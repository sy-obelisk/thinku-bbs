<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>
<style>
    .tc_mode {
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        text-align: center;
        z-index: 99999;
        background: rgba(0, 0, 0, 0.5);
    }

    .tc_ct {
        margin-top: 10%;
        font-size: 16px;
        display: inline-block;
        vertical-align: middle;
    }

    .yd_l {
        float: left;
        border: none;
        cursor: pointer;
        font-family: 宋体;
        margin-right: 15px;
        display: inline-block;
        font-size: 14px;
        line-height: 30px;
        outline: none;
        box-shadow: rgba(0, 0, 0, 0.157) 0px 0px 1px 1px;
        color: #ffffff !important;
        padding: 0px 13px;
        margin-top: 6px;
        background: #3abfcf !important;
        transition: all ease 0.3s;
    }

    .yd_l:hover {
        background: #479cae !important;
    }

    .qd_bt {
        margin-left: 7px;
        display: inline-block;
        vertical-align: middle;
        background: #ceffe2;
        height: 20px;
        line-height: 20px;
        font-size: 12px;
        color: #3eb4e9;
        padding: 0 10px;
        cursor: pointer;
        border-radius: 5px;
    }

    .qd_bt:hover {
        color: #00a0e9;
        background: #a8e8d4;
    }

    .qd_bt.qx {
        color: #ffffff;
        background: #e99a95;
    }

    .qd_bt.qx:hover {
        background: #e9757d;
    }

    .yd_ct {
        /*display: none;*/
        float: right;
        width: 350px;
        padding-top: 6px;
        white-space: nowrap;
        transform: translateX(360px);
        transition: all ease 0.3s;
    }

    .con-page {
        overflow: hidden;
    }

    .yd_fl_wrap {
        float: left;
        overflow: hidden;
        width: 420px;
        transition: all ease 0.3s;
    }

    .tc_mode .loding_gif {
        position: absolute;
        left: 50%;
        top: 50%;
        margin-top: -12px;
        margin-left: -12px;
        display: block;
        width: 25px;
        height: 25px;
    }
</style>


<div class="row control-tit wrapper border-bottom white-bg">
    <span>帖子管理</span>
    <a class="addRole" href="/content/post/add">添加帖子</a>
