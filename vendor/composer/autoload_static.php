<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2bc615eb00f6e55f518decdc72dd6824
{
    public static $files = array (
        '317775e4223c5fa826e0e0b79e46999a' => __DIR__ . '/../..' . '/includes/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'w' => 
        array (
            'wP\\Plugin\\Boilerplate\\' => 22,
        ),
        'T' => 
        array (
            'Twilio\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'wP\\Plugin\\Boilerplate\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
        'Twilio\\' => 
        array (
            0 => __DIR__ . '/..' . '/twilio/sdk/src/Twilio',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2bc615eb00f6e55f518decdc72dd6824::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2bc615eb00f6e55f518decdc72dd6824::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2bc615eb00f6e55f518decdc72dd6824::$classMap;

        }, null, ClassLoader::class);
    }
}