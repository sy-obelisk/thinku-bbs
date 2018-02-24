<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use app\libs\Pager;

use yii;
use app\libs\Sms;
use yii\web\Controller;
use app\modules\cn\models\User;
use app\modules\cn\models\News;
use app\modules\cn\models\Login;
use app\modules\cn\models\Content;
use app\modules\cn\models\Collect;
use app\modules\cn\models\Category;
use app\modules\cn\models\DailyTask;
use app\modules\cn\models\UserExtend;
use app\modules\cn\models\UserDiscuss;
use app\modules\content\models\ExtendData;
use app\modules\content\models\ContentExtend;
use app\modules\content\models\CategoryExtend;
use app\modules\content\models\CategoryContent;

class ApiController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * 短信接口
     */
    public function actionPhoneCode()
    {
        $session = Yii::$app->session;
        $sms = new Sms();
        $phoneNum = Yii::$app->request->post('phoneNum');
        if (!empty($phoneNum)) {
            $phoneCode = mt_rand(100000, 999999);
            $session->set($phoneNum . 'phoneCode', $phoneCode);
            $session->set('phoneTime', time());
            $content = '【申友论坛】验证码：' . $phoneCode . '（10分钟有效），您正在通过申友论坛网免费会员！';
            $sms->send($phoneNum, $content, $ext = '', $stime = '', $rrid = '');
            $res['code'] = 0;
            $res['message'] = '短信发送成功！';
        } else {
            $res['code'] = 1;
            $res['message'] = '发送失败!手机号码为空！';
        }
        die(json_encode($res));
    }

    /**
     * 发送邮件
     */
    public function actionSendMail()
    {
        $session = Yii::$app->session;
        $emailCode = mt_rand(100000, 999999);
        $email = Yii::$app->request->post('email');
        $session->set($email . 'phoneCode', $emailCode);
        $session->set('phoneTime', time());
        $mail = Yii::$app->mailer->compose();
        $mail->setTo($email);
        $mail->setSubject("【申友论坛】邮件验证码");
        $mail->setHtmlBody('
            <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
            <div style="width: 900px;margin: 0 auto;margin-bottom: 10px">
                 <img src="http://test.toeflonline.cn/cn/images/TF_logo.png" alt="logo">
            </div>
            <div style="width: 850px;border: 1px #dcdcdc solid;margin: 0 auto;overflow: hidden">
                 <p style="font-weight: bold;font-size: 18px;margin-left: 20px;color: #34388e;font-family: 微软雅黑;">亲爱的用户 ：</p>
                <span style="margin-left: 20px;font-family: 微软雅黑;">
            你好！你正在通过邮箱免费注册名校留学论坛，网址<a href="http://www.thinkwithu.com">www.thinkwithu.com</a>。你的验证码为：【<span style="color:#ff913e;">' . $emailCode . '</span>】。（有效期为：此邮件发出后48小时）
                </span>
                </br>
                <p style="margin-left: 20px;font-family: 微软雅黑;">
                添加微信公众号：<span style="color:green;font-weight:bold">申友留学</span>，获取留学最新信息~
                </p>
                <p style="margin-left: 20px;font-family: 微软雅黑;">
                            <span style="font-weight:bold">注：</span>有问题请咨询申友留学微信小助手：小小申（thinkuxxs）；
想要快速获取留学资讯，请添加好友，详细了解留学上的细节~
                </p>
            <div style="width: 100%;background: #e8e8e8;padding:5px 20px;font-size:12px;box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;margin-top: 30px;color: #808080;font-family: 微软雅黑;">
            温馨提示：请你注意保护你的邮箱，避免邮件被他人盗用哟！
            </div>
            </div>
            <div style="font-size: 12px;width: 800px;margin: 0 auto;text-align: right;color: #808080;">
        </div>
        '

        );    //发布可以带html标签的文本
        if ($mail->send()) {
            $res['code'] = 0;
            $res['message'] = '邮件发送成功！';
        } else {
            $res['code'] = 1;
            $res['message'] = '邮件发送失败！';
        }
        die(json_encode($res));
    }

    /**
     * 注册
     */
    public function actionRegister()
    {
        $login = new Login();
        $registerStr = Yii::$app->request->post('registerStr');//电话或邮箱
        $pass = Yii::$app->request->post('pass');
        $code = Yii::$app->request->post('code');
        $type = Yii::$app->request->post('type');
        $userName = Yii::$app->request->post('userName', '');
        if ($userName == '') {
            $userName = 'LX' . time();
        }
        $checkTime = $login->checkTime();
        if ($checkTime) {
            $checkCode = $login->checkCode($registerStr, $code);
            if ($checkCode) {
                // 验证用户名，邮箱，电话是否存在
                $checkUserInfo = $login->checkUserInfo($registerStr, $type, $userName);
                if ($checkUserInfo) {
                    die(json_encode($checkUserInfo));
                }
                if ($type == 1) {
                    $login->phone = $registerStr;
                } else {
                    $login->email = $registerStr;
                }
                $login->userPass = md5(md5($pass) . 'LXLT');
                $login->createTime = time();
                $login->userName = $userName;
                $re = $login->save();
                if ($re) {
                    $model = new News();
                    $model->news = '终于等到你，欢迎成为留学论坛的一员';
                    $model->userId = $login->primaryKey;
                    $model->status = 1;
                    $model->type = 1;
                    $model->createTime = time();
                    $model->sendId = 1;
                    $model->save();
                    $res['code'] = 0;
                    $res['message'] = '注册成功';
                    unset($_SESSION[$registerStr . 'phoneCode']);
                } else {
                    $res['code'] = 1;
                    $res['message'] = '注册失败，请重试';
                    $res['type'] = '3';
                }
            } else {
                $res['code'] = 1;
                $res['message'] = '验证码错误';
                $res['type'] = '1';
            }
        } else {
            $res['code'] = 1;
            $res['message'] = '验证码过期';
            $res['type'] = '1';
        }
        die(json_encode($res));
    }

    /**
     * 登录
     */
    public function actionLoginIn()
    {
        header('Content-Type:text/html;charset=utf-8');
        $apps = Yii::$app->request;
        $session = Yii::$app->session;
        $logins = new User();
        if ($apps->isPost) {
            $userName = $apps->post('userName');
            $verifyCode = $apps->post('verifyCode');
            $code = $session->get('verifyCode');
            if ($code != strtolower($verifyCode)) {
                $res['code'] = 1;
                $res['message'] = '验证码错误';
                die(json_encode($res));
            }
            $userPass = md5(md5($apps->post('userPass')) . 'LXLT');
            $where = "where (phone='" . $userName . "' or email='" . $userName . "') and userPass='" . $userPass . "'";
            $loginsdata = Yii::$app->db->createCommand('select id,nickname,userName,phone,email,image,integral,level from {{%user}}' . $where)->queryOne();
            if (!empty($loginsdata['id'])) {
                $session->set('userId', $loginsdata['id']);
                $session->set('userData', $loginsdata);
                $session->set('integral', $loginsdata['integral']);
                if ($loginsdata['image'] == null) {
                    $loginsdata['image'] = '';
                }
                $res['code'] = 0;
                $res['url'] = (Yii::$app->session->get('url'))?Yii::$app->session->get('url'):'/index.html';
                unset($_SESSION['url']);
                $res['message'] = '登录成功';
            } else {
                $res['code'] = 1;
                $res['message'] = '用户名或密码错误';
            }
        } else {
            $res['code'] = 1;
            $res['message'] = '请填写登录信息';
        }
        die(json_encode($res));
    }

    /**
     * 快速登录
     */
    public function actionMessageLogin()
    {
        header('Content-Type:text/html;charset=utf-8');
        $apps = Yii::$app->request;
        $session = Yii::$app->session;
        $login = new Login();
        if ($apps->isPost) {
            $registerStr = $apps->post('registerStr');//电话或邮箱
            $code = Yii::$app->request->post('code');
            $type = 1;
            $checkTime = $login->checkTime();
            if ($checkTime) {
                $checkCode = $login->checkCode($registerStr, $code);
                if ($checkCode) {
                    $loginsdata = Yii::$app->db->createCommand("select id,nickname,userName,phone,email,image,integral,level from {{%user}} where phone='$registerStr'")->queryOne();
                    if (!$loginsdata) {
                        $login->phone = $registerStr;
                        $login->userPass = '';
                        $login->createTime = time();
                        $login->userName = 'LX' . time();
                        $re = $login->save();
                        if ($re) {
                            $model = new News();
                            $model->news = '终于等到你，欢迎成为留学论坛的一员';
                            $model->userId = $login->primaryKey;
                            $model->status = 1;
                            $model->type = 1;
                            $model->createTime = time();
                            $model->sendId = 1;
                            $model->save();
                        } else {
                            $res['code'] = 1;
                            $res['message'] = '登录失败，请重试';
                            die(json_encode($res));
                        }
                    }
                    $session->set('userId', $loginsdata['id']);
                    $session->set('userData', $loginsdata);
                    $session->set('integral', $loginsdata['integral']);
                    if ($loginsdata['image'] == null) {
                        $loginsdata['image'] = '';
                    }
                    $res['code'] = 0;
                    $res['url'] = (Yii::$app->session->get('url'))?Yii::$app->session->get('url'):'/index.html';
                    $res['message'] = '登录成功';
                    die(json_encode($res));
                } else {
                    $res['code'] = 1;
                    $res['message'] = '验证码错误';
                    die(json_encode($res));
                }
            } else {
                $res['code'] = 1;
                $res['message'] = '验证码过期';
                die(json_encode($res));
            }
        }
    }

    /**
     * 注销账户
     * @return string
     * */
    public function actionLoginOut()
    {
        $session = Yii::$app->session;
        $session->remove('userData');
        $session->remove('userId');
        die(json_encode(['code' => 0]));
    }

    /**
     * ajax获取内容列表，验证
     */
    public function actionGetList()
    {
        $first = Yii::$app->request->post('first');
        $second = Yii::$app->request->post('second', '');
        $third = Yii::$app->request->post('third', '');
        $page = Yii::$app->request->post('page', 1);
        $pageSize = Yii::$app->request->post('pageSize', 15);
        $model = new Content();
        $data = $model->getList($first, $second, $third, $pageSize, $page);
        $page=$data['page'];
        $data=$data['list'];
        die(json_encode(['data'=>$data,'page'=>$page, 'code' => 0]));
    }

    /**
     * 下载文件
     */
    public function actionDownload()
    {

        //根据内容的id，查找文件的地址
        // 再判断下载

        $integral = Yii::$app->session->get('integral', '');
        if ($integral < 10) {
            echo '<script>alert("您的等级太低，努力升级吧，少年！")</script>';
            die;
        }
        $id = Yii::$app->request->get('id', '');
        $model = new Content();
        $data = $model->getClass(['fields' => 'url', 'where' => "c.id=$id"]);
        $f = 'http://bbs.com' . $data[0]['url'];
        $n = strrpos($f, '/') + 1;
        $fileName = substr($f, $n);
        $file = fopen($f, "r");
        if (!$file) {
            echo "文件找不到";
        } else {
            header("Content-type:application/octet-stream");    //输入文件类型
            header("Accept-Ranges:bytes");
            Header("Content-Disposition: attachment; filename=" . $fileName);
            ob_clean();
            flush();
            while (!feof($file)) {
                echo fread($file, 50000);
            }
            fclose($file);
        }

    }

    /**
     * 举报、留言，已验证
     */
    public function actionReport()
    {
        $reData['contentId'] = Yii::$app->request->post('contentId');
        $reData['description'] = Yii::$app->request->post('description');
        $reData['reportType'] = Yii::$app->request->post('reportType');
        $reData['description'] = htmlspecialchars($reData['description']);
        $reData['createTime'] = time();
        $reData['status'] = 0;// 0表示未处理，1表示属实，2表示不属实
        $session = Yii::$app->session;
        $reData['userId'] = $session->get('userId');
        if (!$reData['userId']) {
            $data['code'] = 2;
            $data['message'] = '未登录';
            die(json_encode($data));
        }
        $re = Yii::$app->db->createCommand()->insert("{{%report}}", $reData)->execute();
        if ($re) {
            $data['code'] = 0;
            $data['message'] = '发表成功';
        } else {
            $data['code'] = 1;
            $data['message'] = '发表失败';
        }
        die(json_encode($data));
    }

    /**
     * 签到,已验证
     */
    public function actionSignIn()
    {
        $userId = Yii::$app->session->get('userId');
        if (!$userId) {
            $data['code'] = 2;
            $data['message'] = '未登录';
        }
        $time = date("Y-m-d");
        $daily = new DailyTask();
        $task = $daily->todayTask(" where userId=" . $userId . " and time=" . $time);// 查看数据是否存在
        if ($task) {
            $signIn = $daily->todayTask(" where userId=" . $userId . " and time=" . $time . " and signIn=1");// 查看数据是否存在
            if ($signIn) {
                $data['code'] = 1;
                $data['message'] = '今日已经签到，不能重复签到';
                die(json_encode($data));
            } else {
                $re = DailyTask::updateAll(['signIn' => 1], "id=" . $signIn['id']);
            }
        } else {
            $data['time'] = date("Y-m-d");
            $data['userId'] = $userId;
            $data['signIn'] = 1;
            $re = Yii::$app->db->createCommand()->insert("{{%dailyTask}}", $data)->execute();
        }
        if ($re) {
            $user = new User();
            $user->integral($userId, 2, '论坛签到',1);
            $re['code'] = 0;
            $re['message'] = '签到成功';
            die(json_encode($re));
        } else {
            $re['code'] = 1;
            $re['message'] = '失败';
            die(json_encode($re));
        }
    }

    /**
     * 收藏，已验证
     */
    public function actionCollection()
    {
        $userId = Yii::$app->session->get('userId');
        $id = Yii::$app->request->post('id');
        if (!$userId) {
            $data['code'] = 2;
            $data['message'] = '未登录';
            die(json_encode($data));
        }
        $collect = new Collect();
        $status = $collect->IsCollection($id);
        if ($status) {
            $data['code'] = 1;
            $data['message'] = '已收藏，不能重复收藏';
            die(json_encode($data));
        }
        $re = $collect->Collection($id);
        if ($re) {
            $user = new User();
            $user->integral($userId, 1, '收藏文章',1);
            $data['code'] = 0;
            $data['message'] = '收藏成功';
            die(json_encode($data));
        } else {
            $data['code'] = 1;
            $data['message'] = '收藏失败';
            die(json_encode($data));
        }

    }

    /**
     * 评论,已验证
     */
    public function actionDiscuss()
    {
        $userId = Yii::$app->session->get('userId');
        $data['userId'] = $userId;
        $data['contentId'] = Yii::$app->request->post('id');// 帖子内容的id
        $data['pid'] = Yii::$app->request->post('pid');// 用户评论的id，直接评论文章的话为0
        $data['comment'] = Yii::$app->request->post('comment'); // 评论内容
        if (!$userId) {
            $data['code'] = 2;
            $data['message'] = '未登录';
            die(json_encode($data));
        }
        $re = Yii::$app->db->createCommand()->insert("{{%user_discuss}}", $data)->execute();
        if ($re) {
            $user = new User();
            $user->integral($userId, 3, '评论获取积分',1);
            $res['code'] = 0;
            $res['message'] = '点赞成功，积分+3';
            die(json_encode($res));
        } else {
            $res['code'] = 1;
            $res['message'] = '点赞失败，请重试';
            die(json_encode($res));
        }

    }

    /**
     * 点赞，文章点赞，评论点赞，添加积分，已验证
     */
    public function actionLike()
    {
        $userId = Yii::$app->session->get('userId');
        $post['contentId'] = Yii::$app->request->post('id');// 帖子内容的id,评论的id
        $post['type'] = Yii::$app->request->post('type');// 1为文章，2为评论
        $post['status'] = Yii::$app->request->post('status');// 1赞，2或者踩
        $post['userId'] = $userId;
        $post['createTime'] = time();
        if (!$userId) {
            $data['code'] = 2;
            $data['message'] = '未登录';
            die(json_encode($data));
        }
        $like = Yii::$app->db->createCommand("select id from {{%user_like}} where contentId=" . $post['contentId'] . " and type=" . $post['type'])->queryOne();
        if ($like) {
            $data['code'] = 1;
            $data['message'] = '不能重复评价';
            die(json_encode($data));
        }
        Yii::$app->db->createCommand()->insert("{{%user_like}}", $post)->execute();
        if ($post['type'] == 1) {
            $content = new Content();
            $re = $content->like($userId,$post['contentId'], $post['status']);
        } else {
            $u = new UserDiscuss();
            $re = $u->like($userId,$post['contentId'], $post['status']);
        }
        die(json_encode($re));
    }

    /**
     * 发帖时获取分类
     */
    public function actionPostCate()
    {
        $id = Yii::$app->request->post('id');// 帖子内容的id,评论的id
        // 如果为留学的话，取分类的方式不同
        $pid = Yii::$app->db->createCommand("select id,pid From {{%category}} where id=$id ")->queryAll();
        $cate = new Category();
        $data = $cate->getSonCate($id);
        if ($data == false) {
            $re['code'] = 1;
            $re['message'] = '请求参数错误';
        }
        die(json_encode($data));
    }

    /**
     * 发帖
     */
    public function actionNewArticle()
    {
        if ($_POST) {
            $user=Yii::$app->session->get('userId');
            if(!$user){
                $data['code'] = 2;
                $data['message'] = '未登录';
                die(json_encode($data));
            }
            $model = new content();
            $contentData['name'] = Yii::$app->request->post('name');// 标题
            $contentData['abstract'] = '';// 摘要
            $contentData['pid'] = Yii::$app->request->post('pid', 0);// 父id，一般为0
            $contentData['catId'] = Yii::$app->request->post('catId');// 主id
            $extendValue[0] = Yii::$app->request->post('article');// 文章
            $category = explode(",", Yii::$app->request->post('category'));//这个是副分类格式'45,54'
//            $category = explode(",",'2,6,16');//这个是副分类
            $addtime = date("Y-m-d H:i:s");
            $model->createTime = $addtime;
            $model->userId = Yii::$app->session->get('userId');
            $model->userId = 1;
            $model->name = $contentData['name'];
            $model->abstract = $contentData['abstract'];
            $model->pid = $contentData['pid'];
            $model->image = '';
            $model->catId = $contentData['catId'];
            $model->viewCount = 0;
            $re = $model->save();
            Content::updateAll(['sort' => $model->primaryKey], "id=$model->primaryKey");
            //将分类的内容属性，转移到内容本身的扩展属性中
            $contentExtend = new ContentExtend();
            $contentExtend->shiftExtend($model->primaryKey, $contentData['catId'], $extendValue, $contentData['pid']);
            //将分类的内容的副分类存储
            $categoryContent = new CategoryContent();
            $categoryContent->secondClass($model->primaryKey, $category);
            if ($re = 1) {
                $key = $model->primaryKey;
                $data['code'] = 0;
                $data['message'] = '发表成功';
                $data['id'] = $model->primaryKey;
                die(json_encode($data));
            } else {
                $data['code'] = 1;
                $data['message'] = '发表失败，请重试';
                die(json_encode($data));
            }
        } else {
            $data['code'] = 1;
            $data['message'] = '请求错误';
            die(json_encode($data));
        }
    }

    /**
     * 积分
     */
    public function actionIntegral()
    {
        $userId = Yii::$app->request->get('userId');
        if (!$userId) {
            $data['code'] = 2;
            $data['message'] = '未登录';
            die(json_encode($data));
        }
        $data['details'] = Yii::$app->db->createCommand("select id,score,message,createTime From {{%integral_details}} where userId=$userId order by id desc limit 10")->queryAll();
        $data['integral'] = Yii::$app->db->createCommand("select integral From {{%user}} where id=$userId order by id desc limit 1")->queryOne()['integral'];
        die(json_encode($data));
    }

    /**
     * 找回密码
     */
    public function actionFindPass()
    {
        $login = new Login();
        $registerStr = Yii::$app->request->post('registerStr');
        $pass = Yii::$app->request->post('pass');
        $code = Yii::$app->request->post('code');
        $type = Yii::$app->request->post('type');
        $checkTime = $login->checkTime();
        if ($checkTime) {
            $checkCode = $login->checkCode($registerStr, $code);
            if (!$checkCode) {
                $res['code'] = 1;
                $res['message'] = '验证码错误';
                die(json_encode($res));
            }
        } else {
            $res['code'] = 1;
            $res['message'] = '验证码过期';
            die(json_encode($res));
        }
        $user = $login->find()->where("phone='$registerStr' or email='$registerStr'")->one();
        if (!$user) {
            if ($type == 1) {
                $res['code'] = 2;
                $res['message'] = '此电话还没有注册！';
                die(json_encode($res));
            } else {
                $res['code'] = 2;
                $res['message'] = '此邮箱还没有注册！';
                die(json_encode($res));
            }
        }
        if ($type == 1) {
            $re = $login->updateAll(['userPass' => md5(md5($pass) . 'LXLT')], "phone='$registerStr'");
        } else {
            $re = $login->updateAll(['userPass' => md5(md5($pass) . 'LXLT')], "email='$registerStr'");
        }
        if ($re) {
            $res['code'] = 0;
            $res['message'] = '密码找回成功';
            die(json_encode($res));
        } else {
            $res['code'] = 1;
            $res['message'] = '找回失败，请重试';
            die(json_encode($res));
        }
    }

    /**
     * 修改密码
     */
    public function actionChangePass()
    {
        $login = new Login();
        $registerStr = Yii::$app->request->post('registerStr');
        $pass = Yii::$app->request->post('pass');
        $new = Yii::$app->request->post('newPass');
        $user = $login->find()->where("(phone='$registerStr' or email='$registerStr') and userPass='" . md5(md5($pass) . 'LXLT') . "''")->one();
        if (!$user) {
            $res['code'] = 2;
            $res['message'] = '用户名或密码不正确';
            die(json_encode($res));
        }
        $re = $login->updateAll(['userPass' => md5(md5($new) . 'LXLT')], "id='" . $user['id'] . "'");
        if ($re) {
            $res['code'] = 0;
            $res['message'] = '密码修改成功';
            die(json_encode($res));
        } else {
            $res['code'] = 1;
            $res['message'] = '密码修改失败，请重试';
            die(json_encode($res));
        }
    }

    /**
     * 上传头像
     */
    public function actionUpImage()
    {
        $session = Yii::$app->session;
        $userId = $session->get('userId');
        $userData = $session->get('userData');
        $image = Yii::$app->request->post('image');
        $sign = Login::updateAll(['image' => $image], "id=$userId");
        $user = Yii::$app->db->createCommand("select id,nickname,userName,phone,email,image,integral,level from {{%user}} where id=$userId")->queryOne();
        if ($sign) {
            $userData['image'] = $image;
            $session->set('userData', $user);
            $res['code'] = 0;
            $res['message'] = '更换成功';
        } else {
            $res['code'] = 1;
            $res['message'] = '更换失败，请重试';
        }
        die(json_encode($res));
    }

    /**
     * 修改个人资料
     */
    public function actionChangeUserInfo()
    {
        $model = new Login();
        $session = Yii::$app->session;
        $userId = $session->get('userId');
        $userName = Yii::$app->request->post('userName', '');
        $bathday = Yii::$app->request->post('bathday', '');
        $email = Yii::$app->request->post('email', '');
        $phone = Yii::$app->request->post('phone', '');
        $nickname = Yii::$app->request->post('nickName', '');
        $school = Yii::$app->request->post('school');
        $education = Yii::$app->request->post('education');
        $label = Yii::$app->request->post('label', '');
        $userInfo = [];
        if ($nickname) {
            $userInfo['nickname'] = $nickname;
        }
        if ($phone) {
            $userInfo['phone'] = $phone;
        }
        if ($email) {
            $userInfo['email'] = $email;
        }

        if ($phone) {
            $signPhone = Login::find()->where("id=$userId AND phone='$phone'")->one();
            if (!$signPhone) {
                $phone = Login::find()->where(" phone='$phone'")->one();
                if ($phone) {
                    die(json_encode(['code' => 1, 'message' => '该手机已被其他用户绑定']));
                }
            }
        }
        $model->updateAll($userInfo, "id=$userId");
        $userData = $model->findOne($userId);
        Yii::$app->session->set('userData', $userData);
        if ($bathday || $school || $education) {
            $extend['bathday'] = $bathday;
            $extend['school'] = $school;
            $extend['education'] = $education;
            $extend['userId'] = $userId;
            $extend['label'] = $label;
            $re = Yii::$app->db->createCommand()->insert("{{%user_extend}}", $extend)->execute();
        }
        $res['code'] = 0;
        $res['message'] = '保存成功';
        die(json_encode($res));
    }

    /**
     * 回帖只看该作者
     */
    public function actionOnlyAuthor()
    {
        $authorId = Yii::$app->request->post('authorId ', '');
        $contentId = Yii::$app->request->post('contentid', '');
        // 获取评论的数据，是回复文章的数据还是回复文章和其他人的数据
        $discuss = new UserDiscuss();
        $data = $discuss->getAuthorDiscuss($authorId, $contentId, $pageSize = 10, $page = 1);// 这里是查看全部的回复，只看回复文章的话加pid=0
        die(json_encode($data));
    }

    /*
     * 发布悬赏
     * */
    public function actionReward()
    {
        $integral = Yii::$app->session->get('integral', '');
        if ($integral < 10) {
            echo '<script>alert("您的等级太低，努力升级吧，少年！")</script>';
            die;
        }
        if ($_POST) {
            $model = new content();
            $contentData['name'] = Yii::$app->request->post('name');// 标题
            $contentData['abstract'] = '';// 摘要
            $contentData['pid'] = 0;// 父id，一般为0
            $contentData['catId'] = Yii::$app->request->post('catId');// 主id
            $extendValue[0] = Yii::$app->request->post('article', '');// 文章
            $category = explode(",", Yii::$app->request->post('category'));//这个是副分类格式'45,54'
//            $category = explode(",",'2,6,16');//这个是副分类
            $addtime = date("Y-m-d H:i:s");
            $model->createTime = $addtime;
            $model->userId = Yii::$app->session->get('userId');
            $model->userId = 1;
            $model->name = $contentData['name'];
            $model->abstract = $contentData['abstract'];
            $model->pid = $contentData['pid'];
            $model->image = '';
            $model->catId = $contentData['catId'];
            $model->viewCount = 0;
            $re = $model->save();
            Content::updateAll(['sort' => $model->primaryKey], "id=$model->primaryKey");
            //将分类的内容属性，转移到内容本身的扩展属性中
            $contentExtend = new ContentExtend();
            $contentExtend->shiftExtend($model->primaryKey, $contentData['catId'], $extendValue, $contentData['pid']);
            //将分类的内容的副分类存储
            $categoryContent = new CategoryContent();
            $categoryContent->secondClass($model->primaryKey, $category);
            if ($re = 1) {
                $key = $model->primaryKey;
                $data['code'] = 0;
                $data['message'] = '发表成功';
                $data['id'] = $model->primaryKey;
                die(json_encode($data));
            } else {
                $data['code'] = 1;
                $data['message'] = '发表失败，请重试';
                die(json_encode($data));
            }
        } else {
            $data['code'] = 1;
            $data['message'] = '请求错误';
            die(json_encode($data));
        }
    }

    /*
     * 全部/精华
     * */
    public function actionAllArticle()
    {
        $cate= Yii::$app->request->post('cate', 'all');
        $page= Yii::$app->request->post('page', 1);
        $model=new Content();
        $first='2,3,4,5,14';
        if($cate=='all'){
            $data=$model->getList($first,'','',15,$page);
        }else{
            $data=$model->getList($first,'','',15,$page,'goodArticle=1 and ');
        }
        $page=$data['page'];
        $data=$data['list'];
        die(json_encode(['code'=>0,'data'=>$data,'page'=>$page]));
    }


}