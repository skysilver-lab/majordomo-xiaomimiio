<?php
/*
* @version 0.1 (wizard)
*/
  if ($this->owner->name=='panel') {
   $out['CONTROLPANEL']=1;
  }
  $table_name='miio_devices';
  $rec=SQLSelectOne("SELECT * FROM $table_name WHERE ID='$id'");
  if ($this->mode=='update') {
   $ok=1;
  // step: default
  if ($this->tab=='') {
  //updating '<%LANG_TITLE%>' (varchar, required)
   global $title;
   $rec['TITLE']=$title;
   if ($rec['TITLE']=='') {
    $out['ERR_TITLE']=1;
    $ok=0;
   }
  //updating 'IP' (varchar)
   global $ip;
   $rec['IP']=$ip;
  //updating 'TOKEN' (varchar)
   global $token;
   $rec['TOKEN']=$token;
  //updating 'DEVICE_TYPE' (varchar)
   global $device_type;
   $rec['DEVICE_TYPE']=$device_type;
  //updating 'MODEL' (varchar)

      
      global $update_period;
      $rec['UPDATE_PERIOD']=(int)$update_period;
      if ($rec['UPDATE_PERIOD']>0) {
          $rec['NEXT_UPDATE']=date('Y-m-d H:i:s');
      }
      
      $commands=array('online','command','message');


  }
  // step: data
  if ($this->tab=='data') {
  }
  //UPDATING RECORD
   if ($ok) {
    if ($rec['ID']) {
     SQLUpdate($table_name, $rec); // update
    } else {
     $new_rec=1;
     $rec['ID']=SQLInsert($table_name, $rec); // adding new record
    }
    $out['OK']=1;

       if ($this->tab=='') {
           foreach($commands as $cmd) {
               $cmd_rec=SQLSelectOne("SELECT * FROM miio_commands WHERE DEVICE_ID=".$rec['ID']." AND TITLE = '".$cmd."'");
               if (!$cmd_rec['ID']) {
                   $cmd_rec=array();
                   $cmd_rec['TITLE']=$cmd;
                   $cmd_rec['DEVICE_ID']=$rec['ID'];
                   SQLInsert('miio_commands',$cmd_rec);
               }
           }
           $this->requestInfo($rec['ID']);
           sleep(1);
           $this->requestStatus($device_id);

       }

   } else {
    $out['ERR']=1;
   }
  }
  // step: default
  if ($this->tab=='') {
  }
  // step: data
  if ($this->tab=='data') {
  }
  if ($this->tab=='data') {
   //dataset2
   $new_id=0;
   global $delete_id;
   if ($delete_id) {
    SQLExec("DELETE FROM miio_commands WHERE ID='".(int)$delete_id."'");
   }
   $properties=SQLSelect("SELECT * FROM miio_commands WHERE DEVICE_ID='".$rec['ID']."' ORDER BY ID");
   $total=count($properties);
   for($i=0;$i<$total;$i++) {
    if ($properties[$i]['ID']==$new_id) continue;
    if ($this->mode=='update') {
        /*
      global ${'title'.$properties[$i]['ID']};
      $properties[$i]['TITLE']=trim(${'title'.$properties[$i]['ID']});
      global ${'value'.$properties[$i]['ID']};
      $properties[$i]['VALUE']=trim(${'value'.$properties[$i]['ID']});
      */
      global ${'linked_object'.$properties[$i]['ID']};
      $properties[$i]['LINKED_OBJECT']=trim(${'linked_object'.$properties[$i]['ID']});
      global ${'linked_property'.$properties[$i]['ID']};
      $properties[$i]['LINKED_PROPERTY']=trim(${'linked_property'.$properties[$i]['ID']});
      global ${'linked_method'.$properties[$i]['ID']};
      $properties[$i]['LINKED_METHOD']=trim(${'linked_method'.$properties[$i]['ID']});
      SQLUpdate('miio_commands', $properties[$i]);
      $old_linked_object=$properties[$i]['LINKED_OBJECT'];
      $old_linked_property=$properties[$i]['LINKED_PROPERTY'];
      if ($old_linked_object && $old_linked_object!=$properties[$i]['LINKED_OBJECT'] && $old_linked_property && $old_linked_property!=$properties[$i]['LINKED_PROPERTY']) {
       removeLinkedProperty($old_linked_object, $old_linked_property, $this->name);
      }
     }
       $properties[$i]['VALUE']=str_replace('",','", ',$properties[$i]['VALUE']);

       if ($properties[$i]['LINKED_OBJECT'] && $properties[$i]['LINKED_PROPERTY']) {
           addLinkedProperty($properties[$i]['LINKED_OBJECT'], $properties[$i]['LINKED_PROPERTY'], $this->name);
       }
       if (file_exists(DIR_MODULES.'devices/devices.class.php')) {
           if ($properties[$i]['TITLE']=='power') {
               $properties[$i]['SDEVICE_TYPE']='relay';
           }
       }

   }
   $out['PROPERTIES']=$properties;   
  }
  if (is_array($rec)) {
   foreach($rec as $k=>$v) {
    if (!is_array($v)) {
     $rec[$k]=htmlspecialchars($v);
    }
   }
  }
  outHash($rec, $out);
