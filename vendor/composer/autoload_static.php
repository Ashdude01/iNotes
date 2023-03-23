<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit07e2e9ce6a6550a6b5031d3e2d4cf682
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit07e2e9ce6a6550a6b5031d3e2d4cf682::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit07e2e9ce6a6550a6b5031d3e2d4cf682::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit07e2e9ce6a6550a6b5031d3e2d4cf682::$classMap;

        }, null, ClassLoader::class);
    }
}