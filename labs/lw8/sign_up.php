<?php

    require_once("config.inc.php");
    require_once(SCRIPTS_DIR . 'common.inc.php');
    require_once(SCRIPTS_DIR . "sign_up.inc.php");

    $styles = array('form_styles.css');
    $title = 'Sign Up';
    $tplName = 'reg_form.tpl';
    $msg = 'Its free and always will be';

    if (!empty($_POST))
    {
        $data = getUserDataFromRequest();
        $msg = $data ? saveToDB($data) : 'Invalid Data!';
        $title = 'Save Data';
        $tplName = 'info.tpl';
        array_push($styles, 'show_data_styles.css');
        array_push($styles, 'upload_styles.css');
    }

    $pageVars['title']      = $title;
    $pageVars['pageStyles'] = addStyles($styles);

    $tplVars = array
    (
        'genDays' => genDays(),
        'genYears' => genYears(),
        'info' => $msg
    );

    echo buildPage($tplName, $tplVars, $pageVars);
