<?php
namespace app\modules\cn\models;

use app\modules\cn\models\UserDiscuss;
use app\modules\cn\models\UserAnswer;
use app\modules\cn\models\Collect;
use yii\db\ActiveRecord;
use app\libs\Pager;
use yii;

class Content extends ActiveRecord
{
    public $cateData;

    public static function tableName()
    {
        return '{{%content}}';
    }

    /**
     * 获取特定的内容列表
     * @return array
     */
    public function getList($first, $second = '', $third = '', $pageSize = 15, $page = 1, $where = '')
    {

//        $where = $where . "c.catId in ('$first,$second,$third')";
        $model = new Content();
        if($third){
            $cate="$first,$second,$third";
            $list= $model->getClass(['count'=>1,'fields' => 'listeningFile','category' =>$cate,'order'=>'c.id desc','pageSize' => $pageSize,'page'=>$page]);
            $count=$list['count'];
            unset($list['count']);
        }else{
            if($second){
                $cate="$first,$second";
                $list= $model->getClass(['count'=>1,'fields' => 'listeningFile','category' =>$cate,'order'=>'c.id desc','pageSize' => $pageSize,'page'=>$page]);
                $count=$list['count'];
                unset($list['count']);
            }else{
                $where = $where . "c.catId in ('$first')";
                $sql = "select c.id,c.name,c.abstract,c.viewCount,c.createTime,c.userId,u.userName,u.nickname,u.image,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655')  as listeningFile from {{%content}} c LEFT JOIN {{%user}} u ON u.id=c.userId WHERE $where order by c.id DESC,c.sort ASC";
                $count = count(Yii::$app->db->createCommand($sql)->queryAll());
                $limit = " limit " . ($page - 1) * $pageSize . ",$pageSize";
                $sql .= " $limit";
                $list = Yii::$app->db->createCommand($sql)->queryAll();
            }
        }
        foreach ($list as $k => $v) {
            $arr = Yii::$app->db->createCommand("select userName,nickname,ud.createTime from {{%user_discuss}} ud left join {{%user}} u on u.id=ud.userId where ud.contentId=" . $v['id'] . " and ud.pid=0 order by ud.id desc limit 1")->queryOne();
            $user = Yii::$app->db->createCommand("select userName,nickname,image from  {{%user}} where id=" . $v['userId'] . " limit 1")->queryOne();
            $list[$k]['userName']= $user['nickname'] == false ? $user['userName'] : $user['nickname'];
            $list[$k]['pic']= $user['image'] ;
            $list[$k]['last']['name'] = $arr['nickname'] == false ? $arr['userName'] : $arr['nickname'];
            $list[$k]['last']['time'] = substr($arr['createTime'], 0, 10);
            $list[$k]['count'] = count(Yii::$app->db->createCommand("select id from {{%user_discuss}}  where contentId=" . $v['id'] . " and pid=0")->queryAll());

        }
        $p['count'] = $count;
        $p['pagecount'] = ceil($count / $pageSize);
        $p['page'] = $page;
        return ['list'=>$list,'page'=>$p];
    }

    /**
     * 赞或者踩
     * @return array
     */
    public function like($userId,$id, $status)
    {
        $data = Yii::$app->db->createCommand("select id,liked,hate from {{%content}} where id=$id")->queryOne();
        if ($status == 1) {
            $re = Content::updateAll(['liked' => $data['liked'] + 1], "id=" . $id);
            if ($re) {
                Yii::$app->db->createCommand()->insert("{{%user_like}}", ['contentId'=>$id,'type'=>1,'status'=>1,'createTime'=>time(),'userId'=>$userId])->execute();
                $user = new User();
                $user->integral($userId, 1, '点赞获取积分',1);
                $res['code'] = 0;
                $res['message'] = '点赞成功，积分+1';
            } else {
                $res['code'] = 1;
                $res['message'] = '点赞失败，请重试';
            }
        } else {
            $re = Content::updateAll(['hate' => $data['hate'] + 1], "id=" . $id);
            if ($re) {
                Yii::$app->db->createCommand()->insert("{{%user_like}}", ['contentId'=>$id,'type'=>1,'status'=>2,'createTime'=>time(),'userId'=>$userId])->execute();
                $res['code'] = 0;
                $res['message'] = '操作成功';
            } else {
                $res['code'] = 1;
                $res['message'] = '操作失败';
            }
        }
        return $res;
    }


