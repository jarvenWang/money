
    <div class="in-curpage-wrap">
        <a href="#">常规</a> —>
        <a href="#" class="in-curpage-active">设置</a>
    </div>
    <!-- module routine-setting  -->
    <div class="in-content-wrap">
        <div id="tabs">
            <ul class="tab-title clearfix">
                <li class="tabulous_active">用户管理</li>
                <li>角色管理</li>
                <li>权限管理</li>
                <li>添加角色</li>
                <li>添加用户</li>

                <li>添加权限</li>
            </ul>
            <div id="tabs_container" class="routine-tab-wrap">
                <div id="tabs-1" class="tab-itembox">
                    <form>
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
                                    <td align="center">{{$data->display_name}}</td>
                                    <td align="center"><a onclick="edituser('{{$data->id}}')" class="com-smallbtn com-btn-color01 editer-btn">编辑</a><a onclick="deluser({{$data->id}})" class=" com-smallbtn com-btn-color02 ml5 del-btn">删除</a></td>
                                    <!-- //编辑弹框 -->

                                    <div  class="notice-editorbox{{$data->id}}" style="display: none;">
                                        <div class="notice-con-box">
                                            <form>
                                                <div class="com-form-wrap">
                                                    <!-- input -->
                                                    <input type="hidden" name="edit_id" value="{{$data->id}}"  class="com-input-text id{{$data->id}}">
                                                    <div class="com-form-group clearfix">
                                                        <label class="com-form-l com-fl com-lh">姓名：</label>
                                                        <div class="com-form-r com-fl">
                                                            <input type="text" value="{{$data->name}}" class="com-input-text name{{$data->id}}">
                                                        </div>
                                                    </div>
                                                    <!-- //input -->
                                                    <!-- input -->
                                                    <div class="com-form-group clearfix">
                                                        <label class="com-form-l com-fl com-lh">用户名：</label>
                                                        <div class="com-form-r com-fl">
                                                            <input type="text" value="{{$data->username}}" class="com-input-text username{{$data->id}}">
                                                        </div>
                                                    </div>
                                                    <!-- //input -->
                                                    <!-- input -->
                                                    <div class="com-form-group clearfix">
                                                        <label class="com-form-l com-fl com-lh">密码：</label>
                                                        <div class="com-form-r com-fl">
                                                            <input type="password" value="{{$data->password}}" class="com-input-text password{{$data->id}}">
                                                        </div>
                                                    </div>
                                                    <!-- //input -->
                                                    <div class="com-form-group clearfix">
                                                        <label class="com-form-l com-fl com-lh" >权限组：</label>
                                                        <div class="com-form-r com-fl">
                                                            <select  class="com-select role{{$data->id}}">
                                                                @foreach ($status as $k)
                                                                    @if($k->id == $data->roleid)
                                                                        <option value="{{$k->id}}" selected="selected">{{$k->display_name}}</option>
                                                                    @else
                                                                        <option value="{{$k->id}}">{{$k->display_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- button -->
                                                    <div class="com-form-group clearfix">
                                                        <label class="com-form-l com-fl"></label>
                                                        <div class="com-form-r com-fl">
                                                            <a type="submit"  class="com-bigbtn com-btn-color02 sub{{$data->id}}">确认</a>
                                                        </div>
                                                    </div>
                                                    <!-- //button -->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- //编辑弹框 -->


                                </tr>
                                @endforeach

                                </tr>

                            </tbody>
                        </table>
                        <!-- //列表数据  -->
                    </form>
                </div>
                <!-- // tab-1 -->
                <div id="tabs-2" class="tab-itembox" style="display: none;">
                    <form>
                        <!-- 列表数据  -->
                        <table  id="myTable" class="tablesorter table  table-bordered ">
                            <thead>
                            <tr>
                                <th align="center">角色名称</th>
                                <th align="center">显示角色</th>
                                <th align="center">描述</th>
                                {{--<th class="col-sm-2">所属经销商ID</th>--}}
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
                            @foreach ($roledata as $role)
                                <tr>
                                    <td align="center">{{$role['name']}}</td>
                                    <td align="center">{{$role['display_name']}}</td>
                                    {{--<td align="center">@if(isset($data->roles->name)){{$data->roles->name}}@endif</td>--}}
                                    <td align="center">{{$role['description']}}</td>
                                    {{--<td align="center">{{$role['reseller_id']}}</td>--}}

                                    <td align="center"><a onclick="editrole({{$role['id']}})" class="com-smallbtn com-btn-color01 editer-btn">编辑</a><a onclick="delrole('{{$role['id']}}')" class=" com-smallbtn com-btn-color02 ml5 del-btn">删除</a></td>
                                    <!-- //编辑弹框 -->

                                    <div  class="role-notice-editorbox{{$role['id']}}" style="display:none">

                                        <form>
                                            <div class="com-form-wrap">
                                                <!-- input -->
                                                <input type="hidden" name="edit_id" value="{{$role['id']}}"  class="com-input-text roleid{{$role['id']}}">
                                                <div class="com-form-group clearfix">
                                                    <label class="com-form-l com-fl com-lh">角色名称：</label>
                                                    <div class="com-form-r com-fl">
                                                        <input type="text" value="{{$role['name']}}" class="com-input-text rolename{{$role['id']}}">
                                                    </div>
                                                </div>
                                                <!-- //input -->
                                                <!-- input -->
                                                <div class="com-form-group clearfix">
                                                    <label class="com-form-l com-fl com-lh">显示角色：</label>
                                                    <div class="com-form-r com-fl">
                                                        <input type="text"  value="{{$role['display_name']}}" class="com-input-text roledisplayname{{$role['id']}}">
                                                    </div>
                                                </div>
                                                <!-- //input -->
                                                <!-- input -->
                                                <div class="com-form-group clearfix">
                                                    <label class="com-form-l com-fl com-lh">描述：</label>
                                                    <div class="com-form-r com-fl">
                                                        <textarea class="com-input-text description{{$role['id']}}">{{$role['description']}}</textarea>

                                                    </div>
                                                </div>
                                                <!-- input -->


                                                <!-- input -->
                                                <div class="com-form-group clearfix">

                                                    <div class="com-form-group clearfix">
                                                        <label class="com-form-l com-fl">权限节点：</label>
                                                        <div class="com-form-r com-fl  " >
                                                            <div class="com-ib">
                                                                <input type="checkbox" value="" disabled="disabled">
                                                                <label>标识符</label>
                                                                <label>名称</label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                   @foreach ($permission_data as $per)

                                                        @if (in_array($per->id,$role['perm_arr']))
                                                            <div class="com-form-group clearfix">
                                                                <label class="com-form-l com-fl"></label>
                                                                <div class="com-form-r com-fl  " >
                                                                    <div class="com-ib">
                                                                        <input type="checkbox" class="checked ischecked{{$role['id']}}" value="{{$per->id}}" >
                                                                        <label>{{$per->name}}</label>
                                                                        <label>{{$per->display_name}}</label>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="com-form-group clearfix">
                                                                <label class="com-form-l com-fl"></label>
                                                                <div class="com-form-r com-fl  " >
                                                                    <div class="com-ib">
                                                                        <input type="checkbox" class="ischecked{{$role['id']}}"  value="{{$per->id}}" >
                                                                        <label>{{$per->name}}</label>
                                                                        <label>{{$per->display_name}}</label>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        @endif

                                                    @endforeach

                                                </div>
                                                <!-- //input -->
                                                <!-- button -->
                                                <div class="com-form-group clearfix">
                                                    <label class="com-form-l com-fl"></label>
                                                    <div class="com-form-r com-fl">
                                                        <a type="submit"  class="com-bigbtn com-btn-color02 subrole{{$role['id']}}">确认</a>
                                                    </div>
                                                </div>
                                                <!-- //button -->
                                            </div>
                                        </form>
                                    </div>

                                    <!-- //编辑弹框 -->

                                </tr>
                                @endforeach

                                </tr>

                            </tbody>
                        </table>
                        <!-- //列表数据  -->
                    </form>
                </div>

                <!-- // tab-5 -->
                <div id="tabs-5" class="tab-itembox" style="display: none;">
                    <form>
                        <!-- 列表数据  -->
                        <table  id="myTable" class="tablesorter table  table-bordered ">
                            <thead>
                            <tr>
                                <th align="center">名称</th>
                                <th align="center">标识符</th>
                                <th align="center">描述</th>
                                <th class="col-sm-2">操作</th>
                                {{--* name : 权限英文名称,命名规则:以英文字母开头,英文、数字、横线(-)组成
                                * display_name : 显示名称,命名要求,须清晰表明权限的作用
                                * description : 权限详细说明--}}
                            </tr>
                            </thead>
                            <!-- <tbody>
                                <tr align="center">
                                    <td align="center" colspan="11">没有数据</td>
                                </tr>
                            </tbody> -->
                            <tbody>
                            <tr >
                            @foreach ($permission_data as $permission)
                                <tr>
                                    <td align="center">{{$permission->display_name}}</td>
                                    <td align="center">{{$permission->name}}</td>
                                    {{--<td align="center">@if(isset($data->roles->name)){{$data->roles->name}}@endif</td>--}}
                                    <td align="center">{{$permission->description}}</td>
                                    <td align="center"><a onclick="permssionedit('{{$permission->id}}')" class="com-smallbtn com-btn-color01 editer-btn">编辑</a><a onclick="delpermssion({{$permission->id}})" class=" com-smallbtn com-btn-color02 ml5 del-btn">删除</a></td>

                                    <!-- //编辑弹框 -->

                                    <div  class="permission-notice-editorbox{{$permission->id}}" style="display: none;">

                                        <form>
                                            <div class="com-form-wrap">
                                                <!-- input -->
                                                <input type="hidden" name="edit_id" value="{{$permission->id}}"  class="com-input-text permissionid{{$permission->id}}">
                                                <div class="com-form-group clearfix">
                                                    <label class="com-form-l com-fl com-lh">名称：</label>
                                                    <div class="com-form-r com-fl">
                                                        <input type="text" value="{{$permission->display_name}}" class="com-input-text permissiondisplayname{{$permission->id}}">
                                                    </div>
                                                </div>
                                                <!-- //input -->
                                                <!-- input -->
                                                <div class="com-form-group clearfix">
                                                    <label class="com-form-l com-fl com-lh">标识符：</label>
                                                    <div class="com-form-r com-fl">
                                                        <input type="text" value="{{$permission->name}}" class="com-input-text permissionname{{$permission->id}}">
                                                    </div>
                                                </div>
                                                <!-- //input -->
                                                <!-- input -->
                                                <div class="com-form-group clearfix">
                                                    <label class="com-form-l com-fl com-lh">描述：</label>
                                                    <div class="com-form-r com-fl">
                                                        <textarea class="com-input-text permissiondescription{{$permission->id}}">{{$permission->description}}</textarea>

                                                    </div>
                                                </div>
                                                <!-- input -->
                                                <!-- button -->
                                                <div class="com-form-group clearfix">
                                                    <label class="com-form-l com-fl"></label>
                                                    <div class="com-form-r com-fl">
                                                        <a type="submit"  class="com-bigbtn com-btn-color02 subpermission{{$permission->id}}">确认</a>
                                                    </div>
                                                </div>
                                                <!-- //button -->
                                            </div>
                                        </form>
                                    </div>

                                    <!-- //编辑弹框 -->
                                </tr>
                                @endforeach

                                </tr>

                            </tbody>
                        </table>
                        <!-- //列表数据  -->
                    </form>
                </div>
                <!-- // tab-2 -->
                <div id="tabs-3" class="tab-itembox" style="display: none;">
                    <form  name="loginForma" id="loginForma" method="post" action="/add-role">
                        <div class="com-form-wrap">
                            <!-- input -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">角色名称：</label>
                                <div class="com-form-r com-fl">
                                    <input type="text" name="name" class="com-input-text com-input-sizemid">
                                </div>
                            </div>
                            <!-- //input -->
                            <!-- input -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">显示名称：</label>
                                <div class="com-form-r com-fl">
                                    <input type="text" name="display_name" class="com-input-text">
                                </div>
                            </div>

                            <!-- textarea -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">角色说明：</label>
                                <div class="com-form-r com-fl">
                                    <textarea name="description" class="com-textarea"></textarea>
                                </div>
                            </div>
                            <!-- //textarea -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!-- input -->
                            <div class="com-form-group clearfix">

                                <div class="com-form-group clearfix">
                                    <label class="com-form-l com-fl">权限节点：</label>
                                    <div class="com-form-r com-fl  " >
                                        <div class="com-ib">
                                            <input type="checkbox" value="" disabled="disabled" >
                                            <label>标识符</label>
                                            <label>名称</label>
                                        </div>

                                    </div>
                                </div>
                                @foreach ($permission_all as $all)

                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl"></label>
                                        <div class="com-form-r com-fl  " >
                                            <div class="com-ib">
                                                <input type="checkbox" name="allpermisson[]"  value="{{$all->id}}" >
                                                <label>{{$all->name}}</label>
                                                <label>{{$all->display_name}}</label>
                                            </div>

                                        </div>
                                    </div>


                                @endforeach

                            </div>
                            <!-- //input -->
                            <!-- button -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl"></label>
                                <div class="com-form-r com-fl">
                                    <button type="submit" class="com-bigbtn com-btn-color02 ">确认</button>
                                </div>
                            </div>
                            <!-- //button -->
                        </div>
                    </form>
                </div>
                <!-- // tab-3 -->
                <div id="tabs-4" class="tab-itembox" style="display: none;">
                    <form  name="loginForm" id="loginForm" method="post" action="/add-user">
                        <div class="com-form-wrap">
                            <!-- input -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">姓名：</label>
                                <div class="com-form-r com-fl">
                                    <input type="text" name="name" class="com-input-text">
                                </div>
                            </div>
                            <!-- //input -->
                            <!-- input -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">用户名：</label>
                                <div class="com-form-r com-fl">
                                    <input type="text" name="username" class="com-input-text">
                                </div>
                            </div>
                            <!-- //input -->
                            <!-- input -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">密码：</label>
                                <div class="com-form-r com-fl">
                                    <input type="password" name="password" class="com-input-text">
                                </div>
                            </div>
                            <!-- //input -->
                            <!--  select -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh" >权限组：</label>
                                <div class="com-form-r com-fl">
                                    <select name="role_id" id="" class="com-select">
                                        <option value="0">请选择所属用户组</option>
                                        @foreach ($status as $k)
                                            <option value="{{$k->id}}">{{$k->display_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- //select -->

                            <!-- input -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">用户邮箱：</label>
                                <div class="com-form-r com-fl">
                                    <input type="email" name="email" class="com-input-text">
                                </div>
                            </div>
                            <!-- //input -->

                            <!-- radio -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl">允许登录：</label>
                                <div class="com-form-r com-fl">
                                    <div class="com-ib">
                                        <input type="radio" name="status" checked="checked">
                                        <label> 是</label>
                                    </div>
                                    <div class="com-ib ml5">
                                        <input type="radio" name="status">
                                        <label>否</label>
                                    </div>
                                </div>
                            </div>
                            <!-- //radio -->
                            <!-- textarea -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">备注信息：</label>
                                <div class="com-form-r com-fl">
                                    <textarea class="com-textarea" name="remark"></textarea>
                                </div>
                            </div>
                            <!-- //textarea -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="remember_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="website_status" value="1">
                            <!-- button -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl"></label>
                                <div class="com-form-r com-fl">
                                    <button type="submit" class="com-bigbtn com-btn-color02 ">确认</button>
                                </div>
                            </div>
                            <!-- //button -->
                        </div>
                    </form>
                </div>

                <!-- // tab-4 -->
                <div id="tabs-4" class="tab-itembox" style="display: none;">
                    <form name="loginFormd" id="loginFormd"  method="post" action="/add-permission">
                        <div class="com-form-wrap">
                            <!-- input -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">标识符：</label>
                                <div class="com-form-r com-fl">
                                    <input type="text" name="name" class="com-input-text com-input-sizemid">
                                </div>
                            </div>
                            <!-- //input -->
                            <!-- input -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">名称：</label>
                                <div class="com-form-r com-fl">
                                    <input type="text" name="display_name" class="com-input-text">
                                </div>
                            </div>

                            <!-- textarea -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">描述：</label>
                                <div class="com-form-r com-fl">
                                    <textarea name="description" class="com-textarea"></textarea>
                                </div>
                            </div>
                            <!-- //textarea -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!-- button -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl"></label>
                                <div class="com-form-r com-fl">
                                    <button type="submit" class="com-bigbtn com-btn-color02 ">确认</button>
                                </div>
                            </div>
                            <!-- //button -->
                        </div>
                    </form>
                </div>



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

        function edituser(e){
            layer.open({
                type: 1,
                title: '管理员修改',
                shadeClose: true,
                shade: 0.5,
                area: ['500px', '400px'],
                content: $(".notice-editorbox"+e)
            });
            $(".sub"+e).on("click",function(){
                var id =$(".id"+e).val();
                var name =$(".name"+e).val();
                var username =$(".username"+e).val();
                var role =$(".role"+e).val();
                var password =$(".password"+e).val();

                $.post('/edit-user',{'_token':'{{csrf_token()}}','edit_id':id,'edit_name':name,'edit_username':username,'edit_role':role,'edit_password':password},function(data) //第二个参数要传token的值 再传参数要用逗号隔开
                {
//                    alert(data);
                    layer.msg(data);
                    location.reload();
                });

            });

        }

        function editrole(e){
            $(".ischecked"+e).each(function () {

                var res =$(this).hasClass('checked');
                if(res){
                    $(this).parents('.icheckbox_minimal-blue').addClass('checked');
                }

            });
            layer.open({
                type: 1,
                title: '角色修改',
                shadeClose: true,
                shade: 0.5,
                area: ['500px', '400px'],
                content: $(".role-notice-editorbox"+e)
            });
            $(".subrole"+e).on("click",function(){
                var roleid =$(".roleid"+e).val();
                var rolename =$(".rolename"+e).val();
                var roledisplayname =$(".roledisplayname"+e).val();
                var description =$(".description"+e).val();
                var arr = new Array();
                $(".ischecked"+e).each(function () {
                    var on =$(this).attr('value');
                    var has= $(this).parents('.icheckbox_minimal-blue').hasClass('checked');
                    if(has){
                        arr.push(on);
                    }

                });
                $.post('/edit-role',{'_token':'{{csrf_token()}}','roleid':roleid,'rolename':rolename,'roledisplayname':roledisplayname,'description':description,'arr':arr},function(data) //第二个参数要传token的值 再传参数要用逗号隔开--}}
                {
//                alert(data);
//                layer.closeAll();
                    layer.msg(data);
                    location.reload();
                });

            });
        }
        function permssionedit(e){

            layer.open({
                type: 1,
                title: '权限节点修改',
                shadeClose: true,
                shade: 0.5,
                area: ['500px', '400px'],
                content: $(".permission-notice-editorbox"+e)
            });
            $(".subpermission"+e).on("click",function(){
                var permissionid =$(".permissionid"+e).val();
                var permissiondisplayname =$(".permissiondisplayname"+e).val();
                var permissionname =$(".permissionname"+e).val();
                var permissiondescription =$(".permissiondescription"+e).val();

                $.post('/edit-permission',{'_token':'{{csrf_token()}}','permissionid':permissionid,'permissiondisplayname':permissiondisplayname,'permissionname':permissionname,'permissiondescription':permissiondescription},function(data) //第二个参数要传token的值 再传参数要用逗号隔开
                {
//                alert(data);
//                layer.closeAll();
                    layer.msg(data);
                    location.reload();
                });

            });
        }
        function deluser(val) {
            layer.confirm('确定删除吗？', {
                btn: ['是','否'] //按钮
            }, function(){
                $.post('/delete-user',{'_token':'{{csrf_token()}}','id':val},function(data) //第二个参数要传token的值 再传参数要用逗号隔开
                {
//                    alert(data);
//                    layer.closeAll();
                    layer.msg(data);
                    location.reload();
                });
            });
        }

        function delrole(val) {
            layer.confirm('确定删除吗？', {
                btn: ['是','否'] //按钮
            }, function(){
                $.post('/del-role',{'_token':'{{csrf_token()}}','id':val},function(data) //第二个参数要传token的值 再传参数要用逗号隔开
                {
//                    alert(data);
//                    layer.closeAll();
                    layer.msg(data);
                    location.reload();
                });
            });
        }

        function delpermssion(val) {
            layer.confirm('确定删除吗？', {
                btn: ['是','否'] //按钮
            }, function(){
                $.post('/delete-permission',{'_token':'{{csrf_token()}}','id':val},function(data) //第二个参数要传token的值 再传参数要用逗号隔开
                {
//                    alert(data);
//                    layer.closeAll();
                    layer.msg(data);
                    location.reload();
                });
            });
        }
        //登入
        var loadingIndex;
        $(function(){
            $('#loginForm').ajaxForm({
                success: logcomplete, // 这是提交后的方法
                dataType: 'json'
            });

            function logcomplete(data){
                layer.close(loadingIndex);
                if(data.status==1){
                    layer.msg(data.success, {time: 1000}, function(){
                        window.location.href=data.url;
                    });
                }else{
                    layer.alert(data.error,{icon: 5});
                    return false;
                }
            }

            $('#loginForma').ajaxForm({
                success: logcompletea, // 这是提交后的方法
                dataType: 'json'
            });

            function logcompletea(data){
                layer.close(loadingIndex);
                if(data.status==1){
                    layer.msg(data.success, {time: 1000}, function(){
                        window.location.href=data.url;
                    });
                }else{
                    layer.alert(data.error,{icon: 5});
                    return false;
                }
            }

            $('#loginFormb').ajaxForm({
                success: logcompletea, // 这是提交后的方法
                dataType: 'json'
            });

            function logcomplete(data){
                layer.close(loadingIndex);
                if(data.status==1){
                    layer.msg(data.success, {time: 1000}, function(){
                        window.location.href=data.url;
                    });
                }else{
                    layer.alert(data.error,{icon: 5});
                    return false;
                }
            }

            $('#loginFormd').ajaxForm({
                success: logcompleted, // 这是提交后的方法
                dataType: 'json'
            });

            function logcompleted(data){
                layer.close(loadingIndex);
                if(data.status==1){
                    layer.msg(data.success, {time: 1000}, function(){
                        window.location.href=data.url;
                    });
                }else{
                    layer.alert(data.error,{icon: 5});
                    return false;
                }
            }
            //tab切换
            $(".tab-title li").on("click",function(){
                var index = $(this).index();
                $(this).addClass('tabulous_active').siblings().removeClass('tabulous_active');
                $(".tab-itembox").eq(index).show().siblings().hide();
            })

        })
    </script>

