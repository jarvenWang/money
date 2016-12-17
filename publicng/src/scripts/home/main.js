/**
 * Created by Administrator on 2016/12/7.
 */
angular.module('main', [])
.controller('mainCtrl', ['$scope','$state',function($scope,$state){

    //处理二级路由
    $state.go('index.sysSetting');

   var menuData = [
       [

           {"urlValue":"index.sysSetting","name":"全局设置"},
           {"urlValue":"index.sysGame","name":"游戏管理"},
           {"urlValue":"index.sysAccount","name":"员工账号"},
           {"urlValue":"index.sysJournal","name":"后台操作日志"}
       ],
       [
           {"urlValue":"index.sysReport","name":"全局报表"},
           {"urlValue":"index.sysReport","name":"活动营销"},
           {"urlValue":"index.sysSetting","name":"公告管理"},
           {"urlValue":"index.sysGame","name":"短信"},
           {"urlValue":"index.sysAccount","name":"运营分析"}
       ],
       [
           {"urlValue":"index.sysSetting","name":"充值记录"},
           {"urlValue":"index.sysGame","name":"提现记录"},
           {"urlValue":"index.sysAccount","name":"分红记录"},
           {"urlValue":"index.sysJournal","name":"加扣款"},
           {"urlValue":"index.sysJournal","name":"财务报表"},
           {"urlValue":"index.sysJournal","name":"接口设置"},
           {"urlValue":"index.sysJournal","name":"财务操作日志"}
       ],
       [
           {"urlValue":"index.sysReport","name":"客服"},
           {"urlValue":"index.sysSetting","name":"客服管理"},
           {"urlValue":"index.sysSetting","name":"客服报表"},
           {"urlValue":"index.sysSetting","name":"设置"},
           {"urlValue":"index.sysSetting","name":"会员帮助中心"},
       ],
       [
           {"urlValue":"index.sysReport","name":"会员列表"},
           {"urlValue":"index.sysSetting","name":"会员反水"},
           {"urlValue":"index.sysSetting","name":"会员核查"},
           {"urlValue":"index.sysSetting","name":"会员报表"},
           {"urlValue":"index.sysSetting","name":"会员分析"},
           {"urlValue":"index.sysSetting","name":"会员等级"},
           {"urlValue":"index.sysSetting","name":"会员层级"},
           {"urlValue":"index.sysSetting","name":"会员登录日志"}
       ],
       [
           {"urlValue":"index.sysReport","name":"代理列表"},
           {"urlValue":"index.sysSetting","name":"代理层级"},
           {"urlValue":"index.sysSetting","name":"佣金结算"},
           {"urlValue":"index.sysSetting","name":"代理公告"},
           {"urlValue":"index.sysSetting","name":"代理登录日志"}
       ],
       [
           {"urlValue":"index.sysReport","name":"体育记录"},
           {"urlValue":"index.sysSetting","name":"彩票记录"},
           {"urlValue":"index.sysSetting","name":"视讯记录"},
           {"urlValue":"index.sysSetting","name":"老虎机记录"},
           {"urlValue":"index.sysSetting","name":"游戏报表"},
           {"urlValue":"index.sysSetting","name":"游戏分析"}
       ],
   ];

   $scope.getMenu=function(value){
       switch (value)
       {
           case 0:
               $scope.menuData=menuData[0];
               break;
           case 1:
               $scope.menuData=menuData[1];
               break;
           case 2:
               $scope.menuData=menuData[2];
               break;
           case 3:
               $scope.menuData=menuData[3];
               break;
           case 4:
               $scope.menuData=menuData[4];
               break;
           case 5:
               $scope.menuData=menuData[5];
               break;
           case 6:
               $scope.menuData=menuData[6];
               break;
       }
   };
   //进入页面时触发
   $scope.getMenu(0);

}])