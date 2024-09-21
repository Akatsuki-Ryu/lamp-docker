<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('showmessage');?>
<?php if($param['login']) { if($_G['inajax']) { dheader('Location:member.php?mod=logging&action=login&inajax=1&infloat=1');exit;?><?php } else { dheader('Location:member.php?mod=logging&action=login');exit;?><?php } } include template('common/header'); if($_G['inajax']) { ?>
<div class="tip">
<dt id="messagetext">
<p><?php echo $show_message;?></p>
        <?php if($_G['forcemobilemessage']) { ?>
        <p>
<a href="<?php echo $_G['setting']['mobile']['pageurl'];?>" class="mtn">继续访问</a><br />
<a href="javascript:history.back();">返回上一页</a>
</p>
        <?php } if($url_forward && !$_GET['loc']) { ?>
<script type="text/javascript">
setTimeout(function() {
window.location.href = '<?php echo $url_forward;?>';
}, '3000');
</script>
<?php } elseif($allowreturn) { ?>
<dd><input type="button" class="close pn" onclick="popup.close();" value="关闭"></dd>
<?php } ?>
</dt>
</div>
<?php } else { ?>
<div class="header cl">
<div class="mz"><a href="javascript:history.back();"><i class="dm-c-left"></i></a></div>
<h2>提示信息</h2>
<div class="my"><a href="index.php"><i class="dm-house"></i></a></div>
</div>
<div class="jump_c">
<p><?php echo $show_message;?></p>
<?php if($_G['forcemobilemessage']) { ?>
<p class="mt10">
<a href="<?php echo $_G['setting']['mobile']['pageurl'];?>">继续访问</a><br />
<a href="javascript:history.back();">返回上一页</a>
</p>
<?php } if($url_forward) { ?>
<p><a href="<?php echo $url_forward;?>" class="grey">点击此链接进行跳转</a></p>
<?php } elseif($allowreturn) { ?>
<p><a href="javascript:history.back();" class="grey">[ 点击这里返回上一页 ]</a></p>
<?php } ?>
</div>
<?php } include template('common/footer'); ?>