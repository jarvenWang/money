/**
 * Created by Administrator on 2016/12/7.
 */
angular.module('sysAccount', [])
.controller('sysAccountCtrl', ['apiServer','$scope','$state','$location',function(apiServer,$scope,$state,$location){

    var acountStore={
        "init": function () {
            var curpath = $location.$$path;
            acountStore.come(curpath)
        },
        "come": function (curpath) {
            if(curpath == "/sysAccount/sysAcoResign"){
                acountStore.go(1);
            }else if(curpath == "/sysAccount/sysAcoPer"){
                acountStore.go(2);
            }else{
                acountStore.go(0);
            }
        },
        "go": function (type) {
            $scope.type =type;
            switch (type)
            {
                case 0:
                    $state.go("sysAccount.sysAcoList")
                    break;
                case 1:
                    $state.go("sysAccount.sysAcoResign")
                    break;
                case 2:
                    $state.go("sysAccount.sysAcoPer")
                    break;
            }
        }
    }

    //初始化
    acountStore.init();
    //点击tab跳转
    $scope.go=acountStore.go;

}])