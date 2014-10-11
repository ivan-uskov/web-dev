<?php

    define("DEFAULT_FILENAME", "default");
    define("DEFAULT_PARAGRAPH_COUNT", 0);
    define("DEFAULT_WORD_COUNT", 0);
    define("HEADER_PATH", "/html/header.html");
    define("FOOTER_PATH", "/html/footer.html");

    $paragraphCount = complainInputNumbers($_GET['paragraph_count']) ? $_GET['paragraph_count'] : DEFAULT_PARAGRAPH_COUNT;
    $wordCount = complainInputNumbers($_GET['word_count']) ? $_GET['word_count'] : DEFAULT_WORD_COUNT;
    $fileName = complainInputWords($_GET['fileName']) ? $_GET['fileName'] : DEFAULT_FILENAME;

    function complainInputNumbers($data)
    {
        $isNorm = isset($data) && !empty($data) && !preg_match('/[^0-9]/', $data);
        return $isNorm;
    }

    function complainInputWords($data)
    {
        $isNorm = isset($data) && !empty($data) && !preg_match('/[^a-zA-Z]/', $data);
        return $isNorm;
    }

    function generateFileName($fileName)
    {
        return 'data/' . $fileName . '.txt';
    }

    function formatStr($str)
    {
        $str = preg_replace('/[.,!?]/', '', $str);
        $str = preg_replace('/  /', ' ', $str);
        $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
        return $str;
    }

    function getData($fileName)
    {
        $data = null;
        if(file_exists($fileName))
        {
            $data = file($fileName);
        }
        else
        {
            $data = file(generateFileName(DEFAULT_FILENAME));
        }
        return $data;
    }

    function concateData($data)
    {
        $text = '';
        if ($data)
        {
            for ($i = 0; $i < count($data); $i++)
            {
                if (strlen($data[$i]) > 0 )
                {
                    $str = $data[$i];
                    $str = formatStr($str);
                    if ($str != '') $text = $text . $str;
                }
            }
        }
        return $text;
    }

    function createParagraph($text, $wordCount)
    {
        if ($wordCount > 0)
        {
            $paragraph = '<p>';
            $text[0] = mb_convert_case($text[0], MB_CASE_TITLE, "UTF-8");
            for ($i = 0; $i < $wordCount; $i++)
            {
                $paragraph = $paragraph . ' ' . $text[$i];
            }
            $paragraph =  $paragraph . '.</p>';
        }
        else
        {
            $paragraph = '';
        }
        return $paragraph;
    }

    function resizeText($text, $wordCount)
    {
        for ($i = 0; $i < $wordCount; $i++)
        {
            array_shift($text);
        }
        return $text;
    }

    function displayLorem($paragraphCount, $wordCount, $fileName)
    {
        $text = concateData(getData(generateFileName($fileName)));
        if (!empty($text))
        {
            $default = explode(" ", $text);
            $words = $default;
            for ($i = 0; $i < $paragraphCount; $i++)
            {
                while ((count($words) < $wordCount ))
                {
                    $words =  array_merge($words, $default);
                    shuffle($words);
                }
                echo createParagraph($words, $wordCount);
                $words = resizeText($words, $wordCount);
            }
        }
    }

    include_once(HEADER_PATH);
    displayLorem($paragraphCount, $wordCount, $fileName);
    include_once(FOOTER_PATH);