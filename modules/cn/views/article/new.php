<link rel="stylesheet" href="/cn/css/new-article.css">
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<!--内容区-->
<div class="new-wrap p-container">
<!--路径导航-->
  <ul class="bread-crumb">
    <li><a href="">首页</a><span>&gt;</span><a href="">发帖</a></li>
  </ul>
  <div class="new-classify">
    <select name="clsFirst" id="clsFirst"></select>
    <select name="clsSecond" id="clsSecond"></select>
    <select style="visibility: hidden" name="clsThird" id="clsThird"></select>
  </div>
  <div class="new-title">
    <input type="text" placeholder="请输入标题">
  </div>
  <div class="new-cnt">
    <script id="myEditor" >

    </script>
  </div>
  <div class="sub-btn">
    <button class="put-in">发表</button>
<!--    <button class="save-draft">保存草稿</button>-->
  </div>
</div>
<!--<script src="/cn/js/jquery.SuperSlide.2.1.js"></script>-->
<script src="/cn/js/new-classify.js"></script>
<script src="/cn/js/new-article.js"></script>
<script>
  var ue = UE.getEditor('myEditor');
  _init_area();
</script>