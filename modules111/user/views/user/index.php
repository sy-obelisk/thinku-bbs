<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>
<div class="row control-tit wrapper border-bottom white-bg">
    <span>用户管理</span>----
    <span><a href="/user/user/add-user">添加用户</a></span>
</div>


    <form action="/user/user/index" method="get">
        <div>
            用户UID：<input type="text" name="uid" value="<?php echo isset($_GET['uid'])?$_GET['uid']:'' ?>">
            用户名：<input type="text" name="userName" value="<?php echo isset($_GET['userName'])?$_GET['userName']:'' ?>">
            昵称：<input type="text" name="nickName" value="<?php echo isset($_GET['nickName'])?$_GET['nickName']:'' ?>">
            邮箱：<input type="text" name="email" value="<?php echo isset($_GET['email'])?$_GET['email']:'' ?>">
            电话：<input type="text" name="phone" value="<?php echo isset($_GET['phone'])?$_GET['phone']:'' ?>">
            <input type="submit" value="搜索">
        </div>
    </form>
    <div>
        <table class="table-container">
            <thead>
            <tr>
            <th>UID</th>
            <th>用户名</th>
            <th>昵称</th>
            <th>角色</th>
            <th>电话</th>
            <th>邮箱</th>
            <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($data['data'] as $v){ ?>
                <tr>
                    <td><?php echo $v['uid'] ?></td>
                    <td><?php echo $v['username'] ?></td>
                    <td><?php echo $v['nickname'] ?></td>
                    <td><?php echo $v['name'] ?></td>
                    <td><?php echo $v['phone'] ?></td>
                    <td><?php echo $v['email'] ?></td>
                    <td><?php if($roleId==1){ ?><a href="/user/user/update?id=<?php echo $v['uid'] ?>&url=<?php echo Yii::$app->request->getUrl() ?>">修改角色</a>----<?php } ?><a href="/user/user/update-integral?id=<?php echo $v['uid'] ?>&url=<?php echo Yii::$app->request->getUrl() ?>">修改积分</a> <a href="/user/user/update-pass?id=<?php echo $v['uid'] ?>&url=<?php echo Yii::$app->request->getUrl() ?>">修改密码</a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="con-page">
            <ul class="pageSize">
                <?php echo  $data['pageStr'] ?>
            </ul>
        </div>
    </div>

<script type="text/javascript">
    $('.iPage').click(function(){
        $(this).siblings().removeClass('on');
        $(this).addClass('on');
        var page = $('.con-page').find('.on').html();
        location.href ="/user/user/index?uid=<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>&userName=<?php echo isset($_GET['userName']) ? $_GET['userName'] : '' ?>&nickName=<?php echo isset($_GET['nickName']) ? $_GET['nickName'] : '' ?>&role=<?php echo isset($_GET['role']) ? $_GET['role'] : '' ?>&email=<?php echo isset($_GET['email']) ? $_GET['email'] : '' ?>&phone=<?php echo isset($_GET['phone']) ? $_GET['phone'] : '' ?>&page="+page;
    })

    $('.prev').click(function(){
        var page = $('.con-page').find('.on').html();
        if(page == 1){
            return false;
        }else{
            page = parseInt(page)-1;
        }
        location.href ="/user/user/index?uid=<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>&userName=<?php echo isset($_GET['userName']) ? $_GET['userName'] : '' ?>&nickName=<?php echo isset($_GET['nickName']) ? $_GET['nickName'] : '' ?>&role=<?php echo isset($_GET['role']) ? $_GET['role'] : '' ?>&email=<?php echo isset($_GET['email']) ? $_GET['email'] : '' ?>&phone=<?php echo isset($_GET['phone']) ? $_GET['phone'] : '' ?>&page="+page;
    })

    $('.next').click(function(){
        var page = $('.con-page').find('.on').html();
        if(page == <?php echo $data['totalPage']?>){
            return false;
        }else{
            page = parseInt(page)+1;
        }
        location.href ="/user/user/index?uid=<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>&userName=<?php echo isset($_GET['userName']) ? $_GET['userName'] : '' ?>&nickName=<?php echo isset($_GET['nickName']) ? $_GET['nickName'] : '' ?>&role=<?php echo isset($_GET['role']) ? $_GET['role'] : '' ?>&email=<?php echo isset($_GET['email']) ? $_GET['email'] : '' ?>&phone=<?php echo isset($_GET['phone']) ? $_GET['phone'] : '' ?>&page="+page;
    })
</script>
