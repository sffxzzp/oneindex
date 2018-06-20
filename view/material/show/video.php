<?php view::layout('layout')?>
<?php
$item['thumb'] = onedrive::thumbnail($item['path']);
?>

<?php view::begin('content');?>
<link class="dplayer-css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dplayer/dist/DPlayer.min.css">
<script src="https://cdn.jsdelivr.net/npm/dplayer/dist/DPlayer.min.js"></script>
<script src="<?php e($root);?>view/js/subtitles-octopus.js"></script>
<script src="<?php e($root);?>view/js/qrcode.min.js"></script>
<div class="mdui-container-fluid">
	<br>
	<div id="dplayer"></div>
	<br>
	<!-- 固定标签 -->
	<div class="mdui-textfield">
	  <label class="mdui-textfield-label">下载地址</label>
	  <input class="mdui-textfield-input" type="text" value="<?php e($url);?>"/>
	</div>
	<div class="mdui-textfield">
	  <label class="mdui-textfield-label">引用地址</label>
	  <textarea class="mdui-textfield-input"><video><source src="<?php e($url);?>" type="video/mp4"></video></textarea>
	</div>
	<div class="mdui-textfield">
		<label class="mdui-textfield-label">二维码</label><br>
		<div id="qrcode"></div>
	</div>
</div>
<script>
var qrcode = new QRCode(document.getElementById("qrcode"), {
	width: "200",
	height: "200",
	colorDark: "#000000",
	colorLight: "#ffffff"
});
qrcode.makeCode("<?php e($url);?>");
const dp = new DPlayer({
	container: document.getElementById('dplayer'),
	lang:'zh-cn',
	video: {
		url: '<?php e($item['downloadUrl']);?>',
		pic: '<?php @e($item['thumb']);?>',
		type: 'auto'
	}
});
dp.on('canplay', function () {
	var video = document.getElementsByTagName('video')[0];
	window.SubtitlesOctopusOnLoad = function () {
		var options = {
			video: video,
			subUrl: '<?php $urlparts = pathinfo($url); e($urlparts['dirname'].'/'.$urlparts['filename'].'.ass');?>',
			fonts: ["//gapis.geekzu.org/g-fonts/ea/notosanssc/v1/NotoSansSC-Regular.otf", "//gapis.geekzu.org/g-fonts/ea/notosanstc/v1/NotoSansTC-Regular.otf", "//gapis.geekzu.org/g-fonts/ea/notosansjapanese/v6/NotoSansJP-Regular.otf"],
			workerUrl: '<?php e($root);?>view/js/subtitles-octopus-worker.js'
		};
		window.octopusInstance = new SubtitlesOctopus(options);
	};
	if (SubtitlesOctopus) {
		SubtitlesOctopusOnLoad();
	}
});
</script>
<a href="<?php e($url);?>" class="mdui-fab mdui-fab-fixed mdui-ripple mdui-color-theme-accent"><i class="mdui-icon material-icons">file_download</i></a>
<?php view::end('content');?>