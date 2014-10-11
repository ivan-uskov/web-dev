<?php

    function getSignInDataFromRequest()
    {
        $data = array(
            'email' => getEmailFromPost('email'),
            'password' => hash('sha256', getTextFromPost('password'))
        );
        return $data['email'] != NO_EMAIL ? $data : null;
    }

    function checkUserData($userList, $userData)
    {
        $userId = null;
        foreach ($userList as $num => $user)
        {
            if ($user['password'] == $userData['password'])
            {
                $userId = $user['user_id'];
            }
        }
        return $userId;
    }

    function authenticate($userData)
    {
        $authenticated = false;
        $userList = getUserDataByEmailFromDB($userData);
        $userId = checkUserData($userList, $userData);
        if (!is_null($userId))
        {
            $_SESSION['user_id'] = $userId;
            $authenticated = true;
        }
        return $authenticated;
    }