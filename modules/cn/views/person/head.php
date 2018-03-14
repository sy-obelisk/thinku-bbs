
  <link rel="stylesheet" href="/cn/css/person-cmn.css">
  <link rel="stylesheet" href="/cn/css/person-head.css">
  <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<!--内容区-->
<div class="person p-container clearfix">
  <?php use app\commands\front\PersonWidget;?>
  <?php PersonWidget::begin();?>
  <?php PersonWidget::end();?>
  <!--内容区-->
  <section class="person-cnt head-cnt">
    <div class="head-now">
      <p>当前我的头像</p>
      <div class="preview-box">
        <img src="<?php echo $data['image']!=false?$data['image']:'/cn/images/head.png'?>" alt="">
      </div>
    </div>
    <div class="head-up">
      <p>设置我的新头像</p>
      <div>
        <label for="headInput" id="headLabel">上传头像</label>
      </div>
    </div>
  </section>
  <div id="headPortrait" ></div>
</div>
  <script>
    //实例化编辑器
    var _editor = UE.getEditor('headPortrait');
    _editor.ready(function () {
      _editor.hide();//隐藏编辑器
      //监听图片上传
      _editor.addListener('beforeInsertImage', function (t, arg) {
        $.post('/cn/api/up-image', {image: arg[0].src}, function (re) {
          if (re.code == 0) {
            $('.preview-box img').attr('src', arg[0].src);
            $('.aside-head>div>img').attr('src', arg[0].src);
          } else {
            alert(re.message)
          }
        }, 'json')
      });
    });
    //弹出图片上传的对话框
    $('#headLabel').click(function () {
      var myImage = _editor.getDialog("insertimage");
      myImage.open();
    })

  </script>
