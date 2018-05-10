<?php view::layout('layout')?>
<?php $mpd =  str_replace("thumbnail","videomanifest",$item['thumb'])."&part=index&format=dash&useScf=True&pretranscode=0&transcodeahead=0";?>
<?php view::begin('content');?>
<link class="dplayer-css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dplayer/dist/DPlayer.min.css">
<script src="https://cdn.jsdelivr.net/npm/dashjs/dist/dash.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dplayer/dist/DPlayer.min.js"></script>
<script src="view/js/subtitles-octopus.js"></script>
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
</div>
<script>
var dp;
function loadPlayer(mode) {
    if (mode==0) {
        dp = new DPlayer({
            container: document.getElementById('dplayer'),
            lang:'zh-cn',
            video: {
                url: '<?php e($item['downloadUrl']);?>',
                pic: '<?php @e($item['thumb'].'&width=176&height=176');?>',
                type: 'auto'
            }
        });
    }
    else {
        dp = new DPlayer({
            container: document.getElementById('dplayer'),
            lang:'zh-cn',
            video: {
                url: '<?php echo $mpd;?>',
                pic: '<?php @e($item['thumb'].'&width=176&height=176');?>',
                type: 'dash'
            }
        });
    }
}
function subtitle() {
    dp.on('canplay', function () {
        var video = document.getElementsByTagName('video')[0];
        window.SubtitlesOctopusOnLoad = function () {
            var options = {
                video: video,
                subUrl: '<?php $urlparts = pathinfo($url); e($urlparts['dirname'].'/'.$urlparts['filename'].'.ass');?>',
                fonts: ["//gapis.geekzu.org/g-fonts/ea/notosanssc/v1/NotoSansSC-Regular.otf", "//gapis.geekzu.org/g-fonts/ea/notosanstc/v1/NotoSansTC-Regular.otf", "//gapis.geekzu.org/g-fonts/ea/notosansjapanese/v6/NotoSansJP-Regular.otf"],
                workerUrl: 'view/js/subtitles-octopus-worker.js'
            };
            window.octopusInstance = new SubtitlesOctopus(options);
        };
        if (SubtitlesOctopus) {
            SubtitlesOctopusOnLoad();
        }
    });
}
function modeSwitch() {
    dp.destroy();
    loadPlayer(1);
    subtitle();
};
loadPlayer(0);
subtitle();
</script>

<div class="mdui-fab-wrapper" mdui-fab="{trigger: 'click'}">
    <button class="mdui-fab mdui-ripple mdui-color-theme-accent">
        <i class="mdui-icon material-icons">settings</i>
        <i class="mdui-icon mdui-fab-opened material-icons">settings</i>
    </button>
    <div class="mdui-fab-dial">
        <a href="<?php e($url);?>" class="mdui-fab mdui-fab-mini mdui-ripple mdui-color-theme-accent"><i class="mdui-icon material-icons">file_download</i></a>
        <a onclick="javascript:modeSwitch();" class="mdui-fab mdui-fab-mini mdui-ripple mdui-color-red"><i class="mdui-icon material-icons">sync_problem</i></a>
    </div>
</div>
<?php view::end('content');?>