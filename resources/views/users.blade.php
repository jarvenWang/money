@extends('layouts.master')
@section('title', '后台管理系统')
@section('content')
    <div class="in-curpage-wrap">
        <a href="#">设置</a> —>
        <a href="#" class="in-curpage-active">管理员列表</a>
    </div>
    <!-- module section start -->
    <div class="in-content-wrap">
        <!-- 搜索条件  -->
        <div class="in-search-box clearfix">
            <select  class="in-search-sel">
                <option>管理员账号</option>
                <option>游戏单号</option>
                <option>游戏局数</option>
            </select>
            <input type="text" value=""  class="in-search-input" >
            <div class="in-datachoose-box">
                <input onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  class="laydate-icon">-<input onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" class="laydate-icon">
            </div>
            <select class="in-search-sel">
                <option>选择排序</option>
                <option>投注金额</option>
                <option>投注时间</option>
            </select >
            <select class="in-search-sel">
                <option>每页15条</option>
                <option>每页30条</option>
                <option>每页50条</option>
                <option>每页100条</option>
            </select>
            <a href="javascript:;"  class="com-searchbtn com-btn-color01 in-search-btn">确认</a>
            <a href="javascript:;"  class="com-searchbtn com-btn-color02 in-search-btn  ml5 addmember">添加</a>
            <a href="/add-user"  class="com-searchbtn com-btn-color02 in-search-btn  ml5 addmember">添加管理员</a>
        </div>
        <!-- //搜索条件 -->
        <!-- 总计 -->
        <div class="in-total-box">
            <a  href="#" class="in-member-num">
                vip会员人数:<span>10000</span>
            </a>
            <a  href="#" class="in-member-num">
                在线会员人数:<span>10000</span>
            </a>
            <a  href="#" class="in-member-num">
                危险会员人数:<span>10000</span>
            </a>
            <a href="#"  class="in-member-num">
                会员总额:<span>10000</span>
            </a>
        </div>
        <!--  //总计 -->
        <!-- 列表数据  -->
        <table  id="myTable" class="tablesorter table  table-bordered ">
            <thead>
            <tr>
                <th align="center">姓名</th>
                <th align="center">用户名</th>
                <th align="center">用户组</th>
                <th class="col-sm-2">操作</th>
            </tr>
            </thead>
            <!-- <tbody>
                <tr align="center">
                    <td align="center" colspan="11">没有数据</td>
                </tr>
            </tbody> -->
            <tbody>
            <tr >
            @foreach ($datas as $data)
                <tr>
                    <td align="center">{{$data->name}}</td>
                    <td align="center">{{$data->username}}</td>
                    {{--<td align="center">@if(isset($data->roles->name)){{$data->roles->name}}@endif</td>--}}
                    <td align="center">222222</td>
                    <td align="center"><a href="/edit-user?id={{$data->id}}" class="com-smallbtn com-btn-color01 editer-btn">编辑</a><a href="/deleteUser?id={{$data->id}}" class=" com-smallbtn com-btn-color02 ml5 del-btn">删除</a></td>

                </tr>
            @endforeach

            </tr>

            </tbody>
        </table>
        <!-- //列表数据  -->
        <!-- 小计 -->
        <div class="in-total-box">
            <a  href="#" class="in-member-num">
                vip会员人数:<span>100</span>
            </a>
            <a  href="#" class="in-member-num">
                在线会员人数:<span>100</span>
            </a>
            <a  href="#" class="in-member-num">
                危险会员人数:<span>100</span>
            </a>
            <a href="#"  class="in-member-num">
                会员总额:<span>100</span>
            </a>
        </div>
        <!--  //小计 -->
        <!-- 分页按钮 -->
        <div id="pagenation">

        </div>
        <!-- //分页按钮 -->

        <!-- 编辑弹框 -->
        <div  class="notice-editorbox" id="notice-box" style="display: none;">
            <div class="notice-con-box">
                <form>
                    <div class="com-form-wrap">
                        <!-- input -->
                        <div class="com-form-group clearfix">
                            <label class="com-form-l com-fl com-lh">性别：</label>
                            <div class="com-form-r com-fl">
                                <input type="text" class="com-input-text">
                            </div>
                        </div>
                        <!-- //input -->
                        <!-- input -->
                        <div class="com-form-group clearfix">
                            <label class="com-form-l com-fl com-lh">性别：</label>
                            <div class="com-form-r com-fl">
                                <input type="text" class="com-input-text">
                            </div>
                        </div>
                        <!-- //input -->
                        <!-- input -->
                        <div class="com-form-group clearfix">
                            <label class="com-form-l com-fl com-lh">性别：</label>
                            <div class="com-form-r com-fl">
                                <input type="text" class="com-input-text">
                            </div>
                        </div>
                        <!-- //input -->
                        <!-- input -->
                        <div class="com-form-group clearfix">
                            <label class="com-form-l com-fl com-lh">性别：</label>
                            <div class="com-form-r com-fl">
                                <input type="text" class="com-input-text">
                            </div>
                        </div>
                        <!-- //input -->
                        <!-- button -->
                        <div class="com-form-group clearfix">
                            <label class="com-form-l com-fl"></label>
                            <div class="com-form-r com-fl">
                                <a href="javascript:;" class="com-bigbtn com-btn-color02 ">确认</a>
                            </div>
                        </div>
                        <!-- //button -->
                    </div>
                </form>
            </div>
        </div>
        <!-- //编辑弹框 -->
    </div>
    <!-- module section end  -->
    <script type="text/javascript">
        //分页插件初始化
        laypage({
            cont: $('#pagenation'), //容器。值支持id名、原生dom对象，jquery对象,
            pages: 100, //总页数
            skip: true, //是否开启跳页
            skin: '#AF0000',
            groups: 3 //连续显示分页数
        });

        //tablesorter的初始化
        $(document).ready(function()
                {
                    $("#myTable").tablesorter();
                }
        );

        //编辑弹框
        $(".editer-btn").on("click",function(){
            layer.open({
                type: 1,
                title: '公告修改',
                shadeClose: true,
                shade: 0.5,
                area: ['600px', '70%'],
                content: $("#notice-box")    //iframe的url
            });
        })
        //删除弹框
        $(".del-btn").on("click",function(){
            layer.confirm('确认删除？', {
                btn: ['确认','取消'] //按钮
            });
        })

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
@endsection