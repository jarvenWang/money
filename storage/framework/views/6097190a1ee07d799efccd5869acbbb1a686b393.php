<div class="in-curpage-wrap">
    <a href="#">报表</a> —>
    <a href="#" class="in-curpage-active">财务记录列表</a>
</div>
<!-- module section start -->
<div class="in-content-wrap">
    <div id="tabs">
        <ul class="tab-title clearfix">
            <li class="tabulous_active">入款记录</li>
            <li>出款记录</li>
        </ul>
        <div id="tabs_container" class="routine-tab-wrap">
<div id="tabs-1" class="tab-itembox">
    <!-- 搜索条件  -->
    <div class="in-search-box clearfix">
        <select  class="in-search-sel aaa">
            <option class="pass" value="">全部</option>
            <option class="pass" value="0">没有处理的</option>
            <option class="pass" value="1">第一次申请</option>
            <option class="pass" value="2">审核通过的</option>
            <option class="pass" value="3">审核不通过的</option>
        </select>
        <input type="hidden" id="status" value="">
        <div class="in-datachoose-box">
            <input onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  class="laydate-icon start">-<input onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="laydate-icon end">
            <input type="hidden" id="start" value="">
            <input type="hidden" id="end" value="">
        </div>
        
        <select class="in-search-sel num">
            <option value="2">每页2条</option>
            <option value="3">每页3条</option>
            <option value="4">每页4条</option>
            <option value="5">每页5条</option>
            <input type="hidden" id="num" value="">
        </select>
        <a onclick="selectdata()"  class="com-searchbtn com-btn-color01 in-search-btn">确认</a>
        
    </div>
    <!-- //搜索条件 -->
    <!-- 总计 -->
    <div class="in-total-box">
        <a  href="#" class="in-member-num">
            审核通过入款人数:<span><?php echo e($pass_count); ?></span>
        </a>
        <a  href="#" class="in-member-num">
            待审核人数:<span><?php echo e($wait_count); ?></span>
        </a>
        <a  href="#" class="in-member-num">
            没处理人数:<span><?php echo e($start_count); ?></span>
        </a>
        <a href="#"  class="in-member-num">
            记录总数:<span><?php echo e($count); ?></span>
        </a>
    </div>
    <!--  //总计 -->
    <!-- 列表数据  -->
    <table  id="myTable" class="tablesorter table  table-bordered ">
        <thead>
        <tr>
            <th align="center">id</th>
            <th align="center">会员账号</th>
            <th align="center">流水单号</th>
            <th align="center">输入金额</th>
            <th align="center">入款类型</th>
            <th align="center">申请时间</th>
            <th align="center">入款状态</th>
            <th align="center">审核时间</th>
            <th align="center">备注信息</th>
            <th align="center">操作</th>
        </tr>
        </thead>
        <!-- <tbody>
            <tr align="center">
                <td align="center" colspan="11">没有数据</td>
            </tr>
        </tbody> -->
        <tbody class="inner">

        <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <tr class="the<?php echo e($data->id); ?>">
                <td align="center"><?php echo e($data->id); ?></td>
                <td align="center"><?php echo e($data->username); ?></td>
                <td align="center"><?php echo e($data->account); ?></td>
                <td align="center"><?php echo e($data->money); ?></td>
                <td align="center"><?php echo e($data->type); ?></td>
                <td align="center"><?php echo e($data->apply_time); ?></td>
                <td align="center" class="ckstatus<?php echo e($data->id); ?>"><?php echo e($data->status); ?></td>
                <td align="center" class="cktime<?php echo e($data->id); ?>"><?php echo e($data->check_time); ?></td>
                <td align="center" class="ckremark<?php echo e($data->id); ?>"><?php echo e($data->remark); ?></td>
                <td align="center"><a onclick="edit_log(<?php echo e($data->id); ?>)" class="com-smallbtn com-btn-color01 editer-btn" style="color: white;">审核</a><a onclick="del_log(<?php echo e($data->id); ?>)"  class=" com-smallbtn com-btn-color02 ml5 del-btn" style="color: white;">删除</a></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>



        </tbody>
    </table>
    <!-- //列表数据  -->
    <!-- 总计 -->
    <div class="in-total-box">
        <a  href="#" class="in-member-num">
            审核通过入款人数:<span><?php echo e($pass_count); ?></span>
        </a>
        <a  href="#" class="in-member-num">
            待审核人数:<span><?php echo e($wait_count); ?></span>
        </a>
        <a  href="#" class="in-member-num">
            没处理人数:<span><?php echo e($start_count); ?></span>
        </a>
        <a href="#"  class="in-member-num">
            记录总数:<span><?php echo e($count); ?></span>
        </a>
    </div>
    <!--  //总计 -->
    <!-- 分页按钮 -->
    
    <!-- //分页按钮 -->
    <div id="pagenation">

    </div>
    <!-- 编辑弹框 -->
    <div  class="notice-editorbox" id="notice-box" style="display: none;">
        <div class="notice-con-box">
            <form>
                <div class="com-form-wrap">
                    <!-- input -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl com-lh">备注信息：</label>
                        <div class="com-form-r com-fl">
                            <textarea name="remark" id="remark"></textarea>
                        </div>
                    </div>
                    <!-- //input -->
                    <!-- button -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl"></label>
                        <div class="com-form-r com-fl">
                            <a class="com-bigbtn com-btn-color02 " id="can">通过</a>
                            <a class="com-bigbtn com-btn-color02 " id="cannot">待审</a>
                        </div>
                    </div>
                    <!-- //button -->


                </div>
            </form>
        </div>
    </div>
