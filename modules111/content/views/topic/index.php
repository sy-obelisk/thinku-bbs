<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>
<div class="row control-tit wrapper border-bottom white-bg">
    <span>话题管理</span>
</div>
<div class="wrapper wrapper-content">
    <form action="/content/topic/index" method="get">
        <div>
            用户UID：<input type="text" name="uid" value="<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>">
            时间：<input type="text" class="input-small Wdate" onclick="WdatePicker()" size="10" name="beginTime"
                      value="<?php echo isset($_GET['beginTime']) ? $_GET['beginTime'] : '' ?>">--<input
                class="input-small Wdate" onclick="WdatePicker()" size="10" type="text" name="endTime"
                value="<?php echo isset($_GET['endTime']) ? $_GET['endTime'] : '' ?>">
            话题关键词：<input type="text" name="words" value="<?php echo isset($_GET['words']) ? $_GET['words'] : '' ?>">
            <input type="submit" value="搜索">
        </div>
    </form>
    <div>
        <table class="table-container">
            <th>话题ID</th>
            <th>发表人UID</th>
            <th class="w150">话题</th>
            <th>发表时间</th>
            <th>热门</th>
            <th class="tc-handle">操作</th>
            <?php foreach ($data['data'] as $v) { ?>
                <tr>
                    <td class="tm"><?php echo $v['id'] ?></td>
                    <td class="tm"><?php echo $v['uid'] ?></td>
                    <td class="tm"><?php echo $v['name'] ?></td>
                    <td class="tm"><?php echo date('Y-m-d H:i:s',$v['createTime']) ?></td>
                    <td class="tm"><?php if($v['hot']==1){ ?><a href="/content/topic/hot?id=<?php echo $v['id'] ?>">取消热门</a><?php }else{ ?><a href="/content/topic/hot?id=<?php echo $v['id'] ?>">设置热门</a><?php } ?></td>
                    <td class="tm">
                        <a href="/content/topic/update?id=<?php echo $v['id'] ?>">修改</a>
                        <a href="/content/topic/delete?id=<?php echo $v['id'] ?>">删除</a>
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
        location.href ="/content/topic/index?uid=<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>&beginTime=<?php echo isset($_GET['beginTime']) ? $_GET['beginTime'] : '' ?>&endTime=<?php echo isset($_GET['endTime']) ? $_GET['endTime'] : '' ?>&words=<?php echo isset($_GET['words']) ? $_GET['words'] : '' ?>&page="+page;
    })

    $('.prev').click(function(){
        var page = $('.con-page').find('.on').html();
        if(page == 1){
            return false;
        }else{
            page = parseInt(page)-1;
        }
        location.href ="/content/topic/index?uid=<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>&beginTime=<?php echo isset($_GET['beginTime']) ? $_GET['beginTime'] : '' ?>&endTime=<?php echo isset($_GET['endTime']) ? $_GET['endTime'] : '' ?>&words=<?php echo isset($_GET['words']) ? $_GET['words'] : '' ?>&page="+page;
    })

    $('.next').click(function(){
        var page = $('.con-page').find('.on').html();
        if(page == <?php echo $data['totalPage']?>){
            return false;
        }else{
            page = parseInt(page)+1;
        }
        location.href ="/content/topic/index?uid=<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>&beginTime=<?php echo isset($_GET['beginTime']) ? $_GET['beginTime'] : '' ?>&endTime=<?php echo isset($_GET['endTime']) ? $_GET['endTime'] : '' ?>&words=<?php echo isset($_GET['words']) ? $_GET['words'] : '' ?>&page="+page;
    })
</script>

