<div class="row control-tit wrapper border-bottom white-bg">
    <span>添加模块</span>
</div>
    <div>
        <form action="/basic/modular/add" method="post">
            <input type="hidden" name="uid" value="<?php  echo $uid?>">
            <input type="hidden" name="id" value="<?php echo isset($data['id'])?$data['id']:'' ?>">
            父级模块：<input name="pid" class="easyui-combotree" value="<?php echo $parent['id'] ?>" data-options="url:'/basic/api/tree?pid=0&id=<?php echo $parent['id'] ?>',method:'get'" style="width:200px;">
            路径：<input type="text" name="modularUrl" value="<?php echo isset($data['path'])?$data['path']:'' ?>">
            模块名：<input type="text" name="modularName" value="<?php echo isset($data['name'])?$data['name']:'' ?>">
            <input type="submit" value="<?php echo isset($data['id'])? '修改':'提交' ?>">
        </form>
    </div>


