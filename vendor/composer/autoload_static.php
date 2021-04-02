<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8af3c7903dcb10bcc79e23a33105c8ce
{
    public static $files = array (
        '9b38cf48e83f5d8f60375221cd213eee' => __DIR__ . '/..' . '/phpstan/phpstan/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'salty\\Sw6PerformanceAnalysis\\' => 29,
        ),
        'K' => 
        array (
            'K10r\\Codestyle\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'salty\\Sw6PerformanceAnalysis\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'K10r\\Codestyle\\' => 
        array (
            0 => __DIR__ . '/..' . '/k10r/codestyle/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8af3c7903dcb10bcc79e23a33105c8ce::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8af3c7903dcb10bcc79e23a33105c8ce::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8af3c7903dcb10bcc79e23a33105c8ce::$classMap;

        }, null, ClassLoader::class);
    }
}
