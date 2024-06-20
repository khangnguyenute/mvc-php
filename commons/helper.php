<?php

// Khai báo các hàm dùng Global
if (!function_exists(('require_file'))) {
    function require_file($pathFolder)
    {
        $files = array_diff(scandir($pathFolder), ['.', '..']);

        foreach ($files as $file) {
            require_once $pathFolder . $file;
        }
    }
}

if (!function_exists(('debug'))) {
    function debug($data)
    {
        echo '<pre>';
        print_r($data);
        die();
    }
}

if (!function_exists(('upload_file'))) {
    function upload_file($file, $pathFolderUpload)
    {
        $imagePath = $pathFolderUpload . time() . '-' . basename($file['name']);

        if (move_uploaded_file($file["tmp_name"], PATH_UPLOAD . $imagePath)) {
            return  $imagePath;
        }
        return null;
    }
}

if (!function_exists(('get_file_upload'))) {
    function get_file_upload($field, $default = null)
    {
        if (isset($_FILES[$field]) && $_FILES[$field]['size'] > 0) {
            return  $_FILES[$field];
        }

        return $default;
    }
}

if (!function_exists('middleware_auth_check')) {
    function middleware_auth_check($act)
    {
        if ($act === 'login') {
            if (!empty($_SESSION['user'])) {
                header('Location: ' . BASE_URL_ADMIN);
                exit();
            }
        } else if (empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL_ADMIN . '?act=login');
            exit();
        }
    }
}

if (!function_exists('get_settings')) {
    function get_settings()
    {
        $fileSetting = PATH_UPLOAD . 'uploads/settings.json';
        if (file_exists($fileSetting)) {
            $data = json_decode(file_get_contents($fileSetting), true);
        } else {
            $settings = listAll('settings');

            $keys = array_column($settings, 'key');
            $values = array_column($settings, 'value');

            $data = array_combine($keys, $values);
            file_put_contents(PATH_UPLOAD . 'uploads/settings.json', json_encode($data, JSON_PRETTY_PRINT));
        }
        return $data;
    }
}
