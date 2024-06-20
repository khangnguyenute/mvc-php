<?php

function getPostTopView()
{
    try {
        $status = STATUS_PUBLISHED;
        $sql = "SELECT 
                    p.id as id,
                    p.category_id as category_id,
                    c.name as category_name,
                    p.author_id as author_id,
                    a.name as author_name,
                    a.avatar as author_avatar,
                    p.title as title,
                    p.excerpt as excerpt,
                    p.img_thumbnail as img_thumbnail,
                    p.updated_at as updated_at
                FROM posts as p 
                INNER JOIN categories as c ON c.id = p.category_id
                INNER JOIN authors as a ON a.id = p.author_id 
                WHERE p.status='$status' 
                ORDER BY p.view_count DESC LIMIT 1";

        $stmt = $GLOBALS["conn"]->prepare($sql);

        $stmt->execute();
        return $stmt->fetch();
    } catch (\Exception $e) {
        debug($e->getMessage());
    }
};

function getPostTop6Latest($id)
{
    try {
        $status = STATUS_PUBLISHED;
        $sql = "SELECT 
                    p.id as id,
                    p.category_id as category_id,
                    c.name as category_name,
                    p.author_id as author_id,
                    a.name as author_name,
                    p.title as title,
                    p.img_thumbnail as img_thumbnail,
                    p.updated_at as updated_at
                FROM posts as p 
                INNER JOIN categories as c ON c.id = p.category_id
                INNER JOIN authors as a ON a.id = p.author_id 
                WHERE p.status='$status' AND p.id <> :id ORDER BY p.id DESC LIMIT 6";

        $stmt = $GLOBALS["conn"]->prepare($sql);
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll();
    } catch (\Exception $e) {
        debug($e->getMessage());
    }
};
function getPostTop5Trending($id)
{
    try {
        $status = STATUS_PUBLISHED;
        $sql = "SELECT 
                    p.id as id,
                    p.category_id as category_id,
                    c.name as category_name,
                    p.author_id as author_id,
                    a.name as author_name,
                    p.title as title,
                    p.updated_at as updated_at
                FROM posts as p 
                INNER JOIN categories as c ON c.id = p.category_id
                INNER JOIN authors as a ON a.id = p.author_id 
                WHERE p.status='$status' AND p.id <> :id AND p.is_trending = 1 ORDER BY p.id DESC LIMIT 5";

        $stmt = $GLOBALS["conn"]->prepare($sql);
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll();
    } catch (\Exception $e) {
        debug($e->getMessage());
    }
};

if (!function_exists('getPostById')) {
    function getPostById($id)
    {
        try {
            $sql = "SELECT 
                    p.id as id,
                    p.category_id as category_id,
                    c.name as category_name,
                    p.author_id as author_id,
                    a.name as author_name,
                    a.avatar as author_avatar,
                    p.title as title,
                    p.excerpt as excerpt,
                    p.content as content,
                    p.is_trending as is_trending,
                    p.status as status,
                    p.img_thumbnail as img_thumbnail,
                    p.img_cover as img_cover,
                    p.created_at as created_at,
                    p.updated_at as updated_at
                FROM posts as p 
                INNER JOIN categories as c ON c.id = p.category_id
                INNER JOIN authors as a ON a.id = p.author_id
                WHERE p.id=:id
                LIMIT 1
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":id", $id);

            $stmt->execute();
            return $stmt->fetch();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('getPostByCategoryId')) {
    function getPostByCategoryId($id, $page, $perPage)
    {
        try {
            $status = STATUS_PUBLISHED;
            $limit = $perPage;
            $offset = ($page - 1) * $perPage;

            $sql = "SELECT 
                    p.id as id,
                    p.category_id as category_id,
                    c.name as category_name,
                    p.author_id as author_id,
                    a.name as author_name,
                    a.avatar as author_avatar,
                    p.title as title,
                    p.excerpt as excerpt,
                    p.img_thumbnail as img_thumbnail,
                    p.updated_at as updated_at
                FROM posts as p 
                INNER JOIN categories as c ON c.id = p.category_id
                INNER JOIN authors as a ON a.id = p.author_id
                WHERE c.id=:id && p.status='$status'
                LIMIT $limit OFFSET $offset
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":id", $id, \PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('countAllPostByCategoryId')) {
    function countAllPostByCategoryId($id)
    {
        try {
            $status = STATUS_PUBLISHED;
            $sql = "SELECT 
                        count(*) total
                    FROM posts
                    WHERE category_id=:id && status='$status'";
            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":id", $id);

            $stmt->execute();
            return $stmt->fetch();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}
