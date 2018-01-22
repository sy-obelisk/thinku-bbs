<?php
namespace app\libs\upload;
/*
 * 图片处理类
 * @author:yxt
 * @time:2013年10月17日9:34:39
 */
class Image {

    /**
     * 取得图像信息
     * @author yxt
     * @param string $str_image 图像文件名
     * @return mixed
     */

    static function getImageInfo($str_image) {
        $arr_image_info = getimagesize($str_image);
        if ($arr_image_info !== false) {
            $str_image_type = strtolower(substr(image_type_to_extension($arr_image_info[2]), 1));
            $str_image_size = filesize($str_image);
            $arr_info = array(
                "width" => $arr_image_info[0],
                "height" => $arr_image_info[1],
                "type" => $str_image_type,
                "size" => $str_image_size,
                "mime" => $arr_image_info['mime']
            );
            return $arr_info;
        } else {
            return false;
        }
    }

    /**
     * 生成缩略图
     * @author yxt
     * @param string $str_image  原图
     * @param string $str_thumb_name 缩略图文件名
     * @param string $str_type 图像格式
     * @param string $str_max_width  宽度
     * @param string $str_max_height  高度
     * @param boolean $bool_interlace 启用隔行扫描
     * @return void
     */
    static function thumb($str_image, $str_thumb_name, $str_type='', $str_max_width=200, $str_max_height=50, $bool_interlace=true) {
        // 获取原图信息
        $info = Image::getImageInfo($str_image);
        if ($info !== false) {
            $str_src_width = $info['width'];
            $str_src_height = $info['height'];
            $str_type = empty($str_type) ? $info['type'] : $str_type;
            $str_type = strtolower($str_type);
            $bool_interlace = $bool_interlace ? 1 : 0;
            unset($info);
            $scale = min($str_max_width / $str_src_width, $str_max_height / $str_src_height); // 计算缩放比例
            if ($scale >= 1) {
                // 超过原图大小不再缩略
                $width = $str_src_width;
                $height = $str_src_height;
            } else {
                // 缩略图尺寸
                $width = (int) ($str_src_width * $scale);
                $height = (int) ($str_src_height * $scale);
            }

            // 载入原图
            $create_fun = 'ImageCreateFrom' . ($str_type == 'jpg' ? 'jpeg' : $str_type);
            if(!function_exists($create_fun)) {
                return false;
            }
            $res_src_img = $create_fun($str_image);

            //创建缩略图
            if ($str_type != 'gif' && function_exists('imagecreatetruecolor'))
                $res_thumb_img = imagecreatetruecolor($width, $height);
            else
                $res_thumb_img = imagecreate($width, $height);
              //png和gif的透明处理 by luofei614
            if('png'==$str_type){
                imagealphablending($res_thumb_img, false);//取消默认的混色模式（为解决阴影为绿色的问题）
                imagesavealpha($res_thumb_img,true);//设定保存完整的 alpha 通道信息（为解决阴影为绿色的问题）
            }elseif('gif'==$str_type){
                $trnprt_indx = imagecolortransparent($res_src_img);
                 if ($trnprt_indx >= 0) {
                        //its transparent
                       $trnprt_color = imagecolorsforindex($res_src_img , $trnprt_indx);
                       $trnprt_indx = imagecolorallocate($res_thumb_img, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                       imagefill($res_thumb_img, 0, 0, $trnprt_indx);
                       imagecolortransparent($res_thumb_img, $trnprt_indx);
              }
            }
            // 复制图片
            if (function_exists("ImageCopyResampled"))
                imagecopyresampled($res_thumb_img, $res_src_img, 0, 0, 0, 0, $width, $height, $str_src_width, $str_src_height);
            else
                imagecopyresized($res_thumb_img, $res_src_img, 0, 0, 0, 0, $width, $height, $str_src_width, $str_src_height);

            // 对jpeg图形设置隔行扫描
            if ('jpg' == $str_type || 'jpeg' == $str_type)
                imageinterlace($res_thumb_img, $bool_interlace);

            // 生成图片
            $image_fun = 'image' . ($str_type == 'jpg' ? 'jpeg' : $str_type);
            $image_fun($res_thumb_img, $str_thumb_name);
            imagedestroy($res_thumb_img);
            imagedestroy($res_src_img);
            return $str_thumb_name;
        }
        return false;
    }
}