<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd61e63df6bf1d94d261054b49a2a5654
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'sendReservation\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'sendReservation\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd61e63df6bf1d94d261054b49a2a5654::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd61e63df6bf1d94d261054b49a2a5654::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd61e63df6bf1d94d261054b49a2a5654::$classMap;

        }, null, ClassLoader::class);
    }
}
