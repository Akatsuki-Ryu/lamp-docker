<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('post_forumselect');?><?php include template('common/header'); ?><div class="header cl">
<div class="mz"><a href="javascript:history.back();"><i class="dm-c-left"></i></a></div>
<h2>发新帖</h2>
<div class="my"><a href="search.php?mod=forum"><i class="dm-search"></i></a></div>
</div>
<div style="display:none">
<ul id="fs_group"><?php echo $grouplist;?></ul>
<ul id="fs_forum_common"><?php echo $commonlist;?></ul><?php if(isset($forumlist) && is_array($forumlist)) foreach($forumlist as $forumid => $forum) { ?><ul id="fs_forum_<?php echo $forumid;?>"><?php echo $forum;?></ul>
<?php } if(isset($subforumlist) && is_array($subforumlist)) foreach($subforumlist as $forumid => $forum) { ?><ul id="fs_subforum_<?php echo $forumid;?>"><?php echo $forum;?></ul>
<?php } ?>
</div>
<div class="pblbox cl">
<ul class="pbl cl">
<li id="block_group"></li>
<li id="block_forum"></li>
<li id="block_subforum"></li>
</ul>
</div>
<?php if($_G['group']['allowpost'] || !$_G['uid']) { ?>
<div class="post_btn cl">
<button id="postbtn" class="pn" onclick="window.location.href='forum.php?mod=post&action=newthread&fid=' + selectfid" disabled="disabled">发新帖</button>
</div>
<?php } ?>
<script type="text/javascript" reload="1">
var s = '<?php if($commonfids) { ?><p><a id="commonforum" href="javascript:;" onclick="switchforums(this, 1, \'common\')" class="pbsb lightlink">常用版块</a></p><?php } ?>';
var lis = document.getElementById('fs_group').getElementsByTagName('LI');
for(i = 0;i < lis.length;i++) {
var gid = lis[i].getAttribute('fid');
if(document.getElementById('fs_forum_' + gid)) {
s += '<p><a href="javascript:;" ondblclick="locationforums(1, ' + gid + ')" onclick="switchforums(this, 1, ' + gid + ')" class="pbsb">' + lis[i].innerHTML + '</a></p>';
}

}
document.getElementById('block_group').innerHTML = s;
var lastswitchobj = null;
var selectfid = 0;
var switchforum = switchsubforum = '';

switchforums(document.getElementById('commonforum'), 1, 'common');

function switchforums(obj, block, fid) {
if(lastswitchobj != obj) {
if(lastswitchobj) {
lastswitchobj.parentNode.className = '';
}
obj.parentNode.className = 'pbls';
}
var s = '';
if(block == 1) {
var lis = document.getElementById('fs_forum_' + fid).getElementsByTagName('LI');
for(i = 0;i < lis.length;i++) {
fid = lis[i].getAttribute('fid');
if(fid != '') {
s += '<p><a href="javascript:;" ondblclick="locationforums(2, ' + fid + '\)" onclick="switchforums(this, 2, ' + fid + ')"' + (document.getElementById('fs_subforum_' + fid) ?  ' class="pbsb"' : '') + '>' + lis[i].innerHTML + '</a></p>';
}
}
document.getElementById('block_forum').innerHTML = s;
document.getElementById('block_subforum').innerHTML = '';
switchforum = switchsubforum = '';
selectfid = 0;
document.getElementById('postbtn').setAttribute("disabled", "disabled");
document.getElementById('postbtn').className = 'pn xg1 y';
} else if(block == 2) {
selectfid = fid;
if(document.getElementById('fs_subforum_' + fid)) {
var lis = document.getElementById('fs_subforum_' + fid).getElementsByTagName('LI');
for(i = 0;i < lis.length;i++) {
fid = lis[i].getAttribute('fid');
s += '<p><a href="javascript:;" ondblclick="locationforums(3, ' + fid + ')" onclick="switchforums(this, 3, ' + fid + ')">' + lis[i].innerHTML + '</a></p>';
}
document.getElementById('block_subforum').innerHTML = s;
} else {
document.getElementById('block_subforum').innerHTML = '';
}
switchforum = obj.innerHTML;
switchsubforum = '';
document.getElementById('postbtn').removeAttribute("disabled");
document.getElementById('postbtn').className = 'pn pnc y';
} else {
selectfid = fid;
switchsubforum = obj.innerHTML;
document.getElementById('postbtn').removeAttribute("disabled");
document.getElementById('postbtn').className = 'pn pnc y';
}
lastswitchobj = obj;
}

function locationforums(block, fid) {
location.href = block == 1 ? 'forum.php?gid=' + fid : 'forum.php?mod=forumdisplay&fid=' + fid;
}

</script><?php include template('common/footer'); ?>