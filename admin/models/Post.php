<?php

if (!function_exists('listAllForPost')) {
    function listAllForPost()
    {
        try {
            $sql = "
                SELECT 
                    p.id as id,
                    p.category_id as category_id,
                    c.name as category_name,
                    p.author_id as author_id,
                    a.name as author_name,
                    a.avatar as author_avatar,
                    p.title as title,
                    p.excerpt as excerpt,
                    p.is_trending as is_trending,
                    p.status as status,
                    p.img_thumbnail as img_thumbnail,
                    p.img_cover as img_cover,
                    p.created_at as created_at,
                    p.updated_at as updated_at
                FROM posts as p 
                INNER JOIN categories as c ON c.id = p.category_id
                INNER JOIN authors as a ON a.id = p.author_id
                ORDER BY p.id DESC
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('showOneForPost')) {
    function showOneForPost($id)
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

if (!function_exists('getTagsForPostId')) {
    function getTagsForPostId($id)
    {
        try {
            $sql = "
                SELECT 
                    t.id as id,
                    t.name as name
                FROM tags as t 
                INNER JOIN post_tag as pt ON pt.tag_id = t.id
                WHERE pt.post_id=:post_id
            ";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(':post_id', $id);

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('deleteTagsByPostId')) {
    function deleteTagsByPostId($id)
    {
        try {
            $sql = "DELETE FROM post_tag WHERE post_id=:post_id";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(':post_id', $id);

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}
