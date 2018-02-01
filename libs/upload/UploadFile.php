<?php

/*
 * 文件上传
 * @author:yxt
 * @time:2013年10月17日9:34:39
 */

class UploadFile
{//类定义开始

    private $config = array(
        'int_max_size' => -1,    // 上传文件的最大值
        'arr_allow_exts' => array(),    // 允许上传的文件后缀 留空不作后缀检查
        'arr_allow_types' => array(),    // 允许上传的文件类型 留空不做检查
        'bool_thumb' => false,    // 使用对上传图片进行缩略图处理
        'str_thumb_max_width' => '',// 缩略图最大宽度
        'str_thumb_max_height' => '',// 缩略图最大高度
        'str_thumb_prefix' => 'thumb_',// 缩略图前缀
        'str_thumb_suffix' => '',//缩略图的文件后缀，默认为空
        'str_thumb_path' => '',// 缩略图保存路径
        'str_thumb_file' => '',// 缩略图文件名
        'str_thumb_ext' => '',// 缩略图扩展名
        'bool_thumb_remove_origin' => false,// 是否移除原图
        'bool_zip_images' => false,// 压缩图片文件上传
        'bool_auto_sub' => true,// 启用子目录保存文件
        'str_sub_type' => 'custom',// 子目录创建方式 可以使用hash date custom
        'str_sub_dir' => '', // 子目录名称 str_sub_type为custom方式后有效,最后要有斜杠
        'str_date_format' => 'Ymd',
        'int_hash_level' => 1, // hash的目录层次
        'str_save_path' => '',// 上传文件保存路径
        'bool_auto_check' => true, // 是否自动检查附件
        'bool_upload_replace' => false,// 存在同名是否覆盖
        'str_save_rule' => 'uniqid',// 上传文件命名规则,可以是一个函数，也可以是一个字符串
        'str_hash_type' => 'md5_file',// 上传文件Hash规则函数名
    );

    // 错误信息
    private $error = '';
    // 上传成功的文件信息
    private $uploadFileInfo;
    //返回的数据结构
    protected $arr_res = array('int_code' => 0, 'str_reason' => '', 'arr_data' => null);

    public function __get($name)
    {
        if (isset($this->config[$name])) {
            return $this->config[$name];
        }
        return null;
    }

    public function __set($name, $value)
    {
        if (isset($this->config[$name])) {
            $this->config[$name] = $value;
        }
    }

    public function __isset($name)
    {
        return isset($this->config[$name]);
    }

    /**
     * 架构函数
     * @access public
     * @param array $config 上传参数
     */
    public function __construct($config = array())
    {
        if (is_array($config)) {
            $this->config = array_merge($this->config, $config);
        }
    }

    /**
     * 上传一个文件
     * @auth yxt
     * @param array $arr_file 数据表名
     * @return boolean
     */
    private function _save($arr_file)
    {
        $filename = $arr_file['savepath'] . $arr_file['savename'];
        if (!$this->bool_upload_replace && is_file($filename)) {
            // 不覆盖同名文件
            $this->_setRes(0, '上传文件失败', array('int_error' => 12));
            return false;
        }
        // 如果是图像文件 检测文件格式
        if (in_array(strtolower($arr_file['extension']), array('gif', 'jpg', 'jpeg', 'bmp', 'png', 'swf'))) {
            $info = getimagesize($arr_file['tmp_name']);
            if (false === $info || ('gif' == strtolower($arr_file['extension']) && empty($info['bits']))) {
                $this->_setRes(0, '上传文件失败', array('int_error' => 13));
                return false;
            }
        }
        if (!move_uploaded_file($arr_file['tmp_name'], $this->_autoCharset($filename, 'utf-8', 'gbk'))) {
            $tint_errorerror = '文件上传保存错误！';
            $this->_setRes(0, '上传文件失败', array('int_error' => 14));
            return false;
        }
        if ($this->bool_thumb && in_array(strtolower($arr_file['extension']), array('gif', 'jpg', 'jpeg', 'bmp', 'png'))) {
            $image = getimagesize($filename);
            if (false !== $image) {
                //是图像文件生成缩略图
                $thumbWidth = explode(',', $this->str_thumb_max_width);
                $thumbHeight = explode(',', $this->str_thumb_max_height);
                $str_thumb_prefix = explode(',', $this->str_thumb_prefix);
                $str_thumb_suffix = explode(',', $this->str_thumb_suffix);
                $str_thumb_file = explode(',', $this->str_thumb_file);
                $str_thumb_path = $this->str_thumb_path ? $this->str_thumb_path : dirname($filename) . '/';
                $str_thumb_ext = $this->str_thumb_ext ? $this->str_thumb_ext : $arr_file['extension']; //自定义缩略图扩展名
                // 生成图像缩略图
                for ($i = 0, $len = count($thumbWidth); $i < $len; $i++) {
                    if (!empty($str_thumb_file[$i])) {
                        $thumbname = $str_thumb_file[$i];
                    } else {
                        $prefix = isset($str_thumb_prefix[$i]) ? $str_thumb_prefix[$i] : $str_thumb_prefix[0];
                        $suffix = isset($str_thumb_suffix[$i]) ? $str_thumb_suffix[$i] : $str_thumb_suffix[0];
                        $thumbname = $prefix . basename($filename, '.' . $arr_file['extension']) . $suffix;
                    }
                    Image::thumb($filename, $str_thumb_path . $thumbname . '.' . $str_thumb_ext, '', $thumbWidth[$i], $thumbHeight[$i], true);
                }
                if ($this->bool_thumb_remove_origin) {
                    // 生成缩略图之后删除原图
                    unlink($filename);
                }
            }
        }
        if ($this->bool_zip_images) {
            /**
             *  TODO 对图片压缩包在线解压,以后扩展用
             */

        }
        return true;
    }

