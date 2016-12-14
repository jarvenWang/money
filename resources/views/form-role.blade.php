<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$page_name}}</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <script src="{{ asset('/js/jquery.min.js')}}"></script>
    <script src="{{ asset('/js/jquery.form.js')}}"></script>
    <script src="{{ asset('/layer/layer.js')}}"></script>
</head>
<body>
<div class="col-sm-12">
    <h3 class="text-center">{{$page_name}}</h3>
    <form class="form-horizontal" role="form" id="ajaxForm" method="post" action="">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">ID</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="name" placeholder="以英文字母开头,英文、数字组合">
            </div>
        </div>
        <div class="form-group">
            <label for="username" class="col-sm-3 control-label">名称</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="display_name" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <label for="remark" class="col-sm-3 control-label">备注</label>
            <div class="col-sm-9">
                <textarea name="description" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="remark" class="col-sm-3 control-label"></label>
            <div class="col-sm-9">
                <button type="submit" class="btn btn-primary">提交</button>
                <a href="/roles" class="btn btn-default">返回列表</a>
            </div>
        </div>
    </form>
</div>


</body>
</html>
<script>
    //登入
    var loadingIndex;
    $(function(){
        $('#ajaxForm').ajaxForm({
            beforeSubmit: beforeCheck, // 此方法主要是提交前执行的方法，根据需要设置
            success: completeDo, // 这是提交后的方法
            dataType: 'json'
        });

        function beforeCheck(){
            if( '' == $('input[name=name]').val()){
                layer.msg('ID不能为空');
                $('input[name=name]').focus();
                return false;
            }
            if( '' == $('input[name=display_name]').val()){
                layer.msg('名称不能为空');
                $('input[name=display_name]').focus();
                return false;
            }
            loadingIndex = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
        }
        function completeDo(data){
            layer.close(loadingIndex);
            if(data.status==1){
                layer.msg(data.success, {time: 1000}, function(){
                    window.location.href=data.url;
                });
            }else{
                layer.alert(data.error,{icon: 5});
                return false;
            }
        }

    });


</script>