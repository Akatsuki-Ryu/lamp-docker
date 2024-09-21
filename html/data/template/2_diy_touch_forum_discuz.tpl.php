<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('discuz');?><?php include template('common/header'); if($_GET['mod'] == 'find') { include template('forum/find'); } else { if($_G['setting']['mobile']['forum']['index'] == 1 && empty($_G['cache']['heats']['message']) && $_GET['forumlist'] != 1) { dheader('Location:forum.php?mod=guide&view=newthread');exit;?><?php } else { ?>	
<?php if(($_G['setting']['mobile']['forum']['index'] && $_GET['forumlist'] != 1) || !$_G['setting']['mobile']['forum']['index']) { ?>
<div class="header cl">
<div class="mzlogo"><a href="javascript:;"><?php echo $_G['style']['touchlogo'];?></a></div>
<div class="myss"><a href="search.php?mod=forum"><i class="dm-search"></i>搜索关键字</a></div>
</div>
<?php } else { ?>
<div class="header cl">
<div class="mz"><a href="javascript:history.back();"><i class="dm-c-left"></i></a></div>
<h2><?php echo $_G['setting']['navs'][2]['navname'];?></h2>
<div class="my"><a href="search.php?mod=forum"><i class="dm-search"></i></a></div>
</div>
<?php } if(($_G['setting']['mobile']['forum']['index'] > 1 && $_GET['forumlist'] != 1)) { ?>	
<?php if(!empty($_G['setting']['grid']['showgrid']) && !$_G['setting']['grid']['gridtype']) { ?>
<div class="dz-swiper_box dz-swiper">
<ul class="swiper-wrapper"><?php if(isset($grids['slide']) && is_array($grids['slide'])) foreach($grids['slide'] as $stid => $svalue) { ?><li class="swiper-slide"><a href="<?php echo $svalue['url'];?>"><img src="<?php echo $svalue['image'];?>" width="100%" class="vm"><span><?php echo $svalue['subject'];?></span></a></li>
<?php } ?>
</ul>
<div class="swiper-forum"></div>
</div>
<script>
var swiper = new Swiper('.dz-swiper', {
autoplay: {
disableOnInteraction: false,
delay: 3000,
},
  pagination: {
el: '.swiper-forum',
type: 'fraction',
  },
});
</script>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['index_top'])) echo $_G['setting']['pluginhooks']['index_top'];?>	
<?php } if($_G['setting']['mobile']['forum']['index'] > 1 && $_GET['forumlist'] != 1) { loadcache(array('forums'));$i=0;?><?php if(!empty($_G['cache']['heats']['message'])) { ?>
<div class="hotbox cl">
<h2><span>热点</span>推荐</h2>
<div class="hotbox-toutiao cl">
<ul><?php if(isset($_G['cache']['heats']['message']) && is_array($_G['cache']['heats']['message'])) foreach($_G['cache']['heats']['message'] as $data) { ?><li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $data['tid'];?>"><span><?php echo $data['subject'];?></span><?php echo $data['message'];?></a></li>
<?php } ?>
</ul>
</div>
<div class="listbox hotbox-list cl">
<ul><?php if(isset($_G['cache']['heats']['subject']) && is_array($_G['cache']['heats']['subject'])) foreach($_G['cache']['heats']['subject'] as $data) { ?><li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $data['tid'];?>"><span class="mbk"><?php echo $_G['cache']['forums'][$data['fid']]['name'];?></span><span class="mx">|</span><?php echo $data['subject'];?></a></li>
<?php } ?>
</ul>
</div>
</div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['index_catlist_top'])) echo $_G['setting']['pluginhooks']['index_catlist_top'];?>
<?php if(!empty($_G['setting']['grid']['showgrid'])) { ?>
<div class="tabs flex-box mt10 cl">
<a href="javascript:;" class="flex mon">最新主题</a>
<a href="javascript:;" class="flex">最新回复</a>
<a href="javascript:;" class="flex"><?php echo $_G['setting']['navs'][2]['navname'];?>热帖</a>
<a href="javascript:;" class="flex">精华帖子</a>
<?php if($_G['setting']['mobile']['forum']['index'] == 2) { ?><a href="forum.php?forumlist=1" class="flex">版块列表</a><?php } ?>
</div>
<div id="tabs-box" class="swiper-container listbox cl">
<div class="swiper-wrapper">
<div class="swiper-slide">
<ul><?php if(isset($grids['newthread']) && is_array($grids['newthread'])) foreach($grids['newthread'] as $thread) { if(!$thread['forumstick'] && $thread['closed'] > 1 && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])) { $thread['tid']=$thread['closed'];?><?php } ?>
<li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>"<?php if($thread['highlight']) { ?> <?php echo $thread['highlight'];?><?php } ?>><span class="mybk"><?php echo $thread['dateline'];?></span><span class="mico"></span><?php echo $thread['oldsubject'];?></a></li>
<?php } ?>
</ul>
</div>
<div class="swiper-slide">
<ul><?php if(isset($grids['newreply']) && is_array($grids['newreply'])) foreach($grids['newreply'] as $thread) { if(!$thread['forumstick'] && $thread['closed'] > 1 && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])) { $thread['tid']=$thread['closed'];?><?php } ?>				
<li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>"<?php if($thread['highlight']) { ?> <?php echo $thread['highlight'];?><?php } ?>><span class="mybk"><?php echo $thread['replies'];?> 回复</span><span class="mico"></span><?php echo $thread['oldsubject'];?></a></li>
<?php } ?>
</ul>
</div>
<div class="swiper-slide">
<ul><?php if(isset($grids['hot']) && is_array($grids['hot'])) foreach($grids['hot'] as $thread) { if(!$thread['forumstick'] && $thread['closed'] > 1 && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])) { $thread['tid']=$thread['closed'];?><?php } $i++;?><li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>"<?php if($thread['highlight']) { ?> <?php echo $thread['highlight'];?><?php } ?>><span class="mybk"><?php echo $thread['views'];?> 人气</span><span class="mnum"><?php echo $i;?></span><?php echo $thread['oldsubject'];?></a></li>
<?php } ?>
</ul>
</div>
<div class="swiper-slide">
<ul><?php if(isset($grids['digest']) && is_array($grids['digest'])) foreach($grids['digest'] as $thread) { if(!$thread['forumstick'] && $thread['closed'] > 1 && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])) { $thread['tid']=$thread['closed'];?><?php } ?>
<li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>"<?php if($thread['highlight']) { ?> <?php echo $thread['highlight'];?><?php } ?>><span class="mybk"><?php echo $thread['author'];?></span><span class="mico"></span><?php echo $thread['oldsubject'];?></a></li>
<?php } ?>
</ul>
</div>
</div>
</div>
<script type="text/javascript">
window.onload = function() {
var tabsSwiper = new Swiper('#tabs-box', {
speed: 500,
on: {
slideChangeTransitionStart: function() {
$(".tabs .mon").removeClass('mon');
$(".tabs a").eq(this.activeIndex).addClass('mon');
}
}
})
$(".tabs a").on('click', function(e) {
e.preventDefault()
$(".tabs .mon").removeClass('mon')
$(this).addClass('mon')
tabsSwiper.slideTo($(this).index())
})
}
</script>
<?php } } if(in_array($_G['setting']['mobile']['forum']['index'], array(0,3)) || $_GET['forumlist'] == 1) { if($announcements) { ?>
<div class="ann-box">
<div class="mtit">公告</div>
<div id="ann"><ul><?php echo $announcements;?></ul></div>
</div>
<script type="text/javascript">discuz_loop(24, 30, 3000, 'ann');</script>
<?php } if($_G['setting']['mobile']['forum']['statshow']) { ?>
<div class="stat cl">
<ul class="flex-box">
<li class="flex"><em><?php echo $todayposts;?></em>今日</li>
<li class="flex"><em><?php echo $postdata[0];?></em>昨日</li>
<li class="flex"><em><?php echo $posts;?></em>帖子</li>
<li class="flex"><em><?php echo $_G['cache']['userstats']['totalmembers'];?></em>会员</li>
</ul>
</div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['index_top_mobile'])) echo $_G['setting']['pluginhooks']['index_top_mobile'];?>
<div class="forumlist cl"><?php if(isset($catlist) && is_array($catlist)) foreach($catlist as $key => $cat) { ?><div class="subforumshow cl" href="#sub-forum_<?php echo $cat['fid'];?>">
<i class="<?php if(!$_G['setting']['mobile']['forum']['forumview']) { ?>dm-minus-c<?php } else { ?>dm-plus-c<?php } ?>"></i>
<h2><a href="javascript:;"><?php echo $cat['name'];?></a></h2>
</div>
<div id="sub-forum_<?php echo $cat['fid'];?>" class="sub-forum mlist<?php if($cat['forumcolumns'] == 3) { ?>3<?php } elseif($cat['forumcolumns'] == 2) { ?>2<?php } elseif($cat['forumcolumns'] == 1 || $cat['forumcolumns'] == 0) { ?>1<?php } else { ?>4<?php } ?> cl">
<ul><?php if(isset($cat['forums']) && is_array($cat['forums'])) foreach($cat['forums'] as $forumid) { $forum=$forumlist[$forumid];?><?php $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? $_G['scheme'].'://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forum['fid'];?><?php if($forum['permission'] == 1) { ?>
<li><span class="micon<?php if($_G['setting']['mobile']['forum']['iconautowidth']) { ?> autowidth<?php } ?>"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $forum['fid'];?>"><?php if($forum['icon']) { ?><?php echo $forum['icon'];?><?php } else { ?><svg width="48" height="44" alt="<?php echo $forum['name'];?>"><path fill="#<?php if($forum['folder']) { ?>fdc910<?php } else { ?>c9c9c9<?php } ?>" d="M48 20C48 9 37.3 0 24 0S0 8.9 0 20s10.7 20 24 20c2.4 0 4.7-.3 6.8-.8L42 44l-2.8-8.5C44.6 31.8 48 26.2 48 20z"/></svg><?php } ?></a></span>
<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $forum['fid'];?>" class="murl"><p class="mtit">私密版块<?php if($forum['todayposts'] > 0 && ($cat['forumcolumns'] == 1 || $cat['forumcolumns'] == 0)) { ?><span class="mnum">今日 <?php echo $forum['todayposts'];?></span><?php } ?></p></a></li>
<?php } else { ?>
<li><span class="micon<?php if($_G['setting']['mobile']['forum']['iconautowidth']) { ?> autowidth<?php } ?>"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $forum['fid'];?>"><?php if($forum['icon']) { ?><?php echo $forum['icon'];?><?php } else { ?><svg width="48" height="44" alt="<?php echo $forum['name'];?>"><path fill="#<?php if($forum['folder']) { ?>fdc910<?php } else { ?>c9c9c9<?php } ?>" d="M48 20C48 9 37.3 0 24 0S0 8.9 0 20s10.7 20 24 20c2.4 0 4.7-.3 6.8-.8L42 44l-2.8-8.5C44.6 31.8 48 26.2 48 20z"/></svg><?php } ?></a></span>
<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $forum['fid'];?>" class="murl"><p class="mtit"><?php echo $forum['name'];?><?php if($forum['todayposts'] > 0 && ($cat['forumcolumns'] == 1 || $cat['forumcolumns'] == 0)) { ?><span class="mnum">今日 <?php echo $forum['todayposts'];?></span><?php } ?></p>
<?php if($cat['forumcolumns'] < 3) { if($forum['redirect']) { ?><p class="mtxt">链接到外部地址</p><?php } else { ?><p class="mtxt"><?php if($cat['forumcolumns'] == 2) { ?>帖数: <?php echo dnumber($forum['posts']); if($forum['todayposts'] > 0) { ?><span class="mnum">今日: <?php echo $forum['todayposts'];?></span><?php } } else { if($forum['description']) { ?><?php echo $forum['description'];?><?php } else { ?>暂无版块介绍<?php } } ?></p><?php } } ?></a></li>
<?php } } ?>
</ul>
</div>
<?php } ?>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['index_middle_mobile'])) echo $_G['setting']['pluginhooks']['index_middle_mobile'];?>
<script type="text/javascript">
(function() {
<?php if(!$_G['setting']['mobile']['forum']['forumview']) { ?>
$('.sub-forum').css('display', 'block');
<?php } else { ?>
$('.sub-forum').css('display', 'none');
<?php } ?>
$('.subforumshow').on('click', function() {
var obj = $(this);
var subobj = $(obj.attr('href'));
if(subobj.css('display') == 'none') {
subobj.css('display', 'block');
obj.find('i').removeClass().addClass('dm-minus-c');
} else {
subobj.css('display', 'none');
obj.find('i').removeClass().addClass('dm-plus-c');
}
});
 })();
