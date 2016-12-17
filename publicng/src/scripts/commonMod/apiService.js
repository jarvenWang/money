/**
 * 存放公用的服务
 */
pangu.common
/**
 * [/**拦截器服务 - Interceptors/]
 */
.factory('interceptor',['$q','$rootScope',function($q,$rootScope){
    return {
        'request': function(config) {
            //设置请求头
            if(config.method == "POST" || config.method == "PUT" || config.method == "DELETE" || config.method == "OPTIONS"){
                config.headers['Content-Type'] = 'application/x-www-form-urlencoded';
            }

            if(config.timeout){	//ajax请求

                //设置时间戳（请求开始）
                config.requestTimestamp = new Date().getTime();

            }

            return config;
        },
        'response':function(response){
            if(response.msg == 'auth failed'){
                alert('登录超时！')
                window.location.href = '?'+$rootScope.indexPath
            }
            //设置时间戳（请求返回）
            response.responseTimestamp = new Date().getTime();

            return response;
        },
        'responseError':function(rejection){
            console.log(rejection)
            //错误处理
            switch(rejection.status){
                case 0: //超时或中断
                    console.log('中断或超时！');
                    return $q.reject(rejection);
                    break;
                case 401: 	//末授权的请求
                    return $q.reject(rejection);
                    break;
                case 403: 	//禁止的请求
                    return $q.reject(rejection);
                    break;
                case 404: 	//页面找不到
                    return $q.reject(rejection);
                    break;
                case 500: 	//服务器错误
                    return $q.reject(rejection);
                    break;
            }
            //return $q.reject(rejection);//reject()失败 resolve()成功
            return rejection;
        }
    }
}])
/**
 * [异步ajax请求服务]
 */
.factory('ajaxServer', ['$http','$q', function($http,$q){
    return {
        //发送请求
        /**
         * [send description]
         * @param  {[type]}  data    [$http的 参数对象]
         * @param  {Boolean} isAbort [为true时，timeout配置设为promise对象，以此用来强制中断请求，配合greedy方法使用，为false时，timeout默认配置 20000ms超时 ]
         * @return {[type]}          [isAbort为真，返回deferred，为假，返回]
         */
        'send':function(data,isAbort){

            var that = this,
                resultObj = null,
                deferred = $q.defer(),
                promise = deferred.promise,
                settings = {
                    url:"",
                    method:"GET",
                    timeout:60000,
                    params:{},
                    data:{}
                };

            isAbort = isAbort || false;  //isAbort默认为false

            resultObj = promise;

            if(isAbort){
                settings.timeout = promise;
                resultObj = deferred;
            }

            $.extend(settings,data);
            $http(settings).then(function(response){
                //console.log( that.getDoneTime(response) );
                deferred.status = "success";
                deferred.resolve(response.data);
            },function(err){
                deferred.status = "err";
                deferred.reject(err);
            })

            return resultObj;
        },
        //获得请求时间
        'getDoneTime':function(response){

            var time = 0;
            time = response.responseTimestamp - response.config.requestTimestamp;

            return ( '请求用时： ' + (time / 1000) + ' 秒' )
        },
        /**
         * [monopoly 独占型提交]
         * 只允许同时存在一次提交操作，并且直到本次提交完成才能进行下一次提交。
         * target 存放deffere对象的对象
         * func 返回一个def对象
         * @return {[type]} []
         */
        'monopoly':function(target,func){
            var that = target;
            if(that.deffered && !( that.deffered.status === 'success' || that.deffered.status === 'err' )){
                return
            }

            that.deffered = func();
        },
        /**
         * [greedy 贪婪型提交]
         * 无限制的提交，但是以最后一次操作为准；亦即需要尽快给出最后一次操作的反馈，而前面的操作结果并不重要。
         * target 是 promise对象挂裁的对象 设为：document
         * func 返回一个deffer对象的函数
         * @return {[type]} [description]
         */
        'greedy':function(target,func){
            var that = target;
            if(that.deffered && !( that.deffered.status === 'success' || that.deffered.status === 'err' )){

                that.deffered.resolve('cancel');
            }
            that.deffered = func();
        }
    }
}])

/**
 * [接口统一管理]
  */
.factory('apiServer', ['ajaxServer','$rootScope',function(ajaxServer,$rootScope){
    return {
         'loginCode':function(){
             var url = $rootScope.APIHOST+'/api/make';

             return ajaxServer.send({
                 method:"POST",
                 url:url
             })
         },
        //登录请求
        'login':function(oParams){
            var url = $rootScope.APIHOST+'/api/admins-login';

            return ajaxServer.send({
                method:"POST",
                url:url,
                data:$.param(oParams)
            })
        },
        //员工账号-列表
        "sysAcountList":function(oParams){
            var url = $rootScope.APIHOST+'/api/admin?token='+$.cookie("token");

            return ajaxServer.send({
                url:url,
                params:oParams
            })
        },
        //员工账号-添加
        "sysAddAcount":function(oParams){
            var url = $rootScope.APIHOST+'/api/admin?token='+$.cookie("token");

            return ajaxServer.send({
                method:"POST",
                url:url,
                data:$.param(oParams)
            })
        },
        //员工账号-修改
        "sysModifyAcount":function(oParams){
            var url = $rootScope.APIHOST+'/api/admin/'+oParams.id+'?token='+$.cookie("token");

            return ajaxServer.send({
                method:"PUT",
                url:url,
                data:$.param(oParams)
            })
        },
        //权限组-列表
        "jurGroupList":function(oParams){
            var url = $rootScope.APIHOST+'/api/role?token='+$.cookie("token");

            return ajaxServer.send({
                url:url
            })
        },
        //权限组-新增
        "jurGroupAdd":function(oParams){
            var url = $rootScope.APIHOST+'/api/role?token='+$.cookie("token");

            return ajaxServer.send({
                method:"POSt",
                url:url,
                data:$.param(oParams)
            })
        },
        //权限组-删除
        "jurGroupDel":function(oParams){
            var url = $rootScope.APIHOST+'/api/role/'+oParams.id+'?token='+$.cookie("token");

            return ajaxServer.send({
                method:"DELETE",
                url:url,
                data:$.param(oParams)
            })
        },
        //权限组-编辑
        "jurGroupEdit":function(oParams){
            var url = $rootScope.APIHOST+'/api/role/'+oParams.id+'?token='+$.cookie("token");

            return ajaxServer.send({
                method:"PUT",
                url:url,
                data:$.param(oParams)
            })
        },
        //会员-列表
        "memberList":function(oParams){
            var url = $rootScope.APIHOST+'/api/member?token='+$.cookie("token");

            return ajaxServer.send({
                url:url,
                params:oParams
            })
        },
        //会员-等级列表
        "gradeList":function(){
            var url = $rootScope.APIHOST+'/api/grade?token='+$.cookie("token");

            return ajaxServer.send({
                url:url
            })
        },
        //会员-层级列表
        "levelList":function(){
            var url = $rootScope.APIHOST+'/api/level?token='+$.cookie("token");

            return ajaxServer.send({
                url:url
            })
        },
        //会员-返水审核列表
        "fanShuiCheckList":function(){
            var url = $rootScope.APIHOST+'/api/fanshui?token='+$.cookie("token");

            return ajaxServer.send({
                url:url
            })
        },
        //会员-返水历史列表
        "fanShuiHistory":function(){
            var url = $rootScope.APIHOST+'/api/fanshui_log?token='+$.cookie("token");

            return ajaxServer.send({
                url:url
            })
        }

    }
}])
