
  <link rel="stylesheet" href="/cn/css/person-cmn.css">
  <link rel="stylesheet" href="/cn/css/person-head.css">

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

      </div>
      <button class="disabled" id="sureBtn">确认上传</button>
    </div>
    <div class="head-up">
      <p>设置我的新头像</p>
      <div>
        <input id="headInput" type="file" accept="image/*">
        <label for="headInput" id="headLabel">上传头像</label>
      </div>
    </div>
  </section>
</div>
  <script>
    $("#headInput").on("change", function(e){
      var file = e.target.files[0]; //获取图片资源
      // 只选择图片文件
      if (!file.type.match('image.*')) {
        return false;
      }
      var reader = new FileReader();
      reader.readAsDataURL(file); // 读取文件
      // 渲染文件
      reader.onload = function(arg) {
        var img = '<img class="preview" src="' + arg.target.result + '" alt="preview"/>';
        $(".preview-box").empty().append(img);
        $('.head-now button').removeClass('disabled').addClass('on');
      }
    });
    $('#sureBtn').click(function () {
      if ($(this).hasClass('on')){
        var form_data = new FormData();
        var file_data = $("#headInput").prop("files")[0];
        form_data.append("image", file_data);
        $.ajax({
          type: "POST", // 上传文件要用POST
          url: "/cn/api/up-image",
          dataType : "json",
          crossDomain: true, // 如果用到跨域，需要后台开启CORS
          processData: false,  // 注意：不要 process data
          contentType: false,  // 注意：不设置 contentType
          data: form_data
        }).success(function(res) {
          console.log(res);
          if (res.code == 0){
            alert(res.message);
          }
        }).fail(function(res) {
          console.log(res);
          alert(res.message);
        });
      }
    })
  </script>
