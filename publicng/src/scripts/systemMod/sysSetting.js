/**
 * Created by Administrator on 2016/12/7.
 */
angular.module('sysSetting', [])
.controller('sysSettingCtrl', function(){

   /* layui.use('form', function(){
        var form = layui.form(); //只有执行了这一步，部分表单元素才会修饰成功

    });*/
    //layui模块引入
    layui.use(['form','layer','element'], function(){
        console.log(222)
        var form = layui.form();
        form.render('radio');
    });


})