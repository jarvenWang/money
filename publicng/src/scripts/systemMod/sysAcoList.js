/**
 * Created by Administrator on 2016/12/7.
 */
angular.module('sysAcoList', [])
.controller('sysAcoListCtrl', ['apiServer','$scope','$state',function(apiServer,$scope,$state){
    var sysAccStore = {
        "init":function(){
            //存放添加弹框
            var bombBox;

            //查询条件初始化
            $scope.search = {
                "type" : "0",
                "status": "",
                "num" : 10,
                "allname" : ""
            }

            //弹框初始化
            $scope.bomb={
                "username":"",
                "password":"",
                "name" : "",
                "statu": 1,
                "selectJurGroup":""
            }

            //请求第一页列表数据
            sysAccStore.getsysAccList(1);

        },
        //获取员工列表
        "getsysAccList":function(curpage){
            //发送请求
            var oParams={
                "num": parseInt($scope.search.num),   //每页条数
                "page":curpage, //当前页码
                "username":$scope.search.username = ($scope.search.type==0) ? $scope.search.allname : "",
                "status" : $scope.search.status,
                "name" : $scope.search.name = ($scope.search.type==1) ? $scope.search.allname : ""
            };
            apiServer.sysAcountList(oParams).then(function(data){
                if(data.status==1){
                    $scope.sysAccData = data.data.list;
                    $scope.totalpage = Math.ceil(data.data.count/$scope.search.num);
                    //调用分页
                    laypage({
                        cont: $('#pagenation'), //容器。值支持id名、原生dom对象，jquery对象,
                        pages: $scope.totalpage, //总页数
                        curr: curpage || 1,
                        skip: true, //是否开启跳页
                        skin: '#108EE9',
                        groups: 3, //连续显示分页数
                        jump:function(obj, first){
                            if(!first){
                                sysAccStore.getsysAccList(obj.curr);
                            }
                        }
                    });
                }
            },function(err){console.log(err)})
        },
        //查询
        "clickQuery":function(){
            sysAccStore.getsysAccList(1);
        },
        //查询条件重置
        "clickReset":function(){
            $state.reload();
        },
        //点击添加
        "clickAdd":function(){
            $scope.type = 1;  //1:添加 ,2: 编辑
            $scope.titleName = "添加员工账号";
            //网站状态
            $scope.bomb.statu = 1;
            //获取权限组
            sysAccStore.getJurGroup(
                function(data){
                    $scope.jurGroupData = data.data.list;
                    $scope.bomb.selectJurGroup = $scope.jurGroupData[0];
                }
            );
            sysAccStore.showBomb();

        },
        //确认添加员工账号
        "submitAdd":function(){
            //参数
            var oParams ={
                "role_id" : $scope.bomb.selectJurGroup.id,
                "name"    : $scope.bomb.name,  //昵称
                "username": $scope.bomb.username,
                "password": $scope.bomb.password,
                "status" :  $scope.bomb.statu
            }
            console.log(oParams)
            apiServer.sysAddAcount(oParams).then(function(data){
                if(data.status ==1){
                    layer.close(bombBox);
                    layer.msg("添加成功");
                    $state.reload();
                }else{
                    layer.msg(data.msg)
                }
            },function(err){layer.msg(err)});
        },
        //点击编辑
        "clickModify":function(item){
            $scope.type = 2;  //1:添加 ,2: 编辑
            $scope.titleName = "编辑员工账号";

            $scope.id = item.id;
            $scope.bomb.username = item.username;
            $scope.bomb.password = item.password;
            $scope.bomb.name = item.name;
            $scope.bomb.statu = (item.status==1) ? 0 : 1 ;
            $scope.role_id = item.role_id;
            //获取权限组
            sysAccStore.getJurGroup(
                function(data){
                    $scope.jurGroupData = data.data.list;
                    angular.forEach($scope.jurGroupData,function(value,key){
                        if(value.id == $scope.role_id ){
                            console.log(key)
                            $scope.bomb.selectJurGroup = $scope.jurGroupData[key];
                        }
                    })

                }
            );
            sysAccStore.showBomb();
        },
        //确认编辑员工账号
        "submitModify":function(){

            //参数
            var oParams ={
                "id"      : $scope.id,
                "role_id" : $scope.bomb.selectJurGroup.id,
                "name"    : $scope.bomb.name,  //昵称
                "username": $scope.bomb.username,
                "password": $scope.bomb.password,
                "status" :  $scope.bomb.statu
            }
            apiServer.sysModifyAcount(oParams).then(function(data){
                if(data.status ==1){
                    layer.close(bombBox);
                    layer.msg("编辑成功");
                    $state.reload();
                }else{
                    layer.msg(data.msg)
                }
            },function(err){console.log(err)})
        },
        //显示弹框
        "showBomb":function(){
            bombBox=layer.open({
                type: 1,
                title: $scope.titleName,
                area: ['800px', 'auto'],
                shadeClose: false,
                content: $('.sysAcc-add'),
                cancel:function(){
                    sysAccStore.cancelBomb();
                }
            });
        },
        //关闭弹框
        "cancelBomb":function(){
            //清空文本框
            $scope.bomb={
                "username":"",
                "password":"",
                "name" : "",
                "statu": 1,
                "selectJurGroup":""
            }
            layer.close(bombBox);
        },
        //获取权限组
        "getJurGroup":function(fn){
            //获取权限组
            apiServer.jurGroupList().then(function(data){
                if(data.status==1){
                    fn && fn(data);
                }
            },function(err){console.log(err)})
        }
    }

    //初始化
    sysAccStore.init();
    //点击添加员工账号
    $scope.clickAdd= sysAccStore.clickAdd;
    //确认添加员工账号
    $scope.submitAdd = sysAccStore.submitAdd;
    //取消弹框
    $scope.cancelBomb = sysAccStore.cancelBomb;
    //点击修改员工账号
    $scope.clickModify = sysAccStore.clickModify;
    //确认修改员工账号
    $scope.submitModify = sysAccStore.submitModify;
    //点击查询
    $scope.clickQuery = sysAccStore.clickQuery;
    //点击重置
    $scope.clickReset = sysAccStore.clickReset;

}])