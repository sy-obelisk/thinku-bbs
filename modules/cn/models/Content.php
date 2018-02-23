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
            $list= $model->getClass(['count'=>1,'fields' => 'listeningFile','category' =>$cate,'pageSize' => $pageSize,'page'=>$page]);
            $count=$list['count'];
            unset($list['count']);
        }else{
            if($second){
                $cate="$first,$second";
                $list= $model->getClass(['count'=>1,'fields' => 'listeningFile','category' =>$cate,'pageSize' => $pageSize,'page'=>$page]);
                $count=$list['count'];
                unset($list['count']);
            }else{
                $where = $where . "c.catId in ('$first')";
                $sql = "select c.id,c.name,c.abstract,c.viewCount,c.createTime,u.userName,u.nickname,u.image,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655')  as listeningFile from {{%content}} c LEFT JOIN {{%user}} u ON u.id=c.userId WHERE $where order by c.id DESC,c.sort ASC";
                $count = count(Yii::$app->db->createCommand($sql)->queryAll());
                $limit = " limit " . ($page - 1) * $pageSize . ",$pageSize";
                $sql .= " $limit";
                $list = Yii::$app->db->createCommand($sql)->queryAll();
            }
        }
//        var_dump($where );die;

//var_dump($data);die;
//
        foreach ($list as $k => $v) {
            $arr = Yii::$app->db->createCommand("select userName,nickname,ud.createTime from {{%user_discuss}} ud left join {{%user}} u on u.id=ud.userId where ud.contentId=" . $v['id'] . " and ud.pid=0 order by ud.id desc limit 1")->queryOne();
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
                Yii::$app->db->createCommand()->insert("{{%user_like}}", ['contentId'=>$id,'type'=>1,'status'=>1,'creatTime'=>time(),'userId'=>$userId])->execute();
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
                Yii::$app->db->createCommand()->insert("{{%user_like}}", ['contentId'=>$id,'type'=>1,'status'=>2,'creatTime'=>time(),'userId'=>$userId])->execute();
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
     * 获取基础听力内容
     * @param int $basic 类型
     * @param int $page
     * @return array
     * @Obelisk
     */

//    public function getBasicContent($basic=82,$page=1){
//        $pageSize = 20;
//        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
//        $content = \Yii::$app->db->createCommand("select c.id,c.name,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as questSelect,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655') as file,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer,(SELECT count(DISTINCT ua.userId) from {{%user_answer}} ua WHERE ua.contentId = c.id ) as totle from {{%content}} c where c.id in(select cc.contentId from {{%category_content}} cc where cc.catId in(".$basic.") ) order by sort ASC, id ASC ".$limit)->queryAll();
//        $count = count(\Yii::$app->db->createCommand("select id from {{%content}} where id in(select cc.contentId from {{%category_content}} cc where cc.catId in(".$basic.") ) order by sort DESC,id DESC ")->queryAll());
//        $pages = ceil($count/$pageSize);
//        return ['content' => $content,'page' => $page,'pages' => $pages,'count' => $count];
//    }
//
//    /**
//     * 根据分页，搜索获取内容练习内容
//     * @param $part
//     * @param string $tpo
//     * @param int $ccc
//     * @param int $ddd
//     * @param int $page
//     * @return array
//     * @Obelisk
//     */
//    public function getContent($tpo="39",$page=1,$pageSize = 6){
//        $heaving = "";
//        if(!empty($tpoType)){
//            $heaving = "group by cc.contentId having count(1)=2";
//            $tpo .= ",$tpoType";
//        }
//        $limit = (($page-1)*6).",6";
//        $content = \Yii::$app->db->createCommand("select c.*,ca.name as catName,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='6d67cf3eba969f1515df48f6f43e740d') as cnName,(SELECT count(u.id) FROM {{%user}} u WHERE u.visitUrl = CONCAT( '/listening/', c.id ,'.html') || u.visitUrl = CONCAT( '/listen/question/', c.id,'.html')) AS totle from {{%content}} c left Join {{%category}} ca on c.catId=ca.id where c.id in(select cc.contentId from {{%category_content}} cc where cc.catId in(".$tpo.") ".$heaving.") order by c.title LIMIT ".$limit)->queryAll();
//        $count = count(\Yii::$app->db->createCommand("select c.id from {{%content}} c left Join {{%category}} ca on c.catId=ca.id where c.id in(select cc.contentId from {{%category_content}} cc where cc.catId in(".$tpo.") ".$heaving.") order by c.title ")->queryAll());
//        $pageModel = new Pager($count,$page,$pageSize);
//        $pageStr = $pageModel->GetPagerContent();
//        return ['count' =>$count,'content' => $content,'pageStr' => $pageStr];
//    }
//
//    /**
//     * 根据Id 获取问题的内容的答案，备选项，听力文件
//     * @param $id
//     * @Obelisk
//     */
//    public function getOneQuestion($id){
//        $content = \Yii::$app->db->createCommand("select c.catId,c.title,c.id,c.pid,c.name,ca.name as catName,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='e4dd05210147f22f9da9bdfcb1c0c562') as fileAdd,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='1837da083c9ba84649782cda5d7b2cd9') as questType,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as questSelect,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655') as file,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='b34abe997968ee9a0852814db839f75e') as text from {{%content}} c left Join {{%category}} ca on c.catId=ca.id where c.id=$id order by c.sort DESC,id ASC ")->queryOne();
//        $sign = Collect::find()->where("contentId={$content['id']}")->one();
//        if($sign){
//            $content['collect'] = 1;
//        }else{
//            $content['collect'] = 0;
//        }
//        return $content;
//    }
//
//    /**
//     * 根据主分类Id 获取所有内容包括其子内容 练习
//     * @param $catId
//     * @param $id
//     * @Obelisk
//     */
//    public function getAllContent($catId,$id){
//        $userId = \Yii::$app->session->get('userId');
//        $model = new UserDiscuss();
//        $answerModel = new UserAnswer();
//        $contentData = \Yii::$app->db->createCommand("select c.id,c.image,c.catId,c.name,c.title,ca.name as catName,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655') as file,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='b34abe997968ee9a0852814db839f75e') as text from {{%content}} c left Join {{%category}} ca on c.catId=ca.id where c.id in(select cc.contentId from {{%category_content}} cc where cc.catId in($catId))")->queryAll();
//        $currentData = [];
//        foreach($contentData as $k => $v){
//            $question = \Yii::$app->db->createCommand("select c.id,c.name,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='1837da083c9ba84649782cda5d7b2cd9') as questType,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='e4dd05210147f22f9da9bdfcb1c0c562') as fileAdd,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655') as file from {{%content}} c where c.pid={$v['id']} AND c.id in(select cc.contentId from {{%category_content}} cc where cc.catId = 48 ) order by sort DESC,id ASC")->queryAll();
//            $contentData[$k]['child'] = $question;
//            if($userId){
//                $contentData[$k]['record'] = $answerModel->getListenRecord($userId,$v['id']);
//            }
//            if($id != "") {
//                if ($v['id'] == $id) {
//                    $currentData = $contentData[$k];
//                    $currentData['child'] = \Yii::$app->db->createCommand("select c.id,c.name,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='e4dd05210147f22f9da9bdfcb1c0c562') as fileAdd,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='1837da083c9ba84649782cda5d7b2cd9') as questType,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as questSelect,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655') as file,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer from {{%content}} c where c.pid=$id AND c.catId=48 order by sort DESC,id ASC")->queryAll();
//                    foreach($currentData['child'] as $key => $val){
//                        $currentData['child'][$key]['discuss'] = $model->getContentDiscuss($val['id']);
//                        if($userId){
//                            $sign = Collect::find()->where("contentId={$val['id']} AND userId=$userId AND collectType=1")->one();
//                            if($sign){
//                                $currentData['child'][$key]['collect'] = 1;
//                            }else{
//                                $currentData['child'][$key]['collect'] = 0;
//                            }
//                        }else{
//                            $currentData['child'][$key]['collect'] = 0;
//                        }
//                    }
//                }
//            }else{
//                $currentData = [];
//            }
//        }
//        //查询该条内容的评论
//        if($id != "") {
//            $discuss = $model->getContentDiscuss($currentData['child'][0]['id']);
//        }else{
//            $discuss = [];
//        }
//        return ['contentData' => $contentData,'currentData' => $currentData,'discuss' => $discuss];
//    }
//
//    /**
//     * 根据内容Id 获取所有内容包括其子内容 精听
//     * @param $id
//     * @Obelisk
//     */
//    public function getListen($id){
//        $userId = \Yii::$app->session->get('userId');
//        $pc = \Yii::$app->db->createCommand("select CONCAT_WS(' ',ce.value,ed.value) as value From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id where contentId = $id AND code = '99b3cc02b18ec45447bd9fd59f1cd655'")->queryOne();
//        $offsetTime = \Yii::$app->db->createCommand("select CONCAT_WS(' ',ce.value,ed.value) as value From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id where contentId = $id AND code = '99c2265aa8cd374b779c95ccbdb5ac2a'")->queryOne();
//        $sentence = \Yii::$app->db->createCommand("select tc.id as collectId,c.id,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='28ec209ca256d8e34aea41d0bda50fc4') as section,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='b34abe997968ee9a0852814db839f75e') as sentence,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='c8cc4bd99d4fcfcdfd5673bd635b5bcd') as time,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='11d2dfb57c8f47e7475da15edfcb7eeb') as cnSentence  from {{%content}} c LEFT JOIN {{%tf_collect}} tc ON tc.contentId=c.id AND tc.userId='$userId' where c.pid=$id AND c.id IN ( SELECT cc.contentId FROM {{%category_content}} cc WHERE cc.catId = 49 ) order by id ASC")->queryAll();
//        $section = 0;
//        $content = array();
//        $idNumber = 2000;
//        $start_time = $offsetTime['value']==null?0.5:$offsetTime['value'];
//        $audio_time = 0;
//        $host = \Yii::$app->request->getHostInfo();
//        foreach($sentence as $k => $v){
//            //分段时储存
//            if($v['section'] != $section){
//                $sign = $v['id'];
//                $content['section'][$section]['id'] = $idNumber;
//                $content['section'][$section]['seq'] = $section+1;
//                $content['section'][$section]['start_time'] = $start_time;
//                $content['section'][$section]['audio_time'] = $v['time'];
//                $content['section'][$section]['fav'] = 'false';
//                $section++;
//                $idNumber++;
//                $seq = 1;
//            }
//            if($section == $v['section'] && $sign != $v['id']){
//                $content['section'][$section-1]['audio_time'] += $v['time'];
//            }
//            $content['sentence'][$k]['id'] = $v['id'];
//            $content['sentence'][$k]['content'] = $v['sentence'];
//            $content['sentence'][$k]['cnSentence'] = $v['cnSentence'];
//            $content['sentence'][$k]['parent'] = $content['section'][$section-1]['id'];
//            $content['sentence'][$k]['seq'] = $seq;
//            $content['sentence'][$k]['start_time'] = $start_time;
//            $content['sentence'][$k]['audio_time'] = $v['time'];
//            $content['sentence'][$k]['section'] = $section;
//            $content['sentence'][$k]['fav'] = 'false';
//            $content['sentence'][$k]['collectId'] = $v['collectId'];
//            $start_time += $v['time'];
//            $seq++;
//            $idNumber++;
//        }
//        $content['article'][0]['id'] = 24694;
//        $content['article'][0]['words_num'] = 783;
//        $content['article'][0]['level'] = 0;
//        $content['article'][0]['seq'] = 0;
//        $content['article'][0]['start_time'] = 0;
//        $content['article'][0]['audio_time'] = 306.00;
//        $content['article'][0]['listen_num'] = 16282;
//        $content['article'][0]['listen_people'] = 0;
//        $content['article'][0]['listenCount'] = 0;
//        $content['article'][0]['fav'] = 'false';
//        $content['audio']['id'] = '2263';
//        $content['audio']['name'] = 'TPO-14-L4.mp3';
//        $content['audio']['audio_time'] = '306.00';
//        $content['audio']['content'] = 'null';
//        $content['audio']['title'] = 'TPO-14-L4.mp3';
//        $content['audio']['formatType'] = 'mp3';
//        $content['audio']['filePath'] = $pc['value'];
//        $content['audio']['picPath'] = 'http://img.enhance.cn/toefl/listening-img/TPO/TPO-14-L4.png';
//        $content['audio']['html_content'] = 'null';
//        $content['audio']['type'] = '1';
//        return $content;
//
//    }
//
//    /**
//     * 模块列表页信息
//     * @Obelisk
//     */
//    public function getAllTest(){
//        $data = \Yii::$app->db->createCommand("select (Select SUM(ts.score) FROM {{%tf_test_history}} tth LEFT JOIN {{%tf_score}} ts ON tth.correct=ts.number WHERE tth.testId=(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='4bf183d69dada92bb0963c4c4b57b55b')  GROUP BY tth.testId) as listenScore,(Select COUNT(tth.userId) FROM {{%tf_test_history}} tth LEFT JOIN {{%tf_score}} ts ON tth.correct=ts.number WHERE tth.testId=(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='4bf183d69dada92bb0963c4c4b57b55b')  GROUP BY tth.testId) as listenNumber,c.name,c.id,COUNT(tts.id) as people from {{%content}} c LEFT JOIN {{%tf_test_statistics}} tts ON c.id=tts.tpoNumber WHERE c.catId = 146 GROUP by c.id   ORDER BY c.id ASC ")->queryAll();
//        foreach($data as $k=> $v){
//            $data[$k]['listenScore'] = $v['listenNumber'] == 0 || $v['listenNumber'] == null ?0:ceil($v['listenScore']/$v['listenNumber']);
//        }
//        return $data;
////        Select SUM(ts.score) as score,COUNT(DISTINCT tth.userId) AS people,COUNT(tth.userId) as number,ca.name,ca.id From {{%category}} ca LEFT JOIN {{%tf_test_history}} tth ON ca.id=tth.testId LEFT JOIN {{%tf_score}} ts ON tth.correct=ts.number WHERE ca.pid=38  GROUP BY ca.id
//    }
//
//    /**
//     * 获取文章信息
//     * @param $id
//     * @param int $num
//     * @Obelisk
//     */
//    public function getPrContent($id,$num){
//        $limit = $num-1;
//        $data = \Yii::$app->db->createCommand("select c.*,ca.name as catName,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655') as file from {{%content}} c left Join {{%category}} ca on c.catId=ca.id where c.catId=$id order by sort DESC,id ASC LIMIT $limit,1")->queryOne();
//        if($data){
//            $data['count'] = count($this->find()->where("pid = {$data['id']} AND catId = 48")->all());
//        }
//        return $data;
//    }
//
//    /**
//     * 根据Id 获取问题的内容的答案，备选项，听力文件
//     * @param $id
//     * @Obelisk
//     */
//    public function getTestQuestion($id,$num){
//        $limit = $num-1;
//        $content = \Yii::$app->db->createCommand("select c.id,c.name,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='e4dd05210147f22f9da9bdfcb1c0c562') as fileAdd,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='1837da083c9ba84649782cda5d7b2cd9') as questType,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as questSelect,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655') as file,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer from {{%content}} c left Join {{%category}} ca on c.catId=ca.id where c.pid=$id AND c.catId=48 order by c.sort DESC,id ASC LIMIT $limit,1")->queryOne();
//        return $content;
//    }
//
//    /**
//     * 获取某套题的做题人数和平局分
//     * @Obelisk
//     *
//     */
//    public function getOneTestScore($contentStr){
//        $topDetails = \Yii::$app->db->createCommand("SELECT COUNT(ua.userid) as people ,sum(ts.score) as score FROM (SELECT COUNT(contentId) AS total,userid FROM {{%user_answer}} WHERE belong='test' AND answerType = 1 AND pid IN ($contentStr) GROUP BY userid) ua LEFT JOIN {{%tf_score}} ts ON ts.number = ua.total")->queryAll();
//        return $topDetails;
//    }
//
//    /**
//     * 获取文章的题目数
//     * @param $id 文章Id
//     * @Obelisk
//     */
//    public function getPieceNum($id){
//      $data = count(\Yii::$app->db->createCommand("select id from {{%content}} c where c.pid=$id AND c.catId=48 order by sort DESC,id ASC")->queryAll());
//        return $data;
//  }
//
//    /**
//     * 获取文章的句子数
//     * @param $id 文章Id
//     * @Obelisk
//     */
//    public function getSentenceNum($id){
//        $data = count(\Yii::$app->db->createCommand("select id from {{%content}} c where c.pid=$id AND c.catId=49 order by sort DESC,id ASC")->queryAll());
//        return $data;
//    }
//
//    /**
//     * 获取用户当前未做题目的最近题目
//     * @param $userId
//     * @param $id
//     * @return string
//     * @Obelisk
//     */
//    public function getLastQuestion($userId,$id,$isDel=0){
//        $completeStr = \Yii::$app->db->createCommand("select  GROUP_CONCAT(contentId) as str from {{%user_answer}}  where userId=$userId AND pid=$id AND belong='practise' GROUP BY pid")->queryAll();
//        if(count($completeStr) == 0){
//            $num = '';
//        }else{
//            $completeStr = count($completeStr)>0?$completeStr[0]['str']:'';
//            $coStr = \Yii::$app->db->createCommand("select MIN(id) as num from {{%content}} c where c.pid=$id AND c.catId=48 AND c.id not in($completeStr)")->queryAll();
//            $num = $coStr[0]['num'];
//            if($num == null){
//                if($isDel == 0){
//                    UserAnswer::deleteAll("userId=$userId AND pid=$id AND belong='practise'");
//                }
//                $num = '';
//            }
//        }
//        return $num;
//    }
//
//    /**
//     * 获取用户当前未做听写最近近的句子
//     * @param $userId
//     * @param $id
//     * @return string
//     * @Obelisk
//     */
//    public function getLastSentence($userId,$id){
//        $completeStr = \Yii::$app->db->createCommand("select  GROUP_CONCAT(contentId) as str from {{%user_answer}}  where userId=$userId AND pid=$id AND belong='dictation' GROUP BY pid")->queryAll();
//        if(count($completeStr) == 0){
//            $num = '';
//        }else{
//            $completeStr = count($completeStr)>0?$completeStr[0]['str']:'';
//            $coStr = \Yii::$app->db->createCommand("select MIN(id) as num from {{%content}} c where c.pid=$id AND c.catId=49 AND c.id not in($completeStr)")->queryAll();
//            $num = $coStr[0]['num'];
//            if($num == null){
//                UserAnswer::deleteAll("userId=$userId AND pid=$id AND belong='dictation'");
//                $num = '';
//            }
//        }
//        return $num;
//    }
//    /**
//     * toefl调用内容
//     * @param $select 包含where条件，查询字段，分页，排序
//     * @return array
//     * @Obelisk
//     */
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
//
//    /**
//     * 获取每套TPO下的文章Id
//     *
//     */
//    public function ListeningChangeTpo($tpo){
//        $data = \Yii::$app->db->createCommand("SELECT id from {{%content}} WHERE catId=$tpo ORDER BY id ASC")->queryAll();
//        return $data;
//    }
//
//    /**
//     * 根据小分类获取tpo文章信息
//     * @param $catId
//     * @return array
//     * @Obelisk
//     */
//    public function getTpoCatChange($catId,$page,$pageSize){
//        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
//        $userId = \Yii::$app->session->get('userId');
//       // $model = new UserDiscuss();
//        $answerModel = new UserAnswer();
//        $contentData = \Yii::$app->db->createCommand("select c.id,c.image,c.catId,c.name,c.title,ca.name as catName,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655') as file,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='b34abe997968ee9a0852814db839f75e') as text from {{%content}} c left Join {{%category}} ca on c.catId=ca.id where c.id in(select cc.contentId from {{%category_content}} cc where cc.catId=$catId) ORDER BY c.id ASC $limit ")->queryAll();
//        foreach($contentData as $k => $v){
//            $question = \Yii::$app->db->createCommand("select c.id,c.name,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='1837da083c9ba84649782cda5d7b2cd9') as questType,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='e4dd05210147f22f9da9bdfcb1c0c562') as fileAdd,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655') as file from {{%content}} c where c.pid={$v['id']} AND c.id in(select cc.contentId from {{%category_content}} cc where cc.catId = 48 ) order by sort DESC,id ASC")->queryAll();
//            $contentData[$k]['child'] = $question;
//            if($userId){
//                $contentData[$k]['record'] = $answerModel->getListenRecord($userId,$v['id']);
//            }
//        }
//        return ['contentData' => $contentData];
//    }
//
//    /**
//     * 获取口语问题列表
//     * @param $category
//     * @return array
//     * @Obelisk
//     */
//    public function getSpokenTpo($category){
//        $sql = "Select c.*,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as question,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as type,ca.name as catName,ca.id as catId,COUNT(ua.id) as num from {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id LEFT JOIN {{%user_answer}} ua ON ua.contentId=c.id WHERE c.catId IN ($category) GROUP by c.id ORDER BY c.catId,c.title ASC";
//        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        $content = [];
//        $k = '';
//        $num =-1;
//        foreach ($data as  $v){
//            if($k != $v['catName']){
//                $k = $v['catName'];
//                $catId = $v['catId'];
//                $num++;
//            }
//            $content[$num]['catName']=$k;
//            $content[$num]['catId']=$catId;
//            $content[$num]['question'][]=$v;
//        }
//        return $content;
//    }
//    /**
//     * 获取口语分类
//     * @return array
//     */
//    public function getSpokenPart(){
//        $sql = "Select DISTINCT (SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as type from {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id LEFT JOIN {{%user_answer}} ua ON ua.contentId=c.id  where ca.pid=102 GROUP by c.id ORDER BY c.catId,c.title ASC";
//        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        return $data;
//
//    }
//
//    /**
//     * 获取黄金80题题目
//     * @param $page
//     * @param int $pageSize
//     * @Obelisk
//     */
//    public function changeGold($page,$pageSize=10){
//        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
//        $sql = "Select (SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as alternatives,c.*,ca.name as catName,COUNT(ua.id) as num from {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id LEFT JOIN {{%user_answer}} ua ON ua.contentId=c.id WHERE c.catId =145  GROUP by c.id ORDER BY c.id $limit ";
//        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        return $data;
//    }
//
//    /**
//     * 获取口语当前问题详情
//     * @param $id
//     * @return array
//     * @Obelisk
//     */
//    public function getSpokenQuestion($id){
//        $data = \Yii::$app->db->createCommand("select c.*,ca.id as catId,ca.name as catName,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655') as file,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='b34abe997968ee9a0852814db839f75e') as article,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='32cc8e6f27caf3fdf26e8cfd4e7b4433') as description,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='61f13913003193ea19e7e1271bca2752') as articleFile,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as question,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='e4dd05210147f22f9da9bdfcb1c0c562') as questionFile from {{%content}} c LEFT JOIN {{%category}}ca ON c.catId=ca.id WHERE c.id=$id")->queryOne();
//        return $data;
//    }
//
//
//    /**获取题号Id
//     * @param $catId
//     * @param $num
//     * @Obelisk
//     */
//    public function getContentId($catId,$num,$order='title'){
//        $num = $num-1;
//        $sql = "select id from {{%content}} WHERE catId=$catId ORDER BY $order ASC LIMIT $num,1";
//        $data = \Yii::$app->db->createCommand($sql)->queryOne();
//        return $data;
//    }
//    public function getContentIdRead($id,$num){
//        $num = $num-1;
//        $sql = "select id from {{%content}} WHERE pid=$id ORDER BY title ASC LIMIT $num,1";
//        $data = \Yii::$app->db->createCommand($sql)->queryOne();
//        return $data;
//    }
//    /**
//     * 通过分类Id获取模考tpoNumber
//     * @param $id
//     * @Obelisk
//     */
//    public function getSpokenId($id)
//    {
//        $sql = "select ce.contentId from {{%content_extend}}ce LEFT JOIN {{%content}} c ON ce.contentId=c.id LEFT JOIN {{%category}} ca ON c.catId=ca.id WHERE ce.value=$id AND ca.id = 146";
//        $data = \Yii::$app->db->createCommand($sql)->queryOne();
//        return $data['contentId'];
//    }
//    /**
//     * 通过标签获取课程Id
//     * @Obelisk
//     */
//    public function getClassDetails($tagStr,$pid){
//        $count = count(explode(",",$tagStr));
//        $sql = "select c.id from {{%content}} c WHERE c.pid=$pid AND c.id in(select ct.contentId from {{%content_tag}} ct where ct.tagContentId in(".$tagStr.") group by ct.contentId having count(1)=$count ) ";
//        $data = \Yii::$app->db->createCommand($sql)->queryOne();
//        return $data;
//    }
//
//    /**
//     * 获取写作问题列表
//     * @param $category
//     * @return array
//     * @Obelisk
//     */
//    public function getWritingTpo($category){
//        $session  = Yii::$app->session;
//        $userId = $session->get('userId');
//        $sql = "Select c.*,ca.name as catName,ca.id as catId,COUNT(ua.id) as num from {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id LEFT JOIN {{%user_answer}} ua ON ua.contentId=c.id WHERE c.catId IN ($category) GROUP by c.id ORDER BY c.id,c.title ASC";
//        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        $content = [];
//        $k = '';
//        $num =-1;
//        foreach ($data as  $v){
//            if($userId) {
//                $yes = UserAnswer::find()->where("contentId={$v['id']} AND (belong='writingTpo' || belong='writingIndependent') AND userId = $userId")->one();
//                if($yes){
//                    $v['finish'] = 1;
//                }else{
//                    $v['finish'] = 0;
//                }
//            }else{
//                $v['finish'] = 0;
//            }
//            if($k != $v['catName']){
//                $k = $v['catName'];
//                $catId = $v['catId'];
//                $num++;
//            }
//            $content[$num]['catName']=$k;
//            $content[$num]['catId']=$catId;
//            $content[$num]['question'][]=$v;
//        }
//        return $content;
//    }
//    /**
//     * 获取独立话题题目
//     * @param $page
//     * @param int $pageSize
//     * @Obelisk
//     */
//    public function Independence($page,$pageSize=20){
//        $session  = Yii::$app->session;
//        $userId = $session->get('userId');
//        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
//        $sql = "Select c.*,ca.name as catName,COUNT(ua.id) as num from {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id LEFT JOIN {{%user_answer}} ua ON ua.contentId=c.id WHERE c.catId =185  GROUP by c.id ORDER BY c.id $limit ";
//        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        foreach($data as $k =>$v){
//            if($userId) {
//                $yes = UserAnswer::find()->where("contentId={$v['id']} AND (belong='writingTpo' || belong='writingIndependent') AND userId = $userId")->one();
//                if($yes){
//                    $data[$k]['finish'] = 1;
//                }else{
//                    $data[$k]['finish'] = 0;
//                }
//            }else{
//                $data[$k]['finish'] = 0;
//            }
//        }
//        return $data;
//    }
//
//    public function getWritingQuestion($id){
//        $data = \Yii::$app->db->createCommand("
//        select c.*,ca.id as catId,ca.name as catName,(
//        SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//         left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//         WHERE ce.contentId = c.id
//         AND ce.code='32cc8e6f27caf3fdf26e8cfd4e7b4433') as readdata,
//         (SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//         left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//          WHERE ce.contentId = c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655') as file,
//           (SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//         left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//          WHERE ce.contentId = c.id AND ce.code='b34abe997968ee9a0852814db839f75e') as filemsg,
//          (SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//          left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//          WHERE ce.contentId = c.id AND ce.code='1837da083c9ba84649782cda5d7b2cd9') as question,
//          (SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//          left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//          WHERE ce.contentId = c.id AND ce.code='f13fb457229c1aa8261314f4c0497396') as modelone,
//          (SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//           left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//           WHERE ce.contentId = c.id AND ce.code='bb783364b020c8ba9083ae91bc5b569a') as modeltwo,
//           (SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//           left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//           WHERE ce.contentId = c.id AND ce.code='8c81734685cdd7fdb09748976c7b55d3') as modelthree
//           from {{%content}} c
//           LEFT JOIN {{%category}}ca ON c.catId=ca.id
//           WHERE c.id=$id")->queryOne();
//        return $data;
//    }
//
//    /**范文点赞
//     * @param $id
//     * @param $name //modelone :3  modeltwo:4 modelthree:5//
//     * @return array|bool
//     * by fawn
//     *
//     */
//    public function getModelEssayLiked($id,$name){
//        $sql = "Select liked from {{%model_essay_liked}} WHERE contentId =$id AND name='$name'";
//        $data = \Yii::$app->db->createCommand($sql)->queryOne();
//        return $data;
//    }
//
//    /**查询阅读内容
//     * @param $catId
//     * @return array|bool
//     * by fawn
//     */
//    public function getContentByReading($category){
//        $session  = Yii::$app->session;
//        $userId = $session->get('userId');
//        $sql = "Select c.*,ca.name as catName,ca.id as catId,COUNT(ua.id) as num from {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id LEFT JOIN {{%user_answer}} ua ON ua.contentId=c.id WHERE c.catId IN ($category) GROUP by c.id ORDER BY c.catId,c.title ASC";
//        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        $content = [];
//        $k = '';
//        $num =-1;
//        foreach ($data as  $v){
//            if($userId) {
//                $count = $this->find()->where("pid={$v['id']}")->count();
//                $yes = UserAnswer::find()->where("pid={$v['id']} AND (belong='readOg' || belong='readTpo') AND userId = $userId")->count();
//                if($yes == 0){
//                    $v['finish'] = 0;
//                }elseif($yes<$count){
//                    $v['finish'] = 1;
//                }else{
//                    $v['finish'] = 2;
//                }
//            }else{
//                $v['finish'] = 0;
//            }
//            if($k != $v['catName']){
//                $k = $v['catName'];
//                $catId = $v['catId'];
//                $num++;
//            }
//            $content[$num]['catName']=$k;
//            $content[$num]['catId']=$catId;
//            $content[$num]['question'][]=$v;
//        }
//        return $content;
//    }
//
//    /**按题型查询题目
//     * @param $catId
//     * @param $userid
//     * @return array
//     * by fawn
//     */
//    public function getTpoFrom($catId,$userid){
//        $sql = "select id,name from {{%category}} WHERE pid=$catId";
//        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        foreach($data as $k=>$v){
//            //推理题总题数
//            $question = $this->getClass(['category'=>$v['id']]);
//            $sum = count($question);
//            $data[$k]['questionSum'] = !empty($sum)?$sum:0;
//            foreach($question as $key=>$val){
//                //查询用户 $val['id'] + $userid
//                if($val['id'])
//                {
//                    if($userid){
//                        $userAnswer = $this->getUserAnswerRead($val['id'],$userid,'readPattern');
//                        $userNum = count($userAnswer);
//                    }else{
//                        $userNum = 0;
//                    }
//                    $data[$k]['userNum'] = !empty($userNum)?$userNum:0;
//                }
//            }
//        }
//        return $data;
//    }
//
//    /**查询用户是否已做题
//     * @param $contentid
//     * @param $userid
//     * @return array
//     * by fawn
//     */
//    public function getUserAnswerRead($contentid,$userid,$belong='')
//    {
//        $sql = "select contentId from {{%user_answer}} WHERE contentId in($contentid) AND userId=$userid AND belong='$belong' GROUP BY id";
//        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        return $data;
//    }
//
//    /**按ID查询阅读问题
//     * @param $id
//     * @return array|bool
//     * by fawn
//     */
//    public function getReadQuestion($id){
//        $data = \Yii::$app->db->createCommand("select c.*,ca.id as catId,ca.name as catName,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='32cc8e6f27caf3fdf26e8cfd4e7b4433') as question,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='b34abe997968ee9a0852814db839f75e') as article from {{%content}} c LEFT JOIN {{%category}}ca ON c.catId=ca.id WHERE c.id=$id")->queryOne();
//        return $data;
//    }
//
//    /**查询阅读子问题
//     * @param $id
//     * @param $order
//     * @return array|bool
//     * by fawn
//     */
//    public function getReadSonQuestion($id,$title){
//        $data = \Yii::$app->db->createCommand("select c.*,ca.id as catId,ca.name as catName,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='1837da083c9ba84649782cda5d7b2cd9') as question,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='4bf183d69dada92bb0963c4c4b57b55b') as answerA,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='8c81734685cdd7fdb09748976c7b55d3') as answerB,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='bb783364b020c8ba9083ae91bc5b569a') as answerC,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='f13fb457229c1aa8261314f4c0497396') as answerD,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer from {{%content}} c LEFT JOIN {{%category}}ca ON c.catId=ca.id WHERE c.pid=$id AND c.title=$title")->queryOne();
//        return $data;
//    }
//
//    /**详情查询阅读子问题
//     * @param $id
//     * @param $order
//     * @return array|bool
//     * by fawn
//     */
//    public function getReadDetailQuestion($id){
//        $data = \Yii::$app->db->createCommand("select c.*,ca.id as catId,ca.name as catName,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='1837da083c9ba84649782cda5d7b2cd9') as question,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='4bf183d69dada92bb0963c4c4b57b55b') as answerA,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='8c81734685cdd7fdb09748976c7b55d3') as answerB,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='bb783364b020c8ba9083ae91bc5b569a') as answerC,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='f13fb457229c1aa8261314f4c0497396') as answerD,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer from {{%content}} c LEFT JOIN {{%category}}ca ON c.catId=ca.id WHERE c.id=$id")->queryOne();
//        return $data;
//    }
//
//    /**查询某一类问题-列表
//     * @param $pid
//     * @return array
//     * by fawn
//     */
//    public function getQuestionList($pid)
//    {
//        $sql = "select title,id from {{%content}} WHERE pid =$pid  ORDER BY CAST(title as SIGNED) ASC";
//        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        return $data;
//    }
//
//    public function getPostiton($id)
//    {
//        //查询分类ID
//       $content = $this->getContentRead($id,'id');
//        if($content){
//            $catId = $content[0]['catId'];
//            //查询分类下内容
//            $sql_cat = "select id from {{%content}} WHERE catId =$catId";
//            $data_cat = \Yii::$app->db->createCommand($sql_cat)->queryAll();
//            foreach($data_cat as $k=>$v){
//                $cat = $this->getContentRead($v['id'],'pid');
//                $data_cat[$k]['son'] = !empty($cat)?$cat:0;
//                $data_cat[$k]['tpo'] = 'P'.($k+1);
//
//            }
//        }
//        return $data_cat;
//    }
//
//    public function getContentRead($id,$type){
//        $session  = Yii::$app->session;
//        $userId = $session->get('userId');
//        $sql = "select * from {{%content}} WHERE $type=$id ORDER BY CAST(title as SIGNED) ASC";
//        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        foreach($data as $k => $v){
//            if($type=='catId'){
//                if($userId) {
//                    $count = $this->find()->where("pid={$v['id']}")->count();
//                    $yes = UserAnswer::find()->where("pid={$v['id']} AND (belong='readOg' || belong='readTpo') AND userId = $userId")->count();
//                    if($yes == 0){
//                        $data[$k]['finish'] = 0;
//                    }elseif($yes<$count){
//                        $data[$k]['finish'] = 1;
//                    }else{
//                        $data[$k]['finish'] = 2;
//                    }
//                }else{
//                    $data[$k]['finish'] = 0;
//                }
//            }
//        }
//        return $data;
//    }
//
//    public function getReadQuestionId($id,$num){
//        $sql = "select id from {{%content}} WHERE pid=$id ORDER BY CAST(title as SIGNED) ASC Limit $num,1";
//        $data = \Yii::$app->db->createCommand($sql)->queryOne();
//        return $data['id'];
//    }
//
//    /**分题型取题
//     * @param $catid
//     * @param $num
//     * @return mixed
//     * by fawn
//     */
//    public function getPatternQuestion($catid,$userid){
//        $allQuestion =$this->getClass(['category'=>$catid]);//取所有题目
//        //查询用户已做题目
//        $qid = '';
//        foreach($allQuestion as $k=>$v){
//            $userAnswer = $this->getUserAnswerRead($v['id'],$userid,'readPattern');
//            foreach($userAnswer as $a=>$b){
//                $qid .= $b['contentId'] . ",";
//            }
//        }
//        //取出未做题
//        $qid = trim($qid,',');
//        if(!empty($qid)){
//            $where ='c.id not in('.$qid.')';
//        }else{
//            $where ='2=2';
//        }
//        $question = $this->getClass(['category'=>$catid,'pageSize'=>1,'where' => $where]);
//        //全部做完，随机取
//        if(empty($question)){
//            $question = $this->getClass(['category'=>$catid,'order'=>'rand()','pageSize'=>1]);
//        }
//        foreach($question as $q=>$p){
//            //子题目
//            $son = $this->getSonQuestionById($p['id']);
//            //文章
//            $pid = $this->getReadQuestion($p['pid']);
//            $question[$q]['son'] =$son;
//            $question[$q]['ption'] =$pid;
//        }
//        return $question;
//    }
//
//    /**查询OG题
//     * @param $pid
//     * @return array
//     * by fawn
//     */
//    public function getReadOgQuestion($pid,$num){
//        $data = \Yii::$app->db->createCommand("select c.*,ca.id as catId,ca.name as catName,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='1837da083c9ba84649782cda5d7b2cd9') as question,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='4bf183d69dada92bb0963c4c4b57b55b') as answerA,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='8c81734685cdd7fdb09748976c7b55d3') as answerB,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='bb783364b020c8ba9083ae91bc5b569a') as answerC,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='f13fb457229c1aa8261314f4c0497396') as answerD,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer from {{%content}} c LEFT JOIN {{%category}}ca ON c.catId=ca.id WHERE c.pid=$pid ORDER BY title ASC limit $num,1")->queryone();
//        $data['art'] = $this->getReadQuestion($data['pid']);
//        return $data;
//    }
//    /**查询子问题
//     * @param $id
//     * @return array|bool
//     * by fawn
//     */
//    public function getSonQuestionById($id){
//        $data = \Yii::$app->db->createCommand("
//select c.*,ca.id as catId,ca.name as catName,
//(SELECT CONCAT_WS('',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='1837da083c9ba84649782cda5d7b2cd9') as question,
//(SELECT CONCAT_WS('',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='4bf183d69dada92bb0963c4c4b57b55b') as answerA,
//(SELECT CONCAT_WS('',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='8c81734685cdd7fdb09748976c7b55d3') as answerB,
//(SELECT CONCAT_WS('',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='bb783364b020c8ba9083ae91bc5b569a') as answerC,
//(SELECT CONCAT_WS('',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='f13fb457229c1aa8261314f4c0497396') as answerD,
//(SELECT CONCAT_WS('',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer,
//(SELECT CONCAT_WS('',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='28ec209ca256d8e34aea41d0bda50fc4') as postionD,
//(SELECT CONCAT_WS('',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='60883c91048a952f7abe6c666b54648b') as postionW,
//(SELECT CONCAT_WS('',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as questionType,
//(SELECT CONCAT_WS('',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='99c2265aa8cd374b779c95ccbdb5ac2a') as hint
//from {{%content}} c
//LEFT JOIN {{%category}}ca ON c.catId=ca.id WHERE c.id=$id")->queryOne();
//        return $data;
//    }
//
//    public function getCategory($id){
//        $sql = "select ca.name from {{%category}} ca LEFT JOIN {{%content}} c on c.catId=ca.id WHERE c.id=$id";
//        $data = \Yii::$app->db->createCommand($sql)->queryone();
//        return $data['name'];
//    }
//    public function getReadQuestions($id,$num){
//        $data = \Yii::$app->db->createCommand("
//select c.*,ca.id as catId,ca.name as catName,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='1837da083c9ba84649782cda5d7b2cd9') as question,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='4bf183d69dada92bb0963c4c4b57b55b') as answerA,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='8c81734685cdd7fdb09748976c7b55d3') as answerB,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='bb783364b020c8ba9083ae91bc5b569a') as answerC,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='f13fb457229c1aa8261314f4c0497396') as answerD,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='28ec209ca256d8e34aea41d0bda50fc4') as postionD,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='60883c91048a952f7abe6c666b54648b') as postionW,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as questionType,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='99c2265aa8cd374b779c95ccbdb5ac2a') as hint
//from {{%content}} c LEFT JOIN {{%category}}ca ON c.catId=ca.id WHERE c.pid=$id ORDER BY CAST(title as SIGNED) ASC LIMIT $num,1")->queryone();
//        return $data;
//    }
//
//
//    /**
//     * @param $id
//     * @param $num
//     * @return array|bool
//     * @Obelisk
//     */
//    public function getReadTestQuestions($id){
//        $data = \Yii::$app->db->createCommand("
//select c.*,ca.id as catId,ca.name as catName,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='1837da083c9ba84649782cda5d7b2cd9') as question,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='4bf183d69dada92bb0963c4c4b57b55b') as questionContent,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='8c81734685cdd7fdb09748976c7b55d3') as content,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='28ec209ca256d8e34aea41d0bda50fc4') as postionD,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='60883c91048a952f7abe6c666b54648b') as postionW,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as questionType,
//(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce
//left JOIN {{%extend_data}} ed ON ed.extendId=ce.id
//WHERE ce.contentId = c.id AND ce.code='99c2265aa8cd374b779c95ccbdb5ac2a') as hint
//from {{%content}} c LEFT JOIN {{%category}}ca ON c.catId=ca.id WHERE c.id=$id")->queryone();
//        return $data;
//    }
//
//    public function getReadQuestionList($userId,$recordId,$pid,$type){
//        if($type == 2){
//            $testId = HistoryRecord::findOne($recordId);
//            $pidArr = Content::find()->asArray()->where('catId='.$testId->testId)->all();
//            $pidStr = '';
//            foreach($pidArr as $v) {
//                $pidStr .= $v['id'].',';
//            }
//            $pidStr = substr($pidStr,0,-1);
//        }else{
//            $pidStr = $pid;
//        }
//        $data = \Yii::$app->db->createCommand("select c.*,ca.id as catId,ca.name as catName,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='1837da083c9ba84649782cda5d7b2cd9') as question,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='4bf183d69dada92bb0963c4c4b57b55b') as answerA,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='8c81734685cdd7fdb09748976c7b55d3') as answerB,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='bb783364b020c8ba9083ae91bc5b569a') as answerC,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='f13fb457229c1aa8261314f4c0497396') as answerD,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer from {{%content}} c LEFT JOIN {{%category}}ca ON c.catId=ca.id WHERE c.pid in ($pidStr) ORDER BY id ASC ")->queryAll();
//        foreach($data as $k=>$v){
//            $model = new UserAnswer();
//            $userRecord = $model->getUserReadResult($userId,$recordId,$v['id']);
//            $data[$k]['answer'] = !empty($userRecord)?$userRecord['answer']:'▂';
//        }
//        return $data;
//    }
//    /**OG取题
//     * @param $catid
//     * @param $userid
//     * @return array
//     * by fawn
//     */
//    public function getOgQuestion($id,$userid,$type){
//        $allQuestion =$this->getClass(['where' => ' c.pid='.$id,'pageSize'=>100,'order' => 'CAST(c.title as SIGNED) ASC']);//取所有题目
//        $allNum = count($allQuestion);//总数
//        //查询用户已做题目
//        $qid = '';
//        $allId = '';
//        foreach($allQuestion as $k=>$v){
//            $allId .= $v['id'] . ",";
//            if($type=='og'){
//                $readType = 'readOg';
//            }else{
//                $readType = 'readTpo';
//            }
//            $userAnswer = $this->getUserAnswerRead($v['id'],$userid,$readType);
//            foreach($userAnswer as $a=>$b){
//                $qid .= $b['contentId'] . ",";
//            }
//        }
//        //取出未做题
//        $qid = trim($qid,',');
//        $afterNum = count(explode(',',$qid));
//        if(!empty($qid)){
//            $where =' c.pid='.$id.' AND c.id not in('.$qid.')';
//        }else{
//            $where =' c.pid='.$id.' AND 2=2';
//        }
//        $question = $this->getClass(['pageSize'=>1,'where' => $where,'order' => 'CAST(c.title as SIGNED) ASC']);
////        //规则1 ：全部做完，随机取
////        if(empty($question)){
////            $question = $this->getClass(['where' => ' c.pid='.$id,'order'=>'rand()','pageSize'=>1]);
////        }
//        //规则2：全部做完，重新做题
//        $session  = Yii::$app->session;
//        $start = $session->get('start');
//        $readQuestion = $session->get('readQuestion');
//        if($readQuestion == ''){
//            $session->set('readQuestion',$qid);
//        }
//        if(empty($question) && $start==1){
//            $model = new UserAnswer();
//            $allId = trim($allId,',');
//            $model->deleteAll("userId=$userid AND contentId in(".$allId.")");
//            $where =' c.pid='.$id.' AND 2=2';
//            $question = $this->getClass(['pageSize'=>1,'where' => $where,'order' => 'CAST(c.title as SIGNED) ASC']);
//        }
//        $session->set('start',$question[0]['title']);;
//        foreach($question as $q=>$p){
//            //子题目
//            $son = $this->getSonQuestionById($p['id']);
//            //文章
//            $pid = $this->getReadQuestion($p['pid']);
//            $question[$q]['son'] =$son;
//            $question[$q]['ption'] =$pid;
//        }
//        return $question;
//    }
//
//    /**
//     * 根据内容Id 泛听练习内容
//     * @param $id
//     * @Obelisk
//     */
//    public function getPanListensPractice($id){
//        $userId = \Yii::$app->session->get('userId');
//        $pc = \Yii::$app->db->createCommand("select CONCAT_WS(' ',ce.value,ed.value) as value From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id where contentId = $id AND code = '99b3cc02b18ec45447bd9fd59f1cd655'")->queryOne();
//        $offsetTime = \Yii::$app->db->createCommand("select CONCAT_WS(' ',ce.value,ed.value) as value From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id where contentId = $id AND code = '99c2265aa8cd374b779c95ccbdb5ac2a'")->queryOne();
//        $sentence = \Yii::$app->db->createCommand("select tc.id as collectId,c.id,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='28ec209ca256d8e34aea41d0bda50fc4') as section,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='b34abe997968ee9a0852814db839f75e') as sentence,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='c8cc4bd99d4fcfcdfd5673bd635b5bcd') as time,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='11d2dfb57c8f47e7475da15edfcb7eeb') as cnSentence  from {{%content}} c LEFT JOIN {{%tf_collect}} tc ON tc.contentId=c.id AND tc.userId='$userId' where c.pid=$id AND c.id IN ( SELECT cc.contentId FROM {{%category_content}} cc WHERE cc.catId = 49 ) order by id ASC")->queryAll();
//        $section = 0;
//        $content = array();
//        $idNumber = 2000;
//        $start_time = $offsetTime['value']==null?0.5:$offsetTime['value'];
//        $audio_time = 0;
//        $host = \Yii::$app->request->getHostInfo();
//        foreach($sentence as $k => $v){
//            //分段时储存
//            if($v['section'] != $section){
//                $sign = $v['id'];
//                $content['section'][$section]['id'] = $idNumber;
//                $content['section'][$section]['seq'] = $section+1;
//                $content['section'][$section]['start_time'] = $start_time;
//                $content['section'][$section]['audio_time'] = $v['time'];
//                $content['section'][$section]['fav'] = 'false';
//                $section++;
//                $idNumber++;
//                $seq = 1;
//            }
//            if($section == $v['section'] && $sign != $v['id']){
//                $content['section'][$section-1]['audio_time'] += $v['time'];
//            }
//            $content['sentence'][$k]['id'] = $v['id'];
//            $content['sentence'][$k]['content'] = $v['sentence'];
//            $content['sentence'][$k]['cnSentence'] = $v['cnSentence'];
//            $content['sentence'][$k]['parent'] = $content['section'][$section-1]['id'];
//            $content['sentence'][$k]['seq'] = $seq;
//            $content['sentence'][$k]['start_time'] = $start_time;
//            $content['sentence'][$k]['audio_time'] = $v['time'];
//            $content['sentence'][$k]['section'] = $section;
//            $content['sentence'][$k]['fav'] = 'false';
//            $content['sentence'][$k]['collectId'] = $v['collectId'];
//            $start_time += $v['time'];
//            $seq++;
//            $idNumber++;
//        }
//        $content['article'][0]['id'] = 24694;
//        $content['article'][0]['words_num'] = 783;
//        $content['article'][0]['level'] = 0;
//        $content['article'][0]['seq'] = 0;
//        $content['article'][0]['start_time'] = 0;
//        $content['article'][0]['audio_time'] = 306.00;
//        $content['article'][0]['listen_num'] = 16282;
//        $content['article'][0]['listen_people'] = 0;
//        $content['article'][0]['listenCount'] = 0;
//        $content['article'][0]['fav'] = 'false';
//        $content['audio']['id'] = '2263';
//        $content['audio']['name'] = 'TPO-14-L4.mp3';
//        $content['audio']['audio_time'] = '306.00';
//        $content['audio']['content'] = 'null';
//        $content['audio']['title'] = 'TPO-14-L4.mp3';
//        $content['audio']['formatType'] = 'mp3';
//        $content['audio']['filePath'] = $pc['value'];
//        $content['audio']['picPath'] = 'http://img.enhance.cn/toefl/listening-img/TPO/TPO-14-L4.png';
//        $content['audio']['html_content'] = 'null';
//        $content['audio']['type'] = '1';
//        return $content;
//
//    }
//
//
//    //wap
//
//
//    /**
//     * wap 获取听力问题
//     * @param $id
//     * @return array
//     * @Obelisk
//     */
//    public function wapHeardContent($id,$userId){
//        $data = $this->findOne($id);
//        if($data->pid == 0){
//            $pid =$id;
//            if($userId){
//                $contentId = $this->getLastQuestion($userId,$id);
//                if(!$contentId){
//                    $content = $this->find()->asArray()->where("pid=$id AND catId=48")->orderBy("id ASC")->one();
//                    $contentId = $content['id'];
//                }
//            }else{
//                $content = $this->find()->asArray()->where("pid=$id AND catId=48")->orderBy("id ASC")->one();
//                $contentId = $content['id'];
//            }
//        }else{
//            $contentId = $id;
//            $data = $this->findOne($contentId);
//            $pid = $data->pid;
//        }
//        if($userId){
//            \Yii::$app->session->set('startTime',time());
//        }
//        $articleSql = "select c.id,c.image,c.catId,c.name,c.title,ca.name as catName,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655') as file,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='b34abe997968ee9a0852814db839f75e') as text from {{%content}} c left Join {{%category}} ca on c.catId=ca.id where c.id = $pid";
//        $article = \Yii::$app->db->createCommand($articleSql)->queryOne();
//        $questionSql = "select c.id,c.name,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='e4dd05210147f22f9da9bdfcb1c0c562') as fileAdd,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='1837da083c9ba84649782cda5d7b2cd9') as questType,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as questSelect,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655') as file,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer from {{%content}} c where c.id=$contentId AND c.catId=48 order by sort DESC,id ASC";
//        $question = \Yii::$app->db->createCommand($questionSql)->queryOne();
//        $nextId = $this->find()->asArray()->where("pid=$pid AND id>$contentId AND catId=48")->orderBy("id ASC")->limit(1)->one();
//        $over = $this->find()->where("pid=$pid AND id<=$contentId AND catId=48")->orderBy("id ASC")->count();
//        if($nextId){
//            $nextId = $nextId['id'];
//        }else{
//            $nextId = 0;
//        }
//        $count = $this->find()->where("pid=$pid AND catId=48")->count();
//        return ['count' => $count,'over' => $over,'question' => $question,'nextId' => $nextId,'article' => $article];
//    }
//
//    /**
//     * wap 获取口语问题
//     * @param $id
//     * @param $type
//     * @Obelisk
//     */
//    public function wapSpokenContent($id,$type){
//        $token=rand(10000,100000);
//        Yii::$app->session->set("authenticity_token",$token);
//        if($type !=3){
//            if($type == 1){
//                $content = $this->find()->asArray()->where("catId = $id")->orderBy("id ASC")->one();
//                $contentId = $content['id'];
//                $catId = $id;
//            }else{
//                $contentId = $id;
//                $cat = $this->findOne($contentId);
//                $catId = $cat->catId;
//            }
//            $nextId = $this->find()->asArray()->where("catId = $catId AND id>$contentId")->orderBy("id ASC")->one();
//            if($nextId){
//                $nextId = $nextId['id'];
//            }else{
//                $nextId = 0;
//            }
//        }else{
//            $contentId = $id;
//            $nextId = $this->find()->asArray()->where("catId = 145 AND id>$contentId")->orderBy("id ASC")->one();
//            if($nextId){
//                $nextId = $nextId['id'];
//            }else{
//                $nextId = 0;
//            }
//        }
//        $data = $this->getSpokenQuestion($contentId);
//        $model = new UserAnswer();
//        $share = $model->getShare($contentId,10,1);
//        return ['token' => $token,'type' => $type,'data' => $data,'share' => $share,'nextId' => $nextId];
//    }
//
//    /**
//     * wap 获取听力问题
//     * @param $id
//     * @return array
//     * @Obelisk
//     */
//    public function wapReadContent($id,$userId){
//        $data = $this->findOne($id);
//        if($data->pid == 0){
//            $pid =$id;
//            if($userId){
//                $contentId = $this->getReadLastQuestion($id,$userId);
//            }else{
//                $content = $this->find()->asArray()->where("pid=$id AND catId=232")->orderBy("id ASC")->one();
//                $contentId = $content['id'];
//            }
//        }else{
//            $contentId = $id;
//            $data = $this->findOne($contentId);
//            $pid = $data->pid;
//        }
//        if($contentId){
//            //子题目
//            $question = $this->getSonQuestionById($contentId);
//            //文章
//            $article = $this->getReadQuestion($pid);
//            $nextId = $this->find()->asArray()->where("pid=$pid AND id>$contentId AND catId=232")->orderBy("id ASC")->limit(1)->one();
//            $upId = $this->find()->asArray()->where("pid=$pid AND id<$contentId AND catId=232")->orderBy("id desc")->limit(1)->one();
//            if($nextId){
//                $nextId = $nextId['id'];
//            }else{
//                $nextId = 0;
//            }
//            $upId==false?$upId=0:$upId=$upId['id'];
//            $count = $this->find()->where("pid=$pid AND catId=232")->count();
//            return ['count' => $count,'contentId' => $contentId,'question' => $question,'nextId' => $nextId,'article' => $article,'upId'=>$upId];
//        }else{
//            return ['contentId' => $contentId];
//        }
//    }
//
//    public function getReadLastQuestion($id,$userId){
//        $contentId = UserAnswer::find()->asArray()->where("pid=$id AND userId=$userId AND (belong='readTpo' || belong='readOg')")->orderBy("contentId DESC")->one();
//        if($contentId){
//            $content = $this->find()->asArray()->where("pid=$id AND catId=232 AND id>{$contentId['contentId']}")->orderBy("id ASC")->one();
//        }else{
//            $content = $this->find()->asArray()->where("pid=$id AND catId=232")->orderBy("id ASC")->one();
//        }
//        if($content){
//            $contentId = $content['id'];
//        }else{
//            $contentId = 0;
//        }
//
//        return $contentId;
//    }
//
//    /**
//     * 获取购物车列表
//     * @Obelisk
//     */
//    public function getGoods($id){
//        $sql = "select c.id as contentId,c.image,ca.name as catName,ca.id as catId,c.name as contentName,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='0ac9d45187ea22acbadedef8f8ab0e54') as price from  {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id WHERE c.id=$id";
//        $goods = \Yii::$app->db->createCommand($sql)->queryAll();
//        $sql = "select GROUP_CONCAT(c.name) as tag from {{%content_tag}} ct LEFT JOIN {{%content}} c ON c.id=ct.tagContentId WHERE ct.contentId=$id GROUP BY  ct.contentId";
//        $data = \Yii::$app->db->createCommand($sql)->queryOne();
//        $goods[0]['tag'] = $data['tag'];
//        return $goods;
//    }
}
