<?php
    define("MAX_YEAR", 2014);
    define("MIN_YEAR", 1970);
    define("MAX_DAY", 31);
    define("MIN_DAY", 1);    

    $months = array
    (
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December'
    );

    $years = genDaysArr();
    $days = genYearsArr();

    function genDaysArr()
    {
        $days = array();
        for ($i = MIN_DAY; $i <= MAX_DAY; $i++)
        {
            $days[$i] = $i;
        }
        return $days;
    }

    function genYearsArr()
    {
        $years = "";
        for ($i = MAX_YEAR; $i >= MIN_YEAR; $i--)
        {
            $years[$i] = $i;
        }
        return $years;
    }

    /**
     * Возвращает массив $data, если в $_POST есть валидные данные
     * массив columnName => val
     * columnName соответсвует названию столбцов в таблице users
     * @return array|bool
     */
    function getUserDataFromRequest()
    {
        $year = getTextFromPost('year');
        $month = getTextFromPost('month');
        $day = getTextFromPost('day');
        $reEmail = getEmailFromPost('re_email');

        $data = array();
        $data['birthday'] = array();
        $data['first_name'] = getTextFromPost('first_name');
        $data['last_name'] = getTextFromPost('last_name');
        $data['email'] = getEmailFromPost('email');
        $data['password'] = hash('sha256', getTextFromPost('password'));
        $data['gender'] = getTextFromPost('i_am');
        if ($year && $month && $day) $data['birthday'] = genDateStr($year, $month, $day);

        $valid = (($data['email'] == $reEmail) && ($data['email'] != NO_EMAIL)) ? true : null;
        $valid = $valid && !is_null($data['email']) && !is_null($data['password']);

        return $valid ? $data : false;
    }

    function saveToDB($data)
    {
        $msg = (dbLinkConnect()) ? insertIntoTable(TABLE_FOR_USERS, $data) : 'Connect to DB problems';
        //Фалы записанны если $msg === false иначе $msg = сообщение об ошибке
        return ($msg === false) ? "Your are registered" : $msg;
    }

    function saveUserData($data)
    {
        $email = $data['email'];
        if (checkUser($email))
        {
            $msg = 'User is already exists. Please write another email';
        }
        else
        {
            $msg = $data ? saveToDB($data) : 'Invalid Data!';
        }
        return $msg;
    }

