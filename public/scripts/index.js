$(function() {
	/**
	* 头部下拉效果
	 */
	var itemFir = $(".in-iteml-fir"),
		itemSec = $(".in-iteml-sec");
	//下拉菜单
	itemFir.hover(function() {
		$(this).addClass('in-hoverbg').siblings().removeClass('in-hoverbg').end().find(".in-itemmenu").show();
	}, function() {
		$(this).find(".in-itemmenu").hide();
	});
	//二级菜单选中效果
	itemSec.hover(function() {
		$(this).addClass('in-hoverbg2');
	}, function() {
		$(this).removeClass('in-hoverbg2');
	});
	//右边下拉框
	var itemR01 = $(".in-item");
	itemR01.hover(function() {
		$(this).addClass('in-itemmenu-customer').find(".in-itemmenu").show();
	}, function() {
		$(this).removeClass("in-itemmenu-customer").find(".in-itemmenu").hide();
	});
	

	/**
	*  @ function  [messageTip]   左下角消息提示框
	 */
	function messageTip(){
		layer.open({
			type: 1,
			title:' 信息',
			skin: 'layui-layer-demo', //样式类名
			closeBtn: 1, //不显示关闭按钮
			shift: 2,
			area: ['340px', '215px'],
			time: 3000,    //2秒后自动关闭
			offset: 'rb',     //右下角弹出
			shade: 0, //开启遮罩关闭
			content: '我是提示的内容'
		});
	}
	//messageTip();
	
})






