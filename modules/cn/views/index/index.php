<link rel="stylesheet" href="/cn/css/index.css">
  <!--内容区-->
  <div class="home p-container">
    <section class="bnr clearfix">
      <div class="bnr-banner">
        <div class="box">
          <ul>
            <li>
              <a href="">
                <img src="/cn/images/index02.png" alt="">
              </a>
            </li>
            <li>
              <a href="">
                <img src="/cn/images/index02.png" alt="">
              </a>
            </li>
            <li>
              <a href="">
                <img src="/cn/images/index02.png" alt="">
              </a>
            </li>
          </ul>
        </div>
        <div class="prev">&lt;</div>
        <div class="next">&gt;</div>
      </div>
      <div class="bnr-info">
        <div class="hd">
          <ul>
            <li>报告</li>
            <li>资讯</li>
            <li>故事</li>
            <li>头条</li>
          </ul>
        </div>
        <div class="bd">
          <ul>
            <li><a href="">【TOEFL】托福TPO10阅读名师精评版名师精评（3）</a></li>
            <li><a href="">【TOEFL】托福TPO10阅读名师精评版名师精评（3）</a></li>
            <li><a href="">【TOEFL】托福TPO10阅读名师精评版名师精评（3）</a></li>
            <li><a href="">【TOEFL】托福TPO10阅读名师精评版名师精评（3）</a></li>
            <li><a href="">【TOEFL】托福TPO10阅读名师精评版名师精评（3）</a></li>
            <li><a href="">【TOEFL】托福TPO10阅读名师精评版名师精评（3）</a></li>
            <li><a href="">【TOEFL】托福TPO10阅读名师精评版名师精评（3）</a></li>
            <li><a href="">【TOEFL】托福TPO10阅读名师精评版名师精评（3）</a></li>
            <li><a href="">【TOEFL】托福TPO10阅读名师精评版名师精评（3）</a></li>
            <li><a href="">【TOEFL】托福TPO10阅读名师精评版名师精评（3）</a></li>
            <li><a href="">【TOEFL】托福TPO10阅读名师精评版名师精评（3）</a></li>
            <li><a href="">【TOEFL】托福TPO10阅读名师精评版名师精评（3）</a></li>
            <li><a href="">【TOEFL】托福TPO10阅读名师精评版名师 精评（3）</a></li>
          </ul>
          <ul>
            <li><a href="">托福110分【核心词汇】精选（超全）【雷哥托福】</a></li>
            <li><a href="">托福110分【核心词汇】精选（超全）【雷哥托福】</a></li>
            <li><a href="">托福110分【核心词汇】精选（超全）【雷哥托福】</a></li>
            <li><a href="">托福110分【核心词汇】精选（超全）【雷哥托福】</a></li>
            <li><a href="">托福110分【核心词汇】精选（超全）【雷哥托福】</a></li>
            <li><a href="">托福110分【核心词汇】精选（超全）【雷哥托福】</a></li>
            <li><a href="">托福110分【核心词汇】精选（超全）【雷哥托福】</a></li>
          </ul>
          <ul>
            <li><a href="">托福24套写作TPO解析【雷哥托福】托福24套写作TPO解析【雷哥托福】托福24套写作TPO解析【雷哥托福】</a></li>
            <li><a href="">托福24套写作TPO解析【雷哥托福】</a></li>
            <li><a href="">托福24套写作TPO解析【雷哥托福】</a></li>
            <li><a href="">托福24套写作TPO解析【雷哥托福】</a></li>
            <li><a href="">托福24套写作TPO解析【雷哥托福】</a></li>
            <li><a href="">托福24套写作TPO解析【雷哥托福】</a></li>
          </ul>
          <ul>
            <li><a href="">托福写作连接词怎么用？【雷哥托福】</a></li>
            <li><a href="">托福写作连接词怎么用？【雷哥托福】</a></li>
            <li><a href="">托福写作连接词怎么用？【雷哥托福】</a></li>
            <li><a href="">托福写作连接词怎么用？【雷哥托福】</a></li>
            <li><a href="">托福写作连接词怎么用？【雷哥托福】</a></li>
            <li><a href="">托福写作连接词怎么用？【雷哥托福】</a></li>
            <li><a href="">托福写作连接词怎么用？【雷哥托福】</a></li>
          </ul>
        </div>
      </div>
    </section>
    <!--offer、高分-->
    <section class="workcase clearfix">
      <div class="offer">
        <h5 class="p-title">报OFFER</h5>
        <div class="bd">
          <ul>
            <?php foreach($offer as $v){?>
            <li><a href="http://www.thinkwithu.com/word-details/<?php echo $v['id']?>/104.html" target="_blank">【<?php echo $v['abroadSchool']?>】<?php echo $v['title']?></a></li>
            <?php }?>