</div>

        <div id="tabs-2" class="tab-itembox" style="display: none;">
            <!-- 搜索条件  -->
            <div class="in-search-box clearfix">

                <select  class="in-search-sel bbb">
                    <option class="pass" value="">全部</option>
                    <option class="pass" value="0">没有处理的</option>
                    <option class="pass" value="1">第一次申请</option>
                    <option class="pass" value="2">审核通过的</option>
                    <option class="pass" value="3">审核不通过的</option>
                </select>
                <input type="hidden" id="statuss" value="">
                <div class="in-datachoose-box">
                    <input onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  class="laydate-icon starts">-<input onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="laydate-icon ends">
                    <input type="hidden" id="starts" value="">
                    <input type="hidden" id="ends" value="">
                </div>
                
                <select class="in-search-sel number">
                    <option value="2">每页2条</option>
                    <option value="3">每页3条</option>
                    <option value="4">每页4条</option>
                    <option value="5">每页5条</option>
                    <input type="hidden" id="number" value="">
                </select>
                <a onclick="selectdatas()"  class="com-searchbtn com-btn-color01 in-search-btn">确认</a>
                
            </div>
            <!-- //搜索条件 -->
            <!-- 总计 -->
            <div class="in-total-box">
                <a  href="#" class="in-member-num">
                    审核通过入款人数:<span><?php echo e($pass_count); ?></span>
                </a>
                <a  href="#" class="in-member-num">
                    待审核人数:<span><?php echo e($wait_count); ?></span>
                </a>
                <a  href="#" class="in-member-num">
                    没处理人数:<span><?php echo e($start_count); ?></span>
                </a>
                <a href="#"  class="in-member-num">
                    记录总数:<span><?php echo e($count); ?></span>
                </a>
            </div>
            <!--  //总计 -->
            <!-- 列表数据  -->
            <table  id="myTable" class="tablesorter table  table-bordered ">
                <thead>
                <tr>
                    <th align="center">id</th>
                    <th align="center">会员账号</th>
                    <th align="center">流水单号</th>
                    <th align="center">输入金额</th>
                    <th align="center">入款类型</th>
                    <th align="center">申请时间</th>
                    <th align="center">入款状态</th>
                    <th align="center">审核时间</th>
                    <th align="center">备注信息</th>
                    <th align="center">操作</th>
                </tr>
                </thead>
                <!-- <tbody>
                    <tr align="center">
                        <td align="center" colspan="11">没有数据</td>
                    </tr>
                </tbody> -->
                <tbody class="inners">

                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr class="the<?php echo e($result->id); ?>">
                        <td align="center"><?php echo e($result->id); ?></td>
                        <td align="center"><?php echo e($result->username); ?></td>
                        <td align="center"><?php echo e($result->account); ?></td>
                        <td align="center"><?php echo e($result->money); ?></td>
                        <td align="center"><?php echo e($result->type); ?></td>
                        <td align="center"><?php echo e($result->apply_time); ?></td>
                        <td align="center" class="ckstatus<?php echo e($result->id); ?>"><?php echo e($result->status); ?></td>
                        <td align="center" class="cktime<?php echo e($result->id); ?>"><?php echo e($result->check_time); ?></td>
                        <td align="center" class="ckremark<?php echo e($result->id); ?>"><?php echo e($result->remark); ?></td>
                        <td align="center"><a onclick="edit_log(<?php echo e($result->id); ?>)" class="com-smallbtn com-btn-color01 editer-btn" style="color: white;">审核</a><a onclick="del_log(<?php echo e($result->id); ?>)"  class=" com-smallbtn com-btn-color02 ml5 del-btn" style="color: white;">删除</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>



                </tbody>
            </table>
            <!-- //列表数据  -->
            <!-- 总计 -->
            <div class="in-total-box">
                <a  href="#" class="in-member-num">
                    审核通过入款人数:<span><?php echo e($pass_count); ?></span>
                </a>
                <a  href="#" class="in-member-num">
                    待审核人数:<span><?php echo e($wait_count); ?></span>
                </a>
                <a  href="#" class="in-member-num">
                    没处理人数:<span><?php echo e($start_count); ?></span>
                </a>
                <a href="#"  class="in-member-num">
                    记录总数:<span><?php echo e($count); ?></span>
                </a>
            </div>
            <!--  //总计 -->
            <!-- 分页按钮 -->
        
        <!-- 分页按钮 -->
            <div id="pagenation_two" style="text-align: center;padding: 20px 0;">

            </div>
        <!-- //分页按钮 -->

            <!-- 编辑弹框 -->
            <div  class="notice-editorbox" id="notice-box" style="display: none;">
                <div class="notice-con-box">
                    <form>
                        <div class="com-form-wrap">
                            <!-- input -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">备注信息：</label>
                                <div class="com-form-r com-fl">
                                    <textarea name="remark" id="remark"></textarea>
                                </div>
                            </div>
                            <!-- //input -->
                            <!-- button -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl"></label>
                                <div class="com-form-r com-fl">
                                    <a class="com-bigbtn com-btn-color02 " id="can">通过</a>
                                    <a class="com-bigbtn com-btn-color02 " id="cannot">待审</a>
                                </div>
                            </div>
                            <!-- //button -->


                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

