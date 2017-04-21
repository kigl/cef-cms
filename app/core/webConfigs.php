<?php
$configs = [
    ROOT_DIR . '/app/core/config/web.php',
    ROOT_DIR . '/app/modules/backend/config/web.php',
    ROOT_DIR . '/app/modules/user/config/web.php',
    ROOT_DIR . '/app/modules/shop/config/web.php',
    ROOT_DIR . '/app/modules/comment/config/web.php',
    ROOT_DIR . '/app/modules/infosystem/config/web.php',
    ROOT_DIR . '/app/modules/page/config/web.php',
    ROOT_DIR . '/app/modules/tag/config/web.php',
    ROOT_DIR . '/app/modules/form/config/web.php',
    ROOT_DIR . '/app/modules/menu/config/web.php',
    ROOT_DIR . '/app/modules/lists/config/web.php',
];

$result = [];
foreach ($configs as $config) {
    if (is_file($config)) {
        $result = array_merge_recursive($result, require $config);
    }
}

return $result;