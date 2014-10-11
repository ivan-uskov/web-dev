<?php

    require_once("config.inc.php");
    require_once(SCRIPTS_DIR . 'common.inc.php');
    require_once(SCRIPTS_DIR . 'file_list.inc.php');

    redirectNonAuth($currUserId, 'file_list.php');

    $styles = array('form_styles.css', 'show_data_styles.css', 'list_styles.css');

    $files = getFileList();

    $email = getParamFromGet('email') ? getParamFromGet('email') : '';
    $ext = getParamFromGet('ext') ? getParamFromGet('ext') : '';

    $pageVars['title']      = 'File list';
    $pageVars['pageStyles'] = addStyles($styles);

    $tplVars = array
    (
        'email' => $email,
        'ext' => $ext
    );

    if (isset($files)) $tplVars['files'] = $files;

    echo buildPage('file_list.tpl', $tplVars, $pageVars);