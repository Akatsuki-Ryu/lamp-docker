<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('login');
0
|| checktplrefresh('./template/default/touch/member/login.htm', './template/default/touch/common/seccheck.htm', 1726577950, '1', './data/template/2_1_touch_member_login.tpl.php', './template/default', 'touch/member/login')
;?><?php include template('common/header'); if(!$_GET['infloat']) { ?>
<div class="header cl">
<div class="mz"><a href="javascript:history.back();"><i class="dm-c-left"></i></a></div><h2></h2><div class="my"></div>
</div>
<div class="header_toplogo"><?php echo $_G['style']['touchlogo'];?><p><?php if(!isset($_GET['viewlostpw'])) { ?>登录<?php } else { ?>找回密码<?php } ?></p></div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['logging_top_mobile'])) echo $_G['setting']['pluginhooks']['logging_top_mobile'];?><?php $loginhash = 'L'.random(4);?><div class="loginbox <?php if($_GET['infloat']) { ?>login_pop<?php } ?>">
<?php if($_GET['infloat']) { ?>
<h2 class="log_tit"><a href="javascript:;" onclick="popup.close();"><span class="icon_close y">&nbsp;</span></a><?php if(!isset($_GET['viewlostpw'])) { ?>登录<?php } else { ?>找回密码<?php } ?></h2>
<?php } if(!isset($_GET['viewlostpw'])) { ?>
<form id="loginform" method="post" action="member.php?mod=logging&amp;action=login&amp;loginsubmit=yes&amp;loginhash=<?php echo $loginhash;?>&amp;mobile=2" onsubmit="<?php if($_G['setting']['pwdsafety']) { ?>pwmd5('password3_<?php echo $loginhash;?>');<?php } ?>" >
<input type="hidden" name="formhash" id="formhash" value='<?php echo FORMHASH;?>' />
<input type="hidden" name="referer" id="referer" value="<?php if(dreferer()) { echo dreferer(); } else { ?>forum.php?mobile=2<?php } ?>" />
<input type="hidden" name="fastloginfield" value="username">
<input type="hidden" name="cookietime" value="2592000">
<?php if($auth) { ?>
<input type="hidden" name="auth" value="<?php echo $auth;?>" />
<?php } ?>
<div class="login_from">
<ul>
<li><input type="text" value="" class="px" autocomplete="off" value="" name="username" placeholder="请输入用户名" fwin="login"></li>
<li><input type="password" class="px" value="" name="password" placeholder="密码" fwin="login"></li>
<li class="questionli">
<div class="login_select">
<span class="login-btn-inner">
<span class="login-btn-text">
<span class="span_question">安全提问(未设置请忽略)</span>
</span>
<i class="dm-c-right icon-arrow"></i>
</span>
<select id="questionid_<?php echo $loginhash;?>" name="questionid" class="sel_list">
<option value="0" selected="selected">安全提问(未设置请忽略)</option>
<option value="1">母亲的名字</option>
<option value="2">爷爷的名字</option>
<option value="3">父亲出生的城市</option>
<option value="4">您其中一位老师的名字</option>
<option value="5">您个人计算机的型号</option>
<option value="6">您最喜欢的餐馆名称</option>
<option value="7">驾驶执照最后四位数字</option>
</select>
</div>
</li>
<li class="answerli" style="display:none;"><input type="text" name="answer" id="answer_<?php echo $loginhash;?>" class="px" placeholder="答案"></li>
</ul>
<?php if($seccodecheck || $secqaacheck) { $sechash = 'S'.random(4);
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
<?php } } } ?>
</div>
<div class="btn_login"><button value="true" name="submit" type="submit" class="formdialog pn">登录</button></div>
</form>
<?php if($_G['setting']['connect']['allow'] && !$_G['setting']['bbclosed']) { ?>
<div class="btn_qqlogin"><a href="<?php echo $_G['connect']['login_url'];?>&statfrom=login_simple" class="pn">!connect_mobile_login!</a></div>
<?php } if($_G['setting']['regstatus']) { ?>
<div class="reg_link"><a href="member.php?mod=logging&amp;action=login&amp;lostpasswd=yes&amp;viewlostpw=1" class="y">找回密码</a><a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" class="reg_now">还没有注册？</a></div>
<?php } } else { ?>
<form id="lostpwform" method="post" action="member.php?mod=lostpasswd&amp;lostpwsubmit=yes&amp;infloat=yes&amp;mobile=2" autocomplete="off">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="handlekey" value="lostpwform" />
<div class="login_from">
<ul>
<li><input type="text" class="px" value="" name="email" placeholder="Email" fwin="login"></li>
<li><input type="text" class="px" value="" name="username" placeholder="请输入用户名" autocomplete="off" fwin="login"></li>
</ul>
</div>
<div class="btn_login"><button value="true" name="lostpwsubmit" type="submit" class="formdialog pn">提交</button></div>
</form>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['logging_bottom_mobile'])) echo $_G['setting']['pluginhooks']['logging_bottom_mobile'];?>
</div>
<?php if($_G['setting']['pwdsafety']) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>md5.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script>
<?php } updatesession();?><script type="text/javascript">
(function() {
document.addEventListener("change", function(event) {
if (!event.target.matches(".sel_list")) return;
var obj = event.target;
var span_question = qSel(".span_question");
span_question.textContent = obj.options[obj.selectedIndex].text;
var answerli = qSel(".answerli");
var questionli = qSel(".questionli");
if (obj.value == 0) {
answerli.style.display = "none";
questionli.classList.add("bl_none");
} else {
answerli.style.display = "block";
questionli.classList.remove("bl_none");
}
});
})();
</script><?php include template('common/footer'); ?>