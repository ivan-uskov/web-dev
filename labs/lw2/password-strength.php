<?php
    function countByReg($reg, $str)
    {
        $col = 0;
        $pos = 0;
        while (preg_match($reg, $str, $chars, PREG_OFFSET_CAPTURE, $pos))
        {
            $curr = $chars[0];
            $col++;
            $pos = $curr[1] + 1;
        }
        return $col;
    }

    $strength = 0;
    $pass = isset($_GET['password']) ? $_GET['password'] : NULL;
    if ($pass)
    {
        $strength += 4 * strlen($pass); //+Длинна пароля
        $strength += countByReg('/[0-9]/', $pass) * 4; //+Количество цифр
        $strength += (strlen($pass) - countByReg('/[A-Z]/', $pass)) * 2; //+Количество символов в верхнем регистре
        $strength += (strlen($pass) - countByReg('/[a-z]/', $pass)) * 2; //+Количество символов в нижнем регистре
        if (!preg_match('/[^0-9]/', $pass))
        {
            $strength -= strlen($pass); //-Если в строке только цифры
        }
        if (!preg_match('/[^a-zA-Z]/', $pass))
        {
            $strength -= strlen($pass); //-Если в строке только буквы
        }
        for ($i = 0; $i < strlen($pass); $i++)
        {
            if (substr_count($pass, $pass[$i], $i) > 1)
            {
                $strength -= substr_count($pass, $pass[$i], $i); //Вычитаем повторяющиеся символы
            }
        }
    }
    echo $strength;
?>
