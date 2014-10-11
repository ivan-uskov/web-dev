<?php
    function getFromPost($name, $defaultValue = null)
    {
        return isset($_POST[$name]) ? $_POST[$name] : $defaultValue;
    }

    function getTextFromPost($name, $defaultValue = null)
    {
        $elt = getFromPost($name, $defaultValue);
        return !empty($elt) && !preg_match(CORRECT_DATA, $elt) ? $elt : $defaultValue;
    }

    function getEmailFromPost($name, $defaultValue = null)
    {
        $elt = getFromPost($name, $defaultValue);
        return !empty($elt) && !preg_match(EMAIL_RULE, $elt) ? $elt : NO_EMAIL;
    }

    function getEmailFromGet($key)
    {
        $email = isset($_GET[$key]) && !empty($_GET[$key]) ? $_GET[$key] : false;
        return !preg_match(EMAIL_RULE, $email) ? $email : false;
    }

    function getFileName($email)
    {
        $fileName = FILE_DIR . $email . FILE_RESOLUTION;
        return $fileName;
    }

    function genDateStr($year, $month, $day)
    {
        return $year . "-" . $month . "-" . $day;
    }

    function getParamFromGet($name)
    {
        return isset($_GET[$name]) && !empty($_GET[$name]) ? $_GET[$name] : null;
    }
