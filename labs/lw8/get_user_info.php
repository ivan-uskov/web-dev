<?php

    require_once("config.inc.php");
    require_once(SCRIPTS_DIR . "common.inc.php");
    require_once(SCRIPTS_DIR . 'get_user_info.inc.php');

    redirectNonAuth($currUserId);

    $tplName = 'get_data.tpl';
    $styles = array('form_styles.css', 'show_data_styles.css');

    $userData = getUserDataByParam('user_id');
    $userData = is_null($userData) ? getUserDataByParam('email') : $userData;

    $pageVars['title']      = 'User Info';
    $pageVars['pageStyles'] = addStyles($styles);

    $tplVars = array();

    if (!is_null($userData))
    {
        $tplVars['info'] = $userData;
        $tplName = 'info.tpl';
    }

    echo buildPage($tplName, $tplVars, $pageVars);
