<?php

function getAllCategories()
{
    $title = 'List Category';
    $view = 'categories/index';
    $style = 'datatable';
    $script = 'datatable';
    $script2 = 'categories/script';
    $categories = listAll('categories');

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

function getCategoryById($id)
{
    $category = showOne('categories', $id);

    if (empty($category)) {
        e404();
    }

    $title = 'Category Detail: ' . $category['name'];
    $view = 'categories/show';

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

function createCategory()
{
    $title = 'Create new category';
    $view = 'categories/create';

    if (!empty($_POST)) {
        $data = [
            "name" => $_POST['name'] ?? null
        ];


        $errors = validateCategoryCreate($data);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;

            header('Location: ' . BASE_URL_ADMIN . '?act=category-create');
            exit();
        }

        insert('categories', $data);
        $_SESSION['success'] = "Thao tác thành công";

        header('Location: ' . BASE_URL_ADMIN . '?act=categories');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

function validateCategoryCreate($data)
{
    $errors = [];
    if (empty($data['name'])) {
        $errors[] = "Name must be required";
    } else if (checkExistedName('categories', $data['name'])) {
        $errors[] = "Name already exists";
    }

    return $errors;
}

function updateCategoryById($id)
{
    $category = showOne('categories', $id);

    if (empty($category)) {
        e404();
    }

    $title = 'Update category: ' . $category['name'];
    $view = 'categories/update';

    if (!empty($_POST)) {
        $data = [
            "name" => $_POST['name'] ?? $category['name']
        ];


        $errors = validateCategoryUpdate($id, $data);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {
            update('categories', $id, $data);
            $_SESSION['success'] = "Thao tác thành công";
        }

        header('Location: ' . BASE_URL_ADMIN . "?act=category-update&id=$id");
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

function validateCategoryUpdate($id, $data)
{
    $errors = [];
    if (empty($data['name'])) {
        $errors[] = "Name must be required";
    } else if (checkExistedNameForUpdate('categories', $id, $data['name'])) {
        $errors[] = "Name already exists";
    }

    return $errors;
}

function deleteCategoryById($id)
{
    delete2('categories', $id);
    $_SESSION['success'] = "Thao tác thành công";
    header('Location: ' . BASE_URL_ADMIN . "?act=categories");
    exit();
};
