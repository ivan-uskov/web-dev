<?php

    require_once("config.inc.php");
    require_once(SCRIPTS_DIR . "common.inc.php");
    require_once(SCRIPTS_DIR . "sign_in.inc.php");

    $styles = array('form_styles.css', 'sign_in_styles.css');
    $info = (getParamFromGet('info') == NA_KEY) ? 'Your redirected, please Sign In!' : 'Enter your data';

    if (getParamFromGet('log_out') == 'true')
    {
        $_SESSION['user_id'] = null;
        $pageVars['userEmail'] = 'Not Authorized';
    }

    $userData = getSignInDataFromRequest();
    if (authenticate($userData))
    {
        $lastPage = isset($_SESSION['redirected_page']) ? $_SESSION['redirected_page'] : false;
        if ($lastPage && (in_array($lastPage, $pagesList)))
        {
            $_SESSION['redirected_page'] = null;
            header("Location: $lastPage");
            die();
        }
        header('Location: get_user_info.php?user_id=' . $_SESSION['user_id']);
        die();
    }

    $pageVars['title']      = 'User Info';
    $pageVars['pageStyles'] = addStyles($styles);

    $tplVars = array
    (
        'info' => $info
    );

    echo buildPage('sign_in.tpl', $tplVars, $pageVars);

