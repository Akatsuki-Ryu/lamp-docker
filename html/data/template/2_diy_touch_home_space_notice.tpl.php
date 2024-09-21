<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_notice');?>
<?php $_G['home_tpl_titles'] = array('提醒');?><?php include template('common/header'); ?><div class="header cl">
<div class="mz"><a href="javascript:history.back();"><i class="dm-c-left"></i></a></div>
<h2>提醒</h2>
<div class="my"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=profile&amp;mycenter=1"><i class="dm-person"></i></a></div>
</div>
<div class="dhnv flex-box cl">
<a href="home.php?mod=space&amp;do=pm" class="flex">我的消息<?php if($newpmcount) { ?><strong>(<?php echo $newpmcount;?>)</strong><?php } ?></a>
<a href="home.php?mod=space&amp;do=notice" class="flex mon">我的提醒<?php if($_G['member']['newprompt']) { ?><strong>(<?php echo $_G['member']['newprompt'];?>)</strong><?php } ?></a>
</div>
<?php if(empty($list)) { ?>
<div class="threadlist_box mt10 cl">
<?php if($new == 1) { ?>
<h4>暂时没有新提醒，<a href="home.php?mod=space&amp;do=notice&amp;isread=1">点此查看已读提醒</a></h4>
<?php } else { ?>
<h4>暂时没有提醒内容</h4>
<?php } ?>
</div>
<?php } if($list) { ?>
<div id="notice_ul" class="imglist mt10 cl">
<ul><?php if(isset($list) && is_array($list)) foreach($list as $key => $value) { ?><li class="cl" <?php echo $value['rowid'];?> notice="<?php echo $value['id'];?>">		
<span class="mimg"><?php if($value['authorid']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $value['authorid'];?>"><?php echo avatar($value['authorid'],'small');?></a><?php } else { ?><img src="<?php echo IMGDIR;?>/systempm.png" alt="systempm" /><?php } ?></span>
<p class="mtit">
<a href="home.php?mod=spacecp&amp;ac=common&amp;op=ignore&amp;authorid=<?php echo $value['authorid'];?>&amp;type=<?php echo $value['type'];?>&amp;handlekey=addfriendhk_<?php echo $value['authorid'];?>" id="a_note_<?php echo $value['id'];?>" class="dialog mico">屏蔽</a>
<span><?php echo dgmdate($value['dateline'], 'u');?></span>
</p>
<p class="mbody" style="<?php echo $value['style'];?>"><?php echo $value['note'];?></p>
<?php if($value['from_num']) { ?>
<p class="mbody">还有 <?php echo $value['from_num'];?> 个相同通知被忽略</p>
<?php } ?>
</li>
<?php } ?>
</ul>
</div>
<?php if($view!='userapp' && $space['notifications']) { ?>
<div class="notice_tip cl"><a href="home.php?mod=space&amp;do=notice&amp;ignore=all">还有 <?php echo $value['from_num'];?> 个相同通知被忽略 <em>&rsaquo;</em></a></div>
<?php } if($multi) { ?><div class="pgs cl"><?php echo $multi;?></div><?php } } include template('common/footer'); ?>