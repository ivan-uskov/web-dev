<?php

    require_once("config.inc.php");
    require_once(SCRIPTS_DIR . 'common.inc.php');
    require_once(SCRIPTS_DIR . 'user_list.inc.php');

    redirectNonAuth($currUserId, 'user_list.php');

    $styles = array('form_styles.css', 'show_data_styles.css', 'list_styles.css');
    $users = getUserList();

    $vars['title']            = 'User Info';
    $vars['users']            = $users;
    $vars['scripts']          = array();
    $vars['pageStyles']       = $styles;
    $vars['content_template'] = 'user_list.tpl';

    echo buildPage($vars);
