<?php

if (!function_exists('updateSettingByKey')) {
    function updateSettingByKey($key, $data = [])
    {
        try {
            $setParams = get_set_params($data);

            $sql = "UPDATE settings SET $setParams WHERE `key` = :key";

            $stmt = $GLOBALS['conn']->prepare($sql);
            foreach ($data as $fieldName => &$value) {
                $stmt->bindParam(":$fieldName", $value);
            }

            $stmt->bindParam(":key", $key);

            $stmt->execute();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}
