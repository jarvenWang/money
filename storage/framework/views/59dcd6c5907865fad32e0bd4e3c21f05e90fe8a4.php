
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
                            <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <tr>
                                    <td align="center"><?php echo e($data->name); ?></td>
                                    <td align="center"><?php echo e($data->username); ?></td>
                                    
                                    <td align="center"><?php echo e($data->display_name); ?></td>
                                    <td align="center"><a onclick="edituser('<?php echo e($data->id); ?>')" class="com-smallbtn com-btn-color01 editer-btn">编辑</a><a onclick="deluser(<?php echo e($data->id); ?>)" class=" com-smallbtn com-btn-color02 ml5 del-btn">删除</a></td>
                                    <!-- //编辑弹框 -->

                                    <div  class="notice-editorbox<?php echo e($data->id); ?>" style="display: none;">
                                        <div class="notice-con-box">
                                            <form>
                                                <div class="com-form-wrap">
                                                    <!-- input -->
                                                    <input type="hidden" name="edit_id" value="<?php echo e($data->id); ?>"  class="com-input-text id<?php echo e($data->id); ?>">
                                                    <div class="com-form-group clearfix">
                                                        <label class="com-form-l com-fl com-lh">姓名：</label>
                                                        <div class="com-form-r com-fl">
                                                            <input type="text" value="<?php echo e($data->name); ?>" class="com-input-text name<?php echo e($data->id); ?>">
                                                        </div>
                                                    </div>
                                                    <!-- //input -->
                                                    <!-- input -->
                                                    <div class="com-form-group clearfix">
                                                        <label class="com-form-l com-fl com-lh">用户名：</label>
                                                        <div class="com-form-r com-fl">
                                                            <input type="text" value="<?php echo e($data->username); ?>" class="com-input-text username<?php echo e($data->id); ?>">
                                                        </div>
                                                    </div>
                                                    <!-- //input -->
                                                    <!-- input -->
                                                    <div class="com-form-group clearfix">
                                                        <label class="com-form-l com-fl com-lh">密码：</label>
                                                        <div class="com-form-r com-fl">
                                                            <input type="password" value="<?php echo e($data->password); ?>" class="com-input-text password<?php echo e($data->id); ?>">
                                                        </div>
                                                    </div>
                                                    <!-- //input -->
                                                    <div class="com-form-group clearfix">
                                                        <label class="com-form-l com-fl com-lh" >权限组：</label>
                                                        <div class="com-form-r com-fl">
                                                            <select  class="com-select role<?php echo e($data->id); ?>">
                                                                <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                                    <?php if($k->id == $data->roleid): ?>
                                                                        <option value="<?php echo e($k->id); ?>" selected="selected"><?php echo e($k->display_name); ?></option>
                                                                    <?php else: ?>
                                                                        <option value="<?php echo e($k->id); ?>"><?php echo e($k->display_name); ?></option>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- button -->
                                                    <div class="com-form-group clearfix">
                                                        <label class="com-form-l com-fl"></label>
                                                        <div class="com-form-r com-fl">
                                                            <a type="submit"  class="com-bigbtn com-btn-color02 sub<?php echo e($data->id); ?>">确认</a>
                                                        </div>
                                                    </div>
                                                    <!-- //button -->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- //编辑弹框 -->


                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

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
                            <?php $__currentLoopData = $roledata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <tr>
                                    <td align="center"><?php echo e($role['name']); ?></td>
                                    <td align="center"><?php echo e($role['display_name']); ?></td>
                                    
                                    <td align="center"><?php echo e($role['description']); ?></td>
                                    

                                    <td align="center"><a onclick="editrole(<?php echo e($role['id']); ?>)" class="com-smallbtn com-btn-color01 editer-btn">编辑</a><a onclick="delrole('<?php echo e($role['id']); ?>')" class=" com-smallbtn com-btn-color02 ml5 del-btn">删除</a></td>
                                    <!-- //编辑弹框 -->

                                    <div  class="role-notice-editorbox<?php echo e($role['id']); ?>" style="display:none">

                                        <form>
                                            <div class="com-form-wrap">
                                                <!-- input -->
                                                <input type="hidden" name="edit_id" value="<?php echo e($role['id']); ?>"  class="com-input-text roleid<?php echo e($role['id']); ?>">
                                                <div class="com-form-group clearfix">
                                                    <label class="com-form-l com-fl com-lh">角色名称：</label>
                                                    <div class="com-form-r com-fl">
                                                        <input type="text" value="<?php echo e($role['name']); ?>" class="com-input-text rolename<?php echo e($role['id']); ?>">
                                                    </div>
                                                </div>
                                                <!-- //input -->
                                                <!-- input -->
                                                <div class="com-form-group clearfix">
                                                    <label class="com-form-l com-fl com-lh">显示角色：</label>
                                                    <div class="com-form-r com-fl">
                                                        <input type="text"  value="<?php echo e($role['display_name']); ?>" class="com-input-text roledisplayname<?php echo e($role['id']); ?>">
                                                    </div>
                                                </div>
                                                <!-- //input -->
                                                <!-- input -->
                                                <div class="com-form-group clearfix">
                                                    <label class="com-form-l com-fl com-lh">描述：</label>
                                                    <div class="com-form-r com-fl">
                                                        <textarea class="com-input-text description<?php echo e($role['id']); ?>"><?php echo e($role['description']); ?></textarea>

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
                                                   <?php $__currentLoopData = $permission_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $per): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                                        <?php if(in_array($per->id,$role['perm_arr'])): ?>
                                                            <div class="com-form-group clearfix">
                                                                <label class="com-form-l com-fl"></label>
                                                                <div class="com-form-r com-fl  " >
                                                                    <div class="com-ib">
                                                                        <input type="checkbox" class="checked ischecked<?php echo e($role['id']); ?>" value="<?php echo e($per->id); ?>" >
                                                                        <label><?php echo e($per->name); ?></label>
                                                                        <label><?php echo e($per->display_name); ?></label>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="com-form-group clearfix">
                                                                <label class="com-form-l com-fl"></label>
                                                                <div class="com-form-r com-fl  " >
                                                                    <div class="com-ib">
                                                                        <input type="checkbox" class="ischecked<?php echo e($role['id']); ?>"  value="<?php echo e($per->id); ?>" >
                                                                        <label><?php echo e($per->name); ?></label>
                                                                        <label><?php echo e($per->display_name); ?></label>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        <?php endif; ?>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                                                </div>
                                                <!-- //input -->
                                                <!-- button -->
                                                <div class="com-form-group clearfix">
                                                    <label class="com-form-l com-fl"></label>
                                                    <div class="com-form-r com-fl">
                                                        <a type="submit"  class="com-bigbtn com-btn-color02 subrole<?php echo e($role['id']); ?>">确认</a>
                                                    </div>
                                                </div>
                                                <!-- //button -->
                                            </div>
                                        </form>
                                    </div>

                                    <!-- //编辑弹框 -->

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

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
                                
                            </tr>
                            </thead>
                            <!-- <tbody>
                                <tr align="center">
                                    <td align="center" colspan="11">没有数据</td>
                                </tr>
                            </tbody> -->
                            <tbody>
                            <tr >
                            <?php $__currentLoopData = $permission_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <tr>
                                    <td align="center"><?php echo e($permission->display_name); ?></td>
                                    <td align="center"><?php echo e($permission->name); ?></td>
                                    
                                    <td align="center"><?php echo e($permission->description); ?></td>
                                    <td align="center"><a onclick="permssionedit('<?php echo e($permission->id); ?>')" class="com-smallbtn com-btn-color01 editer-btn">编辑</a><a onclick="delpermssion(<?php echo e($permission->id); ?>)" class=" com-smallbtn com-btn-color02 ml5 del-btn">删除</a></td>

                                    <!-- //编辑弹框 -->

                                    <div  class="permission-notice-editorbox<?php echo e($permission->id); ?>" style="display: none;">

                                        <form>
                                            <div class="com-form-wrap">
                                                <!-- input -->
                                                <input type="hidden" name="edit_id" value="<?php echo e($permission->id); ?>"  class="com-input-text permissionid<?php echo e($permission->id); ?>">
                                                <div class="com-form-group clearfix">
                                                    <label class="com-form-l com-fl com-lh">名称：</label>
                                                    <div class="com-form-r com-fl">
                                                        <input type="text" value="<?php echo e($permission->display_name); ?>" class="com-input-text permissiondisplayname<?php echo e($permission->id); ?>">
                                                    </div>
                                                </div>
                                                <!-- //input -->
                                                <!-- input -->
                                                <div class="com-form-group clearfix">
                                                    <label class="com-form-l com-fl com-lh">标识符：</label>
                                                    <div class="com-form-r com-fl">
                                                        <input type="text" value="<?php echo e($permission->name); ?>" class="com-input-text permissionname<?php echo e($permission->id); ?>">
                                                    </div>
                                                </div>
                                                <!-- //input -->
                                                <!-- input -->
                                                <div class="com-form-group clearfix">
                                                    <label class="com-form-l com-fl com-lh">描述：</label>
                                                    <div class="com-form-r com-fl">
                                                        <textarea class="com-input-text permissiondescription<?php echo e($permission->id); ?>"><?php echo e($permission->description); ?></textarea>

                                                    </div>
                                                </div>
                                                <!-- input -->
                                                <!-- button -->
                                                <div class="com-form-group clearfix">
                                                    <label class="com-form-l com-fl"></label>
                                                    <div class="com-form-r com-fl">
                                                        <a type="submit"  class="com-bigbtn com-btn-color02 subpermission<?php echo e($permission->id); ?>">确认</a>
                                                    </div>
                                                </div>
                                                <!-- //button -->
                                            </div>
                                        </form>
                                    </div>

                                    <!-- //编辑弹框 -->
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

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
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
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
                                <?php $__currentLoopData = $permission_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl"></label>
                                        <div class="com-form-r com-fl  " >
                                            <div class="com-ib">
                                                <input type="checkbox" name="allpermisson[]"  value="<?php echo e($all->id); ?>" >
                                                <label><?php echo e($all->name); ?></label>
                                                <label><?php echo e($all->display_name); ?></label>
                                            </div>

                                        </div>
                                    </div>


                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

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
                                        <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($k->id); ?>"><?php echo e($k->display_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="remember_token" value="<?php echo e(csrf_token()); ?>">
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
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
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

                $.post('/edit-user',{'_token':'<?php echo e(csrf_token()); ?>','edit_id':id,'edit_name':name,'edit_username':username,'edit_role':role,'edit_password':password},function(data) //第二个参数要传token的值 再传参数要用逗号隔开
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
                $.post('/edit-role',{'_token':'<?php echo e(csrf_token()); ?>','roleid':roleid,'rolename':rolename,'roledisplayname':roledisplayname,'description':description,'arr':arr},function(data) //第二个参数要传token的值 再传参数要用逗号隔开--}}
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

                $.post('/edit-permission',{'_token':'<?php echo e(csrf_token()); ?>','permissionid':permissionid,'permissiondisplayname':permissiondisplayname,'permissionname':permissionname,'permissiondescription':permissiondescription},function(data) //第二个参数要传token的值 再传参数要用逗号隔开
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
                $.post('/delete-user',{'_token':'<?php echo e(csrf_token()); ?>','id':val},function(data) //第二个参数要传token的值 再传参数要用逗号隔开
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
                $.post('/del-role',{'_token':'<?php echo e(csrf_token()); ?>','id':val},function(data) //第二个参数要传token的值 再传参数要用逗号隔开
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
                $.post('/delete-permission',{'_token':'<?php echo e(csrf_token()); ?>','id':val},function(data) //第二个参数要传token的值 再传参数要用逗号隔开
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

