<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="<?php echo e(asset('styles/reset.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('styles/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('styles/index.css')); ?>">
    <script type="text/javascript" src="<?php echo e(asset('bower_components/jquery/jquery-2.1.4.min.js')); ?>"></script>

</head>
<body>
<div class="permiss-box">
    <p  class="permiss-text">权限不足，10秒后返回<span>10</span></p>
</div>
<script type="text/javascript">
    var time = 10,
         timeEle = $(".permiss-text span"),
         timer= setInterval(function(){
        if(time==0){
            timeEle.text(0);
            clearInterval(timer);
            window.history.back();
        }else{
            time--;
            timeEle.text(time);
        }
    },1000)
</script>
</body>
</html>