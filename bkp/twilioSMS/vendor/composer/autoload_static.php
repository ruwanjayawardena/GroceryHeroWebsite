<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita56bbaf341f8b5d8f7103be768ee4650
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twilio\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twilio\\' => 
        array (
            0 => __DIR__ . '/..' . '/twilio/sdk/Twilio',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita56bbaf341f8b5d8f7103be768ee4650::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita56bbaf341f8b5d8f7103be768ee4650::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
