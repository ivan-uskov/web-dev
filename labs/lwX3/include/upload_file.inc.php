<?php

    function getFileData()
    {
        return isset($_FILES['user_file']) ? $_FILES['user_file'] : null;
    }

    function makeFilePath($fileInfo)
    {
        $fileInfoToDB['file_ext'] = substr($fileInfo['name'], 1 + strrpos($fileInfo['name'], "."));
        $fileInfoToDB['user_id'] = $fileInfo['user_id'];
        $fileInfoToDB['real_name'] = $fileInfo['name'];
        $msg = insertIntoTable('user_files', $fileInfoToDB);
        if (!$msg)
        {
            $filePath = array
            (
                'realPath' => SITE_ROOT . FILE_DIR . getLastInsertId() . '.' .$fileInfoToDB['file_ext'],
                'tmpPath'  => $fileInfo['tmp_name']
            );
        }
        return isset($filePath) ? $filePath : null;
    }

    function uploadFile($filePath)
    {
        $fileUploaded = move_uploaded_file($filePath['tmpPath'], $filePath['realPath']);
        return $fileUploaded ? true : false;
    }

    /**
     * Сохраняет файт
     * @param array $fileInfo
     * необходимо поле user_id в $fileInfo
     * @return bool|null
     */
    function saveFile($fileInfo)
    {
        $fileUploaded = false;
        if ($fileInfo && isset($fileInfo['user_id']) && $fileInfo['user_id'])
        {
            $filePath = makeFilePath($fileInfo);
            $fileUploaded = !is_null($filePath) ? uploadFile($filePath) : null;
        }
       return $fileUploaded;
    }