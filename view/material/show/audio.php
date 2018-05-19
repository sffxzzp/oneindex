<?php view::layout('layout')?>

<?php view::begin('content');?>
<script src="<?php e($root);?>view/js/qrcode.min.js"></script>
<div class="mdui-container-fluid">
	<br>
	<center>
	<audio src="<?php e($item['downloadUrl']);?>" controls autoplay style="width: 100%;"  poster="<?php @e($item['thumb'].'&width=176&height=176');?>">
	</audio>
	</center>
	<br>
	<!-- 固定标签 -->
	<div class="mdui-textfield">
	  <label class="mdui-textfield-label">下载地址</label>
	  <input class="mdui-textfield-input" type="text" value="<?php e($url);?>"/>
	</div>
	<div class="mdui-textfield">
	  <label class="mdui-textfield-label">引用地址</label>
	  <textarea class="mdui-textfield-input"><audio src="<?php e($url);?>"></audio></textarea>
	</div>
	<div class="mdui-textfield">
		<label class="mdui-textfield-label">二维码</label><br>
		<div id="qrcode"></div>
	</div>
</div>
<a href="<?php e($url);?>" class="mdui-fab mdui-fab-fixed mdui-ripple mdui-color-theme-accent"><i class="mdui-icon material-icons">file_download</i></a>
<script>
var qrcode = new QRCode(document.getElementById("qrcode"), {
	width: "200",
	height: "200",
	colorDark: "#000000",
	colorLight: "#ffffff"
});
qrcode.makeCode("<?php e($url);?>");
</script>
<?php view::end('content');?>