</div>
    </div>


<!-- module section end  -->
<script type="text/javascript">
    //筛选查询
    function selectdata() {
        var a= $(".aaa").val();
        var start = $(".start").val();
        var end = $(".end").val();
        var num = $(".num").val();
        $("#status").val(a);
        $("#start").val(start);
        $("#end").val(end);
        $("#num").val(num);
        fan();
    }
    // 初始化运行
    fan();
    //分页插件初始化
    function fan(curr){
        var a= $("#status").val();
        var start = $("#start").val();
        var end = $("#end").val();
        var num = $("#num").val();
        $.getJSON("/payment_log", {
            page: curr,
            status: a,
            start:start,
            end:end,
            num:num
        }, function(res){
            console.info(res);
            $('.inner').html(res.list);
            //显示分页
            laypage({
                cont: 'pagenation',
                skin: '#AF0000',
                //skip: true
                pages: res.allpage,
                curr: res.nextpage,
                jump: function(obj, first){
                    if(!first){
                        fan(obj.curr-1);
                    }
                }
            });
        });
    };

    //筛选查询
    function selectdatas() {
        var a= $(".bbb").val();
        var start = $(".starts").val();
        var end = $(".ends").val();
        var num = $(".number").val();
        $("#statuss").val(a);
        $("#starts").val(start);
        $("#ends").val(end);
        $("#number").val(num);
        fantwo();
    }
