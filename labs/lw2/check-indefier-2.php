<?php
    header("Content-Type: text/html; charset=utf-8");
    $identifier = isset($_GET['identifier']) ? $_GET['identifier'] : NULL;
    $message = 'Не является идентификатором, т.к. первый символ не буква';
    $errors = "";
    $isIdentifier = !empty($identifier) && ctype_alpha($identifier[0]);
    if ($isIdentifier)
    {
        $message = 'Является идентификатором';
        for ($i = 0; $i < strlen($identifier); $i++)
        {
            $char = $identifier[$i];
            if (!ctype_alpha($char) && !is_numeric($char))
            {
                $isIdentifier = false;
                $errors = $errors . $char;
            }
        }
        if (!$isIdentifier)
        {
            $message = "Не является идентификатором, есть недопустимые символы '$errors'";

        }
    }
    echo $message;
?>