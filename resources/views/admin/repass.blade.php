
<div class="in-curpage-wrap">
    <a href="#">管理员</a> —>
    <a href="#" class="in-curpage-active">修改密码</a>
</div>
<!-- module routine-setting  -->
<div class="in-content-wrap">
    <div id="tabs">

        <div id="tabs_container" class="routine-tab-wrap">

                    <!-- 列表数据  -->
                    <table  id="myTable" class="tablesorter table  table-bordered ">
                        <tbody>
                        <tr >
                                <div class="com-form-wrap">
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">原密码：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="password" name="oldpassword" maxlength="10" class="com-input-text com-input-sizemid">
                                        </div>
                                    </div>
                                    <!--// input -->

                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">新密码：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="password" name="newpassword" maxlength="10" class="com-input-text com-input-sizemid">
                                        </div>
                                    </div>
                                    <!--// input -->

                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">确认新密码：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="password" name="renewpassword" maxlength="10" class="com-input-text com-input-sizemid">
                                        </div>
                                    </div>
                                    <!--// input -->

                                    <!-- button -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl"></label>
                                        <div class="com-form-r com-fl">
                                            <button id="password" type="submit" class="com-bigbtn com-btn-color02 subrole">确认修改</button>
                                        </div>
                                    </div>
                                    <!-- //button -->
                                </div>
                        </tr>
                        </tbody>
                    </table>
                    <!-- //列表数据  -->


        </div>
    </div>
</div>
<!-- //module routine-setting  -->

<script type="text/javascript">
    /**
     *form表单checkout radio美化初始化
     */
    $('input').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue',
        increaseArea: '20%' // optional
    });
    $("#password").click(function () {
        var oldpassword = $("input[name='oldpassword']").val();
        var newpassword = $("input[name='newpassword']").val();
        var renewpassword = $("input[name='renewpassword']").val();
        if(!oldpassword || !newpassword || !renewpassword){
            layer.msg('原、新密码不能为空');
            return false;
        }
        if(newpassword.length<6){
            layer.msg('新密码大于等于6位');
            return false;
        }
        if(newpassword!=renewpassword){
            layer.msg('两次密码不相等');
            return false;
        }
        $.post('/set_password',{'_token':'{{csrf_token()}}','oldpassword':oldpassword,'newpassword':newpassword},function(data)
        {
            console.info(data);
            if(data == 1){
                layer.msg('操作成功');
            }else if(data == 2){
                layer.msg('原密码不正确');
            }else if(data == 3){
                layer.msg('更新失败');
            }
        });


    });

</script>


