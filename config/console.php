<?php

$params = require __DIR__ . '/params.php';
$db = file_exists(__DIR__.'/db_local.php')?
  require __DIR__ . '/db_local.php':
  require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'container' =>  [
      'singletons'  =>  [
        \app\components\notifications\Notification::class  =>  [
          ['class'=>\app\components\notifications\NotificationEmail::class],
          [\yii\di\Instance::of('mail')]
        ],
        'mail'  =>  function(){
          return Yii::$app->mailer;
        },
        \app\components\logger\Logger::class=>['class'=>\app\components\logger\LoggerConsole::class]
      ],
      'definitions' =>  []
    ],
    'components' => [
        'cache' => [
          'class' => 'yii\caching\MemCache',
          'useMemcached' => true,
        ],
        'authManager' => [
          'class' => 'yii\rbac\DbManager'
        ],
        'activity' => ['class'=>\app\components\ActivityComponent::class],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'mailer' => [
          'class' => 'yii\swiftmailer\Mailer',
          // send all mails to a file by default. You have to set
          // 'useFileTransport' to false and configure a transport
          // for the mailer to send real emails.
          'useFileTransport' => false,
          'enableSwiftMailerLogging' => true,
          'transport' => [
            'class' =>  'Swift_SmtpTransport',
            'host'  =>  'smtp.yandex.ru',
            'username' => 'v4t4@yandex.ru',
            'password' => 'Retr_09',
            'port' => '587',
            'encryption' => 'tls'
          ]
        ],
        'db' => $db,
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
