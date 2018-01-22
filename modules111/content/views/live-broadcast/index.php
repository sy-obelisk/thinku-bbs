<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>
<div class="row control-tit wrapper border-bottom white-bg">
    <span>直播管理</span>
    <a class="addRole" href="/content/live-broadcast/add">添加直播</a>
</div>
<div class="wrapper wrapper-content">
    <div>
        <table class="table-container">
            <th>ID</th>
            <th>直播标题</th>
            <th>开播时间</th>
            <th class="w150">结束时间</th>
            <th class="w350">宣传时间</th>
            <th>发表时间</th>
            <th class="tc-handle">操作</th>
            <?php foreach ($data['data'] as $v) { ?>
                <tr>
                    <td class="tm"><?php echo $v['id'] ?></td>
                    <td class="tm"><?php echo $v['title'] ?></td>
                    <td class="tm"><?php echo date('Y-m-d H:i:s',$v['startTime']) ?></td>
                    <td class="tm"><?php echo date('Y-m-d H:i:s',$v['endTime']) ?></td>
                    <td class="tm"><?php echo date('Y-m-d H:i:s',$v['psvTime']) ?></td>
                    <td class="tm"><?php echo date('Y-m-d H:i:s',$v['createTime']) ?></td>
                    <td class="tm">
                        <a href="/content/live-broadcast/add?id=<?php echo $v['id'] ?>">修改</a>
                        <a href="/content/live-broadcast/delete?id=<?php echo $v['id'] ?>">删除</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <div class="con-page">
            <ul class="pageSize">
                <?php echo $data['pageStr'] ?>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.iPage').click(function(){
        $(this).siblings().removeClass('on');
        $(this).addClass('on');
        var page = $('.con-page').find('.on').html();
        location.href ="/content/live-broadcast/index?page="+page;
    })

    $('.prev').click(function(){
        var page = $('.con-page').find('.on').html();
        if(page == 1){
            return false;
        }else{
            page = parseInt(page)-1;
        }
        location.href ="/content/live-broadcast/index?page="+page;
    })

    $('.next').click(function(){
        var page = $('.con-page').find('.on').html();
        if(page == <?php echo $data['totalPage']?>){
            return false;
        }else{
            page = parseInt(page)+1;
        }
        location.href ="/content/live-broadcast/index?page="+page;
    })
</script>

