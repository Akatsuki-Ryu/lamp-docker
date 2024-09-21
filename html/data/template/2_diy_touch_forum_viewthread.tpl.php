<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('viewthread');?><?php include template('common/header'); ?><div class="header cl">
<div class="mz"><a href="javascript:history.back();"><i class="dm-c-left"></i></a></div>
<h2><a href="<?php if($_GET['fromguid'] == 'hot' && $_G['setting']['guidestatus']) { ?>forum.php?mod=guide&view=hot&page=<?php echo $_GET['page'];?><?php } else { ?>forum.php?mod=forumdisplay&fid=<?php echo $_G['fid'];?>&<?php echo rawurldecode($_GET['extra']);?><?php } ?>"><?php echo strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name'];?></a></h2>
<div class="my"><a href="index.php"><i class="dm-house"></i></a></div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_top_mobile'])) echo $_G['setting']['pluginhooks']['viewthread_top_mobile'];?>
<div class="viewthread">
<div class="view_tit">
<?php if($_G['forum_thread']['typeid'] && $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']]) { ?>
<em>[<?php echo $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']];?>]</em>
<?php } if($threadsorts && $_G['forum_thread']['sortid']) { ?>
<em>[<?php echo $_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']];?>]</em>
<?php } ?>
<?php echo $_G['forum_thread']['subject'];?>
<?php if($_G['forum_thread']['displayorder'] == -2) { ?> <span>(审核中)</span>
<?php } elseif($_G['forum_thread']['displayorder'] == -3) { ?> <span>(已忽略)</span>
<?php } elseif($_G['forum_thread']['displayorder'] == -4) { ?> <span>(草稿)</span>
<?php } ?>
</div><?php $postcount = 0;?><?php if(isset($postlist) && is_array($postlist)) foreach($postlist as $post) { $needhiddenreply = ($hiddenreplies && $_G['uid'] != $post['authorid'] && $_G['uid'] != $_G['forum_thread']['authorid'] && !$post['first'] && !$_G['forum']['ismoderator']);?><?php if(!empty($_G['setting']['pluginhooks']['viewthread_posttop_mobile'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_posttop_mobile'][$postcount];?>
<div class="plc cl" id="pid<?php echo $post['pid'];?>">
<div class="avatar"><img src="<?php if(!$post['authorid'] || $post['anonymous']) { ?><?php echo avatar(0, 'small', true);?><?php } else { ?><?php echo avatar($post['authorid'], 'small', true);?><?php } ?>" /></div>
<div class="display pi<?php if($post['first']) { ?> pione<?php } ?>">
<ul class="authi">
<li class="mtit">
<span class="y">
<?php if(isset($post['isstick'])) { ?>
<img src ="<?php echo IMGDIR;?>/settop.png" class="vm" /> 来自 <?php echo $post['number'];?><?php echo $postnostick;?>
<?php } elseif($post['number'] == -1) { ?>
推荐
<?php } else { if(!empty($postno[$post['number']])) { ?><?php echo $postno[$post['number']];?><?php } else { ?><?php echo $post['number'];?><?php echo $postno[0];?><?php } } ?>
</span>
<span class="z">
<?php if($post['authorid'] && $post['username'] && !$post['anonymous']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>"><?php echo $post['author'];?></a>
<?php } else { if(!$post['authorid']) { ?>
<a href="javascript:;">游客 <em><?php echo $post['useip'];?><?php if($post['port']) { ?>:<?php echo $post['port'];?><?php } ?></em></a>
<?php } elseif($post['authorid'] && $post['username'] && $post['anonymous']) { if($_G['forum']['ismoderator']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>"><?php echo $_G['setting']['anonymoustext'];?></a><?php } else { ?><?php echo $_G['setting']['anonymoustext'];?><?php } } else { ?>
<?php echo $post['author'];?> <em>该用户已被删除</em>
<?php } } ?>
</span>
</li>
<li class="mtime">
<?php if($post['first']) { ?><span class="y"><i class="dm-eye"></i><em><?php echo $_G['forum_thread']['views'];?></em><i class="dm-chat-s"></i><em><?php echo $_G['forum_thread']['allreplies'];?></em></span><?php } if($post['first'] && $modmenu['thread']) { ?>
<em class="mgl"><a href="#moption_<?php echo $post['pid'];?>" class="popup blue">管理</a></em>
<div id="moption_<?php echo $post['pid'];?>" popup="true" class="manage" style="display:none;">
<div class="manage_popup pb10 cl">
<?php if(!$_G['forum_thread']['special']) { ?>
<a class="button" href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if($_G['forum_thread']['sortid']) { if($post['first']) { ?>&amp;sortid=<?php echo $_G['forum_thread']['sortid'];?><?php } } if(!empty($_GET['modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?>">编辑</a>
<?php } if($_G['forum']['ismoderator']) { if($_G['group']['allowdelpost']) { ?>
<input type="button" value="删除主题" class="dialog button" href="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;operation=delete&amp;optgroup=3&amp;from=<?php echo $_G['tid'];?>">
<?php } if($_G['group']['allowbumpthread'] && !$_G['forum_thread']['is_archived']) { ?>
<input type="button" value="升降" class="dialog button" href="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;operation=bump&amp;optgroup=3&amp;from=<?php echo $_G['tid'];?>">
<?php } if($_G['group']['allowstickthread'] && ($_G['forum_thread']['displayorder'] <= 3 || $_G['adminid'] == 1) && !$_G['forum_thread']['is_archived']) { ?>
<input type="button" value="置顶" class="dialog button" href="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;operation=stick&amp;optgroup=1&amp;from=<?php echo $_G['tid'];?>">
<?php } if($_G['group']['allowlivethread'] && !$_G['forum_thread']['is_archived']) { ?>
<input type="button" value="直播" class="dialog button" href="forum.php?mod=topicadmin&amp;action=live&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">
<?php } if($_G['group']['allowhighlightthread'] && !$_G['forum_thread']['is_archived']) { ?>
<input type="button" value="高亮" class="dialog button" href="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;operation=highlight&amp;optgroup=1&amp;from=<?php echo $_G['tid'];?>">
<?php } if($_G['group']['allowdigestthread'] && !$_G['forum_thread']['is_archived']) { ?>
<input type="button" value="精华" class="dialog button" href="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;operation=digest&amp;optgroup=1&amp;from=<?php echo $_G['tid'];?>">
<?php } if($_G['group']['allowrecommendthread'] && !empty($_G['forum']['modrecommend']['open']) && $_G['forum']['modrecommend']['sort'] != 1 && !$_G['forum_thread']['is_archived']) { ?>
<input type="button" value="推荐" class="dialog button" href="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;operation=recommend&amp;optgroup=1&amp;from=<?php echo $_G['tid'];?>">
<?php } if($_G['group']['allowstampthread'] && !$_G['forum_thread']['is_archived']) { ?>
<input type="button" value="图章" class="dialog button" href="forum.php?mod=topicadmin&amp;action=stamp&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">
<?php } if($_G['group']['allowstamplist'] && !$_G['forum_thread']['is_archived']) { ?>
<input type="button" value="图标" class="dialog button" href="forum.php?mod=topicadmin&amp;action=stamplist&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">
<?php } if($_G['group']['allowclosethread'] && !$_G['forum_thread']['is_archived'] && $_G['forum']['status'] != 3) { ?>
<input type="button" value="<?php if(!$_G['forum_thread']['closed']) { ?>关闭<?php } else { ?>打开<?php } ?>" class="dialog button" href="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;from=<?php echo $_G['tid'];?>&amp;optgroup=4">
<?php } if($_G['group']['allowmovethread'] && !$_G['forum_thread']['is_archived'] && $_G['forum']['status'] != 3) { ?>
<input type="button" value="移动" class="dialog button" href="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;operation=move&amp;optgroup=2&amp;from=<?php echo $_G['tid'];?>">
<?php } if($_G['group']['allowedittypethread'] && !$_G['forum_thread']['is_archived']) { ?>
<input type="button" value="分类" class="dialog button" href="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;operation=type&amp;optgroup=2&amp;from=<?php echo $_G['tid'];?>">
<?php } if(!$_G['forum_thread']['special'] && !$_G['forum_thread']['is_archived']) { if($_G['group']['allowcopythread'] && $_G['forum']['status'] != 3) { ?>
<input type="button" value="复制" class="dialog button" href="forum.php?mod=topicadmin&amp;action=copy&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">
<?php } if($_G['group']['allowmergethread'] && $_G['forum']['status'] != 3) { ?>
<input type="button" value="合并" class="dialog button" href="forum.php?mod=topicadmin&amp;action=merge&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">
<?php } if($_G['group']['allowrefund'] && $_G['forum_thread']['price'] > 0) { ?>
<input type="button" value="撤销付费" class="dialog button" href="forum.php?mod=topicadmin&amp;action=refund&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">
<?php } } if($_G['group']['allowsplitthread'] && !$_G['forum_thread']['is_archived'] && $_G['forum']['status'] != 3) { ?>
<input type="button" value="分割" class="dialog button" href="forum.php?mod=topicadmin&amp;action=split&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">
<?php } if($_G['group']['allowrepairthread'] && !$_G['forum_thread']['is_archived']) { ?>
<input type="button" value="修复" class="dialog button" href="forum.php?mod=topicadmin&amp;action=repair&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">
<?php } if($_G['forum_firstpid']) { if($_G['group']['allowwarnpost']) { ?>
<input type="button" value="警告" class="dialog button" href="forum.php?mod=topicadmin&amp;action=warn&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">
<?php } if($_G['group']['allowbanpost']) { ?>
<input type="button" value="屏蔽" class="dialog button" href="forum.php?mod=topicadmin&amp;action=banpost&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">
<?php } } if($_G['group']['allowremovereward'] && $_G['forum_thread']['special'] == 3 && !$_G['forum_thread']['is_archived']) { ?>
<input type="button" value="移除悬赏" class="dialog button" href="forum.php?mod=topicadmin&amp;action=removereward&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">
<?php } if($_G['forum']['status'] == 3 && in_array($_G['adminid'], array('1','2')) && $_G['forum_thread']['closed'] < 1) { ?>
<input type="button" value="推到版块" class="dialog button" href="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;operation=recommend_group&amp;optgroup=5&amp;from=<?php echo $_G['tid'];?>">
<?php } if($_G['group']['allowmanagetag']) { ?>
<a href="forum.php?mod=tag&amp;op=manage&amp;tid=<?php echo $_G['tid'];?>" class="dialog button">标签</a>
<?php } if($_G['group']['alloweditusertag']) { ?>
<a href="forum.php?mod=misc&amp;action=usertag&amp;tid=<?php echo $_G['tid'];?>" class="dialog button">用户标签</a>
<?php } } if($allowpusharticle && $allowpostarticle) { ?>
<a href="portal.php?mod=portalcp&amp;ac=article&amp;from_idtype=tid&amp;from_id=<?php echo $_G['tid'];?>" class="dialog button">生成文章</a>
<?php } if(!empty($post['totalrate']) && $_G['forum']['ismoderator']) { ?>
<input type="button" value="撤销评分" class="dialog button" href="forum.php?mod=misc&amp;action=removerate&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;page=<?php echo $page;?>">
<?php } ?>
</div>
</div>
<?php } elseif(!$post['first'] && $modmenu['post']) { ?>
<em class="mgl"><a href="#moption_<?php echo $post['pid'];?>" class="popup">管理</a></em>
<div id="moption_<?php echo $post['pid'];?>" popup="true" class="manage" style="display:none">
<div class="manage_popup">
<a class="button" href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if(!empty($_GET['modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?>">编辑</a>
<?php if($_G['group']['allowdelpost']) { ?>
<input type="button" value="删除" class="dialog button" href="forum.php?mod=topicadmin&amp;action=delpost&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;operation=&amp;optgroup=&amp;page=&amp;topiclist[]=<?php echo $post['pid'];?>">
<?php } if($_G['group']['allowbanpost']) { ?>
<input type="button" value="屏蔽" class="dialog button" href="forum.php?mod=topicadmin&amp;action=banpost&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;operation=&amp;optgroup=&amp;page=&amp;topiclist[]=<?php echo $post['pid'];?>">
<?php } if($_G['group']['allowwarnpost']) { ?>
<input type="button" value="警告" class="dialog button" href="forum.php?mod=topicadmin&amp;action=warn&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;operation=&amp;optgroup=&amp;page=&amp;topiclist[]=<?php echo $post['pid'];?>">
<?php } if($_G['forum']['ismoderator'] && $_G['group']['allowstickreply'] || $_G['forum_thread']['authorid'] == $_G['uid']) { ?>
<input type="button" value="置顶" class="dialog button" href="forum.php?mod=topicadmin&amp;action=stickreply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;operation=&amp;optgroup=&amp;page=&amp;topiclist[]=<?php echo $post['pid'];?>">
<?php } if($_G['forum_thread']['pushedaid'] && $allowpostarticle) { ?>
<input type="button" value="文章连载" class="dialog button" href="portal.php?mod=portalcp&amp;ac=article&amp;op=pushplus&amp;action=pushplus&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;operation=&amp;optgroup=&amp;page=&amp;topiclist[]=<?php echo $post['pid'];?>&amp;aid=<?php echo $_G['forum_thread']['pushedaid'];?>">
<?php } if(!empty($post['totalrate']) && $_G['forum']['ismoderator']) { ?>
<input type="button" value="撤销评分" class="dialog button" href="forum.php?mod=misc&amp;action=removerate&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;page=<?php echo $page;?>">
<?php } ?>
</div>
</div>
<?php } else { if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && ($post['authorid'] == $_G['uid'] && $_G['forum_thread']['closed'] == 0) && !(!$alloweditpost_status && $edittimelimit && TIMESTAMP - $post['dbdateline'] > $edittimelimit)))) { ?>
<em class="mgl"><a href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if(!empty($_GET['modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?>"><?php if($_G['forum_thread']['special'] == 2 && !$post['message']) { ?>添加柜台介绍<?php } else { ?>编辑<?php } ?></a></em>
<?php } elseif($_G['uid'] && $post['authorid'] == $_G['uid'] && $_G['setting']['postappend']) { ?>
<em class="mgl"><a href="forum.php?mod=misc&amp;action=postappend&amp;tid=<?php echo $post['tid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;page=<?php echo $page;?>">补充</a></em>
<?php } } ?>
<?php echo $post['dateline'];?>
</li>
<?php if(!$post['first'] && $_G['forum_thread']['special'] == 5) { ?>
<li class="mtime">
<?php if($post['stand'] == 1) { ?><em class="f_g"><a class="f_g" href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;filter=debate&amp;stand=1">正方</a></em>
<?php } elseif($post['stand'] == 2) { ?><em class="f_b"><a class="f_b" href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;filter=debate&amp;stand=2">反方</a></em>
<?php } else { ?><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;filter=debate&amp;stand=0">中立</a><?php } if($post['stand']) { ?>
<a class="dialog" href="forum.php?mod=misc&amp;action=debatevote&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" id="voterdebate_<?php echo $post['pid'];?>">支持 <?php echo $post['voters'];?></a>
<?php } ?>
</li>
<?php } ?>
</ul>
<div class="message">
<?php if($post['warned']) { ?>
<span class="quote">受到警告</span>
<?php } if(!$post['first'] && !empty($post['subject']) && (!$needhiddenreply)) { ?>
<h2><strong><?php echo $post['subject'];?></strong></h2>
<?php } if($_G['adminid'] != 1 && $_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || $post['status'] == -1 || $post['memberstatus'])) { ?>
<div class="quote">提示: <em>作者被禁止或删除 内容自动屏蔽</em></div>
<?php } elseif($_G['adminid'] != 1 && $post['status'] & 1) { ?>
<div class="quote">提示: <em>该帖被管理员或版主屏蔽</em></div>
<?php } elseif($needhiddenreply) { ?>
<div class="quote">此帖仅作者可见</div>
<?php } elseif($post['first'] && $_G['forum_threadpay']) { include template('forum/viewthread_pay'); } else { if($_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5))) { ?>
<div class="quote">提示: <em>作者被禁止或删除 内容自动屏蔽，只有管理员或有管理权限的成员可见</em></div>
<?php } elseif($post['status'] & 1) { ?>
<div class="quote">提示: <em>该帖被管理员或版主屏蔽，只有管理员或有管理权限的成员可见</em></div>
<?php } if($post['first'] && $_G['forum_thread']['price'] > 0 && $_G['forum_thread']['special'] == 0) { ?>
付费主题, 价格: <strong><?php echo $_G['forum_thread']['price'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]]['title'];?> </strong> <a href="forum.php?mod=misc&amp;action=viewpayments&amp;tid=<?php echo $_G['tid'];?>" >记录</a>
<?php } if($post['first'] && $threadsort && $threadsortshow) { if($threadsortshow['optionlist'] && !($post['status'] & 1) && !$_G['forum_threadpay']) { if($threadsortshow['optionlist'] == 'expire') { ?>
该信息已经过期
<?php } else { ?>
<div class="box_ex2 viewsort b_b mb10">
<h4><?php echo $_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']];?></h4><?php if(isset($threadsortshow['optionlist']) && is_array($threadsortshow['optionlist'])) foreach($threadsortshow['optionlist'] as $option) { if($option['type'] != 'info') { ?>
<?php echo $option['title'];?>: <?php if($option['value']) { ?><?php echo $option['value'];?> <?php echo $option['unit'];?><?php } else { ?><span class="fc-s">--</span><?php } ?><br />
<?php } } ?>
</div>
<?php } } } if($post['first']) { if(!$_G['forum_thread']['special']) { ?>
<?php echo $post['message'];?>
<?php } elseif($_G['forum_thread']['special'] == 1) { include template('forum/viewthread_poll'); } elseif($_G['forum_thread']['special'] == 2) { include template('forum/viewthread_trade'); } elseif($_G['forum_thread']['special'] == 3) { include template('forum/viewthread_reward'); } elseif($_G['forum_thread']['special'] == 4) { include template('forum/viewthread_activity'); } elseif($_G['forum_thread']['special'] == 5) { include template('forum/viewthread_debate'); } elseif($threadplughtml) { ?>
<?php echo $threadplughtml;?>
<?php echo $post['message'];?>
<?php } else { ?>
<?php echo $post['message'];?>
<?php } } else { ?>
<?php echo $post['message'];?>
<?php } } ?>
</div>
<?php if(($_G['setting']['mobile']['mobilesimpletype'] == 0) && (!$needhiddenreply)) { if($post['attachment']) { ?>
<div class="quote">
附件: <em><?php if($_G['uid']) { ?>您所在的用户组无法下载或查看附件<?php } else { ?>您需要<a href="member.php?mod=logging&amp;action=login">登录</a>才可以下载或查看附件。没有账号？<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" title="注册账号"><?php echo $_G['setting']['reglinkname'];?></a><?php } ?></em>
</div>
<?php } elseif($post['imagelist'] || $post['attachlist']) { if($post['imagelist']) { ?>
<ul class="img_one"><?php echo showattach($post, 1); ?></ul>
<?php } if($post['attachlist']) { ?>
<ul class="post_attlist"><?php echo showattach($post); ?></ul>
<?php } } } if($post['first']) { } ?>
<div id="comment_<?php echo $post['pid'];?>">
<?php if($_GET['from'] != 'preview' && $_G['setting']['commentnumber'] && !empty($comments[$post['pid']])) { ?>
<h3 class="psth xs1"><span class="icon_ring vm"></span>点评</h3>
<?php if($totalcomment[$post['pid']]) { ?><div class="pstl"><?php echo $totalcomment[$post['pid']];?></div><?php } if(isset($comments[$post['pid']]) && is_array($comments[$post['pid']])) foreach($comments[$post['pid']] as $comment) { ?><div class="plc p0 cl" id="commentdetail_<?php echo $comment['id'];?>">
<div class="avatar l0"><?php echo $comment['avatar'];?></div>
<div class="display pi">
<ul class="authi">
<li class="mtit">
<span class="y"><?php if($comment['useip'] && $_G['group']['allowviewip']) { ?>IP:<?php echo $comment['useip'];?><?php if($comment['port']) { ?>:<?php echo $comment['port'];?><?php } } ?></span>
<span class="z">
<?php if($comment['authorid']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="xi2 xw1"><?php echo $comment['author'];?></a>
<?php } else { ?>
游客
<?php } ?>
</span>
</li>
<li class="mtime">
<em class="mgl"><?php if($_G['forum']['ismoderator'] && $_G['group']['allowdelpost']) { ?><a href="forum.php?mod=topicadmin&amp;action=delcomment&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $comment['id'];?>&amp;page=<?php echo $_G['page'];?>" class="dialog">删除</a><?php } ?></em>
发表于 <?php echo dgmdate($comment['dateline'], 'u');?></li>
<li class="mtxt mt5"><?php echo $comment['comment'];?></li>
</ul>
</div>
</div>
<?php } if($commentcount[$post['pid']] > $_G['setting']['commentnumber']) { ?><div id="dumppage"></div><div class="pgs cl"><div class="page"><a href="javascript:;" class="nxt" onclick="ajaxget('forum.php?mod=misc&action=commentmore&tid=<?php echo $post['tid'];?>&pid=<?php echo $post['pid'];?>&page=2', 'comment_<?php echo $post['pid'];?>')">下一页</a></div></div><?php } } ?>
</div>

<?php if($_GET['from'] != 'preview' && !empty($post['ratelog'])) { ?>
<h3 class="psth xs1"><span class="icon_ring vm"></span>评分</h3>
<div id="ratelog_<?php echo $post['pid'];?>">
<?php if($_G['setting']['ratelogon']) { ?>
<dd style="margin:0">
<?php } else { ?>
<dd>
<?php } ?>
<div id="post_rate_<?php echo $post['pid'];?>"></div>
<?php if($_G['setting']['ratelogon']) { ?>
<ul class="post_box cl">
<li class="flex-box mli p0">
<div class="flex-2 xs1 xg1 xw1"><span class="z"><a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" class="dialog" title="查看全部评分"> 参与人数 <span class="xi1"><?php echo count($postlist[$post['pid']]['totalrate']);; ?></span></a></span></div><?php if(isset($post['ratelogextcredits']) && is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { if($score > 0) { ?>
<div class="flex-2 xs1 xg1 xw1"><?php echo $_G['setting']['extcredits'][$id]['title'];?> <i><span class="xi1">+<?php echo $score;?></span></i></div>
<?php } else { ?>
<div class="flex-2 xs1 xg1 xw1"><?php echo $_G['setting']['extcredits'][$id]['title'];?> <i><span class="xi1"><?php echo $score;?></span></i></div>
<?php } } ?>
<div class="flex-3 xs1 xg1 xw1">理由</div>
</li><?php if(isset($post['ratelog']) && is_array($post['ratelog'])) foreach($post['ratelog'] as $uid => $ratelog) { ?><li class="flex-box mli p0">
<div class="flex-2 xs1 xg1"><span class="z"><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank"><?php echo $ratelog['username'];?></a></span></div><?php if(isset($post['ratelogextcredits']) && is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { if($ratelog['score'][$id] > 0) { ?>
<div class="flex-2 xs1 xi1 xw1"> + <?php echo $ratelog['score'][$id];?></div>
<?php } else { ?>
<div class="flex-2 xs1 xg1 xw1"><?php echo $ratelog['score'][$id];?></div>
<?php } } ?>
<div class="flex-3 xs1 xg1"><?php echo $ratelog['reason'];?></div>
</li>
<?php } ?>
<li class="flex-box mli p0"><div class="flex xs2 xg1 xw1"><a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" title="查看全部评分" class="dialog">查看全部评分</a></div></li>
</ul>
<?php } else { ?>
<div class="forumlist">
<div class="sub-forum mlist4 cl">
<ul class="cl"><?php if(isset($post['ratelog']) && is_array($post['ratelog'])) foreach($post['ratelog'] as $uid => $ratelog) { ?><li class="b0">
<span class="micon"><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank"><?php echo avatar($uid, 'small');; ?></a></span>
<a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" class="murl"><p class="mtit"><?php echo $ratelog['username'];?></p></a><?php if(isset($ratelog['score']) && is_array($ratelog['score'])) foreach($ratelog['score'] as $id => $score) { if($score > 0) { ?>
<p class="mtit mt0"><em class='xi1'><?php echo $_G['setting']['extcredits'][$id]['title'];?> + <?php echo $score;?> <?php echo $_G['setting']['extcredits'][$id]['unit'];?></em></p>
<?php } else { ?>
<p class="mtit mt0"><span><?php echo $_G['setting']['extcredits'][$id]['title'];?> <?php echo $score;?> <?php echo $_G['setting']['extcredits'][$id]['unit'];?></span></p>
<?php } } ?>
</li>
<?php } ?>
</ul>
<div class="xs2 xg1 xw1"><a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" title="查看全部评分" class="dialog">查看全部评分</a></div>
</div>
</div>
<?php } ?>
</dd>
</div>
<?php } else { ?>
<div id="post_rate_div_<?php echo $post['pid'];?>"></div>
<?php } ?>
</div>
<div class="threadlist_foot cl">
<ul>
<?php if($_G['uid'] && $allowpostreply && !$post['first']) { ?>
<li><a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;repquote=<?php echo $post['pid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;page=<?php echo $page;?>"><i class="dm-chat-s"></i>回复</a></li>
<?php } if($_G['group']['raterange'] && $post['authorid']) { ?>
<li><a href="forum.php?mod=misc&amp;action=rate&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" class="dialog"><i class="dm-heart"></i>评分</a></li>
<?php } if($post['invisible'] == 0) { if($allowpostreply && $post['allowcomment'] && (!$thread['closed'] || $_G['forum']['ismoderator'])) { ?><li><a href="forum.php?mod=misc&amp;action=comment&amp;tid=<?php echo $post['tid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;page=<?php echo $page;?><?php if($_G['forum_thread']['special'] == 127) { ?>&amp;special=<?php echo $specialextra;?><?php } ?>" class="dialog"><i class="dm-chat-t"></i>点评</a></li><?php } } if(!$_G['forum_thread']['special'] && !$rushreply && !$hiddenreplies && $_G['setting']['repliesrank'] && !$post['first'] && !($post['isWater'] && $_G['setting']['filterednovote'])) { ?>
<li><a href="forum.php?mod=misc&amp;action=postreview&amp;do=support&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;hash=<?php echo FORMHASH;?>" class="dialog"><i class="dm-c-up"></i>支持 <span id="review_support_<?php echo $post['pid'];?>"><?php echo $post['postreview']['support'];?></span></a></li>
<li><a href="forum.php?mod=misc&amp;action=postreview&amp;do=against&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;hash=<?php echo FORMHASH;?>" class="dialog"><i class="dm-c-down"></i>反对 <span id="review_against_<?php echo $post['pid'];?>"><?php echo $post['postreview']['against'];?></span></a></li>
<?php } if($post['first']) { if(($_G['group']['allowrecommend'] || !$_G['uid']) && !empty($_G['setting']['recommendthread']['status'])) { if(!empty($_G['setting']['recommendthread']['addtext'])) { ?>
<li><a href="forum.php?mod=misc&amp;action=recommend&amp;do=add&amp;tid=<?php echo $_G['tid'];?>&amp;hash=<?php echo FORMHASH;?>" class="dialog"><i></i><i class="dm-c-up"></i><?php echo $_G['setting']['recommendthread']['addtext'];?><span id="recommendv_add"<?php if(!$_G['forum_thread']['recommend_add']) { ?> style="display:none"<?php } ?>><?php echo $_G['forum_thread']['recommend_add'];?></span></a></li>
<?php } if(!empty($_G['setting']['recommendthread']['subtracttext'])) { ?>
<li><a href="forum.php?mod=misc&amp;action=recommend&amp;do=subtract&amp;tid=<?php echo $_G['tid'];?>&amp;hash=<?php echo FORMHASH;?>" class="dialog"><i></i><i class="dm-c-down"></i><?php echo $_G['setting']['recommendthread']['subtracttext'];?><span id="recommendv_subtract"<?php if(!$_G['forum_thread']['recommend_sub']) { ?> style="display:none"<?php } ?>><?php echo $_G['forum_thread']['recommend_sub'];?></span></a></li>
<?php } } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postfooter_mobile'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postfooter_mobile'][$postcount];?>
</ul>
</div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postbottom_mobile'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postbottom_mobile'][$postcount];?><?php $postcount++;?><?php if($post['first']) { ?>
<div class="discuz_x cl"></div>
<div class="txtlist cl">
<div class="mtit cl">
<?php if(!$rushreply) { if($ordertype != 1) { ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;ordertype=1" class="ytxt">倒序浏览</a>
<?php } else { ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;ordertype=2" class="ytxt">正序浏览</a>
<?php } } if(!IS_ROBOT && !$_GET['authorid'] && !$_G['forum_thread']['archiveid']) { ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;page=<?php echo $page;?>&amp;authorid=<?php echo $_G['forum_thread']['authorid'];?>" rel="nofollow" class="ytxt">只看楼主</a>
<?php } elseif(!$_G['forum_thread']['archiveid']) { ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;page=<?php echo $page;?>" rel="nofollow" class="ytxt">看全部</a>
<?php } ?>
全部回复<?php if($_G['forum_thread']['allreplies']) { ?><em><?php echo $_G['forum_thread']['allreplies'];?></em><?php } ?>
</div>
</div>
<?php if(!$_G['forum_thread']['allreplies']) { ?>
<div class="view_reply cl"><i class="dm-sofa"></i>暂无回复，快来抢沙发</div>
<?php } } } ?>
</div>
<?php echo $multipage;?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_bottom_mobile'])) echo $_G['setting']['pluginhooks']['viewthread_bottom_mobile'];?>
<div class="foot foot_reply flex-box cl">
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;reppost=<?php echo $_G['forum_firstpid'];?>&amp;page=<?php echo $page;?>" class="flex"><i class="dm-chat-s"></i>回复</a>
<?php if(helper_access::check_module('favorite')) { ?>
<a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id=<?php echo $_G['tid'];?>" class="dialog flex mx"><i class="dm-star"></i><?php if($_G['forum_thread']['favtimes']) { ?><?php echo $_G['forum_thread']['favtimes'];?><?php } ?>收藏</a>
<?php } if(helper_access::check_module('follow')) { ?>
<a href="home.php?mod=spacecp&amp;ac=follow&amp;op=relay&amp;tid=<?php echo $_G['tid'];?>&amp;from=forum" class="dialog flex mx"><i class="fico-launch"></i><?php if($_G['forum_thread']['relay']) { ?><?php echo $_G['forum_thread']['relay'];?><?php } ?>转播</a>
<?php } if(helper_access::check_module('share')) { ?>
<a href="home.php?mod=spacecp&amp;ac=share&amp;type=thread&amp;id=<?php echo $_G['tid'];?>" class="dialog flex mx"><i class="dm-star"></i><?php if($_G['forum_thread']['sharetimes']) { ?><?php echo $_G['forum_thread']['sharetimes'];?><?php } ?>分享</a>
<?php } if(!$_G['forum']['disablecollect'] && helper_access::check_module('collection')) { ?>
<a href="forum.php?mod=collection&amp;action=edit&amp;op=addthread&amp;tid=<?php echo $_G['tid'];?>" class="dialog flex mx"><i class="fico-collection"></i><?php if($post['releatcollectionnum']) { ?><?php echo $post['releatcollectionnum'];?><?php } ?>淘帖</a>
<?php } ?>
</div>
<div class="foot_height_view"></div>
<script type="text/javascript">
$('.favbtn').on('click', function() {
var obj = $(this);
$.ajax({
type:'POST',
url:obj.attr('href') + '&handlekey=favbtn&inajax=1',
data:{'favoritesubmit':'true', 'formhash':'<?php echo FORMHASH;?>'},
dataType:'xml',
})
.success(function(s) {
popup.open(s.lastChild.firstChild.nodeValue);
evalscript(s.lastChild.firstChild.nodeValue);
})
.error(function() {
window.location.href = obj.attr('href');
popup.close();
});
return false;
});
</script>
<a href="javascript:;" class="scrolltop bottom"></a><?php $nofooter = true;?><?php include template('common/footer'); ?>