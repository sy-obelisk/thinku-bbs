<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="<?php echo baseUrl?>/content/content/index">内容管理</a> <span class="divider">/</span></li>
        <li class="active">标签管理</li>
    </ul>
    <legend>标签管理</legend>
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
            <th>状态</th>
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
                <td><span><?php echo $v['showd'] == 1?'展示':'隐藏'?></span></td>
<!--                <td><span>--><?php //echo $v['pid']?><!--</span></td>-->
<!--                <td><span>--><?php //echo $v['catId']?><!--</span></td>-->
<!--                <td><span>--><?php //echo $v['catName']?><!--</span></td>-->
<!--                <td><span>--><?php //echo isset($v['pr']) && $v['inheritId']?$v['pr']:'未继承'?><!--</span></td>-->
<!--                <td><span>--><?php //echo $v['codeName']?><!--</span></td>-->
<!--                <td><span>--><?php //echo $v['code']?><!--</span></td>-->
<!--                <td><span>--><?php //echo $v['canDelete']?'不能删除':'能删除'?><!--</span></td>-->
                <td>
                    <div>
                            <a class="btn"
                               href="<?php echo baseUrl?>/content/content/tag-show?id=<?php echo $v['id']?>&contentId=<?php echo $contentId?>"><?php echo $v['showd'] == 1?'隐藏':'展示'?></a>

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