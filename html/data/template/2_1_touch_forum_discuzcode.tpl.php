<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); function tpl_hide_credits_hidden($creditsrequire) {
global $_G;?><?php
$return = <<<EOF
<div class="locked">
EOF;
 if($_G['uid']) { 
$return .= <<<EOF
{$_G['username']}
EOF;
 } else { 
$return .= <<<EOF
游客
EOF;
 } 
$return .= <<<EOF
，本帖隐藏的内容需要积分高于 {$creditsrequire} 才可浏览，您当前积分为 {$_G['member']['credits']}</div>
EOF;
?><?php return $return;?><?php }

function tpl_hide_credits($creditsrequire, $message) {?><?php
$return = <<<EOF
<div class="locked">以下内容需要积分高于 {$creditsrequire} 才可浏览</div>
{$message}<br /><br />

EOF;
?><?php return $return;?><?php }

function tpl_codedisp($code) {
$randomid = 'code_'.random(3);?><?php
$return = <<<EOF
<div class="blockcode"><div id="{$randomid}"><ol><li>{$code}</ol></div><em onclick="copycode(getID('{$randomid}'));">复制代码</em></div>
EOF;
?><?php return $return;?><?php }

function tpl_quote() {?><?php
$return = <<<EOF
<div class="quote"><blockquote>\\1</blockquote></div>
EOF;
?><?php return $return;?><?php }

function tpl_free() {?><?php
$return = <<<EOF
<div class="quote"><blockquote>\\1</blockquote></div>
EOF;
?><?php return $return;?><?php }

function tpl_hide_reply() {
global $_G;?><?php
$return = <<<EOF
<div class="showhide"><h4>本帖隐藏的内容</h4>\\1</div>

EOF;
?><?php return $return;?><?php }

function tpl_hide_reply_hidden() {
global $_G;?><?php
$return = <<<EOF
<div class="locked">
EOF;
 if($_G['uid']) { 
$return .= <<<EOF
{$_G['username']}
EOF;
 } else { 
$return .= <<<EOF
游客
EOF;
 } 
$return .= <<<EOF
，如果您要查看本帖隐藏内容请<a href="forum.php?mod=post&amp;action=reply&amp;fid={$_G['fid']}&amp;tid={$_G['tid']}" onclick="showWindow('reply', this.href)">回复</a></div>
EOF;
?><?php return $return;?><?php }

function attachlist($attach) {
global $_G;
$attach['refcheck'] = (!$attach['remote'] && $_G['setting']['attachrefcheck']) || ($attach['remote'] && ($_G['setting']['ftp']['hideurl'] || ($attach['isimage'] && $_G['setting']['attachimgpost'] && strtolower(substr($_G['setting']['ftp']['attachurl'], 0, 3)) == 'ftp')));
$aidencode = packaids($attach);
$is_archive = $_G['forum_thread']['is_archived'] ? "&fid=".$_G['fid']."&archiveid=".$_G['forum_thread']['archiveid'] : '';
$pluginhook = !empty($_G['setting']['pluginhooks']['viewthread_attach_extra'][$attach['aid']]) ? $_G['setting']['pluginhooks']['viewthread_attach_extra'][$attach['aid']] : '';?><?php
$return = <<<EOF

<li class="b_t p5">

EOF;
 if(!$attach['price'] || $attach['payed']) { 
$return .= <<<EOF
<a href="forum.php?mod=attachment{$is_archive}&amp;aid={$aidencode}" id="aid{$attach['aid']}" target="_blank">
EOF;
 } else { 
$return .= <<<EOF
<a href="forum.php?mod=misc&amp;action=attachpay&amp;aid={$attach['aid']}&amp;tid={$attach['tid']}" class="dialog">
EOF;
 } 
$return .= <<<EOF

<div class="tit">

EOF;
 if($_G['setting']['mobile']['mobilesimpletype'] == 0) { 
$return .= <<<EOF
{$attach['attachicon']}
EOF;
 } 
$return .= <<<EOF

<span class="link f_b">{$attach['filename']}</span>
<p class="pl5 f_9">{$attach['dateline']} 上传</p>
<p class="pl5 f_9">{$attach['attachsize']}
EOF;
 if($attach['readperm']) { 
$return .= <<<EOF
, 阅读权限: <strong>{$attach['readperm']}</strong>
EOF;
 } if(!$_G['setting']['hideattachdown']) { 
$return .= <<<EOF
, 下载次数: {$attach['downloads']}
EOF;
 } if(!$attach['attachimg'] && $_G['getattachcredits']) { 
$return .= <<<EOF
, 下载积分: {$_G['getattachcredits']}
EOF;
 } 
$return .= <<<EOF
</p>

EOF;
 if($attach['price']) { 
$return .= <<<EOF

<p class="pl5 f_9">
售价: <strong class="xi1">{$attach['price']} {$_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]]['unit']}{$_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]]['title']}</strong> &nbsp;[<a href="forum.php?mod=misc&amp;action=viewattachpayments&amp;aid={$attach['aid']}" class="dialog">记录</a>]

