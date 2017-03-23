<?php
$configs = [
    ROOT_DIR . '/app/config/console.php',
    ROOT_DIR . '/vendor/kigl/cef-core/config/console.php',
    ROOT_DIR . '/vendor/kigl/cef-module-backend/config/console.php',
    ROOT_DIR . '/vendor/kigl/cef-module-user/config/console.php',
    ROOT_DIR . '/vendor/kigl/cef-module-shop/config/console.php',
    ROOT_DIR . '/vendor/kigl/cef-module-comment/config/console.php',
    ROOT_DIR . '/vendor/kigl/cef-module-infosystem/config/console.php',
    ROOT_DIR . '/vendor/kigl/cef-module-service/config/console.php',
    ROOT_DIR . '/vendor/kigl/cef-module-page/config/console.php',
    ROOT_DIR . '/vendor/kigl/cef-module-tag/config/console.php',
];

$result = [];
foreach ($configs as $config) {
    if (is_file($config)) {
        $result = array_merge_recursive($result, require $config);
    }
}

return $result;