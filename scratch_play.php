<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>scratch player</title>
<link rel="stylesheet" type="text/css" href="./js/player.css">

</head>


<body>


<div id="w">
<canvas id="s"></canvas>
<div id="m"></div>
<div id="b">
<label id="q" for="a">Question</label>
<input type="text" id="a">
</div>
</div>

<span id="l">wait...</span>

<button id="green" title="start"></button>
<button id="stop" title="stop"></button>
<button id="f" title="fullscreen"></button>


<script src="./js/vm.min.js"></script>
<script src="./js/play_scratch.js"></script>
<script type="text/javascript" id="j">


<?php
ini_set('display_errors','off');    # 關閉錯誤輸出

//是否一開始就播放 (true or false)
if ($_GET['autoplay'])
    echo "var AutoStart = true; \n" ;
else
    echo "var AutoStart = false; \n" ;
//檔名   只能為英數 -_ 字元
if (preg_match( '/^([0-9a-z-_]*)\.sb([2-3]?)$/i', $_GET['sb'])  ){
    $sb_file =$_GET['sb'] ;

}else
    $sb_file ='sample.sb3' ;

    $sb3_base64 =base64_encode( file_get_contents("sb/" . $sb_file) );

?>
//直接放入資料內容，載入比較快
var FILE= "data:application/octet-stream;base64,<?php echo $sb3_base64  ;  ?>"   ;

var DESIRED_USERNAME = "griffpatch",COMPAT = true, TURBO = false;
var SRC = "file" ;

if (SRC === 'file') {
  fetch(FILE)
    .then(r => r.arrayBuffer())
    .then(b => Scratch.vm.loadProject(b));
} else {
  Scratch.vm.downloadProjectId('');
}

</script>

</body>
</html>
