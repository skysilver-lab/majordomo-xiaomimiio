<?php

if ($this->mode == 'update') {
    $login = gr('cloud_login');
    $pass = gr('cloud_password');
    $region = gr('cloud_region');
    $read_only = gr('read_only','int');
    $out['READ_ONLY']=$read_only;
    if ($login && $pass) {
        $cmd = 'python3 '.dirname(__FILE__) . '/token_extractor.py --server='.$region.' --username='.$login.' --password='.$pass;

        $res = exec($cmd, $output);
        $result = array();
        $out['OUTPUT']=$cmd."\n\n".implode("\n",$output);
        $current_device = array();
        foreach($output as $line) {
            if (preg_match('/new-device/',$line)) {
                $current_device = array();
            }
            if (preg_match('/{(.+?)}={(.+?)}/is',$line,$m)) {
                $current_device[$m[1]]=$m[2];
            }
            if ($current_device['ID']) {
                $result[$current_device['ID']]=$current_device;
            }
        }

        //$milo=SQLSelect("SELECT * FROM miio_devices");
        //dprint($result,false);

        if (!$read_only) {
            $updated_devices=0;
            foreach($result as $device) {
                // MODEL NAME TOKEN
                $device_rec = SQLSelectOne("SELECT * FROM miio_devices WHERE IP='".$device['IP']."'");
                if ($device_rec['ID']
                    && ($device_rec['DEVICE_TYPE']==$device['MODEL'] || $device_rec['DEVICE_TYPE']=='')) {
                    if (preg_match('/^new /is',$device_rec['TITLE'])) {
                        $device_rec['TITLE']=$device['NAME'];
                    }
                    $device_rec['TOKEN']=$device['TOKEN'];
                    $device_rec['DEVICE_TYPE']=$device['MODEL'];
                    SQLUpdate('miio_devices',$device_rec);
                    $updated_devices++;
                }
            }
            if ($updated_devices) {
                $this->discover();
            }
        }

    }
    $out['CLOUD_LOGIN'] = htmlspecialchars($login);
    $out['CLOUD_PASSWORD'] = htmlspecialchars($pass);
    $out['CLOUD_REGION'] = htmlspecialchars($region);
}
