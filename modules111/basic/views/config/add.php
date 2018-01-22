<style>
    .control-tit {
        margin-top: 10px;
        padding: 15px 20px;
    }
    .addRole{
        padding-left: 50px;
        text-align: right;

    }
</style>

<div class="row control-tit wrapper border-bottom white-bg">
    <a class="addRole" href="/basic/config/index">配置管理</a>
    <span><?php echo $title ?></span>
</div>
<div>
    <form action="/basic/config/add" method="post">
        <input type="hidden" name="id" value="<?php echo isset($data['id'])?$data['id']:'' ?>">
        配置名：<input type="text" name="params" value="<?php echo isset($data['key'])?$data['key']:'' ?>">
        value值：<input type="text" name="value" value="<?php echo isset($data['value'])?$data['value']:'' ?>">
        <input type="submit" value="提交">
    </form>
</div>
