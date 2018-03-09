<link rel="stylesheet" href="/cn/css/new-article.css">
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<!--<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>-->
<!--内容区-->
<div class="new-wrap p-container">
<!--路径导航-->
  <ul class="bread-crumb">
    <li><a href="/index.html">首页</a><span>&gt;</span><a href="">发帖</a></li>
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
  <div class="sub-btn clearfix">
    <button id="upBtn" class="up-data">上传资料</button>
    <button class="put-in">发表</button>
<!--    <button class="save-draft">保存草稿</button>-->
  </div>
  <!--上传的文件-->
  <div class="upload_file clearfix">
    <div class="fl relative">
      <ul class="upload_file_wrap"></ul>
    </div>
  </div>
</div>
<!--<script src="/cn/js/jquery.SuperSlide.2.1.js"></script>-->
<script src="/cn/js/new-classify.js"></script>
<script src="/cn/js/new-article.js"></script>

<script type="text/javascript">
  _init_area();
  //实例化编辑器
  var o_ueditorupload = UE.getEditor('j_ueditorupload',
    {
      autoHeightEnabled:false
    });
  o_ueditorupload.ready(function ()
  {
    o_ueditorupload.hide();//隐藏编辑器
    //监听图片上传
    o_ueditorupload.addListener('beforeInsertImage', function (t,arg)
    {
      $('.imageFile').val(arg[0].src);
    });
    /* 文件上传监听
     * 需要在ueditor.all.min.js文件中找到
     * d.execCommand("insertHtml",l)
     * 之后插入d.fireEvent('afterUpfile',b)
     */
    o_ueditorupload.addListener('afterUpfile', function (t, arg)
    {
//      console.log(arg);
      var str = '';
      for(var i=0;i<arg.length;i++){
        str +='<li>';
        str +='<img src="/cn/images/cloud_1.png" alt="">';
        str +='<span class="file_name">'+arg[i].title+'</span>';
        str +='<img class="remove_btn" src="/cn/images/remove_1.png" alt="" onclick="deleteFile(this)">';
        str +='<input class="datum" type="hidden" name="data[datum][]" value="'+arg[i].url+'">';
        str +='<input class="datumTitle" type="hidden" name="data[datumTitle][]" value="'+arg[i].title+'">';
        str +='</li>';
      }
      $('.upload_file_wrap').append(str);
    });
  });
  function deleteFile(_this){
    $(_this).closest('li').remove();
  }
  $(function () {
    // 上传文件面板显示
    $('#upBtn').click(function () {
      var myFiles = o_ueditorupload.getDialog("attachment");
      myFiles.open();
    })
  })
</script>
<script type="text/plain" id="j_ueditorupload"></script>