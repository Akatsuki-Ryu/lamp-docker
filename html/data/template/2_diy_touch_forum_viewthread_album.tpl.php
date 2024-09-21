<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('viewthread_album');?><?php include template('common/header'); ?><style type="text/css">
.postalbum { background-color:#343434; display:none; height:100%; overflow:hidden; padding:0 0 1px 0; position:absolute; top:0; width:100%; z-index:80; }
.postalbum_h { height:50px; left:0; line-height:50px; position:absolute; top:0px; width:100%; z-index:90; opacity:0.7; background:black; }
.postalbum_h a:link, a:visited, a:hover { color:white; }
.postalbum_h_back { position:absolute; left:13px; top:0px; height:25px; width:60px; font-size:14px; z-index:90; color:white; }
.postalbum_h_back i { margin-right:3px; }
.postalbum_h_picnum { position:absolute; right:10px; top:0px; height:25px; width:105px; z-index:90; color:white; }
.postalbum_c { height:100%; position:relative; z-index:-1; display:-webkit-box; display:-moz-box; display:-o-box; display:box; -webkit-transition:all 350ms linear; -moz-transition:all 350ms linear; -o-transition:all 350ms linear; transition:all 350ms linear; }
.postalbum_u { border-radius:3px 3px 3px 3px; text-align:center; }
.postalbum_i { margin-bottom:-3px; max-width:100%; vertical-align:middle; visibility:hidden; }
</style><?php $curaidkey = 0;?><?php $count = count($imglist['aid']);?><?php if($_GET['aid']) { if(isset($imglist['aid']) && is_array($imglist['aid'])) foreach($imglist['aid'] as $k => $aid) { if($_GET['aid'] == $aid) { $curaidkey = $k;break;?><?php } } } ?>
<div class="postalbum">
<div class="postalbum_h">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;page=<?php echo $_G['page'];?>" class="postalbum_h_back"><i class="dm-c-left z"></i>返回</a>
<span class="postalbum_h_picnum">第 <span id="curpic"><?php echo $curaidkey + 1?></span> 张 / 共 <?php echo $count;?> 张</span>
</div>
<ul class="postalbum_c"><?php if(isset($imglist['url']) && is_array($imglist['url'])) foreach($imglist['url'] as $key => $imgurl) { ?><li class="postalbum_u" id="u_<?php echo $key;?>">
<img class="postalbum_i" load="0" id="img_<?php echo $key;?>" <?php if($curaidkey == $key) { ?>src="<?php echo $imgurl;?>"<?php } ?> zsrc="<?php echo $imgurl;?>" orig="<?php echo $imglist['url'][$key];?>"/>
</li>
<?php } ?>
</ul>
</div>

<script type="text/javascript">
(function() {
var support3d = ("WebKitCSSMatrix" in window && "m11" in new WebKitCSSMatrix());
var curkey = <?php echo $curaidkey;?>;
var count = <?php echo $count;?>;
var imglist = new Array();
imglist['url'] = [<?php echo dimplode($imglist['url']);; ?>];

var width = window.innerWidth;
var height = document.documentElement.clientHeight;
$('.postalbum').css({'display':'block', 'height':height + 'px'});
$('.postalbum_u').css({'height':height + 'px', 'width':width + 'px'});
$('.postalbum_i').css({'max-height':'100%', 'visibility':'visible'});
if(support3d) {
$('.postalbum_c').css({'line-height':height + 'px', 'width':width * count + 'px'});
slidmoving('-' + curkey * width);
} else {
$('.postalbum_c').css({'display':'block', 'height':height * count + 'px'});
$('.postalbum_c').css({'top': '-' + curkey * height + 'px'});
}

var position = {};
var status = true;
var posalbum_touch_interval = 0;
var postalbum_timeoutid = null;
touchaction = function(postalbum, postalbum_u, fun) {
postalbum.on('touchstart', postalbum_u, function(e) {
e = mygetnativeevent(e);
position.x1 = e.touches[0].pageX;
position.y1 = e.touches[0].pageY;
position.hori = true;
status = true;
}).on('touchmove', postalbum_u, function(e) {
status = false;
e = mygetnativeevent(e);
position.x2 = e.touches[0].pageX;
position.y2 = e.touches[0].pageY;
position.distx = position.x2 - position.x1;
position.disty = position.y2 - position.y2;
if(Math.abs(position.distx) < 2 * Math.abs(position.disty)) {
position.hori = false;
} else {
e.preventDefault();
}
}).on('touchend', postalbum_u, function(e) {
e = mygetnativeevent(e);
if(position.x2 && Math.abs(position.distx) > 30 && position.hori && !status) {
var swipedire = position.distx > 0 ? 'right' : 'left';
fun.call(this, swipedire, e);
} else if(status) {
postalbum_touch_interval = new Date().getTime();
if(!postalbum_timeoutid) {
postalbum_timeoutid = setTimeout(function() {
var interval = new Date().getTime() - postalbum_touch_interval;
if(interval >= 250) {
fun.call(this, 'tap', e);
}
postalbum_touch_interval = 0;
postalbum_timeoutid = null;
}, 250);
}
}
});
};

var curkeyimg = $('#img_' + curkey);
curkeyimg.css({'-webkit-transition':'all 200ms', '-moz-transition':'all 200ms', '-o-transition':'all 200ms', 'transition':'all 200ms'});
imgchange(curkeyimg, 1, 0, 0);
setTimeout(function() {
fiximgmove(curkeyimg);
}, 350);

var imgscale = 1;
var oldscalex = 0;
var oldscaley = 0;
var newscalex = 0;
var newscaley = 0;
var imgmovestatus = false;
var touch_interval = 0;
var timeoutid = null;
var imgtouchpos = {};
$('.postalbum_u').on('touchstart', '.postalbum_i', function(e) {
if(!imgmovestatus) {
return;
}
e = mygetnativeevent(e);
imgtouchpos.x1 = e.touches[0].pageX;
imgtouchpos.y1 = e.touches[0].pageY;
}).on('touchmove', '.postalbum_i', function(e) {
if(!imgmovestatus) {
return;
}
e = mygetnativeevent(e);
imgtouchpos.x2 = e.touches[0].pageX;
imgtouchpos.y2 = e.touches[0].pageY;
imgtouchpos.distx = imgtouchpos.x2 - imgtouchpos.x1;
imgtouchpos.disty = imgtouchpos.y2 - imgtouchpos.y1;

newscalex = imgtouchpos.distx / imgscale + oldscalex;
newscaley = imgtouchpos.disty / imgscale + oldscaley;

imgchange($('#img_' + curkey), imgscale, newscalex, newscaley);

}).on('touchend', '.postalbum_i', function(e) {

touch_interval = new Date().getTime();
if(!timeoutid) {
timeoutid = setTimeout(function() {
var interval = new Date().getTime() - touch_interval;
var obj = $('#img_' + curkey);
if(interval < 250) {
imgscale = imgscale == 1 ? 2 : 1;
imgmovestatus = (imgscale == 1) ? false : true;
if(imgmovestatus) {
obj.attr('src', obj.attr('orig'));
}
imgchange(obj, imgscale, newscalex, newscaley);
setTimeout(function() {
fiximgmove(obj);
}, 250);
} else {
if(imgmovestatus) {
oldscalex = newscalex;
oldscaley = newscaley;
fiximgmove(obj);
}
}
touch_interval = 0;
timeoutid = null;
}, 250);
}
});

function imgchange(img, scale, x, y) {
if(!img[0]) {
return;
}
scale = scale || 1;
x = x || 0;
y = y || 0;

img.css('-webkit-transform', 'scale(' + scale + ')');
img.css('-moz-transform', 'scale(' + scale + ')');
img.css('-o-transform', 'scale(' + scale + ')');
img.css('transform', 'scale(' + scale + ')');

var pimg = img.parent();
var translatetxt = (support3d ? "translate3d": "translate") + "(" + x * scale + "px, " + y * scale + "px" + (support3d ? ", 0px)": ")");
pimg.css('-webkit-transform', translatetxt);
pimg.css('-moz-transform', translatetxt);
pimg.css('-o-transform', translatetxt);
pimg.css('transform', translatetxt);
}

function fiximgmove(imgobj) {
var offset = imgobj.offset();
var movex = imgobj.width() * imgscale - width;
var movey = imgobj.height() * imgscale - height;
if(movey > 0) {
var yoffset = offset.top - $('.postalbum').offset().top;
if(yoffset > 0) {
oldscaley = oldscaley - yoffset / imgscale;
} else {
if(yoffset + imgobj.height() * imgscale - height < 0) {
oldscaley = oldscaley - (yoffset + imgobj.height() * imgscale - height) / imgscale;
}
}
} else {
oldscaley = 0;
}

if(movex > 0) {
if(offset.left > 0) {
oldscalex = oldscalex - offset.left / imgscale;
} else {
if(offset.left + imgobj.width() * imgscale - width < 0) {
oldscalex = oldscalex - (offset.left + imgobj.width() * imgscale - width) / imgscale;
}
}
} else {
oldscalex = 0;
}

if(imgscale < 1) {
imgscale = 1;
}
newscalex = oldscalex;
newscaley = oldscaley;
imgchange(imgobj, imgscale, oldscalex, oldscaley);
}

var headerstatus = true;
touchaction($('.postalbum'), '.postalbum_u', function(swipedire, touchevent) {
if(imgmovestatus) {
return;
}
switch(swipedire) {
case 'left':
if(curkey >= count - 1) {
popup.open('最后一张', 'alert');
} else {
for(var i=0; i<3; i++) {
if(!$('#img_' + (curkey + i)).attr('src')) {
$('#img_' + (curkey + i)).attr('src', $('#img_'+(curkey + i)).attr('zsrc'));
}
}
curkey++;
if(support3d) {
slidmoving('-' + curkey * width);
} else {
$('.postalbum_c').css({'top': '-' + curkey * height + 'px'});
}
$('#curpic').text(curkey + 1);
}
break;
case 'right':
if(curkey <= 0) {
popup.open('第一张', 'alert');
} else {
for(var i=-3; i<0; i++) {
if(!$('#img_' + (curkey + i)).attr('src')) {
$('#img_' + (curkey + i)).attr('src', $('#img_'+(curkey + i)).attr('zsrc'));
}
}
curkey--;
if(support3d) {
slidmoving('-' + curkey * width);
} else {
$('.postalbum_c').css({'top': '-' + curkey * height + 'px'});
}
$('#curpic').text(curkey + 1);
}
break;
case 'tap':
var obj = $('.postalbum_h');
var top = headerstatus ? 0 : 44;
adjust = function() {
setTimeout(function() {
if(top == 0 && headerstatus == false) {
headerstatus = true;
} else if(top == 44 && headerstatus == true) {
headerstatus = false;
} else if(headerstatus == false) {
top--;
obj.css('top', '-' + top + 'px');
adjust();
} else {
top++;
obj.css('top', '-' + top + 'px');
adjust();
}
}, 10);
}
adjust();
break;
}
});

function slidmoving(distx) {
$('.postalbum_c').css('-webkit-transform', 'translate3d('+ distx + 'px, 0, 0)');
$('.postalbum_c').css('-moz-transform', 'translate3d('+ distx + 'px, 0, 0)');
$('.postalbum_c').css('-o-transform', 'translate3d('+ distx + 'px, 0, 0)');
$('.postalbum_c').css('transform', 'translate3d('+ distx + 'px, 0, 0)');
return true;
}

})();
</script><?php $nofooter = true;?><?php include template('common/footer'); ?>