EOF;
 if(!$attach['payed']) { 
$return .= <<<EOF

&nbsp;[<a href="forum.php?mod=misc&amp;action=attachpay&amp;aid={$attach['aid']}&amp;tid={$attach['tid']}" class="dialog">购买</a>]

EOF;
 } 
$return .= <<<EOF

</p>

EOF;
 } 
$return .= <<<EOF

</div>
</a>
<div>
EOF;
 if($attach['description']) { 
$return .= <<<EOF
<p class="f_9">{$attach['description']}</p>
EOF;
 } 
$return .= <<<EOF
</div>
{$pluginhook}
</li>

EOF;
?><?php return $return;?><?php }

function imagelist($attach, $firstpost = 0) {
global $_G, $post;
$fix = count($post['imagelist']) == 1 ? 1000 : 1500;
$fixtype = count($post['imagelist']) == 1 ? 'fixnone' : 'fixwr';
$attach['refcheck'] = (!$attach['remote'] && $_G['setting']['attachrefcheck']) || ($attach['remote'] && ($_G['setting']['ftp']['hideurl'] || ($attach['isimage'] && $_G['setting']['attachimgpost'] && strtolower(substr($_G['setting']['ftp']['attachurl'], 0, 3)) == 'ftp')));
$mobilethumburl = $attach['attachimg'] && $_G['setting']['showimages'] && (!$attach['price'] || $attach['payed']) && ($_G['group']['allowgetimage'] || $_G['uid'] == $attach['uid']) ? getforumimg($attach['aid'], 0, $fix, 99999, 1) : '' ;
$aidencode = packaids($attach);
$is_archive = $_G['forum_thread']['is_archived'] ? "&fid=".$_G['fid']."&archiveid=".$_G['forum_thread']['archiveid'] : '';
$pluginhook = !empty($_G['setting']['pluginhooks']['viewthread_attach_extra'][$attach['aid']]) ? $_G['setting']['pluginhooks']['viewthread_attach_extra'][$attach['aid']] : '';
$guestviewthumb = !empty($_G['setting']['guestviewthumb']['flag']) && !$_G['uid'];
$mobileguestviewthumburl = $guestviewthumb ? ($attach['attachimg'] && $_G['setting']['showimages'] && (((!$attach['price'] || $attach['payed']) && ($_G['group']['allowgetimage'] || $_G['uid'] == $attach['uid'])) || ($guestviewthumb)) ? getforumimg($attach['aid'], 0, $_G['setting']['guestviewthumb']['width'], $_G['setting']['guestviewthumb']['height'], 1) : '') : '';?><?php
$return = <<<EOF


EOF;
 if($attach['attachimg'] && $_G['setting']['showimages'] && (((!$attach['price'] || $attach['payed']) && ($_G['group']['allowgetimage'] || $_G['uid'] == $attach['uid'])) || ($guestviewthumb))) { if($_G['setting']['mobile']['mobilesimpletype'] == 0) { 
$return .= <<<EOF

<li><a href="forum.php?mod=viewthread&amp;tid={$attach['tid']}&amp;aid={$attach['aid']}&amp;from=album&amp;page={$_G['page']}" class="orange"><img id="aimg_{$attach['aid']}" src="
EOF;
 if($guestviewthumb) { 
$return .= <<<EOF
{$mobileguestviewthumburl}
EOF;
 } elseif($attach['refcheck']) { 
$return .= <<<EOF
forum.php?mod=attachment{$is_archive}&aid={$aidencode}&noupdate=yes&nothumb=yes
EOF;
 } else { 
$return .= <<<EOF
{$attach['url']}{$attach['attachment']}
EOF;
 } 
$return .= <<<EOF
" alt="{$attach['imgalt']}" /></a>
{$pluginhook}
</li>

EOF;
 } } 
$return .= <<<EOF


EOF;
?><?php return $return;?><?php }

