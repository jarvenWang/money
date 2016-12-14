{{--<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css">--}}
<div class="in-curpage-wrap">
    <a href="#">常规</a> —>
    <a href="#">公告</a> —>
    <a href="#" class="in-curpage-active">公告列表</a>
</div>
<!-- module section start -->
<div class="in-content-wrap">
    <!-- 搜索条件  -->
    <div class="in-search-box clearfix">
        <form action="{{ route('_noticeList') }}" method="get">
            <select class="in-search-sel">
                <option>标题</option>
            </select>
            <input type="text" value="{{ $title }}" name="title" class="in-search-input">
            <div class="in-datachoose-box">
                <input name="start_time"  value="{{ $startTime }}" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="laydate-icon">-
                <input name="end_time" value="{{ $endTime }}"  onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="laydate-icon">
            </div>
            <select class="in-search-sel" name="order">
                <option >选择排序</option>
                <option value="created_at" >发布时间</option>
                <option value="deleted_at" >过期时间</option>
            </select>
            <select class="in-search-sel" name="limit" >
                <option value="15">每15条</option>
                <option value="30" >每页30条</option>
                <option value="50" >每页50条</option>
                <option value="100" >每页100条</option>
            </select>
            <button type="submit" class="com-searchbtn com-btn-color01 in-search-btn">确认</button>
            <a href="javascript:;" class="com-searchbtn com-btn-color02 in-search-btn  ml5 addnotice">添加</a>
        </form>
    </div>
    <script>
        $('form').ajaxForm(function ($message) {
            $("#include-page").html($message);
        });
    </script>
    <!-- //搜索条件 -->
    <!-- 列表数据  -->
    <table id="myTable" class="tablesorter table  table-bordered ">
        <thead>
        <tr>
            <th align="center">ID</th>
            <th align="center">公告标题</th>
            <th align="center">发布时间</th>
            <th align="center">过期时间</th>
            <th align="center">显示设备</th>
            <th align="center">公告类别</th>
            <th align="center">操作</th>
        </tr>
        </thead>
        <tbody id="trJson">
        @forelse($data  as $d)
            <tr id="row_{{ $d->id }}">
                <td align="center" id="{{ $d->id }}">{{ $d->id }}</td>
                <td align="center" id="title{{ $d->id }}">{{ $d->title }}</td>
                <td align="center" id="created_at{{ $d->id }}">{{ $d->created_at }}</td>
                <td align="center" id="deleted_at{{ $d->id }}">{{ $d->deleted_at }}</td>
                <td align="center" id="display_where{{ $d->id }}">{{ $display_where[$d->display_where] }}</td>
                <td align="center" id="display_type{{ $d->id }}">{{ $display_type[$d->display_type] }}</td>
                <td align="center">
                    <a href="javascript:;" class="com-smallbtn com-btn-color01 editer-btn" editid="{{ $d->id }}">编辑</a>
                    <a href="javascript:;" class="com-smallbtn com-btn-color02 ml5 del-btn" delid="{{ $d->id }}">删除</a>
                </td>
            </tr>
        @empty

            <tr align="center" id="no_data">
                <td align="center" colspan="11">没有数据</td>
            </tr>

        @endforelse
        </tbody>
    </table>
    <!-- //列表数据  -->
    <!-- 分页按钮 -->
    <div id="pagenation">

    </div>
    {{--{{ $data->links() }}--}}
            <!-- //分页按钮 -->


    <!-- 编辑弹框 -->
    <div  class="notice-editorbox" id="edit_notice-box" style="display:none;">
        <div class="notice-con-box">
            <form>
                <div class="com-form-wrap">
                    <!-- input -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl com-lh">公告标题：</label>
                        <div class="com-form-r com-fl">
                            <input type="text" id="fm_title" name="data[title]" class="com-input-text">
                        </div>
                    </div>
                    <!-- //input -->
                    <!-- textarea -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl com-lh">公告内容：</label>
                        <div class="com-form-r com-fl">
                            <textarea id="fm_content" class="com-textarea" name="data[content]"></textarea>
                        </div>
                    </div>
                    <!-- //textarea -->
                    <!-- input -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl com-lh">过期时间：</label>
                        <div class="com-form-r com-fl">
                            <input type="text" id="fm_deleted_at" name="data[deleted_at]"  value="" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="com-input-text">
                        </div>
                    </div>
                    <!-- //input -->
                    <!-- select -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl com-lh">设备类型：</label>
                        <div class="com-form-r com-fl">
                            <select class="com-select" id="fm_display_where" name="data[display_where]">
                                @foreach ($display_where as $key => $dw)
                                    <option value="{{$key}}" >{{$dw}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- //select -->
                    <!-- select -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl com-lh">显示方式：</label>
                        <div class="com-form-r com-fl">
                            <select class="com-select" id="fm_display_type" name="data[display_type]">
                                @foreach ($display_type as $key => $dt)
                                    <option value="{{$key}}" >{{$dt}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- //select -->
                    <input type="hidden" name="data[id]" id="fm_id">
                    <!-- button -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl"></label>
                        <div class="com-form-r com-fl">
                            <button onclick="return fm_submit()" class="com-bigbtn com-btn-color02 ">确认</button>
                        </div>
                    </div>
                    <!-- //button -->
                </div>
            </form>
        </div>
    </div>
    <!-- //编辑弹框 -->
    <!-- 添加弹框 start -->
    <div  class="notice-editorbox" id="add_notice-box" style="display:none">
        <div class="notice-con-box">
            <form>
                <div class="com-form-wrap">
                    <!-- input -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl com-lh">公告标题：</label>
                        <div class="com-form-r com-fl">
                            <input type="text"  id="fma_title" name="data[title]" class="com-input-text">
                        </div>
                    </div>
                    <!-- //input -->
                    <!-- textarea -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl com-lh">公告内容：</label>
                        <div class="com-form-r com-fl">
                            <textarea id="fma_content" class="com-textarea" name="data[content]"></textarea>
                        </div>
                    </div>
                    <!-- //textarea -->
                    <!-- input -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl com-lh">过期时间：</label>
                        <div class="com-form-r com-fl">
                            <input type="text" id="fma_deleted_at" name="data[deleted_at]" value="" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="com-input-text">
                        </div>
                    </div>
                    <!-- //input -->
                    <!-- select -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl com-lh">显示设备类型：</label>
                        <div class="com-form-r com-fl">
                            <select class="com-select" id="fma_display_where" name="data[display_where]">
                                @foreach ($display_where as $key => $dw)
                                    <option value="{{$key}}" >{{$dw}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- //select -->
                    <!-- select -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl com-lh">显示方式：</label>
                        <div class="com-form-r com-fl">
                            <select class="com-select" id="fma_display_type" name="data[display_type]">
                                @foreach ($display_type as $key => $dt)
                                    <option value="{{$key}}" >{{$dt}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- //select -->
                    <input type="hidden" name="data[id]" id="fma_id">
                    <!-- button -->
                    <div class="com-form-group clearfix">
                        <label class="com-form-l com-fl"></label>
                        <div class="com-form-r com-fl">
                            <button class="com-bigbtn com-btn-color02 " onclick="return fm_add()">确认</button>
                        </div>
                    </div>
                    <!-- //button -->
                </div>
            </form>
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
        var _title = $("#fm_title").val(),
                _content = $("#fm_content").val(),
                _display_where = $("#fm_display_where").val(),
                _display_type = $("#fm_display_type").val(),
                _deleted_at = $("#fm_deleted_at").val(),
                _id = $("#fm_id").val();
        var data = {
            "title": _title,
            "content": _content,
            "display_where": _display_where,
            "display_type": _display_type,
            "deleted_at": _deleted_at,
            "id": _id
        };
        var _data = JSON.stringify(data);
        if (!_title || !_content || !_deleted_at) {
            layer.alert('标题,内容,过期时间不能为空');
            return false;
        }
        var urls = "{{ route('_changeNotice') }}";
        $.ajax({
            type: 'get',
            url: urls,
            data: {"data": _data},
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    $("#title" + data.id).text(data.title);
                    $("#content" + data.id).text(data.content);
                    $("#display_where" + data.id).text(data.display_where);
                    $("#display_type" + data.id).text(data.display_type);
                    $("#deleted_at" + data.id).text(data.deleted_at);
                    $("#id" + data.id).text(data.id);
                    setTimeout(function () {
                        layer.close(index);
                    }, 500);

                }
            }
        });
        return false;
    }

    // laypage 添加分页功能
    @if($page!=1)
    getPage({{ $page }});
    @else
    page_init();
    @endif
    function page_init(){
        var counts ={{ $count or 0 }};
        laypage({
            cont: 'pagenation', //容器。值支持id名、原生dom对象，jquery对象。【如该容器为】：<div id="page1"></div>
            pages: counts, //通过后台拿到的总页数
            curr:  1, //当前页
            skip: false,
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
        var getPages ={{ $page or 1 }};
        var first ={{ $first or 0 }};
        var counts ={{ $count }};
        var urls = "{{ route('_noticeList') }}";
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
        var urls = "{{ route('_selectNotice') }}";
        $.ajax({
            type: 'get',
            url: urls,
            data: {'editid': editid},
            dataType: "json",
            success: function (data) {
                $("#fm_title").val(data.title);
                $("#fm_content").val(data.content);
                $("#fm_display_where").val(data.display_where);
                $("#fm_display_type").val(data.display_type);
                $("#fm_deleted_at").val(data.deleted_at);
                $("#fm_id").val(data.id);
            }
        });

        index = layer.open({
            type: 1,
            title: '修改',
            shadeClose: true,
            shade: 0.5,
            area: ['600px', '70%'],
            content: $("#edit_notice-box")    //iframe的url
        });
    });
    //删除弹框
    $(".del-btn").on("click", function () {

        var _that = $(this);
        var delid = $(this).attr('delid');
        var urls = "{{ route('_delNotice') }}";
        layer.confirm('确认删除？', {
            btn: ['确认', '取消'] //按钮
        }, function () {
            $.ajax({
                type: 'get',
                url: urls,
                data: {'delid': delid},
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        $("#row_"+ delid).hide();
                        layer.msg('删除成功', {icon: 1});
                    } else {
                        layer.msg('请勿重新操作', {icon: 2});
                    }
                }
            });

        }, function () {

        });

    });

    //添加弹框
    $(".addnotice").on("click", function () {
        _add = layer.open({
            type: 1,
            title: '新增公告',
            shadeClose: true,
            shade: 0.5,
            area: ['600px', '70%'],
            content: $("#add_notice-box")  //iframe的url
        });
    });
    function fm_add() {
        var _title = $("#fma_title").val(),
                _content = $("#fma_content").val(),
                _display_where = $("#fma_display_where").val(),
                _display_type = $("#fma_display_type").val(),
                _deleted_at = $("#fma_deleted_at").val();
        var data = {
            "title": _title,
            "content": _content,
            "display_where": _display_where,
            "display_type": _display_type,
            "deleted_at": _deleted_at

        };
        var _data = JSON.stringify(data);
        if (!_title || !_content || !_deleted_at) {
            layer.alert('标题,内容,过期时间不能为空');
            return false;
        }
        var urls = "{{ route('_addNotice') }}";
        $.ajax({
            type: 'post',
            url: urls,
            data: {"data": _data, "_token": "{{  csrf_token() }}"},
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    layer.close(_add);
                    $.get(
                            '{{ route('_noticeList') }}','',function(d){
                                $("#include-page").html(d);
                            }
                    );
                }
                if (data.status == 2) {
                    layer.alert(data.message);
                }
            }
        });
        return false;
    }

</script>
