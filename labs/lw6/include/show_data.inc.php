<?php
    function createOutStr($data)
    {
        $str = '';
        for ($i = 0; $i < count($data); $i++)
        {
            $data[$i] = preg_replace('/[_]/', ' ', $data[$i]);
            $data[$i] = mb_convert_case($data[$i], MB_CASE_TITLE, "UTF-8");
            $str = $str . $data[$i] . "<br />";
        }
        return $str;
    }

    function showUserData()
    {
        $email = getEmailFromGet('email');
        if ($email)
        {
            $fileName = getFileName($email);
            $data = getDataFromFile($fileName);
            if ($data)
            {
                $out = createOutStr($data);
            }
            else
            {
                $out = "File doesn't exist";
            }
        }
        else
        {
            $out = "Please enter correct email!";
        }
        return $out;
    }