    /**
     * toefl调用内容
     * @param $select 包含where条件，查询字段，分页，排序
     * @return array
     * @Obelisk
     */
    public static function getClass($select)
    {
        $where = "1=1";
        $where .= isset($select['where']) ? " AND " . $select['where'] : '';
        $seField = "";
        $fields = isset($select['fields']) ? $select['fields'] : '';
        //原价
        if (strstr($fields, 'originalPrice')) {
            $seField .= ",(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='61f13913003193ea19e7e1271bca2752') as originalPrice";
        }
        //vip总监
        if (strstr($fields, 'vip')) {
            $seField .= ",(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='63948cf4e1234694cfa02048a77ad754') as vip";
        }
        //总监老师
        if (strstr($fields, 'majordomo')) {
            $seField .= ",(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='ab6df6ee04cfccc7f6ff9aadf0f46a8d') as majordomo";
        }
        //A级培训师
        if (strstr($fields, 'A')) {
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='3aa42936f977b9ef0b1717c646c5f91c') as A";
        }
        //描述
        if (strstr($fields, 'description')) {
            $seField .= ",(SELECT  CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='32cc8e6f27caf3fdf26e8cfd4e7b4433') as description";
        }
        //培训师
        if (strstr($fields, 'trainer')) {
            $seField .= ",(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='784b0cdb89d960e484f35f8872b7b7ea') as trainer";
        }
        //课程时长
        if (strstr($fields, 'duration')) {
            $seField .= ",(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='c8cc4bd99d4fcfcdfd5673bd635b5bcd') as duration";
        }
        //连接地址
        if (strstr($fields, 'url')) {
            $seField .= ",(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='43f8278a38a3539a7cfcdff67e5af92c') as url";
        }
        //开课日期
        if (strstr($fields, 'commencement')) {
            $seField .= ",(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='90f1d6d0fea6f171e8b82d9cbefee283') as commencement";
        }
        //性价比
        if (strstr($fields, 'performance')) {
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='32cc8e6f27caf3fdf26e8cfd4e7b44f9') as performance";
        }
        //主讲课程
        if (strstr($fields, 'speak')) {
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as speak";
        }
        //价格
        if (strstr($fields, 'price')) {
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='0ac9d45187ea22acbadedef8f8ab0e54') as price";
        }

        //段落编号
        if (strstr($fields, 'numbering')) {
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='28ec209ca256d8e34aea41d0bda50fc4') as numbering";
        }
        //答案
        if (strstr($fields, 'answer')) {
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer";
        }
        //备选项
        if (strstr($fields, 'alternatives')) {
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as alternatives";

        }
        //句子编号
        if (strstr($fields, 'sentenceNumber')) {
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='60883c91048a952f7abe6c666b54648b') as sentenceNumber";
        }
        //听力文件
        if (strstr($fields, 'listeningFile')) {
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655') as listeningFile";
        }
        //中午名称
        if (strstr($fields, 'cnName')) {
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='6d67cf3eba969f1515df48f6f43e740d') as cnName";
        }
        //文章
        if (strstr($fields, 'article')) {
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='b34abe997968ee9a0852814db839f75e') as article";
        }
        //问题补充听力
        if (strstr($fields, 'problemComplement')) {
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='e4dd05210147f22f9da9bdfcb1c0c562') as problemComplement";
        }
        //听力ID
        if (strstr($fields, 'listenId')) {
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='4bf183d69dada92bb0963c4c4b57b55b') as listenId";
        }
        if (isset($select['category'])) {
            if (isset($select['type'])) {
                $where .= " AND c.id in(select DISTINCT cc.contentId from {{%category_content}} cc where cc.catId in(" . $select['category'] . ") ) ";
            } else {
                $count = count(explode(",", $select['category']));
                $where .= " AND c.id in(select cc.contentId from {{%category_content}} cc where cc.catId in(" . $select['category'] . ") group by cc.contentId having count(1)=$count ) ";
            }
        }
        $page = isset($select['page']) ? $select['page'] : 1;
        $order = isset($select['order']) ? $select['order'] : 'c.sort ASC,c.id DESC';
        $pageSize = isset($select['pageSize']) ? $select['pageSize'] : 10;
        $limit = isset($select['limit']) ? $select['limit'] : (($page - 1) * $pageSize) . ",$pageSize";
//        var_dump("select c.*,ca.id as catId,ca.name as catName$seField from {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id where $where ORDER BY $order LIMIT ".$limit);die;
        $content = \Yii::$app->db->createCommand("select c.*,ca.id as catId,ca.name as catName$seField from {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id where $where ORDER BY $order LIMIT " . $limit)->queryAll();
        if (isset($select['pageStr'])) {
            $count = count(\Yii::$app->db->createCommand("select c.*,ca.name as catName$seField from {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id where $where")->queryAll());
            $pageModel = new Pager($count, $page, $pageSize);
            $pageStr = $pageModel->GetPagerContent();
            $content['pageStr'] = $pageStr;
        }
        $count = count(\Yii::$app->db->createCommand("select c.*,ca.name as catName$seField from {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id where $where")->queryAll());
        if (isset($select['count'])) {
            $content['count'] = $count;
        }

        return $content;
    }
}
