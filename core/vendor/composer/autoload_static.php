<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd08a2b6f5e41e256fb611c05532ca1a7
{
    public static $files = array (
        '2cffec82183ee1cea088009cef9a6fc3' => __DIR__ . '/..' . '/ezyang/htmlpurifier/library/HTMLPurifier.composer.php',
        '2c102faa651ef8ea5874edb585946bce' => __DIR__ . '/..' . '/swiftmailer/swiftmailer/lib/swift_required.php',
    );

    public static $prefixLengthsPsr4 = array (
        'y' => 
        array (
            'yii\\swiftmailer\\' => 16,
            'yii\\jui\\' => 8,
            'yii\\imagine\\' => 12,
            'yii\\gii\\' => 8,
            'yii\\faker\\' => 10,
            'yii\\debug\\' => 10,
            'yii\\composer\\' => 13,
            'yii\\codeception\\' => 16,
            'yii\\bootstrap\\' => 14,
            'yii\\' => 4,
            'yii2mod\\bxslider\\' => 17,
        ),
        'v' => 
        array (
            'vova07\\imperavi\\' => 16,
        ),
        'k' => 
        array (
            'kotchuprik\\sortable\\' => 20,
            'kartik\\touchspin\\' => 17,
            'kartik\\popover\\' => 15,
            'kartik\\plugins\\popover\\' => 23,
            'kartik\\money\\' => 13,
            'kartik\\grid\\' => 12,
            'kartik\\editable\\' => 16,
            'kartik\\dialog\\' => 14,
            'kartik\\base\\' => 12,
        ),
        'c' => 
        array (
            'conquer\\helpers\\' => 16,
            'conquer\\codemirror\\' => 19,
            'cebe\\markdown\\' => 14,
        ),
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'yii\\swiftmailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-swiftmailer',
        ),
        'yii\\jui\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-jui',
        ),
        'yii\\imagine\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-imagine',
        ),
        'yii\\gii\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-gii',
        ),
        'yii\\faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-faker',
        ),
        'yii\\debug\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-debug',
        ),
        'yii\\composer\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-composer',
        ),
        'yii\\codeception\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-codeception',
        ),
        'yii\\bootstrap\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-bootstrap',
        ),
        'yii\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2',
        ),
        'yii2mod\\bxslider\\' => 
        array (
            0 => __DIR__ . '/..' . '/yii2mod/yii2-bx-slider',
        ),
        'vova07\\imperavi\\' => 
        array (
            0 => __DIR__ . '/..' . '/vova07/yii2-imperavi-widget/src',
        ),
        'kotchuprik\\sortable\\' => 
        array (
            0 => __DIR__ . '/..' . '/kotchuprik/yii2-sortable-widgets',
        ),
        'kartik\\touchspin\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/yii2-widget-touchspin',
        ),
        'kartik\\popover\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/yii2-popover-x',
        ),
        'kartik\\plugins\\popover\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/bootstrap-popover-x',
        ),
        'kartik\\money\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/yii2-money',
        ),
        'kartik\\grid\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/yii2-grid',
        ),
        'kartik\\editable\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/yii2-editable',
        ),
        'kartik\\dialog\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/yii2-dialog',
        ),
        'kartik\\base\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/yii2-krajee-base',
        ),
        'conquer\\helpers\\' => 
        array (
            0 => __DIR__ . '/..' . '/conquer/helpers',
        ),
        'conquer\\codemirror\\' => 
        array (
            0 => __DIR__ . '/..' . '/conquer/codemirror',
        ),
        'cebe\\markdown\\' => 
        array (
            0 => __DIR__ . '/..' . '/cebe/markdown',
        ),
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
    );

    public static $prefixesPsr0 = array (
        'I' => 
        array (
            'Imagine' => 
            array (
                0 => __DIR__ . '/..' . '/imagine/imagine/lib',
            ),
        ),
        'H' => 
        array (
            'HTMLPurifier' => 
            array (
                0 => __DIR__ . '/..' . '/ezyang/htmlpurifier/library',
            ),
        ),
        'D' => 
        array (
            'Diff' => 
            array (
                0 => __DIR__ . '/..' . '/phpspec/php-diff/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd08a2b6f5e41e256fb611c05532ca1a7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd08a2b6f5e41e256fb611c05532ca1a7::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitd08a2b6f5e41e256fb611c05532ca1a7::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
