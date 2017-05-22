<?php
$configs = [
    ROOT_DIR . '/app/core/config/web.php',
    ROOT_DIR . '/app/modules/backend/config/web.php',
    ROOT_DIR . '/app/modules/users/config/web.php',
    ROOT_DIR . '/app/modules/shop/config/web.php',
    ROOT_DIR . '/app/modules/comment/config/web.php',
    ROOT_DIR . '/app/modules/infosystems/config/web.php',
    ROOT_DIR . '/app/modules/pages/config/web.php',
    ROOT_DIR . '/app/modules/tag/config/web.php',
    ROOT_DIR . '/app/modules/form/config/web.php',
    ROOT_DIR . '/app/modules/menu/config/web.php',
    ROOT_DIR . '/app/modules/lists/config/web.php',
    ROOT_DIR . '/app/modules/tools/config/web.php',
    ROOT_DIR . '/app/modules/template/config/web.php',
    ROOT_DIR . '/app/modules/sites/config/web.php',
];

$result = [];
foreach ($configs as $config) {
    if (is_file($config)) {
        $result = array_merge_recursive($result, require $config);
    }
}

return $result;