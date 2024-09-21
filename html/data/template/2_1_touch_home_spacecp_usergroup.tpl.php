<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_usergroup');?><?php include template('common/header'); if(in_array($do, array('buy', 'exit'))) { include template('home/spacecp_header'); ?><?php if(!empty($_G['setting']['pluginhooks']['spacecp_usergroup_top'])) echo $_G['setting']['pluginhooks']['spacecp_usergroup_top'];?><?php include template('home/spacecp_usergroup_header'); ?><div class="f_c">
<h3 class="flb">
<em id="return_<?php echo $_GET['handlekey'];?>"><?php if($join) { ?>购买用户组 <?php echo $group['grouptitle'];?><?php } else { ?>退出用户组 <?php echo $group['grouptitle'];?><?php } ?></em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_GET['handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>

<form id="buygroupform_<?php echo $groupid;?>" name="buygroupform_<?php echo $groupid;?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=usergroup&amp;do=<?php echo $do;?>&amp;groupid=<?php echo $groupid;?>"<?php if(!empty($_GET['inajax'])) { ?> onsubmit="ajaxpost('buygroupform_<?php echo $groupid;?>', 'return_<?php echo $_GET['handlekey'];?>', 'return_<?php echo $_GET['handlekey'];?>', 'onerror');return false;"<?php } ?>>
<input type="hidden" name="referer" value="<?php echo dreferer(); ?>" />
<input type="hidden" name="buysubmit" value="true" />
<input type="hidden" name="gid" value="<?php echo $_GET['gid'];?>" />

<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_GET['handlekey'];?>" /><?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">
<table class="list" cellspacing="0" cellpadding="0" style="width:300px">
<?php if($join) { if($group['dailyprice']) { ?>
<tr>
<td>日价格</td><td> <?php echo $group['dailyprice'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstrans']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstrans']]['title'];?></td>
</tr>
<tr>
<td>您目前可以购买</td><td><?php echo $usermaxdays;?> 天</td>
</tr>
<tr>
<td>购买时间</td><td><input type="text" size="2" name="days" value="<?php echo $group['minspan'];?>" class="px" onkeyup="change_credits_need(this.value)" /> 天</td>
</tr>
<tr>
<td>所需<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstrans']]['title'];?></td><td><span id="credits_need"></span> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstrans']]['unit'];?>
<script language="javascript">
var dailyprice = <?php echo $group['dailyprice'];?>;
function change_credits_need(daynum) {
if(!isNaN(parseInt(daynum))) {
$('credits_need').innerHTML = parseInt(daynum) * dailyprice;
} else {
$('credits_need').innerHTML = '0';
}
}
change_credits_need(<?php echo $group['minspan'];?>);
</script></td>
</tr>
<tr>
<td colspan="2">说明:
<?php if($join) { ?>
本组是收费用户组，您可以根据日价格按天购买，<br/>但是不能少于 <?php echo $group['minspan'];?> 天。请注意，购买后不能退款 
<?php } else { ?>
本操作不可恢复，您退出收费用户组后，如需再次加入，将重新支付相应的费用，因此请在提交前仔细确定是否退出本组 
<?php } ?>
</td>
</tr>
<?php } else { ?>
<tr>
<td colspan="2">说明: 加入该组是免费的，且没有时间限制，您可以随时加入或者退出</td>
</tr>
<?php } } else { ?>
<tr>
<td colspan="2">说明:
<?php if($group['type'] != 'special' || $group['system']=='private') { ?>
注意: 该组不是开放用户组，一旦您退出，只有管理员才能将您重新加入进来
<?php } elseif($group['dailyprice']) { ?>
本操作不可恢复，您退出收费用户组后，如需再次加入，将重新支付相应的费用，因此请在提交前仔细确定是否退出本组 
<?php } else { ?>
该组是开放的用户组，您退出后，可以随时加入进来 
<?php } ?>
</td>
</tr>
<?php } ?>
</table>
</div>
<p>
<button type="submit" name="editsubmit_btn" id="editsubmit_btn" value="true" class="pn pnc"><strong>提交</strong></button>
</p>
</form>
</div>
</div>
<?php } elseif($do == 'switch') { include template('home/spacecp_header'); ?><?php if(!empty($_G['setting']['pluginhooks']['spacecp_usergroup_top'])) echo $_G['setting']['pluginhooks']['spacecp_usergroup_top'];?><?php include template('home/spacecp_usergroup_header'); ?><div class="f_c">
<h3 class="flb">
<em id="return_<?php echo $_GET['handlekey'];?>">切换到 <?php echo $group['grouptitle'];?></em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_GET['handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>
<form id="switchgroupform_<?php echo $groupid;?>" name="switchgroupform_<?php echo $groupid;?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=usergroup&amp;do=switch&amp;groupid=<?php echo $groupid;?>"<?php if(!empty($_GET['inajax'])) { ?> onsubmit="ajaxpost('switchgroupform_<?php echo $groupid;?>', 'return_<?php echo $_GET['handlekey'];?>', 'return_<?php echo $_GET['handlekey'];?>', 'onerror');return false;"<?php } ?>>
<input type="hidden" name="referer" value="<?php echo dreferer(); ?>" />
<input type="hidden" name="groupsubmit" value="true" />
<input type="hidden" name="gid" value="<?php echo $_GET['gid'];?>" />

<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_GET['handlekey'];?>" /><?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">
<table class="list" cellspacing="0" cellpadding="0" style="width:300px">
<tr>
<td>原主用户组</td><td><?php echo $_G['group']['grouptitle'];?></td>
</tr>
<tr>
<td>新主用户组</td><td><?php echo $group['grouptitle'];?></td>
</tr>
</table>
</div>
<p>
<button type="submit" name="editsubmit_btn" id="editsubmit_btn" value="true" class="pn pnc"><strong>提交</strong></button>
</p>
</form>
</div>
</div>
<?php } elseif($do == 'forum') { include template('home/spacecp_header'); ?><?php if(!empty($_G['setting']['pluginhooks']['spacecp_usergroup_top'])) echo $_G['setting']['pluginhooks']['spacecp_usergroup_top'];?><?php include template('home/spacecp_usergroup_header'); ?><table cellpadding="0" cellspacing="0" class="tdat ftb mt10 mb10">
<tr class="alt">
<th class="xw1">版块名称</th><?php if(isset($perms) && is_array($perms)) foreach($perms as $perm) { ?><td class="xw1"><?php echo $permlang['perms_'.$perm];?></td>
<?php } ?>
</tr><?php $key = 1;?><?php if(isset($_G['cache']['forums']) && is_array($_G['cache']['forums'])) foreach($_G['cache']['forums'] as $fid => $forum) { if($forum['status']) { ?>
<tr <?php if($key++%2==0) { ?>class="alt"<?php } ?>>
<th<?php if($forum['type'] == 'forum') { ?> style="padding-left:30px"<?php } elseif($forum['type'] == 'sub') { ?> style="padding-left:60px"<?php } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $forum['fid'];?>"><?php echo $forum['name'];?></a></th><?php if(isset($perms) && is_array($perms)) foreach($perms as $perm) { ?><td>
<?php if(!empty($verifyperm[$fid][$perm])) { if($myverifyperm[$fid][$perm] || $forumperm[$fid][$perm]) { ?>
<i class="fico-valid fc-v" title="data_valid"></i>
<?php } else { ?>
<i class="fico-invalid fc-i" title="data_invalid"></i>
<?php } ?>
&nbsp;<?php echo $verifyperm[$fid][$perm];?>
<?php } else { if($forumperm[$fid][$perm]) { ?><i class="fico-valid fc-v" title="data_valid"></i><?php } else { ?><i class="fico-invalid fc-i" title="data_invalid"></i><?php } } ?>
</td>
<?php } ?>
</tr>
<?php } } ?>
</table>
<i class="fico-valid fc-v" title="data_valid"></i> 表示有权操作&nbsp;
<i class="fico-invalid fc-i" title="data_invalid"></i> 表示无权操作&nbsp;
<?php if($_G['setting']['verify']['enabled']) { echo implode('', $verifyicon); ?> 表示必须拥有指定的认证
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['spacecp_usergroup_bottom'])) echo $_G['setting']['pluginhooks']['spacecp_usergroup_bottom'];?>
</div>
<?php } elseif($do == 'expiry' || $do == 'list') { include template('home/spacecp_header'); ?><?php if(!empty($_G['setting']['pluginhooks']['spacecp_usergroup_top'])) echo $_G['setting']['pluginhooks']['spacecp_usergroup_top'];?><?php include template('home/spacecp_usergroup_header'); ?><p class="tbmu"><span class="y">
您目前有 <span class="xi1"> <?php echo $usermoney;?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstrans']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstrans']]['title'];?></span></span>
当前用户组: <?php echo $_G['cache']['usergroups'][$_G['groupid']]['grouptitle'];?>
</p>
<?php if($do == 'expiry') { ?>
<div class="notice">您当前的用户组已经到期，请选择继续续费还是要切换到其他用户组</div>
<?php } if($expirylist) { ?>
<table cellspacing="0" cellpadding="0" class="dt mt10 mb10">
<tbody class="th">
<tr>
<th>用户组</th>
<th>日价格</th>
<th>您目前可以购买</th>
<th>到期时间</th>
<th></th>
</tr>
</tbody>
<tbody><?php if(isset($expirylist) && is_array($expirylist)) foreach($expirylist as $groupid => $group) { ?><tr class="<?php echo swapclass('alt'); ?>">
<td><a href="home.php?mod=spacecp&amp;ac=usergroup&amp;gid=<?php echo $groupid;?>" class="xi2" target="_blank"><?php echo $group['grouptitle'];?></a></td>
<td>
<?php if($_G['cache']['usergroups'][$groupid]['pubtype'] == 'buy' && $group['dailyprice']) { ?>
<?php echo $group['dailyprice'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstrans']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstrans']]['title'];?>
<?php } elseif($_G['cache']['usergroups'][$groupid]['pubtype'] == 'free') { ?>
免费
<?php } ?>
</td>
<td><?php if($group['usermaxdays']) { ?><?php echo $group['usermaxdays'];?> 天<?php } ?></td>
<td><?php echo $group['time'];?></td>
<td>
<?php if((is_array($extgroupids) && in_array($groupid, $extgroupids)) || $groupid == $_G['groupid']) { if($groupid != $_G['groupid']) { if(!$group['noswitch']) { ?>
<a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=switch&amp;groupid=<?php echo $groupid;?>&amp;handlekey=switchgrouphk" class="xw1 xi2">切换</a>
<?php } if(!$group['maingroup']) { if($_G['cache']['usergroups'][$groupid]['pubtype'] == 'buy') { ?>
<a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=buy&amp;groupid=<?php echo $groupid;?>&amp;handlekey=buygrouphk" class="xw1 xi2">续费</a>
<?php } ?>
<a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=exit&amp;groupid=<?php echo $groupid;?>&amp;handlekey=exitgrouphk" class="xw1 xi2">退出</a>
<?php } } else { if($_G['cache']['usergroups'][$groupid]['pubtype'] == 'buy') { ?>
<a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=buy&amp;groupid=<?php echo $groupid;?>&amp;handlekey=buygrouphk" class="xw1 xi2">续费</a>
<?php } ?>
主用户组
<?php } } elseif($_G['cache']['usergroups'][$groupid]['pubtype'] == 'free') { ?>
<a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=buy&amp;groupid=<?php echo $groupid;?>&amp;handlekey=buygrouphk" class="xw1 xi2">免费购买</a>
<?php } elseif($_G['cache']['usergroups'][$groupid]['pubtype'] == 'buy') { ?>
<a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=buy&amp;groupid=<?php echo $groupid;?>&amp;handlekey=buygrouphk" class="xw1 xi2">购买</a>
<?php } ?>
</td>
</tr>
<?php } ?>
</tbody>
</table>
<?php } else { ?>
<p class="emp">抱歉！本站尚未开通可供购买的用户组</p>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['spacecp_usergroup_bottom'])) echo $_G['setting']['pluginhooks']['spacecp_usergroup_bottom'];?>
</div>
<?php } else { include template('home/spacecp_header'); ?><?php if(!empty($_G['setting']['pluginhooks']['spacecp_usergroup_top'])) echo $_G['setting']['pluginhooks']['spacecp_usergroup_top'];?><?php include template('home/spacecp_usergroup_header'); $permtype = array(0 => '普通权限', 1 => '管理权限');?><div class="tdats">
<table cellpadding="0" cellspacing="0" class="tdat">
<tr><th class="c0">&nbsp;</th></tr>
<tr><th class="alt">&nbsp;</th></tr>
<tbody class="ca">
<tr><td>用户级别</td></tr><?php if(isset($bperms) && is_array($bperms)) foreach($bperms as $key => $perm) { ?><tr <?php if($key%2==0) { ?>class="alt"<?php } ?>>
<td><?php echo $permlang['perms_'.$perm];?></td>
</tr>
<?php } ?>
</tbody>

<tr class="alt h">
<th>帖子相关</th>
</tr>
<tbody class="cb"><?php if(isset($pperms) && is_array($pperms)) foreach($pperms as $key => $perm) { ?><tr <?php if($key%2==0) { ?>class="alt"<?php } ?>>
<td><?php echo $permlang['perms_'.$perm];?></td>
</tr>
<?php } ?>
</tbody>

<tr class="alt h">
<th>家园相关</th>
</tr>
<tbody class="cc"><?php if(isset($sperms) && is_array($sperms)) foreach($sperms as $key => $perm) { ?><tr <?php if($key%2==0) { ?>class="alt"<?php } ?>>
<td><?php echo $permlang['perms_'.$perm];?></td>
</tr>
<?php } ?>
</tbody>


<tr class="alt h">
<th>附件相关</th>
</tr>
<tbody class="cd"><?php if(isset($aperms) && is_array($aperms)) foreach($aperms as $key => $perm) { ?><tr <?php if($key%2==0) { ?>class="alt"<?php } ?>>
<td><?php echo $permlang['perms_'.$perm];?></td>
</tr>
<?php } ?>
</tbody>
</table>
<table cellpadding="0" cellspacing="0" class="tdat tfx<?php if(!$group) { ?>f<?php } ?>">
<tr>
<th class="c0"><h4>我的主用户组 - <?php echo $maingroup['grouptitle'];?></h4></th>
</tr>
<tr>
<th class="alt"><span class="notice">积分: <?php echo $space['credits'];?></span></th>
</tr><?php echo permtbody($maingroup); ?></table>
<?php if($group) { if($switchtype == 'user') { $cid = 1;$tlang = '普通用户组';?><?php } if($switchtype == 'upgrade') { $cid = 2;$tlang = '晋级用户组';?><?php } if($switchtype == 'admin') { $cid = 3;$tlang = '站点管理组';?><?php } ?>
<ul id="tba" class="tb c<?php echo $cid;?>">
<li id="c<?php echo $cid;?>"><?php echo $tlang;?> - <?php echo $currentgrouptitle;?></li>
</ul>
<div class="tscr">
<table cellpadding="0" cellspacing="0" class="tdat">
<tr>
<th class="alt h">
<?php if($group['grouptype'] == 'member') { $v = $group['groupcreditshigher'] - $_G['member']['credits'];?><?php if($_G['group']['grouptype'] == 'member' && $v > 0) { ?>
<span class="notice">您升级到此用户组还需积分 <?php echo $v;?></span>
<?php } else { ?>
<span class="notice">积分下限 <?php echo $group['groupcreditshigher'];?></span>
<?php } } if(isset($publicgroup[$group['groupid']]) && $group['groupid'] != $_G['groupid'] && $publicgroup[$group['groupid']]['allowsetmain']) { ?>
<a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=switch&amp;groupid=<?php echo $group['groupid'];?>&amp;gid=<?php echo $_GET['gid'];?>&amp;handlekey=switchgrouphk" class="xw1 xi2">切换</a>
<?php } if((is_array($extgroupids) && in_array($group['groupid'], $extgroupids)) && $switchmaingroup && $group['grouptype'] == 'special' && $group['groupid'] != $_G['groupid']) { if($_G['cache']['usergroups'][$group['groupid']]['pubtype'] == 'buy') { ?>
<a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=buy&amp;groupid=<?php echo $group['groupid'];?>&amp;gid=<?php echo $_GET['gid'];?>&amp;handlekey=buygrouphk" class="xw1 xi2">续费</a>
<?php } ?>
<a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=exit&amp;groupid=<?php echo $group['groupid'];?>&amp;gid=<?php echo $_GET['gid'];?>&amp;handlekey=exitgrouphk" class="xw1 xi2">退出</a>
<?php } if($group['grouptype']=='special' && $group['groupid'] != $_G['groupid'] && array_key_exists($group['groupid'], $publicgroup) && !$publicgroup[$group['groupid']]['allowsetmain']) { ?>
<a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=buy&amp;groupid=<?php echo $group['groupid'];?>&amp;gid=<?php echo $_GET['gid'];?>&amp;handlekey=buygrouphk" class="xw1 xi2">购买</a>
<?php } if(isset($groupterms['ext']) && is_array($groupterms['ext']) && array_key_exists($group['groupid'], $groupterms['ext'])) { ?>
<span class="notice">用户组过期时间: <?php echo dgmdate($groupterms['ext'][$group['groupid']]);?></span>
<?php } ?>
</th>
</tr><?php echo permtbody($group); ?></table>
</div>
<?php } ?>
</div>
<i class="fico-valid fc-v" title="data_valid"></i> 表示有权操作&nbsp;
<i class="fico-invalid fc-i" title="data_invalid"></i> 表示无权操作
<div id="gmy_menu" class="p_pop" style="display:none"><?php echo $usergroups['my'];?></div>
<div id="gupgrade_menu" class="p_pop" style="display:none"><?php echo $usergroups['upgrade'];?></div>
<div id="guser_menu" class="p_pop" style="display:none"><?php echo $usergroups['user'];?></div>
<div id="gadmin_menu" class="p_pop" style="display:none"><?php echo $usergroups['admin'];?></div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['spacecp_usergroup_bottom'])) echo $_G['setting']['pluginhooks']['spacecp_usergroup_bottom'];?>
</div>
<?php } function permtbody($maingroup) {
global $_G, $bperms, $pperms, $sperms, $aperms;?><tr><td><?php echo showstars($_G['cache']['usergroups'][$maingroup['groupid']]['stars']);; ?></td></tr>
<tbody class="ca"><?php if(isset($bperms) && is_array($bperms)) foreach($bperms as $key => $groupbperm) { ?><tr <?php if($key%2==0) { ?>class="alt"<?php } ?>>
<td>
<?php if($groupbperm == 'creditshigher' || $groupbperm == 'readaccess' || $groupbperm == 'maxpmnum') { ?>
<?php echo $maingroup[$groupbperm];?>
<?php } elseif($groupbperm == 'allowsearch') { if($maingroup['allowsearch'] == '0') { ?>禁用搜索<?php } elseif($maingroup['allowsearch'] == '1') { ?>只允许搜索标题<?php } else { ?>允许搜索帖子内容<?php } } else { if($maingroup[$groupbperm] >= 1) { ?><i class="fico-valid fc-v" title="data_valid"></i><?php } else { ?><i class="fico-invalid fc-i" title="data_invalid"></i><?php } } ?>
</td>
</tr>
<?php } ?>
</tbody>

<tr class="alt h">
<th><?php echo $maingroup['grouptitle'];?></th>
</tr>
<tbody class="cb"><?php if(isset($pperms) && is_array($pperms)) foreach($pperms as $key => $grouppperm) { ?><tr <?php if($key%2==0) { ?>class="alt"<?php } ?>>
<td>
<?php if(in_array($grouppperm, array('maxsigsize', 'maxbiosize'))) { ?>
<?php echo $maingroup[$grouppperm];?> 字节
<?php } elseif($grouppperm == 'allowrecommend') { if($maingroup['allowrecommend'] > 0) { ?>+<?php echo $maingroup['allowrecommend'];?><?php } else { ?><i class="fico-invalid fc-i" title="data_invalid"></i><?php } } elseif(in_array($grouppperm, array('allowat', 'allowcreatecollection'))) { echo intval($maingroup[$grouppperm]); } else { if($maingroup[$grouppperm] == 1 || (in_array($grouppperm, array('raterange', 'allowcommentpost')) && !empty($maingroup[$grouppperm]))) { ?><i class="fico-valid fc-v" title="data_valid"></i><?php } else { ?><i class="fico-invalid fc-i" title="data_invalid"></i><?php } } ?>
</td>
</tr>
<?php } ?>
</tbody>

<tr class="alt h">
<th><?php echo $maingroup['grouptitle'];?></th>
</tr>
<tbody class="cc"><?php if(isset($sperms) && is_array($sperms)) foreach($sperms as $key => $perm) { ?><tr <?php if($key%2==0) { ?>class="alt"<?php } ?>>
<td>
<?php if(in_array($perm, array('maxspacesize', 'maximagesize'))) { if($maingroup[$perm]) { ?><?php echo $maingroup[$perm];?><?php } else { ?>没有限制<?php } } else { if($maingroup[$perm] == 1) { ?><i class="fico-valid fc-v" title="data_valid"></i><?php } else { ?><i class="fico-invalid fc-i" title="data_invalid"></i><?php } } ?>
</td>
</tr>
<?php } ?>
</tbody>

<tr class="alt h">
<th><?php echo $maingroup['grouptitle'];?></th>
</tr>
<tbody class="cd"><?php if(isset($aperms) && is_array($aperms)) foreach($aperms as $key => $groupaperm) { ?><tr <?php if($key%2==0) { ?>class="alt"<?php } ?>>
<td>
<?php if(in_array($groupaperm, array('maxattachsize', 'maxsizeperday', 'maxattachnum'))) { if($maingroup[$groupaperm]) { ?><?php echo $maingroup[$groupaperm];?><?php } else { ?>没有限制<?php } } elseif($groupaperm == 'attachextensions') { if($maingroup['allowpostattach'] == 1) { if($maingroup['attachextensions']) { ?><p class="nwp" title="<?php echo $maingroup['attachextensions'];?>"><?php echo $maingroup['attachextensions'];?></p><?php } else { ?>没有限制<?php } } else { ?><i class="fico-invalid fc-i" title="data_invalid"></i><?php } } else { if($maingroup[$groupaperm] == 1) { ?><i class="fico-valid fc-v" title="data_valid"></i><?php } else { ?><i class="fico-invalid fc-i" title="data_invalid"></i><?php } } ?>
</td>
</tr>
<?php } ?>
</tbody><?php }?><?php include template('common/footer'); ?>