<?php
    function getDataFromFile($fileName)
    {
        $data = false;
        if (file_exists($fileName))
        {
            $data = file($fileName);
        }
        return $data;
    }

    function getFileName($email)
    {
        return "data/" . $email . ".txt";
    }

    function createOutStr($data)
    {
        $str = '';
        for ($i = 0; $i < count($data); $i++)
        {
            $str = $str . $data[$i] . "<br />";
        }
        return $str;
    }

    $email = isset($_GET['email']) ? $_GET['email'] : NULL;
    $message = false;
    if ($email)
    {
        $fileName = getFileName($email);
        $data = getDataFromFile($fileName);
        if ($data)
        {
            echo createOutStr($data);
        }
        else
        {
            $message = "File doesn't exist";
        }
    }
    else
    {
        $message = "Please enter email!";
    }

    if ($message) echo $message;