    /**
     * 上传所有文件
     * @author yxt
     * @param array $file 上传文件信息
     * @param string $str_save_path 上传文件保存路径
     * @return array
     */
    public function upload($arr_file, $str_save_path = '')
    {
        //如果不指定保存文件名，则由系统默认
        if (empty($str_save_path)) {
            $str_save_path = $this->str_save_path;
        }

        // 检查上传目录
        if (!is_dir($str_save_path)) {//如果不是目录

            // 检查目录是否编码后的
            if (is_dir(base64_decode($str_save_path))) {
                $str_save_path = base64_decode($str_save_path);
            } else {
                // 尝试创建目录

                if (!mkdir($str_save_path, 0777, true)) {
                    $this->_setRes(0, '上传目录' . $str_save_path . '不存在');
                    return $this->arr_res;
                }
            }

        } else {//如果是目录检查是否可写
            if (!is_writeable($str_save_path)) {
                $this->_setRes(0, '上传目录' . $str_save_path . '不可写');
                return $this->arr_res;
            }
        }
        //尝试创建缩略图目录
        if (!empty($this->str_thumb_path)) {
            if (is_dir(base64_decode($str_save_path))) {
                if (!mkdir($this->str_thumb_path, 0777, true)) {
                    $this->_setRes(0, '上传目录' . $this->str_thumb_path . '不存在');
                    return $this->arr_res;
                }
            }
        }
        $arr_file_info = array();
        $bool_is_upload = false;

        // 获取上传的文件信息
        // 对$_FILES数组信息处理
        $arr_file2[] = $arr_file;
        $arr_files = $this->_dealFiles($arr_file2);
        foreach ($arr_files as $key => $arr_file) {
            //过滤无效的上传
            if (!empty($arr_file['name'])) {
                //登记上传文件的扩展信息
                if (!isset($arr_file['key'])) {
                    $arr_file['key'] = $key;
                }
                $arr_file['extension'] = $this->_getExt($arr_file['name']);
                $arr_file['savepath'] = $str_save_path;
                $arr_file['savename'] = $this->_getSaveName($arr_file);
                // 自动检查附件
                if ($this->bool_auto_check) {
                    if (!$this->_check($arr_file)) {//如果检查失败返回检查结果
                        return $this->arr_res;
                    }
                }
                //保存上传文件
                if (!$this->_save($arr_file)) {//如果保存失败
                    return $this->arr_res;
                }
                if (function_exists($this->str_hash_type)) {
                    $fun = $this->str_hash_type;
                    $arr_file['hash'] = $fun($this->_autoCharset($arr_file['savepath'] . $arr_file['savename'], 'utf-8', 'gbk'));
                }
                //上传成功后保存文件信息，供其他地方调用
                unset($arr_file['tmp_name'], $arr_file['error']);
                $arr_file['name'] = substr($arr_file['name'], 0, strrpos($arr_file['name'], '.'));
                $arr_file_info[] = $arr_file;
                $bool_is_upload = true;
            }
        }
        if ($bool_is_upload) {
            $this->_setRes(1, '上传文件成功', array('int_error' => 0, 'arr_data' => $arr_file_info));
            return $this->arr_res;
        } else {
            $this->_setRes(0, '上传文件失败', array('int_error' => 15));
            return $this->arr_res;
        }
    }

