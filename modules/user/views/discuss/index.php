<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>

<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="/user/index/index">用户模块</a> <span class="divider">/</span></li>
        <li class="active">讨论管理</li>
    </ul>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="javascript:;" onclick="javascript:openall();">讨论管理</a>
        </li>
    </ul>
    <legend>所有讨论</legend>
    <form action="<?php echo baseUrl?>/user/discuss/index/" method="get" class="form-horizontal">
        <table class="table">
            <tr>
                <td>
                    讨论ID：
                </td>
                <td>
                    <input name="id" class="input-small" size="25" type="text" class="number" value="<?php echo isset($_GET['id'])?$_GET['id']:''?>"/>
                </td>
                <td>
                    创建时间：
                </td>
                <td>
                    <input class="input-small Wdate" onclick="WdatePicker()" type="text" size="10"  name="beginTime" value="<?php echo isset($_GET['beginTime'])?$_GET['beginTime']:''?>"/> - <input class="input-small Wdate" onclick="WdatePicker()"  size="10" type="text" name="endTime"  value="<?php echo isset($_GET['endTime'])?$_GET['endTime']:''?>"/>
                </td>
                <td>
                    用户Id：
                </td>
                <td>
                    <input class="input-small" name="userId" size="25" type="text" value="<?php echo isset($_GET['userId'])?$_GET['userId']:''?>"/>
                </td>
            </tr>
            <tr>
<!--                <td>-->
<!--                    讨论类型：-->
<!--                </td>-->
<!--                <td>-->
<!--                    <select name="type">-->
<!--                        <option value="" --><?php //echo isset($_GET['type'])&&$_GET['type']==""?"selected":''?><!-->全部</option>-->
<!--                        <option value="1" --><?php //echo isset($_GET['type'])&&$_GET['type']==1?"selected":''?><!-->解析</option>-->
<!--                        <option value="2" --><?php //echo isset($_GET['type'])&&$_GET['type']==2?"selected":''?><!-->评论</option>-->
<!--                    </select>-->
<!--                </td>-->
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
                <th><input type="checkbox" class="checkAll"/></th>
                <th width="80">ID</th>
                <th>内容Id</th>
                <th>用户Id</th>
                <th>讨论内容</th>
                <th>讨论类型</th>
                <th>发表时间</th>
                <th>是否发表</th>
                <th >操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($data as $v) {
                ?>
                <tr>
                    <td><input class="childCheck" type="checkbox" name="pushId[]" value="<?php echo $v['id']?>"/></td>
                    <td><?php echo $v['id']?></td>
                    <td><span><?php echo $v['contentId']?></span></td>
                    <td><span><?php echo $v['userId']?></span></td>
                    <td><span><?php echo $v['comment']?></span></td>
                    <td><span><?php echo '评论'?></span></td>
                    <td><span><?php echo $v['createTime']?></span></td>
                    <td><?php echo $v['status']?'<em class="icon-ok">':'<em class="icon-remove">'?></em></td>
                    <td>
                        <div>
                            <?php
                            foreach($block as $val) {
                                ?>
                                <?php if($val['value'] != "publish" && $val['value'] != "no-publish" ) { ?>
                                    <a class="btn"
                                       href="<?php echo baseUrl?>/user/discuss/<?php echo $val['value']?>?id=<?php echo $v['id']?>&url=<?php echo Yii::$app->request->getUrl()?>"><?php echo $val['name']?></a>
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
        <div class="control-group">
            <div class="controls">
                <?php
                foreach($block as $v) {
                    ?>
                    <?php if($v['value'] == "publish") { ?>
                        <button class="push btn btn-primary" type="button"><?php echo $v['name'] ?></button>
                    <?php
                    }elseif($v['value'] == "no-publish") {
                        ?>
                        <button class="noPush btn btn-primary" type="button"><?php echo $v['name'] ?></button>
                    <?php
                    }
                        ?>
                <?php
                }
                ?>
            </div>
        </div>
        <input type="hidden" name="url" value="<?php echo Yii::$app->request->getUrl()?>" />
    </form>
    <div class="pagination pagination-right">
        <?php use yii\widgets\LinkPager;?>
        <?php echo LinkPager::widget([
            'pagination' => $page,
        ])?>
    </div>
</div>
<script>
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
            $("#checkPush").attr('action','/user/discuss/publish');
            $("#checkPush").submit();
        })
        $(".noPush").on('click',function(){
            $("#checkPush").attr('action','/user/discuss/no-publish');
            $("#checkPush").submit();
        })
    })
</script>