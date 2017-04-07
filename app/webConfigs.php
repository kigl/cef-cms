<?php
$configs = [
    ROOT_DIR . '/app/config/web.php',
    ROOT_DIR . '/vendor/kigl/cef-core/config/web.php',
    ROOT_DIR . '/vendor/kigl/cef-module-backend/config/web.php',
    ROOT_DIR . '/vendor/kigl/cef-module-user/config/web.php',
    ROOT_DIR . '/vendor/kigl/cef-module-shop/config/web.php',
    ROOT_DIR . '/vendor/kigl/cef-module-comment/config/web.php',
    ROOT_DIR . '/vendor/kigl/cef-module-infosystem/config/web.php',
    ROOT_DIR . '/vendor/kigl/cef-module-service/config/web.php',
    ROOT_DIR . '/vendor/kigl/cef-module-page/config/web.php',
    ROOT_DIR . '/vendor/kigl/cef-module-tag/config/web.php',
    ROOT_DIR . '/vendor/kigl/cef-module-form/config/web.php',
];

$result = [];
foreach ($configs as $config) {
    if (is_file($config)) {
        $result = array_merge_recursive($result, require $config);
    }
}

return $result;