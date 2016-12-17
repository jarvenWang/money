/**
 * [pangu 全局对象]
 * @type {Object}
 */


window.pangu = {
		source:{	//本地开发环境
			path:'./views/',
			/*apiHost:"http://192.168.1.139", */  //王金宝电脑
			apiHost:"http://43.251.231.178",         //服务器接口地址
			/*apiHost:"http://192.168.1.199/master/public/",*/  //陈泽电脑
			webSocketHost:"ws://192.168.220.132:4063",
			indexPath:'c=source#/',
			loginPath:'index.php?c=source&a=login'
		},
		develop:{	//测试服务器环境
			path:'public/dist',                //测试服务图片，链接模板引用
			apiHost:"",
			webSocketHost:"ws://192.168.220.132:4063", //测试服 121.40.130.106:4063
			indexPath:'c=index#/',
			loginPath:'index.php?c=index&a=login',
		},
		production:{		//正式上线环境
			path:'public/dist/',            //正式服务图片，链接模板引用
			apiHost:"",
			webSocketHost:"ws://120.27.128.165:4063", //线上服   121.40.189.16:4063
			indexPath:'c=index#/',
			loginPath:'index.php?c=index&a=login'
		},
		setConfig:function(){
			switch (window.location.host) {
			    case "aa.aa.com": //生产环境
			    	this.config = this.production;
			        break;
			    case "bb.bb.com": //测试环境
			        this.config = this.develop;
			        break;
			    default:  		         //本地前端开发环境
			        this.config = this.source;
			        break;
			}
		},
		config:{},      //存放全局配置路径
		app:{},         //存放应用的入口模块
		common:{}       //存放公用模块
};

pangu.setConfig();

