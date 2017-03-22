<?php
$configs = [
    ROOT_DIR . '/app/config/web.php',
    ROOT_DIR . '/packagest/core/config/web.php',
    ROOT_DIR . '/packagest/backend/config/web.php',
    ROOT_DIR . '/packagest/user/config/web.php',
    ROOT_DIR . '/packagest/shop/config/web.php',
    ROOT_DIR . '/packagest/comment/config/web.php',
    ROOT_DIR . '/packagest/infosystem/config/web.php',
    ROOT_DIR . '/packagest/service/config/web.php',
    ROOT_DIR . '/packagest/page/config/web.php',
    ROOT_DIR . '/packagest/tag/config/web.php',
];

$result = [];
foreach ($configs as $config) {
    if (is_file($config)) {
        $result = array_merge_recursive($result, require $config);
    }
}

return $result;