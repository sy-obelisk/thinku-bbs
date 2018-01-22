<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>
<div class="row control-tit wrapper border-bottom white-bg">
    <span><a href="/content/post/index">帖子管理</a></span>

</div>
<div class="wrapper wrapper-content">
    <form action="/content/post/reply-add" method="post">
        <input type="hidden" name="postId" value="<?php echo $_GET['id'] ?>">
        回复内容：<input type="text" name="content" value="">
        <input type="submit" value="提交">
    </form>
</div>
</div>