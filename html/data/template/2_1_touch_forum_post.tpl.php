<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('post');
0
|| checktplrefresh('./template/default/touch/forum/post.htm', './template/default/touch/forum/post_editor_attribute.htm', 1726577701, '1', './data/template/2_1_touch_forum_post.tpl.php', './template/default', 'touch/forum/post')
|| checktplrefresh('./template/default/touch/forum/post.htm', './template/default/touch/common/seccheck.htm', 1726577701, '1', './data/template/2_1_touch_forum_post.tpl.php', './template/default', 'touch/forum/post')
;?><?php include template('common/header'); $adveditor = $isfirstpost && $special || $special == 2 && ($_GET['action'] == 'newthread' || $_GET['action'] == 'reply' && !empty($_GET['addtrade']) || $_GET['action'] == 'edit' && $thread['special'] == 2);?><form method="post" id="postform" 
<?php if($_GET['action'] == 'newthread') { ?>action="forum.php?mod=post&amp;action=<?php if($special != 2) { ?>newthread<?php } else { ?>newtrade<?php } ?>&amp;fid=<?php echo $_G['fid'];?>&amp;extra=<?php echo $extra;?>&amp;topicsubmit=yes&amp;mobile=2"
<?php } elseif($_GET['action'] == 'reply') { ?>action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $extra;?>&amp;replysubmit=yes&amp;mobile=2"
<?php } elseif($_GET['action'] == 'edit') { ?>action="forum.php?mod=post&amp;action=edit&amp;extra=<?php echo $extra;?>&amp;editsubmit=yes&amp;mobile=2" <?php echo $enctype;?>
<?php } ?>>
<input type="hidden" name="formhash" id="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="posttime" id="posttime" value="<?php echo TIMESTAMP;?>" />
<?php if(!empty($_GET['modthreadkey'])) { ?><input type="hidden" name="modthreadkey" id="modthreadkey" value="<?php echo $_GET['modthreadkey'];?>" /><?php } if($_GET['action'] == 'reply') { ?>
<input type="hidden" name="noticeauthor" value="<?php echo $noticeauthor;?>" />
<input type="hidden" name="noticetrimstr" value="<?php echo $noticetrimstr;?>" />
<input type="hidden" name="noticeauthormsg" value="<?php echo $noticeauthormsg;?>" />
<?php if($reppid) { ?>
<input type="hidden" name="reppid" value="<?php echo $reppid;?>" />
<?php } if($_GET['reppost']) { ?>
<input type="hidden" name="reppost" value="<?php echo $_GET['reppost'];?>" />
<?php } elseif($_GET['repquote']) { ?>
<input type="hidden" name="reppost" value="<?php echo $_GET['repquote'];?>" />
<?php } } if($_GET['action'] == 'edit') { ?>
<input type="hidden" name="fid" id="fid" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="tid" value="<?php echo $_G['tid'];?>" />
<input type="hidden" name="pid" value="<?php echo $pid;?>" />
<input type="hidden" name="page" value="<?php echo $_GET['page'];?>" />
<?php } if($special) { ?>
<input type="hidden" name="special" value="<?php echo $special;?>" />
<?php } if($specialextra) { ?>
<input type="hidden" name="specialextra" value="<?php echo $specialextra;?>" />
<?php } ?>
<div class="header cl">
<div class="mz"><a href="javascript:history.back();"><i class="dm-c-left"></i></a></div>
<h2><?php if($_GET['action'] == 'edit') { ?>编辑<?php } else { ?>发帖<?php } ?></h2>
<div class="my"></div>
</div>
<?php if($_GET['action'] == 'newthread' && ($_G['group']['allowpostpoll'] || $_G['group']['allowpostreward'] || $_G['group']['allowpostdebate'] || $_G['group']['allowpostactivity'] || $_G['group']['allowposttrade'] || $_G['setting']['threadplugins'] || $_G['forum']['threadsorts']['types'])) { ?>
<div class="dhnavs_box">
<div id="dhnavs">
<div id="dhnavs_li">
<ul class="swiper-wrapper">
<?php if(empty($_G['forum']['threadsorts']['required']) && !$_G['forum']['allowspecialonly']) { ?>
<li class="swiper-slide <?php if($postspecialcheck[0]) { ?>mon<?php } ?>"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;cedit=yes<?php if(!empty($_G['tid'])) { ?>&amp;tid=<?php echo $_G['tid'];?><?php } if(!empty($modelid)) { ?>&amp;modelid=<?php echo $modelid;?><?php } ?>&amp;extra=<?php echo $extra;?>">发表帖子</a></li>
<?php } if(isset($_G['forum']['threadsorts']['types']) && is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $tsortid => $name) { ?><li class="swiper-slide <?php if($sortid == $tsortid) { ?>mon<?php } ?>"><a href="forum.php?mod=post&amp;action=newthread&amp;sortid=<?php echo $tsortid;?>&amp;fid=<?php echo $_G['fid'];?>&amp;cedit=yes<?php if(!empty($_G['tid'])) { ?>&amp;tid=<?php echo $_G['tid'];?><?php } if(!empty($modelid)) { ?>&amp;modelid=<?php echo $modelid;?><?php } ?>&amp;extra=<?php echo $extra;?>"><?php echo strip_tags($name);; ?></a></li>
<?php } if($_G['group']['allowpostpoll']) { ?><li class="swiper-slide <?php if($_GET['special'] == 1) { ?>mon<?php } ?>"><a href="forum.php?mod=post&amp;action=newthread&amp;special=1&amp;fid=<?php echo $_G['fid'];?>&amp;cedit=yes<?php if(!empty($_G['tid'])) { ?>&amp;tid=<?php echo $_G['tid'];?><?php } if(!empty($modelid)) { ?>&amp;modelid=<?php echo $modelid;?><?php } ?>&amp;extra=<?php echo $extra;?>">发投票</a></li><?php } if($_G['group']['allowpostreward']) { ?><li class="swiper-slide <?php if($_GET['special'] == 3) { ?>mon<?php } ?>"><a href="forum.php?mod=post&amp;action=newthread&amp;special=3&amp;fid=<?php echo $_G['fid'];?>&amp;cedit=yes<?php if(!empty($_G['tid'])) { ?>&amp;tid=<?php echo $_G['tid'];?><?php } if(!empty($modelid)) { ?>&amp;modelid=<?php echo $modelid;?><?php } ?>&amp;extra=<?php echo $extra;?>">发悬赏</a></li><?php } if($_G['group']['allowpostdebate']) { ?><li class="swiper-slide <?php if($_GET['special'] == 5) { ?>mon<?php } ?>"><a href="forum.php?mod=post&amp;action=newthread&amp;special=5&amp;fid=<?php echo $_G['fid'];?>&amp;cedit=yes<?php if(!empty($_G['tid'])) { ?>&amp;tid=<?php echo $_G['tid'];?><?php } if(!empty($modelid)) { ?>&amp;modelid=<?php echo $modelid;?><?php } ?>&amp;extra=<?php echo $extra;?>">发辩论</a></li><?php } if($_G['group']['allowpostactivity']) { ?><li class="swiper-slide <?php if($_GET['special'] == 4) { ?>mon<?php } ?>"><a href="forum.php?mod=post&amp;action=newthread&amp;special=4&amp;fid=<?php echo $_G['fid'];?>&amp;cedit=yes<?php if(!empty($_G['tid'])) { ?>&amp;tid=<?php echo $_G['tid'];?><?php } if(!empty($modelid)) { ?>&amp;modelid=<?php echo $modelid;?><?php } ?>&amp;extra=<?php echo $extra;?>">发起活动</a></li><?php } if($_G['group']['allowposttrade']) { ?><li class="swiper-slide <?php if($_GET['special'] == 2) { ?>mon<?php } ?>"><a href="forum.php?mod=post&amp;action=newthread&amp;special=2&amp;fid=<?php echo $_G['fid'];?>&amp;cedit=yes<?php if(!empty($_G['tid'])) { ?>&amp;tid=<?php echo $_G['tid'];?><?php } if(!empty($modelid)) { ?>&amp;modelid=<?php echo $modelid;?><?php } ?>&amp;extra=<?php echo $extra;?>">出售商品</a></li><?php } if($_G['setting']['threadplugins']) { if(isset($_G['forum']['threadplugin']) && is_array($_G['forum']['threadplugin'])) foreach($_G['forum']['threadplugin'] as $tpid) { if(array_key_exists($tpid, $_G['setting']['threadplugins']) && is_array($_G['group']['allowthreadplugin']) && in_array($tpid, $_G['group']['allowthreadplugin'])) { ?>
<li class="swiper-slide <?php if($specialextra==$tpid) { ?>mon<?php } ?>"><a href="forum.php?mod=post&amp;action=newthread&amp;specialextra=<?php echo $tpid;?>&amp;fid=<?php echo $_G['fid'];?>&amp;cedit=yes<?php if(!empty($_G['tid'])) { ?>&amp;tid=<?php echo $_G['tid'];?><?php } if(!empty($modelid)) { ?>&amp;modelid=<?php echo $modelid;?><?php } ?>&amp;extra=<?php echo $extra;?>"><?php echo $_G['setting']['threadplugins'][$tpid]['name'];?></a></li>
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
<?php } ?>
<div class="post_from post_box">
<?php if(!empty($_G['setting']['pluginhooks']['post_top_mobile'])) echo $_G['setting']['pluginhooks']['post_top_mobile'];?>
<ul class="cl">
<?php if($_GET['action'] == 'reply' && !empty($_GET['addtrade']) || $_GET['action'] == 'edit' && $thread['special'] == 2 && !$postinfo['first']) { ?>
<input name="subject" type="hidden" value="" />
<?php } elseif($_GET['action'] != 'reply') { ?>
<li class="mli"><input type="text" class="px pl5" id="needsubject" autocomplete="off" value="<?php echo $postinfo['subject'];?>" name="subject" placeholder="帖子标题"></li>
<?php } else { ?>
<li class="mtext">
RE: <?php echo $thread['subject'];?>
<?php if($quotemessage) { ?><?php echo $quotemessage;?><?php } ?>
</li>
<?php } if($isfirstpost && !empty($_G['forum']['threadtypes']['types'])) { ?>
<li class="mli">
<select id="typeid" name="typeid" class="sort_sel pl5">	
<i class="dm-c-down sort_jt"></i>
<option value="0" selected="selected">主题分类</option><?php if(isset($_G['forum']['threadtypes']['types']) && is_array($_G['forum']['threadtypes']['types'])) foreach($_G['forum']['threadtypes']['types'] as $typeid => $name) { if(empty($_G['forum']['threadtypes']['moderators'][$typeid]) || $_G['forum']['ismoderator']) { ?>
<option value="<?php echo $typeid;?>"<?php if($thread['typeid'] == $typeid || $_GET['typeid'] == $typeid) { ?> selected="selected"<?php } ?>><?php echo strip_tags($name);; ?></option>
<?php } } ?>
</select>
</li>
<?php } ?>
</ul><?php include template('forum/post_editor_extra'); ?><ul class="cl">
<li class="mtext">
<textarea class="pt" id="needmessage" autocomplete="off" id="<?php echo $editorid;?>_textarea" name="<?php echo $editor['textarea'];?>" placeholder="<?php if($_GET['action'] != 'reply') { ?>帖子<?php } ?>内容" fwin="reply"><?php if($special != 127) { ?><?php echo $postinfo['message'];?><?php } ?></textarea>
<div class="mimg cl">
<a href="javascript:;" class="post_imgbtn"><i class="dm-image"></i>上传图片<input type="file" name="Filedata" id="filedata" multiple="multiple" accept=".jpg,.jpeg,.gif,.png,.bmp,image/jpeg,image/gif,image/png,image/bmp" /></a>
<a href="javascript:;" class="post_attbtn"><i class="dm-star-fill"></i>上传附件<input type="file" name="Filedata" id="attfiledata" multiple="multiple" /></a>
</div>
<div class="cl">
<ul id="imglist" class="post_imglist cl"><?php if(isset($imgattachs['used']) && is_array($imgattachs['used'])) foreach($imgattachs['used'] as $temp) { ?><li><span aid="<?php echo $temp['aid'];?>" class="del" up="1"><a href="javascript:;"><i class="dm-error"></i></a></span><span class="p_img"><a href="javascript:;"><img style="height:54px;width:54px;" id="aimg_<?php echo $temp['aid'];?>" src="<?php echo $temp['url'];?>/<?php echo $temp['attachment'];?>" /></a></span><input type="hidden" name="attachnew[<?php echo $temp['aid'];?>]['description']" /></li>
<?php } ?>
</ul>
</div>
<div class="cl">
<ul id="attlist" class="post_attlist setbox cl"><?php if(isset($attachs['used']) && is_array($attachs['used'])) foreach($attachs['used'] as $temp) { ?><li class="b_t"><div class="tit"><span aid="<?php echo $temp['aid'];?>" up="1" class="del btn f_f"><a href="javascript:;"><i class="dm-trash z"></i></a></span>
<?php if($_G['setting']['allowattachurl']) { if($temp['ext'] == 'mp3') { ?>
<span class="btn" onclick="addsmilies('[audio]attach://<?php echo $temp['aid'];?>.mp3[/audio]')">插入音乐</span>
<?php } elseif($temp['ext'] == 'mp4') { ?>
<span class="btn" onclick="addsmilies('[media=x,500,375]attach://<?php echo $temp['aid'];?>.mp4[/media]')">插入视频</span>
<?php } } ?>
<span class="btn" onclick="addsmilies('[attach]<?php echo $temp['aid'];?>[/attach]')">插入</span><?php echo $temp['filetype'];?><span class="link"><?php echo $temp['filename'];?></span></div><div class="minput"><div class="attms flex-box"><span class="f_c">描述</span><input type="text" name="attachnew[<?php echo $temp['aid'];?>][description]" value="<?php echo $temp['description'];?>" class="input flex"></div></div><div class="minput">
<?php if($_G['group']['allowsetattachperm']) { if($_G['cache']['groupreadaccess']) { ?>
<div class="attqx flex-box"><span>阅读权限</span>
<div class="flex">
<select name="attachnew[<?php echo $temp['aid'];?>][readperm]" id="readperm<?php echo $temp['aid'];?>" class="sort_sel">
<option value="" selected="selected">不限</option><?php if(isset($_G['cache']['groupreadaccess']) && is_array($_G['cache']['groupreadaccess'])) foreach($_G['cache']['groupreadaccess'] as $val) { ?><option value="<?php echo $val['readaccess'];?>"<?php if($temp['readperm'] == $val['readaccess']) { ?> selected="selected"<?php } ?>><?php echo $val['grouptitle'];?></option>
<?php } ?>
<option value="255"<?php if($temp['readperm'] == 255) { ?> selected<?php } ?>>最高权限</option>
</select>
</div>
</div>
<?php } } if($_G['group']['maxprice']) { ?><div class="attjg flex-box"><span>售价</span><input type="text" name="attachnew[<?php echo $temp['aid'];?>][price]" value="<?php echo $temp['price'];?>" class="input price flex"><em><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]]['title'];?></em></div><?php } ?></div></li>
<?php } ?>
</ul>
</div>
</li>
<?php if($_GET['action'] == 'edit' && $isorigauthor && ($isfirstpost && $thread['replies'] < 1 || !$isfirstpost) && !$rushreply && $_G['setting']['editperdel']) { ?>
<label>
<li class="flex-box mli">
<div class="flex-3 xg1"><span class="z">删除本帖</span></div>
<div class="flex"><span class="y"><input type="checkbox" name="delete" id="delete" class="pc" value="1"></span></div>
</li>
</label>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['post_middle_mobile'])) echo $_G['setting']['pluginhooks']['post_middle_mobile'];?><div class="discuz_x cl"></div>
<li id="post_extra" class="cl">
<div class="dhnavs_box">
<div id="dhnavs">
<div id="dhnavs_li">
<ul class="swiper-wrapper" id="post_extra_tb" onselectstart="return false">
<li class="swiper-slide" id="extra_additional_b" onclick="showExtra('extra_additional')"><a>附加选项</a></li>
<?php if($_GET['action'] == 'newthread' || $_GET['action'] == 'edit' && $isfirstpost) { if($_G['group']['allowsetreadperm']) { ?>
<li class="swiper-slide" id="extra_readperm_b" onclick="showExtra('extra_readperm')"><a>阅读权限</a></li>
<?php } if($_G['group']['allowreplycredit'] && !in_array($special, array(2, 3))) { if($_GET['action'] == 'newthread') { $extcreditstype = $_G['setting']['creditstransextra'][10];?><?php } else { $extcreditstype = !empty($replycredit_rule['extcreditstype']) ? $replycredit_rule['extcreditstype'] : $_G['setting']['creditstransextra'][10];?><?php } $userextcredit = getuserprofile('extcredits'.$extcreditstype);?><?php if(($_GET['action'] == 'newthread' && $userextcredit > 0) || ($_GET['action'] == 'edit' && $isorigauthor && $isfirstpost)) { ?>
<li class="swiper-slide" id="extra_replycredit_b" onclick="showExtra('extra_replycredit')"><a>回帖奖励</a></li>
<?php } } if(($_GET['action'] == 'newthread' && $_G['group']['allowpostrushreply'] && $special != 2) || ($_GET['action'] == 'edit' && getstatus($thread['status'], 3))) { ?>
<li class="swiper-slide" id="extra_rushreplyset_b" onclick="showExtra('extra_rushreplyset')"><a>抢楼主题</a></li>
<?php } if($_G['group']['maxprice'] && !$special) { ?>
<li class="swiper-slide" id="extra_price_b" onclick="showExtra('extra_price')"><a>主题售价</a></li>
<?php } if($_G['group']['allowposttag']) { ?>
<li class="swiper-slide" id="extra_tag_b" onclick="showExtra('extra_tag')"><a>主题标签</a></li>
<?php } if($_G['group']['allowsetpublishdate'] && ($_GET['action'] == 'newthread' || ($_GET['action'] == 'edit' && $isfirstpost && $thread['displayorder'] == -4))) { ?>
<li class="swiper-slide" id="extra_pubdate_b" onclick="showExtra('extra_pubdate')"><a>定时发布</a></li>
<?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['post_attribute_extra_mobile'])) echo $_G['setting']['pluginhooks']['post_attribute_extra_mobile'];?>
</ul>
</div>
</div>
</div>
</li>

