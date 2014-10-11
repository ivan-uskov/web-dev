<?php
    require_once('config.mysql.inc.php');

    function dbLinkConnect()
    {
        global $g_dbLink;
        $g_dbLink = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $err = mysqli_connect_error();
        return !$err;
    }

    function escapeString($value)
    {
        global $g_dbLink;
        return "'" . mysqli_real_escape_string($g_dbLink, $value) . "'";
    }

    /**
     * Собирает SQL запрос из ассоицитивного массива в строку
     * ключи массива - название столбцов
     * @param array $data
     * @param string $tableName
     * @return null|string
     */
    function makeInsertQuery($data, $tableName)
    {
        if (!empty($data))
        {
            $sqlQuery = 'INSERT INTO ' . $tableName . ' SET ';
            foreach ($data as $key => $val)
            {
                $sqlQuery = $sqlQuery . ' ' . $key . ' = ' . escapeString($val) . ',';
            }
            $sqlQuery = mb_substr($sqlQuery, 0, -1); // удаляем лишнюю запятую в конце строки
            $sqlQuery = $sqlQuery . ';';
        }
        else
        {
            $sqlQuery = null;
        }
        return $sqlQuery;
    }

    /**
     * Добавляет данные в таблицу
     * @param string $tableName имя таблицы
     * @param  array $data данные columnName => val
     * @return string|bool сообщение об ошибке, при её наличии, иначе false
     */
    function insertIntoTable($tableName, $data)
    {
        global $g_dbLink;
        $query = makeInsertQuery($data, $tableName); //Подготавливаем запрос
        $res = $query ? mysqli_query($g_dbLink, $query) : false; //Делаем запрос
        if (!$res) $msg = 'Query err ' . mysqli_error($g_dbLink); //Проверяем ошибки
        return isset($msg) ? $msg : false;
    }

    function makeSelectQuery($tableName, $fields, $condition = '')
    {
        $sqlQuery = null;
        if (!empty($fields))
        {
            $sqlQuery = "SELECT $fields FROM $tableName $condition";
        }
        return $sqlQuery;
    }

    function getAssoc($res)
    {
        $data = array();
        while ($row = mysqli_fetch_assoc($res))
        {
            array_push($data, $row);
        }
        return $data;
    }

    /**
     * Запрашивает данные из таблицы (по условию)
     * @param string $tableName
     * @param string $fields необходимые поля, через запятую
     * @param string $condition условие на языке SQL
     * @return array|string
     */
    function selectColsFromTable($tableName, $fields, $condition = '')
    {
        global $g_dbLink;
        $query = makeSelectQuery($tableName, $fields, $condition);
        $res = $query ? mysqli_query($g_dbLink, $query) : false;
        if ($res)
        {
            $data = getAssoc($res);
        }
        else
        {
            $msg = 'Query err ' . mysqli_error($g_dbLink);
        }
        return isset($msg) ? $msg : $data;
    }

    function getLastInsertId()
    {
        global $g_dbLink;
        return mysqli_insert_id($g_dbLink);
    }

    function getUserDataByEmailFromDB($data)
    {
        $condition = "WHERE email = " . escapeString($data['email']);
        $res = selectColsFromTable(TABLE_FOR_USERS, 'user_id, password', $condition);
        return (gettype($res) == 'array') ? $res : false;
    }

    function getUserEmailByIdFromDB($userId)
    {
        $condition = "WHERE user_id = " . escapeString($userId);
        $res = selectColsFromTable(TABLE_FOR_USERS, 'email', $condition);
        return (gettype($res) == 'array') && (isset($res[0])) ? $res[0]['email'] : null;
    }

    function checkUser($email)
    {
        $condition = "WHERE email = " . escapeString($email);
        $res = selectColsFromTable('users', 'user_id', $condition);
        return (count($res) > 0) ? true : false;
    }


