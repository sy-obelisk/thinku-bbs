<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>

<!-- 树形菜单选择 -->
<link rel="stylesheet" type="text/css" href="/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="/easyui/themes/icon.css">
<script type="text/javascript" src="/easyui/jquery.easyui.min.js"></script>
<?php
use app\libs\Method;
?>
<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="/content/index/index">内容模块</a> <span class="divider">/</span></li>
        <li class="active">内容管理</li>
    </ul>
    <ul class="nav">
        <?php
        if(isset($_GET['showId'])){
            $id = $_GET['showId'];
        }elseif(isset($_GET['catId'])){
            $id = $_GET['catId'];
        }else{
            $id = "";
        }
        foreach($block as $v) {
            if ($v['value'] == 'add') {
                if($id != ""){
                    $major = \app\modules\cn\models\Category::find()->where("id= $id")->one();
                }
                ?>
                <?php
                if(isset($major)&&$major->isMajor == 1 || $id == '') {
                    ?>
                    <li class="dropdown pull-right">
                        <a class="dropdown-toggle"
                           href="<?php echo baseUrl?>/content/content/add?url=<?php echo Yii::$app->request->getUrl()?>&id=<?php echo $id?>&pid=<?php echo isset($_GET['pid']) ? $_GET['pid'] : 0?>">添加内容</a>
<!--                        <a class="dropdown-toggle" href="--><?php //echo baseUrl?><!--/content/content/batch">批量添加</a>-->
                    </li>
                <?php
                }
                    ?>
            <?php
            }
        }
        ?>
    </ul>
    <form action="<?php echo baseUrl?>/content/content/index/" method="get" class="form-horizontal">
        <table class="table">
            <tr>
                <td>
                    内容ID：
                </td>
                <td>
                    <input name="id" class="input-small" size="25" type="text" class="number" value="<?php echo isset($_GET['id'])?$_GET['id']:''?>"/>
                </td>
                <td>
                    录入时间：
                </td>
                <td>
                    <input class="input-small Wdate" onclick="WdatePicker()" type="text" size="10"  name="beginTime" value="<?php echo isset($_GET['beginTime'])?$_GET['beginTime']:''?>"/> - <input class="input-small Wdate" onclick="WdatePicker()"  size="10" type="text" name="endTime"  value="<?php echo isset($_GET['endTime'])?$_GET['endTime']:''?>"/>
                </td>
                <td>
                    录入人：
                </td>
                <td>
                    <input class="input-small" name="userId" size="25" type="text" value="<?php echo isset($_GET['userId'])?$_GET['userId']:''?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    问题类型：
                </td>
                <td>
                    <input class="input-small" name="questionType" size="25" type="text" value="<?php echo isset($_GET['questionType'])?$_GET['questionType']:''?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary" type="submit">提交</button>
                </td>
                <td></td>
            </tr>
        </table>
    </form>
    <form action="/content/content/sort" method="post">
    <table class="table table-hover add_defined">
        <thead>
        <tr>
            <th width="80">排序</th>
            <th width="80">ID</th>
            <th width="80">PID</th>
            <!--<th width="80">缩略图</th>-->
            <th>内容名称</th>
            <th>内容摘要</th>
            <th>缩略图</th>
            <th>分类</th>
            <?php
             foreach($extendData as $v) {
                 ?>
                 <th><?php echo $v['name']?></th>
             <?php
             }
            ?>
            <th>发布时间</th>
            <th >操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($content as $kss => $v) {
            ?>
            <tr>
                <td class="notSLH"><input style="width: 20px;" name="sort[]" type="text" value="<?php echo $v['sort']?>"></td>
                <input name="id[]" type="hidden" value="<?php echo $v['id']?>">
                <td class="notSLH"><?php echo $v['id']?></td>
                <td class="notSLH"><?php echo $v['pid']?></td>
                <!--<td><img src="{x2;if:v:extend['thumb']}{x2;v:extend['thumb']}{x2;else}app/core/styles/images/noupload.gif{x2;endif}" alt="" style="width:24px;"/></td>-->
                <td><span><?php echo $v['name']?></span></td>
                <td><span><?php echo $v['abstract']?></span></td>
                <td><span><?php echo $v['image']?></span></td>
                <td><span><?php echo $v['caName']?></span></td>
                <?php
                foreach($extendData as $k=>$val) {
                    $name = chr(ord('A') + intval($k));
                    $v[$name] = Method::getextbyhtml($v[$name]);
                    ?>
                    <td <?php echo $val['value'] == ""?"title='$v[$name]'":''?>><span><?php echo $v[$name]?></span></td>
                <?php
                }
                ?>
                <td><span title="<?php echo $v['createTime']?>"><?php echo $v['createTime']?></span></td>
                <td  class="notSLH" style="width: 247px;">
                    <div>
                        <a class="btn" href="<?php echo baseUrl?>/content/content/index?pid=<?php echo $v['id']?>">内容管理</a>
                        <?php
                        foreach($block as $val) {
                            if ($val['value'] != 'add' && $val['value'] != 'sort') {
                                ?>
                                <?php if ($val['value'] == 'delete') { ?>
                                    <a class="btn"
                                       href="javascript:;"
                                       onclick="checkDelete(<?php echo $v['id'] ?>)"><?php echo $val['name'] ?></a>
                                    <?php
                                } else {
                                    ?>
                                    <a class="btn"
                                       href="<?php echo baseUrl ?>/content/content/<?php echo $val['value'] ?>?url=<?php echo Yii::$app->request->getUrl() ?>&id=<?php echo $v['id'] ?>"><?php echo $val['name'] ?></a>
                                    <?php
                                }
                            }
                        }
                        ?>
                        <a class="btn" href="<?php echo baseUrl?>/content/content/index?show=<?php echo $v['show']?>&pid=<?php echo $v['id']?>">
                            <?php if($v['show']==1){
                                echo "隐藏";
                            } else {
                                echo "显示";
                            }
                ?></a>
                        <?php if($v['catId'] == 87 && $v['pid']!=0) { ?>
                            <a class="btn" href = "<?php echo baseUrl?>/content/content/video?pid=<?php echo $v['id']?>" > LIVESDKID</a >
                            <?php
                        }
                        ?>
                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
        <input type="hidden" name="url" value="<?php echo Yii::$app->request->getUrl()?>">
        <button class="push btn btn-primary" type="submit">排序</button>
    </form>
    <div class="pagination pagination-right">
        <?php use yii\widgets\LinkPager;?>
        <?php echo LinkPager::widget([
            'pagination' => $page,
        ])?>
    </div>
</div>
<script>
    function getCheck(){
        var node = $('#tree').tree('getSelected');
        $('input[name="catId"]').val(node.id);
    }
    function checkDelete(id){
        $.post('/content/api/content-delete',{id:id},function(re){
            if(re.code == 1){
                if(confirm("确定删除内容吗")){
                    location.href = "/content/content/delete?url=<?php echo Yii::$app->request->getUrl()?>&id="+id;
                }
            }else{
                if(confirm("该内容含有子内容，是否进行强制删除")){
                    location.href = "/content/content/delete?url=<?php echo Yii::$app->request->getUrl()?>&id="+id;
                }
            }
        },"json")
    }
</script>