<?php
    require_once("const.inc.php");
    require_once(SCRIPTS_DIR . "common.inc.php");
    require_once(SCRIPTS_DIR . "save_data.inc.php");

    $data = getData();
    $status = recordFile($data);
    if ($status)
    {
       $message = "File recorded normally!";
    }
    else
    {
        $message = "Emails doesn't match!";
    }
    echo $message;

