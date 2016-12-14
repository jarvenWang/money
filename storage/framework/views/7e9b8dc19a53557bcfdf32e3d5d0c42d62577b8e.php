<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BS-后台</title>




    <link rel="stylesheet" href="<?php echo e(asset('styles/reset.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('styles/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/styles/index.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('/bower_components/layer/skin/layer.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/bower_components/laypage/skin/laypage.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/bower_components/tablesorter/themes/blue/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/bower_components/icheck-1.x/skins/minimal/blue.css')); ?>">

    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" type="text/css">
    <script src="<?php echo e(asset('/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/jquery.form.js')); ?>"></script>
    <script src="<?php echo e(asset('/layer/layer.js')); ?>"></script>
</head>
<body>


    <div class="login-wrap">
        <form name="loginForm" id="loginForm" method="post" action="/login">
            <?php echo e(csrf_field()); ?>

            <div class="com-form-wrap">
                <input type="hidden" name="screen" value="" id="screen" />
                <!-- input -->
                <div class="com-form-group clearfix">
                    <label class="com-form-l com-fl com-lh">名称：</label>
                    <div class="com-form-r com-fl">
                        <input type="text"  name="username" class="com-input-text">
                    </div>
                </div>
                <!-- //input -->
                <!-- input -->
                <div class="com-form-group clearfix">
                    <label class="com-form-l com-fl com-lh">密码：</label>
                    <div class="com-form-r com-fl">
                        <input type="password"  name="password" class="com-input-text">
                    </div>
                </div>
                <!-- //input -->

                <!-- input -->
                <div class="com-form-group clearfix">
                    <label class="com-form-l com-fl com-lh">验证码：</label>
                    <div class="com-form-r com-fl">
                        <img src="<?php echo e(url('getcode')); ?>" id="code" onclick="this.src='<?php echo e(url('getcode')); ?>?'+Math.random()"/>
                        <input type="text"  name="code" style="float:left"/>
                    </div>
                </div>
                <!-- //input -->
                <!-- button -->
                <div class="com-form-group clearfix">
                    <label class="com-form-l com-fl"></label>
                    <div class="com-form-r com-fl">
                        <p><button type="submit" class="com-bigbtn com-btn-color02 ">登陆</button>  </p>
                    </div>
                </div>
                <!-- //button -->
            </div>
        </form>
    </div>
    
    
    
    
    
    
    
    
    
    
    

    <script type="text/javascript" src="<?php echo e(asset('/scripts/index.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('/scripts/common.js')); ?>"></script>


</body>
</html>
<script>
    //登入
    var loadingIndex;
    $(function(){
        $('#loginForm').ajaxForm({
            beforeSubmit: logcheckForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: logcomplete, // 这是提交后的方法
            dataType: 'json'
        });

        function logcheckForm(){

            if( '' == $('input[name=username]').val()){
                layer.msg('登入用户名不能为空');
                $('input[name=username]').focus();
                return false;
            }

            if( '' == $('input[name=password]').val()){
                layer.msg('登入密码不能为空');
                $('input[name=password]').focus();
                return false;
            }
            loadingIndex = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
        }
        function logcomplete(data){
            layer.close(loadingIndex);
            if(data.status==1){
                layer.msg(data.success, {time: 1000}, function(){
                    window.location.href=data.url;
                });
            }else{
                layer.alert(data.error,{icon: 5});
                $("#code").click();
                return false;
            }
        }

    });

    //找回密码，发送邮件
    $(function(){
        $('#runemail').ajaxForm({
            beforeSubmit: emailcheckForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: emailcomplete, // 这是提交后的方法
            dataType: 'json'
        });

        function emailcheckForm(){
            if( '' == $.trim($('#email').val())){
                layer.alert('邮件不能为空', {icon: 6});
                $('#email').focus();
                return false;
            }

        }
        function emailcomplete(data){
            if(data.status==1){
                layer.alert(data.info, {icon: 6});
                return false;
            }else{
                layer.alert(data.info, {icon: 5});
                return false;
            }
        }

    });


</script>
<script type="text/javascript">
    document.getElementById('screen').value = screen.width + 'x' + screen.height;
</script>