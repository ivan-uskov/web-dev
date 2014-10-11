<?php

    function makeOutStr($data)
    {
        $out = '';
        foreach($data[0] as $key => $val)
        {
            $key = preg_replace('/[_]/', ' ', $key);
            $key = mb_convert_case($key, MB_CASE_TITLE, "UTF-8");
            if ($key != 'Password')
            {
                $out = $out . $key . ' = ' . $val . '<br/>';
            }
        }
        return $out;
    }

    /**
     * Достаёт из базы информацию о user и собирает из неё строку
     * @param $param имя параметра из GET по которому находится польватель
     * @return null|string
     */
    function getUserDataByParam($param)
    {
        $paramVal = getParamFromGet($param);
        if (!is_null($paramVal) && dbLinkConnect()) $condition = "WHERE $param = " .  escapeString($paramVal);
        return isset($condition) ? makeOutStr(selectColsFromTable('users', '*', $condition)) : null;
    }