<?php
    function getCurrUserId()
    {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }

    function redirectNonAuth($currUserId, $currPage)
    {
        $_SESSION['redirected_page'] = $currPage;
        if (is_null($currUserId))
        {
            header('Location: sign_in.php?info=' . NA_KEY);
            die();
        }
    }