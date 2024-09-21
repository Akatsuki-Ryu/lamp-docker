<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('forum');
0
|| checktplrefresh('./template/default/touch/search/forum.htm', './template/default/touch/search/pubsearch.htm', 1726855644, '1', './data/template/2_1_touch_search_forum.tpl.php', './template/default', 'touch/search/forum')
|| checktplrefresh('./template/default/touch/search/forum.htm', './template/default/touch/search/thread_list.htm', 1726855644, '1', './data/template/2_1_touch_search_forum.tpl.php', './template/default', 'touch/search/forum')
;?><?php include template('common/header'); ?><div class="header cl">
<div class="mz"><a href="javascript:history.back();"><i class="dm-c-left"></i></a></div>
<h2>帖子搜索</h2>
<div class="my"><a href="index.php"><i class="dm-house"></i></a></div>
</div>
<form class="searchform" method="post" autocomplete="off" action="search.php?mod=forum">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" /><?php if(!empty($srchtype)) { ?><input type="hidden" name="srchtype" value="<?php echo $srchtype;?>" /><?php } ?>
<div class="search flex-box">
<input value="<?php echo $keyword;?>" autocomplete="off" class="mtxt flex" name="srchtxt" id="scform_srchtxt" value="" placeholder="搜索关键字">
<input type="hidden" name="searchsubmit" value="yes"><input type="submit" value="搜索" class="mbtn" id="scform_submit">
</div>
<?php if($_G['setting']['forumstatus'] && $_G['setting']['srchhotkeywords'] && empty($searchid)) { ?>
<div class="search-hot">
<h2>热搜: </h2>
<ul><?php if(isset($_G['setting']['srchhotkeywords']) && is_array($_G['setting']['srchhotkeywords'])) foreach($_G['setting']['srchhotkeywords'] as $val) { if($val=trim($val)) { $valenc=rawurlencode($val);?><?php
$__FORMHASH = FORMHASH;$srchhotkeywords[] = <<<EOF


EOF;
 if(!empty($searchparams['url'])) { 
$srchhotkeywords[] .= <<<EOF

<li><a href="{$searchparams['url']}?q={$valenc}&source=hotsearch{$srchotquery}">{$val}</a></li>

EOF;
 } else { 
$srchhotkeywords[] .= <<<EOF

<li><a href="search.php?mod=forum&amp;srchtxt={$valenc}&amp;formhash={$__FORMHASH}&amp;searchsubmit=true&amp;source=hotsearch">{$val}</a></li>

EOF;
 } 
$srchhotkeywords[] .= <<<EOF


EOF;
?>
<?php } } echo implode('', $srchhotkeywords);; ?></ul>
</div>
<?php } ?><?php if(!empty($_G['setting']['pluginhooks']['forum_top'])) echo $_G['setting']['pluginhooks']['forum_top'];?><?php $policymsgs = $p = '';?><?php if(isset($_G['setting']['creditspolicy']['search']) && is_array($_G['setting']['creditspolicy']['search'])) foreach($_G['setting']['creditspolicy']['search'] as $id => $policy) { ?><?php
$policymsg = <<<EOF

EOF;
 if($_G['setting']['extcredits'][$id]['img']) { 
$policymsg .= <<<EOF
{$_G['setting']['extcredits'][$id]['img']} 
EOF;
 } 
$policymsg .= <<<EOF
{$_G['setting']['extcredits'][$id]['title']} {$policy} {$_G['setting']['extcredits'][$id]['unit']}
EOF;
?><?php $policymsgs .= $p.$policymsg;$p = ', ';?><?php } if($policymsgs) { ?><p>每进行一次搜索将扣除 <?php echo $policymsgs;?></p><?php } ?>
</form>
<?php if(!empty($searchid) && submitcheck('searchsubmit', 1)) { ?><div class="threadlist_box">
<h2><?php if($keyword) { ?>结果: <em>找到 “<span class="emfont"><?php echo $keyword;?></span>” 相关内容 <?php echo $index['num'];?> 个</em> <?php if($modfid) { ?><a href="forum.php?mod=modcp&amp;action=thread&amp;fid=<?php echo $modfid;?>&amp;keywords=<?php echo $modkeyword;?>&amp;submit=true&amp;do=search&amp;page=<?php echo $page;?>">进入管理面板</a><?php } } else { ?>结果: <em>找到相关主题 <?php echo $index['num'];?> 个</em><?php } ?></h2>
<?php if(empty($threadlist)) { ?>
<h4>对不起，没有找到匹配结果。</h4>
<?php } else { $threadlist_data = get_attach($threadlist);?><div class="threadlist cl">
<ul><?php if(isset($threadlist) && is_array($threadlist)) foreach($threadlist as $thread) { ?><li class="list">
<div class="threadlist_top cl">
<a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" class="mimg"><img src="<?php echo avatar($thread['authorid'], 'middle', true);?>"></a>
<div class="muser">
<h3><a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" class="mmc"><?php echo $thread['author'];?></a></h3>
<span class="mtime"><?php echo $thread['dateline'];?></span>
</div>
</div>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>">
<div class="threadlist_tit cl">
<?php if($thread['folder'] == 'lock') { ?>
<span class="micon lock">!closed_thread!</span>
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
<?php if($threadlist_data[$thread['tid']]['attachment']) { $attach_on = 0;?><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>">
<div class="<?php if(count($threadlist_data[$thread['tid']]['attachment']) == 1) { ?>threadlist_imgs1 <?php } elseif(count($threadlist_data[$thread['tid']]['attachment']) == 2) { ?> threadlist_imgs threadlist_imgs2<?php } else { ?> threadlist_imgs<?php } ?> cl">
<ul><?php if(isset($threadlist_data[$thread['tid']]['attachment']) && is_array($threadlist_data[$thread['tid']]['attachment'])) foreach($threadlist_data[$thread['tid']]['attachment'] as $value) { $attach_on++; if($attach_on > 9) break;?><li><?php if(count($threadlist_data[$thread['tid']]['attachment']) > 9 && $attach_on == 9) { ?><em><?php echo count($threadlist_data[$thread['tid']]['attachment']); ?>图</em><?php } ?><img src="<?php echo $value;?>" class="vm"></li>
<?php } ?>
</ul>
</div>
</a>
<?php } ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>"><div class="threadlist_mes cl"><?php echo $threadlist_data[$thread['tid']]['message'];?></div></a>
<div class="threadlist_foot cl">
<ul>
<li class="mr"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $thread['fid'];?>">#<?php echo $_G['cache']['forums'][$thread['fid']]['name'];?></a></li>
<li><i class="dm-eye-fill"></i><?php echo $thread['views'];?></li>
<li><i class="dm-chat-s-fill"></i><?php echo $thread['replies'];?></li>
</ul>
</div>
</li>
<?php } ?>
</ul>
</div>
<?php } ?>
<?php echo $multipage;?>
</div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['forum_bottom'])) echo $_G['setting']['pluginhooks']['forum_bottom'];?><?php include template('common/footer'); ?>