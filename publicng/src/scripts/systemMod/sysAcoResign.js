/**
 * Created by Administrator on 2016/12/15.
 */
angular.module('sysAcoResign', [])
.controller('sysAcoResignCtrl', ['apiServer','$scope','$state',function(apiServer,$scope,$state){
    var resignStore ={
        "init":function(){


            $scope.num=30;
            resignStore.getResList(1);
        },
        //获取权限组列表
        "getResList": function (curpage) {
            //发送请求
            var oParams={

            };
            apiServer.jurGroupList(oParams).then(function(data){
                if(data.status==1){
                    console.log(data)
                    $scope.sysJurData = data.data.list;
                    $scope.totalpage = Math.ceil(data.data.count/$scope.num);
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
                                resignStore.getResList(obj.curr);
                            }
                        }
                    });
                }
            },function(err){console.log(err)})
        }
    }

    //初始化
    resignStore.init();
}])