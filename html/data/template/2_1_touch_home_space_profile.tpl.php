<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_profile');?>
<?php if($_GET['mycenter'] && !$_G['uid']) { dheader('Location:member.php?mod=logging&action=login');exit;?><?php } elseif($_GET['mycenter'] && $_G['uid'] != $space['uid']) { dheader('Location:home.php?mod=space&uid='.$_G['uid'].'&do=profile&mycenter=1');exit;?><?php } include template('common/header'); ?><style>.user_avatar {background-image:url(<?php echo avatar($space['uid'], 'big', true);?>) !important}</style>
<div class="header cl">
<div class="mz"><a href="javascript:history.back();"><i class="dm-c-left"></i></a></div>
<h2><?php if($_G['uid'] == $space['uid']) { ?>我的资料<?php } else { ?><?php echo $space['username'];?>的资料<?php } ?></h2>
<div class="my"><a href="index.php"><i class="dm-house"></i></a></div>
</div>
<div class="userinfo">
<div class="user_avatar">
<div class="avatar_bg">
<div class="avatar_m"><img src="<?php echo avatar($space['uid'], 'middle', true);?>" /></div>
<h2 class="name"><?php echo $space['username'];?></h2>
</div>
</div>
<div class="user_box cl" onclick="window.location.href='home.php?mod=spacecp&ac=credit&op=log'">
<ul>
<li><span><?php echo $space['credits'];?></span>积分</li><?php if(isset($_G['setting']['extcredits']) && is_array($_G['setting']['extcredits'])) foreach($_G['setting']['extcredits'] as $key => $value) { if($value['title']) { ?>
<li><span><?php echo $space["extcredits$key"];?> <?php echo $value['unit'];?></span><?php echo $value['title'];?></li>
<?php } } ?>
</ul>
</div>
<?php if($_G['setting']['magicstatus'] && $_G['setting']['magics']['gift']) { $magicgiftinfo = !empty($space['magicgift']) ? dunserialize($space['magicgift']) : array();?><?php if($magicgiftinfo['left'] && !in_array($_G['uid'], (array)$magicgiftinfo['receiver']) && $_G['uid'] != $space['uid']) { $percredit = min($magicgiftinfo['percredit'], $magicgiftinfo['left']);?><?php $extcredits = str_replace('extcredits', '', $magicgiftinfo['credittype']);?><?php $credittype = $_G['setting']['extcredits'][$extcredits]['title'];?><div class="bodybox dzcell-group-inset m15 p10 cl">
<a href="home.php?mod=spacecp&amp;ac=magic&amp;op=receivegift&amp;uid=<?php echo $space['uid'];?>" class="dialog">
<div class="dzcell-item">
<div><img src="<?php echo STATICURL;?>image/magic/gift.small.gif" class="vm" /><?php echo lang('magic/gift', 'gift_receive_gift', array('percredit'=>$percredit,'credittype'=>$credittype))?></div>
</div>
</a>
</div>
<?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['space_profile_top_mobile'])) echo $_G['setting']['pluginhooks']['space_profile_top_mobile'];?>
<div class="myinfo_list_ico cl">
<ul>
<?php if(helper_access::check_module('forum')) { ?>
<li><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=thread<?php if($_G['uid'] == $space['uid']) { ?>&amp;view=me<?php } ?>"><i class="dm-chat-s-fill"></i><?php if($_G['uid'] == $space['uid']) { ?>我的主题<?php } else { ?>Ta的主题<?php } ?></a></li>
<?php } if(helper_access::check_module('blog')) { ?>
<li><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=blog<?php if($_G['uid'] == $space['uid']) { ?>&amp;view=me<?php } ?>"><i class="dm-chat-s-fill"></i><?php if($_G['uid'] == $space['uid']) { ?>我的日志<?php } else { ?>Ta的日志<?php } ?></a></li>
<?php } if(helper_access::check_module('favorite') && $_G['uid'] == $space['uid']) { ?>
<li><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=favorite&amp;view=me&amp;type=thread"><i class="dm-star-fill"></i>我的收藏</a></li>
<?php } if($_G['uid'] == $space['uid']) { ?>
<li><a href="home.php?mod=space&amp;do=pm"><i class="dm-chat-t-fill"></i>消息提醒<?php if($_G['member']['newpm'] || $_G['member']['newprompt']) { ?><em>NEW</em><?php } ?></a></li>
<?php } else { ?>
<li><a href="home.php?mod=space&amp;do=pm&amp;subop=view&amp;touid=<?php echo $space['uid'];?>"><i class="dm-chat-t-fill"></i>发短消息</a></li>
<?php } if(helper_access::check_module('friend')) { if($_G['uid'] == $space['uid']) { ?>
<li><a href="home.php?mod=space&amp;do=friend"><i class="dm-person-fill"></i>我的好友</a></li>
<?php } else { require_once libfile('function/friend');$isfriend=friend_check($space['uid']);?><?php if(!$isfriend) { ?>
<li><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $space['uid'];?>&amp;handlekey=addfriendhk_<?php echo $space['uid'];?>" id="a_friend_li_<?php echo $space['uid'];?>" class="dialog"><i class="dm-person-fill"></i>加为好友</a></li>
<?php } else { ?>
<li><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?php echo $space['uid'];?>&amp;handlekey=ignorefriendhk_<?php echo $space['uid'];?>" id="a_ignore_<?php echo $space['uid'];?>" class="dialog"><i class="dm-person-fill"></i>解除好友</a></li>
<?php } } } if(($_G['setting']['ec_ratio'] || $_G['setting']['card']['open']) && $_G['uid'] == $space['uid']) { ?>
<li><a href="home.php?mod=spacecp&amp;ac=credit&amp;op=buy"><i class="dm-person-fill"></i>积分充值</a></li>
<?php } if($_G['setting']['magicstatus'] && $_G['setting']['magics']['gift']) { if($_G['uid'] == $space['uid']) { if($magicgiftinfo) { ?>
<li><a href="home.php?mod=spacecp&amp;ac=magic&amp;op=retiregift" class="dialog"><i><img src="<?php echo STATICURL;?>image/magic/gift.small.gif" class="vm"></i><?php echo lang('magic/gift', 'gift_gc');?></a></li>
<?php } else { ?>
<li><a href="home.php?mod=magic&amp;mid=gift" class="dialog"><i><img src="<?php echo STATICURL;?>image/magic/gift.small.gif" class="vm"></i><?php echo lang('magic/gift', 'gift_use');?></a></li>
<?php } } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['space_profile_nav_extra_mobile'])) echo $_G['setting']['pluginhooks']['space_profile_nav_extra_mobile'];?>
</ul>
</div>
<?php if($space['group']['maxsigsize'] && $space['sightml']) { ?>
<div class="myinfo_list cl">
<ul>
<li><b>个人签名</b></li>
<li class="sig"><?php echo $space['sightml'];?></li>
</ul>
</div>
<?php } ?>
<div class="myinfo_list cl">
<ul>
<?php if(!empty($_G['setting']['pluginhooks']['space_profile_baseinfo_top_mobile'])) echo $_G['setting']['pluginhooks']['space_profile_baseinfo_top_mobile'];?>
<li><b>个人资料</b><?php if($_G['uid'] == $space['uid']) { ?><span class="mtxt"><a href="home.php?mod=spacecp" style="color: #fff;">设置</a></span><?php } else { if($_G['ols'][$space['uid']]) { ?><span class="mtxt">在线</span><?php } } ?></li>
<li>UID<span><?php echo $space['uid'];?></span></li>
<li>用户组<?php if(!empty($space['groupexpiry'])) { ?><em>有效期至<?php echo dgmdate($space['groupexpiry'], 'Y-m-d H:i');?></em><?php } ?><span style="color:<?php echo $space['group']['color'];?>"><?php echo $space['group']['grouptitle'];?></span></li>
<?php if($space['adminid']) { ?><li>管理组<span style="color:<?php echo $space['admingroup']['color'];?>"><?php echo $space['admingroup']['grouptitle'];?></span></li><?php } if($space['extgroupids']) { ?><li>扩展用户组<span><?php echo $space['extgroupids'];?></span></li><?php } if(isset($profiles) && is_array($profiles)) foreach($profiles as $value) { ?><li><?php echo $value['title'];?><span><?php echo $value['value'];?></span></li>
<?php } if(in_array($_G['adminid'], array(1, 2))) { ?><li>Email<span><?php echo $space['email'];?></span></li><?php } if($space['spacenote']) { ?><li>最新记录<span><?php echo $space['spacenote'];?></span></li><?php } if($space['customstatus']) { ?><li>自定义头衔<span><?php echo $space['customstatus'];?></span></li><?php } if($space['oltime'] && !$_G['setting']['sessionclose']) { ?><li>在线时间<span><?php echo $space['oltime'];?> 小时</span></li><?php } ?>
<li>注册时间<span><?php echo $space['regdate'];?></span></li>
<li>最后访问<span><?php echo $space['lastvisit'];?></span></li>
<?php if(!empty($_G['setting']['pluginhooks']['space_profile_baseinfo_bottom_mobile'])) echo $_G['setting']['pluginhooks']['space_profile_baseinfo_bottom_mobile'];?>
</ul>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['space_profile_extrainfo_mobile'])) echo $_G['setting']['pluginhooks']['space_profile_extrainfo_mobile'];?>
<?php if($_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)) { ?>
<div class="btn_admincp"><a href="admin.php" class="pn">管理中心</a></div>
<?php } if($space['uid'] == $_G['uid']) { ?>
<div class="btn_exit"><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>" class="pn">退出登录</a></div>
<?php } ?>
</div>
<?php if(!$_GET['mycenter']) { $nofooter = true;?><?php } include template('common/footer'); ?>