<?php

function getAllAuthors()
{
    $title = 'List author';
    $view = 'authors/index';
    $style = 'datatable';
    $script = 'datatable';
    $script2 = 'authors/script';
    $authors = listAll('authors');

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

function getAuthorById($id)
{
    $author = showOne('authors', $id);

    if (empty($author)) {
        e404();
    }

    $title = 'author Detail: ' . $author['name'];
    $view = 'authors/show';

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

function createAuthor()
{
    $title = 'Create new author';
    $view = 'authors/create';

    if (!empty($_POST)) {
        $data = [
            "name" => $_POST['name'] ?? null,
            "avatar" =>  $_FILES['avatar'] ?? null
        ];

        $avatar = $data['avatar'];
        $errors = validateCreateAuthor($data);

        if (!empty($avatar) && $avatar['size'] > 0) {
            $data['avatar'] = upload_file($avatar, 'uploads/authors/');
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;

            header('Location: ' . BASE_URL_ADMIN . '?act=author-create');
            exit();
        }

        insert('authors', $data);
        $_SESSION['success'] = "Thao tác thành công";

        header('Location: ' . BASE_URL_ADMIN . '?act=authors');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

function validateCreateAuthor($data)
{
    // name - bắt buộc, không trùng
    // avatar - size < 2M, chỉ chấp nhận PNG, JPG, JPEG

    $errors = [];
    if (empty($data['name'])) {
        $errors[] = "Name must be required.";
    } else if (checkExistedName('authors', $data['name'])) {
        $errors[] = "Name already exists.";
    }

    if (!empty($data['avatar']) && $data['avatar']["size"] > 0) {
        $imageType = ['image/png', 'image/jpg', 'image/jpeg'];

        if ($data['avatar']["size"] > 2 * 1024 * 1024) {
            $errors[] = "Size avatar < 2M.";
        } else if (!in_array($data['avatar']['type'], $imageType)) {
            $errors[] = "Avatar only accepts png, jpg, jpeg format files.";
        }
    }

    return $errors;
}

function updateAuthorById($id)
{
    $author = showOne('authors', $id);

    if (empty($author)) {
        e404();
    }

    $title = 'Update author: ' . $author['name'];
    $view = 'authors/update';

    if (!empty($_POST)) {
        $data = [
            "name" => $_POST['name'] ?? $author['name'],
            "avatar" =>  $_FILES['avatar'] ??  $author['avatar']
        ];

        $errors = validateUpdateAuthor($id, $data);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {
            $avatar = $data['avatar'];
            if (!empty($avatar)  && is_array($avatar)  && $avatar['size'] > 0) {
                $data['avatar'] = upload_file($avatar, 'uploads/authors/');
            }

            update('authors', $id, $data);

            if (
                !empty($avatar)                                 // Có upload mới
                && !empty($author['avatar'])                    // Có giá trị cũ
                && !empty($data['avatar'])                      // Upload thành công
                && file_exists(PATH_UPLOAD . $author['avatar']) // File vẫn còn tồn tại trên hệ thống
            ) {
                unlink(PATH_UPLOAD . $author['avatar']);
            }

            $_SESSION['success'] = "Thao tác thành công";
        }

        header('Location: ' . BASE_URL_ADMIN . "?act=author-update&id=$id");
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

function validateUpdateAuthor($id, $data)
{
    // name - bắt buộc, không trùng
    // avatar - size < 2M, chỉ chấp nhận PNG, JPG, JPEG

    $errors = [];
    if (empty($data['name'])) {
        $errors[] = "Name must be required";
    } else if (checkExistedNameForUpdate('authors', $id, $data['name'])) {
        $errors[] = "Name already exists";
    }

    if (!empty($data['avatar']) && is_array($data['avatar']) && $data['avatar']["size"] > 0) {
        $imageType = ['image/png', 'image/jpg', 'image/jpeg'];

        if ($data['avatar']["size"] > 2 * 1024 * 1024) {
            $errors[] = "Size avatar < 2M.";
        } else if (!in_array($data['avatar']['type'], $imageType)) {
            $errors[] = "Avatar only accepts png, jpg, jpeg format files.";
        }
    }

    return $errors;
}

function deleteAuthorById($id)
{
    $author = showOne('authors', $id);

    if (empty($author)) {
        e404();
    }

    delete2('authors', $id);

    if (
        !empty($author['avatar'])                       // Có giá trị cũ
        && file_exists(PATH_UPLOAD . $author['avatar']) // File vẫn còn tồn tại trên hệ thống
    ) {
        unlink(PATH_UPLOAD . $author['avatar']);
    }

    $_SESSION['success'] = "Thao tác thành công";
    header('Location: ' . BASE_URL_ADMIN . "?act=authors");
    exit();
};
