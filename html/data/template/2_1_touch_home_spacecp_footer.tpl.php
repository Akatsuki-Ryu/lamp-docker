<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<li class="swiper-slide<?php if($actives['avatar'] or '') { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=avatar">修改头像</a></li>
<li class="swiper-slide<?php if($actives['profile'] or '') { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=profile">个人资料</a></li>
<?php if($_G['setting']['verify']['enabled'] && allowverify()) { ?>
<li class="swiper-slide<?php if($actives['verify']) { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=verify">认证</a></li>
<?php } ?>
<li class="swiper-slide<?php if($actives['credit'] or '') { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=credit">积分</a></li>
<?php if($_G['setting']['ec_ratio']) { ?>
<li class="swiper-slide<?php if($actives['payment'] or '') { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=payment">订单</a></li>
<?php } ?>
<li class="swiper-slide<?php if($actives['usergroup'] or '') { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=usergroup">用户组</a></li>
<li class="swiper-slide<?php if($actives['privacy'] or '') { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=privacy">隐私筛选</a></li>
<?php if($_G['setting']['sendmailday']) { ?>
<li class="swiper-slide<?php if($actives['sendmail']) { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=sendmail">邮件提醒</a></li><?php } ?>
<li class="swiper-slide<?php if($actives['password'] or '') { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">密码安全</a></li>
<?php if($_G['setting']['creditspolicy']['promotion_visit'] || $_G['setting']['creditspolicy']['promotion_register']) { ?>
<li class="swiper-slide<?php if($actives['promotion'] or '') { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=promotion">访问推广</a></li>
<?php } if(!empty($_G['setting']['plugins']['spacecp'])) { if(isset($_G['setting']['plugins']['spacecp']) && is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(in_array($module['adminid'], array(0, -1)) || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li class="swiper-slide<?php if($_GET['id'] == $id) { ?> mon<?php } ?>"><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?>