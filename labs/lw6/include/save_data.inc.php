<?php
    function getData()
    {
        $data = array();
        $data['age'] = array();
        $data['first_name'] = getFromPost('first_name', '');
        $data['last_name'] = getFromPost('last_name', '');
        $data['email'] = getEmailFromPost('email');
        $data['re_email'] = getEmailFromPost('re_email');
        $data['password'] = getFromPost('password');
        $data['i_am'] = getFromPost('i_am');
        $data['age']['year'] = getFromPost('year');
        $data['age']['month'] = getFromPost('month');
        $data['age']['day'] = getFromPost('day');
        $ok = (($data['email'] == $data['re_email']) && $data['email'] != NO_EMAIL) ? true : null;
        return $ok ? $data : false;
    }

    function writeDataToFile($file, $data)
    {
        $status = true;
        foreach ($data as $key => $val)
        {
            $val = ($key == "age") ? genDateStr($val) : $val;
            $str = "$key = $val\r\n";
            $write = fwrite($file, $str);
            if (!$write) $status = false;
        }
        return $status;
    }

    function recordFile($data)
    {
        $status = true;
        if($data)
        {
            $email = $data['email'];
            $file = fopen(getFileName($email), "w");
            writeDataToFile($file, $data);
            fclose($file);
        }
        else
        {
            $status = false;
        }
        return $status;
    }