    /**
     * 上传单个上传字段中的文件 支持多附件
     * @author yxt
     * @param array $file 上传文件信息
     * Array
     * (
     * [name] => 2012041065284309.jpg
     * [type] => image/jpeg
     * [tmp_name] => C:\Windows\Temp\phpDEDC.tmp
     * [error] => 0
     * [size] => 94806
     * )
     * @param string $str_save_path 上传文件保存路径
     * @return string
     */
    public function uploadOne($arr_file, $str_save_path = '')
    {
        //如果不指定保存文件名，则由系统默认
        if (empty($str_save_path))
            $str_save_path = $this->str_save_path;
        // 检查上传目录
        if (!is_dir($str_save_path)) {
            // 尝试创建目录
            if (!mkdir($str_save_path, 0777, true)) {
                $this->_setRes(0, '上传目录' . $str_save_path . '不存在');
                return $this->arr_res;
            }
        } else {
            if (!is_writeable($str_save_path)) {
                $this->_setRes(0, '上传目录' . $str_save_path . '不可写');
                return $this->arr_res;
            }
        }
        //过滤无效的上传
        if (!empty($arr_file['name'])) {
            $arr_file_array = array();
            if (is_array($arr_file['name'])) {
                $keys = array_keys($arr_file);
                $count = count($arr_file['name']);
                for ($i = 0; $i < $count; $i++) {
                    foreach ($keys as $key)
                        $arr_file_array[$i][$key] = $arr_file[$key][$i];
                }
            } else {
                $arr_file_array[] = $arr_file;
            }
            $arr_info = array();
            foreach ($arr_file_array as $key => $arr_file) {
                //登记上传文件的扩展信息
                $arr_file['extension'] = $this->_getExt($arr_file['name']);
                $arr_file['savepath'] = $str_save_path;
                $arr_file['savename'] = $this->_getSaveName($arr_file);
                // 自动检查附件
                if ($this->bool_auto_check) {
                    if (!$this->_check($arr_file)) {
                        return $this->arr_res;
                    }
                }
                //保存上传文件
                if (!$this->_save($arr_file)) return false;
                if (function_exists($this->str_hash_type)) {
                    $fun = $this->str_hash_type;
                    $arr_file['hash'] = $fun($this->_autoCharset($arr_file['savepath'] . $arr_file['savename'], 'utf-8', 'gbk'));
                }
                unset($arr_file['tmp_name'], $arr_file['error']);
                $arr_file['name'] = substr($arr_file['name'], 0, strrpos($arr_file['name'], '.'));
                $arr_info[] = $arr_file;
            }
            // 返回上传的文件信息
            $this->_setRes(1, '上传文件成功', array('int_error' => 0, 'arr_data' => $arr_info));
            return $this->arr_res;
        } else {
            $this->_setRes(0, '上传无效', array('int_error' => 15));
            return $this->arr_res;
        }
    }

    /**
     * 转换上传文件数组变量为正确的方式,主要针对那种在表单中使用中括号命名的
     * @author yxt
     * @param array $files 上传的文件变量$_FILES
     * @return array
     */
    private function _dealFiles($arr_files)
    {
        $arr_file_re = array();
        $n = 0;
//        var_dump($arr_files);die;
        foreach ($arr_files as $key => $file) {
            if (is_array($file['name'])) {
                $keys = array_keys($file);
                $count = count($file['name']);
                for ($i = 0; $i < $count; $i++) {
                    $arr_file_re[$n]['key'] = $key;
                    foreach ($keys as $_key) {
                        $arr_file_re[$n][$_key] = $file[$_key][$i];
                    }
                    $n++;
                }
            } else {
                $arr_file_re[$key] = $file;
            }
        }
        return $arr_file_re;
    }

    /**
     * 根据上传文件命名规则取得保存文件名，如果有路径包括路径
     * @auth yxt
     * @param string $filename 文件信息比如$_FILES[image]
     * @return string
     */
    private function _getSaveName($filename)
    {
        $rule = $this->str_save_rule;
        if (empty($rule)) {//没有定义命名规则，则保持文件名不变
            $str_save_name = $filename['name'];
        } else {
            if (function_exists($rule)) {
                //使用函数生成一个唯一文件标识号
                $str_save_name = $rule() . "." . $filename['extension'];
            } else {
                //如果指定的函数不存在则使用函数名来作为文件名
                $str_save_name = $rule . "." . $filename['extension'];
            }
        }
        if ($this->bool_auto_sub) {
            // 使用子目录保存文件
            $filename['savename'] = $str_save_name;
            $str_save_name = $this->_getSubName($filename) . $str_save_name;
        }
        return $str_save_name;
    }

