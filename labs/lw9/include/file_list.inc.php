<?php

    function checkFilter()
    {
        $filter = null;
        $email = getParamFromGet('email');
        $ext = getParamFromGet('ext');
        if (!is_null($email) && !is_null($ext))
        {
            $filter = " ((email LIKE '%$email%') AND (file_ext LIK '%$ext%'))";
        }
        elseif (!is_null($email))
        {
            $filter = " (email LIKE '%$email%')";
        }
        elseif (!is_null($ext))
        {
            $filter = " (file_ext LIKE '%$ext%')";
        }
        return $filter;
    }

    function makeTableStr($data)
    {
        $out = '';
        for ($i = 0; $i < count($data); $i++)
        {
            if ($i == MAX_FILES) break;
            $user = $data[$i];
            $out = $out . '<tr>';
            $out = $out . '<td>' . $user['file_id'] . '</td>';
            $out = $out . '<td>' . $user['real_name'] . '</td>';
            $out = $out . '<td>' . $user['first_name'] . ' ' . $user['last_name'] . '</td>';
            $out = $out . '<td>' . $user['email'] . '</td>';
            $out = $out . '<td>' . $user['add_date'] . '</td>';
            $out = $out . '</tr>';
        }
        return $out;
    }

    function getFileList()
    {
        $filter = checkFilter();
        $fields = 'user_files.file_id, user_files.real_name, users.first_name,
                   users.last_name, users.email, user_files.add_date';
        $tables = 'users, user_files';
        $condition = ' WHERE (user_files.user_id = users.user_id) ';
        if (!is_null($filter)) $condition = $condition . 'AND' . $filter;
        return makeTableStr(selectColsFromTable($tables, $fields, $condition));
    }