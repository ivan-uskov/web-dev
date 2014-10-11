<?php
    function checkUserChangeFile($user_id, $file_id)
    {
        $where = 'WHERE (user_id=' . $user_id . ')AND(file_id=' . $file_id . ')';
        $changes = selectColsFromTable('files_score_changes', 'change_id', $file_id);
        return count($changes) > 0 ? false : true;
    }
