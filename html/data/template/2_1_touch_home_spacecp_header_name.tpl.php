<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if(!empty($actives['profile'])) { ?>
个人资料
<?php } elseif(!empty($actives['verify'])) { ?>
认证
<?php } elseif(!empty($actives['avatar'])) { ?>
修改头像
<?php } elseif(!empty($actives['credit'])) { if($op == 'log') { ?>
积分记录
<?php } elseif($op == 'buy') { ?>
积分充值
<?php } else { ?>
积分
<?php } } elseif(!empty($actives['payment'])) { ?>
我的订单
<?php } elseif(!empty($actives['usergroup'])) { ?>
用户组
<?php } elseif(!empty($actives['privacy'])) { ?>
隐私筛选
<?php } elseif(!empty($actives['sendmail'])) { ?>
邮件提醒
<?php } elseif(!empty($actives['password'])) { ?>
密码安全
<?php } elseif(!empty($actives['promotion'])) { ?>
访问推广
<?php } elseif(!empty($actives['plugin'])) { ?>
<?php echo $_G['setting']['plugins'][$pluginkey][$_GET['id']]['name'];?>
<?php } ?>