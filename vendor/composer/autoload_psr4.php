<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
    'think\\view\\driver\\' => array($vendorDir . '/topthink/think-view/src'),
    'think\\trace\\' => array($vendorDir . '/topthink/think-trace/src'),
    'think\\' => array($vendorDir . '/topthink/framework/src/think', $vendorDir . '/topthink/think-helper/src', $vendorDir . '/topthink/think-orm/src', $vendorDir . '/topthink/think-queue/src', $vendorDir . '/topthink/think-template/src'),
    'app\\' => array($baseDir . '/app'),
    'Symfony\\Polyfill\\Php80\\' => array($vendorDir . '/symfony/polyfill-php80'),
    'Symfony\\Polyfill\\Php72\\' => array($vendorDir . '/symfony/polyfill-php72'),
    'Symfony\\Polyfill\\Mbstring\\' => array($vendorDir . '/symfony/polyfill-mbstring'),
    'Symfony\\Contracts\\Translation\\' => array($vendorDir . '/symfony/translation-contracts'),
    'Symfony\\Component\\VarDumper\\' => array($vendorDir . '/symfony/var-dumper'),
    'Symfony\\Component\\Translation\\' => array($vendorDir . '/symfony/translation'),
    'Symfony\\Component\\Process\\' => array($vendorDir . '/symfony/process'),
    'Psr\\SimpleCache\\' => array($vendorDir . '/psr/simple-cache/src'),
    'Psr\\Log\\' => array($vendorDir . '/psr/log/Psr/Log'),
    'Psr\\Http\\Message\\' => array($vendorDir . '/psr/http-message/src'),
    'Psr\\Container\\' => array($vendorDir . '/psr/container/src'),
    'PHPMailer\\PHPMailer\\' => array($vendorDir . '/phpmailer/phpmailer/src'),
    'Carbon\\' => array($vendorDir . '/nesbot/carbon/src/Carbon'),
);
