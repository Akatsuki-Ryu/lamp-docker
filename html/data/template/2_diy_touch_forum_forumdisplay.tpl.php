<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('forumdisplay');?><?php include template('common/header'); ?><div class="header cl">
<div class="mz"><a href="javascript:history.back();"><i class="dm-c-left"></i></a></div>
<h2><?php echo strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name'];?></h2>
<div class="my"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>"><i class="dm-edit"></i></a></div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_top_mobile'])) echo $_G['setting']['pluginhooks']['forumdisplay_top_mobile'];?>
<div class="forumdisplay-top cl">
<h2>
<?php if($_G['forum']['icon']) { ?><img src="<?php echo get_forumimg($_G['forum']['icon']); ?>" alt="<?php echo $_G['forum']['name'];?>" /><?php } else { ?><svg width="48" height="44" alt="<?php echo $_G['forum']['name'];?>"><path fill="#c9c9c9" d="M48 20C48 9 37.3 0 24 0S0 8.9 0 20s10.7 20 24 20c2.4 0 4.7-.3 6.8-.8L42 44l-2.8-8.5C44.6 31.8 48 26.2 48 20z"/></svg><?php } if(helper_access::check_module('favorite')) { ?>
<a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=forum&amp;id=<?php echo $_G['fid'];?>&amp;handlekey=favoriteforum&amp;formhash=<?php echo FORMHASH;?>" id="a_favorite" class="dialog">收藏<span id="number_favorite" <?php if(!$_G['forum']['favtimes']) { ?> style="display:none;"<?php } ?>><span id="number_favorite_num"> +<?php echo $_G['forum']['favtimes'];?></span></span></a>
<?php } ?>
<?php echo $_G['forum']['name'];?>
</h2>
<p>今日: <span><?php echo $_G['forum']['todayposts'];?></span>主题: <span><?php echo $_G['forum']['threads'];?></span><?php if($_G['forum']['rank']) { ?>排名: <span><?php echo $_G['forum']['rank'];?></span><?php } ?></p>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_nav_mobile'])) echo $_G['setting']['pluginhooks']['forumdisplay_nav_mobile'];?>
</div>
<div class="dhnav_box">
<div id="dhnav">
<div id="dhnav_li">
<ul class="flex-box">
<li class="flex<?php if($_REQUEST['sortall']==1||(!$_REQUEST['typeid'] && !$_REQUEST['sortid']&& !$_REQUEST['filter'])) { ?> mon<?php } ?>"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?><?php if($_G['forum']['threadsorts']['defaultshow']) { ?>&amp;filter=sortall&amp;sortall=1<?php } if($_GET['archiveid']) { ?>&amp;archiveid=<?php echo $_GET['archiveid'];?><?php } ?>">全部</a></li>
<li class="flex<?php if($_GET['filter'] == 'lastpost') { ?> mon<?php } ?>"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=lastpost&amp;orderby=lastpost<?php echo $forumdisplayadd['lastpost'];?><?php if($_GET['archiveid']) { ?>&amp;archiveid=<?php echo $_GET['archiveid'];?><?php } ?>">最新</a></li>
<li class="flex<?php if($_GET['filter'] == 'heat') { ?> mon<?php } ?>"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=heat&amp;orderby=heats<?php echo $forumdisplayadd['heat'];?><?php if($_GET['archiveid']) { ?>&amp;archiveid=<?php echo $_GET['archiveid'];?><?php } ?>">热门</a></li>
<li class="flex<?php if($_GET['filter'] == 'hot') { ?> mon<?php } ?>"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=hot">热帖</a></li>
<li class="flex<?php if($_GET['filter'] == 'digest') { ?> mon<?php } ?>"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=digest&amp;digest=1<?php echo $forumdisplayadd['digest'];?><?php if($_GET['archiveid']) { ?>&amp;archiveid=<?php echo $_GET['archiveid'];?><?php } ?>">精华</a></li>
</ul>
</div>
</div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_middle'])) echo $_G['setting']['pluginhooks']['forumdisplay_middle'];?>
<?php if($_G['forum']['threadsorts'] || ($_G['forum']['threadtypes'] && $_G['forum']['threadtypes']['listable'])) { ?>
<div class="dhnavs_box">
<div id="dhnavs">
<div id="dhnavs_li">
<ul class="swiper-wrapper">
<?php if(($_G['forum']['threadtypes'] && $_G['forum']['threadtypes']['listable'])) { if($_G['forum']['threadtypes']) { if(isset($_G['forum']['threadtypes']['types']) && is_array($_G['forum']['threadtypes']['types'])) foreach($_G['forum']['threadtypes']['types'] as $id => $name) { ?><li class="swiper-slide<?php if($_GET['typeid'] == $id) { ?> mon<?php } ?>"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=typeid&amp;typeid=<?php echo $id;?><?php echo $forumdisplayadd['typeid'];?><?php if($_GET['archiveid']) { ?>&amp;archiveid=<?php echo $_GET['archiveid'];?><?php } ?>"><?php echo $name;?></a></li>
<?php } } } if($_G['forum']['threadsorts']) { if(isset($_G['forum']['threadsorts']['types']) && is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $id => $name) { if($_GET['sortid'] == $id) { ?>
<li class="swiper-slide mon"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?><?php if($_GET['typeid']) { ?>&amp;filter=typeid&amp;typeid=<?php echo $_GET['typeid'];?><?php } if($_GET['archiveid']) { ?>&amp;archiveid=<?php echo $_GET['archiveid'];?><?php } ?>"><?php echo $name;?></a></li>
<?php } else { ?>
<li class="swiper-slide"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=sortid&amp;sortid=<?php echo $id;?><?php echo $forumdisplayadd['sortid'];?><?php if($_GET['archiveid']) { ?>&amp;archiveid=<?php echo $_GET['archiveid'];?><?php } ?>"><?php echo $name;?></a></li>
<?php } } } ?>
</ul>
</div>
</div>
</div>
<script>
if($("#dhnavs_li .mon").length > 0) {
var discuz_nav = $("#dhnavs_li .mon").offset().left + $("#dhnavs_li .mon").width() >= $(window).width() ? $("#dhnavs_li .mon").index() : 0;
}else{
var discuz_nav = 0;
}	
new Swiper('#dhnavs_li', {
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
</script>
<?php } if($subexists && $_G['page'] == 1) { include template('forum/forumdisplay_subforum'); } if(!$subforumonly) { ?>
<div class="threadlist_box<?php if(((in_array($thread['displayorder'], array(1, 2, 3, 4))) || !empty($announcement)) && $_G['page'] == 1) { ?> mt10<?php } ?> cl">
<div class="threadlist cl">
<ul>
<?php if(!empty($announcement)) { ?>
<li class="list_top"><?php if(empty($announcement['type'])) { ?><a href="forum.php?mod=announcement&amp;id=<?php echo $announcement['id'];?>#<?php echo $announcement['id'];?>"><?php } else { ?><a href="<?php echo $announcement['message'];?>"><?php } ?><span class="micon gonggao">公告</span><?php echo $announcement['subject'];?></a></li>
<?php } if($_G['forum_threadcount']) { if(isset($_G['forum_threadlist']) && is_array($_G['forum_threadlist'])) foreach($_G['forum_threadlist'] as $key => $thread) { if(!$_G['setting']['mobile']['forum']['displayorder3'] && $thread['displayorder'] > 0) { continue;?><?php } if($thread['displayorder'] > 0 && !$displayorder_thread) { $displayorder_thread = 1;?><?php } if($thread['moved']) { $thread['tid']=$thread['closed'];?><?php } if(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
<li class="list_top">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>">
<?php if(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
<span class="micon">置顶</span>
<?php } ?>
<em <?php echo $thread['highlight'];?>><?php echo $thread['subject'];?></em>					
</a>
</li>
<?php } else { ?>
<li class="list">
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_thread_mobile'][$key])) echo $_G['setting']['pluginhooks']['forumdisplay_thread_mobile'][$key];?>
<div class="threadlist_top cl">
<?php if($thread['authorid'] && $thread['author']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" class="mimg"><img src="<?php echo avatar($thread['authorid'], 'middle', true);?>"></a>
<?php } else { ?>
<a href="javascript:;" class="mimg"><img src="<?php echo avatar(0, 'middle', true);?>" /></a>
<?php } ?>
<div class="muser">
<h3>
<?php if($thread['authorid'] && $thread['author']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" class="mmc"><?php echo $thread['author'];?></a>
<?php } else { ?>
<?php echo $_G['setting']['anonymoustext'];?>
<?php } ?>
</h3>
<span class="mtime"><?php echo $thread['dateline'];?></span>
</div>
</div>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>">
<div class="threadlist_tit cl">
<?php if($thread['folder'] == 'lock') { ?>
<span class="micon lock">关闭的主题</span>
<?php } elseif($thread['special'] == 1) { ?>
<span class="micon">投票</span>
<?php } elseif($thread['special'] == 2) { ?>
<span class="micon">商品</span>
<?php } elseif($thread['special'] == 3) { ?>
<span class="micon">悬赏</span>
<?php } elseif($thread['special'] == 4) { ?>
<span class="micon">活动</span>
<?php } elseif($thread['special'] == 5) { ?>
<span class="micon">辩论</span>
<?php } if($thread['attachment'] == 2 && $_G['setting']['mobile']['mobilesimpletype'] == 1) { ?>
<span class="micon">图</span>
<?php } if(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
<span class="micon top">置顶</span>
<?php } if($thread['digest'] > 0) { ?>
<span class="micon digest">精华</span>
<?php } ?>
<em <?php echo $thread['highlight'];?>><?php echo $thread['subject'];?></em>
</div>
</a>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>"><div class="threadlist_mes cl"><?php echo $threadlist_data[$thread['tid']]['message'];?></div></a>
<?php if($threadlist_data[$thread['tid']]['attachment']) { $attach_on = 0;?><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>">
<div class="<?php if(count($threadlist_data[$thread['tid']]['attachment']) == 1) { ?>threadlist_imgs1 <?php } elseif(count($threadlist_data[$thread['tid']]['attachment']) == 2) { ?> threadlist_imgs threadlist_imgs2<?php } else { ?> threadlist_imgs<?php } ?> cl">
<ul><?php if(isset($threadlist_data[$thread['tid']]['attachment']) && is_array($threadlist_data[$thread['tid']]['attachment'])) foreach($threadlist_data[$thread['tid']]['attachment'] as $value) { $attach_on++; if($attach_on > 9) break;?><li><?php if(count($threadlist_data[$thread['tid']]['attachment']) > 9 && $attach_on == 9) { ?><em><?php echo count($threadlist_data[$thread['tid']]['attachment']); ?>图</em><?php } ?><img src="<?php echo $value;?>" class="vm"></li>
<?php } ?>
</ul>
</div>
</a>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_thread_content_mobile'][$key])) echo $_G['setting']['pluginhooks']['forumdisplay_thread_content_mobile'][$key];?>

<div class="threadlist_foot cl">
<ul>
<?php if($thread['typeid']) { ?>
<li class="mr"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $thread['fid'];?>&amp;filter=typeid&amp;typeid=<?php echo $thread['typeid'];?>">#<?php echo $_G['forum']['threadtypes']['types'][$thread['typeid']];?></a></li>
<?php } ?>
<li><i class="dm-eye-fill"></i><?php echo $thread['views'];?></li>
<li><i class="dm-chat-s-fill"></i><?php echo $thread['replies'];?></li>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_thread_foot_mobile'][$key])) echo $_G['setting']['pluginhooks']['forumdisplay_thread_foot_mobile'][$key];?>
</ul>
</div>
</li>
<?php } } } else { ?>
<h4>本版块或指定的范围内尚无主题</h4>
<?php } ?>
</ul>
</div>
<?php echo $multipage;?>
</div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_bottom_mobile'])) echo $_G['setting']['pluginhooks']['forumdisplay_bottom_mobile'];?><?php include template('common/footer'); ?>