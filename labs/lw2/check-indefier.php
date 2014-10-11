<?php
    $identifier = isset($_GET['identifier']) ? $_GET['identifier'] : NULL;    
    if (!empty($identifier) && !preg_match('/[^a-zA-Z0-9]/', $identifier) && preg_match('/^[a-zA-Z]/', $identifier))
    {  
        echo "Correct identifier!<br />";
    }
    else
    {
        echo "Invalid identifier!<br />";
        if (preg_match('/^[0-9]/', $identifier))
        {
            echo "Number can't stay on first position!<br />";
        }
        $pos = -1;
        while (preg_match('/[^a-zA-Z0-9]/', $identifier, $chars, PREG_OFFSET_CAPTURE, ++$pos))
        {
            $curr = $chars[0]; //возвращаемый массив $chars содержит 1 элемент
            $char = $curr[0];  //в котором два элемента подстрока и её позиция
            $pos = $curr[1];
            echo "'$char' on pos '$pos' can't be in identifier!<br />";
        }
    }    
?>                  