function attachinpost($attach, $post) {
global $_G;
$attach['refcheck'] = (!$attach['remote'] && $_G['setting']['attachrefcheck']) || ($attach['remote'] && ($_G['setting']['ftp']['hideurl'] || ($attach['isimage'] && $_G['setting']['attachimgpost'] && strtolower(substr($_G['setting']['ftp']['attachurl'], 0, 3)) == 'ftp')));
$mobilethumburl = $attach['attachimg'] && $_G['setting']['showimages'] && (!$attach['price'] || $attach['payed']) && ($_G['group']['allowgetimage'] || $_G['uid'] == $attach['uid']) ? getforumimg($attach['aid'], 0, 200, 200, 'fixnone') : '' ;
$aidencode = packaids($attach);
$is_archive = $_G['forum_thread']['is_archived'] ? '&fid='.$_G['fid'].'&archiveid='.$_G['forum_thread']['archiveid'] : '';
$guestviewthumb = !empty($_G['setting']['guestviewthumb']['flag']) && !$_G['uid'];
$mobileguestviewthumburl = $guestviewthumb ? ($attach['attachimg'] && $_G['setting']['showimages'] && (((!$attach['price'] || $attach['payed']) && ($_G['group']['allowgetimage'] || $_G['uid'] == $attach['uid'])) || ($guestviewthumb)) ? getforumimg($attach['aid'], 0, $_G['setting']['guestviewthumb']['width'], $_G['setting']['guestviewthumb']['height'], 1) : '') : '';?><?php
$return = <<<EOF


EOF;
 if($attach['attachimg'] && $_G['setting']['showimages'] && (((!$attach['price'] || $attach['payed']) && ($_G['group']['allowgetimage'] || $_G['uid'] == $attach['uid'])) || ($guestviewthumb))) { if($_G['setting']['mobile']['mobilesimpletype'] == 0) { 
$return .= <<<EOF

<a href="forum.php?mod=viewthread&amp;tid={$attach['tid']}&amp;aid={$attach['aid']}&amp;from=album&amp;page={$_G['page']}" class="orange"><img id="aimg_{$attach['aid']}" src="
EOF;
 if($guestviewthumb) { 
$return .= <<<EOF
{$mobileguestviewthumburl}
EOF;
 } elseif($attach['refcheck']) { 
$return .= <<<EOF
forum.php?mod=attachment{$is_archive}&aid={$aidencode}&noupdate=yes&nothumb=yes
EOF;
 } else { 
$return .= <<<EOF
{$attach['url']}{$attach['attachment']}
EOF;
 } 
$return .= <<<EOF
" alt="{$attach['imgalt']}" /></a>

EOF;
 } } else { 
$return .= <<<EOF

<ul id="attach_{$attach['aid']}" class="quote post_attlist cl" >
<li class="p5">

EOF;
 if(!$attach['price'] || $attach['payed']) { 
$return .= <<<EOF

<a href="forum.php?mod=attachment{$is_archive}&amp;aid={$aidencode}" target="_blank">

EOF;
 } else { 
$return .= <<<EOF

<a href="forum.php?mod=misc&amp;action=attachpay&amp;aid={$attach['aid']}&amp;tid={$attach['tid']}" class="dialog">

EOF;
 } 
$return .= <<<EOF

<div class="tit">

EOF;
 if($_G['setting']['mobile']['mobilesimpletype'] == 0) { 
$return .= <<<EOF
<span class="z mr5 cl">{$attach['attachicon']}</span>
EOF;
 } 
$return .= <<<EOF

<span class="link f_b">{$attach['filename']}</span>
<p class="pl5 f_9">{$attach['dateline']} 上传</p>
<p class="pl5 f_9">{$attach['attachsize']}
EOF;
 if(!$_G['setting']['hideattachdown']) { 
$return .= <<<EOF
, 下载次数: {$attach['downloads']}
EOF;
 } if(!$attach['attachimg'] && $_G['getattachcredits']) { 
$return .= <<<EOF
, 下载积分: {$_G['getattachcredits']}
EOF;
 } 
$return .= <<<EOF
</p>

EOF;
 if($attach['readperm']) { 
$return .= <<<EOF
<p class="pl5 f_9">阅读权限: <strong>{$attach['readperm']}</strong></p>
EOF;
 } if($attach['price']) { 
$return .= <<<EOF

<p class="pl5 f_9 xg1">
售价: <strong class="xi1">{$attach['price']} {$_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]]['unit']}{$_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]]['title']}</strong> &nbsp;[<a href="forum.php?mod=misc&amp;action=viewattachpayments&amp;aid={$attach['aid']}" class="dialog">记录</a>]

EOF;
 if(!$attach['payed']) { 
$return .= <<<EOF

&nbsp;[<a href="forum.php?mod=misc&amp;action=attachpay&amp;aid={$attach['aid']}&amp;tid={$attach['tid']}" class="dialog">购买</a>]

EOF;
 } 
$return .= <<<EOF

</p>

EOF;
 } 
$return .= <<<EOF

</div>
</a>
<div>
EOF;
 if($attach['description']) { 
$return .= <<<EOF
<p class="f_9 xg1">{$attach['description']}</p>
EOF;
 } 
$return .= <<<EOF
</div>
</li>
</ul>

EOF;
 } 
$return .= <<<EOF


EOF;
?><?php return $return;?><?php }?>