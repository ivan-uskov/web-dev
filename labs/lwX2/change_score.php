<?php
    require_once("config.inc.php");
    require_once(SCRIPTS_DIR . 'common.inc.php');

    $newChange = array
    (
        'user_id' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null,
        'file_id' => isset($_POST['file_id']) ? $_POST['file_id'] : NULL
    );
    $isPlus = isset($_POST['plus']) ? $_POST['plus'] : NULL;

    if (!is_null($newChange['file_id']) && !is_null($newChange['user_id']) && !is_null($isPlus))
    {
        $where = 'file_id=' . $newChange['file_id'];
        $table = 'user_files';
        $set = ($isPlus) ? 'file_score=file_score+1' : 'file_score=file_score-1';
        updateColsBySet($table, $set, $where);
        $newScore = selectColsFromTable('user_files', 'file_score', 'WHERE file_id=' . $newChange['file_id']);
        $newScore = $newScore[0];
        $newChange['recent_score'] = $newScore['file_score'];
        insertIntoTable('files_score_changes', $newChange);
        echo $newChange['recent_score'];
    }