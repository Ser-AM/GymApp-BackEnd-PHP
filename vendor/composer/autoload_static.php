<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd5e1960c4a2d60845543a53c3b66a959
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Serj\\GymAppBack\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Serj\\GymAppBack\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd5e1960c4a2d60845543a53c3b66a959::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd5e1960c4a2d60845543a53c3b66a959::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd5e1960c4a2d60845543a53c3b66a959::$classMap;

        }, null, ClassLoader::class);
    }
}