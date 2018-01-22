<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>
<div class="row control-tit wrapper border-bottom white-bg">
    <span>问题管理</span>
</div>
<div class="wrapper wrapper-content">
    <form action="/content/question/index" method="get">
        <div>
            用户UID：<input type="text" name="uid" value="<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>">
            时间：<input type="text" class="input-small Wdate" onclick="WdatePicker()" size="10" name="beginTime"
                      value="<?php echo isset($_GET['beginTime']) ? $_GET['beginTime'] : '' ?>">--<input
                class="input-small Wdate" onclick="WdatePicker()" size="10" type="text" name="endTime"
                value="<?php echo isset($_GET['endTime']) ? $_GET['endTime'] : '' ?>">
            问题关键词：<input type="text" name="words" value="<?php echo isset($_GET['words']) ? $_GET['words'] : '' ?>">
            话题：
            <select name="topic" id="">
                <option value="" <?php if ((isset($_GET['topic']) ? $_GET['topic'] : '') == '') { ?> selected="selected" <?php } ?>>请选择话题</option>
                <?php foreach($topic as $v) { ?>
                    <option value="<?php echo $v['id'] ?>" <?php if ((isset($_GET['topic']) ? $_GET['topic'] : '') == $v['id']) { ?> selected="selected" <?php } ?>><?php echo $v['name'] ?> </option>
                    <?php
                }
                ?>
            </select>
            <input type="submit" value="搜索">
        </div>
    </form>
    <div>
        <table class="table-container">
            <th>问题ID</th>
            <th>发表人UID</th>
            <th class="w150">问题</th>
            <th class="w350">问题详情</th>
            <th>发表时间</th>
            <th class="tc-handle">操作</th>
            <?php foreach ($data['data'] as $v) { ?>
                <tr>
                    <td class="tm"><?php echo $v['id'] ?></td>
                    <td class="tm"><?php echo $v['uid'] ?></td>
                    <td class="tm"><?php echo $v['title'] ?></td>
                    <td class="tm"><?php echo $v['content'] ?></td>
                    <td class="tm"><?php echo date('Y-m-d H:i:s',$v['createTime']) ?></td>
                    <td class="tm">
                        <a href="/content/question/answer?id=<?php echo $v['id'] ?>">查看回答</a>
                        <a href="/content/question/delete?id=<?php echo $v['id'] ?>">删除</a>
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
        location.href ="/content/question/index?uid=<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>&beginTime=<?php echo isset($_GET['beginTime']) ? $_GET['beginTime'] : '' ?>&endTime=<?php echo isset($_GET['endTime']) ? $_GET['endTime'] : '' ?>&words=<?php echo isset($_GET['words']) ? $_GET['words'] : '' ?>&page="+page;
    })

    $('.prev').click(function(){
        var page = $('.con-page').find('.on').html();
        if(page == 1){
            return false;
        }else{
            page = parseInt(page)-1;
        }
        location.href ="/content/question/index?uid=<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>&beginTime=<?php echo isset($_GET['beginTime']) ? $_GET['beginTime'] : '' ?>&endTime=<?php echo isset($_GET['endTime']) ? $_GET['endTime'] : '' ?>&words=<?php echo isset($_GET['words']) ? $_GET['words'] : '' ?>&page="+page;
    })

    $('.next').click(function(){
        var page = $('.con-page').find('.on').html();
        if(page == <?php echo $data['totalPage']?>){
            return false;
        }else{
            page = parseInt(page)+1;
        }
        location.href ="/content/question/index?uid=<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>&beginTime=<?php echo isset($_GET['beginTime']) ? $_GET['beginTime'] : '' ?>&endTime=<?php echo isset($_GET['endTime']) ? $_GET['endTime'] : '' ?>&words=<?php echo isset($_GET['words']) ? $_GET['words'] : '' ?>&page="+page;
    })
</script>

