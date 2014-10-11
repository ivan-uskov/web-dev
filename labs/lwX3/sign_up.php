<?php

    require_once("config.inc.php");
    require_once(SCRIPTS_DIR . 'common.inc.php');
    require_once(SCRIPTS_DIR . "sign_up.inc.php");

    $scripts = array('lib/ajax.js', 'lib/validate.js', 'sign_up.js');
    $styles = array('form_styles.css');
    $title = 'Sign Up';
    $tplName = 'reg_form.tpl';
    $msg = 'Its free and always will be';

    if (!empty($_POST))
    {
        $data = getUserDataFromRequest();
        $msg = saveUserData($data);
        $title = 'Save Data';
        $tplName = 'info.tpl';
        array_push($styles, 'show_data_styles.css');
        array_push($styles, 'upload_styles.css');
    }

    $vars['info']             = $msg;
    $vars['title']            = $title;
    $vars['days']             = $days; // declarated in sign_up.inc.php
    $vars['years']            = $years; // declarated in sign_up.inc.php
    $vars['months']           = $months; // declarated in sign_up.inc.php
    $vars['scripts']          = $scripts;
    $vars['pageStyles']       = $styles;
    $vars['content_template'] = $tplName;

    echo buildPage($vars);
