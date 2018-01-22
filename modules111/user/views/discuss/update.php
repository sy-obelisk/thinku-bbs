<div class="span10" id="datacontent">

    <ul class="breadcrumb">
        <li><a href="/user/index/index"></a> 用户管理<span class="divider">/</span></li>
        <li><a href="/user/discuss/index">讨论管理</a> <span class="divider">/</span></li>
        <li class="active">修改讨论</li>
    </ul>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#">修改讨论</a>
        </li>
    </ul>
    <form action="/user/discuss/update" method="post" class="form-horizontal">
        <fieldset>
            <div class="control-group">
                <label for="area" class="control-label">评论内容：</label>
                <div class="controls">
                    <textarea name="content" id="area"  value="" /><?php echo $data->discussContent?></textarea>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <button class="btn btn-primary" type="submit">提交</button>
                    <input type="hidden" name="id" value="<?php echo $data->id?>"/>
                    <input type="hidden" name="url" value="<?php echo $url?>" />
                </div>
            </div>
        </fieldset>
    </form>
</div>