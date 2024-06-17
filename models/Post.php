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
                    p.title as title,
                    p.img_thumbnail as img_thumbnail,
                    p.updated_at as updated_at
                FROM posts as p 
                INNER JOIN categories as c ON c.id = p.category_id
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
                    p.author_id as author_id,
                    a.name as author_name,
                    p.title as title
                FROM posts as p 
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
