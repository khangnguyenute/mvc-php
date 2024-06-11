<?php

function getAllUsers()
{
    try {
        $sql = 'SELECT * FROM users';
        $stmt = $GLOBALS['conn']->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    } catch (Exception $e) {
        debug($e);
    }
}

function getUserById($id)
{
    try {
        $sql = 'SELECT * FROM users WHERE id=:id';

        $stmt = $GLOBALS['conn']->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    } catch (Exception $e) {
        debug($e);
    }
}
