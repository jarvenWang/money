
<div class="in-curpage-wrap">
    <a href="#">报表</a> —>
    <a href="#" class="in-curpage-active">会员列表</a>
</div>
<!-- module section start -->
<div class="in-content-wrap">
    <!-- 搜索条件  -->
    <div class="in-search-box clearfix">
        <form action="<?php echo e(route('_member-list')); ?>" method="get">
        <select class="in-search-sel">
            <option>会员账号</option>
            <option>游戏单号</option>
            <option>游戏局数</option>
        </select>
        <input type="text" value="<?php echo e($userName); ?>" name="user_name" class="in-search-input">

        <div class="in-datachoose-box">
            <input name="start_time"  value="<?php echo e($startTime); ?>" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="laydate-icon">-
            <input name="end_time" value="<?php echo e($endTime); ?>"  onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="laydate-icon">
        </div>

        <select class="in-search-sel">
            <option  >选择排序</option>
            <option  >投注金额</option>
            <option  >投注时间</option>
        </select>

        <select class="in-search-sel" name="limit" >
            <option value="15">每15条</option>
            <option value="30" >每页30条</option>
            <option value="50" >每页50条</option>
            <option value="100" >每页100条</option>
        </select>
        
        <button type="submit" class="com-searchbtn com-btn-color01 in-search-btn">确认</button>
        <a href="javascript:;" class="com-searchbtn com-btn-color02 in-search-btn  ml5 addmember">添加</a>
        </form>
    </div>
    <script>


        $('form').ajaxForm(function ($message) {
            $("#include-page").html($message);
//            layer.alert($message);
        });

    </script>
    <!-- //搜索条件 -->
    <!-- 总计 -->
    <div class="in-total-box">
        <a href="#" class="in-member-num">
            vip会员人数:<span><?php echo e(isset($vipcount) ? $vipcount : 0); ?></span>
        </a>
        <a href="#" class="in-member-num">
            在线会员人数:<span><?php echo e(isset($online) ? $online : 0); ?></span>
        </a>
        <a href="#" class="in-member-num">
            危险会员人数:<span><?php echo e(isset($danget) ? $danget : 0); ?></span>
        </a>
        <a href="#" class="in-member-num">
            会员总额:<span><?php echo e(isset($counts) ? $counts : 0); ?></span>
        </a>
    </div>
    <!--  //总计 -->
    <!-- 列表数据  -->
    <table id="myTable" class="tablesorter table  table-bordered ">
        <thead>
        <tr>
            <th align="center">ID</th>
            <th align="center">姓名</th>
            <th align="center">会员名</th>
            <th align="center">邮箱</th>
            <th align="center">手机号</th>
            <th align="center">备注信息</th>
            <th align="center">用户余额</th>
            <th align="center">用户状态</th>
            <th align="center">编辑</th>
        </tr>
        </thead>
        <!-- <tbody>
            <tr align="center">
                <td align="center" colspan="11">没有数据</td>
            </tr>
        </tbody> -->
        <tbody id="trJson">

        <?php $userStatus = ['关闭', '正常'];?>
        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
            <tr>
                <td align="center" id="userid<?php echo e($d->id); ?>"><?php echo e($d->id); ?></td>
                <td align="center" id="name<?php echo e($d->id); ?>"><?php echo e($d->name); ?></td>
                <td align="center" id="username<?php echo e($d->id); ?>"><?php echo e($d->username); ?></td>
                <td align="center" id="email<?php echo e($d->id); ?>"><?php echo e($d->email); ?></td>
                <td align="center" id="mobile<?php echo e($d->id); ?>"><?php echo e($d->mobile); ?></td>
                <td align="center" id="remark<?php echo e($d->id); ?>"><?php echo e($d->remark); ?></td>
                <td align="center" id="balance<?php echo e($d->id); ?>"><?php echo e($d->balance); ?></td>
                <td align="center" id="off<?php echo e($d->id); ?>"><?php echo e($userStatus[$d->status]); ?></td>
                <td align="center">
                    <a href="javascript:;" class="com-smallbtn com-btn-color01 editer-btn" editid="<?php echo e($d->id); ?>">编辑</a>
                    <a href="javascript:;" class="com-smallbtn com-btn-color02 ml5 del-btn" delid="<?php echo e($d->id); ?>">关闭</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>

            <tr align="center">
                <td align="center" colspan="11">没有数据1</td>
            </tr>

        <?php endif; ?>


        </tbody>
    </table>
    <!-- //列表数据  -->
    <!-- 小计 -->
    <div class="in-total-box">
        <a href="#" class="in-member-num">
            vip会员人数:<span><?php echo e(isset($vipcount) ? $vipcount : 0); ?></span>
        </a>
        <a href="#" class="in-member-num">
            在线会员人数:<span><?php echo e(isset($online) ? $online : 0); ?></span>
        </a>
        <a href="#" class="in-member-num">
            危险会员人数:<span><?php echo e(isset($danget) ? $danget : 0); ?></span>
        </a>
        <a href="#" class="in-member-num">
            会员总额:<span><?php echo e(isset($counts) ? $counts : 0); ?></span>
        </a>
    </div>
    <!--  //小计 -->
    <!-- 分页按钮 -->
    <div id="pagenation">

    </div>
    
    <!-- //分页按钮 -->

    
	<!-- 编辑弹框 -->
	<div  class="notice-editorbox" id="notice-box" style="display:none">
		<div class="notice-con-box">

				<div class="com-form-wrap">
					<!-- input -->
					<div class="com-form-group clearfix">
						<label class="com-form-l com-fl com-lh">姓名：</label>
						<div class="com-form-r com-fl">
							<input type="text" id="fm_username" name="data[username]" class="com-input-text">
						</div>
					</div>
					<!-- //input -->
					<!-- input -->
					<div class="com-form-group clearfix">
						<label class="com-form-l com-fl com-lh">会员名字：</label>
						<div class="com-form-r com-fl">
							<input type="text" id="fm_name" name="data[name]" class="com-input-text">
						</div>
					</div>
					<!-- //input -->
					<!-- input -->
					<div class="com-form-group clearfix">
						<label class="com-form-l com-fl com-lh">邮箱：</label>
						<div class="com-form-r com-fl">
							<input type="text" id="fm_email" name="data[email]" class="com-input-text">
						</div>
					</div>
					<!-- //input -->
					<!-- input -->
					<div class="com-form-group clearfix">
						<label class="com-form-l com-fl com-lh">手机号：</label>
						<div class="com-form-r com-fl">
							<input type="text" id="fm_mobile" name="data[mobile]" class="com-input-text">
						</div>
					</div>
					<!-- //input -->
					<input type="hidden" name="data[id]" id="fm_id">
					<!-- button -->
					<div class="com-form-group clearfix">
						<label class="com-form-l com-fl"></label>
						<div class="com-form-r com-fl">
							<button onclick="fm_submit()" class="com-bigbtn com-btn-color02 ">确认</button>
						</div>
					</div>
					<!-- //button -->
				</div>

		</div>	
	</div>
	<!-- //编辑弹框 -->
	<!-- 添加弹框 start -->
	<div  class="notice-editorbox" id="add-box" style="display:none">
		<div class="notice-con-box">

				<div class="com-form-wrap">
					<!-- input -->
					<div class="com-form-group clearfix">
						<label class="com-form-l com-fl com-lh">姓名：</label>
						<div class="com-form-r com-fl">
							<input type="text"  id="fma_username" name="data[username]" class="com-input-text">
						</div>
					</div>
					<!-- //input -->
					<!-- input -->
					<div class="com-form-group clearfix">
						<label class="com-form-l com-fl com-lh">会员名字：</label>
						<div class="com-form-r com-fl">
							<input type="text" id="fma_name" name="data[name]" class="com-input-text">
						</div>
					</div>
					<!-- //input -->
					<!-- input -->
					<div class="com-form-group clearfix">
						<label class="com-form-l com-fl com-lh">密码：</label>
						<div class="com-form-r com-fl">
							<input type="text" id="fma_password" name="data[password]" class="com-input-text">
						</div>
					</div>
					<!-- //input -->
					<!-- input -->
					<div class="com-form-group clearfix">
						<label class="com-form-l com-fl com-lh">邮箱：</label>
						<div class="com-form-r com-fl">
							<input type="text" id="fma_email" name="data[email]" class="com-input-text">
						</div>
					</div>
					<!-- //input -->
					<!-- input -->
					<div class="com-form-group clearfix">
						<label class="com-form-l com-fl com-lh">手机号：</label>
						<div class="com-form-r com-fl">
							<input type="text" id="fma_mobile" name="data[mobile]" class="com-input-text">
						</div>
					</div>
					<!-- //input -->
					<input type="hidden" name="data[id]" id="fma_id">
					<!-- button -->
					<div class="com-form-group clearfix">
						<label class="com-form-l com-fl"></label>
						<div class="com-form-r com-fl">
							<button class="com-bigbtn com-btn-color02 " onclick="fm_add()">确认</button>
						</div>
					</div>
					<!-- //button -->
				</div>

		</div>	
	</div>
	<!-- //添加弹框 end -->
