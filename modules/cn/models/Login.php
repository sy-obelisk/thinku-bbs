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

    /**
     * 验证码的生成
     */
    public function verifyCode()
    {
        $string = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $str = "";
        for ($i = 0; $i < 4; $i++) {
            $pos = rand(0, 60);
            $str .= $string{$pos};
        }
        session_start();
        $_SESSION['verifyCode'] = strtolower($str);
        //（2）创建一张简单的图片（80X20），设置背景色，文本色，再加一些干扰线，干扰素；
        $img_handle = Imagecreate(114, 40);  //图片大小80X20
        $back_color = ImageColorAllocate($img_handle,rand(200,255),rand(200,255),rand(200,255));
        $txt_color = ImageColorAllocate($img_handle,rand(0,100), rand(0,100), rand(0,100));
        //加入干扰线
        for ($i = 0; $i < 3; $i++) {
            $line = ImageColorAllocate($img_handle, rand(0, 255), rand(0, 255), rand(0, 255));
            Imageline($img_handle, rand(0, 15), rand(0, 15), rand(100, 150), rand(10, 50), $line);
        }
        //加入干扰象素
        for ($i = 0; $i < 200; $i++) {
            $randcolor = ImageColorallocate($img_handle, rand(0, 255), rand(0, 255), rand(0, 255));
            Imagesetpixel($img_handle, rand() % 100, rand() % 50, $randcolor);
        }
        // （4）清空输出缓存区，再生成验证码图片，并显示图片。
        $strx = rand(3, 8);
        for ($i = 0; $i < 4; $i++) {
            imagestring($img_handle,7, ($i+1)*20, 10, substr($str, $i, 1),  $txt_color);
            $strx += rand(8, 12);
        }
        ob_clean();   // ob_clean()清空输出缓存区
        header("Content-type: image/png"); //生成验证码图片
        Imagepng($img_handle);//显示图片
    }

}