<div class="setbox" id="post_extra_c">
<?php if($_GET['action'] == 'newthread' || $_GET['action'] == 'edit' && $isfirstpost) { if(!empty($userextcredit)) { ?>
<div id="extra_replycredit_c" class="exfm cl" style="display: none;">
<ul class="cl">
<li class="flex-box mli">
<div class="tit">共奖励</div>
<div class="flex input"><input type="text" name="replycredit_times" id="replycredit_times" class="px pxs vm" value="<?php if(!empty($replycredit_rule['lasttimes'])) { ?><?php echo $replycredit_rule['lasttimes'];?><?php } else { ?>1<?php } ?>" onkeyup="javascript:getreplycredit();" /></div>
<div class="tit">次</div>
</li>
<li class="flex-box mli">
<div class="tit">单次回帖奖励:</div>
<div class="flex input"><input type="text" name="replycredit_extcredits" id="replycredit_extcredits" class="px pxs vm" value="<?php if(!empty($replycredit_rule['extcredits']) && $thread['replycredit'] > 0) { ?><?php echo $replycredit_rule['extcredits'];?><?php } else { ?>0<?php } ?>" onkeyup="javascript:getreplycredit();" /></div>
<div class="tit"><?php echo $_G['setting']['extcredits'][$extcreditstype]['unit'];?><?php echo $_G['setting']['extcredits'][$extcreditstype]['title'];?><span class="xg1">(留空或填 0 为不奖励)</span> </div>
</li>
<li class="flex-box mli">
<div class="tit">每人最多可获得 </div>
<div class="flex input">
<select id="replycredit_membertimes" name="replycredit_membertimes" class="sort_sel vm"><?php for($i=1;$i<11;$i++) {;?><option value="<?php echo $i;?>"<?php if(isset($replycredit_rule['membertimes']) && $replycredit_rule['membertimes'] == $i) { ?> selected="selected"<?php } ?>><?php echo $i;?></option><?php };?></select>
</div>
<div class="tit">次</div>
</li>
<li class="flex-box mli">
<div class="tit">中奖率</div>
<div class="flex input">
<select id="replycredit_random" name="replycredit_random" class="sort_sel vm"><?php for($i=100;$i>9;$i=$i-10) {;?><option value="<?php echo $i;?>"<?php if(isset($replycredit_rule['random']) && $replycredit_rule['random'] == $i) { ?> selected="selected"<?php } ?>><?php echo $i;?></option><?php };?></select>
</div>
<div class="tit">%</div>
</li>
<li class="mtit p10">回帖奖励总额: <span id="replycredit_sum"><?php if(!empty($thread['replycredit'])) { ?><?php echo $thread['replycredit'];?><?php } else { ?>0<?php } ?></span> <?php echo $_G['setting']['extcredits'][$extcreditstype]['unit'];?><?php echo $_G['setting']['extcredits'][$extcreditstype]['title'];?><?php if(!empty($thread['replycredit'])) { ?><span class="xg1">(本帖尚有 <?php echo $thread['replycredit'];?> <?php echo $_G['setting']['extcredits'][$extcreditstype]['unit'];?><?php echo $_G['setting']['extcredits'][$extcreditstype]['title'];?>)</span><?php } ?>, <span id="replycredit">税后支付 <?php echo $_G['setting']['extcredits'][$extcreditstype]['title'];?> 0</span> <?php echo $_G['setting']['extcredits'][$extcreditstype]['unit'];?>, 您有 <?php echo $_G['setting']['extcredits'][$extcreditstype]['title'];?> <?php echo $userextcredit;?> <?php echo $_G['setting']['extcredits'][$extcreditstype]['unit'];?></li>
</ul>
</div>
<?php } if($_G['group']['allowsetreadperm']) { ?>
<div id="extra_readperm_c" class="exfm cl" style="display:none">
<ul class="cl">
<li class="flex-box mli">
<div class="tit">阅读权限:</div>
<div class="flex input">
<select name="readperm" id="readperm" class="sort_sel">
<option value="">不限</option><?php if(isset($_G['cache']['groupreadaccess']) && is_array($_G['cache']['groupreadaccess'])) foreach($_G['cache']['groupreadaccess'] as $val) { ?><option value="<?php echo $val['readaccess'];?>"<?php if($thread['readperm'] == $val['readaccess']) { ?> selected="selected"<?php } ?>><?php echo $val['grouptitle'];?></option>
<?php } ?>
<option value="255"<?php if($thread['readperm'] == 255) { ?> selected="selected"<?php } ?>>最高权限</option>
</select>
</div>
</li>
<li class="mtit p10"><span class="xg1">阅读权限按由高到低排列，高于或等于选中组的用户才可以阅读</span></li>
</ul>
</div>
<?php } if($_G['group']['maxprice'] && !$special) { ?>
<div id="extra_price_c" class="exfm cl" style="display:none">
<ul class="cl">
<li class="flex-box mli">
<div class="tit">售价:</div>
<div class="flex input">
<input type="text" id="price" name="price" class="px pxs" value="<?php echo $thread['pricedisplay'];?>" />
</div>
<div class="pipe">
<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]]['title'];?>
</div>
</li>
<li class="mtit p10"><span class="xg1">最高 <?php echo $_G['group']['maxprice'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]]['unit'];?></span></li>
<?php if($_G['group']['maxprice'] && ($_GET['action'] == 'newthread' || $_GET['action'] == 'edit' && $isfirstpost)) { if($_G['setting']['maxincperthread']) { ?><li class="mtit p10"><span class="xg1">主题出售最高收入上限为 <?php echo $_G['setting']['maxincperthread'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]]['unit'];?>&nbsp;&nbsp;&nbsp;&nbsp;</span></li><?php } if($_G['setting']['maxchargespan']) { ?><li class="mtit p10"><span class="xg1">主题最多能销售 <?php echo $_G['setting']['maxchargespan'];?> 个小时<?php if($_GET['action'] == 'edit' && $freechargehours) { ?>，本主题还能销售 <?php echo $freechargehours;?> 个小时<?php } ?></span></li><?php } } ?>
</ul>
</div>
<?php } if($_G['group']['allowposttag']) { ?>
<div id="extra_tag_c" class="exfm cl" style="display: none;">
<ul class="cl">
<li class="flex-box mli">
<div class="tit">标签:</div>
<div class="flex input"><input type="text" class="px vm" size="60" id="tags" name="tags" value="<?php echo $postinfo['tag'] ?? ''; ?>" /></div>
</li>
<li class="mtit p10">
<p class="xg1">用逗号或空格隔开多个标签，最多可填写 5 个</p>
</li>
</ul>
</div>
<?php } if(($_GET['action'] == 'newthread' && $_G['group']['allowpostrushreply'] && $special != 2) || ($_GET['action'] == 'edit' && getstatus($thread['status'], 3))) { ?>
<div id="extra_rushreplyset_c" class="exfm cl" style="display: none;">
<ul class="cl">
<li class="mli"><label for="rushreply"><input type="checkbox" name="rushreply" id="rushreply" class="pc vm" value="1" <?php if($_GET['action'] == 'edit' && getstatus($thread['status'], 3)) { ?>disabled="disabled" checked="checked"<?php } ?> /> 设为抢楼主题</label></li>
<li class="flex-box mli">
<div class="tit"> 抢楼开始：</div>
<div class=""><input type="text" name="rushreplyfrom" id="rushreplyfrom" class="px" autocomplete="off" value="<?php echo $postinfo['rush']['starttimefrom'] ?? ''; ?>" onkeyup="getID('rushreply').checked = true;" /></div>
</li>
<li class="flex-box mli">
<div class="tit">抢楼结束：</div>
<div class=""><input type="text" autocomplete="off" id="rushreplyto" name="rushreplyto" class="px" value="<?php echo $postinfo['rush']['starttimeto'] ?? ''; ?>" onkeyup="getID('rushreply').checked = true;" /></div>
</li>
<li class="flex-box mli">
<div class="tit">奖励楼层: </div>
<div class=""><input type="text" name="rewardfloor" id="rewardfloor" class="px oinf" value="<?php echo $postinfo['rush']['rewardfloor'] ?? ''; ?>" onkeyup="$('rushreply').checked = true;" /></div>
</li>
<li class="mtit p10">多楼层用英文逗号隔开,*号可匹配任意数或空值,如:8,88,*88</li>
<li class="flex-box mli">
<div class="tit">回帖限制: </div>
<div class=""><input type="text" name="replylimit" id="replylimit" class="px" autocomplete="off" value="<?php echo $postinfo['rush']['replylimit'] ?? ''; ?>" onkeyup="$('rushreply').checked = true;" /></div>
</li>
<li class="mtit p10">每个用户回帖次数上限 </li>
<li class="flex-box mli">
<div class="tit">截止楼层:</div>
<div class=""><input type="text" name="stopfloor" id="stopfloor" class="px" autocomplete="off" value="<?php echo $postinfo['rush']['stopfloor'] ?? ''; ?>" onkeyup="$('rushreply').checked = true;" /></div>
</li>
<li class="flex-box mli">
<div class="tit"><?php if(!empty($_G['setting']['creditstransextra'][11])) { ?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra'][11]]['title'];?><?php } else { ?>积分<?php } ?>下限: </div>
<div class=""><input type="text" name="creditlimit" id="creditlimit" class="px" autocomplete="off" value="<?php echo $postinfo['rush']['creditlimit'] ?? ''; ?>" onkeyup="$('rushreply').checked = true;" /></div>
</li>
<li class="mtit p10"><?php if(!empty($_G['setting']['creditstransextra'][11])) { ?>(<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra'][11]]['title'];?>)<?php } else { ?>总积分<?php } ?>大于此设置才能参与抢楼，可不填</li>
</ul>
</div>
<?php } if($_G['group']['allowsetpublishdate'] && ($_GET['action'] == 'newthread' || ($_GET['action'] == 'edit' && $isfirstpost && $thread['displayorder'] == -4))) { ?>
<div id="extra_pubdate_c" class="exfm cl" style="display: none;">
<label><input type="checkbox" name="cronpublish" onclick="if(this.checked) {getID('cronpublishdate').click();doane(event,false);};hidenFollowBtn(this.checked);" id="cronpublish" value="true" class="pc"<?php if($cronpublish) { ?> checked="checked"<?php } ?> />定时发布</label>
<input type="text" name="cronpublishdate" id="cronpublishdate" class="px" autocomplete="off" value="<?php echo $cronpublishdate;?>" onchange="if(this.value) getID('cronpublish').checked = true;">
</div>
<?php } } ?>

<div id="extra_additional_c" class="exfm p5 cl" style="display: none;">
<li class="mtit">基本属性</li>
<ul class="flex-box flex-wrap p10 cl">
<li class="mli flex-half">
<?php if($_GET['action'] != 'edit') { if($_G['group']['allowanonymous']) { ?><label for="isanonymous"><input type="checkbox" name="isanonymous" id="isanonymous" class="pc" value="1" />使用匿名发帖</label><?php } } else { if($_G['group']['allowanonymous'] || (!$_G['group']['allowanonymous'] && $orig['anonymous'])) { ?><label for="isanonymous"><input type="checkbox" name="isanonymous" id="isanonymous" class="pc" value="1" <?php if($orig['anonymous']) { ?>checked="checked"<?php } ?> />使用匿名发帖</label><?php } } ?>
</li>
<?php if($_GET['action'] == 'newthread' || $_GET['action'] == 'edit' && $isfirstpost) { ?>
<li class="mli flex-half"><label for="hiddenreplies"><input type="checkbox" name="hiddenreplies" id="hiddenreplies" class="pc"<?php if($thread['hiddenreplies']) { ?> checked="checked"<?php } ?> value="1">回帖仅作者可见</label></li>
<?php } if($_G['uid'] && ($_GET['action'] == 'newthread' || $_GET['action'] == 'edit' && $isfirstpost) && $special != 3) { ?>
<li class="mli flex-half"><label for="ordertype"><input type="checkbox" name="ordertype" id="ordertype" class="pc" value="1" <?php echo $ordertypecheck;?> />回帖倒序排列</label></li>
<?php } if(($_GET['action'] == 'newthread' || $_GET['action'] == 'edit' && $isfirstpost)) { ?>
<li class="mli flex-half"><label for="allownoticeauthor"><input type="checkbox" name="allownoticeauthor" id="allownoticeauthor" class="pc" value="1"<?php if($allownoticeauthor) { ?> checked="checked"<?php } ?> />接收回复通知</label></li>
<?php } if($_GET['action'] != 'edit' && helper_access::check_module('feed') && $_G['forum']['allowfeed']) { ?>
<li class="mli flex-half"><label for="addfeed"><input type="checkbox" name="addfeed" id="addfeed" class="pc" value="1" <?php echo $addfeedcheck;?>>发送动态</label></li>
<?php } ?>
<li class="mli flex-half"><label for="usesig"><input type="checkbox" name="usesig" id="usesig" class="pc" value="1" <?php if(!$_G['group']['maxsigsize']) { ?>disabled <?php } else { ?><?php echo $usesigcheck;?> <?php } ?>/>使用个人签名</label></li>
</ul>
<li class="mtit">文本特性</li>
<ul class="flex-box flex-wrap p10 cl">
<li class="mli flex-half">
<?php if(($_G['forum']['allowhtml'] || ($_GET['action'] == 'edit' && ($orig['htmlon'] & 1))) && $_G['group']['allowhtml']) { ?>
<label for="htmlon"><input type="checkbox" name="htmlon" id="htmlon" class="pc" value="1" <?php echo $htmloncheck;?> />HTML 代码</label>
<?php } else { ?>
<label for="htmlon"><input type="checkbox" name="htmlon" id="htmlon" class="pc" value="0" <?php echo $htmloncheck;?> disabled="disabled" />HTML 代码</label>
<?php } ?>
</li>
<li class="mli flex-half">
<label for="allowimgcode"><input type="checkbox" id="allowimgcode" class="pc" disabled="disabled"<?php if($_G['forum']['allowimgcode']) { ?> checked="checked"<?php } ?> />[img] 代码</label>
</li>
<?php if($_G['forum']['allowimgcode']) { ?>
<li class="mli flex-half">
<label for="allowimgurl"><input type="checkbox" id="allowimgurl" class="pc" checked="checked" />解析图片链接</label>
</li>
<?php } ?>
<li class="mli flex-half">
<label for="parseurloff"><input type="checkbox" name="parseurloff" id="parseurloff" class="pc" value="1" <?php echo $urloffcheck;?> />禁用链接识别</label>
</li>
<li class="mli flex-half">
<label for="smileyoff"><input type="checkbox" name="smileyoff" id="smileyoff" class="pc" value="1" <?php echo $smileyoffcheck;?> />禁用表情</label>
</li>
<li class="mli flex-half">
<label for="bbcodeoff"><input type="checkbox" name="bbcodeoff" id="bbcodeoff" class="pc" value="1" <?php echo $codeoffcheck;?> />禁用编辑器代码</label>
</li>
<li class="mli flex-half">
<?php if($_G['group']['allowimgcontent']) { ?>
<label for="imgcontent"><input type="checkbox" name="imgcontent" id="imgcontent" class="pc" value="1" <?php echo $imgcontentcheck;?> onclick="switchEditor(this.checked?0:1);$('e_switchercheck').checked=this.checked;" />内容生成图片</label>
<?php } else { ?>
<label for="imgcontent"><input type="checkbox" name="imgcontent" id="imgcontent" class="pc" value="0" <?php echo $imgcontentcheck;?> disabled="disabled"/>内容生成图片</label>
<?php } ?>
</li>
</ul>
<?php if($_GET['action'] == 'newthread' && $_G['forum']['ismoderator'] && ($_G['group']['allowdirectpost'] || !$_G['forum']['modnewposts'])) { if($_GET['action'] == 'newthread' && $_G['forum']['ismoderator'] && ($_G['group']['allowdirectpost'] || !$_G['forum']['modnewposts']) && ($_G['group']['allowstickthread'] || $_G['group']['allowdigestthread'])) { ?>
<li class="mtit">管理操作</li>
<ul class="flex-box flex-wrap p10 cl">
<?php if($_G['group']['allowstickthread']) { ?>
<li class="mli flex-half"><label for="sticktopic"><input type="checkbox" name="sticktopic" id="sticktopic" class="pc" value="1" <?php echo $stickcheck;?> />主题置顶</label></li>
<?php } if($_G['group']['allowdigestthread']) { ?>
<li class="mli flex-half"><label for="addtodigest"><input type="checkbox" name="addtodigest" id="addtodigest" class="pc" value="1" <?php echo $digestcheck;?> />精华帖子</label></li>
<?php } ?>
</ul>
<?php } } elseif($_GET['action'] == 'edit' && $_G['forum_auditstatuson']) { ?>
<li class="mtit">管理操作</li>
<ul class="flex-box flex-wrap p10 cl">
<li class="mli flex-half"><label for="audit"><input type="checkbox" name="audit" id="audit" class="pc" value="1">通过审核</label></li>
</ul>
<?php } ?>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['post_attribute_extra_body_mobile'])) echo $_G['setting']['pluginhooks']['post_attribute_extra_body_mobile'];?>
</div>
<script type="text/javascript">
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
function showExtra(id) {
if ($('#'+id+'_c').css('display') == 'block') {
$('#'+id+'_b').attr("class","swiper-slide");
$('#'+id+'_c').css({'display':'none'});
} else {
var extraButton = $('#post_extra_tb').children('li');
var extraForm = $('#post_extra_c').children('div');

$.each($('#post_extra_tb > li'), function(){
$(this).attr("class","swiper-slide");
});

$.each($('#post_extra_c > div'), function(){
if($(this).hasClass('exfm')) {
$(this).css({'display':'none'});
}
});
$('#'+id+'_b').addClass('mon');
$('#'+id+'_c').css({'display':'block'});
}
}
</script></ul>
<?php if($_GET['action'] != 'edit' && ($secqaacheck || $seccodecheck)) { ?>
<ul class="cl"><?php $sechash = 'S'.random(4);
$sectpl = !empty($sectpl) ? explode("<sec>", $sectpl) : array('<br />',': ','<br />','');?><?php if($secqaacheck) { $message = '';
$question = make_secqaa();
$secqaa = lang('core', 'secqaa_tips').$question;?><?php } if($sectpl) { if($secqaacheck) { ?>
<li class="sec_txt">
验证问答:
<span class="xg2"><?php echo $secqaa;?></span>
<input name="secqaahash" type="hidden" value="<?php echo $sechash;?>" />
<input name="secanswer" id="secqaaverify_<?php echo $sechash;?>" type="text" class="txt" />
</li>
<?php } if($seccodecheck) { ?>
<script type="text/javascript">
//Todo: 抽函数到文件中
var seccheck_tpl = new Array();
var seccheck_modid = new Array();
function updateseccode(idhash, tpl, modid) {
if(!document.getElementById('seccode_' + idhash)) {
return;
}
if(tpl) {
seccheck_tpl[idhash] = tpl;
}
if(modid) {
seccheck_modid[idhash] = modid;
} else {
modid = seccheck_modid[idhash];
}
var id = 'seccodejs_' + idhash;
var src = 'misc.php?mod=seccode&action=update&mobile=2&idhash=' + idhash + '&' + Math.random() + '&modid=' + modid;
if(document.getElementById(id)) {
document.getElementsByTagName('head')[0].appendChild(document.getElementById(id));
}
var scriptNode = document.createElement("script");
scriptNode.type = "text/javascript";
scriptNode.id = id;
scriptNode.src = src;
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
</script>
<li class="sec_code vm">
<input name="seccodehash" type="hidden" value="<?php echo $sechash;?>" />
<span id="seccode_c<?php echo $sechash;?>" class="flex-box"></span>
<script type="text/javascript" reload="1">updateseccode('c<?php echo $sechash;?>', '<?php echo $sectpl;?>', '<?php echo $_G['basescript'];?>::<?php echo CURMODULE;?>');</script>
</li>
<?php } } ?></ul>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['post_bottom_mobile'])) echo $_G['setting']['pluginhooks']['post_bottom_mobile'];?>
</div>
<div class="post_btn">
<button id="postsubmit" class="btn_pn <?php if($_GET['action'] == 'edit') { ?>btn_pn_blue" disable="false"<?php } else { ?>btn_pn_grey" disable="true"<?php } ?>>
<?php if($_GET['action'] == 'newthread') { if($special == 0) { ?>发表
<?php } elseif($special == 1) { ?>发投票
<?php } elseif($special == 2) { ?>出售商品
<?php } elseif($special == 3) { ?>发悬赏
<?php } elseif($special == 4) { ?>发起活动
<?php } elseif($special == 5) { ?>发辩论
<?php } elseif($special == 127) { if($buttontext) { ?><?php echo $buttontext;?><?php } else { ?>发表帖子<?php } } } elseif($_GET['action'] == 'reply' && !empty($_GET['addtrade'])) { ?>添加商品
<?php } elseif($_GET['action'] == 'reply') { ?>回复
<?php } elseif($_GET['action'] == 'edit' && $isfirstpost && $thread['displayorder'] == -4) { ?>发表帖子
<?php } elseif($_GET['action'] == 'edit') { ?>保存
<?php } ?>
</button>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['post_btn_extra_mobile'])) echo $_G['setting']['pluginhooks']['post_btn_extra_mobile'];?>
<input type="hidden" name="<?php if($_GET['action'] == 'newthread') { ?>topicsubmit<?php } elseif($_GET['action'] == 'reply') { ?>replysubmit<?php } elseif($_GET['action'] == 'edit') { ?>editsubmit<?php } ?>" value="yes">
</form>
<script type="text/javascript">
(function() {
var needsubject = needmessage = false;
<?php if($_GET['action'] == 'reply') { ?>
needsubject = true;
<?php } elseif($_GET['action'] == 'edit') { ?>
needsubject = needmessage = true;
<?php } if($_GET['action'] == 'newthread' || ($_GET['action'] == 'edit' && $isfirstpost)) { ?>
$('#needsubject').on('keyup input', function() {
var obj = $(this);
if(obj.val()) {
needsubject = true;
if(needmessage == true) {
$('.btn_pn').removeClass('btn_pn_grey').addClass('btn_pn_blue');
$('.btn_pn').attr('disable', 'false');
}
} else {
needsubject = false;
$('.btn_pn').removeClass('btn_pn_blue').addClass('btn_pn_grey');
$('.btn_pn').attr('disable', 'true');
}
});
<?php } ?>
$('#needmessage').on('keyup input', function() {
var obj = $(this);
if(obj.val()) {
needmessage = true;
if(needsubject == true) {
$('.btn_pn').removeClass('btn_pn_grey').addClass('btn_pn_blue');
$('.btn_pn').attr('disable', 'false');
}
} else {
needmessage = false;
$('.btn_pn').removeClass('btn_pn_blue').addClass('btn_pn_grey');
$('.btn_pn').attr('disable', 'true');
}
});
$('#needmessage').on('scroll', function() {
var obj = $(this);
if(obj.scrollTop() > 0) {
obj.attr('rows', parseInt(obj.attr('rows'))+2);
}
}).scrollTop($(document).height());
 })();
