<?php

function getAllUsers()
{
    $title = 'List User';
    $view = 'users/index';
    $style = 'datatable';
    $script = 'datatable';
    $script2 = 'users/script';
    $users = listAll('users');

    require_once PATH_VIEW_ADMIN . '/layouts/master.php';
};

function getUserById($id)
{
    $user = showOne('users', $id);

    if (empty($user)) {
        e404();
    }

    $title = 'User Detail - ' . $user['name'];
    $view = 'users/show';

    require_once PATH_VIEW_ADMIN . '/layouts/master.php';
};

function createUser()
{
    $title = 'Create User';
    $view = 'users/create';


    if (!empty($_POST)) {
        header('Location: ' . BASE_URL_ADMIN . '?act=users');
        exit();
        $data = [
            "name" => $_POST['name'] ?? null,
            "email" => $_POST['email'] ?? null,
            "password" => $_POST['password'] ?? null,
            "type" => $_POST['type'] ?? null,
        ];

        $errors = validateUserCreate($data);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;

            header('Location: ' . BASE_URL_ADMIN . '?act=user-create');
            exit();
        }

        insert('users', $data);
        $_SESSION['success'] = 'Thao tác thành công!';

        header('Location: ' . BASE_URL_ADMIN . '?act=users');
        exit();
    }

    require_once PATH_VIEW_ADMIN . '/layouts/master.php';
};

function validateUserCreate($data)
{
    $errors = [];

    // Name
    if (empty($data['name'])) {
        $errors[] = 'Name must be required';
    } else if (strlen($data['name']) > 50) {
        $errors[] = 'Name maximum 50 characters';
    }

    // Email
    if (empty($data['email'])) {
        $errors[] = 'Email must be required';
    } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
    } else if (checkExistedEmail('users', $data['email'])) {
        $errors[] = 'Email already exists';
    }

    // Password
    if (empty($data['password'])) {
        $errors[] = 'Password must be required';
    } else if (strlen($data['password']) < 8 || strlen($data['password']) > 20) {
        $errors[] = 'Password must be at least 8 characters';
        $errors[] = 'Password maximum 20 characters';
    }

    // Type
    if ($data['type'] === null) {
        $errors[] = 'Type must be required';
    } else if (!in_array($data['type'], [0, 1])) {
        $errors[] = 'Type must be 0 or 1';
    }

    return $errors;
}

function updateUserById($id)
{
    $user = showOne('users', $id);

    if (empty($user)) {
        e404();
    }

    $title = 'Update User: ' . $user['name'];
    $view = 'users/update';



    if (!empty($_POST)) {
        $data = [
            "name" => $_POST['name'] ?? $user['name'],
            "email" => $_POST['email'] ?? $user['email'],
            "password" => $_POST['password'] ?? $user['password'],
            "type" => $_POST['type'] ?? $user['type'],
        ];

        $errors = validateUserUpdate($id, $data);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {
            update('users', $id, $data);
            $_SESSION['success'] = 'Thao tác thành công!';
        }

        header('Location: ' . BASE_URL_ADMIN . '?act=user-update&id=' . $id);
        exit();
    }

    require_once PATH_VIEW_ADMIN . '/layouts/master.php';
};

function validateUserUpdate($id, $data)
{
    $errors = [];

    // Name
    if (empty($data['name'])) {
        $errors[] = 'Name must be required';
    } else if (strlen($data['name']) > 50) {
        $errors[] = 'Name maximum 50 characters';
    }

    // Email
    if (empty($data['email'])) {
        $errors[] = 'Email must be required';
    } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
    } else if (checkExistedEmailForUpdate('users', $id, $data['email'])) {
        $errors[] = 'Email already exists';
    }

    // Password
    if (empty($data['password'])) {
        $errors[] = 'Password must be required';
    } else if (strlen($data['password']) < 8 || strlen($data['password']) > 20) {
        $errors[] = 'Password must be at least 8 characters';
        $errors[] = 'Password maximum 20 characters';
    }

    // Type
    if ($data['type'] === null) {
        $errors[] = 'Type must be required';
    } else if (!in_array($data['type'], [0, 1])) {
        $errors[] = 'Type must be 0 or 1';
    }

    return $errors;
}

function deleteUserById($id)
{
    delete('users', $id);
    $_SESSION['success'] = 'Thao tác thành công!';

    header('Location: ' . BASE_URL_ADMIN . '?act=users');
    exit();
};
