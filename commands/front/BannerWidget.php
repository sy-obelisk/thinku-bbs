<?php
/**
 * 主导航菜单组件
 */
    namespace app\commands\front;
    use yii\base\Widget;
    use yii;
    use yii\web\application;
    use yii\web\controller;
	class BannerWidget extends Widget  {
        public $now_path;
        public $banner;
        public $pic;
        public $controller;
        /**
         * 定义函数
         * */
        public function init()
        {//这个可以取侧边栏数
            $this->path();
        }

        /**
         * 运行覆盖程序
         * */

        public function path(){
            $this->controller = Yii::$app->controller->id;
            $this->pic = Yii::$app->db->createCommand("select * from {{%banner}} where module='$this->controller'")->queryAll();
        }
        public function run(){
            return $this->render('banner',['pic'=>$this->pic]);
        }
	}
?>