</script>
<?php } ?>
<div class="footer mt10 cl">
<div class="footer-nv">
<a href="javascript:;" class="mon">手机版</a>|<a
href="<?php echo $_G['setting']['mobile']['nomobileurl'];?>">电脑版</a><?php if($clienturl) { ?>|<a 
href="<?php echo $clienturl;?>">客户端</a><?php } ?>
</div>
<div class="footer-copy mt10">
<?php if($_G['setting']['icp'] || $_G['setting']['mps']) { if($_G['setting']['icp']) { ?><a href="https://beian.miit.gov.cn/" target="_blank"><?php echo $_G['setting']['icp'];?></a><?php } if($_G['setting']['mps']) { ?><a href="https://beian.mps.gov.cn/#/query/webSearch?code=<?php echo $_G['setting']['mpsid'];?>" target="_blank"><img width="14" height="14" src="<?php echo IMGDIR;?>/ico_mps.png" /><?php echo $_G['setting']['mps'];?></a><?php } ?><br><?php } ?>
Powered by Discuz! <em><?php echo $_G['setting']['version'];?></em>
<p class="xs0">&copy; 2001-2024 <a href="https://code.dismall.com/" target="_blank">Discuz! Team</a>.</p>
</div>
</div>
<?php } } include template('common/footer'); ?>