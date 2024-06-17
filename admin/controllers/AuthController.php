<?php

function showFormLogin()
{
    if (!empty($_POST)) {
        login();
    }

    require_once PATH_VIEW_ADMIN . "auth/login.php";
}

function login()
{
    $user = getAdminByEmailAndPassword($_POST["email"], $_POST["password"]);
    if (empty($user)) {
        $_SESSION['error'] = 'Email hoặc password chưa đúng';
        header('Location: ' . BASE_URL_ADMIN . '?act=login');
        exit();
    }

    $_SESSION['user'] = $user;

    header('Location: ' . BASE_URL_ADMIN);
    exit();
}

function logout()
{
    if (!empty($_SESSION['user'])) {
        session_destroy();
    }

    header('Location: ' . BASE_URL_ADMIN . '?act=login');
    exit();
}
