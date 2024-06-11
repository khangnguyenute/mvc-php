<?php

function userDetail($id)
{
    $user = getUserById($id);
    require_once PATH_VIEW . 'users/detail.php';
}
