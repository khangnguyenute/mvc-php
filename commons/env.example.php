<?php

// Khai báo các biến môi trường
define('PATH_CONTROLLER', __DIR__ . '/../controllers/');
define('PATH_MODEL', __DIR__ . '/../models/');
define('PATH_VIEW', __DIR__ . '/../views/');

define('PATH_CONTROLLER_ADMIN', __DIR__ . '/../admin/controllers/');
define('PATH_MODEL_ADMIN', __DIR__ . '/../admin/models/');
define('PATH_VIEW_ADMIN', __DIR__ . '/../admin/views/');

define('BASE_URL', 'http://localhost/mvc-php/');
define('BASE_URL_ADMIN', 'http://localhost/mvc-php/admin/');

define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'mvc');

define('STATUS_DRAFT', 'draft');
define('STATUS_PUBLISHED', 'published');
