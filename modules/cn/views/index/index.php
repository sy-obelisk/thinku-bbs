<?php foreach ($data as $k=>$v){?>

    <a href="/download/<?php echo $v['id']?>.html">下载</a>
<?php }?>
<!--<script src="https://cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>-->
<script src="/js/jquery-1.7.2.min.js"></script>
<script>
    function del(id) {
        $.ajax({
            type: 'post',
            url: "/cn/index/download",
//            xhrFields: {
//                withCredentials: true
//            },
            data : {
                id:id
            },
            dataType: 'text',
            success: function (msg) {
                if (msg) {
                    alert('msg');
                }
            }
        });
    }
</script>
