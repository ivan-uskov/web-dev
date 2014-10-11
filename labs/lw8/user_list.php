<?php

    require_once("config.inc.php");
    require_once(SCRIPTS_DIR . 'common.inc.php');
    require_once(SCRIPTS_DIR . 'user_list.inc.php');

    redirectNonAuth($currUserId);

    $styles = array('form_styles.css', 'show_data_styles.css', 'list_styles.css');
    $users = getUserList();

    $pageVars['title']      = 'User Info';
    $pageVars['pageStyles'] = addStyles($styles);

    $tplVars = array
    (
        'users' => $users
    );

    echo buildPage('user_list.tpl', $tplVars, $pageVars);
