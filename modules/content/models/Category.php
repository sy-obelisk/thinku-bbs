<?php 
namespace app\modules\content\models;
use yii\db\ActiveRecord;
class Category extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%category}}';
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['pid','name','image','createTime','description','userId'], 'required'],

        ];
    }
    /**
     * 获取所有分类
     * @param $pid
     * @param $status
     * @param string $catId
     * @param array $data
     * @return array
     * @Obelisk
     */
    public function getAllCate($pid,$status,$catId="",$show ="",$data=array()){
        $userId = \Yii::$app->session->get('adminId');
        $block = \Yii::$app->db->createCommand("select b.* from {{%user_block}} ub LEFT JOIN {{%block}} b ON ub.blockId = b.id WHERE ub.userId = $userId AND b.pid=8")->queryAll();
        if($show != ""){
            $show = " AND isShow = 1";
        }
        $objData = $this->find()->where("pid=$pid $show")->orderBy('sort DESC')->all();
        foreach($objData as $k => $v){
            $data[$k] = $v->attributes;
            if(empty($status)){
                $str = "";
                foreach($block as $val){
                    if($val['value'] == 'content-index'){
                        $str .= '<a href="'.baseUrl.'/content/category/'.$val['value'].'?catId='.$v->id.'">内容管理</a> ';
                    }elseif($val['value'] == 'delete'){
                        $str .= ' <a onclick="checkDelete('.$v->id.')" class="categoryDelete" href="javascript:;">删除</a> ';
                    }elseif($val['value'] == 'add'){
                        $str .=' <a href="'.baseUrl.'/content/category/'.$val['value'].'?pid='.$v->id.'">添加子分类</a> ';
                    }else{
                        $str .=' <a href="'.baseUrl.'/content/category/'.$val['value'].'?id='.$v->id.'">'.$val['name'].'</a> ';
                    }
                }
                $data[$k]['action'] = $str;
            }else{
                if(empty($catId)){
                    $data[$k]['name'] = '<a href="'.baseUrl.'/content/content/index?showId='.$v->id.'">'.$v['name'].'</a>';
                }else{
                    $data[$k]['name'] = '<a href="'.baseUrl.'/content/content/index?catId='.$catId.'&showId='.$v->id.'">'.$v['name'].'</a>';
                }
                $data[$k]['action'] = '<a href="'.baseUrl.'/content/content/index?catId='.$v->id.'">进入</a>';
            }

        }
        foreach($data as $k => $v){
            $childData = $this->getAllCate($v['id'],$status,$catId);
            if(count($childData) > 0){
                $data[$k]['children'] = $childData ;
            }

        }
        return $data;
    }

    /**
     * 获取子分类
     * @param $pid
     * @param $status
     * @param string $catId
     * @param array $data
     * @return array
     * @Obelisk
     */
    public function getChildAll($id){
        $data = \Yii::$app->db->createCommand('select id,name as text from {{%category}} where pid='.$id)->queryAll();
        foreach($data as $k => $v){
            $childData = $this->getChildAll($v['id']);
            $data = array_merge($data,$childData);
        }
        return $data;
    }

    /**
     * 获取树形菜单
     * @param $pid
     * @param $id  选中的分类Id
     * @param  $type 是否递归查询
     * @param array $data
     * @return array
     * @Obelisk
     */
    public function getTree($pid,$id='',$show="",$major="",$type="",$data =array()){
        if($major != ""){
            $major = " AND isMajor = 1";
        }
        if($show != ""){
            $show = " AND isShow = 1";
        }
        $data = \Yii::$app->db->createCommand('select id,name as text from {{%category}} where pid='.$pid.$major.$show)->queryAll();
        if($id){
            $idArr = explode(",",$id);
        }
        foreach($data as $k => $v){
            if($id){
                if(in_array($v['id'],$idArr)){
                    $data[$k]['checked'] = true;
                }
            }
            if($type == 0){
                $childData = $this->getTree($v['id'],$id,$show,$major);
                if(count($childData) > 0){
                    $data[$k]['children'] = $childData ;
                }
            }

        }
        return $data;
    }

    /**
     * 获取指定分类
     *
     */
    public function getAllCat($pid){
        $sql = "select * from {{%category}}";
        if($pid){
            $sql .=" where pid=$pid";
        }
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }
    /**
     * 获取当前主分类的副分类模板
     * @param $catId
     * @param $id
     * @return array|bool
     * @Obelisk
     */

    public function getContentSecond($catId,$id){
        if($id){
            $idArr = explode(",",$id);
        }
        $data = \Yii::$app->db->createCommand('select secondClass from {{%category}} where id='.$catId)->queryOne();
        $classTemplate = explode(",",$data['secondClass']);
        $data = [];
        foreach($classTemplate as $k => $v){
            $data[$k] = \Yii::$app->db->createCommand('select id,name as text from {{%category}} where id='.$v)->queryOne();
            if(in_array($data[$k]['id'],$idArr)){
                $data[$k]['checked'] = true;
            }
            $data[$k]['children'] = $this->getTree($v,$id);
        }
        return $data;
    }

    /**
     * 搜索关键分类
     * @param $keyWords
     * @Obelisk
     */
    public function searchCat($keyWords){
        $where = '1=1';
        if($keyWords){
            $where .= " AND name like '%$keyWords%'";
        }
        $sql = "select id,name from {{%category}} WHERE $where";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }

    /**
     *
     * @Obelisk
     */
    public function getTag(){
        $sql = "select id,name as text from {{%category}} WHERE pid = 147";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $data;

    }
}
