<?php

function settingShowForm()
{
    $title = 'List Settings';
    $view = 'settings/form';

    $settings = settingPluckKeyValue();

    require_once PATH_VIEW_ADMIN . '/layouts/master.php';
};

function settingSave()
{
    $settings = settingPluckKeyValue();

    foreach ($_POST as $key => $value) {
        if (isset($settings[$key])) {
            // update
            if ($settings[$key] != $value) {
                updateSettingByKey($key, [
                    'value' => $value
                ]);
            }
        } else {
            // insert
            insert('settings', [
                'key' => $key,
                'value' => $value,
            ]);
        };
    }

    $_SESSION['success'] = "Thao tác thành công";

    $fileSetting = PATH_UPLOAD . 'uploads/settings.json';
    if (file_exists($fileSetting)) {
        unlink($fileSetting);
    }

    header('Location: ' . BASE_URL_ADMIN . '?act=setting-form');
    exit();
};

function settingPluckKeyValue()
{
    $data = listAll('settings');

    $settings = [];
    foreach ($data as $item) {
        $settings[$item['key']] = $item['value'];
    }

    return $settings;
}
