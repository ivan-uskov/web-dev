<?php
    require_once('common/functions.inc.php');
    require_once('common/mysql_io.inc.php');
    require_once('common/template.inc.php');
    require_once('common/account.inc.php');

    $pagesList = array('file_list.php', 'get_user_info.php', 'sign_in.php', 'sign_up.php', 'upload_file.php', 'user_list.php');

    dbLinkConnect();

    session_id('Account');
    session_start();

    $currUserId = getCurrUserId();
    $currUserEmail = getUserEmailByIdFromDB($currUserId);
    $pageVars = array
    (
        'userEmail' => !is_null($currUserEmail) ? $currUserEmail : 'Not Authorized'
    );