<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_pm');
0
|| checktplrefresh('./template/default/touch/home/space_pm.htm', './template/default/touch/home/space_pm_node.htm', 1726596997, 'diy', './data/template/2_diy_touch_home_space_pm.tpl.php', './template/default', 'touch/home/space_pm')
;?>
<?php $_G['home_tpl_titles'] = array('短消息');?><?php include template('common/header'); if(in_array($filter, array('privatepm')) || in_array($_GET['subop'], array('view'))) { if(in_array($filter, array('privatepm'))) { ?>
<div class="header cl">
<div class="mz"><a href="javascript:history.back();"><i class="dm-c-left"></i></a></div>
<h2>我的消息</h2>
<div class="my"><a href="home.php?mod=spacecp&amp;ac=pm"><i class="dm-edit"></i></a></div>
</div>
<div class="dhnv flex-box cl">
<a href="home.php?mod=space&amp;do=pm" class="flex mon">我的消息<?php if($newpmcount) { ?><strong>(<?php echo $newpmcount;?>)</strong><?php } ?></a>
<a href="home.php?mod=space&amp;do=notice" class="flex">我的提醒<?php if($_G['member']['newprompt']) { ?><strong>(<?php echo $_G['member']['newprompt'];?>)</strong><?php } ?></a>
</div>
<div id="pmlist" class="imglist mt10 cl">
<ul><?php if(isset($list) && is_array($list)) foreach($list as $key => $value) { ?><li>
<span class="mimg"><a href="<?php if($value['touid']) { ?>home.php?mod=space&do=pm&subop=view&touid=<?php echo $value['touid'];?><?php } else { ?>home.php?mod=space&do=pm&subop=view&plid=<?php echo $value['plid'];?>&type=1<?php } ?>"><img src="<?php if($value['pmtype'] == 2) { ?><?php echo STATICURL;?>image/common/grouppm.png<?php } else { ?><?php echo avatar($value['touid'] ? $value['touid'] : ($value['lastauthorid'] ? $value['lastauthorid'] : $value['authorid']), 'small', true);?><?php } ?>"></a></span>
<a href="<?php if($value['touid']) { ?>home.php?mod=space&do=pm&subop=view&touid=<?php echo $value['touid'];?><?php } else { ?>home.php?mod=space&do=pm&subop=view&plid=<?php echo $value['plid'];?>&type=1<?php } ?>">
<p class="mtit">
<span class="mtime"><?php echo dgmdate($value['dateline'], 'u');?></span>
<?php if($value['new']) { ?><span class="mnum"><?php echo $value['pmnum'];?></span><?php } if($value['touid']) { if($value['msgfromid'] == $_G['uid']) { ?>
我对 <?php echo $value['tousername'];?> 说:
<?php } else { ?>
<?php echo $value['tousername'];?> 对我 说:
<?php } } elseif($value['pmtype'] == 2) { ?>
发起者:<?php echo $value['firstauthor'];?>
<?php } ?>
</p>
<p class="mtxt">
<?php if($value['pmtype'] == 2) { ?>[群聊]<?php if($value['subject']) { ?><?php echo $value['subject'];?><br><?php } } if($value['pmtype'] == 2 && $value['lastauthor']) { ?><?php echo $value['lastauthor'];?> : <?php echo $value['message'];?><?php } else { ?><?php echo $value['message'];?><?php } ?>
</p>
</a>
</li>
<?php } ?>
</ul>
</div>
<?php } elseif(in_array($_GET['subop'], array('view'))) { $msguser = $tousername;?><div class="header cl">
<div class="mz"><a href="javascript:history.back();"><i class="dm-c-left"></i></a></div>
<h2><?php if($chatpmmember) { ?>查看消息<?php } else { ?>正在与<?php echo $msguser;?>聊天中……<?php } ?></h2>
<div class="my"><a href="index.php"><i class="dm-house"></i></a></div>
</div>
<div class="msgbox b_m">
<?php if(!$list) { ?>
<div class="threadlist_box mt10 cl">
<h4>当前没有相应的短消息</h4>
</div>
<?php } else { if(isset($list) && is_array($list)) foreach($list as $key => $value) { if($value['msgfromid'] != $_G['uid']) { ?>
<div class="friend_msg cl">
<div class="avat z"><img src="<?php echo avatar($value['msgfromid'], 'small', true);?>" class="vm"></div>
<div class="dialog_green z">
<div class="dialog_c"><?php echo $value['message'];?></div>
<div class="date"><?php echo dgmdate($value['dateline'], 'u');?></div>
</div>
</div>
<?php } else { ?>
<div class="self_msg cl">
<div class="avat y"><img src="<?php echo avatar($value['msgfromid'], 'small', true);?>" class="vm"></div>
<div class="dialog_white y">			
<div class="dialog_c"><?php echo $value['message'];?></div>
<div class="date"><?php echo dgmdate($value['dateline'], 'u');?></div>
</div>
</div>
<?php } } ?>
<?php echo $multi;?>
<div id="dumppage" style="display:none">
<?php } ?>
</div>
<form id="pmform" class="pmform" name="pmform" method="post" action="home.php?mod=spacecp&amp;ac=pm&amp;op=send&amp;pmid=<?php echo $pmid;?>&amp;daterange=<?php echo $daterange;?>&amp;pmsubmit=yes&amp;mobile=2" >
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if(!$touid) { ?>
<input type="hidden" name="plid" value="<?php echo $plid;?>" />
<?php } else { ?>
<input type="hidden" name="touid" value="<?php echo $touid;?>" />
<?php } ?>
<div class="foot_height"></div>
<div class="foot msg_post flex-box">
<input type="text" value="" class="flex px" autocomplete="off" id="replymessage" name="message" placeholder="请输入内容..." />
<input type="button" name="pmsubmit" id="pmsubmit" class="formdialog pns" value="发送" />
</div>
</form><?php $nofooter = true;?><?php } } else { ?>
<div class="threadlist_box mt10 cl">
<div class="threadlist cl">
<h4>手机版不支持复杂短消息操作，请返回<a href="home.php?mod=space&amp;do=pm&amp;filter=privatepm">我的短消息</a></h4>
</div>
</div>
<?php } include template('common/footer'); ?>