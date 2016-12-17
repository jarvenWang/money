/**
 * Created by Administrator on 2016/12/15.
 */
angular.module('memberFanShui', [])
.controller('memberFanShuiCtrl', ['apiServer','$scope','$state',function(apiServer,$scope,$state){
    var fanShuiStore = {
        "init":function(){
            //显示tab
            $scope.tabType =0;
            //单选，多选
            $scope.selectAll = false;
            $scope.x=false;
            //时间
            var date;
            laydate({
                elem: '#date', //需显示日期的元素选择器
                event: 'click', //触发事件
                format: 'YYYY-MM-DD', //日期格式
                istime: false, //是否开启时间选择
                istoday: true, //是否显示今天
                choose: function(dates){ //选择好日期的回调
                    date = dates;
                }
            })
            //搜索条件初始化
            $scope.search={
                "date": "",
                "user_name" :""
            };

            //请求第一页列表数据
            fanShuiStore.getFsList();
            fanShuiStore.getFsRecord();
        },
        //获取返水审核列表
        "getFsList":function(){
            //发送请求
            var oParams={

            };
            apiServer.fanShuiCheckList(oParams).then(function(data){
                if(data.status==1){
                    $scope.fanShuiCheckData = data.data;
                }else{
                    layer.msg(data.msg)
                }
            },function(err){console.log(err)})
        },
        //查询
        "clickQuery":function(){
            fanShuiStore.getFsList();
        },
        //查询条件重置
        "clickReset":function(){
            window.location.reload();
        },
        //返水历史记录
        "getFsRecord":function(){
            apiServer.fanShuiHistory().then(function(data){
                if(data.status==1){
                    $scope.fanShuiHistory = data.data;
                }else{
                    layer.msg(data.msg)
                }
            },function(err){console.log(err)})
        },
        //tab切换
        "go": function (type) {
            $scope.tabType =type;
        },
        //全选
        "checkAll": function (selectAll) {
            console.log(selectAll)
        },
        //单选
        "chk": function (x,item) {
            console.log(x)
            console.log(item)
        }
    }

    //初始化
    fanShuiStore.init();
    //点击查询
    $scope.clickQuery = fanShuiStore.clickQuery;
    //点击重置
    $scope.clickReset = fanShuiStore.clickReset;
    //点击tab切换
    $scope.go = fanShuiStore.go;
    //全选
    $scope.checkAll = fanShuiStore.checkAll;
    //单选
    $scope.chk = fanShuiStore.chk;
}])