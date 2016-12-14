$(function(){
	/**
	*   @description [项目页面嵌套的解决方案：load]
	*   @attr     [data-page]  获取嵌套页名称的属性
	*   @class  [.bs-page]    嵌套需要加的样式名
	*   @class  [.include-page]  嵌套页添加的区域 样式名
	 */
	var pageRecord = sessionStorage.getItem("pageName");
	var isLoad=false; //遮罩还在时，左边不能点击
	if(!pageRecord){
		$(".include-page").load("main.html");
	}else{
		$(".include-page").load(pageRecord);	
	}
	$(".bs-page").on("click",function(){
		var pageName = $(this).attr("data-page")+".html";
		loadPage(pageName);
	})
	

	/**
	 *  @param  [pageName]   页面名称：如main.html
	 *  @funtion  [loadPage]     加载页面
	 */
	function loadPage(pageName){
		if(isLoad && $(this).hasClass('bs-page-l')){
			return false;
		}
		var index = layer.load(1, {
		  	shade: [0.1,'#000']
		});
		isLoad = true;
		sessionStorage.setItem("pageName",pageName);
		$(".include-page").load(pageName,function(){
			setTimeout(function(){
				layer.close(index);
				isLoad = false;
			},10)
		});
	}
})