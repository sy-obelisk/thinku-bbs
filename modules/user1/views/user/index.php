<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>

<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="/user/index/index">用户模块</a> <span class="divider">/</span></li>
        <li class="active">用户管理</li>
    </ul>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="javascript:;" onclick="javascript:openall();">用户管理</a>
        </li>
        <?php
        foreach($block as $v) {
            ?>
            <?php
            if($v['value'] == 'add') {
                ?>
                <li class="dropdown pull-right">
                    <a href="<?php echo baseUrl?>/user/user/add">添加用户</a>
                </li>
            <?php
            }
            ?>
        <?php
        }
        ?>
    </ul>
    <legend>用户</legend>
    <form action="<?php echo baseUrl?>/user/user/index/" method="get" class="form-horizontal">
        <table class="table">
            <tr>
                <td>
                    用户Id：
                </td>
                <td>
                    <input name="id" class="input-small" size="25" type="text" class="number" value="<?php echo isset($_GET['id'])?$_GET['id']:''?>"/>
                </td>
                <td>
                    注册时间：
                </td>
                <td>
                    <input class="input-small Wdate" onclick="WdatePicker()" type="text" size="10"  name="beginTime" value="<?php echo isset($_GET['beginTime'])?$_GET['beginTime']:''?>"/> - <input class="input-small Wdate" onclick="WdatePicker()"  size="10" type="text" name="endTime"  value="<?php echo isset($_GET['endTime'])?$_GET['endTime']:''?>"/>
                </td>
                <td>
                    用户邮箱：
                </td>
                <td>
                    <input class="input-small" name="email" size="25" type="text" value="<?php echo isset($_GET['email'])?$_GET['email']:''?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    用户电话：
                </td>
                <td>
                    <input name="phone" class="input-small" size="25" type="text" class="number" value="<?php echo isset($_GET['phone'])?$_GET['phone']:''?>"/>
                </td>
                <td>
                    用户名：
                </td>
                <td>
                    <input class="input-small" name="userName" size="25" type="text" value="<?php echo isset($_GET['userName'])?$_GET['userName']:''?>"/>
                </td>
                <td>
                    用户昵称：
                </td>
                <td>
                    <input class="input-small" name="nickname" size="25" type="text" value="<?php echo isset($_GET['nickname'])?$_GET['nickname']:''?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    做题时间：
                </td>
                <td>
                    <input class="input-small Wdate" onclick="WdatePicker()" type="text" size="10"  name="doBeginTime" value="<?php echo isset($_GET['doBeginTime'])?$_GET['doBeginTime']:''?>"/> - <input class="input-small Wdate" onclick="WdatePicker()"  size="10" type="text" name="doEndTime"  value="<?php echo isset($_GET['doEndTime'])?$_GET['doEndTime']:''?>"/>
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
                <th>用户名</th>
<!--                <th>头像</th>-->
                <th>昵称</th>
                <th>电话</th>
                <th>邮箱</th>
                <th>做题数</th>
                <th>模考数</th>
                <th>积分</th>
                <th>备注</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($data as $v) {
                ?>
                <tr>
                    <td><?php echo $v['id']?></td>
                    <td><?php echo $v['userName']?></td>
<!--                    <td><img height="30" width="30" src="--><?php //echo $v['image']?><!--"/></td>-->
                    <td><?php echo $v['nickname']?></td>
                    <td><?php echo $v['phone']?></td>
                    <td><?php echo $v['email']?></td>
                    <td><?php echo $v['questionNum']?></td>
                    <td><?php echo $v['testNum']?></td>
                    <td><?php echo $v['integral']?></td>
                    <td><?php echo $v['remark']?></td>
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
            location.href = "/user/user/delete?url=<?php echo Yii::$app->request->getUrl()?>&id="+id;
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