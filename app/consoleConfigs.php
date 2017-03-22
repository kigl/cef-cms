<?php
$configs = [
    ROOT_DIR . '/app/config/console.php',
    //ROOT_DIR . '/packagest/core/config/console.php',
    /*ROOT_DIR . '/packagest/backend/config/console.php',
    ROOT_DIR . '/packagest/user/config/console.php',
    ROOT_DIR . '/packagest/shop/config/console.php',
    ROOT_DIR . '/packagest/comment/config/console.php',
    ROOT_DIR . '/packagest/infosystem/config/console.php',
    ROOT_DIR . '/packagest/service/config/console.php',
    ROOT_DIR . '/packagest/page/config/console.php',*/
    //ROOT_DIR . '/packagest/tag/config/console.php',
];

$result = [];
foreach ($configs as $config) {
    if (is_file($config)) {
        $result = array_merge_recursive($result, require $config);
    }
}

return $result;