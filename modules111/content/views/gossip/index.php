<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>
<div class="row control-tit wrapper border-bottom white-bg">
    <span>备考八卦管理</span>
    <a class="addRole" href="/content/gossip/add">添加八卦</a>
</div>
<div class="wrapper wrapper-content">
    <form action="/content/gossip/index" method="get">
        <div>
            用户UID：<input type="text" name="uid" value="<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>">
            时间：<input type="text" class="input-small Wdate" onclick="WdatePicker()" size="10" name="beginTime"
                      value="<?php echo isset($_GET['beginTime']) ? $_GET['beginTime'] : '' ?>">--<input
                class="input-small Wdate" onclick="WdatePicker()" size="10" type="text" name="endTime"
                value="<?php echo isset($_GET['endTime']) ? $_GET['endTime'] : '' ?>">
            类型：<select name="type" id="">
                <option <?php if ((isset($_GET['type']) ? $_GET['type'] : '') == '') { ?> selected="selected" <?php } ?>
                    value="">选择类型
                </option>
                <option <?php if ((isset($_GET['type']) ? $_GET['type'] : '') == 1) { ?> selected="selected" <?php } ?>
                    value="1">GMAT
                </option>
                <option <?php if ((isset($_GET['type']) ? $_GET['type'] : '') == 2) { ?> selected="selected" <?php } ?>
                    value="2">托福
                </option>
                <option <?php if ((isset($_GET['type']) ? $_GET['type'] : '') == 3) { ?> selected="selected" <?php } ?>
                    value="3">留学
                </option>
                <option <?php if ((isset($_GET['type']) ? $_GET['type'] : '') == 4) { ?> selected="selected" <?php } ?>
                    value="4">雅思
                </option>
            </select>
            <input type="submit" value="搜索">
        </div>
    </form>
    <div>
        <table class="table-container">
            <th>八卦ID</th>
            <th>UID</th>
            <th class="w150">标题</th>
            <th class="w350">内容</th>
            <th class="w250">头像图片</th>
            <th>发表时间</th>
            <th>发表人</th>
            <th>类别</th>
            <th class="tc-handle">操作</th>
            <?php foreach ($data['data'] as $v) { ?>
                <tr>
                    <td class="tm"><?php echo $v['id'] ?></td>
                    <td class="tm"><?php echo $v['uid'] ?></td>
                    <td class="ellipsis"><?php echo base64_decode($v['title']) ?></td>
                    <td><?php echo base64_decode($v['content']) ?></td>
                    <td class="ellipsis"><img src="<?php echo baseUrl.$v['icon'] ?>" alt=""></td>
                    <td class="tm"><?php echo date('Y-m-d H:i:s',$v['createTime']) ?></td>
                    <td class="tm"><?php echo $v['publisher'] ?></td>
                    <td class="tm"><?php if ($v['belong'] == 1) {
                            echo 'GMAT';
                        } elseif ($v['belong'] == 2) {
                            echo '托福';
                        } elseif ($v['belong'] == 3) {
                            echo '留学';
                        } else {
                            echo '雅思';
                        } ?>
                    </td>
                    <td class="tm">
                        <a href="/content/gossip/reply?id=<?php echo $v['id'] ?>">查看回复</a>
                        <a href="/content/gossip/delete?id=<?php echo $v['id'] ?>">删除</a>
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
        location.href ="/content/gossip/index?uid=<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>&beginTime=<?php echo isset($_GET['beginTime']) ? $_GET['beginTime'] : '' ?>&endTime=<?php echo isset($_GET['endTime']) ? $_GET['endTime'] : '' ?>&type=<?php echo isset($_GET['type']) ? $_GET['type'] : '' ?>&page="+page;
    })

    $('.prev').click(function(){
        var page = $('.con-page').find('.on').html();
        if(page == 1){
            return false;
        }else{
            page = parseInt(page)-1;
        }
        location.href ="/content/gossip/index?uid=<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>&beginTime=<?php echo isset($_GET['beginTime']) ? $_GET['beginTime'] : '' ?>&endTime=<?php echo isset($_GET['endTime']) ? $_GET['endTime'] : '' ?>&type=<?php echo isset($_GET['type']) ? $_GET['type'] : '' ?>&page="+page;
    })

    $('.next').click(function(){
        var page = $('.con-page').find('.on').html();
        if(page == <?php echo $data['totalPage']?>){
            return false;
        }else{
            page = parseInt(page)+1;
        }
        location.href ="/content/gossip/index?uid=<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>&beginTime=<?php echo isset($_GET['beginTime']) ? $_GET['beginTime'] : '' ?>&endTime=<?php echo isset($_GET['endTime']) ? $_GET['endTime'] : '' ?>&type=<?php echo isset($_GET['type']) ? $_GET['type'] : '' ?>&page="+page;
    })
</script>

