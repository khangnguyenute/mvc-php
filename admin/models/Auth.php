<?php

if (!function_exists("getAdminByEmailAndPassword")) {
    function getAdminByEmailAndPassword($email, $password)
    {
        try {
            $sql = "SELECT * FROM users WHERE email=:email && password=:password && type = 1 LIMIT 1";
            $stmt = $GLOBALS["conn"]->prepare($sql);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);

            $stmt->execute();
            return $stmt->fetch();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}
