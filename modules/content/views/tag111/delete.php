
<div class="span10" id="datacontent">
    <form action="<?php echo baseUrl?>/content/extend/delete" method="post" class="form-horizontal">
        <fieldset>
            <div class="control-group">
                <div class="controls" id="checkbox_digui">
                    <input type="radio" name="status" value="1"/> 删除本身&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="status" value="2"/> 子类删除&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="status" value="3"/> 递归删除&nbsp;&nbsp;&nbsp;
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input name="id" type="hidden" value="<?php echo isset($id)?$id:''?>">
                    <input type="submit"  class="btn btn-primary" value="提交">
                </div>
            </div>
        </fieldset>
    </form>
</div>