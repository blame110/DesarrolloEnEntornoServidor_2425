<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd0d2ab95c771b8296bd0bd0900c3a111
{
    public static $files = array (
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pmpin\\Unidad3\\' => 14,
        ),
        'F' => 
        array (
            'FastRoute\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pmpin\\Unidad3\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd0d2ab95c771b8296bd0bd0900c3a111::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd0d2ab95c771b8296bd0bd0900c3a111::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd0d2ab95c771b8296bd0bd0900c3a111::$classMap;

        }, null, ClassLoader::class);
    }
}
