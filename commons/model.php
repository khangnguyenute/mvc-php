<?php

// CRUD -> Create/Read(Danh sách/ chi tiết)/Update/Delete

if (!function_exists('get_str_keys')) {
    function get_str_keys($data)
    {
        return implode(',', array_keys($data));
    }
}

if (!function_exists('get_virtual_params')) {
    function get_virtual_params($data)
    {
        return ':' . implode(',:', array_keys($data));
    }
}

if (!function_exists('get_set_params')) {
    function get_set_params($data)
    {
        $keys = array_keys($data);

        $tmp = [];
        foreach ($keys as $key) {
            $tmp[] = "$key=:$key";
        }
        return  implode(',', $tmp);
    }
}

if (!function_exists('insert')) {
    function insert($tableName, $data = [])
    {
        try {
            $strKeys = get_str_keys($data);
            $virtualParams = get_virtual_params($data);

            $sql = "INSERT INTO $tableName($strKeys) VALUES($virtualParams)";

            $stmt = $GLOBALS['conn']->prepare($sql);
            foreach ($data as $fieldName => &$value) {
                $stmt->bindParam(":$fieldName", $value);
            }

            $stmt->execute();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('insert_get_last_id')) {
    function insert_get_last_id($tableName, $data = [])
    {
        try {
            $strKeys = get_str_keys($data);
            $virtualParams = get_virtual_params($data);

            $sql = "INSERT INTO $tableName($strKeys) VALUES($virtualParams)";

            $stmt = $GLOBALS['conn']->prepare($sql);
            foreach ($data as $fieldName => &$value) {
                $stmt->bindParam(":$fieldName", $value);
            }

            $stmt->execute();
            return $GLOBALS['conn']->lastInsertId();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('listAll')) {
    function listAll($tableName)
    {
        try {
            $sql = "SELECT * FROM $tableName ORDER BY id DESC";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}


if (!function_exists('showOne')) {
    function showOne($tableName, $id)
    {
        try {
            $sql = "SELECT * FROM $tableName WHERE id=:id LIMIT 1";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":id", $id);

            $stmt->execute();
            return $stmt->fetch();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('update')) {
    function update($tableName, $id, $data = [])
    {
        try {
            $setParams = get_set_params($data);

            $sql = "UPDATE $tableName SET $setParams WHERE id = :id";

            $stmt = $GLOBALS['conn']->prepare($sql);
            foreach ($data as $fieldName => &$value) {
                $stmt->bindParam(":$fieldName", $value);
            }

            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('delete')) {
    function delete2($tableName, $id)
    {
        try {
            $sql = "DELETE FROM $tableName WHERE id = :id";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('e404')) {
    function e404()
    {
        echo '404 - Not found';
        die();
    }
}

if (!function_exists('checkExistedName')) {
    function checkExistedName($tableName, $name)
    {
        try {
            $sql = "SELECT * FROM $tableName WHERE name=:name LIMIT 1";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":name", $name);

            $stmt->execute();
            $data = $stmt->fetch();
            return !empty($data);
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('checkExistedNameForUpdate')) {
    function checkExistedNameForUpdate($tableName, $id, $name)
    {
        try {
            $sql = "SELECT * FROM $tableName WHERE name=:name AND id <> :id LIMIT 1";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":id", $id);

            $stmt->execute();
            $data = $stmt->fetch();
            return !empty($data);
        } catch (\Exception $e) {
            debug($e);
        }
    }
}
