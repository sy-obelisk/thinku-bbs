<?php
namespace app\libs;
use yii;
/**
 * 申友 短信接口 公用类库
 * ============================================================================
 * 版权所有 2015-2020 北京九州申友教育咨询有限公司，并保留所有权利。
 * 网站地址: http://www.gmatonline.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: obelisk (刘志勇)
 */
class Sms {
    private $SN;
    private $PWD;
    private $SIG;

    function __construct() {
        $this->SN = Yii::$app->params['SMS_SN'];
        $this->PWD = Yii::$app->params['SMS_PWD'];
        $this->SIG = Yii::$app->params['SMS_SIG'];
    }
    /**
     * send 发送短信
     * 函数的含义说明
     * 发送短信函数
     * @access public
     * @param $mobile  参数一的说明
     * @param $consignee  参数二的说明
     * @param $ext  这是一个混合类型
     * @param $send_date
     * @param $rrid
     * @since 1.0
     * @ Aaron(刘志勇)
     * @return array
     */
    public function send($mobile, $content, $ext = '', $stime = '', $rrid = '') {
        $flag = 0;
        $argv = array('sn' => $this -> SN, 'pwd' => strtoupper(md5($this -> SN . $this -> PWD)), 'mobile' => $mobile, 'content' => iconv("UTF-8", "gb2312//IGNORE", $content . '【' . $this -> SIG . '】'), 'ext' => $ext, 'stime' => $stime, //定时时间 格式为2011-6-29 11:09:21
            'rrid' => $rrid);
        //构造要post的字符串
        $params ='';
        foreach ($argv as $key => $value) {
            if ($flag != 0) {
                $params .= "&";
                $flag = 1;
            }
            $params .= $key . "=";
            $params .= urlencode($value);
            $flag = 1;
        }
        $length = strlen($params);
        //创建socket连接
        $fp = fsockopen("sdk2.entinfo.cn", 8060, $errno, $errstr, 10) or exit($errstr . "--->" . $errno);
        //构造post请求的头
        $header = "POST /webservice.asmx/mt HTTP/1.1\r\n";
        $header .= "Host:sdk2.entinfo.cn\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . $length . "\r\n";
        $header .= "Connection: Close\r\n\r\n";
        //添加post的字符串
        $header .= $params . "\r\n";
        //发送post的数据
        $resput = fputs($fp, $header);
        $inheader = 1;
        while (!feof($fp)) {
            $line = fgets($fp, 1024);
            //去除请求包的头只显示页面的返回数据
            if ($inheader && ($line == "\n" || $line == "\r\n")) {
                $inheader = 0;
            }
            if ($inheader == 0) {
                // echo $line;
            }
        }
        $line = str_replace("<string xmlns=\"http://tempuri.org/\">", "", $line);
        $line = str_replace("</string>", "", $line);
        $result = explode("-", $line);
        if (count($result) > 1) {
            $r = true;
            $remark = '发送失败返回值为:' . $line . '。请查看webservice返回值对照表';
        } else {
            $r = false;
            $remark = '发送成功 返回值为:' . $line;
        }
        //记录日志
        $this -> addlog($this -> SN, "发送", $mobile, $content, $line, $remark);
        return $r;
    }

    /**
     * setlog
     * 日志记录函数
     *
     * @access public
     * @param mixed  参数一的说明
     * @param mixed  参数二的说明
     * @param mixed  这是一个混合类型
     * @since 1.0
     * @ Aaron(刘志勇)
     * @return array
     */
    public function addlog($value = '') {
        return true;
    }

}

?>