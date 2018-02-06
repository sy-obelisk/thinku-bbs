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

    //只看该作者
    public function getAuthorDiscuss($userId, $contentId, $pageSize = 10, $page = 1)
    {
        $limit = "limit " . ($page - 1) * $pageSize . ",$pageSize";
        $data = \Yii::$app->db->createCommand("SELECT d.* from " . tablePrefix . "user_discuss d left join " . tablePrefix . "user u on d.userId = u.id where userId=$userId and contendId=$contentId and show=1 and pid=0 order by d.createTime DESC " . $limit)->queryAll();
        $count = count(\Yii::$app->db->createCommand("SELECT d.* from " . tablePrefix . "user_discuss d left join " . tablePrefix . "user u on d.userId = u.id where userId=$userId and contendId=$contentId  and show=1 and pid=0 order by d.createTime DESC ")->queryAll());
        return ['data' => $data, 'count' => $count];
    }

    /**
     * 获取当前内容的评论
     * @param $contentId
     * @param int $page
     * @return array
     * 还得改
     */
    public function getContentDiscuss($contentId,$page=1,$pageSize=10){
        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
        $data = \Yii::$app->db->createCommand("SELECT u.image,u.nickname,u.userName,d.* from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.pid=0 AND d.status=1 AND d.contentId = $contentId order by d.id DESC ".$limit)->queryAll();
        foreach($data as $k => $v){
            if(!$v['nickname']){
                $data[$k]['nickname'] = $v['userName'];
            }
            if(!$v['image']){
                $data[$k]['image'] = \Yii::$app->params['defaultImg'];
            }
//            $data[$k]['countReply'] = count(\Yii::$app->db->createCommand("SELECT d.id from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.reply='{$v['id']}' order by d.createTime DESC ")->queryAll());
            $data[$k]['countReply'] = count(\Yii::$app->db->createCommand("SELECT d.id from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.pid='{$v['id']}' order by d.id DESC ")->queryAll());
            $child = \Yii::$app->db->createCommand("SELECT u.image,u.nickname,u.userName,d.* from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.pid={$v['id']} AND d.contentId=$contentId order by d.id ASC ")->queryAll();
            foreach($child as $key => $val){
                if(!$val['nickname']){
                    $child[$key]['nickname'] = $val['userName'];
                }
                if(!$v['image']){
                    $child[$key]['image'] = \Yii::$app->params['defaultImg'];
                }
                $child[$key]['countReply'] = count(\Yii::$app->db->createCommand("SELECT d.id from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.pid='{$val['id']}' order by d.id DESC ")->queryAll());
            }
            $data[$k]['child'] = $child;
            //获取子评论
            $sonDiscuss = $this->getSonDiscuss($v['id']);
            $data[$k]['sonNum'] = count($sonDiscuss);
            $data[$k]['son'] = $sonDiscuss;
        }
        return ['data' => $data,'page' => $page];
    }


//    /**子评论
//     * @param $pid
//     * @return array
//     * by fawn
//     */
    public function getSonDiscuss($pid){
        $data = \Yii::$app->db->createCommand("SELECT u.image,u.nickname,u.userName,d.* from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.pid=$pid order by d.createTime DESC ")->queryAll();
        foreach($data as $k => $v){
            if(!$v['nickname']){
                $data[$k]['nickname'] = $v['userName'];
            }
            if(!$v['image']){
                $data[$k]['image'] = '/cn/images/details_defaultImg.png';
            }
        }
        return $data;
    }

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
