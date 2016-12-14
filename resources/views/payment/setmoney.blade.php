
<div class="in-curpage-wrap">
    <a href="#">财务</a> —>
    <a href="#" class="in-curpage-active">加扣款</a>
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
                                        <label class="com-form-l com-fl com-lh">会员账号：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" name="username" class="com-input-text com-input-sizemid">
                                        </div>
                                        <input type="hidden" id="id" value=""/>
                                        <div class="com-form-r" id="check" style="border:1px solid lightgray;width: 66px;height: 33px;margin-left: 10px;text-align: center; line-height: 35px;">点击查询</div>
                                    </div>
                                    <!-- //input -->
                                    <div id="show" style="display: none;">
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">中心钱包：</label>
                                        <div class="com-form-r com-fl">
                                            <span id="balance" style="line-height: 39px;"></span>
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">红包账户：</label>
                                        <div class="com-form-r com-fl">
                                            <span style="line-height: 39px;">123.90</span>
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">新天地娱乐场：</label>
                                        <div class="com-form-r com-fl">
                                            <span style="line-height: 39px;">0</span>
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <!--  select -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh" >操作类型：</label>
                                        <div class="com-form-r com-fl">
                                            <select name="type" id="type" class="com-select">
                                                <option value="">选择操作类型</option>
                                                <option value="1">补款</option>
                                                <option value="2">扣款</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- //select -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">操作金额：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" id="money" name="money" class="com-input-text com-input-sizemid">
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">流水要求：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" id="require" name="require" class="com-input-text com-input-sizemid">
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">备注说明：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" id="remark" name="remark" class="com-input-text com-input-sizemid" style="width: 800px;">
                                        </div>
                                    </div>
                                    <!-- //input -->

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <!-- button -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl"></label>
                                        <div class="com-form-r com-fl">
                                            <button id="sub" type="submit" class="com-bigbtn com-btn-color02 subrole">确认操作</button>
                                        </div>
                                    </div>
                                    <!-- //button -->
                                </div>
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

    $("#check").click(function () {
        var username = $("input[name='username']").val();
        $.post('/search_member',{'_token':'{{csrf_token()}}','username':username},function(data)
        {
            //console.info(data);
            if(data == 2){
                layer.msg('该用户名不存在');
                $("#id").val('');
                $("#show").css('display','none');
            }else{
                $("#show").css('display','block');
                $("#id").val(data.id);
                $("#balance").html(data.balance);
            }
        });

    });

    $("#sub").click(function () {
        var id = $("#id").val();
        var balance = $("#balance").html();
        var type = $("#type").val();
        var remark = $("#remark").val();
        var money = $("#money").val();
        if(!money){
            layer.msg('操作金额格式不正确');
            return false;
        }
        if(type==1 || type==2) {
            //扣款
            if(type==2){
                if(money>balance){
                    layer.msg('扣款金额大于余额');
                    return false;
                }
            }
            $.post('/change_money',{'_token':'{{csrf_token()}}','id':id,'balance':balance,'type':type,'remark':remark,'money':money},function(data)
            {
                console.info(data);
                if(data != 1){
                    layer.msg('操作成功');
                    location.reload()
                }else{
                    layer.msg('数据修改失败');
                }
            });
        }else{
            layer.msg('请选择操作类型');
            return false;
        }

    });
</script>


