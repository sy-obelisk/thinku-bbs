<aside class="person-aside">
    <div class="aside-head">
        <div>
            <img src="" alt="">
        </div>
        <p>用户名</p>
        <p><span class="iconfont icon-jifen"></span>积分：<?php echo $integral?></p>
    </div>
    <ul class="aside-list">
        <li <?php if (strpos($path, 'change-image') !== false ) echo 'class="on"'; ?>><a href="change-image.html">设置头像</a></li>
        <li <?php if (strpos($path, 'person') !== false ) echo 'class="on"'; ?>><a href="person.html">个人中心</a></li>
        <li <?php if (strpos($path, 'collection') !== false ) echo 'class="on"'; ?>><a href="collection.html">我的收藏</a></li>
        <li <?php if (strpos($path, 'share') !== false ) echo 'class="on"'; ?>><a href="share.html">我的分享</a></li>
        <li <?php if (strpos($path, 'article') !== false ) echo 'class="on"'; ?>><a href="article.html">我的帖子</a></li>
        <li <?php if (strpos($path, 'message-board') !== false ) echo 'class="on"'; ?>><a href="message-board.html">留言板</a></li>
        <li <?php if (strpos($path, 'info') !== false ) echo 'class="on"'; ?>><a href="info.html">系统消息</a></li>
    </ul>
</aside>