<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('register');
0
|| checktplrefresh('./template/default/touch/member/register.htm', './template/default/touch/common/seccheck.htm', 1726579642, '1', './data/template/2_1_touch_member_register.tpl.php', './template/default', 'touch/member/register')
;?><?php include template('common/header'); ?><div class="header cl">
<div class="mz"><a href="javascript:history.back();"><i class="dm-c-left"></i></a></div><h2></h2><div class="my"></div>
</div>
<div class="header_toplogo"><?php echo $_G['style']['touchlogo'];?><p><?php echo $_G['setting']['reglinkname'];?></p></div>
<?php if(!empty($_G['setting']['pluginhooks']['register_top_mobile'])) echo $_G['setting']['pluginhooks']['register_top_mobile'];?>
<div class="loginbox registerbox">
<div class="login_from post_box">
<form method="post" autocomplete="off" name="register" id="registerform" action="member.php?mod=<?php echo $_G['setting']['regname'];?>&amp;mobile=2">
<input type="hidden" name="regsubmit" value="yes" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" /><?php $dreferer = str_replace('&amp;', '&', dreferer());?><input type="hidden" name="referer" value="<?php echo $dreferer;?>" />
<input type="hidden" name="activationauth" value="<?php if($_GET['action'] == 'activation') { ?><?php echo $activationauth;?><?php } ?>" />
<?php if($_G['setting']['sendregisterurl']) { ?>
<input type="hidden" name="hash" value="<?php echo $_GET['hash'];?>" />
<?php } ?>
<ul>
<?php if($sendurl) { ?>
<li class="mli"><input type="email" class="px" autocomplete="off" value="" name="<?php echo $_G['setting']['reginput']['email'];?>" placeholder="邮箱" fwin="login"></li>
<?php } else { if(empty($invite) && $_G['setting']['regstatus'] == 2 && !$invitestatus) { ?>
<li class="mli">
<input type="text" class="px" autocomplete="off" value="" name="invitecode" placeholder="邀请码" fwin="login">
<?php if($this->setting['inviteconfig']['buyinvitecode'] && $this->setting['inviteconfig']['invitecodeprice'] && payment::enable()) { ?>
<a href="misc.php?mod=buyinvitecode" class="input-append">还没有邀请码？点击此处获取</a>
<?php } ?>
</li>
<?php } ?>
<li class="mli"><input type="text" class="px" autocomplete="off" value="" name="<?php echo $_G['setting']['reginput']['username'];?>" placeholder="用户名：3-15位" fwin="login"></li>
<li class="mli"><input type="password" class="px" value="" name="<?php echo $_G['setting']['reginput']['password'];?>" placeholder="密码" fwin="login"></li>
<li class="mli"><input type="password" class="px" value="" name="<?php echo $_G['setting']['reginput']['password2'];?>" placeholder="确认密码" fwin="login"></li>
<li class="mli"><input type="email" class="px" autocomplete="off" value="<?php echo $hash[0];?>" name="<?php echo $_G['setting']['reginput']['email'];?>" placeholder="邮箱" fwin="login"></li>
<?php if($_G['setting']['regverify'] == 2) { ?>
<li class="mli"><input type="text" class="px" autocomplete="off" value="注册原因" name="regmessage" placeholder="注册原因" fwin="login"></li>
<?php } if(empty($invite) && $_G['setting']['regstatus'] == 3) { ?>
<li class="mli"><input type="text" class="px" autocomplete="off" value="" name="invitecode" placeholder="邀请码" fwin="login"></li>
<?php } if(isset($_G['cache']['fields_register']) && is_array($_G['cache']['fields_register'])) foreach($_G['cache']['fields_register'] as $field) { if($htmls[$field['fieldid']]) { if($field['fieldid'] == 'gender') { ?>
<li class="flex-box mli"><div class="flex xg1"><?php echo $field['title'];?></div><div class="flex-3"><?php echo $htmls[$field['fieldid']];?></div></li>
<?php } elseif($field['fieldid'] == 'birthday') { ?>
<li class="flex-box mli"><div class="flex xg1"><?php echo $field['title'];?></div><div class="flex-3 multisel"><?php echo $htmls[$field['fieldid']];?></div></li>
<?php } else { ?>
<li class="mli"><?php echo $htmls[$field['fieldid']];?></li>
<?php } } } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['register_input_mobile'])) echo $_G['setting']['pluginhooks']['register_input_mobile'];?>
</ul>
<?php if($secqaacheck || $seccodecheck) { $sechash = 'S'.random(4);
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
<?php } } } if($bbrules) { ?>
<label for="agreebbrule"><li class="mli"><input type="checkbox" class="pc" name="agreebbrule" value="<?php echo $bbrulehash;?>" id="agreebbrule" checked="checked" />同意<a href="javascript:;" onclick="showBBRule()">网站服务条款</a></li></label>
<div id="layer_bbruletxt" popup="true" class="tip login_pop" style="display:none;">
<div style="height:200px;display:block;overflow-y:scroll;">
<div class="log_tit"><?php echo addslashes($this->setting['bbname']);; ?> 网站服务条款</div>
<div class="p15"><?php echo $bbrulestxt;?></div>
</div>
</div>
<?php } ?>
</div>
<div class="btn_register"><button value="true" name="regsubmit" type="submit" class="formdialog pn">立即注册</button></div>
<div class="reg_link"><a href="member.php?mod=logging&amp;action=login&amp;referer=<?php echo rawurlencode($dreferer); ?>" class="login_now">已有账号？现在登录</a></div>
</form>
</div>
<div id="mask" style="display:none;"></div>
<?php if(!empty($_G['setting']['pluginhooks']['register_bottom_mobile'])) echo $_G['setting']['pluginhooks']['register_bottom_mobile'];?>
<script type="text/javascript">
<?php if($sendurl) { ?>
function succeedhandle_registerform(url, message, extra) {
popup.open(message, 'confirm', url)
}
<?php } if($bbrules && $bbrulesforce) { ?>
showBBRule();
<?php } if($this->showregisterform) { ?>
function showBBRule() {
var bbruletxt = getID("layer_bbruletxt").innerHTML;
popup.open(bbruletxt, 'alert');
}
<?php } ?>
</script><?php updatesession();?><?php include template('common/footer'); ?>