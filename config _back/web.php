<?php



$params = require(__DIR__ . '/params.php');

Yii::$classMap['Method'] = '@app/libs/Method.php';

Yii::$classMap['UploadFile'] = '@app/libs/upload/UploadFile.php';



$config = [

    'id' => 'basic',

    'basePath' => dirname(__DIR__),

    'bootstrap' => ['log'],

    'modules' => [

        'content' => [

                    'class'=>'app\modules\content\ContentModule'

                ],

        'basic' => [

            'class'=>'app\modules\basic\BasicModule'

        ],



        'user' => [

            'class'=>'app\modules\user\UserModule'

        ],



        'cn' => [

            'class'=>'app\modules\cn\CnModule'

        ],



        'toefl' => [

            'class'=>'app\modules\toefl\ToeflModule'

        ],

        'order' => [

            'class'=>'app\modules\order\orderModule'

        ],

    ],

    'components' => [

        'request' => [

            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation

            'cookieValidationKey' => '3ggkbEhqR-n2ASj19BJSpbdvpmbO4NwK',

        ],

        'cache' => [

            'class' => 'yii\caching\MemCache',

            'servers'=> [['host'=>'127.0.0.1','port'=>'11211']]

        ],

//        'errorHandler' => [
//
//            'errorAction' => 'site/error',
//
//        ],

        'mailer' => [

            'class' => 'yii\swiftmailer\Mailer',

            'useFileTransport' =>false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件

            'transport' => [

                'class' => 'Swift_SmtpTransport',

                'host' => 'smtp.qq.com',  //每种邮箱的host配置不一样

                'username' => '2565225484@qq.com',

                'password' => 'pfglhtsistrneaif',

                'port' => '25',

                'encryption' => 'tls',



            ],

            'messageConfig'=>[

                'charset'=>'UTF-8',

                'from'=>['2565225484@qq.com'=>'小申托福在线']

            ],

        ],

        'urlManager' => [

             'enablePrettyUrl' => true,

             'showScriptName' => false,

             //'suffix' => '.html',

             'rules' => [

                 'listen/practise.html'=>'cn/heard',

                 'cn/login.html'=>'cn/login',

                 'listen.html'=>'cn/index',

                 'cn/heard/mo-kao.html'=>'cn/heard/mo-kao',

                 'cn/heard'=>'error',

                 'listening/<id:\d+>.html' => 'cn/heard/careful-listening',

                 'listening/<id:\d+>/<type:\d+>/<num:\d+>.html' => 'cn/heard/careful-listening',

                 'listen/question/<id:\d+>.html' => 'cn/heard/part-two',

                 'listen/question/<id:\d+>/<num:\d+>.html' => 'cn/heard/part-two',

                 'listen/word/<id:\d+>/<basic:\d+>/<page:\d+>.html' => 'cn/heard/base-one',

                 'listen/word/<basic:\d+>/<page:\d+>.html' => 'cn/heard/base-one',

                 'tpoExam.html' => 'cn/test',

                 'tpoExam/tpo/<id:\d+>.html' => 'cn/test/exam',

                 'tpoExam/result/<id:\d+>.html' => 'cn/test/test-result',

                 'user/exam/<type:\d+>/<page:\d+>/<donePage:\d+>/<undoenPage:\d+>.html' => 'cn/person/test-record',

                 'user/exam.html' => 'cn/person/test-record',

                 'user/listen.html' => 'cn/person/listen-record',

                 'user/collect.html' => 'cn/person/collect',

                 'user/manage.html' => 'cn/person/manage',

                 'toeflcourses.html' => 'cn/class/index',

                 'toeflcourses/<id:\d+>.html' => 'cn/class/details',

                 'teacher.html' => 'cn/teacher',

                 'toeflnews.html' => 'cn/news',

                 'toeflnews/<id:\d+>.html' => 'cn/news/details',

                 'toeflnews/<str:\w+>.html' => 'cn/news',

                 'speaking/<type>/<id:\d+>.html' => 'cn/spoken/details',

                 'speaking.html' => 'cn/spoken',

             ],

         ],



        'log' => [

            'traceLevel' => YII_DEBUG ? 3 : 0,

            'targets' => [

                [

                    'class' => 'yii\log\FileTarget',

                    'levels' => ['error', 'warning'],

                ],

            ],

        ],

        'db' => require(__DIR__ . '/db.php'),

    ],

    'params' => $params,

];



if (YII_ENV_DEV) {

    // configuration adjustments for 'dev' environment

    $config['bootstrap'][] = 'debug';

    $config['modules']['debug'] = 'yii\debug\Module';



    $config['bootstrap'][] = 'gii';

    $config['modules']['gii'] = 'yii\gii\Module';

}



return $config;



