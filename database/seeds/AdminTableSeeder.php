<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /*$fill_data = [
            'name' => 'wangjinbao',
            'username' => 'wangjinbao1',
            'website_status' => 1,
            'remember_token' => 'bgK5eiuja2',
            'domains' => 'Repellat labore veritatis perspiciatis facere recusandae nobis ex modi. In assumenda nobis et est. Tenetur totam ipsum eius et quisquam. Omnis consequuntur unde mollitia vel expedita architecto.',
            'password' => bcrypt('123123'),
            'level' => 1
        ];
        factory(App\Models\Admin::class,1)->create($fill_data);*/
        DB::table('admins')->insert(
                array(
                    'name' => 'chenze',
                    'username' => 'chenze',
                    'website_status' => 1,
                    'remember_token' => 'bgK5eiuja2',
                    'domains' => 'test',
                    'password' => bcrypt('123456'),
                    'level' => 1
                ));
        DB::table('role_admin')->insert(
            array(
                'admin_id' => 1,
                'role_id' => 1
            ));
        DB::table('admin_roles')->insert(
            array(
                'id' => 1,
                'name' => '超级管理员',
                'display_name'=>'超级管理员',
                'description'=>'超级管理员',
                'reseller_id'=>0,
                'created_at'=>'2016-11-04 13:39:50',
                'updated_at'=>'2016-11-04 13:39:50'
            ));
        DB::table('admin_permission_role')->insert(
        array(
            array(
                'role_id' => 1,
                'permission_id'=>1
            ),
            array(
                'role_id' => 1,
                'permission_id'=>2
            ),
            array(
                'role_id' => 1,
                'permission_id'=>3
            ),
            array(
                'role_id' => 1,
                'permission_id'=>4
            ),array(
                'role_id' => 1,
                'permission_id'=>5
            ) ,array(
                'role_id' => 1,
                'permission_id'=>6
            ),array(
                'role_id' => 1,
                'permission_id'=>7
            ),array(
                'role_id' => 1,
                'permission_id'=>8
            ),array(
                'role_id' => 1,
                'permission_id'=>9
            ),array(
                'role_id' => 1,
                'permission_id'=>10
            ),array(
                'role_id' => 1,
                'permission_id'=>11
            ),array(
                'role_id' => 1,
                'permission_id'=>12
            ),array(
                'role_id' => 1,
                'permission_id'=>13
            ),array(
                'role_id' => 1,
                'permission_id'=>14
            ),array(
                'role_id' => 1,
                'permission_id'=>15
            ),array(
                'role_id' => 1,
                'permission_id'=>16
            ),array(
                'role_id' => 1,
                'permission_id'=>17
            ),array(
                'role_id' => 1,
                'permission_id'=>18
            ),array(
                'role_id' => 1,
                'permission_id'=>19
            ),array(
                'role_id' => 1,
                'permission_id'=>20
            )
        )
        );
        DB::table('admin_permissions')->insert(
            array(
                array(
                    'id' => 1,
                    'name' => 'add-user',
                    'display_name'=>'添加管理员',
                     'created_at'=>'2016-11-04 13:39:50',
                     'updated_at'=>'2016-11-04 13:39:50'
                ),
                array(
                    'id' => 2,
                    'name' => 'edit-user',
                    'display_name'=>'编辑管理员',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),
                array(
                    'id' => 3,
                    'name' => 'delete-user',
                    'display_name'=>'编辑管理员',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),
                array(
                    'id' => 4,
                    'name' => 'add-role',
                    'display_name'=>'添加角色',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),
                array(
                    'id' => 5,
                    'name' => 'edit-role',
                    'display_name'=>'编辑角色',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),
                array(
                    'id' => 6,
                    'name' => 'del-role',
                    'display_name'=>'删除角色',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),
                array(
                    'id' => 7,
                    'name' => 'add-permission',
                    'display_name'=>'添加权限节点',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),
                array(
                    'id' => 8,
                    'name' => 'edit-permission',
                    'display_name'=>'编辑权限节点',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),
                array(
                    'id' => 9,
                    'name' => 'delete-permission',
                    'display_name'=>'删除权限节点',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),
                array(
                    'id' => 10,
                    'name' => 'index',
                    'display_name'=>'后台首页',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),array(
                    'id' => 11,
                    'name' => 'routine-setting.html',
                    'display_name'=>'添加角色访问页面',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),array(
                    'id' => 12,
                    'name' => 'member-level.html',
                    'display_name'=>'代理层级',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),array(
                    'id' => 13,
                    'name' => 'changeLevel',
                    'display_name'=>'修改层级',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),array(
                    'id' => 14,
                    'name' => 'addLevel',
                    'display_name'=>'添加层级',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),array(
                    'id' => 15,
                    'name' => 'member-grade.html',
                    'display_name'=>'会员等级',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),array(
                    'id' => 16,
                    'name' => 'changeGrade',
                    'display_name'=>'修改等级',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),array(
                    'id' => 17,
                    'name' => 'addGrade',
                    'display_name'=>'添加等级',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),array(
                    'id' => 18,
                    'name' => 'member-agent-level.html',
                    'display_name'=>'会员层级',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),array(
                    'id' => 19,
                    'name' => 'changeAgentLevel',
                    'display_name'=>'修改会员层级',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),array(
                    'id' => 20,
                    'name' => 'addAgentLevel',
                    'display_name'=>'添加会员层级',
                    'created_at'=>'2016-11-04 13:39:50',
                    'updated_at'=>'2016-11-04 13:39:50'
                ),

            )
        );

    }
}
