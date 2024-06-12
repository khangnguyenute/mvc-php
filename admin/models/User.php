<?php

if (!function_exists('checkExistedEmail')) {
    function checkExistedEmail($tableName, $email)
    {
        try {
            $sql = "SELECT * FROM $tableName WHERE email=:email LIMIT 1";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":email", $email);

            $stmt->execute();
            $data = $stmt->fetch();
            return !empty($data);
        } catch (\Exception $e) {
            debug($e);
        }
    }
}


if (!function_exists('checkExistedEmailForUpdate')) {
    function checkExistedEmailForUpdate($tableName, $id, $email)
    {
        try {
            $sql = "SELECT * FROM $tableName WHERE email=:email AND id <> :id LIMIT 1";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":id", $id);

            $stmt->execute();
            $data = $stmt->fetch();
            return !empty($data);
        } catch (\Exception $e) {
            debug($e);
        }
    }
}
