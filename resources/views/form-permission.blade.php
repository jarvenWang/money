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
		<input type="hidden" name="id" value="{{$data->id}}" />
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 标识符：  </label>
			<div class="col-sm-10">
				<input type="text" name="name" id="name" placeholder="输入标识" value="{{$data->name}}" class="col-xs-10 col-sm-4" />
				<span class="lbl">&nbsp;&nbsp;<span class="red">*</span>用于判断管理员权限，请填写英文，横线和数字组合</span>
			</div>
		</div>
		<div class="space-4"></div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 名称：  </label>
			<div class="col-sm-10">
				<input type="text" name="display_name" id="display_name" value="{{$data->display_name}}" placeholder="输入中文名称" class="col-xs-10 col-sm-4" />
				<span class="lbl">&nbsp;&nbsp;<span class="red">*</span>用于在页面显示</span>
			</div>
		</div>
		<div class="space-4"></div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 描述：  </label>
			<div class="col-sm-10">
				<input type="text" name="description" id="description" value="{{$data->description}}" placeholder="输入描述" class="col-xs-10 col-sm-4" />
				<span class="lbl">&nbsp;&nbsp;填写对此权限的说明</span>
			</div>
		</div>
		<div class="space-4"></div>

		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button class="btn btn-info" type="submit">
					<i class="ace-icon fa fa-check bigger-110"></i>
					保存
				</button>

				&nbsp; &nbsp; &nbsp;
				<a class="btn" href="/permissions">
					返回列表
				</a>
			</div>
		</div>

	</form>
</div>


</body>
</html>
<script>
	var loadingIndex;
	$(function(){
		$('#ajaxForm').ajaxForm({
			beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
			success: complete, // 这是提交后的方法
			dataType: 'json'
		});

		function checkForm(){
			if( '' == $.trim($('#name').val())){
				layer.alert('标识符不能为空', {icon: 6}, function(index){
					layer.close(index);
					$('#name').focus();
				});
				return false;
			}

			var name = $.trim($('input[name="name"]').val()); //获取INPUT值
			var myReg = /^[\u4e00-\u9fa5]+$/;//验证中文
			if(name.indexOf(" ")>=0)
			{
				layer.alert('标识符包含了空格，请重新输入', {icon: 6}, function(index){
					layer.close(index);
					$('#name').focus();
				});
				return false;
			}

			if (myReg.test(name)) {
				layer.alert('名称必须是字母，横线和数字的组合', {icon: 6}, function(index){
					layer.close(index);
					$('#name').focus();
				});
				return false;
			}

			if( '' == $.trim($('#display_name').val())){
				layer.alert('名称不能为空', {icon: 6}, function(index){
					layer.close(index);
					$('#display_name').focus();
				});
				return false;
			}
			loadingIndex = layer.load(0, {shade: false});


		}
		function complete(data){
			layer.close(loadingIndex);
			if(data.status==1){
				layer.alert(data.success, {icon: 6}, function(index){
					layer.close(index);
					if (data.url)
						window.location.href=data.url;
					else
					{
						$('#ajaxForm').reset();
					}
				});
			}else{
				layer.alert(data.error, {icon: 5}, function(index){
					layer.close(index);
					$('#name').focus();
				});
				return false;
			}
		}

	});
</script>