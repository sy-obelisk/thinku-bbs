<?php
namespace app\modules\cn\models;

use app\libs\Pager;
use app\modules\cn\models\Content;
use yii;
use yii\db\ActiveRecord;

class UserDiscuss extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_discuss}}';
    }

    /**
     * 赞或者踩
     * @return array
     */
    public function like($id, $status)
    {
        $data = Yii::$app->db->createCommand("select id,liked,hate from {{%content}} where id=$id")->queryOne();
        if ($status==1) {
            $re = UserDiscuss::updateAll(['liked' => $data['liked'] + 1], "id=" . $id);
            if ($re) {
                $user = new User();
                $user->integral(1, '点赞获取积分');
                $res['code'] = 0;
                $res['message'] = '点赞成功，积分+1';
            } else {
                $res['code'] = 1;
                $res['message'] = '点赞失败，请重试';
            }
        } else {
            $re = UserDiscuss::updateAll(['hate' => $data['hate'] + 1], "id=" . $id);
            if ($re) {

                $res['code'] = 0;
                $res['message'] = '操作成功';
            } else {
                $res['code'] = 1;
                $res['message'] = '操作失败';
            }
        }
        return $res;
    }

//    /**
//     * 获取当前内容的评论
//     * @param $contentId
//     * @param int $page
//     * @return array
//     * @Obelisk
//     */
//    public function getContentDiscuss($contentId,$page=1,$pageSize=10,$type='2'){
//        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
//        $data = \Yii::$app->db->createCommand("SELECT u.image,u.nickname,u.userName,d.* from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.pid=0 AND d.status=1 AND type =$type AND d.contentId = $contentId order by d.createTime DESC ".$limit)->queryAll();
//        foreach($data as $k => $v){
//            if(!$v['nickname']){
//                $data[$k]['nickname'] = $v['userName'];
//            }
//            if(!$v['image']){
//                $data[$k]['image'] = \Yii::$app->params['defaultImg'];
//            }
//            $data[$k]['createTime'] = strtotime($v['createTime']);
//            $data[$k]['countReply'] = count(\Yii::$app->db->createCommand("SELECT d.id from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.reply='{$v['id']}' order by d.createTime DESC ")->queryAll());
//            $child = \Yii::$app->db->createCommand("SELECT u.image,u.nickname,u.userName,d.* from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.pid={$v['id']} AND d.status=1 order by d.createTime ASC ")->queryAll();
//            foreach($child as $key => $val){
//                if(!$val['nickname']){
//                    $child[$key]['nickname'] = $val['userName'];
//                }
//                if(!$v['image']){
//                    $child[$key]['image'] = \Yii::$app->params['defaultImg'];
//                }
//                $child[$key]['createTime'] = strtotime($val['createTime']);
//                $child[$key]['countReply'] = count(\Yii::$app->db->createCommand("SELECT d.id from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.reply='{$val['id']}' order by d.createTime DESC ")->queryAll());
//            }
//            $data[$k]['child'] = $child;
//            //获取子评论
//            $sonDiscuss = $this->getSonDiscuss($v['id'],$type);
//            $data[$k]['sonNum'] = count($sonDiscuss);
//            $data[$k]['son'] = $sonDiscuss;
//        }
//        $parse = \Yii::$app->db->createCommand("SELECT d.*,u.userName,u.nickname,u.image from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id  where d.pid=0 AND d.status=1 AND d.type =1 AND d.contentId = $contentId order by d.createTime DESC")->queryAll();
//        $count = count(\Yii::$app->db->createCommand("SELECT d.* from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.pid=0 AND d.status=1 AND d.contentId = $contentId order by d.createTime DESC ")->queryAll());
//        $pageModel = new Pager($count,$page);
//        $pageStr = $pageModel->GetPagerContent();
//        return ['data' => $data,'pageStr' => $pageStr,'page' => $page,'parse' => $parse];
//    }
//
//    /**题目解析
//     * @param $contentId
//     * @return array
//     * by fawn
//     */
//    public function getParse($contentId)
//    {
//        $parse = \Yii::$app->db->createCommand("SELECT d.*,u.image,u.nickname,u.userName from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.pid=0 AND d.status=1 AND type =1 AND d.contentId = $contentId order by d.createTime DESC ")->queryAll();
//        foreach($parse as $k => $v){
//            if(!$v['nickname']){
//                $parse[$k]['nickname'] = $v['userName'];
//            }
//        }
//        return $parse;
//    }
//    /**
//     * 获取套轮详情
//     * @param $id
//     * @Obelisk
//     */
//    public function getDiscussDetails($id){
//        $sql = "select ud.*,u.userName,u.nickname,u.image from {{%user_discuss}} ud LEFT JOIN {{%user}} u on ud.userId=u.id WHERE ud.id=$id";
//        $data = \Yii::$app->db->createCommand($sql)->queryOne();
//        if(!$data['image']){
//            $data['image'] = \Yii::$app->params['defaultImg'];
//        }
//        if(!$data['nickname']){
//            $data['nickname'] = $data['userName'];
//        }
//        $data['createTime'] = date("m-d H:i:s",$data['createTime']);
//        return $data;
//    }
//
//    /**子评论
//     * @param $pid
//     * @return array
//     * by fawn
//     */
//    public function getSonDiscuss($pid){
//        $data = \Yii::$app->db->createCommand("SELECT u.image,u.nickname,u.userName,d.* from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.pid=$pid order by d.createTime DESC ")->queryAll();
//        foreach($data as $k => $v){
//            if(!$v['nickname']){
//                $data[$k]['nickname'] = $v['userName'];
//            }
//            if(!$v['image']){
//                $data[$k]['image'] = '/cn/images/details_defaultImg.png';
//            }
//        }
//        return $data;
//    }
//    public function getDiscuss($content){
//        $data = \Yii::$app->db->createCommand("SELECT u.image,u.nickname,u.userName,d.* from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.discussContent='".$content."' order by d.createTime DESC ")->queryOne();
//        if($data){
//            if(!$data['nickname']){
//                $data['nickname'] = $data['userName'];
//            }
//            if(!$data['image']){
//                $data['image'] = '/cn/images/details_defaultImg.png';
//            }
//        }
//        return $data;
//    }
//    public function getDiscussbyid($id,$type){
//        $data = \Yii::$app->db->createCommand("SELECT u.image,u.nickname,u.userName,d.* from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.pid =0 AND d.contentId='".$id."' AND d.type=$type order by d.createTime DESC ")->queryAll();
//        foreach($data as $k => $v){
//            if(!$v['nickname']){
//                $data[$k]['nickname'] = $v['userName'];
//            }
//            if(!$v['image']){
//                $data[$k]['image'] = '/cn/images/details_defaultImg.png';
//            }
//        }
//        return $data;
//    }
}
