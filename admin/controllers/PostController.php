<?php

function getAllPosts()
{
    $title = 'List post';
    $view = 'posts/index';
    $style = 'datatable';
    $script = 'datatable';
    $script2 = 'posts/script';
    $posts = listAllForPost();

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

function getPostById($id)
{
    $post = showOneForPost($id);

    if (empty($post)) {
        e404();
    }

    $title = 'Post Detail: ' . $post['title'];
    $view = 'posts/show';

    $tags = getTagsForPostId($id);

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

function createPost()
{
    $title = 'Create new post';
    $view = 'posts/create';
    $script = "tinymce";

    $categories = listAll('categories');
    $authors = listAll('authors');
    $tags = listAll('tags');

    if (!empty($_POST)) {
        $data = [
            "title" => $_POST['title'] ?? null,
            "excerpt" => $_POST['excerpt'] ?? null,
            "category_id" => $_POST['category_id'] ?? null,
            "author_id" => $_POST['author_id'] ?? null,
            "content" => $_POST['content'] ?? null,
            "is_trending" => $_POST['is_trending'] ?? 0,
            "status" => $_POST['status'] ?? STATUS_DRAFT,
            "img_thumbnail" =>  get_file_upload('img_thumbnail'),
            "img_cover" =>  get_file_upload('img_cover'),
        ];

        $errors = validatePost($data);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;

            header('Location: ' . BASE_URL_ADMIN . '?act=post-create');
            exit();
        }

        $imgThumbnail = $data['img_thumbnail'];
        if (is_array($imgThumbnail) && $imgThumbnail['size'] > 0) {
            $data['img_thumbnail'] = upload_file($imgThumbnail, 'uploads/posts/');
        }

        $imgCover = $data['img_cover'];
        if (is_array($imgCover) && $imgCover['size'] > 0) {
            $data['img_cover'] = upload_file($imgCover, 'uploads/posts/');
        }

        try {
            $GLOBALS['conn']->beginTransaction();

            $postId = insert_get_last_id('posts', $data);

            // Insert post_tag table
            if (!empty($_POST['tags'])) {
                foreach ($_POST['tags'] as $tagId) {
                    insert('post_tag', [
                        "post_id" => $postId,
                        "tag_id" => $tagId
                    ]);
                };
            }

            $GLOBALS['conn']->commit();
        } catch (\Exception $e) {
            $GLOBALS['conn']->rollBack();

            if (
                is_array($imgThumbnail)                                 // Là file 
                && !empty($data['img_thumbnail'])                       // Upload thành công
                && file_exists(PATH_UPLOAD . $data['img_thumbnail'])    // File vẫn còn tồn tại trên hệ thống
            ) {
                unlink(PATH_UPLOAD . $data['img_thumbnail']);
            }

            if (
                is_array($imgCover)                                 // Có upload mới
                && !empty($data['img_cover'])                       // Upload thành công
                && file_exists(PATH_UPLOAD . $data['img_cover'])    // File vẫn còn tồn tại trên hệ thống
            ) {
                unlink(PATH_UPLOAD . $data['img_cover']);
            }

            debug($e);
        }

        $_SESSION['success'] = "Thao tác thành công";

        header('Location: ' . BASE_URL_ADMIN . '?act=posts');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

function updatePostById($id)
{
    $post = showOne('posts', $id);

    if (empty($post)) {
        e404();
    }

    $title = 'Update post: ' . $post['title'];
    $view = 'posts/update';
    $script = 'tinymce';

    $categories = listAll('categories');
    $authors = listAll('authors');
    $tags = listAll('tags');

    $tagsForPost = getTagsForPostId($id);
    $tagIdsForPost = array_column($tagsForPost, 'id');

    if (!empty($_POST)) {
        $data = [
            "title" => $_POST['title'] ?? $post['title'],
            "excerpt" => $_POST['excerpt'] ?? $post['excerpt'],
            "content" => $_POST['content'] ?? $post['content'],
            "category_id" => $_POST['category_id'] ?? $post['category_id'],
            "author_id" => $_POST['author_id'] ?? $post['author_id'],
            "status" => $_POST['status'] ?? $post['status'],
            "is_trending" => $_POST['is_trending'] ?? $post['is_trending'],
            "updated_at" => date("Y-m-d H:i:s"),
            "img_thumbnail" =>  get_file_upload('img_thumbnail', $post['img_thumbnail']),
            "img_cover" =>  get_file_upload('img_cover', $post['img_cover']),
        ];

        $errors = validatePost($data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {
            $imgThumbnail = $data['img_thumbnail'];
            if (is_array($imgThumbnail) && $imgThumbnail['size'] > 0) {
                $data['img_thumbnail'] = upload_file($imgThumbnail, 'uploads/posts/');
            }

            $imgCover = $data['img_cover'];
            if (is_array($imgCover) && $imgCover['size'] > 0) {
                $data['img_cover'] = upload_file($imgCover, 'uploads/posts/');
            }

            try {
                $GLOBALS['conn']->beginTransaction();

                update('posts', $id, $data);

                // Delete post_tag
                deleteTagsByPostId($id);

                // Insert post_tag table
                if (!empty($_POST['tags'])) {
                    foreach ($_POST['tags'] as $tagId) {
                        insert('post_tag', [
                            "post_id" => $id,
                            "tag_id" => $tagId
                        ]);
                    };
                }

                $GLOBALS['conn']->commit();
            } catch (\Exception $e) {
                $GLOBALS['conn']->rollBack();

                if (
                    is_array($imgThumbnail)                                 // Là file 
                    && !empty($data['img_thumbnail'])                       // Upload thành công
                    && file_exists(PATH_UPLOAD . $data['img_thumbnail'])    // File vẫn còn tồn tại trên hệ thống
                ) {
                    unlink(PATH_UPLOAD . $data['img_thumbnail']);
                }

                if (
                    is_array($imgCover)                                 // Có upload mới
                    && !empty($data['img_cover'])                       // Upload thành công
                    && file_exists(PATH_UPLOAD . $data['img_cover'])    // File vẫn còn tồn tại trên hệ thống
                ) {
                    unlink(PATH_UPLOAD . $data['img_cover']);
                }

                debug($e);
            }

            if (
                is_array($imgThumbnail)                                 // Có upload mới
                && !empty($post['img_thumbnail'])                       // Có giá trị cũ
                && !empty($data['img_thumbnail'])                       // Upload thành công
                && file_exists(PATH_UPLOAD . $post['img_thumbnail'])    // File vẫn còn tồn tại trên hệ thống
            ) {
                unlink(PATH_UPLOAD . $post['img_thumbnail']);
            }

            if (
                is_array($imgCover)                                 // Có upload mới
                && !empty($post['img_cover'])                       // Có giá trị cũ
                && !empty($data['img_cover'])                       // Upload thành công
                && file_exists(PATH_UPLOAD . $post['img_cover'])    // File vẫn còn tồn tại trên hệ thống
            ) {
                unlink(PATH_UPLOAD . $post['img_cover']);
            }

            $_SESSION['success'] = "Thao tác thành công";
        }

        header('Location: ' . BASE_URL_ADMIN . "?act=post-update&id=$id");
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

function validatePost($data)
{
    $errors = [];

    // Title
    if (empty($data['title'])) {
        $errors[] = "Title must be required";
    } else if (strlen($data['title']) > 100) {
        $errors[] = 'Title maximum 100 characters';
    }

    // Excerpt
    if (empty($data['excerpt'])) {
        $errors[] = "Excerpt must be required";
    } else if (strlen($data['excerpt']) > 200) {
        $errors[] = 'Excerpt maximum 200 characters';
    }

    $imageType = ['image/png', 'image/jpg', 'image/jpeg'];
    // Image Thumbnail
    if (empty($data['img_thumbnail'])) {
        $errors[] = "Image thumbnail must be required";
    } else if (is_array($data['img_thumbnail']) && $data['img_thumbnail']["size"] > 0) {
        if ($data['img_thumbnail']["size"] > 2 * 1024 * 1024) {
            $errors[] = "Size image thumbnail < 2M.";
        } else if (!in_array($data['img_thumbnail']['type'], $imageType)) {
            $errors[] = "image thumbnail only accepts png, jpg, jpeg format files.";
        }
    }

    // Image Cover
    if (is_array($data['img_cover']) && $data['img_cover']["size"] > 0) {
        if ($data['img_cover']["size"] > 2 * 1024 * 1024) {
            $errors[] = "Size image cover < 2M.";
        } else if (!in_array($data['img_cover']['type'], $imageType)) {
            $errors[] = "image cover only accepts png, jpg, jpeg format files.";
        }
    }

    // Category
    if (empty($data['category_id'])) {
        $errors[] = "Category must be required";
    }

    // Author
    if (empty($data['author_id'])) {
        $errors[] = "Author must be required";
    }

    // Status
    if ($data['status'] === null) {
        $errors[] = 'Status must be required';
    } else if (!in_array($data['status'], [STATUS_DRAFT, STATUS_PUBLISHED])) {
        $errors[] = 'Status must be 0 or 1';
    }

    // Is Trending
    if ($data['is_trending'] === null) {
        $errors[] = 'Is trending must be required';
    } else if (!in_array($data['is_trending'], [0, 1])) {
        $errors[] = 'Is trending must be 0 or 1';
    }

    return $errors;
}

function deletePostById($id)
{
    $post = showOne('posts', $id);

    if (empty($post)) {
        e404();
    }

    try {
        $GLOBALS['conn']->beginTransaction();

        deleteTagsByPostId($id);

        delete2('posts', $id);

        $GLOBALS['conn']->commit();
    } catch (\Exception $e) {
        $GLOBALS['conn']->rollBack();

        debug($e);
    }


    if (
        !empty($post['img_thumbnail'])                       // Có giá trị cũ
        && file_exists(PATH_UPLOAD . $post['img_thumbnail']) // File vẫn còn tồn tại trên hệ thống
    ) {
        unlink(PATH_UPLOAD . $post['img_thumbnail']);
    }

    if (
        !empty($post['img_cover'])                       // Có giá trị cũ
        && file_exists(PATH_UPLOAD . $post['img_cover']) // File vẫn còn tồn tại trên hệ thống
    ) {
        unlink(PATH_UPLOAD . $post['img_cover']);
    }

    $_SESSION['success'] = "Thao tác thành công";
    header('Location: ' . BASE_URL_ADMIN . "?act=posts");
    exit();
};
