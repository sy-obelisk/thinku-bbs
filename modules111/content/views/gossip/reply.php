<div class="row control-tit wrapper border-bottom white-bg">
    <span>回复管理</span>
    <a class="addRole" data-toggle="modal" data-target="#replyPost" href="javascript:void (0)">回复本条八卦</a>
</div>
<div class="wrapper wrapper-content">
    <div>
        <?php if ($data) { ?>
            <table class="table-container">
                <th>回复人</th>
                <th>回复内容</th>
                <th>回复时间</th>
                <th>操作</th>
                <?php foreach ($data as $v) { ?>
                    <tr>
                        <td><?php echo $v['uName'] ?></td>
                        <td><?php echo base64_decode($v['content']) ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $v['createTime']); ?></td>
                        <td class="tm">
                            <a data-toggle="modal" data-target="#exampleModal" data-replyId="<?php echo $v['id'] ?>" href="javascript:void (0)">回复</a>&nbsp;
                            <a href="/content/gossip/reply-delete?id=<?php echo $v['id'] ?>">删除</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        } else { ?>
            <table class="table-container">
                <th>并没有什么回复</th>
            </table>
            <?php
        }
        ?>
    </div>
</div>

<div class="modal fade" id="replyPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">回复八卦</h4>
            </div>
            <div class="modal-body">
                <form action="/content/gossip/all-reply" method="post" id="reply_post" >
                    <div class="form-group">
                        <input type="hidden" name="gossipId-1" value="<?php echo $_GET['id'] ?>">
                        <label for="message-text" class="control-label">内容:</label>
                        <textarea class="form-control replyPost" name="contentPost" id="message-text"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" onclick="click_p()">回复</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">回复评论</h4>
            </div>
            <div class="modal-body">
                <form action="/content/gossip/all-reply" method="post" id="replyContent" >
                    <div class="form-group">
                        <input type="hidden" name="gossipId" value="<?php echo $_GET['id'] ?>">
                        <input type="hidden" id="replyId" name="replyId"  value="">
                        <label for="message-text" class="control-label">内容:</label>
                        <textarea class="form-control replyContent" name="content" id="message-text"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" onclick="click_r()">回复</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('replyid') // Extract info from data-* attributes
        var modal = $(this);
        modal.find('#replyId').val(recipient);
    });
    function click_p(){
        var  replyPost = $(".replyPost").val();
        if(replyPost){
            $("#reply_post").submit();
        } else {
            alert("内容不能为空");
            return false;
        }
    }
    function click_r(){
        var  replyContent = $(".replyContent").val();
        if(replyContent){
            $("#replyContent").submit();
        } else {
            alert("内容不能为空");
            return false;
        }
    }
</script>
