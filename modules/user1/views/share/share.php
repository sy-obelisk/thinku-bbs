<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>

<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="/user/index/index">用户模块</a> <span class="divider">/</span></li>
        <li class="active">分享管理</li>
    </ul>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="javascript:;" onclick="javascript:openall();">分享管理</a>
        </li>
    </ul>
    <legend>用户</legend>
    <form action="<?php echo baseUrl?>/user/share/index/" method="get" class="form-horizontal">
        <table class="table">
            <tr>
                <td>
                    用户Id：
                </td>
                <td>
                    <input name="userId" class="input-small" size="25" type="text" class="userId" value="<?php echo isset($_GET['userId'])?$_GET['userId']:''?>"/>
                </td>
                <td>
                    分享时间：
                </td>
                <td>
                    <input class="input-small Wdate" onclick="WdatePicker()" type="text" size="10"  name="beginTime" value="<?php echo isset($_GET['beginTime'])?$_GET['beginTime']:''?>"/> - <input class="input-small Wdate" onclick="WdatePicker()"  size="10" type="text" name="endTime"  value="<?php echo isset($_GET['endTime'])?$_GET['endTime']:''?>"/>
                </td>
                <td>
                    题目Id：
                </td>
                <td>
                    <input class="input-small" name="questionId" size="25" type="text" value="<?php echo isset($_GET['questionId'])?$_GET['questionId']:''?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    分享类型：
                </td>
                <td>
                    <select name="belong">
                        <option value="" <?php echo isset($_GET['belong'])&&$_GET['belong']==""?"selected":''?>>全部</option>
                        <option value="1" <?php echo isset($_GET['belong'])&&$_GET['belong']==1?"selected":''?>>写作</option>
                        <option value="2" <?php echo isset($_GET['belong'])&&$_GET['belong']==2?"selected":''?>>口语</option>
                    </select>
                </td>
                <td>
                    名师点评：
                </td>
                <td>
                    <select name="teacher">
                        <option value="" <?php echo isset($_GET['teacher'])&&$_GET['teacher']==""?"selected":''?>>全部</option>
                        <option value="1" <?php echo isset($_GET['teacher'])&&$_GET['teacher']==1?"selected":''?>>是</option>
                        <option value="2" <?php echo isset($_GET['teacher'])&&$_GET['teacher']==2?"selected":''?>>否</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary" type="submit">提交</button>
                </td>
            </tr>
        </table>
    </form>
    <form action="/user/discuss/publish" id="checkPush" method="post">
        <table class="table table-hover">
            <thead>
            <tr>
                <th width="80">ID</th>
                <th>题目Id</th>
<!--                <th>头像</th>-->
                <th>用户Id</th>
                <th>用户名</th>
                <th>分享内容</th>
                <th>是否邀请名师点评</th>
                <th>点赞数</th>
                <th>分享时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($data as $v) {
                ?>
                <tr>
                    <td><?php echo $v['id']?></td>
                    <td><?php echo $v['contentId']?></td>
<!--                    <td><img height="30" width="30" src="--><?php //echo $v['image']?><!--"/></td>-->
                    <td><?php echo $v['userId']?></td>
                    <td><?php echo $v['userName']?></td>
                    <td><?php echo $v['shareContent']?></td>
                    <td><?php echo $v['belong'] == 'spoken'?'口语':'写作'?></td>
                    <td><?php echo $v['teacher']?'是':'否'?></td>
                    <td><?php echo $v['liked']?></td>
                    <td><?php echo date("Y-m-d H:i:s",$v['shareTime'])?></td>
                    <td>
                        <div>
                            <?php
                            foreach($block as $val) {
                                ?>
                                <a class="btn"
                                   href="<?php echo baseUrl ?>/user/share/<?php echo $val['value'] ?>?userId=<?php echo $v['userId'] ?>"><?php echo $val['name'] ?></a>
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
    </form>
    <div class="pagination pagination-right">
        <?php use yii\widgets\LinkPager;?>
        <?php echo LinkPager::widget([
            'pagination' => $page,
        ])?>
    </div>
</div>
<script type="text/javascript">
    function checkDelete(id){
        if(confirm("确定删除用户吗？删除后用户资料将不可恢复")){
            location.href = "/user/news/delete?url=<?php echo Yii::$app->request->getUrl()?>&id="+id;
        }

    }
    $(function() {
        $(".checkAll").change(function () {
            var sss = $(this).is(":checked");
            if(sss){
                $(".childCheck").prop("checked", true);
            }else{
                $(".childCheck").prop("checked", false);
            }
        })

        $(".push").on('click',function(){
            $("input[name='status']").val(1);
            $("#checkPush").submit();
        })
        $(".noPush").on('click',function(){
            $("input[name='status']").val(0);
            $("#checkPush").submit();
        })
    })
</script>