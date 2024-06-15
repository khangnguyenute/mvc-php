<?php

session_start();

// Require file trong commons
require_once '../commons/env.php';
require_once '../commons/helper.php';
require_once '../commons/connect-db.php';
require_once '../commons/model.php';


// Require file trong controllers và models
require_file(PATH_CONTROLLER_ADMIN);
require_file(PATH_MODEL_ADMIN);

// Điều hướng
$act = $_GET['act'] ?? '/';

match ($act) {
    '/' => dashboard(),

    // User
    'users' => getAllUsers(),
    'user-detail' => getUserById($_GET['id']),
    'user-create' => createUser(),
    'user-update' => updateUserById($_GET['id']),
    'user-delete' => deleteUserById($_GET['id']),

    // Post
    'posts' => getAllPosts(),
    'post-detail' => getPostById($_GET['id']),
    'post-create' => createPost(),
    'post-update' => updatePostById($_GET['id']),
    'post-delete' => deletePostById($_GET['id']),

    // Category
    'categories' => getAllCategories(),
    'category-detail' => getCategoryById($_GET['id']),
    'category-create' => createCategory(),
    'category-update' => updateCategoryById($_GET['id']),
    'category-delete' => deleteCategoryById($_GET['id']),

    // Tag
    'tags' => getAllTags(),
    'tag-detail' => getTagById($_GET['id']),
    'tag-create' => createTag(),
    'tag-update' => updateTagById($_GET['id']),
    'tag-delete' => deleteTagById($_GET['id']),

    // Author
    'authors' => getAllAuthors(),
    'author-detail' => getAuthorById($_GET['id']),
    'author-create' => createAuthor(),
    'author-update' => updateAuthorById($_GET['id']),
    'author-delete' => deleteAuthorById($_GET['id']),
};

require_once '../commons/disconnect-db.php';