// 初始化运行
fantwo();
//分页插件初始化
function fantwo(curr){
        var a= $("#statuss").val();
        var start = $("#starts").val();
        var end = $("#ends").val();
        var num = $("#number").val();
        console.info(start);
    $.getJSON("/payment_logs", {
        page: curr,
            status: a,
            start:start,
            end:end,
            num:num
    }, function(res){
        console.info(res);
        $('.inners').html(res.list);
        //显示分页
        laypage({
            cont: 'pagenation_two',
            skin: '#AF0000',
            //skip: true
            pages: res.allpage,
            curr: res.nextpage,
            jump: function(obj, first){
                if(!first){
                    fantwo(obj.curr-1);
                }
            }
        });
    });
};

    //tablesorter的初始化
    $(document).ready(function()
            {
                $("#myTable").tablesorter();
            }
    );

    //审核处理弹框
    function edit_log(e) {

        layer.open({
            type: 1,
            title: '审核操作',
            shadeClose: true,
            shade: 0.5,
            area: ['500px', '70%'],
            content: $("#notice-box")    //iframe的url
        });
        $("#can").on("click",function(){
            var remark =$("#remark").val();
            if(remark){
                $.post('/check_log',{'_token':'<?php echo e(csrf_token()); ?>','status':'ok','id':e,'remark':remark},function(data) //第二个参数要传token的值 再传参数要用逗号隔开--}}
                {
                    //alert(data.check_time);
                     if(data == 2){
                        layer.msg('审核失败');
                         layer.closeAll();
                    }else if(data == 3){
                        layer.msg('被其它管理员审核过');
                         layer.closeAll();
                    }else{
                         layer.msg('审核成功');
                         $(".cktime"+e).html(data.check_time);
                         $(".ckremark"+e).html(data.remark);
                         $(".ckstatus"+e).html(data.status);
                         layer.closeAll();
                    }

                });
            }else{
                layer.msg('备注信息不能为空!');
                layer.closeAll();
            }

        });
        $("#cannot").on("click",function(){
            var remark =$("#remark").val();
            if(remark){
                $.post('/check_log',{'_token':'<?php echo e(csrf_token()); ?>','status':'wait','id':e,'remark':remark},function(data) //第二个参数要传token的值 再传参数要用逗号隔开--}}
                {
                    //alert(data.check_time);return false;
                    if(data == 2){
                        layer.msg('审核失败');
                        layer.closeAll();
                    }else if(data == 3){
                        layer.msg('被其它管理员审核过');
                        layer.closeAll();
                    }else{
                        layer.msg('审核成功');
                        $(".cktime"+e).html(data.check_time);
                        $(".ckremark"+e).html(data.remark);
                        $(".ckstatus"+e).html(data.status);
                        layer.closeAll();
                    }

                });
            }else{
                layer.msg('备注信息不能为空!');
            }

        });
    }
    //删除记录方法
    function del_log(val) {
        layer.confirm('确定删除吗？', {
            btn: ['是','否'] //按钮
        }, function(){
            $.post('/del_log',{'_token':'<?php echo e(csrf_token()); ?>','id':val},function(data) //第二个参数要传token的值 再传参数要用逗号隔开
            {
                if(data ==1){
                    layer.msg('删除成功');
                    $('tr').remove(".the"+val);
                    layer.closeAll();
                }else{
                    layer.msg('删除失败');
                    layer.closeAll();
                }
            });
        });
    }
    //添加弹框
    $(".addmember").on("click",function(){
        layer.open({
            type: 1,
            title: '公告修改',
            shadeClose: true,
            shade: 0.5,
            area: ['600px', '70%'],
            content: $("#notice-box")    //iframe的url
        });
    })
</script>

<script type="text/javascript">
    $(function () {
        $(".direction").each(function () {
            $(this).click(function () {
                var render = $(this).attr('render');
                var status = $(".status").val();
                var start = $("#start").val();
                var end = $("#end").val();
                var send_url = render;
                if(status!=''){
                    send_url+='&status='+status;
                }
                if(start!=''){
                    send_url+='&start='+start;
                }
                if(end!=''){
                    send_url+='&end='+end;
                }
                $.ajax({
                    type: 'get',
                    url: send_url,

                    dataType: "html",
                    success: function (data) {
                        $('.include-page').html(data);
                        if(start!=''){
                            $("#start").val(start);
                            $(".start").val(start);
                        }
                        if(end!=''){
                            $("#end").val(end);
                            $(".end").val(end);
                        }
                        $(".aaa").find('option').each(function () {
                            var select = $(this).val();
                            if(select == status){
                                $(this).attr('selected','selected');
                            }
                        })
                    }
                });
            });
        });
    });

    //tab切换
    $(".tab-title li").on("click",function(){
        var index = $(this).index();
        $(this).addClass('tabulous_active').siblings().removeClass('tabulous_active');
        $(".tab-itembox").eq(index).show().siblings().hide();
    })

</script>