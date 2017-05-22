<?php
$configs = [
    ROOT_DIR . '/app/core/config/console.php',
    ROOT_DIR . '/app/modules/backend/config/console.php',
    ROOT_DIR . '/app/modules/users/config/console.php',
    ROOT_DIR . '/app/modules/shop/config/console.php',
    ROOT_DIR . '/app/modules/comment/config/console.php',
    ROOT_DIR . '/app/modules/infosystems/config/console.php',
    ROOT_DIR . '/app/modules/pages/config/console.php',
    ROOT_DIR . '/app/modules/tag/config/console.php',
    ROOT_DIR . '/app/modules/form/config/console.php',
    ROOT_DIR . '/app/modules/menu/config/console.php',
    ROOT_DIR . '/app/modules/lists/config/console.php',
    ROOT_DIR . '/app/modules/sites/config/console.php',
];

$result = [];
foreach ($configs as $config) {
    if (is_file($config)) {
        $result = array_merge_recursive($result, require $config);
    }
}

return $result;