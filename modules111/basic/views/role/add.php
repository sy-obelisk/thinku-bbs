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
        <span>角色管理</span>
        <a class="addRole" href="/basic/role/add">添加角色</a>
    </div>
    <div>
        <form action="/basic/role/add" method="post">
            <input type="hidden" name="id" value="<?php echo isset($data['id'])?$data['id']:'' ?>">
            角色名：<input type="text" name="roleName" value="<?php echo isset($data['name'])?$data['name']:'' ?>">
            <input type="submit" value="提交">
        </form>
    </div>


