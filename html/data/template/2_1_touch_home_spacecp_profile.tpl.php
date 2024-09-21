<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_profile');
0
|| checktplrefresh('./template/default/touch/home/spacecp_profile.htm', './template/default/touch/home/spacecp_header.htm', 1726579847, '1', './data/template/2_1_touch_home_spacecp_profile.tpl.php', './template/default', 'touch/home/spacecp_profile')
|| checktplrefresh('./template/default/touch/home/spacecp_profile.htm', './template/default/touch/common/seccheck.htm', 1726579847, '1', './data/template/2_1_touch_home_spacecp_profile.tpl.php', './template/default', 'touch/home/spacecp_profile')
|| checktplrefresh('./template/default/touch/home/spacecp_profile.htm', './template/default/touch/home/spacecp_profile_nav.htm', 1726579847, '1', './data/template/2_1_touch_home_spacecp_profile.tpl.php', './template/default', 'touch/home/spacecp_profile')
;?><?php include template('common/header'); ?><div class="header cl">
<div class="mz"><a href="javascript:history.back();"><i class="dm-c-left"></i></a></div>
<h2><?php include template('home/spacecp_header_name'); ?></h2>
<div class="my"><a href="index.php"><i class="dm-house"></i></a></div>
</div>

<div class="dhnav_box">
<div id="dhnav">
<div id="dhnav_li">
<ul class="swiper-wrapper"><?php include template('home/spacecp_footer'); ?></ul>
</div>
</div>
</div>

<script>if($("#dhnav_li .mon").length>0){var discuz_nav=$("#dhnav_li .mon").offset().left+$("#dhnav_li .mon").width()>=$(window).width()?$("#dhnav_li .mon").index():0}else{var discuz_nav=0}new Swiper('#dhnav_li',{freeMode:true,slidesPerView:'auto',initialSlide:discuz_nav,onTouchMove:function(swiper){Discuz_Touch_on=0},onTouchEnd:function(swiper){Discuz_Touch_on=1},});</script>

