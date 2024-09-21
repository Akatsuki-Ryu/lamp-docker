<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if($sortid) { ?>
<input type="hidden" name="sortid" value="<?php echo $sortid;?>" />
<?php } if(!$isfirstpost && $thread['special'] == 5 && empty($firststand) && $_GET['action'] != 'edit') { ?>
<ul class="cl">
<li class="mli">
<select name="stand" id="stand" class="sort_sel pl5">
<option value="">选择观点</option>
<option value="0">中立</option>
<option value="1"<?php if($stand == 1) { ?> selected="selected"<?php } ?>>正方</option>
<option value="2"<?php if($stand == 2) { ?> selected="selected"<?php } ?>>反方</option>
</select>
</li>
</ul>
<?php } if($showthreadsorts) { ?>
<div class="exfm cl"><?php include template('forum/post_sortoption'); ?></div>
<?php } elseif($adveditor) { if($special == 1) { include template('forum/post_poll'); } elseif($special == 2 && ($_GET['action'] != 'edit' || ($_GET['action'] == 'edit' && ($thread['authorid'] == $_G['uid'] && $_G['group']['allowposttrade'] || $_G['group']['allowedittrade'])))) { include template('forum/post_trade'); } elseif($special == 3) { include template('forum/post_reward'); } elseif($special == 4) { include template('forum/post_activity'); } elseif($special == 5) { include template('forum/post_debate'); } elseif($specialextra) { ?><div class="specialpost s_clear"><?php echo $threadplughtml;?></div>
<?php } } ?>