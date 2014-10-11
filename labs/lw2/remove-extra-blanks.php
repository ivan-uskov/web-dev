<?php
    header("Content-Type: text/plain; charset=utf-8");
    $text = isset($_GET['text']) ? $_GET['text'] : NULL; 
    if (!empty($text))
    {
        $text = trim($text);
        $rich_text = "";
        for($i = 0; $i < strlen($text); $i++)
        {
            if (!($text[$i] == ' ' && $text[$i + 1] == ' '))
            {
                $rich_text = $rich_text . $text[$i];
            }
        }
        echo $rich_text;
    }

?>  