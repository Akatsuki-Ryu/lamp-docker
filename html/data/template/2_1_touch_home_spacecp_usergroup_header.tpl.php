<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div class="dhnavs_box">
<div id="dhnavs">
<div id="dhnavs_li">
<ul class="swiper-wrapper">
<li class="swiper-slide<?php if($activeus['usergroup']) { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=usergroup">我的用户组</a></li>
<li class="swiper-slide<?php if($activeus['list'] || $activeus['expiry']) { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=list">购买用户组</a></li>
<li class="swiper-slide<?php if($activeus['forum']) { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=forum">我的<?php echo $_G['setting']['navs'][2]['navname'];?>权限</a></li>
</ul>
</div>
</div>
</div>
<script>if($("#dhnavs_li .mon").length>0){var discuz_nav=$("#dhnavs_li .mon").offset().left+$("#dhnavs_li .mon").width()>=$(window).width()?$("#dhnavs_li .mon").index():0}else{var discuz_nav=0}new Swiper('#dhnavs_li',{freeMode:true,slidesPerView:'auto',initialSlide:discuz_nav,onTouchMove:function(swiper){Discuz_Touch_on=0},onTouchEnd:function(swiper){Discuz_Touch_on=1},});</script>