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
        $w=114;
        $h=40;
        $num=4;
        $code = "";
        for ($i = 0; $i < 4; $i++) {
            $code .= rand('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
           'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W',
           'X', 'Y', 'Z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
           'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
           'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
        }
        //4位验证码也可以用rand(1000,9999)直接生成
        //将生成的验证码写入session，备验证时用
        $_SESSION["verifyCode"] = $code;
        //创建图片，定义颜色值
        header("Content-type: image/PNG");
        $im = imagecreate(114, 40);
        $black = imagecolorallocate($im, 0, 0, 0);
        $gray = imagecolorallocate($im, 200, 200, 200);
        $bgcolor = imagecolorallocate($im, 255, 255, 255);
        //填充背景
        imagefill($im, 0, 0, $gray);
        //画边框
        imagerectangle($im, 0, 0, $w-1, $h-1, $black);
        //随机绘制两条虚线，起干扰作用
        $style = array ($black,$black,$black,$black,$black,
            $gray,$gray,$gray,$gray,$gray
        );
        imagesetstyle($im, $style);
        $y1 = rand(0, $h);
        $y2 = rand(0, $h);
        $y3 = rand(0, $h);
        $y4 = rand(0, $h);
        imageline($im, 0, $y1, $w, $y3, IMG_COLOR_STYLED);
        imageline($im, 0, $y2, $w, $y4, IMG_COLOR_STYLED);
        //在画布上随机生成大量黑点，起干扰作用;
        for ($i = 0; $i < 80; $i++) {
            imagesetpixel($im, rand(0, $w), rand(0, $h), $black);
        }
        //将数字随机显示在画布上,字符的水平间距和位置都按一定波动范围随机生成
        $strx = rand(3, 8);
        for ($i = 0; $i < $num; $i++) {
            $strpos = rand(1, 6);
            imagestring($im, 5, $strx, $strpos, substr($code, $i, 1), $black);
            $strx += rand(8, 12);
        }
        imagepng($im);//输出图片
        imagedestroy($im);//释放图片所占内存

    }


}
