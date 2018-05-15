<?php view::layout('layout')?>

<?php view::begin('content');?>
<script src="view/js/qrcode.min.js"></script>
<div class="mdui-container-fluid">
	<br>
	<div class="mdui-textfield">
		<label class="mdui-textfield-label">下载</label>
		<a href="<?php e($url);?>" class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-ripple">点此下载</a></button>
	</div>
	<br>
	<div class="mdui-textfield">
		<label class="mdui-textfield-label">下载地址</label>
		<input class="mdui-textfield-input" type="text" value="<?php e($url);?>"/>
	</div>
	<div class="mdui-textfield">
		<label class="mdui-textfield-label">HTML 引用地址</label>
		<input class="mdui-textfield-input" type="text" value="<img src='<?php e($url);?>' />"/>
	</div>
	<div class="mdui-textfield">
		<label class="mdui-textfield-label">二维码</label><br>
		<div id="qrcode"></div>
	</div>
	<br>
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
