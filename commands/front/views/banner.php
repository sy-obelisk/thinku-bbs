<div id="myCarousel" class="pull-left carousel slide">
    <!-- 轮播（Carousel）指标 -->
    <ol class="carousel-indicators">
        <?php foreach ($pic as $k=>$v){
            if($k==0){
                echo '<li data-target="#myCarousel" data-slide-to="'.$k.'" class="active"></li>';
            }else{
                echo '<li data-target="#myCarousel" data-slide-to="'.$k.'"></li>';
            }
        }?>

    </ol>
    <!-- 轮播（Carousel）项目 -->
    <div class="carousel-inner">
        <?php foreach($pic as $k=>$v){
            if($k==0){
                echo '<div class="item active">';
            }else{
                echo '<div class="item">';
            }
            echo '<a href="'.$v['url'].'"> <img src="'.$v['pic'].'" alt="'.$v['alt'].'"></a>
                    </div>';
        }?>
    </div>
    <!-- 轮播（Carousel）导航 -->
    <a class="carousel-control s-left" href="#myCarousel"
       data-slide="prev">&lt;</a>
    <a class="carousel-control s-right" href="#myCarousel"
       data-slide="next">&gt;</a>
</div>
<script>
    $('#myCarousel').carousel({
        interval: 3000
    })
</script>