<!--            <li><a href="">【哈弗大学】恭喜上海朱同学斩获哈弗商学院MBA</a></li>-->
<!--            <li><a href="">【哈弗大学】恭喜上海朱同学斩获哈弗商学院MBA</a></li>-->
          </ul>
        </div>
      </div>
      <div class="score">
        <h5 class="p-title">报高分</h5>
        <div class="bd">
          <ul>
            <?php foreach($score as $v){?>
            <li><a href="http://www.thinkwithu.com/picture-details/<?php echo $v['id']?>/104.html" target="_blank">【<?php echo $v['name']?>】<?php echo $v['title']?></a></li>
            <?php }?>
<!--            <li><a href="">【哈弗大学】恭喜上海朱同学斩获哈弗商学院MBA</a></li>-->
<!--            <li><a href="">【哈弗大学】恭喜上海朱同学斩获哈弗商学院MBA</a></li>-->
          </ul>
        </div>
      </div>
    </section>
    <!--热门板块、公开课-->
    <section class="hotpublic clearfix">
      <div class="hot">
        <h5 class="p-title">热门板块</h5>
        <ul class="clearfix hot-list">
          <li class="hot-item">
            <a href="http://www.thinkwithu.com/evaluation.html">
              <div></div>
              <p>留学评估</p>
            </a>
          </li>
          <li class="hot-item">
            <a href="http://www.thinkwithu.com/practices.html">
              <div></div>
              <p>背景提升</p>
            </a>
          </li>
          <li class="hot-item">
            <a href="/square.html">
              <div></div>
              <p>问答广场</p>
            </a>
          </li>
          <li class="hot-item">
            <a href="http://www.thinkwithu.com/schools.html">
              <div></div>
              <p>院校排名</p>
            </a>
          </li>
        </ul>
        <ul class="clearfix hot-list">
          <li class="hot-item">
            <a href="http://www.thinkwithu.com/USA.html" target="_blank">
              <div></div>
              <p>美国留学</p>
            </a>
          </li>
          <li class="hot-item">
            <a href="http://www.thinkwithu.com/UK.html" target="_blank">
              <div></div>
              <p>英国留学</p>
            </a>
          </li>
          <li class="hot-item">
            <a href="http://www.thinkwithu.com/list/178,125.html">
              <div></div>
              <p>研究报告</p>
            </a>
          </li>
          <li class="hot-item">
            <a href="http://www.thinkwithu.com/case.html">
              <div></div>
              <p>名校案例</p>
            </a>
          </li>
        </ul>
      </div>
      <div class="public">
        <h5 class="p-title">出国留学热门公开课</h5>
        <div class="box">
          <ul>
            <li>
              <img src="/cn/images/index02.png" alt="">
              <div>
                <p><a href="">查看详情</a></p>
                <p><a href="">立即报名</a></p>
              </div>
            </li>
            <li>
              <img src="/cn/images/index02.png" alt="">
              <div>
                <p><a href="">查看详情</a></p>
                <p><a href="">立即报名</a></p>
              </div>
            </li>
            <li>
              <img src="/cn/images/index02.png" alt="">
              <div>
                <p><a href="">查看详情</a></p>
                <p><a href="">立即报名</a></p>
              </div>
            </li>
          </ul>
        </div>
        <div class="prev">&lt;</div>
        <div class="next">&gt;</div>
      </div>
    </section>
    <!--资料下载-->
    <section class="download">
      <div class="down-title clearfix">
        <h5 class="p-title">资料下载专区</h5>
        <a href="">more</a>
      </div>
      <div class="down-cnt clearfix">
        <ul>
          <h5><span>留学资料下载</span></h5>
          <li><a href="">院校排名</a></li>
          <li><a href="">专业解读</a></li>
          <li><a href="">选校方案</a></li>
          <li><a href="">精品留学课件+视频</a></li>
        </ul>
        <ul>
          <h5><span>托福雅思资料下载</span></h5>
          <li><a href="">听力资料下载</a></li>
          <li><a href="">口语资料下载</a></li>
          <li><a href="">阅读资料下载</a></li>
          <li><a href="">写作资料下载</a></li>
          <li><a href="">TPO资料下载</a></li>
          <li><a href="">托福雅思资料下载</a></li>
        </ul>
        <ul>
          <h5><span>GMAT资料下载</span></h5>
          <li><a href="">SC资料下载</a></li>
          <li><a href="">CR资料下载</a></li>
          <li><a href="">RC资料下载</a></li>
          <li><a href="">作为/IR资料下载</a></li>
          <li><a href="">GMAT资料下载</a></li>
        </ul>
        <ul>
          <h5><span>SAT资料下载</span></h5>
          <li><a href="">阅读资料下载</a></li>
          <li><a href="">文法资料下载</a></li>
          <li><a href="">数学资料下载</a></li>
          <li><a href="">SAT资料下载</a></li>
        </ul>
      </div>
    </section>
    <section class="posts p-posts clearfix">
      <div class="box">
        <div class="box-tab">
          <div class="hd">
            <ul class="clearfix">
              <li class="on article-all" data-cate="all">
                <div class="img"></div>
                <p>全部</p>
              </li>
              <li class="article-other" data-first="2" data-second="6" data-third="16">
                <div class="img"></div>
                <p>留学</p>
              </li>
              <li class="article-other" data-first="3" data-second="56" data-third="61">
                <div class="img"></div>
                <p>考试</p>
              </li>
              <li class="article-other" data-first="4" data-second="76">
                <div class="img"></div>
                <p>职业</p>
              </li>
              <li class="article-other" data-first="5" data-second="81">
                <div class="img"></div>
                <p>生活</p>
              </li>
            </ul>
          </div>
          <div class="bd">
            <!--全部-->
            <ul class="clearfix all-article">
              <li class="active" data-cate="all"><a href="javascript:void(0)">全部<i class="iconfont icon-hot"></a></i></li>
              <li data-cate="goodArticle"><a href="javascript:void(0)">精华</a></li>
            </ul>
            <!--留学-->
            <ul class="clearfix get-list">
              <div class="abroad-wrap">
                <div class="inHd">
                  <ul class="clearfix">
                    <li>美国</li>
                    <li>英国</li>
                    <li>澳洲</li>
                    <li>加拿大</li>
                    <li>香港</li>
                    <li>新加坡</li>
                    <li>法国</li>
                    <li>其他</li>
                  </ul>
                </div>
                <div class="inBd">
                  <ul>
                    <li class="active" data-first="2" data-second="6" data-third="16"><a href="javascript:void(0)">签证</a></li>
                    <li data-first="2" data-second="6" data-third="17"><a href="javascript:void(0)">答疑</a></li>
                    <li data-first="2" data-second="6" data-third="18"><a href="javascript:void(0)">院校项目</a></li>
                    <li data-first="2" data-second="6" data-third="19"><a href="javascript:void(0)">实习就业</a></li>
                    <li data-first="2" data-second="6" data-third="20"><a href="javascript:void(0)">面试</a></li>
                  </ul>
                  <ul>
                    <li class="active"  data-first="2" data-second="7" data-third="21"><a href="javascript:void(0)">签证</a></li>
                    <li data-first="2" data-second="7" data-third="22"><a href="javascript:void(0)">答疑</a></li>
                    <li data-first="2" data-second="7" data-third="23"><a href="javascript:void(0)">院校项目</a></li>
                    <li data-first="2" data-second="7" data-third="24"><a href="javascript:void(0)">实习就业</a></li>
                    <li data-first="2" data-second="7" data-third="25"><a href="javascript:void(0)">面试</a></li>
                  </ul>
                  <ul>
                    <li class="active" data-first="2" data-second="8" data-third="26"><a href="javascript:void(0)">签证</a></li>
                    <li data-first="2" data-second="8" data-third="27"><a href="javascript:void(0)">答疑</a></li>
                    <li data-first="2" data-second="8" data-third="28"><a href="javascript:void(0)">院校项目</a></li>
                    <li data-first="2" data-second="8" data-third="29"><a href="javascript:void(0)">实习就业</a></li>
                    <li data-first="2" data-second="8" data-third="30"><a href="javascript:void(0)">面试</a></li>
                  </ul>
                  <ul>
                    <li class="active" data-first="2" data-second="9" data-third="31"><a href="javascript:void(0)">签证</a></li>
                    <li data-first="2" data-second="9" data-third="32"><a href="javascript:void(0)">答疑</a></li>
                    <li data-first="2" data-second="9" data-third="33"><a href="javascript:void(0)">院校项目</a></li>
                    <li data-first="2" data-second="9" data-third="34"><a href="javascript:void(0)">实习就业</a></li>
                    <li data-first="2" data-second="9" data-third="35"><a href="javascript:void(0)">面试</a></li>
                  </ul>
                  <ul>
                    <li class="active"  data-first="2" data-second="10" data-third="36"><a href="javascript:void(0)">签证</a></li>
                    <li data-first="2" data-second="10" data-third="37"><a href="javascript:void(0)">答疑</a></li>
                    <li data-first="2" data-second="10" data-third="38"><a href="javascript:void(0)">院校项目</a></li>
                    <li data-first="2" data-second="10" data-third="39"><a href="javascript:void(0)">实习就业</a></li>
                    <li data-first="2" data-second="10" data-third="40"><a href="javascript:void(0)">面试</a></li>
                  </ul>
                  <ul>
                    <li class="active"  data-first="2" data-second="11" data-third="41"><a href="javascript:void(0)">签证</a></li>
                    <li data-first="2" data-second="11" data-third="42"><a href="javascript:void(0)">答疑</a></li>
                    <li data-first="2" data-second="11" data-third="43"><a href="javascript:void(0)">院校项目</a></li>
                    <li data-first="2" data-second="11" data-third="44"><a href="javascript:void(0)">实习就业</a></li>
                    <li data-first="2" data-second="11" data-third="45"><a href="javascript:void(0)">面试</a></li>
                  </ul>
                  <ul>
                    <li class="active" data-first="2" data-second="12" data-third="46"><a href="javascript:void(0)">签证</a></li>
                    <li data-first="2" data-second="12" data-third="47"><a href="javascript:void(0)">答疑</a></li>
                    <li data-first="2" data-second="12" data-third="48"><a href="javascript:void(0)">院校项目</a></li>
                    <li data-first="2" data-second="12" data-third="49"><a href="javascript:void(0)">实习就业</a></li>
                    <li data-first="2" data-second="12" data-third="50"><a href="javascript:void(0)">面试</a></li>
                  </ul>
                  <ul>
                    <li class="active" data-first="2" data-second="13" data-third="51"><a href="javascript:void(0)">签证</a></li>
                    <li data-first="2" data-second="13" data-third="52"><a href="javascript:void(0)">答疑</a></li>
                    <li data-first="2" data-second="13" data-third="53"><a href="javascript:void(0)">院校项目</a></li>
                    <li data-first="2" data-second="13" data-third="54"><a href="javascript:void(0)">实习就业</a></li>
                    <li data-first="2" data-second="13" data-third="55"><a href="javascript:void(0)">面试</a></li>
                  </ul>
                </div>
              </div>
            </ul>
            <!--考试-->
            <ul class="clearfix get-list">
              <div class="exam-wrap">
                <div class="inHd">
                  <ul class="clearfix">
                    <li>GMAT</li>
                    <li>TOEFL</li>
                    <li>IELTS</li>
                    <li>GRE</li>
                    <li>SAT</li>
                  </ul>
                </div>
                <div class="inBd">
                  <!--GMAT-->
                  <ul>
                   <li class="active" data-first="3" data-second="56" data-third="61"><a class="on" href="javascript:void(0)">答疑</a></li>
                   <li data-first="3" data-second="56" data-third="62"><a href="javascript:void(0)">备考经验</a></li>
                   <li data-first="3" data-second="56" data-third="63"><a href="javascript:void(0)">资料下载</a></li>
                   <li data-first="3" data-second="56" data-third="113"><a href="javascript:void(0)">机经下载</a></li>
                 </ul>
                  <!--TOEFL-->
                  <ul>
                    <li class="active" data-first="3" data-second="58" data-third="67"><a href="javascript:void(0)" >答疑</a></li>
                    <li data-first="3" data-second="58" data-third="68"><a href="javascript:void(0)">备考经验</a></li>
                    <li data-first="3" data-second="58" data-third="69"><a href="javascript:void(0)">资料下载</a></li>
                    <li data-first="3" data-second="58" data-third="115"><a href="javascript:void(0)">资料下载</a></li>
                  </ul>
                  <!--IELTS-->
                  <ul>
                    <li class="active" data-first="3" data-second="59" data-third="70"><a href="javascript:void(0)">答疑</a></li>
                    <li data-first="3" data-second="59" data-third="71"><a href="javascript:void(0)">备考经验</a></li>
                    <li data-first="3" data-second="59" data-third="72"><a href="javascript:void(0)">资料下载</a></li>
                    <li data-first="3" data-second="59" data-third="116"><a href="javascript:void(0)">资料下载</a></li>
                  </ul>
                  <!--GRE-->
                  <ul>
                    <li class="active" data-first="3" data-second="57" data-third="64"><a href="javascript:void(0)">答疑</a></li>
                    <li data-first="3" data-second="57" data-third="65"><a href="javascript:void(0)">备考经验</a></li>
                    <li data-first="3" data-second="57" data-third="66"><a href="javascript:void(0)">资料下载</a></li>
                    <li data-first="3" data-second="57" data-third="114"><a href="javascript:void(0)">资料下载</a></li>
                  </ul>
                  <!--SAT-->
                  <ul>
                    <li class="active" data-first="3" data-second="60" data-third="64"><a href="javascript:void(0)">答疑</a></li>
                    <li data-first="3" data-second="60" data-third="65"><a href="javascript:void(0)">备考经验</a></li>
                    <li data-first="3" data-second="60" data-third="66"><a href="javascript:void(0)">资料下载</a></li>
                    <li data-first="3" data-second="60" data-third="117"><a href="javascript:void(0)">资料下载</a></li>
                  </ul>
                </div>
              </div>
            </ul>
            <!--职业-->
            <ul class="clearfix get-list">
              <li class="first-li active" data-first="4" data-second="76"><a href="javascript:void(0)">金融</a></li>
              <li data-first="4" data-second="77"><a href="javascript:void(0)">大商科</a></li>
              <li data-first="4" data-second="78"><a href="javascript:void(0)">会计</a></li>
              <li data-first="4" data-second="79"><a href="javascript:void(0)">理工科</a></li>
              <li data-first="4" data-second="80"><a href="javascript:void(0)">文科艺术类</a></li>
            </ul>
            <!--生活-->
            <ul class="clearfix get-list">
              <li class="first-li active" data-first="5" data-second="81"><a href="javascript:void(0)">美国</a></li>
              <li data-first="5" data-second="82"><a href="javascript:void(0)">英国</a></li>
              <li data-first="5" data-second="83"><a href="javascript:void(0)">澳洲</a></li>
              <li data-first="5" data-second="84"><a href="javascript:void(0)">加拿大</a></li>
              <li data-first="5" data-second="85"><a href="javascript:void(0)">香港</a></li>
              <li data-first="5" data-second="86"><a href="javascript:void(0)">新加坡</a></li>
              <li data-first="5" data-second="87"><a href="javascript:void(0)">法国</a></li>
              <li data-first="5" data-second="88"><a href="javascript:void(0)">其他</a></li>
            </ul>
          </div>
        </div>
        <div class="box-cnt">
          <div class="box-post-list">
