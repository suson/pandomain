<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcbe9a0a0d7ec6d5dee679d5c0a5e9f33
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Dj\\' => 3,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Dj\\' => 
        array (
            0 => __DIR__ . '/..' . '/aileshe/upload/src/Upload',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcbe9a0a0d7ec6d5dee679d5c0a5e9f33::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcbe9a0a0d7ec6d5dee679d5c0a5e9f33::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}