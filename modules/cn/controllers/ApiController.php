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
        $phoneNum = 15021666895;
        if (!empty($phoneNum)) {
            $phoneCode = mt_rand(100000, 999999);
            $session->set($phoneNum . 'phoneCode', $phoneCode);
            $session->set('phoneTime', time());
            $content = '【申友论坛】验证码：' . $phoneCode . '（10分钟有效），您正在通过申友论坛网免费会员！';
            $sms->send($phoneNum, $content, $ext = '', $stime = '', $rrid = '');
            $res['code'] = 1;
            $res['message'] = '短信发送成功！';
        } else {
            $res['code'] = 0;
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
        $email = 'yanyao_feng@163.com';
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
            $res['code'] = 1;
            $res['message'] = '邮件发送成功！';
        } else {
            $res['code'] = 0;
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
            $userName = 'SU' . time();
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
                    $model->news = '终于等到你，欢迎成为申友的一员';
                    $model->userId = $login->primaryKey;
                    $model->status = 1;
                    $model->type = 1;
                    $model->createTime = time();
                    $model->sendId = 1;
                    $model->save();
                    $res['code'] = 1;
                    $res['message'] = '注册成功';
                } else {
                    $res['code'] = 0;
                    $res['message'] = '注册失败，请重试';
                    $res['type'] = '3';
                }
            } else {
                $res['code'] = 0;
                $res['message'] = '验证码错误';
                $res['type'] = '1';
            }
        } else {
            $res['code'] = 0;
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
            $userName = 15021666895;
            $userPass = md5(md5($apps->post('userPass')) . 'LXLT');
            $userPass = md5(md5('xqd509633') . 'LXLT');
            $where = "where (phone='" . $userName . "' or email='" . $userName . "') and userPass='" . $userPass . "'";
            $loginsdata = Yii::$app->db->createCommand('select id,nickname,userName,phone,email,image,integral,level from {{%user}}' . $where)->queryOne();
            if (!empty($loginsdata['id'])) {
                $session->set('userId', $loginsdata['id']);
                $session->set('userData', $loginsdata);
                if ($loginsdata['image'] == null) {
                    $loginsdata['image'] = '';
                }
                $res['code'] = 0;
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
     * 注销账户
     * @return string
     * */
    public function actionLoginOut()
    {
        $session = Yii::$app->session;
        $session->remove('userData');
        $session->remove('userId');
        die(json_encode(['code' => 1]));
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
        $pageStr = $data['pageStr'];
        unset($data['pageStr']);
        die(json_encode(['data' => $data, 'pageStr' => $pageStr, 'code' => 1]));

    }

    /**
     * 下载文件
     */
    public function actionDownload()
    {

        //根据内容的id，查找文件的地址
        // 再判断下载
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
        $reData['isSolve'] = 0;
        $session = Yii::$app->session;
        $reData['userId'] = $session->get('userId');
        if (!$reData['userId']) {
            $data['code'] = 2;
            $data['message'] = '未登录';
            die(json_encode($data));
        }
        $re = Yii::$app->db->createCommand()->insert("{{%report}}", $reData)->execute();
        if ($re) {
            $data['code'] = 1;
            $data['message'] = '发表成功';
        } else {
            $data['code'] = 0;
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
            $user->integral(2, '论坛签到');
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
            $user->integral(1, '收藏文章');
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
            $user->integral(3, '评论获取积分');
            $res['code'] = 0;
            $res['message'] = '点赞成功，积分+3';
            die(json_encode($res));
        } else {
            $res['code'] = 0;
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
            $re = $content->like($post['contentId'], $post['status']);
        } else {
            $u = new UserDiscuss();
            $re = $u->like($post['contentId'],$post['status']);
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
        $pid= Yii::$app->db->createCommand("select id,pid From {{%category}} where id=$id ")->queryAll();
        $cate=new Category();
        $data=$cate->getSonCate($id);
        if($data==false){
            $re['code']=1;
            $re['message']='请求参数错误';
        }
        die(json_encode($data));
    }

    /**
     * 发帖
     */
    public function actionPost()
    {
//        if ($_POST) {
            $model = new content();
            $contentData = Yii::$app->request->post('content');
            $id = Yii::$app->request->post('id');
            $url = Yii::$app->request->post('url');
            $extendId = Yii::$app->request->post('key', []);
            $extendValue = Yii::$app->request->post('value');
            $tagValue = Yii::$app->request->post('tagValue');
//            $tagKey = Yii::$app->request->post('tagKey', []);
            $category = explode(",", Yii::$app->request->post('category'));
            $content = explode(",", Yii::$app->request->post('con'));
            if (empty($contentData['name'])) {
                die('<script>alert("请输入内容名称");history.go(-1);</script>');
            }
            if (!in_array($contentData['catId'], $category)) {
                die('<script>alert("主分类必须在副分类中");history.go(-1);</script>');
            }
            if ($id) {
                $re = $model->updateAll($contentData, 'id = :id', [':id' => $id]);
                foreach ($extendId as $k => $v) {
                    $required = ContentExtend::findOne($v);
                    if ($required->required == 1) {
                        if (empty($extendValue[$k])) {
                            die('<script>alert("属性值必填");history.go(-1);</script>');
                        }
                        if (!empty($required->requiredValue)) {
                            if (!preg_match("$required->requiredValue", $extendValue[$k])) {
                                die('<script>alert("请输入合法值");history.go(-1);</script>');
                            }
                        }
                    }
                    if (!isset($extendValue[$k]{255})) {
                        ContentExtend::updateAll(['value' => $extendValue[$k]], 'id = :id', [':id' => $v]);
                        ExtendData::updateAll(['value' => ""], "extendId = $v");
                    } else {
                        ContentExtend::updateAll(['value' => ""], 'id = :id', [':id' => $v]);
                        $sign = ExtendData::find()->where("extendId = $v")->one();
                        if ($sign) {
                            ExtendData::updateAll(['value' => $extendValue[$k]], "extendId = $v");
                        } else {
                            $dataModel = new ExtendData();
                            $dataModel->extendId = $v;
                            $dataModel->value = $extendValue[$k];
                            $dataModel->save();
                        }
                    }
                }
                CategoryContent::deleteAll('contentId = :contentId', array(':contentId' => $id));
                $categoryContent=new CategoryContent();
                $categoryContent->secondClass($id, $category);
            } else {
                $addtime = date("Y-m-d H:i:s");
                $model->createTime = $addtime;
                $model->userId = Yii::$app->session->get('adminId');
                $model->name = $contentData['name'];
                $model->title = $contentData['title'];
                $model->pid = $contentData['pid'];
                $model->image = $contentData['image'];
                $model->catId = $contentData['catId'];
                $model->viewCount = $contentData['viewCount'];
                $re = $model->save();
                Content::updateAll(['sort' => $model->primaryKey], "id=$model->primaryKey");

                //将分类的内容属性，转移到内容本身的扩展属性中
                $contentDate=new ContentExtend();
                $contentDate->shiftExtend($model->primaryKey, $contentData['catId'], $extendValue, $contentData['pid']);
                //将分类的内容的副分类存储
                $categoryContent=new CategoryContent();
                $categoryContent->secondClass($model->primaryKey, $category);
            }
            if ($re = 1) {
                $key = $model->primaryKey;
                echo '<script>alert("成功")</script>';
                $this->redirect($url);
            } else {
                echo '<script>alert("失败，请重试");history.go(-1);</script>';
                die;
            }
//        } else {
//            $catId = Yii::$app->request->get('id', '');//判断是否选择了主分类
//            $pid = Yii::$app->request->get('pid', 0);
//            $url = Yii::$app->request->get('url', '');
//            $showId = Yii::$app->request->get('showId', '');
//            if (!empty($url) && !empty($showId)) {
//                $url .= "&showId=$showId";
//            }
//            if ($pid != 0) {
//                $p = Content::findOne($pid);
//                $can = Category::findOne($p->catId);
//                if ($can->can == 2) {
//                    $catId = $p->catId;
//                }
//            }
//            if ($catId) {
//                $model = new CategoryExtend();
//                $cateModel = new Category();
//                $cateName = $cateModel->findOne($catId);
//                if ($pid != 0) {
//                    $where = "AND used = 1";
//                } else {
//                    $where = "";
//                }
//                $catContent = $model->find()->where("catId=$catId AND belong='content' $where")->orderBy('id ASC')->all();
//                $relatedCentent = $cateModel->find()->where(['id' => $cateName['Relatedcatid']])->all();
//                return $this->render('add', ['relCentent' => $relatedCentent, 'url' => $url, 'pid' => $pid, 'catId' => $catId, 'catContent' => $catContent, 'catName' => $cateName->name]);
//            } else {
//                return $this->render('add', ['url' => $url]);
//            }
//        }

    }

}