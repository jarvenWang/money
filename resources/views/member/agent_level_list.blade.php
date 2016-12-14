{{--<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css">--}}
<div class="in-curpage-wrap">
    <a href="#">报表</a> —>
    <a href="#" class="in-curpage-active">代理层级</a>
</div>
<!-- module section start -->
<div class="in-content-wrap">
    <!-- 搜索条件  -->
    <div class="in-search-box clearfix">
        <select class="in-search-sel">
            <option>会员账号</option>
            <option>游戏单号</option>
            <option>游戏局数</option>
        </select>
        <input type="text" value="" class="in-search-input">

        <div class="in-datachoose-box">
            <input onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="laydate-icon">-<input
                    onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="laydate-icon">
        </div>
        <select class="in-search-sel">
            <option>选择排序</option>
            <option>投注金额</option>
            <option>投注时间</option>
        </select>
        <select class="in-search-sel">
            <option>每页15条</option>
            <option>每页30条</option>
            <option>每页50条</option>
            <option>每页100条</option>
        </select>
        <a href="javascript:;" class="com-searchbtn com-btn-color01 in-search-btn">确认</a>
        <a href="javascript:;" class="com-searchbtn com-btn-color02 in-search-btn  ml5 addmember">添加</a>
    </div>
    <!-- //搜索条件 -->
    <!-- 总计 -->
    <div class="in-total-box">
        <a href="#" class="in-member-num">
            vip会员人数:<span>10000</span>
        </a>
        <a href="#" class="in-member-num">
            在线会员人数:<span>10000</span>
        </a>
        <a href="#" class="in-member-num">
            危险会员人数:<span>10000</span>
        </a>
        <a href="#" class="in-member-num">
            会员总额:<span>10000</span>
        </a>
    </div>
    <!--  //总计 -->
    <!-- 列表数据  -->
    <table id="myTable" class="tablesorter table  table-bordered ">
        <thead>
        <tr>
            <th align="center">ID</th>
            <th align="center">姓名</th>
            <th align="center">分成方式</th>
            <th align="center">反水比例</th>
            <th align="center">分成比例</th>
            <th align="center">专属服务</th>
            <th align="center">此层级代理数</th>
            <th align="center">添加此层级的管理员用户名</th>
            <th align="center">添加时间</th>
            <th align="center">更新时间</th>
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
        <?php $type = ['占成和反水', '占成','反水'];?>
        @forelse($data  as $d)
            <tr>
                <td align="center" id="levelid{{ $d->id }}">{{ $d->id }}</td>
                <td align="center" id="name{{ $d->id }}">{{ $d->name }}</td>
                <td align="center" id="type{{ $d->id }}">{{ $type[$d->type] }}</td>
                <td align="center" id="fandian{{ $d->id }}">{{ $d->fandian or 0 }}</td>
                <td align="center" id="fencheng{{ $d->id }}">{{ $d->fencheng or 0 }}</td>
                <td align="center" id="total{{ $d->id }}">{{ $d->total }}</td>
                <td align="center" id="private_service{{ $d->id }}">{{ $d->private_service }}</td>
                <td align="center" id="created_by{{ $d->id }}">{{ $d->created_by }}</td>
                <td align="center" id="created_at{{ $d->id }}">{{ $d->created_at }}</td>
                <td align="center" id="updated_at{{ $d->id }}">{{ $d->updated_at }}</td>
                <td align="center">
                    <a href="javascript:;" class="com-smallbtn com-btn-color01 editer-btn" editid="{{ $d->id }}">编辑</a>
                    <a href="javascript:;" class="com-smallbtn com-btn-color02 ml5 del-btn" delid="{{ $d->id }}">关闭</a>
                </td>
            </tr>
        @empty

            <tr align="center">
                <td align="center" colspan="11">没有数据</td>
            </tr>

        @endforelse


        </tbody>
    </table>
    <!-- //列表数据  -->
    <!-- 小计 -->
    <div class="in-total-box">
        <a href="#" class="in-member-num">
            vip会员人数:<span>100</span>
        </a>
        <a href="#" class="in-member-num">
            在线会员人数:<span>100</span>
        </a>
        <a href="#" class="in-member-num">
            危险会员人数:<span>100</span>
        </a>
        <a href="#" class="in-member-num">
            会员总额:<span>100</span>
        </a>
    </div>
    <!--  //小计 -->
    <!-- 分页按钮 -->
    <div id="pagenation">

    </div>
    {{--{{ $data->links() }}--}}
    <!-- //分页按钮 -->


    <!-- 编辑弹框 -->
    <div  class="notice-editorbox" id="notice-box" style="display:none">


            <div class="notice-con-box">

                    <div class="com-form-wrap">
                        <!-- input -->
                        <div class="com-form-group clearfix">
                            <label class="com-form-l com-fl com-lh">会员层级名称：</label>
                            <div class="com-form-r com-fl">
                                <input type="text"  id="fm_name" name="data[name]" class="com-input-text">
                            </div>
                        </div>
                        <!-- //input -->
                        <!-- input -->
                        <div class="com-form-group clearfix">
                            <label class="com-form-l com-fl com-lh">分成方式：</label>
                            <div class="com-form-r com-fl">
                                <input type="text" id="fm_type" name="data[type]" class="com-input-text">
                            </div>
                        </div>
                        <!-- //input -->
                        <!-- input -->
                        <div class="com-form-group clearfix">
                            <label class="com-form-l com-fl com-lh">反水比例：</label>
                            <div class="com-form-r com-fl">
                                <input type="text" id="fm_fandian" name="data[fandian]" class="com-input-text">
                            </div>
                        </div>
                        <div class="com-form-group clearfix">
                            <label class="com-form-l com-fl com-lh">分成比例：</label>
                            <div class="com-form-r com-fl">
                                <input type="text" id="fm_fencheng" name="data[fencheng]" class="com-input-text">
                            </div>
                        </div>
                        <!-- //input -->
                        <!-- input -->
                        <div class="com-form-group clearfix">
                            <label class="com-form-l com-fl com-lh">专属服务(优惠)：</label>
                            <div class="com-form-r com-fl">
                                <input type="text" id="fm_private_service" name="data[private_service]" class="com-input-text">
                            </div>
                        </div>
                        <!-- //input -->
                        <!-- input -->
                        <div class="com-form-group clearfix">
                            <label class="com-form-l com-fl com-lh">代理数：</label>
                            <div class="com-form-r com-fl">
                                <input type="text" id="fm_total" name="data[total]" class="com-input-text">
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
                        <label class="com-form-l com-fl com-lh">会员层级名称：</label>
                        <div class="com-form-r com-fl">
                            <input type="text"  id="fma_name" name="data[name]" class="com-input-text">
                        </div>
                    </div>
                    <!-- //input -->

                    <!-- input -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl com-lh">分成方式：</label>
                        <div class="com-form-r com-fl">
                            <input type="text" id="fma_type" name="data[type]" class="com-input-text">
                        </div>
                    </div>
                    <!-- //input -->
                    <!-- input -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl com-lh">反水比例：</label>
                        <div class="com-form-r com-fl">
                            <input type="text" id="fma_fandian" name="data[fandian]" class="com-input-text">
                        </div>
                    </div>
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl com-lh">分成比例：</label>
                        <div class="com-form-r com-fl">
                            <input type="text" id="fma_fencheng" name="data[fencheng]" class="com-input-text">
                        </div>
                    </div>
                    <!-- //input -->
                    <!-- input -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl com-lh">专属服务(优惠)：</label>
                        <div class="com-form-r com-fl">
                            <input type="text" id="fma_private_service" name="data[private_service]" class="com-input-text">
                        </div>
                    </div>
                    <!-- //input -->
                    <!-- input -->

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
    var type=["占城和反水","占城","反水"];

    //填出表单提交事件
    function fm_submit() {

        var     _id = $("#fm_id").val(),
                _name = $("#fm_name").val(),
                _type = $("#fm_type").val(),
                _fandian = $("#fm_fandian").val(),
                _fencheng = $("#fm_fencheng").val(),
                _private_service = $("#fm_private_service").val();
                _total = $("#fm_total").val();
                _created_by = $("#fm_created_by").val();

        var data = {
            "id":_id,
            "name": _name,
            "type": _type,
            "fencheng": _fencheng,
            "fandian": _fandian,
            "private_service": _private_service,
            "total": _total,
            "created_by": _created_by
        };
        var _data = JSON.stringify(data);
        var urls = "{{ route('_changeAgnetLevel') }}";
        $.ajax({
            type: 'get',
            url: urls,
            data: {"data": _data},
            dataType: "json",
            success: function (data) {

                if (data.status == 1) {
                    $("#name" + data.id).text(data.name);
                    $("#type" + data.id).text(data.flag);
                    $("#fandian" + data.id).text(data.fandian);
                    $("#fencheng" + data.id).text(data.fencheng);
                    $("#private_service" + data.id).text(data.private_service);
                    $("#total" + data.id).text(data.total);
                    $("#created_by" + data.id).text(data.created_by);
                    $("#updated_at" + data.id).text(data.updated_at);
                    setTimeout(function () {
                        layer.close(index);
                    }, 500);

                }

            }
        });
    }

    // laypage 添加分页功能
    getPage({{ $page or 1 }});
    //layer分页函数
    function getPage(curr) {
        var page = curr || 1;
//        获取服务器传过来的第几页
        var getPages ={{ $page or 1 }};
        var first ={{ $first or 0 }};
        var counts ={{ $count }};


        var urls = "{{ route('_member-agent-level') }}";

        if (page != getPages) {
            $.ajax({
                type: 'get',
                url: urls,
                data: {'p': curr},

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
        var urls = "{{ route('_selectAgentLevel') }}";
        $.ajax({
            type: 'get',
            url: urls,
            data: {'editid': editid},
            dataType: "json",
            success: function (data) {
//                var type={"0":"占城和反水","1":"占城","2":"反水"};
                var type=["占城和反水","占城","反水"];
                var flag=data.type;
                $("#fm_id").val(data.id);
                $("#fm_name").val(data.name);
//                $("#fm_type").val(type[flag]);
                $("#fm_type").val(data.type);
                $("#fm_fandian").val(data.fandian);
                $("#fm_fancheng").val(data.fancheng);
                $("#fm_private_service").val(data.private_service);
                $("#fm_total").val(data.total);
                $("#fm_created_by").val(data.created_by);
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

        var urls = "{{ route('_delid') }}";

        layer.confirm('确认删除？', {
            btn: ['确认', '取消'] //按钮
        }, function () {
            layer.alert('暂无操作');
//            alert(1);
/*            $.ajax({
                type: 'get',
                url: urls,
                data: {'delid': delid},
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        $("#off" + delid).html('关闭');
                        layer.msg('修改成功', {icon: 1});
                        {{--getPage({{ $page or 1 }});--}}
                    } else {
                        layer.msg('请勿重新操作', {icon: 2});
                    }

                }
            });*/

        }, function () {
            layer.alert('原来取消了');

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
        var     _name = $("#fma_name").val(),
                _type = $("#fma_type").val(),
                _fandian = $("#fma_fandian").val(),
                _fencheng = $("#fma_fencheng").val(),
                _reseller_id = $("#fma_reseller_id").val(),
                _private_service = $("#fma_private_service").val();


/*        var _name = $("#fma_name").val(),
                _username = $("#fma_username").val(),
                _mobile = $("#fma_mobile").val(),
                _password = $("#fma_password").val(),
                _email = $("#fma_email").val();*/

        var data = {
            "name": _name,
            "type": _type,
            "fencheng": _fencheng,
            "fandian": _fandian,
            "reseller_id": _reseller_id,
            "private_service": _private_service
        };

        var _data = JSON.stringify(data);

        if (!_name || !_type) {
            layer.alert('层级名称,返点类型,不能为空');

            return false;
        }

        var urls = "{{ route('_addAgentLevel') }}";
        $.ajax({
            type: 'post',
            url: urls,
            data: {"data": _data, "_token": "{{  csrf_token() }}"},
            dataType: "json",
            success: function (data) {
                // layer.alert(JSON.stringify(data));

                if (data.status == 1) {
                    layer.close(_add);

                    layer.confirm('新增成功,是否现在刷新页面', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        window.location.reload();
                    });

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