<div class="bodybox p10 cl" style="padding-top: 0 !important;">
<?php if($validate) { ?>
<p class="tbmu mb10">管理员否决了您的注册申请，请完善注册原因，重新提交申请</p>
<form action="member.php?mod=regverify" method="post" autocomplete="off">
<input type="hidden" value="<?php echo FORMHASH;?>" name="formhash" />
<table summary="个人资料" cellspacing="0" cellpadding="0" class="tfm">
<tr>
<th>否决原因</th>
<td><?php echo $validate['remark'];?></td>
<td>&nbsp;</td>
</tr>
<tr>
<th>注册原因</th>
<td><input type="text" class="px" name="regmessagenew" value="" /></td>
<td>&nbsp;</td>
</tr>
<tr>
<th>&nbsp;</th>
<td colspan="2">
<button type="submit" name="verifysubmit" value="true" class="pn pnc" /><strong>重新提交申请</strong></button>
</td>
</tr>
</table>
<?php } else { if($operation == 'password') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>register.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<p class="pt10 mb10">
<?php if(!$_G['member']['freeze']) { if(empty($_G['setting']['connect']['allow']) || !$conisregister) { ?>您必须填写原密码才能修改下面的资料<?php } elseif($wechatuser) { ?>您目前使用的是微信账号绑定本站，您可以在这里设置独立密码，只有设置了独立密码后本站需要填写密码的相应功能才可使用<?php } else { ?>您目前使用的是QQ账号绑定本站，您可以在这里设置独立密码，只有设置了独立密码后本站需要填写密码的相应功能才可使用<?php } } elseif($_G['member']['freeze'] == 1) { ?>
<strong class="xi1">您当前的账号已经被冻结，请修改密码解除冻结状态</strong>
<?php } elseif($_G['member']['freeze'] == 2) { ?>
<strong class="xi1">您当前的账号已经被冻结，必须验证邮箱后才能解除冻结状态 <a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password&amp;resend=1&amp;formhash=<?php echo FORMHASH;?>" class="xi2">重新接收验证邮件</a></strong>
<?php } elseif($_G['member']['freeze'] == -1) { ?>
<strong class="xi1">您当前的账号已经被冻结，必须在本页面填写申诉理由，并经管理中心审核通过后才能解除冻结状态</strong>
<?php } ?>
</p>
<form action="home.php?mod=spacecp&amp;ac=profile" method="post" autocomplete="off">
<input type="hidden" value="<?php echo FORMHASH;?>" name="formhash" />
<table summary="个人资料" cellspacing="0" cellpadding="0" class="tfm">
<?php if(empty($_G['setting']['connect']['allow']) || !$conisregister) { ?>
<tr>
<th><span class="rq" title="必填">*</span>旧密码</th>
<td><input type="password" name="oldpassword" id="oldpassword" class="px" /></td>
</tr>
<?php } ?>
<tr>
<th>新密码</th>
<td>
<input type="password" name="newpassword" id="newpassword" class="px" />
<p class="d" id="chk_newpassword">如不需要更改密码，此处请留空 </p>
</td>
</tr>
<tr>
<th>确认新密码</th>
<td>
<input type="password" name="newpassword2" id="newpassword2"class="px" />
<p class="d" id="chk_newpassword2">如不需要更改密码，此处请留空 </p>
</td>
</tr>
<tr id="contact"<?php if(isset($_GET['from']) && $_GET['from'] == 'contact') { ?> style="background-color: <?php echo $_G['style']['specialbg'];?>;"<?php } ?>>
<th>Email</th>
<td>
<input type="text" name="emailnew" id="emailnew" value="<?php echo $space['email'];?>" class="px" />
<p class="d">
<?php if($_G['member']['freeze'] == 2) { ?>
<p class="xi1">您当前的账号已经被冻结，必须验证邮箱后才能解除冻结状态 <a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password&amp;resend=1&amp;formhash=<?php echo FORMHASH;?>" class="xi2">重新接收验证邮件</a></p>
<?php } elseif(empty($space['newemail'])) { ?>
<i class="fico-email vm fc-v" title="已验证"></i><span class="xi1 vm">当前邮箱已经验证激活</span>
<?php } else { ?>
<?php echo $acitvemessage;?>
<?php } ?>
</p>
<?php if($_G['setting']['regverify'] == 1 && (($_G['group']['grouptype'] == 'member' && in_array($_G['adminid'], array(0, -1))) || $_G['groupid'] == 8) || $_G['member']['freeze']) { ?><p class="d">!如更改地址，系统将修改您的密码并重新验证其有效性，请慎用 </p><?php } ?>
</td>
</tr>
<tr>
<th>安全手机号</th>
<td>
<input type="text" name="secmobiccnew" id="secmobiccnew" value="<?php echo $space['secmobicc'];?>" class="px" style="width: 30px;" />
<input type="text" name="secmobilenew" id="secmobilenew" value="<?php echo $space['secmobile'];?>" class="px" style="width: 60%;" />
<p class="d">国际电话区号不含加号，留空则默认为</p>
</td>
</tr>
<?php if($_G['setting']['smsstatus']) { ?>
<tr>
<th>手机验证码</th>
<td>
<input type="text" name="secmobseccodenew" id="secmobseccodenew" value="" class="px" />
<button type="button" name="secmobseccodesendnew" id="secmobseccodesendnew" value="true" class="pn pnc" onclick="memcp_sendsecmobseccode();" /><strong>发送</strong></button>
<p class="d">在更改完绑定安全手机号收到验证码后，需要在这里输入验证码并点击页面下方的 "保存" 按钮</p>
</td>
</tr>
<?php } if($_G['member']['freeze'] == 2 || $_G['member']['freeze'] == -1) { ?>
<tr>
<th>申诉理由</th>
<td>
<textarea rows="3" cols="80" name="freezereson" class="pt"><?php echo $space['freezereson'];?></textarea>
<?php if($_G['member']['freeze'] == 2) { ?><p class="d" id="chk_newpassword2">如果您无法通过邮箱验证，请填写申诉理由</p><?php } if($_G['member']['freeze'] == -1) { ?><p class="d" id="chk_newpassword2">如果您认为您的账号不应被冻结，请填写申诉理由</p><?php } ?>
</td>
</tr>
<?php } if(($_G['member']['freeze'] == 2 || $_G['member']['freeze'] == -1) && !empty($space['freezemodremark'])) { ?>
<tr>
<th>审核结果</th>
<td>
<textarea rows="3" cols="80" name="freezemodremark" class="pt" disabled="disabled"><?php echo $space['freezemodremark'];?></textarea>
<p class="d" id="chk_newpassword2">您已提交 <?php echo $space['freezemodsubmittimes'];?> 次审核，最后一次审核操作由 <?php echo $space['freezemodadmin'];?> 于 <?php echo $space['freezemoddate'];?> 做出</p>
</td>
</tr>
<?php } ?>

<tr>
<th>安全提问</th>
<td>
<select name="questionidnew" id="questionidnew">
<option value="" selected>保持原有的安全提问和答案</option>
<option value="0">无安全提问</option>
<option value="1">母亲的名字</option>
<option value="2">爷爷的名字</option>
<option value="3">父亲出生的城市</option>
<option value="4">您其中一位老师的名字</option>
<option value="5">您个人计算机的型号</option>
<option value="6">您最喜欢的餐馆名称</option>
<option value="7">驾驶执照最后四位数字</option>
</select>
<p class="d">如果您启用安全提问，登录时需填入相应的项目才能登录 </p>
</td>
</tr>

<tr>
<th>回答</th>
<td>
<input type="text" name="answernew" id="answernew" class="px" />
<p class="d">如您设置新的安全提问，请在此输入答案 </p>
</td>
</tr>
<?php if($secqaacheck || $seccodecheck) { ?>
</table><?php $sectpl = '<table cellspacing="0" cellpadding="0" class="tfm"><tr><th><sec></th><td><sec><p class="d"><sec></p></td></tr></table>';?><?php $sechash = 'S'.random(4);
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
<?php } } ?><table summary="个人资料" cellspacing="0" cellpadding="0" class="tfm">
<?php } ?>
<tr>
<td colspan="2"><button type="submit" name="pwdsubmit" value="true" class="pn pnc" /><strong>保存</strong></button></td>
</tr>
</table>
<input type="hidden" name="passwordsubmit" value="true" />
</form>
<script type="text/javascript">
var strongpw = new Array();
<?php if($_G['setting']['strongpw']) { if(isset($_G['setting']['strongpw']) && is_array($_G['setting']['strongpw'])) foreach($_G['setting']['strongpw'] as $key => $val) { ?>strongpw[<?php echo $key;?>] = <?php echo $val;?>;
<?php } } ?>
var pwlength = <?php if($_G['setting']['pwlength']) { ?><?php echo $_G['setting']['pwlength'];?><?php } else { ?>0<?php } ?>;
checkPwdComplexity($('newpassword'), $('newpassword2'), true);
</script>
<?php if($_G['setting']['smsstatus']) { ?>
<script type="text/javascript">
function memcp_sendsecmobseccode() {
memcp_svctype = 1;
memcp_secmobicc = getID("secmobiccnew").value;
memcp_secmobile = getID("secmobilenew").value;
return sendsecmobseccode(memcp_svctype, memcp_secmobicc, memcp_secmobile);
}
</script>
<?php } } else { ?>
<?php if(!empty($_G['setting']['pluginhooks']['spacecp_profile_top'])) echo $_G['setting']['pluginhooks']['spacecp_profile_top'];?><div class="dhnavs_box">
<div id="dhnavs">
<div id="dhnavs_li">
<ul class="swiper-wrapper">
<?php if($operation != 'verify') { if(isset($profilegroup) && is_array($profilegroup)) foreach($profilegroup as $key => $value) { if($value['available']) { ?>
<li class="swiper-slide<?php if($opactives[$key] or '') { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=<?php echo $key;?>"><?php echo $value['title'];?></a></li>
<?php } } if($_G['setting']['allowspacedomain'] && $_G['setting']['domain']['root']['home'] && checkperm('domainlength')) { ?>
<li class="swiper-slide<?php if($opactives['domain']) { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=domain">我的空间域名</a></li>
<?php } } else { if($_G['setting']['verify']) { if(isset($_G['setting']['verify']) && is_array($_G['setting']['verify'])) foreach($_G['setting']['verify'] as $vid => $verify) { if($verify['available'] && (empty($verify['groupid']) || (is_array($verify['groupid']) && in_array($_G['groupid'], $verify['groupid'])))) { if($vid != 7) { ?>
<li class="swiper-slide<?php if($opactives['verify'.$vid]) { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=verify&amp;vid=<?php echo $vid;?>"><?php echo $verify['title'];?></a></li>
<?php } } } } } if($op != 'verify' && !empty($_G['setting']['plugins']['spacecp_profile'])) { if(isset($_G['setting']['plugins']['spacecp_profile']) && is_array($_G['setting']['plugins']['spacecp_profile'])) foreach($_G['setting']['plugins']['spacecp_profile'] as $id => $module) { if(in_array($module['adminid'], array(0, -1)) || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?>
<li class="swiper-slide<?php if($_GET['id'] == $id) { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=plugin&amp;op=profile&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li>
<?php } } } ?>
</ul>
</div>
</div>
</div>
<script>if($("#dhnavs_li .mon").length>0){var discuz_nav=$("#dhnavs_li .mon").offset().left+$("#dhnavs_li .mon").width()>=$(window).width()?$("#dhnavs_li .mon").index():0}else{var discuz_nav=0}new Swiper('#dhnavs_li',{freeMode:true,slidesPerView:'auto',initialSlide:discuz_nav,onTouchMove:function(swiper){Discuz_Touch_on=0},onTouchEnd:function(swiper){Discuz_Touch_on=1},});</script>
<?php if($vid) { ?>
<p class="tbms mt10 <?php if(!$showbtn) { ?>tbms_r<?php } ?>"><?php if($showbtn) { ?>以下信息通过审核后将不能再次修改，提交后请耐心等待核查 <?php } else { ?>恭喜您，您的认证审核已经通过，下面的资料项已经不允许被修改 <?php } ?></p>
<?php } ?>
<iframe id="frame_profile" name="frame_profile" style="display: none"></iframe>
<form action="<?php if($operation != 'plugin') { ?>home.php?mod=spacecp&ac=profile&op=<?php echo $operation;?><?php } else { ?>home.php?mod=spacecp&ac=plugin&op=profile&id=<?php echo $_GET['id'];?><?php } ?>" method="post" enctype="multipart/form-data" autocomplete="off"<?php if($operation != 'plugin') { ?> target="frame_profile"<?php } ?> onsubmit="clearErrorInfo();">
<input type="hidden" value="<?php echo FORMHASH;?>" name="formhash" />
<?php if(!empty($_GET['vid'])) { ?>
<input type="hidden" value="<?php echo $_GET['vid'];?>" name="vid" />
<?php } ?>
<table cellspacing="0" cellpadding="0" class="tfm" id="profilelist">
<tr>
<th>用户名</th>
<td><?php echo $_G['member']['username'];?></td>
<td>&nbsp;</td>
</tr><?php if(isset($settings) && is_array($settings)) foreach($settings as $key => $value) { if($value['available']) { ?>
<tr id="tr_<?php echo $key;?>">
<th id="th_<?php echo $key;?>"><?php if($value['required']) { ?><span class="rq" title="必填">*</span><?php } ?><?php echo $value['title'];?></th>
<td id="td_<?php echo $key;?>">
<?php echo $htmls[$key];?>
</td>
<td class="p">
<?php if($vid) { ?>
<input type="hidden" name="privacy[<?php echo $key;?>]" value="3" />
<?php } else { ?>
<select name="privacy[<?php echo $key;?>]">
<option value="0"<?php if(isset($privacy[$key]) && $privacy[$key] == "0") { ?> selected="selected"<?php } ?>>公开</option>
<option value="1"<?php if(isset($privacy[$key]) && $privacy[$key] == "1") { ?> selected="selected"<?php } ?>>好友可见</option>
<option value="3"<?php if(isset($privacy[$key]) && $privacy[$key] == "3") { ?> selected="selected"<?php } ?>>保密</option>
</select>
<?php } ?>
</td>
</tr>
<?php } } if($allowcstatus && is_array($allowitems) && in_array('customstatus', $allowitems)) { ?>
<tr>
<th id="th_customstatus">自定义头衔</th>
<td id="td_customstatus">
<input type="text" value="<?php echo $space['customstatus'];?>" name="customstatus" id="customstatus" class="px" />
<div class="rq mtn" id="showerror_customstatus"></div>
</td>
<td>&nbsp;</td>
</tr>
<?php } if($_G['group']['maxsigsize'] && is_array($allowitems) && in_array('sightml', $allowitems)) { ?>
<tr>
<th id="th_sightml">个人签名</th>
<td id="td_sightml">
<div class="tedt">
<div class="area">
<textarea rows="3" cols="80" name="sightml" id="sightmlmessage" class="pt" onkeydown="ctrlEnter(event, 'profilesubmitbtn');"><?php echo $space['sightml'];?></textarea>
</div>
</div>
</td>
<td>&nbsp;</td>
</tr>
<?php } if($operation == 'contact') { ?>
<tr>
<th id="th_sightml">Email</th>
<td id="td_sightml"><?php echo $space['email'];?>&nbsp;(<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password&amp;from=contact#contact">修改</a>)</td>
<td>&nbsp;</td>
</tr>
<?php } if($operation == 'plugin') { include(template($_GET['id']));?><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['spacecp_profile_extra'])) echo $_G['setting']['pluginhooks']['spacecp_profile_extra'];?>
<?php if($showbtn) { ?>
<tr>
<td colspan="3">
<input type="hidden" name="profilesubmit" value="true" />
<button type="submit" name="profilesubmitbtn" id="profilesubmitbtn" value="true" class="pn pnc" /><strong>保存</strong></button>
<span id="submit_result" class="rq"></span>
</td>
</tr>
<?php } ?>
</table>
<?php if(!empty($_G['setting']['pluginhooks']['spacecp_profile_bottom'])) echo $_G['setting']['pluginhooks']['spacecp_profile_bottom'];?>
</form>
<script type="text/javascript">
function show_error(fieldid, extrainfo) {
var elem = getID('th_'+fieldid);
if(elem) {
elem.className = "rq";
fieldname = elem.innerHTML;
extrainfo = (typeof extrainfo == "string") ? extrainfo : "";
getID('showerror_'+fieldid).innerHTML = "请检查该资料项 " + extrainfo;
getID(fieldid).focus();
}
}
function show_success(message) {
message = message == '' ? '资料更新成功' : message;
popup.open(message, 'alert');
}
function clearErrorInfo() {
var spanObj = getID('profilelist').getElementsByTagName("div");
for(var i in spanObj) {
if(typeof spanObj[i].id != "undefined" && spanObj[i].id.indexOf("_")) {
var ids = explode('_', spanObj[i].id);
if(ids[0] == "showerror") {
spanObj[i].innerHTML = '';
getID('th_'+ids[1]).className = '';
}
}
}
}
</script>
<?php } } ?>
</div><?php include template('common/footer'); ?>