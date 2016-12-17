/**
 * Created by Administrator on 2016/12/8.
 */
angular.module('login', [])
/**
 * [getImg description：请求二进制流文件，图片的方法(验证码接口中用到)]
 * @param {string}  method [请求类型]
 * @param {string}  url    [请求路径]
 * @param {string}  domBox [存放返回的数据的dom样式名]
 */
.controller('loginCtrl', ['apiServer','$scope','$rootScope','$state',function(apiServer,$scope,$rootScope,$state){


    var loginStore = {
        "init":function(){        //初始化处理
            $scope.count = 0; //超三次显示
            loginStore.getVerifCode();
        },
        "getVerifCode":function(){ //获取验证码
            apiServer.loginCode().then(function(data){
                if(data.status==1){
                    $scope.url = data.data.list.url;
                    $scope.backcode = data.data.list.backcode;
                }
            },function(err){console.log(err)})
        },
        "postLogin": function () { //登录请求
            //请求验证
            if($scope.login_form.$dirty && $scope.login_form.$invalid){
                return false;
            }
            //请求参数
            var oParams={
                "username":$scope.username,
                "password":$scope.password,
                "code":$scope.code
            }
            //发送请求
            apiServer.login(oParams).then(function(data){
                if(data.status==1){
                    /*$rootScope.token = data.data.token;*/
                    $.cookie("token",data.data.list.token);
                    //路由跳转
                    $state.go("index");
                }else{
                    layer.msg(data.msg)
                }
            },function(err){console.log(err)})
        }
    }

    //初始化请求
    loginStore.init();
    //点击登录
    $scope.login= loginStore.postLogin;
    //更换验证码
    $scope.changCode = loginStore.getVerifCode;

}])