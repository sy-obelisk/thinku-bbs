<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="<?php echo baseUrl?>/content/category/index">分类管理</a> <span class="divider">/</span></li>
        <li class="active">标签组</li>
    </ul>
    <ul class="nav">
        <?php
        $userId = Yii::$app->session->get('adminId');
        $block = Yii::$app->db->createCommand("select b.* from {{%user_block}} ub LEFT JOIN {{%block}} b ON ub.blockId = b.id WHERE ub.userId = $userId AND b.pid=64")->queryAll();
        ?>
        <?php
        foreach($block as $v) {
        if ($v['value'] == 'add') {
        ?>
        <li class="pull-right">
            <a  href="<?php echo baseUrl?>/content/tag/add?catId=<?php echo $catId?>&type=1" >添加分类标签组</a>
        </li>
        <?php
        }
        }
        ?>
    </ul>
    <legend>标签组</legend>
    <table class="table table-hover">
        <thead>
        <tr>
            <th width="80">ID</th>
            <!--<th width="80">缩略图</th>-->
            <th >标签名称</th>
<!--            <th >属性标题</th>-->
<!--            <th>父级id</th>-->
<!--            <th>分类id</th>-->
<!--            <th>分类名称</th>-->
<!--            <th >继承信息</th>-->
<!--            <th >调用码名称</th>-->
<!--            <th >调用码</th>-->
<!--            <th>能否被删除</th>-->
            <th >操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($data as $v) {
            ?>
            <tr>
                <td><?php echo $v['id']?></td>
                <!--<td><img src="{x2;if:v:extend['thumb']}{x2;v:extend['thumb']}{x2;else}app/core/styles/images/noupload.gif{x2;endif}" alt="" style="width:24px;"/></td>-->
                <td><span><?php echo $v['name']?></span></td>
<!--                <td><span>--><?php //echo $v['title']?><!--</span></td>-->
<!--                <td><span>--><?php //echo $v['pid']?><!--</span></td>-->
<!--                <td><span>--><?php //echo $v['catId']?><!--</span></td>-->
<!--                <td><span>--><?php //echo $v['catName']?><!--</span></td>-->
<!--                <td><span>--><?php //echo isset($v['pr']) && $v['inheritId']?$v['pr']:'未继承'?><!--</span></td>-->
<!--                <td><span>--><?php //echo $v['codeName']?><!--</span></td>-->
<!--                <td><span>--><?php //echo $v['code']?><!--</span></td>-->
<!--                <td><span>--><?php //echo $v['canDelete']?'不能删除':'能删除'?><!--</span></td>-->
                <td>
                    <div>
                        <?php
                        foreach($block as $val) {
                        ?>
                            <?php
                            if($val['value'] != 'add') {
                            ?>
                            <a class="btn"
                               href="<?php echo baseUrl?>/content/tag/<?php echo $val['value']?>?id=<?php echo $v['id']?>"><?php echo $val['name']?></a>
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
    <div class="pagination pagination-right">
        <ul></ul>
    </div>
</div>