<!--            <ul>-->
<!--              --><?php //foreach($data as $v){?>
<!--                <li class="item">-->
<!--                  <div class="img">-->
<!--                    <img src="" alt="">-->
<!--                  </div>-->
<!--                  <div class="right">-->
<!--                    <h3><a href="/details/--><?php //echo $v['id']?><!--.html">--><?php //echo $v['name']?><!--<i class="iconfont icon-hot"></a></i></h3>-->
<!--                    <div class="info-list clearfix">-->
<!--                      <div class="first-div"><span>--><?php //echo $v['nickname']?$v['nickname']:$v['userName']?><!--</span> <span>发布于--><?php //echo substr($v['createTime'],0,10)?><!--</span></div>-->
<!--                      <div class="last-div">-->
<!--                        <p>--><?php //echo isset($v['last']['name'])&&$v['last']['name']!=false?"<span>".$v['last']['name']."</span> <span>最后回复于".$v['last']['time']."</span> ":''?><!--</span></p>-->
<!--                        <p><span>查看：--><?php //echo $v['viewCount']?><!-- </span>|<span>回复：--><?php //echo $v['count']?><!--</span></p></div>-->
<!--                    </div>-->
<!--                    <div class="abstract">-->
<!--                      --><?php //echo $v['listeningFile']?>
<!--                    </div>-->
<!--                  </div>-->
<!--                </li>-->
<!--              --><?php //}?>
<!--            </ul>-->
          </div>
