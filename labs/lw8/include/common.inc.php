<?php
    require_once('common/functions.inc.php');
    require_once('common/mysql_io.inc.php');
    require_once('common/template.inc.php');
    require_once('common/account.inc.php');

    dbLinkConnect();

    session_id('Account');
    session_start();

    $currUserId = getCurrUserId();
    $currUserEmail = getUserEmailByIdFromDB($currUserId);
    $pageVars = array
    (
        'userEmail' => !is_null($currUserEmail) ? $currUserEmail : 'Not Authorized'
    );