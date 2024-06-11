<?php

function homeIndex()
{
    $users = getAllUsers();
    require_once PATH_VIEW . 'home.php';
}
