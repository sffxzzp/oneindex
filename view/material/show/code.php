<?php view::layout('layout')?>

<?php view::begin('content');?>
<script src="<?php e($root);?>view/js/qrcode.min.js"></script>
<style type="text/css" media="screen">
	#editor { 
		/*height:800px;*/
	}
</style>
<div class="mdui-container">
<pre id="editor" ><?php echo htmlentities($content);?></pre>
</div>
<div class="mdui-textfield">
	<label class="mdui-textfield-label">下载地址</label>
	<input class="mdui-textfield-input" type="text" value="<?php e($url);?>"/>
</div>
<div class="mdui-textfield">
	<label class="mdui-textfield-label">二维码</label><br>
	<div id="qrcode"></div>
</div>
<a href="<?php e($url);?>" class="mdui-fab mdui-fab-fixed mdui-ripple mdui-color-theme-accent"><i class="mdui-icon material-icons">file_download</i></a>

<script src="https://cdn.bootcss.com/ace/1.2.9/ace.js"></script>
<script src="https://cdn.bootcss.com/ace/1.2.9/ext-language_tools.js"></script>
<script src="https://cdn.bootcss.com/ace/1.2.9/theme-github.js"></script>
<script>
	var qrcode = new QRCode(document.getElementById("qrcode"), {
		width: "200",
		height: "200",
		colorDark: "#000000",
		colorLight: "#ffffff"
	});
	qrcode.makeCode("<?php e($url);?>");
	var editor = ace.edit("editor");
	editor.setTheme("ace/theme/github");
	editor.setFontSize(14);
	editor.session.setMode("ace/mode/<?php e($language);?>");
	
	//Autocompletion
	editor.setOptions({
		selectionStyle: "line",
		highlightActiveLine: true,
		highlightSelectedWord: true,
		enableBasicAutocompletion: true,
		enableSnippets: true,
		enableLiveAutocompletion: true,
		maxLines: Infinity
	});
</script>
<?php view::end('content');?>