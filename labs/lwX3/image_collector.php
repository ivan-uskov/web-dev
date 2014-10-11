<?php

    define('START_INDEX_POST_NAME', 'index');
    define('SIZE_POST_NAME', 'size');
    define('INDEX_FILE_NAME', 'index.idx');
    define('SLIDES_DIR', 'img/slideshow');
    define('EOLN', "\n");
    define('LOG_PATH', 'D:/PS/Web/labs/lwX3/logs/image_collector.log');

    function makeImageIndex($slidesDirPath)
    {
        $files = array();
        $dirHandler = dir($slidesDirPath);

        while ( false !== ($file = $dirHandler->read()) )
        {
            $filePath = $slidesDirPath . '/' . $file;
            if (checkFileAsImg($filePath))
            {
                array_push($files, $filePath);
            }
        }
        $dirHandler->close();
        return $files;
    }

    function checkFileAsImg($filePath)
    {
        $imgTypes = array('png', 'jpg', 'jpeg', 'gif');
        $fileExt = preg_replace('/(.*)[\.]([a-zA-Z]+$)/', '$2', $filePath);
        $fileExt = mb_strtolower($fileExt, 'UTF-8');
        return (is_file($filePath) && in_array($fileExt, $imgTypes));
    }

    function updateIndexFiles()
    {
        $filePath = SLIDES_DIR . '/' . INDEX_FILE_NAME;
        $indexFileList = makeImageIndex(SLIDES_DIR);
        if (file_exists(SLIDES_DIR . '/' . INDEX_FILE_NAME))
        {
            $oldList = deleteEolnSymbols(file($filePath));
            $indexFileList = mergeLists($oldList, $indexFileList);
        }
        else
        {
            saveIndexFile($indexFileList);
        }
        return $indexFileList;
    }

    function mergeLists($oldList, $newList)
    {
        for ($newI = 0; $newI < count($newList); $newI++)
        {
            $isTwice = false;
            for ($oldI = 0; $oldI < count($oldList); $oldI++)
            {
                if ($oldList[$oldI] == $newList[$newI])
                {
                    $isTwice = true;
                }
            }
            if (!$isTwice)
            {
                array_push($oldList, $newList[$newI]);
            }
        }
        return $oldList;
    }

    function deleteEolnSymbols($list)
    {
        for ($i = 0; $i < count($list); $i++)
        {
            $list[$i] = preg_replace('/\n$/', '', $list[$i]);
        }
        return $list;
    }

    function saveIndexFile($fileList)
    {
        $fileHand = fopen(SLIDES_DIR . '/' . INDEX_FILE_NAME, 'w');
        for ($i = 0; $i < count($fileList); $i++)
        {
            fwrite($fileHand, $fileList[$i] . EOLN);
        }
        fclose($fileHand);
    }

    function getImages($startPointer, $size)
    {
        $indexList = updateIndexFiles();
        $imgPart = array();
        $end = (count($indexList) >= $size + $startPointer) ? $startPointer + $size : count($indexList);
        if (($startPointer > -1) && ($startPointer < count($indexList)))
        {
            for ($i = $startPointer; $i < $end; $i++)
            {
                array_push($imgPart, $indexList[$i]);
            }
        }
        return $imgPart;
    }

    function getPostParam($name, $default = null)
    {
        return isset($_POST[$name]) && !empty($_POST[$name]) ? $_POST[$name] : $default;
    }

    function fastLog($str)
    {
        file_put_contents(LOG_PATH, $str . EOLN, FILE_APPEND);
    }

    function requestHandler()
    {
        $startIndex = (int) getPostParam(START_INDEX_POST_NAME);
        $size = (int) getPostParam(SIZE_POST_NAME);
        fastLog("StartID $startIndex Size $size");
        if ( !is_null($startIndex) && !is_null($size) )
        {
            $imagesPart = getImages($startIndex, $size);
            echo json_encode($imagesPart);
        }
        else
        {
            echo "invalid params";
        }
    }

    header('Content-Type: text/html; charset=utf-8');
    requestHandler();