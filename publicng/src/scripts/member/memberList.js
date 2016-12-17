/**
 * Created by Administrator on 2016/12/7.
 */
angular.module('memberList', [])
.controller('memberListCtrl', ['apiServer','$scope','$state',function(apiServer,$scope,$state){

     var memberListStore = {
         "init":function(){
             //表单美化初始化
            /* layui.use(['form','layer','element'], function(){
                 var form = layui.form();
                 form.render();
             });*/

             //搜索条件初始化
             $scope.search={
                 "type": 0,
                 "num" :10, //每页条数
                 "level_name":"", //层级
                 "grade_name":"", //等级
                 "inputValue":""       //输入框值
             };


             //请求第一页列表数据
             memberListStore.getsysAccList(1);
             memberListStore.getGradeList();
             memberListStore.getLevelList();

         },
         //获取等级列表
         "getGradeList":function(){
             apiServer.gradeList().then(function(data){
                 if(data.status==1){
                     $scope.gradeData = data.data.list;
                 }else{
                     layer.msg(data.msg)
                 }
             },function(err){console.log(err)})
         },
         //获取层级列表
         "getLevelList":function(){
             apiServer.levelList().then(function(data){
                 if(data.status==1){
                     $scope.levelData = data.data.list;
                 }else{
                     layer.msg(data.msg)
                 }
             },function(err){console.log(err)})
         },
         //获取会员列表
         "getsysAccList":function(curpage){
             //发送请求
             var oParams={
                 "num":parseInt($scope.search.num),   //每页条数
                 "page":curpage,      //当前页码
                 "user_name": ($scope.search.type==0) ? $scope.search.inputValue : "",      //会员账号
                 "level_name": $scope.search.level_name,
                 "grade_name": $scope.search.grade_name,
                 "superior_name":($scope.search.type==1) ? $scope.search.inputValue : ""    //上级代理
             };
             apiServer.memberList(oParams).then(function(data){
                 if(data.status==1){
                     $scope.memberListData = data.data.list;
                     $scope.totalpage = Math.ceil(data.data.count/$scope.search.num);

                     //调用分页
                     laypage({
                         cont: $('#pagenation'),
                         pages: $scope.totalpage,
                         curr: curpage || 1,
                         skip: true,
                         skin: '#108EE9',
                         groups: 3, //连续显示分页数
                         jump:function(obj, first){
                             if(!first){
                                 memberListStore.getsysAccList(obj.curr);
                             }
                         }
                     });
                 }
             },function(err){console.log(err)})
         },
         //查询
         "clickQuery":function(){
             memberListStore.getsysAccList(1);
         },
         //查询条件重置
         "clickReset":function(){
             $state.reload();
         },
         //点击编辑
         "clickModify":function(item){
               console.log("编辑")
         }
     }

    //初始化
    memberListStore.init();
    //点击查询
    $scope.clickQuery = memberListStore.clickQuery;
    //点击重置
    $scope.clickReset = memberListStore.clickReset;

}])