</div>
<div class="wrapper wrapper-content">
    <form action="/content/post/index" method="get">
        <div>
            用户UID：<input type="text" name="uid" value="<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>">
            标题：<input type="text" name="title" value="<?php echo isset($_GET['title']) ? $_GET['title'] : '' ?>">
            时间：<input type="text" class="input-small Wdate" onclick="WdatePicker()" size="10" name="beginTime"
                      value="<?php echo isset($_GET['beginTime']) ? $_GET['beginTime'] : '' ?>">--<input
                class="input-small Wdate" onclick="WdatePicker()" size="10" type="text" name="endTime"
                value="<?php echo isset($_GET['endTime']) ? $_GET['endTime'] : '' ?>">
            分类：<input name="type" class="easyui-combotree"
                      value="<?php echo isset($_GET['type']) ? $_GET['type'] : '' ?>"
                      data-options="url:'/content/api/tree?pid=0&id=<?php echo $parent['id'] ?>',method:'get'"
                      style="width:200px;">
            <input type="submit" value="搜索">
        </div>
    </form>
    <div>
        <table class="table-container" style="width: 100%;table-layout: fixed;">
            <th style="width: 60px;"><input type="checkbox" style="margin-right: 5px;" id="all"><label
                    for="all">全选</label></th>
            <th style="width: 50px">排序</th>
            <th style="width: 50px">帖子ID</th>
            <th style="width: 60px">用户ID</th>
            <th>标题</th>
            <th style="width: 300px">图片</th>
            <th>发帖时间</th>
            <th>分类</th>
            <th>热门</th>
            <th>操作</th>
            <?php foreach ($data['data'] as $v) { ?>
                <tr>
                    <td style="text-align: center"><input name="subBox" type="checkbox" value="<?php echo $v['id'] ?>"/>
                    </td>
                    <td><span><input style="width: 30px;" type="text" onkeyup="changeSort(<?php echo $v['id']?>,this)" value="<?php echo $v['sort']?>" name="sort"></span></td>
                    <td><?php echo $v['id'] ?></td>
                    <td><?php echo $v['uid'] ?></td>
                    <td><?php echo $v['title'] ?></td>
                    <td style="width: 50px;overflow: auto;"><?php echo $v['imageContent'] ?></td>
                    <td><?php echo date('Y-m-d H:i:s', $v['createTime']) ?></td>
                    <td><?php echo $v['class'] ?></td>
                    <td><?php if ($v['hot'] == 1) { ?><a href="/content/post/hot?id=<?php echo $v['id'] ?>">
                                取消热门</a><?php } else { ?><a href="/content/post/hot?id=<?php echo $v['id'] ?>">
                                设置热门</a><?php } ?></td>
                    <td><a href="/content/post/post-reply?id=<?php echo $v['id'] ?>">查看回复</a>---<a
                            href="/content/post/update?id=<?php echo $v['id'] ?>">修改</a>---<a
                            href="/content/post/delete?id=<?php echo $v['id'] ?>">删除</a></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <div class="con-page">
            <div class="yd_fl_wrap">
                <span class="yd_l qd_bt">移动</span>
                <div class="yd_ct">
                    分类：<input name="type" class="easyui-combotree"
                              value="<?php echo isset($_GET['type']) ? $_GET['type'] : '' ?>"
                              data-options="url:'/content/api/tree?pid=0&id=<?php echo $parent['id'] ?>',method:'get'"
                              style="width:200px;">
                    <span class="qd_bt qd">确定</span>
                    <span class="qd_bt qx">取消</span>
                </div>
            </div>
            <ul class="pageSize" style="float: right;">
                <?php echo $data['pageStr'] ?>
            </ul>
        </div>
    </div>
</div>
<section class="tc_mode">
    <!--    <div class="tc_ct">-->
    <!--    分类：<input name="type" class="easyui-combotree" value="-->
    <?php //echo isset($_GET['type'])?$_GET['type']:'' ?><!--" data-options="url:'/content/api/tree?pid=0&id=-->
    <?php //echo $parent['id'] ?><!--',method:'get'" style="width:200px;">-->
    <!--        <span class="qd_bt">确定</span>-->
    <!--    </div>-->
    <img class="loding_gif" src="/css/coreCss/new/img/loding.gif" alt="">
</section>
<script type="text/javascript">
    $(function () {
        $("#all").click(function () {
            if (this.checked == true) {
                $("input[name='subBox']").each(function () {
                    this.checked = true;
                });
            } else {
                $("input[name='subBox']").each(function () {
                    this.checked = false;
                });
            }
        });
        $('.yd_l').click(function () {
            $('.yd_ct').css({"transform": "translateX(0)"});
            $('.yd_fl_wrap').css({"transform": "translateX(-70px)"});
        });
        $('.qx').click(function () {
            $('.yd_ct').css({"transform": "translateX(360px)"});
            $('.yd_fl_wrap').css({"transform": "translateX(0)"});
        });
        $('.qd').click(function () {
            var arr = [];
            var catId = $('.yd_fl_wrap .textbox-value').val();
            $("input[name='subBox']").each(function () {
                if (this.checked == true) {
                    arr.push($(this).val());
                }
            });
            if (catId=='') {
                alert('请选择分类！');
                return false;
            } else {
                $.ajax({
                    url: '/content/post/mobile-contents',
                    type: 'get',
                    data: {
                        contents: arr,
                        catid: catId
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        $(".tc_mode").show();
                        //请求前的处理
                    },
                    success: function (data) {
                        $(".tc_mode").hide();
                        alert(data.message);
                        if (data.code != 1) {

                        } else {
                            location.reload();
                        }
                    }
                })
            }


        })

    });
    $('.iPage').click(function () {
        $(this).siblings().removeClass('on');
        $(this).addClass('on');
        var page = $('.con-page').find('.on').html();
        location.href = "/content/post/index?uid=<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>&title=<?php echo isset($_GET['title']) ? $_GET['title'] : '' ?>&beginTime=<?php echo isset($_GET['beginTime']) ? $_GET['beginTime'] : '' ?>&endTime=<?php echo isset($_GET['endTime']) ? $_GET['endTime'] : '' ?>&type=<?php echo isset($_GET['type']) ? $_GET['type'] : '' ?>&page=" + page;
    });

    $('.prev').click(function () {
        var page = $('.con-page').find('.on').html();
        if (page == 1) {
            return false;
        } else {
            page = parseInt(page) - 1;
        }
        location.href = "/content/post/index?uid=<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>&title=<?php echo isset($_GET['title']) ? $_GET['title'] : '' ?>&beginTime=<?php echo isset($_GET['beginTime']) ? $_GET['beginTime'] : '' ?>&endTime=<?php echo isset($_GET['endTime']) ? $_GET['endTime'] : '' ?>&type=<?php echo isset($_GET['type']) ? $_GET['type'] : '' ?>&page=" + page;
    });

    $('.next').click(function () {
        var page = $('.con-page').find('.on').html();
        if (page == <?php echo $data['totalPage']?>) {
            return false;
        } else {
            page = parseInt(page) + 1;
        }
        location.href = "/content/post/index?uid=<?php echo isset($_GET['uid']) ? $_GET['uid'] : '' ?>&title=<?php echo isset($_GET['title']) ? $_GET['title'] : '' ?>&beginTime=<?php echo isset($_GET['beginTime']) ? $_GET['beginTime'] : '' ?>&endTime=<?php echo isset($_GET['endTime']) ? $_GET['endTime'] : '' ?>&type=<?php echo isset($_GET['type']) ? $_GET['type'] : '' ?>&page=" + page;
    });
</script>
<script type="text/javascript">
    function changeSort(_id,_this){
        var sort = $(_this).val();
        $.post("/content/api/change-sort",{id:_id,sort:sort},function(re){
            if(re.code == 0){
                alert('排序失败')
            }
        },'json')
    }
</script>

