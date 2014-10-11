<?php
    $message = "File is recorded normally!";
    $email = isset($_GET['email']) ? $_GET['email'] : NULL;
    if ($email)
    {
        $userData = fopen("data/" . $email . ".txt", "w");
        if ($userData)
        {
            foreach ($_GET as $key => $val)
            {
                $key = preg_replace('/[_]/', ' ', $key);
                $key = mb_convert_case($key, MB_CASE_TITLE, "UTF-8");
                $str = $key . ": " . $val . "\r\n";
                $write = fwrite($userData, $str); // Запись в файл
                if (!$write) $message = 'Write error';
            }
            fclose($userData);
        }
        else
        {
            $message = "Can't create file";
        }
    }
    else
    {
        $message = "Please enter Email";
    }
    echo $message;
?>
