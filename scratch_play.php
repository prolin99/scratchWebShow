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
    //echo $sb_file ;
}else
    $sb_file ='sample.sb3' ;
?>
var sb_file = "sb/<?php echo $sb_file ?>" ;





var DESIRED_USERNAME = "griffpatch",COMPAT = true, TURBO = false;
var SRC = "file" ;


var request = new XMLHttpRequest();
request.open('GET', sb_file, true);
request.responseType = 'blob';
request.onload = function() {
    const  reader = new FileReader();
    reader.readAsDataURL(request.response);
    reader.onload =  function(e){
        //console.log('DataURL:', e.target.result);
        //FILE = "data:application/octet-stream;base64,"+ e.target.result   ;
        console.log('read sb3 data ok ');
        var FILE =   e.target.result   ;

        if (SRC === 'file') {

              fetch(FILE)
                .then(r => r.arrayBuffer())
                .then(b => Scratch.vm.loadProject(b));
            } else {
              Scratch.vm.downloadProjectId('');
            }
    };
};
request.send();

</script>

<script src="./js/vm.min.js"></script>
<script src="./js/play_scratch.js"></script>
</body>
</html>
