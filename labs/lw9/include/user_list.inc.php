<?php

    /**
     * Собирает часть таблицы в строку
     * @param $dataAssoc массив пользователей
     * каждый пользователь массив с краткой информацией
     * @return string
     */
    function makeTableStr($dataAssoc)
    {
        $out = '';
        for ($i = 0; $i < count($dataAssoc); $i++)
        {
            if ($i == MAX_USERS) break;
            $user = $dataAssoc[$i];
            $out = $out . '<tr>';
            $out = $out . '<td>' . $user['user_id'] . '</td>';
            $out = $out . '<td>' . $user['first_name'] . '</td>';
            $out = $out . '<td>' . $user['last_name'] . '</td>';
            $out = $out . '<td><a href="get_user_info.php?user_id=' . $user['user_id'] . '" title="Look User Info">';
            $out = $out . $user['email'] . '</a></td>';
            $out = $out . '</tr>';
        }
        return $out;
    }

    function getUserList()
    {
        $table= 'users';
        $fields = 'user_id, first_name, last_name, email';
        if (dbLinkConnect()) $condition = "ORDER BY user_id";
        return isset($condition) ? makeTableStr(selectColsFromTable($table, $fields, $condition)) : null;
    }