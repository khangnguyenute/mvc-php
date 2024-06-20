<?php

function postDetail($id)
{
    $view = "post-detail";

    $mainPost = getPostById($id);
    $postTop6Latest = getPostTop6Latest($id);
    $postTop5Trending = getPostTop5Trending($id);

    require_once PATH_VIEW . 'layouts/master.php';
}

function postListByCategoryId($id, $page = 1, $perPage = 2)
{
    $view = 'post-by-category';
    $category = showOne('categories', $id);

    $posts = getPostByCategoryId($id, $page, $perPage);
    $postTop6Latest = getPostTop6Latest($id);
    $postTop5Trending = getPostTop5Trending($id);

    $totalPost = countAllPostByCategoryId($id)['total'];
    $totalPage = ceil($totalPost / $perPage);
    require_once PATH_VIEW . 'layouts/master.php';
}
