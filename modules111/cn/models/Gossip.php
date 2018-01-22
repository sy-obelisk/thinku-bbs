<?php 
namespace app\modules\cn\models;
use app\libs\Pager;
use yii\db\ActiveRecord;
class Gossip extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%gossip}}';
    }

    /**
     * 获取八卦详细
     * by  yanni
     */

    public function getAllGossipDetail(){
        $gossip = Gossip::find()->asArray()->orderBy("createTime DESC")->limit(20)->all();  //最新八卦
        foreach($gossip as $key=>$v){
            $gossip[$key]['replyNum'] = Reply::find()->where('gossipId='.$v['id'])->count();
        }
        return $gossip;
    }
    /**
     * 获取用户八卦
     * by  yanni
     */
    public function getUserGossip($userId,$page,$pageSize){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $sql = "select p.id,p.title,p.content,p.image,p.viewCount,p.createTime,p.belong from {{%gossip}} p WHERE p.uid=$userId  order by p.viewCount DESC,p.createTime DESC $limit";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        foreach($data as $k=>$v){
            $data[$k]['title'] = base64_decode($v['title']);
            $data[$k]['content'] = base64_decode($v['title']);
        }
        return ['data'=>$data,'page'=>$page];
    }

    public function getAllGossip($page,$pageSize,$uid,$belong){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        if($uid){
            $sql = "select g.*,l.id as likeId from {{%gossip}} g LEFT JOIN {{%like}} l ON l.gossipId=g.id AND l.uid=$uid where g.belong=$belong ORDER BY g.createTime DESC $limit";
        }else{
            $sql = "select g.* from {{%gossip}} g where g.belong=$belong ORDER BY g.createTime DESC $limit";
        }
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        foreach($data as $k => $v){
            if(!isset($v['likeId'])){
                $data[$k]['likeId'] = false;
            }else{
                if($v['likeId']){
                    $data[$k]['likeId'] = true;
                }else{
                    $data[$k]['likeId'] = false;
                }
            }
            $data[$k]['image'] = json_decode($v['image'],true);
            $data[$k]['video'] = json_decode($v['video'],true);
            $data[$k]['audio'] = json_decode($v['audio'],true);
            $data[$k]['title'] = base64_decode($v['title']);
            $data[$k]['content'] = base64_decode($v['content']);
            $reply = Reply::find()->asArray()->where("gossipId={$v['id']}")->all();
            foreach($reply as $key => $val){
                $reply[$key]['content'] = base64_decode($val['content']);
            }
            $likeNum = Like::find()->where("gossipId={$v['id']}")->count();
            $data[$k]['reply'] = $reply;
            $data[$k]['likeNum'] = $likeNum;
        }
        $count = $this->find()->count();
        return ['data' => $data,'count' => $count];
    }

    /**
     * 获取PC八卦列表
     * @param $page
     * @param $pageSize
     * @param $selectId
     * @return array
     * @Obelisk
     */
    public function getGossip($page,$pageSize,$belong){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        if($belong){
            $sql = "select * from {{%gossip}} WHERE belong=$belong order by createTime DESC $limit";
        } else {
            $sql = "select * from {{%gossip}} order by createTime DESC $limit";
        }
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        foreach($data as $k=>$v){
            $sign = Reply::find()->asArray()->where("gossipId={$v['id']}")->orderBy("createTime DESC")->one();
            if($sign){
                $data[$k]['replySign'] =1;
                $data[$k]['replyName'] = $sign['uName'];
                $data[$k]['replyTime'] = $sign['createTime'];
            }else{
                $data[$k]['replySign'] =0;
            }

            $sign = Reply::find()->where("gossipId={$v['id']}")->count();
            $data[$k]['replyCount'] = $sign;
        }
        return $data;
    }

    /**
     * 获取八卦详情
     * @param $id
     * @Obelisk
     */
    public function getGossipDetails($id){
        $data=Gossip::find()->asArray()->where('id='.$id)->one();
        Gossip::updateAll(['viewCount' => $data['viewCount'] + 1],"id=$id");
        $reply = Reply::find()->asArray()->where("gossipId=$id")->orderBy('createTime DESC')->all();
        $hot = Gossip::find()->asArray()->where("id!=$id AND belong={$data['belong']}")->orderBy("createTime DESC")->limit(6)->all();
        $count = Reply::find()->asArray()->where("gossipId=$id")->count();
        return ['reply' => $reply,'data' => $data,'count' => $count,'hot' => $hot];
    }

    public function getPage($page,$pageSize,$belong){
        if($belong){
            $count = Gossip::find()->where("belong=$belong")->count();
        } else {
            $count = Gossip::find()->count();
        }
        $pageModel = new Pager($count,$page,$pageSize);
        $pageStr = $pageModel->GetPagerContent();
        return $pageStr;
    }

}
