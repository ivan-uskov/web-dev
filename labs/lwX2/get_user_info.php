<?php

    require_once("config.inc.php");
    require_once(SCRIPTS_DIR . "common.inc.php");
    require_once(SCRIPTS_DIR . 'get_user_info.inc.php');

    redirectNonAuth($currUserId, 'get_user_info.php');

    $styles = array('form_styles.css', 'show_data_styles.css');

    $userData = getUserDataByParam('user_id');
    $userData = is_null($userData) ? getUserDataByParam('email') : $userData;

    $vars['title']      = 'User Info';
    $vars['scripts'] = array();
    $vars['pageStyles'] = $styles;
    $vars['content_template'] = 'get_data.tpl';

    if (!is_null($userData))
    {
        $vars['info'] = $userData;
        $vars['content_template'] = 'info.tpl';
    }

    echo buildPage($vars);
