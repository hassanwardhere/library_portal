<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitba8650b41fe8d8543c50ada364f2af28
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitba8650b41fe8d8543c50ada364f2af28::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitba8650b41fe8d8543c50ada364f2af28::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitba8650b41fe8d8543c50ada364f2af28::$classMap;

        }, null, ClassLoader::class);
    }
}
