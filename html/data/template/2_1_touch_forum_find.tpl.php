<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div class="header cl">
<div class="mz"><a href="javascript:history.back();"><i class="dm-c-left"></i></a></div>
<h2>发现</h2>
<div class="my"></div>
</div>
<div class="findbox cl">
<ul><?php if(isset($_G['setting']['mfindnavs']) && is_array($_G['setting']['mfindnavs'])) foreach($_G['setting']['mfindnavs'] as $nav) { if(is_array($nav) && $nav['available'] && ($nav['type'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1)) || !$nav['type'])) { ?>
<li><a href="<?php echo $nav['url'];?>"><i class="dm-c-right"></i><?php echo $nav['name'];?></a></li>
<?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['index_find_extra_mobile'])) echo $_G['setting']['pluginhooks']['index_find_extra_mobile'];?>
</ul>
</div>