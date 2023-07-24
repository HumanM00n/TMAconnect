<?php
    function LoggedIn($user) {
        if (isset($user['pseudo']))
        {
            return true;
        } else {
            return false;
        }
    }