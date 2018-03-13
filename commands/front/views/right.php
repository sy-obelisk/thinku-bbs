<!--侧边栏-->
<aside class="aside">
    <ul class="posted">
        <li><a href="/new-article.html"><i class="iconfont icon-hot"></i>我要发帖</a></li>
        <li class="aside-question"><a href="javascript:void(0)"><i class="iconfont icon-hot"></i>我要提问</a></li>
    </ul>
    <!--签到-->
    <div class="sign-in">
        <div class="icon">
            <i class="iconfont icon-hot"></i>
            签到
        </div>
        <div class="num">
            <p>今日签到人数</p>
            <p><?php echo $number?></p>
            <p><?php echo $isSign!=false?'今日已签到':'你还未签到'?></p>
        </div>
    </div>
    <!--论坛公告-->
    <div class="announce">
        <div class="title"></div>
        <div class="cnt">
            【刷词团】号外！号外！GRE填空1200精选专项刷词团强烈来袭~

            刷词内容：雷哥GRE独家整理的鸡精填空选项词1200个+对应填空真题训练

            2018年1月22日开刷！
            报名添加小G君微信：1746295647
        </div>
    </div>
    <!--我要留学-->
    <div class="abroad">
        <div class="title"></div>
        <ul>
            <li><a href="http://www.thinkwithu.com/USA.html">美国</a></li>
            <li><a href="http://www.thinkwithu.com/UK.html">英国</a></li>
            <li><a href="http://www.thinkwithu.com/AUS.html">澳洲</a></li>
            <li><a href="http://www.thinkwithu.com/COUNTRY.html">加拿大</a></li>
            <li><a href="http://www.thinkwithu.com/HK.html">香港</a></li>
            <li><a href="http://www.thinkwithu.com/COUNTRY.html">新加坡</a></li>
            <li><a href="http://www.thinkwithu.com/COUNTRY.html">法国</a></li>
            <li><a href="http://www.thinkwithu.com/COUNTRY.html">其他</a></li>
        </ul>
    </div>
    <!--我要考试-->
    <div class="test">
        <div class="title"></div>
        <ul>
            <li><a href="http://www.gmatonline.cn/index.html">GMAT</a></li>
            <li><a href="http://www.greonline.cn/">GRE</a></li>
            <li><a href="http://www.toeflonline.cn/">托福</a></li>
            <li><a href="http://ielts.viplgw.cn/">雅思</a></li>
            <li><a href="http://www.thinkusat.com/">SAT</a></li>
            <li><a href="http://www.thinkusat.com/act.html">ACT</a></li>
            <li><a href="http://www.thinkwithu.com/">AP</a></li>
        </ul>
    </div>
    <!--我要规划-->
<!--    <div class="project">-->
<!--        <div class="title"></div>-->
<!--        <div class="project-box p-prorank-box">-->
<!--            <div class="hd">-->
<!--                <ul>-->
<!--                    <li class="on">北美</li>-->
<!--                    <li>欧洲</li>-->
<!--                    <li>其他</li>-->
<!--                </ul>-->
<!--            </div>-->
<!--            <div class="bd">-->
<!--              <ul>-->
<!--                <li><a href=""><span style="background-color: #e92b3b">1</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span style="background-color: #e98a52">2</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span style="background-color: #22ada2">3</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>-->
<!--              </ul>-->
<!--              <ul>-->
<!--                <li><a href=""><span style="background-color: #e92b3b">1</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span style="background-color: #e98a52">2</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span style="background-color: #22ada2">3</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>-->
<!--              </ul>-->
<!--              <ul>-->
<!--                <li><a href=""><span style="background-color: #e92b3b">1</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span style="background-color: #e98a52">2</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span style="background-color: #22ada2">3</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>-->
<!--                <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>-->
<!--              </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <!--热帖排行-->
    <div class="ranking">
        <div class="title"></div>
        <div class="ranking-box p-prorank-box">
            <div class="hd">
                <ul>
                    <li class="on">今日热榜</li>
                    <li>一周精华</li>
                </ul>
            </div>
            <div class="bd">
                <ul>
                    <?php foreach($dayHot as $k=>$v){?>
                        <?php if($k==0){?>
                    <li><a href="/details/<?php echo $v['id']?>.html"><span style="background-color: #e92b3b"><?php echo $k+1?></span><?php echo $v['name']?></a></li>
                        <?php }elseif($k==1){?>
                    <li><a href="/details/<?php echo $v['id']?>.html"><span style="background-color: #e98a52"><?php echo $k+1?></span><?php echo $v['name']?></a></li>
                        <?php }elseif($k==2){?>
                    <li><a href="/details/<?php echo $v['id']?>.html"><span style="background-color: #22ada2"><?php echo $k+1?></span><?php echo $v['name']?></a></li>
                        <?php }else{?>
                    <li><a href="/details/<?php echo $v['id']?>.html"><span><?php echo $k+1?></span><?php echo $v['name']?></a></li>
                        <?php }}?>
                </ul>
                <ul>
                    <?php foreach($weekHot as $k=>$v){?>
                        <?php if($k==0){?>
                            <li><a href="/details/<?php echo $v['id']?>.html"><span style="background-color: #e92b3b"><?php echo $k+1?></span><?php echo $v['name']?></a></li>
                        <?php }elseif($k==1){?>
                            <li><a href="/details/<?php echo $v['id']?>.html"><span style="background-color: #e98a52"><?php echo $k+1?></span><?php echo $v['name']?></a></li>
                        <?php }elseif($k==2){?>
                            <li><a href="/details/<?php echo $v['id']?>.html"><span style="background-color: #22ada2"><?php echo $k+1?></span><?php echo $v['name']?></a></li>
                        <?php }else{?>
                            <li><a href="/details/<?php echo $v['id']?>.html"><span><?php echo $k+1?></span><?php echo $v['name']?></a></li>
                        <?php }}?>
                </ul>
              <ul>
                <li><a href=""><span style="background-color: #e92b3b">1</span>12.30换库后CR逻辑鸡精（第8题） 12.30换库后CR逻...</a></li>
                <li><a href=""><span style="background-color: #e98a52">2</span>MBA精英计划美前30英G5</a></li>
                <li><a href=""><span style="background-color: #22ada2">3</span>MBA精英计划美前30英G5</a></li>
                <li><a href=""><span>4</span>MBA精英计划美前30英G5</a></li>
                <li><a href=""><span>5</span>MBA精英计划美前30英G5</a></li>
              </ul>
            </div>
        </div>
    </div>
    <!--热门课程-->
    <div class="course">
        <h2>热门课程</h2>
        <ul>
            <li><a href="">
                    <img src="/cn/images/aside-course01.png" alt="课程图片">
                </a></li>
            <li><a href="">
                    <img src="/cn/images/aside-course02.png" alt="课程图片">
                </a></li>
        </ul>
    </div>
</aside>