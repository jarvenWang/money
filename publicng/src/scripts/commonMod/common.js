/**
 * Created by Administrator on 2016/12/7.
 */

pangu.common=  angular.module('common', [])
.directive('ngFocus', [function() {
    var FOCUS_CLASS = "ng-focused";
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function(scope, element, attrs, ctrl) {
            ctrl.$focused = false;
            element.bind('focus', function(evt) {
                element.addClass(FOCUS_CLASS);
                scope.$apply(function() {ctrl.$focused = true;});
            }).bind('blur', function(evt) {
                element.removeClass(FOCUS_CLASS);
                scope.$apply(function() {ctrl.$focused = false;});
            });
        }
    }
}])
.controller('mainCtrl', ['$scope','$state','$location','$rootScope',function($scope,$state,$location,$rootScope){
    var curpath = $location.$$path;
    console.log(curpath);
    //二级菜单渲染
    var menuData = [
        [
            {"urlValue":"index","name":"全局设置"},
            {"urlValue":"sysGame","name":"游戏管理"},
            {"urlValue":"sysShield","name":"屏蔽IP地区"},
            {"urlValue":"sysAccount","name":"员工账号"},
            {"urlValue":"sysJournal","name":"后台操作日志"}
        ],
        [
            {"urlValue":"operateReport","name":"全局报表"},
            {"urlValue":"sysReport","name":"活动营销"},
            {"urlValue":"sysSetting","name":"公告管理"},
            {"urlValue":"sysGame","name":"短信"},
            {"urlValue":"sysAccount","name":"运营分析"}
        ],
        [
            {"urlValue":"finance","name":"充值记录"},
            {"urlValue":"sysGame","name":"提现记录"},
            {"urlValue":"sysAccount","name":"分红记录"},
            {"urlValue":"sysJournal","name":"加扣款"},
            {"urlValue":"sysJournal","name":"财务报表"},
            {"urlValue":"sysJournal","name":"接口设置"},
            {"urlValue":"sysJournal","name":"财务操作日志"}
        ],
        [
            {"urlValue":"customer","name":"客服"},
            {"urlValue":"sysSetting","name":"客服管理"},
            {"urlValue":"sysSetting","name":"客服报表"},
            {"urlValue":"sysSetting","name":"设置"},
            {"urlValue":"sysSetting","name":"会员帮助中心"},
        ],
        [
            {"urlValue":"memberList","name":"会员列表"},
            {"urlValue":"memberFanShui","name":"会员反水"},
            {"urlValue":"sysSetting","name":"会员登录日志"}
        ],
        [
            {"urlValue":"agent","name":"代理列表"},
            {"urlValue":"agent1","name":"代理层级"},
            {"urlValue":"agent2","name":"佣金结算"},
            {"urlValue":"agent3","name":"代理公告"},
            {"urlValue":"agent4","name":"代理登录日志"}
        ],
        [
            {"urlValue":"game","name":"体育记录"},
            {"urlValue":"game2","name":"彩票记录"},
            {"urlValue":"game3","name":"视讯记录"},
            {"urlValue":"game4","name":"老虎机记录"},
            {"urlValue":"game5","name":"游戏报表"},
            {"urlValue":"game6","name":"游戏分析"}
        ],
    ];

    //根据不同组渲染不同路由
    $scope.getMenu = function(value){
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
    //所有的路由，二级，三级
    var routerName = [['index','sysGame','sysShield','sysAccount','sysJournal',"sysAccount/sysAcoList",
        "sysAccount/sysAcoResign","sysAccount/sysAcoPer","sysJournal"],["operateReport"],["finance"],["customer"
    ],["memberList","memberFanShui"],["agent"],["game"]];
    //判断当前状态属于哪一组
    $scope.checkState = function(curpath){
        for(var i=0;i<routerName.length;i++){
            for(var j=0;j<routerName[i].length;j++){
                if(curpath == '/'+routerName[i][j]){
                    return i;
                }
            }
        }
    }

    //展示二级菜单
    $rootScope.$on('$stateChangeSuccess', function(event, toState, toStateParams) {
        var path = $location.$$path;
        //登录页中隐藏header
        if (path =="/login") {
            $scope.isShowHeader = false;
        }else{
            $scope.isShowHeader = true;
        }

        //二级路由渲染
        var value = $scope.checkState(path);
        $scope.getMenu(value);
    });


}])
