<?php

function getAllTags()
{
    $title = 'List tag';
    $view = 'tags/index';
    $style = 'datatable';
    $script = 'datatable';
    $script2 = 'datatable';
    $tags = listAll('tags');

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

function getTagById($id)
{
    $tag = showOne('tags', $id);

    if (empty($tag)) {
        e404();
    }

    $title = 'tag Detail: ' . $tag['name'];
    $view = 'tags/show';

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

function createTag()
{
    $title = 'Create new tag';
    $view = 'tags/create';

    if (!empty($_POST)) {
        $data = [
            "name" => $_POST['name'] ?? null
        ];


        $errors = validateCreateTag($data);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;

            header('Location: ' . BASE_URL_ADMIN . '?act=tag-create');
            exit();
        }

        insert('tags', $data);
        $_SESSION['success'] = "Thao tác thành công";

        header('Location: ' . BASE_URL_ADMIN . '?act=tags');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

function validateCreateTag($data)
{
    $errors = [];
    if (empty($data['name'])) {
        $errors[] = "Name must be required";
    } else if (checkExistedName('tags', $data['name'])) {
        $errors[] = "Name already exists";
    }

    return $errors;
}

function updateTagById($id)
{
    $tag = showOne('tags', $id);

    if (empty($tag)) {
        e404();
    }

    $title = 'Update tag: ' . $tag['name'];
    $view = 'tags/update';

    if (!empty($_POST)) {
        $data = [
            "name" => $_POST['name'] ?? $tag['name']
        ];


        $errors = validateUpdateTag($id, $data);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {
            update('tags', $id, $data);
            $_SESSION['success'] = "Thao tác thành công";
        }

        header('Location: ' . BASE_URL_ADMIN . "?act=tag-update&id=$id");
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

function validateUpdateTag($id, $data)
{
    $errors = [];
    if (empty($data['name'])) {
        $errors[] = "Name must be required";
    } else if (checkExistedNameForUpdate('tags', $id, $data['name'])) {
        $errors[] = "Name already exists";
    }

    return $errors;
}

function deleteTagById($id)
{
    delete('tags', $id);
    $_SESSION['success'] = "Thao tác thành công";
    header('Location: ' . BASE_URL_ADMIN . "?act=tags");
    exit();
};
