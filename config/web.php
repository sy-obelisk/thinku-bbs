<?php$params = require(__DIR__ . '/params.php');Yii::$classMap['Method'] = '@app/libs/Method.php';Yii::$classMap['UploadFile'] = '@app/libs/upload/UploadFile.php';$config = [    'id' => 'basic',    'basePath' => dirname(__DIR__),    'bootstrap' => ['log'],    'modules' => [        'user' => [            'class' => 'app\modules\user\UserModule'        ],        'cn' => [            'class' => 'app\modules\cn\CnModule'        ],//        'admin' => [//            'class'=>'app\modules\admin\AdminModule'//        ],        'content' => [            'class' => 'app\modules\content\ContentModule'        ],        'basic' => [            'class' => 'app\modules\basic\BasicModule'        ],    ],    'components' => [        'request' => [            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation            'cookieValidationKey' => '3ggkbEhqR-n2ASj19BJSpbdvpmbO4NwK',        ],//        'cache' => [//            'class' => 'yii\caching\MemCache',//            'servers'=> [['host'=>'127.0.0.1','port'=>'11211']]//        ],        'errorHandler' => [            'errorAction' => 'site/error',        ],        'mailer' => [            'class' => 'yii\swiftmailer\Mailer',            'useFileTransport' =>false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件            'transport' => [                'class' => 'Swift_SmtpTransport',                'host' => 'smtp.exmail.qq.com',  //每种邮箱的host配置不一样                'username' => 'thinkwithu.s@thinkwithu.com',                'password' => 'Thinku3052018',                'port' => '465',                'encryption' => 'ssl',            ],            'messageConfig'=>[                'charset'=>'UTF-8',                'from'=>['thinkwithu.s@thinkwithu.com'=>'申友论坛']            ],        ],        'urlManager' => [            'enablePrettyUrl' => true,            'showScriptName' => false,            //'suffix' => '.html',            'rules' => [                '' => 'cn/index/index',// 首页                'index.html' => 'cn/index/index',// 首页                'details/<id:\d+>.html' => 'cn/article/details',// 文章详情                'details/<id:\d+>/<page:\d+>.html' => 'cn/article/details',// 文章详情                'new-article.html' => 'cn/article/new',// fatie                'login.html' => 'cn/login/login',// 登录                'register.html' => 'cn/login/register',// 注册                'findKey.html' => 'cn/login/find-key',// 找回密码                'person/<page:\d+>.html' => 'cn/person/index',// 个人中心                'collection/<page:\d+>.html' => 'cn/person/collect',// 收藏                'question/<page:\d+>.html' => 'cn/person/question',// 收藏                'message-board/<page:\d+>.html' => 'cn/person/leave',// 留言板                'share.html' => 'cn/person/share',// 分享                'info.html' => 'cn/person/info',// 系统消息                'article/<page:\d+>.html' => 'cn/person/article',// 文章                'change-image.html' => 'cn/person/head',// 换头像                'integral/<page:\d+>.html' => 'cn/person/integral',// 积分                'search.html' => 'cn/search/index',// 搜索                'image.html' => 'cn/login/verify-code',// 积分                'question.html' => 'cn/index/question',// 提问列表页            ],        ],        'log' => [            'traceLevel' => YII_DEBUG ? 3 : 0,            'targets' => [                [                    'class' => 'yii\log\FileTarget',                    'levels' => ['error', 'warning'],                ],            ],        ],        'db' => require(__DIR__ . '/db.php'),    ],    'params' => $params,];if (YII_ENV_DEV) {    // configuration adjustments for 'dev' environment    $config['bootstrap'][] = 'debug';    $config['modules']['debug'] = 'yii\debug\Module';    $config['bootstrap'][] = 'gii';    $config['modules']['gii'] = 'yii\gii\Module';}return $config;?>