(function($){
$.fn.extend({
insertAtCaret: function(myValue){
var t = $(this)[0];
if (document.selection) {
this.focus();
sel = document.selection.createRange();
sel.text = myValue;
this.focus();
}
else
if (t.selectionStart || t.selectionStart == '0') {
var startPos = t.selectionStart;
var endPos = t.selectionEnd;
var scrollTop = t.scrollTop;
t.value = t.value.substring(0, startPos) + myValue + t.value.substring(endPos, t.value.length);
this.focus();
t.selectionStart = startPos + myValue.length;
t.selectionEnd = startPos + myValue.length;
t.scrollTop = scrollTop;
}
else {
this.value += myValue;
this.focus();
}
}
})
})(jQuery);
function addsmilies(a){
$('#needmessage').insertAtCaret(a);
}
</script>
<script src="<?php echo STATICURL;?>js/mobile/ajaxfileupload.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo STATICURL;?>js/mobile/buildfileupload.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">
var imgexts = typeof imgexts == 'undefined' ? 'jpg, jpeg, gif, png' : imgexts;
var STATUSMSG = {
'-1' : '内部服务器错误',
'0' : '上传成功',
'1' : '不支持此类扩展名',
'2' : '服务器限制无法上传那么大的附件',
'3' : '用户组限制无法上传那么大的附件',
'4' : '不支持此类扩展名',
'5' : '文件类型限制无法上传那么大的附件',
'6' : '今日您已无法上传更多的附件',
'7' : '请选择图片文件(' + imgexts + ')',
'8' : '附件文件无法保存',
'9' : '没有合法的文件被上传',
'10' : '非法操作',
'11' : '今日您已无法上传那么大的附件',
'12' : '因文件名包含敏感词而无法提交',
'13' : '服务器限制无法上传分辨率过高的附件'
};
var form = $('#postform');
$(document).on('change', '#filedata', function() {
popup.open('<img src="' + IMGDIR + '/imageloading.gif">');
uploadsuccess = function(data) {
if(data == '') {
popup.open('上传失败，请稍后再试', 'alert');
}
var dataarr = data.split('|');
if(dataarr[0] == 'DISCUZUPLOAD' && dataarr[2] == 0) {
popup.close();
$('#imglist').append('<li><div><span aid="'+dataarr[3]+'" class="del"><a href="javascript:;"><i class="dm-error"></i></a></span><span class="p_img"><a href="javascript:;" onclick="addsmilies(\'[attachimg]'+dataarr[3]+'[/attachimg]\')"><img style="height:54px;width:54px;" id="aimg_'+dataarr[3]+'" src="<?php echo $_G['setting']['attachurl'];?>forum/'+dataarr[5]+'" /></a></span><input type="hidden" name="attachnew['+dataarr[3]+'][description]" /><div></li>');
} else {
var sizelimit = '';
if(dataarr[7] == 'ban') {
sizelimit = '(附件类型被禁止)';
} else if(dataarr[7] == 'perday') {
sizelimit = '(不能超过'+Math.ceil(dataarr[8]/1024)+'K)';
} else if(dataarr[7] > 0) {
sizelimit = '(不能超过'+Math.ceil(dataarr[7]/1024)+'K)';
}
popup.open(STATUSMSG[dataarr[2]] + sizelimit, 'alert');
}
};
if(typeof FileReader != 'undefined' && this.files[0]) {//note 支持html5上传新特性
for (const file of this.files) {
var tmpfiles = [];
tmpfiles[0] = file;
$.buildfileupload({
uploadurl:'misc.php?mod=swfupload&operation=upload&type=image&inajax=yes&infloat=yes&simple=2',
files:tmpfiles,
uploadformdata:{uid:"<?php echo $_G['uid'];?>", hash:"<?php echo md5(substr(md5($_G['config']['security']['authkey']), 8).$_G['uid'])?>"},
uploadinputname:'Filedata',
maxfilesize:"<?php echo $swfconfig['max'];?>",
success:uploadsuccess,
error:function() {
popup.open('上传失败，请稍后再试', 'alert');
}
});
}
} else {
$.ajaxfileupload({
url:'misc.php?mod=swfupload&operation=upload&type=image&inajax=yes&infloat=yes&simple=2',
data:{uid:"<?php echo $_G['uid'];?>", hash:"<?php echo md5(substr(md5($_G['config']['security']['authkey']), 8).$_G['uid'])?>"},
dataType:'text',
fileElementId:'filedata',
success:uploadsuccess,
error: function() {
popup.open('上传失败，请稍后再试', 'alert');
}
});
}
});
$(document).on('change', '#attfiledata', function() {
popup.open('<img src="' + IMGDIR + '/imageloading.gif">');
uploadsuccess = function(data) {
if(data == '') {
popup.open('上传失败，请稍后再试', 'alert');
}
var dataarr = data.split('|');
if(dataarr[0] == 'DISCUZUPLOAD' && dataarr[2] == 0) {
popup.close();
var video_file = '';
var file_ex = 'unknown.gif';
if (/bittorrent$|torrent$/.test(dataarr[6].toLowerCase())) {
file_ex = 'torrent.gif';
} else if (/pdf$|pdf$/.test(dataarr[6].toLowerCase())) {
file_ex = 'pdf.gif';
} else if (/(jpg|gif|png|bmp)$/.test(dataarr[6].toLowerCase())) {
file_ex = 'image.gif';
} else if (/(swf|fla|flv|swi)$/.test(dataarr[6].toLowerCase())) {
file_ex = 'flash.gif';
} else if (/(wav|mid|mp3|m3u|wma|asf|asx|vqf|mpg|mpeg|avi|wmv|mp4|ogv|webm|ogg)$/.test(dataarr[6].toLowerCase())) {
file_ex = 'av.gif';
} else if (/(ra|rm|rv)$/.test(dataarr[6].toLowerCase())) {
file_ex = 'real.gif';
} else if (/(php|js|pl|cgi|asp|htm|html|xml)$/.test(dataarr[6].toLowerCase())) {
file_ex = 'html.gif';
} else if (/(txt|rtf|wri|chm)$/.test(dataarr[6].toLowerCase())) {
file_ex = 'text.gif';
} else if (/(doc|ppt)$/.test(dataarr[6].toLowerCase())) {
file_ex = 'msoffice.gif';
} else if (/rar$/.test(dataarr[6].toLowerCase())) {
file_ex = 'rar.gif';
} else if (/(zip|arj|arc|cab|lzh|lha|tar|gz)$/.test(dataarr[6].toLowerCase())) {
file_ex = 'zip.gif';
} else if (/(exe|com|bat|dll)$/.test(dataarr[6].toLowerCase())) {
file_ex = 'binary.gif';
} else {
file_ex = 'unknown.gif';
}
<?php if($_G['setting']['allowattachurl']) { ?>
if (/mp3$/.test(dataarr[6].toLowerCase())) {
video_file = '<span class="btn" onclick="addsmilies(\'[audio]attach://' + dataarr[3] + '.mp3[/audio]\')">插入音乐</span>';
} else if (/(mp4)$/.test(dataarr[6].toLowerCase())) {
video_file = '<span class="btn" onclick="addsmilies(\'[media=x,500,375]attach://' + dataarr[3] + '.mp4[/media]\')">插入视频</span>';
}
<?php } ?>
$('#attlist').append('<li class="b_t"><div class="tit"><span aid="'+dataarr[3]+'" up="1" class="del btn f_f"><a href="javascript:;"><i class="dm-trash z"></i></a></span>'+video_file+'<span class="btn" onclick="addsmilies(\'[attach]'+dataarr[3]+'[/attach]\')">插入</span><img src="static/image/filetype/'+file_ex+'" border="0" class="vm mimg" alt=""><span class="link">'+dataarr[6]+'</span></div><?php if($_GET['result'] != 'simple') { ?><div class="minput"><div class="attms flex-box"><span class="f_c">描述</span><input type="text" name="attachnew['+dataarr[3]+'][description]" value="" class="input flex"></div></div><div class="minput"><?php if($_G['group']['allowsetattachperm']) { if($_G['cache']['groupreadaccess']) { ?><div class="attqx flex-box"><span>阅读权限</span><div class="flex"><select name="attachnew['+dataarr[3]+'][readperm]" id="readperm'+dataarr[3]+'" class="sort_sel"><option value="" selected="selected">不限</option><?php if(isset($_G['cache']['groupreadaccess']) && is_array($_G['cache']['groupreadaccess'])) foreach($_G['cache']['groupreadaccess'] as $val) { ?><option value="<?php echo $val['readaccess'];?>"><?php echo $val['grouptitle'];?>(阅读权限: <?php echo $val['readaccess'];?>)</option><?php } ?><option value="255"<?php if($temp['readperm'] == 255) { ?> selected<?php } ?>>最高权限</option></select></div></div><?php } } if($_G['group']['maxprice']) { ?><div class="attjg flex-box"><span>售价</span><input type="text" name="attachnew['+dataarr[3]+'][price]" value="0" class="input price flex"><em><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]]['title'];?></em></div><?php } ?></div><?php } ?></li>');
} else {
var sizelimit = '';
if(dataarr[7] == 'ban') {
sizelimit = '(附件类型被禁止)';
} else if(dataarr[7] == 'perday') {
sizelimit = '(不能超过'+Math.ceil(dataarr[8]/1024)+'K)';
} else if(dataarr[7] > 0) {
sizelimit = '(不能超过'+Math.ceil(dataarr[7]/1024)+'K)';
}
popup.open(STATUSMSG[dataarr[2]] + sizelimit, 'alert');
}
};
if(typeof FileReader != 'undefined' && this.files[0]) {//note 支持html5上传新特性
for (const file of this.files) {
var tmpfiles = [];
tmpfiles[0] = file;
$.buildfileupload({
uploadurl:'misc.php?mod=swfupload&operation=upload&fid=<?php echo $_G['fid'];?>&inajax=yes&infloat=yes&simple=2',
files:tmpfiles,
uploadformdata:{uid:"<?php echo $_G['uid'];?>", hash:"<?php echo md5(substr(md5($_G['config']['security']['authkey']), 8).$_G['uid'])?>"},
uploadinputname:'Filedata',
maxfilesize:"<?php echo $swfconfig['max'];?>",
success:uploadsuccess,
error:function() {
popup.open('上传失败，请稍后再试', 'alert');
}
});
}
} else {
$.ajaxfileupload({
url:'misc.php?mod=swfupload&operation=upload&fid=<?php echo $_G['fid'];?>&inajax=yes&infloat=yes&simple=2',
data:{uid:"<?php echo $_G['uid'];?>", hash:"<?php echo md5(substr(md5($_G['config']['security']['authkey']), 8).$_G['uid'])?>"},
dataType:'text',
fileElementId:'attfiledata',
success:uploadsuccess,
error: function() {
popup.open('上传失败，请稍后再试', 'alert');
}
});
}
});
$('#postsubmit').on('click', function() {
var obj = $(this);
if(obj.attr('disable') == 'true') {
return false;
}
obj.attr('disable', 'true').removeClass('btn_pn_blue').addClass('btn_pn_grey');
popup.open('<img src="' + IMGDIR + '/imageloading.gif">');
var postlocation = '';
if(typeof geo !== 'undefined' && geo.errmsg === '' && geo.loc) {
postlocation = geo.longitude + '|' + geo.latitude + '|' + geo.loc;
}
var myform = document.getElementById('postform');
var formdata = new FormData(myform);
$.ajax({
type:'POST',
url:form.attr('action') + '&geoloc=' + postlocation + '&handlekey='+form.attr('id')+'&inajax=1',
data:formdata,
cache:false,
contentType:false,
processData:false,
dataType:'xml'
})
.success(function(s) {
popup.open(s.lastChild.firstChild.nodeValue);
})
.error(function() {
popup.open('网络出现问题，请稍后再试', 'alert');
});
return false;
});
$(document).on('click', '.del', function() {
var obj = $(this);
$.ajax({
type:'GET',
url:'forum.php?mod=ajax&action=deleteattach&inajax=yes&aids[]=' + obj.attr('aid') + (obj.attr('up') == 1 ? '&tid=<?php echo $postinfo['tid'];?>&pid=<?php echo $postinfo['pid'];?>&formhash=<?php echo FORMHASH;?>' : ''),
})
.success(function(s) {
obj.closest('li').remove();
})
.error(function() {
popup.open('网络出现问题，请稍后再试', 'alert');
});
return false;
});
</script><?php $nofooter = true;?><?php include template('common/footer'); ?>