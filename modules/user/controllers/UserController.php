<?php
/**
 * 分类管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\user\controllers;


use yii;
use app\libs\AppControl;
use app\libs\Method;
use app\modules\user\models\User;
use app\modules\user\models\UserBlock;
use app\modules\user\models\TestStatistics;

class UserController extends AppControl
{
    public $enableCsrfValidation = false;
    //用户列表
    public function actionIndex()
    {
        $page = Yii::$app->request->get('page', 1);
        $beginTime = strtotime(Yii::$app->request->get('beginTime', ''));
        $endTime = strtotime(Yii::$app->request->get('endTime', ''));
        $id = Yii::$app->request->get('id', '');
        $phone = Yii::$app->request->get('phone', '');
        $email = Yii::$app->request->get('email', '');
        $userName = Yii::$app->request->get('userName', '');
        $nickname = Yii::$app->request->get('nickname', '');
        $where = "1=1";
        $testWhere = "1=1";
        $sign = 0;
        if ($beginTime) {
            $where .= " AND u.createTime>=$beginTime";
        }
        if ($endTime) {
            $where .= " AND u.createTime<=$endTime";
        }
        if ($id) {
            $where .= " AND u.id = $id";
        }
        if ($phone) {
            $where .= " AND u.phone = '$phone'";
        }
        if ($email) {
            $where .= " AND u.email = '$email'";
        }
        if ($userName) {
            $where .= " AND u.userName = '$userName'";
        }
        if ($nickname) {
            $where .= " AND u.nickname = '$nickname'";
        }
        if (($beginTime || $endTime) && ($endTime - $beginTime > 2592000 || $endTime - $beginTime == 0)) {
            $where = "1=1";
        }
        $model = new User();

        if ($sign) {
            $data = $model->getAnswerUser($where, 10, $page);
        } else {
            if ($where == "1=1") {
                $data['data'] = [];
            } else {
                $data = $model->getAllUser($where, 10, $page);
            }

        }
//        var_dump($data);die;
//        $page = Method::getPagedRows(['count'=>$data['count'],'pageSize'=>10, 'rows'=>'models']);
        $page = 1;
        return $this->render('index', ['page' => $page, 'data' => $data['data'], 'block' => $this->block]);
    }

    /**
     * 添加资源
     * @return string
     * @Obelisk
     */
    public function actionAddBlock()
    {
        $model = new UserBlock();
        if ($_POST) {
            $id = Yii::$app->request->post('id');
            $block = Yii::$app->request->post('block');
            $model->deleteAll("userId = $id");
            $blockArr = explode(",", $block);
            foreach ($blockArr as $v) {
                $model = new UserBlock();
                $model->userId = $id;
                $model->blockId = $v;
                $model->save();
            }
            $this->redirect("/user/user/index");
        } else {
            $id = Yii::$app->request->get('id');
            $data = $model->find()->where("userId = $id")->all();
            $blockArr = [];
            foreach ($data as $v) {
                $blockArr[] = $v['blockId'];
            }
            $blockArr = implode(",", $blockArr);
        }
        return $this->render('addBlock', ['block' => $blockArr, 'id' => $id]);
    }

    /**
     * 添加用户
     * @return string
     * @throws yii\db\Exception
     * @Obelisk
     */
    public function actionAdd()
    {
        if ($_POST) {
            $user = Yii::$app->request->post('user');
            foreach ($user as $k => $v) {
                if ($k != 'image' && $v != '') {
                    $sign = User::find()->where("$k='$v'")->one();
                    if ($sign) {
                        die('<script>alert("' . $k . '已被使用");history.go(-1);</script>');
                    }
                }
            }
            $userPass = Yii::$app->request->post('userPass');
            $uid = uc_user_register($user['userName'], md5($userPass), $user['email'], $user['phone'], '托福Pc后台', time());
            if ($uid == -3) {
                die('<script>alert("用户名已经存在");history.go(-1);</script>');
            } elseif ($uid == -6) {
                die('<script>alert("邮箱已经被注册");history.go(-1);</script>');
            } elseif ($uid == -7) {
                die('<script>alert("电话已经被注册");history.go(-1);</script>');
            }
            if ($uid > 0) {
                $remark = Yii::$app->request->post('remark');
                $user['remark'] = $remark;
                $user['userPass'] = md5($userPass);
                $user['createTime'] = time();
                $sign = Yii::$app->db->createCommand()->insert('{{%user}}', $user)->execute();
                if ($sign) {
                    $this->redirect('/user/user/index');
                } else {
                    die('<script>alert("保存失败，请重试");history.go(-1);</script>');
                }
            } else {
                die('<script>alert("保存失败，请重试");history.go(-1);</script>');
            }

        } else {
            return $this->render('add');
        }
    }

    /**
     * 删除用户
     * @return string
     * @Obelisk
     */
    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');
        $url = $_GET['url'];
        User::findOne($id)->delete();
        $this->redirect($url);
    }

    /**
     * 修改用户信息
     * @return string
     * @Obelisk
     */
    public function actionUpdate()
    {
        if ($_POST) {
            $user = Yii::$app->request->post('user');
            $id = Yii::$app->request->post('id');
            foreach ($user as $k => $v) {
                if ($k != 'image' && $v != '') {
                    $sign = User::find()->where("$k='$v' AND id!=$id")->one();
                    if ($sign) {
                        die('<script>alert("' . $k . '已被使用");history.go(-1);</script>');
                    }
                }
            }
            $sign = User::find()->where("phone='{$user['phone']}' AND id=$id")->one();
            if (!$sign) {
                $sign = User::find()->where("phone='{$user['phone']}' ")->one();
                if ($sign) {
                    die('<script>alert("该手机已被绑定");history.go(-1);</script>');
                }
            }
            $sign = User::find()->where("email='{$user['email']}' AND id=$id")->one();
            if (!$sign) {
                $sign = User::find()->where("phone='{$user['email']}' ")->one();
                if ($sign) {
                    die('<script>alert("该邮箱已被绑定");history.go(-1);</script>');
                }
            }
            $sign = User::findOne($id);
            $userPass = Yii::$app->request->post('userPass');
            $remark = Yii::$app->request->post('remark');
            $user['remark'] = $remark;
            if ($sign->userPass != $userPass) {
                $user['userPass'] = md5(md5($userPass) . 'LXLT');
            }
            $sign = User::updateAll($user, "id=$id");
            $returnUrl = Yii::$app->session->get('returnUrl');
            if ($sign) {
                $this->redirect($returnUrl);
            } else {
                die('<script>alert("保存失败，请重试");history.go(-1);</script>');
            }
        } else {
            $id = Yii::$app->request->get('id');
            $url = Yii::$app->request->get('url');
            $data = User::findOne($id);
            Yii::$app->session->set('returnUrl', $url);
            return $this->render('update', ['data' => $data, 'id' => $id]);
        }
    }

    /**
     * 积分详情
     * @Obelisk
     */
    public function actionIntegral()
    {
        $id = Yii::$app->request->get('id');
        $data = Yii::$app->db->createCommand("select integral From {{%user}} where id=$id ")->queryOne();
        $data['details'] = Yii::$app->db->createCommand("select id,score,message,createTime,type From {{%integral_details}} where userId=$id order by id desc limit 10")->queryAll();
        return $this->render('integral', ['integral' => $data, 'id' => $id]);
    }

    /**
     * 积分详情
     * @Obelisk
     */
    public function actionIntegralEdit()
    {
        if ($_POST) {
            $userName = Yii::$app->request->post('userName');
            $url = Yii::$app->request->post('url');
            $number = Yii::$app->request->post('number');
            $type = Yii::$app->request->post('type');
            $id= Yii::$app->request->post('userId');
            $user = new User();
            $user->integral($id, $number, '管理员直接调整');
            $this->redirect($url);
        } else {
            $id = Yii::$app->request->get('id');
            $url = Yii::$app->request->get('url');
            $user = User::findOne($id);
            return $this->render('integralEdit', ['userName' => $user->userName, 'url' => $url,'userId'=>$id]);
        }
    }
}