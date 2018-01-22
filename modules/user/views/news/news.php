<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>

<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="/user/index/index">用户模块</a> <span class="divider">/</span></li>
        <li class="active">消息管理</li>
    </ul>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="javascript:;" onclick="javascript:openall();">消息管理</a>
        </li>
        <?php
        foreach($block as $v) {
            ?>
            <?php
            if($v['value'] == 'add') {
                ?>
                <li class="dropdown pull-right">
                    <a href="<?php echo baseUrl?>/user/news/add">发送消息</a>
                </li>
            <?php
            }
            ?>
        <?php
        }
        ?>
    </ul>
    <legend>用户</legend>
    <form action="<?php echo baseUrl?>/user/news/index/" method="get" class="form-horizontal">
        <table class="table">
            <tr>
                <td>
                    收信人Id：
                </td>
                <td>
                    <input name="userId" class="input-small" size="25" type="text" class="number" value="<?php echo isset($_GET['userId'])?$_GET['userId']:''?>"/>
                </td>
                <td>
                    发送时间：
                </td>
                <td>
                    <input class="input-small Wdate" onclick="WdatePicker()" type="text" size="10"  name="beginTime" value="<?php echo isset($_GET['beginTime'])?$_GET['beginTime']:''?>"/> - <input class="input-small Wdate" onclick="WdatePicker()"  size="10" type="text" name="endTime"  value="<?php echo isset($_GET['endTime'])?$_GET['endTime']:''?>"/>
                </td>
                <td>
                    发送人Id：
                </td>
                <td>
                    <input class="input-small" name="sendId" size="25" type="text" value="<?php echo isset($_GET['sendId'])?$_GET['sendId']:''?>"/>
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
                <th>收信人</th>
<!--                <th>头像</th>-->
                <th>信息内容</th>
                <th>发送人</th>
                <th>发送时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($data as $v) {
                ?>
                <tr>
                    <td><?php echo $v['id']?></td>
                    <td><?php echo $v['userId']?></td>
<!--                    <td><img height="30" width="30" src="--><?php //echo $v['image']?><!--"/></td>-->
                    <td><?php echo $v['news']?></td>
                    <td><?php echo $v['sendId']?></td>
                    <td><?php echo date("Y-m-d H:i:s",$v['createTime'])?></td>
                    <td>
                        <div>
                            <?php
                            foreach($block as $val) {
                                ?>
                            <?php if($val['value'] == 'delete') { ?>
                                    <a class="btn"
                                       href="javascript:;" onclick="checkDelete(<?php echo $v['id']?>)"><?php echo $val['name']?></a>
                                <?php
                                }else if($val['value'] != 'add'){
                                    ?>
                                    <a class="btn"
                                       href="<?php echo baseUrl ?>/user/user/<?php echo $val['value'] ?>?id=<?php echo $v['id'] ?>&url=<?php echo Yii::$app->request->getUrl() ?>"><?php echo $val['name'] ?></a>
                                <?php
                                }
                                ?>
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