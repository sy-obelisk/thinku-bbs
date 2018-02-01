<?php

namespace app\modules\cn\models;

use yii\db\ActiveRecord;

class Login extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**s
     * 验证短信码
     * @param $code
     * @Obelisk
     */
    public function checkCode($phone, $code)
    {
        $phoneCode = \Yii::$app->session->get($phone . 'phoneCode');
        if ($phoneCode == $code && $code != '') {
            //\Yii::$app->session->remove($phone.'phoneCode');
            $re = true;
        } else {
            $re = false;
        }
        return $re;
    }

    /**
     * 验证短信的时间是否过期
     * @Obelisk
     */
    public function checkTime()
    {
        $phoneTime = \Yii::$app->session->get('phoneTime');
        $timeLimit = \Yii::$app->params['timeLimit'];
        if (time() - $phoneTime > $timeLimit) {
            $re = false;
        } else {
            $re = true;
        }
        return $re;
    }

    /**
     * 验证手机或者邮箱是否已经注册
     */
    public function checkPhoneEmail($str, $type)
    {
        if ($type == 1) {
            $re = $this->find()->where("phone='$str'")->one();
        } else {
            $re = $this->find()->where("email='$str'")->one();
        }
        if ($re) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 验证用户名是否已经被注册
     */
    public function checkUserName($userName)
    {
        $re = $this->find()->where("userName='$userName'")->one();
        if ($re) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 验证用户名是否已经被注册
     */
    public function checkUserInfo($str,$type,$userName)
    {
        if ($type == 1) {
            $re = $this->find()->where("phone='$str'")->one();
            if($re){
                $res['code'] = 1;
                $res['message'] = '手机号已经被注册';
                return $res;
            }
        } else {
            $re = $this->find()->where("email='$str'")->one();
            if($re){
                $res['code'] = 1;
                $res['message'] = '邮箱已经被注册';
                return $res;
            }
        }
        $re = $this->find()->where("userName='$userName'")->one();
        if($re){
            $res['code'] = 1;
            $res['message'] = '用户名已经被注册';
            return $res;
        }
        return false;
    }
}
