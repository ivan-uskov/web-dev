<?php

    require_once("config.inc.php");
    require_once(SCRIPTS_DIR . "common.inc.php");
    require_once(SCRIPTS_DIR . 'upload_file.inc.php');

    redirectNonAuth($currUserId, 'upload_file.php');

    $tplName = 'upload_file.tpl';
    $styles  = array('form_styles.css', 'show_data_styles.css', 'upload_styles.css');
    $answer  = '';

    $userFileData = getFileData();
    if (!is_null($userFileData))
    {
        $userFileData['user_id'] = $currUserId;
        $answer = (saveFile($userFileData)) ? 'File Uploaded Normally!' : 'Please try again!';
        $tplName = 'info.tpl';
    }

    $vars['info']             = $answer;
    $vars['title']            = 'Upload File';
    $vars['scripts']          = array();
    $vars['pageStyles']       = $styles;
    $vars['content_template'] = $tplName;

    echo buildPage($vars);
