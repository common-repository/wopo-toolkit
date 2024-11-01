<?php
$wopotk_message = '';
$wopotk_active_plugins_saved = get_option('wopotk_active_plugins_saved');

/* record update log */
if (isset($_GET['tool']) && $_GET['tool']=='stop-update-log'){
  if (delete_option('wopotk_update_log')){
    $wopotk_message = '<span style="color:green">Update log data stopped!</span>';
  }else{
    $wopotk_message = '<span style="color:red">Update log data stop error!</span>';
  }
}

$wopotk_update_log = get_option('wopotk_update_log');
$wopotk_update_log_data = maybe_unserialize($wopotk_update_log);
if ((isset($wopotk_update_log_data['date']) && $wopotk_update_log_data['date']!= date('Y.m.d'))||($wopotk_update_log == false)){
  $wopotk_update_log_data['date'] = date('Y.m.d');
  $wopotk_update_log_data['log'] = '';
}


if (isset($_GET['tool']) && $_GET['tool']=='start-update-log'){
  if (update_option('wopotk_update_log',maybe_serialize($wopotk_update_log_data))){
    $wopotk_message = '<span style="color:green">Update log started!</span>';
    $wopotk_update_log = true;
  }else{
    $wopotk_message = '<span style="color:red">Update log start error!</span>';
  }
}

if (isset($_GET['tool']) && $_GET['tool']=='view-update-log'){
  echo 'Update Log: <br /><pre>'. $wopotk_update_log_data['log'].'</pre>';
}


/* save actived plugins */
if (isset($_GET['tool']) && $_GET['tool']=='save-actived-plugin'){
  $apl=get_option('active_plugins');
  if ($wopotk_active_plugins_saved !== false){
    $wopotk_message = '<span style="color:red">Can\'t save! You need delete your old data first</span>';
  }else if (update_option('wopotk_active_plugins_saved',$apl)){
    $wopotk_message = '<span style="color:green">Actived plugins data saved!</span>';
    $wopotk_active_plugins_saved = get_option('wopotk_active_plugins_saved');
  }else{
    $wopotk_message = '<span style="color:red">Save actived plugins error!</span>';
  }
}

/* restore actived plugins */
if (isset($_GET['tool']) && $_GET['tool']=='restore-actived-plugin'){
  if (update_option('active_plugins',$wopotk_active_plugins_saved)){
    $wopotk_message = '<span style="color:green">Actived plugins data restored!</span>';
  }else{
    $wopotk_message = '<span style="color:red">Restore active plugins error!</span>';
  }
}

if (isset($_GET['tool']) && $_GET['tool']=='delete-actived-plugin'){
  if (delete_option('wopotk_active_plugins_saved')){
    $wopotk_message = '<span style="color:green">Actived plugins data deleted!</span>';
    $wopotk_active_plugins_saved = false;
  }else{
    $wopotk_message = '<span style="color:red">Delete actived plugins error!</span>';
  }
}
echo $wopotk_message;