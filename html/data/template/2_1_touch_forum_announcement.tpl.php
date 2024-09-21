<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('announcement');?><?php include template('common/header'); ?><div class="header cl">
<div class="mz"><a href="javascript:history.back();"><i class="dm-c-left"></i></a></div>
<h2>公告</h2>
<div class="my"><a href="index.php"><i class="dm-house"></i></a></div>
</div>
<div class="dhnav_box">
<div id="dhnav">
<div id="dhnav_li">
<ul class="swiper-wrapper">
<li class="swiper-slide<?php if(empty($_GET['m'])) { ?> mon<?php } ?>"><a href="forum.php?mod=announcement">全部</a><?php if(empty($_GET['m'])) { ?><em></em><?php } ?></li><?php if(isset($months) && is_array($months)) foreach($months as $month) { ?><li class="swiper-slide<?php if($_GET['m'] == $month[0].$month[1]) { ?> mon<?php } ?>"><a href="forum.php?mod=announcement&amp;m=<?php echo $month[0].$month[1];?>"><?php echo $month[0];?> 年 <?php echo $month[1];?> 月</a></li>
<?php } ?>
</ul>
</div>
</div>
</div>
<div class="annlist mt10 cl">
<ul><?php $nn = 0;?><?php if(isset($announcelist) && is_array($announcelist)) foreach($announcelist as $ann) { $nn++;?><li class="cl">
<h2><a href="javascript:;" class="ann_more" id="ann_<?php echo $ann['id'];?>"><i class="dm-c-<?php if($nn == 1 && !$annid || $ann['id'] == $annid) { ?>down<?php } else { ?>right<?php } ?>"></i><?php echo $ann['subject'];?></a></h2>
<h3><span class="my"><?php echo $ann['starttime'];?></span><span class="mz">作者:</span> <a href="home.php?mod=space&amp;username=<?php echo $ann['authorenc'];?>&amp;do=profile"><?php echo $ann['author'];?></a></h3>
<div class="annlist_box" style="display:<?php if($nn == 1 && !$annid || $ann['id'] == $annid) { ?>block<?php } else { ?>none<?php } ?>;" id="ann_<?php echo $ann['id'];?>_box">				
<?php echo $ann['message'];?>
</div>
</li>
<?php } ?>
</ul>	
</div>
<script>
if($("#dhnav_li .mon").length > 0) {
var discuz_nav = $("#dhnav_li .mon").offset().left + $("#dhnav_li .mon").width() >= $(window).width() ? $("#dhnav_li .mon").index() : 0;
}else{
var discuz_nav = 0;
}	
mySwiper = new Swiper('#dhnav_li', {
freeMode : true,
slidesPerView : 'auto',
initialSlide : discuz_nav,
onTouchMove: function(swiper){
Discuz_Touch_on = 0;
},
onTouchEnd: function(swiper){
Discuz_Touch_on = 1;
},
});
$('.ann_more').on('click', function() {
var obj = $(this);
var sub_obj = $('#' + obj.attr('id') + '_box');
if(sub_obj.css('display') == 'none') {
sub_obj.css('display', 'block');
obj.find('i').removeClass().addClass('dm-c-down');
} else {
sub_obj.css('display', 'none');
obj.find('i').removeClass().addClass('dm-c-right');
}
});
</script><?php $nofooter = true;?><?php include template('common/footer'); ?>