    /**
     * 获取子目录的名称
     * @auth yxt
     * @param array $arr_file 上传的文件信息
     * @return string
     */
    private function _getSubName($arr_file)
    {
        switch ($this->str_sub_type) {
            case 'custom':
                $dir = $this->str_sub_dir;
                break;
            case 'date':
                $dir = date($this->str_date_format, time()) . '/';
                break;
            case 'hash':
            default:
                $name = md5($arr_file['savename']);
                $dir = '';
                for ($i = 0; $i < $this->int_hash_level; $i++) {
                    $dir .= $name{$i} . '/';
                }
                break;
        }
        if (!is_dir($arr_file['savepath'] . $dir)) {
            mkdir($arr_file['savepath'] . $dir, 0777, true);
        }
        return $dir;
    }

    /**
     * 检查上传的文件
     * @auth yxt
     * @param array $arr_file 文件信息
     * @return boolean
     */
    private function _check($arr_file)
    {
        if ($arr_file['error'] !== 0) {
            //文件上传失败
            //捕获错误代码
            $this->_setRes(0, '上传文件失败', array('int_error' => $arr_file['error']));
            return false;
        }
        //文件上传成功，进行自定义规则检查
        //检查文件大小
        if (!$this->_checkSize($arr_file['size'])) {
            $this->_setRes(0, '上传文件过大', array('int_error' => 8));
            return false;
        }

        //检查文件Mime类型
        if (!$this->_checkType($arr_file['type'])) {
            $this->_setRes(0, '上传文件格式错误', array('int_error' => 9));
            return false;
        }
        //检查文件类型
        if (!$this->_checkExt($arr_file['extension'])) {
            $this->_setRes(0, '上传文件格式错误', array('int_error' => 10));
            return false;
        }

        //检查是否合法上传
        if (!$this->_checkUpload($arr_file['tmp_name'])) {
            $this->_setRes(0, '非法上传', array('int_error' => 11));
            return false;
        }
        return true;
    }

    /**
     * 自动转换字符集 支持数组转换
     * @auth yxt
     * @param string $fContents 文件类型
     * @param string $str_from 转换前编码
     * @param string $str_to 转换后编码
     * @return array
     */
    private function _autoCharset($fContents, $str_from = 'gbk', $str_to = 'utf-8')
    {
        $str_from = strtoupper($str_from) == 'UTF8' ? 'utf-8' : $str_from;
        $str_to = strtoupper($str_to) == 'UTF8' ? 'utf-8' : $str_to;
        if (strtoupper($str_from) === strtoupper($str_to) || empty($fContents) || (is_scalar($fContents) && !is_string($fContents))) {
            //如果编码相同或者非字符串标量则不转换
            return $fContents;
        }
        if (function_exists('mb_convert_encoding')) {
            return mb_convert_encoding($fContents, $str_to, $str_from);
        } elseif (function_exists('iconv')) {
            return iconv($str_from, $str_to, $fContents);
        } else {
            return $fContents;
        }
    }

    /**
     * 检查上传的文件类型是否合法
     * @auth yxt
     * @param string $str_type 文件类型
     * @return boolean
     */
    private function _checkType($str_type)
    {
        if (!empty($this->arr_allow_types)) {
            return in_array(strtolower($str_type), $this->arr_allow_types);
        }
        return true;
    }


    /**
     * 检查上传的文件后缀是否合法
     * @auth yxt
     * @param string $str_ext 后缀名
     * @return boolean
     */
    private function _checkExt($str_ext)
    {
        if (!empty($this->arr_allow_exts)) {
            return in_array(strtolower($str_ext), $this->arr_allow_exts, true);
        }
        return true;
    }

    /**
     * 检查文件大小是否合法
     * @auth yxt
     * @param integer $int_size 数据
     * @return boolean
     */
    private function _checkSize($int_size)
    {
        return !($int_size > $this->int_max_size) || (-1 == $this->int_max_size);
    }

    /**
     * 检查文件是否非法提交
     * @access private
     * @param string $str_filename 文件名
     * @return boolean
     */
    private function _checkUpload($str_filename)
    {
        return is_uploaded_file($str_filename);
    }

    /**
     * 取得上传文件的后缀
     * @author yxt
     * @param string $str_filename 文件名
     * @return boolean
     */
    private function _getExt($str_filename)
    {
        $arr_pathinfo = pathinfo($str_filename);
        return $arr_pathinfo['extension'];
    }

    /**
     * 设置返回数据
     * @author yxt
     * @param int $code 状态编号
     * @param string $reason 返回状态信息
     * @param array $data 返回结构数组
     * @return null
     */
    private function _setRes($code = 0, $reason = "返回状态信息", $data = array())
    {
        $this->arr_res['int_code'] = $code;
        $this->arr_res['str_reason'] = $reason;
        $this->arr_res['arr_data'] = $data;
    }
}