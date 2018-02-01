<?php
namespace app\libs;

use yii;
use yii\data\Pagination;

class Method
{
    /**
     * 分页函数
     * @param array $config 分页配置
     * @return array 分页
     * @Obelisk
     */
    public static function getPagedRows($config = [])
    {
        $pages = new Pagination(['totalCount' => $config['count']]);
        if (isset($config['pageSize'])) {
            $pages->setPageSize($config['pageSize'], true);
        }
        return $pages;
    }

    /**
     * 生成32位字符串
     * @return string
     * @Obelisk
     */
    public static function guid()
    {
        mt_srand((double)microtime() * 10000);
        $charid = strtolower(md5(uniqid(rand(), true)));
        $uuid = substr($charid, 0, 8) . substr($charid, 8, 4) . substr($charid, 12, 4) . substr($charid, 16, 4) . substr($charid, 20, 12);
        return $uuid;
    }

    /**
     * 生成订单号
     * @return string
     * @Obelisk
     */
    public static function orderNumber()
    {
        $orderNumber = 'toefl' . time() . rand(0, 9);
        return $orderNumber;
    }

    /**
     * @param string $html html内容
     * @param string $tags 保留标签
     * @return string
     */
    public static function getextbyhtml($html = '', $tags = '')
    {
        if (!empty($html)) {
            $res = preg_replace('/&nbsp;/', ' ', trim(strip_tags(htmlspecialchars_decode($html), $tags)));
            $res = trim(preg_replace('/<(p|P)>\W+<\/(p|P)>/', '', $res));
        } else {
            $res = false;
        }
        return $res;
    }

    /**
     * 词典翻译
     * @Obelisk
     */
    public static function getTranslate($words)
    {
        $url = "http://fanyi.youdao.com/openapi.do?keyfrom=5asdfasdf6&key=925644231&type=data&only=dict&doctype=json&version=1.1&q=" . $words;
        $list = file_get_contents($url);
        $js_de = json_decode($list, true);
        if ($js_de['errorCode'] != 0) {
            $data = 0;
        } else {
            $js_de['basic']['us'] = $js_de['basic']['us-phonetic'];
            $js_de['basic']['uk'] = $js_de['basic']['uk-phonetic'];
            $data = $js_de['basic'];
        }
        return $data;
    }

    /**
     * post请求
     * @param $url
     * @param string $post_data
     * @param int $timeout
     * @return mixed
     * @Obelisk
     */
    public static function post($url, $post_data = '', $timeout = 5)
    {//curl

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, 1);

        if ($post_data != '') {

            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));

        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        curl_setopt($ch, CURLOPT_HEADER, false);

        $file_contents = curl_exec($ch);

        curl_close($ch);

        return $file_contents;

    }
}