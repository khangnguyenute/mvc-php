<?php

function homeIndex()
{
    $view = "home";

    $postTopView = getPostTopView();
    $postTop6Latest = getPostTop6Latest($postTopView['id']);
    $postTop6Latest = array_chunk($postTop6Latest, 3);
    $postTop5Trending = getPostTop5Trending($postTopView['id']);

    require_once PATH_VIEW . 'layouts/master.php';
}
