<?php

    require_once("config.inc.php");
    require_once(SCRIPTS_DIR . 'common.inc.php');
    require_once(SCRIPTS_DIR . 'file_list.inc.php');

    redirectNonAuth($currUserId, 'file_list.php');

    $scripts = array('lib/ajax.js', 'lib/file_list.inc.js', 'file_list.js');
    $styles = array('form_styles.css', 'show_data_styles.css', 'list_styles.css');

    $files = getFileList();

    $email = getParamFromGet('email') ? getParamFromGet('email') : '';
    $ext = getParamFromGet('ext') ? getParamFromGet('ext') : '';

    $vars['ext']              = $ext;
    $vars['title']            = 'File list';
    $vars['email']            = $email;
    $vars['scripts']          = $scripts;
    $vars['pageStyles']       = $styles;
    $vars['content_template'] = 'file_list.tpl';

    if (isset($files)) $vars['files'] = $files;

    echo buildPage($vars);
