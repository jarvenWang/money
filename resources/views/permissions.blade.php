<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>权限节点列表</title>
	<link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
	<script src="{{ asset('/js/jquery.min.js')}}"></script>
	<script src="{{ asset('/js/jquery.form.js')}}"></script>
	<script src="{{ asset('/layer/layer.js')}}"></script>
</head>
<body>
<div class="col-sm-12">
	<h3 class="text-center">权限节点列表</h3>
	<table width="100%" class="table table-striped table-bordered table-hover" id="dynamic-table">
		<thead>
		<tr>
			<th width="17%">名称</th>
			<th width="10%">标识符</th>
			<th width="10%">描述</th>
			<th width="8%" style="border-right:#CCC solid 1px;">操作</th>
		</tr>
		</thead>

		<tbody>

		@foreach ($datas as $v)
			<tr>
				<td>{{$v->display_name}}</td>
				<td height="28" >{{$v->name}}</td>
				<td>{{$v->description}}</td>

				<td>
					<div class="hidden-sm hidden-xs action-buttons">
						<a class="green" href="/edit-permission?id={{$v->id}}" title="修改">
							编辑</a>
						<a class="red" href="javascript:;" onclick="return del({{$v->id}});" title="删除">
							删除</a>
					</div>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>


</body>
</html>
<script>
	function del(did){
		layer.confirm('你确定要删除吗？', {icon: 3}, function(index){
			$.get('/admin/delete-permission/'+did,function(data){
				layer.close(index);
				if (data.status){
					layer.msg(data.info, {
						time: 0 //不自动关闭
						,btn: ['确定']
						,yes: function(index){
							layer.close(index);
							if (data.url)
								window.location = data.url;
						}
					});
				}
			});
		});
	}
</script>