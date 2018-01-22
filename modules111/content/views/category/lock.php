<div class="row control-tit wrapper border-bottom white-bg">
    <span>分类加锁</span>-------<span><?php echo isset($data['name'])?$data['name']:'' ?></span>
</div>
    <div>
        <form action="/content/category/lock" method="post">
            <input type="hidden" name="id" value="<?php echo isset($data['id'])?$data['id']:'' ?>">
            分类加密：
            <select name="encryptionMode" id="encryptionMode">
                <option value="0" <?php if($data['keyTag']==0){ ?> selected = "selected" <?php } ?>>无锁</option>
                <option value="1" <?php if($data['keyTag']==1){ ?> selected = "selected" <?php } ?>>密码锁</option>
                <option value="2" <?php if($data['keyTag']==2){ ?> selected = "selected" <?php } ?>>角色锁</option>
            </select>

            <span class="addSelect">
                <?php if($data['keyTag']==1) { ?>
                    密码：<input type="text" name="passKey" value="<?php echo $data['passKey'] ?>">
                    <?php
                } elseif($data['keyTag']==2) { ?>
                    角色：
                    <select name="roleKey" id="">
                        <?php foreach($role as $v) { ?>
                            <option value="<?php echo $v['id'] ?>" <?php if($data['passKey']==$v['id']){ ?> selected = "selected" <?php } ?> ><?php echo $v['name'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                }
                ?>
            </span>
            <input type="submit" value="<?php echo isset($data['id'])? '修改':'提交' ?>">
        </form>
    </div>
<script>
    $('#encryptionMode').on("change",function(){
        var type = $(this).val();
        var str = "";
        $('.addSelect').empty();
        if(type==1){
            str = '<input type="text" name="passKey">';
            $('.addSelect').html(str);
        } else if(type==2){
            $.post("/content/api/get-role",{},function(re){
                str +='<select name="roleKey">';
                for (var i = 0; i < re.length; i++) {
                    str +='<option value="'+re[i].id+'">'+re[i].name+'</option>';
                }
                str +='</select>';
                $('.addSelect').html(str);
            },'json');
        }
    });
</script>


