<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_footer_mobile'])) echo $_G['setting']['pluginhooks']['global_footer_mobile'];?>
<div id="mask" style="display:none;"></div>
<?php if($_G['setting']['statcode']) { ?><div id="statcode" style="display:none;"><?php echo $_G['setting']['statcode'];?></div><?php } if(!$nofooter) { ?>
<div class="foot_height"></div>
<div class="foot flex-box">
<a href="index.php" class="flex<?php if((strpos($_SERVER['REQUEST_URI'], $_G['setting']['defaultindex']) && strpos('forum.php', $_G['setting']['defaultindex']) === false) || strpos($_SERVER['REQUEST_URI'], 'index.php') || (strpos('forum.php', $_G['setting']['defaultindex']) === 0 && $_G['basescript'] == 'forum' && $_GET['mod'] != 'find')) { ?> mon<?php } ?>">
<span class="foot-ico"><em class="ma"></em></span>
<span class="foot-txt">首页</span>
</a>
<?php if(strpos('forum.php', $_G['setting']['defaultindex']) === false) { ?>
<a href="<?php if($_G['setting']['mobile']['forum']['index'] > 1) { ?>forum.php<?php } elseif($_G['setting']['mobile']['forum']['index'] == 1) { ?>forum.php?mod=guide&view=newthread<?php } else { ?>forum.php?forumlist=1<?php } ?>" class="flex<?php if($_G['basescript'] == 'forum' && $_GET['mod'] != 'find' && (CURMODULE == 'index' || $_GET['forumlist'] == 1 || CURMODULE == 'forumdisplay' || CURMODULE == 'viewthread' || CURMODULE == 'guide')) { ?> mon<?php } ?>">
<span class="foot-ico"><em class="mb"></em></span>
<span class="foot-txt"><?php echo $_G['setting']['navs'][2]['navname'];?></span>
</a>
<?php } elseif(strpos('forum.php', $_G['setting']['defaultindex']) === 0) { if(helper_access::check_module('portal')) { ?>
<a href="portal.php" class="flex<?php if($_G['basescript'] == 'portal') { ?> mon<?php } ?>">
<span class="foot-ico"><em class="mb"></em></span>
<span class="foot-txt">资讯</span>
</a>
<?php } elseif(helper_access::check_module('group')) { ?>
<a href="group.php" class="flex<?php if($_G['basescript'] == 'group') { ?> mon<?php } ?>">
<span class="foot-ico"><em class="mb"></em></span>
<span class="foot-txt"><?php echo $_G['setting']['navs'][3]['navname'];?></span>
</a>
<?php } elseif(helper_access::check_module('feed')) { ?>
<a href="home.php" class="flex<?php if($_G['basescript'] == 'home' && CURMODULE == 'space' && $_GET['do'] == 'home') { ?> mon<?php } ?>">
<span class="foot-ico"><em class="mb"></em></span>
<span class="foot-txt">动态</span>
</a>
<?php } else { ?>
<a href="home.php?mod=space&amp;do=pm" class="flex<?php if($_G['basescript'] == 'home' && CURMODULE == 'space' && $_GET['do'] == 'pm') { ?> mon<?php } ?>">
<span class="foot-ico"><em class="mb"><?php if($_G['uid'] && ($_G['member']['newpm'] || $_G['member']['newprompt'])) { ?><i class="ico_msg"></i><?php } ?></em></span>
<span class="foot-txt">消息</span>
</a>
<?php } } ?>
<a href="forum.php?mod=misc&amp;action=nav" class="flex foot-post">
<span class="foot-ico"><em class="mc"></em></span>
<span class="foot-txt">发布</span>
</a>
<a href="forum.php?mod=find" class="flex<?php if($_G['basescript'] == 'forum' && $_GET['mod'] == 'find') { ?> mon<?php } ?>">
<span class="foot-ico"><em class="md"></em></span>
<span class="foot-txt">发现</span>
</a>
<a href="<?php if($_G['uid']) { ?>home.php?mod=space&uid=<?php echo $_G['uid'];?>&do=profile&mycenter=1<?php } else { ?>member.php?mod=logging&action=login<?php } ?>" class="flex<?php if($_G['basescript'] == 'home' && CURMODULE == 'space' && $_GET['mycenter'] == 1) { ?> mon<?php } ?>">
<span class="foot-ico"><em class="me">
<?php if(strpos('forum.php', $_G['setting']['defaultindex']) === false || helper_access::check_module('portal') || helper_access::check_module('group') || helper_access::check_module('feed')) { if($_G['uid'] && ($_G['member']['newpm'] || $_G['member']['newprompt'])) { ?><i class="ico_msg"></i><?php } } ?>
</em></span>
<span class="foot-txt">我的</span>
</a>
</div>
<?php } ?>
</body>
</html><?php updatesession();?><?php if(defined('IN_MOBILE')&&!defined('IN_PREVIEW')) { output();?><?php } else { output_preview();?><?php } ?>
