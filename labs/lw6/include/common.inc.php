<?php
    function getFromPost($name, $defaultValue = null)
    {
        return isset($_POST[$name]) && !preg_match(CORRECT_DATA, $_POST[$name]) ? $_POST[$name] : $defaultValue;
    }

    function getEmailFromPost($name)
    {
        return isset($_POST[$name]) && complainEmail($_POST[$name]) ? $_POST[$name] : NO_EMAIL;;
    }

    function complainEmail($email)
    {
        $isNorm = !preg_match(EMAIL_RULE, $email);
        return $isNorm;
    }

    function getEmailFromGet($key)
    {
        $email = isset($_GET[$key]) && !empty($_GET[$key]) ? $_GET[$key] : false;
        return complainEmail($email) ? $email : false;
    }

    function getFileName($email)
    {
        $fileName = FILE_DIR . $email . FILE_RESOLUTION;
        return $fileName;
    }

    function genDateStr($date)
    {
        return $date['day'] . "/" . $date['month'] . "/" . $date['year'];
    }

    function getDataFromFile($fileName)
    {
        $data = false;
        if (file_exists($fileName))
        {
            $data = file($fileName);
        }
        return $data;
    }