<!--            <li class="item">-->
<!--              <div class="img">-->
<!--                <img src="" alt="">-->
<!--              </div>-->
<!--              <div class="right">-->
<!--                <h3><a href="">12.30换库后CR逻辑鸡精—Zora<i class="iconfont icon-hot"></a></i></h3>-->
<!--                <div class="info-list clearfix">-->
<!--                  <div class="first-div"><span>小托君</span> <span>发布于2017-12-22</span></div>-->
<!--                  <div class="last-div">-->
<!--                    <p><span>Nicholas </span><span>最后回复于2018-01-12</span></p>-->
<!--                    <p><span>查看：778  </span>|<span>回复：66</span></p></div>-->
<!--                </div>-->
<!--                <div class="abstract">-->
<!--                  各位在一线备战托福的朋友们，主讲老师Zora，课程视频和课件在此下载学习；斩获更多托福-->
<!--                  信息，获取更多托福资讯，请添加微信公众号小托君。-->
<!--                </div>-->
<!--              </div>-->
<!--            </li>-->
          <!---分页-->
          <div class="page-wrap">
            <ul class="pagination" id="pagination1"></ul>
          </div>
        </div>
      </div>
      <!--侧边栏-->
      <?php use app\commands\front\RightWidget;?>
      <?php RightWidget::begin();?>
      <?php RightWidget::end();?>
    </section>
  </div>
<script src="/cn/js/index.js"></script>