</div>


<!-- module section end  -->
<script type="text/javascript">
    //关闭弹出窗口用
    var index;
    var _add;
    //填出表单提交事件
    function fm_submit() {

        var _name = $("#fm_name").val(),
                _username = $("#fm_username").val(),
                _mobile = $("#fm_mobile").val(),
                _email = $("#fm_email").val(),
                _id = $("#fm_id").val();
        var data = {
            "name": _name,
            "username": _username,
            "mobile": _mobile,
            "email": _email,
            "id": _id
        };
        var _data = JSON.stringify(data);
        var urls = "<?php echo e(route('_changeUser')); ?>";
        $.ajax({
            type: 'get',
            url: urls,
            data: {"data": _data},
            dataType: "json",
            success: function (data) {

                if (data.status == 1) {
                    $("#name" + data.id).text($("#fm_name").val());
                    $("#username" + data.id).text($("#fm_username").val());
                    $("#email" + data.id).text($("#fm_email").val());
                    $("#mobile" + data.id).text($("#fm_mobile").val());
                    setTimeout(function () {
                        layer.close(index);
                    }, 500);

                }

            }
        });
    }

    // laypage 添加分页功能
    <?php if($page!=1): ?>
    getPage(<?php echo e($page); ?>);
    <?php else: ?>
    page_init();
    <?php endif; ?>
    function page_init(){
        var counts =<?php echo e(isset($count) ? $count : 0); ?>;
        laypage({
            cont: 'pagenation', //容器。值支持id名、原生dom对象，jquery对象。【如该容器为】：<div id="page1"></div>
            pages: counts, //通过后台拿到的总页数
            curr:  1, //当前页
            skip: false,
//                        groups: 3,
            skin: '#393d49',
            jump: function (obj, first) { //触发分页后的回调
                if (!first) { //点击跳页触发函数自身，并传递当前页：obj.curr
                    getPage(obj.curr);
                }
            }
        });
    }
    //layer分页函数
    function getPage(curr) {
        var page = curr || 1;
//        获取服务器传过来的第几页
        var getPages =<?php echo e(isset($page) ? $page : 1); ?>;
        var first =<?php echo e(isset($first) ? $first : 0); ?>;
        var counts =<?php echo e(isset($count) ? $count : 0); ?>;
        var urls = "<?php echo e(route('_member-list')); ?>";

        if (page != getPages) {
            $.ajax({
                type: 'get',
                url: urls,
                data: {'p': curr,'where_json':'<?php echo e($where); ?>' },

                dataType: "html",
                success: function (data) {

                    $("#include-page").html(data);

                    laypage({
                        cont: 'pagenation', //容器。值支持id名、原生dom对象，jquery对象。【如该容器为】：<div id="page1"></div>
                        pages: counts, //通过后台拿到的总页数
                        curr: curr || 1, //当前页
                        skip: false,
//                        groups: 3,
                        skin: '#393d49',
                        jump: function (obj, first) { //触发分页后的回调
                            if (!first) { //点击跳页触发函数自身，并传递当前页：obj.curr
                                getPage(obj.curr);
                            }
                        }
                    });
                }
            });
        } else if (getPages == 1 && first == 0) {
            $.ajax({
                type: 'get',
                url: urls,
                data: {'p': 1, 'first': 1},
                dataType: "html",
                success: function (data) {
                    $("#include-page").html(data);
                    laypage({
                        cont: 'pagenation', //容器。值支持id名、原生dom对象，jquery对象。【如该容器为】：<div id="page1"></div>
                        pages: counts, //通过后台拿到的总页数
//                        groups: 3,
                        skip: false,
                        skin: '#393d49',
                        curr: curr || 1, //当前页
                        jump: function (obj, first) { //触发分页后的回调
                            if (!first) { //点击跳页触发函数自身，并传递当前页：obj.curr
                                getPage(obj.curr);
                            }
                        }
                    });
                }
            });
        }

    }

    //tablesorter的初始化
    $(document).ready(function () {
        //没有对应插件
                $("#myTable").tablesorter();
            }
    );

    //编辑弹框
    $(".editer-btn").on("click", function () {

        var editid = $(this).attr('editid');
        var urls = "<?php echo e(route('_selectUser')); ?>";
        $.ajax({
            type: 'get',
            url: urls,
            data: {'editid': editid},
            dataType: "json",
            success: function (data) {
                $("#fm_name").val(data.name);
                $("#fm_username").val(data.username);
                $("#fm_mobile").val(data.mobile);
                $("#fm_email").val(data.email);
                $("#fm_id").val(data.id);
            }
        });

        index = layer.open({
            type: 1,
            title: '修改',
            shadeClose: true,
            shade: 0.5,
            area: ['600px', '70%'],
            content: $("#notice-box")    //iframe的url
        });
    });
    //删除弹框
    $(".del-btn").on("click", function () {

        var _that = $(this);
        var delid = $(this).attr('delid');
        var urls = "<?php echo e(route('_delid')); ?>";

        layer.confirm('确认删除？', {
            btn: ['确认', '取消'] //按钮
        }, function () {
//            alert(1);
            $.ajax({
                type: 'get',
                url: urls,
                data: {'delid': delid},
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        $("#off" + delid).html('关闭');
                        layer.msg('修改成功', {icon: 1});
                        
                    } else {
                        layer.msg('请勿重新操作', {icon: 2});
                    }

                }
            });

        }, function () {
//            layer.msg('也可以这样', {
//                time: 10, //20s后自动关闭
////                btn: ['明白了', '知道了']
//            });
        });

    });

    //添加弹框
    $(".addmember").on("click", function () {
        _add = layer.open({
            type: 1,
            title: '新增会员',
            shadeClose: true,
            shade: 0.5,
            area: ['600px', '70%'],
            content: $("#add-box")    //iframe的url
        });
    });
    function fm_add() {

        var _name = $("#fma_name").val(),
                _username = $("#fma_username").val(),
                _mobile = $("#fma_mobile").val(),
                _password = $("#fma_password").val(),
                _email = $("#fma_email").val();

        var data = {
            "name": _name,
            "username": _username,
            "mobile": _mobile,
            "email": _email,
            "password": _password

        };
        var _data = JSON.stringify(data);

        if (!_name || !_password) {
            layer.alert('用户名,会员名字,密码不能为空');
            return false;
        }

        var urls = "<?php echo e(route('_addUser')); ?>";
        $.ajax({
            type: 'post',
            url: urls,
            data: {"data": _data, "_token": "<?php echo e(csrf_token()); ?>"},
            dataType: "json",
            success: function (data) {
                // layer.alert(JSON.stringify(data));

                if (data.status == 1) {
                    layer.close(_add);
                    $.ajax({
                        type: 'get',
                        url: '<?php echo e(route('_member-list')); ?>',
                        dataType: "html",
                        success: function (data) {
                            $("#include-page").html(data);

                        }
                    });


/*                    layer.close(_add);
                    layer.confirm('新增成功,是否现在刷新页面', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        window.location.reload();
                    });*/

                    //setTimeout(function () {window.location.reload();}, 1000);
                }
                if (data.status == 2) {
                    //                    layer.alert(JSON.stringify(data));
                    layer.alert(data.message);
                    //                    setTimeout(function(){layer.close(_add);}, 500);
                }
            }
        });
    }


</script>
