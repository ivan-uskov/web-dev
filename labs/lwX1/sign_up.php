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
    $pageVars['scripts']     = addScripts($scripts);
    $pageVars['title']       = $title;
    $pageVars['pageStyles']  = addStyles($styles);
    //var_dump($pageVars['scripts']);

    $tplVars = array
    (
        'genDays' => genDays(),
        'genYears' => genYears(),
        'info' => $msg
    );

    echo buildPage($tplName, $tplVars, $pageVars);
