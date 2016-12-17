/**
 * @盘古项目
 * # 盘古后台
 *
 * Main module of the application.
 */

/**
 * [app 创建和配置应用的入口模块]
 * @type {[type]}
 */

pangu.app=angular.module('App', [
	'ui.router',
	'oc.lazyLoad',
	'common',
	'ui.grid',
	'ui.grid.pagination',
	'ui.grid.edit',
	'ui.grid.autoResize',
	'tableSort'
])
.run(['$rootScope','$state','$location',function($rootScope,$state,$location){

	$rootScope.config = pangu.config;
	$rootScope.APIHOST = $rootScope.config.apiHost; 	    //接口地址
	$rootScope.WSHOST =  $rootScope.config.webSocketHost;  	//webSocket地址
	$rootScope.token ='';   //接口请求必带参数

}])
/*.config(['$stateProvider','$urlRouterProvider','$httpProvider',function($stateProvider, $urlRouterProvider,$httpProvider) {

	$stateProvider
			.state("login", {
				url: "/login",
				templateUrl: pangu.config.path+"login.html",
				controller: "loginCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/loginMod/login.js');
					}]
				}
			})
			.state("index", {
				url: "/index",
				templateUrl: pangu.config.path+"main.html",
				controller: "mainCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/home/main.js');
					}]
				}
			})
			.state("index.sysSetting", {
				url: "/sysSetting",
				templateUrl: pangu.config.path+"sysSetting.html",
				controller: "sysSettingCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/systemMod/sysSetting.js');
					}]
				}
			})
			.state("index.sysGame", {
				url: "/sysGame",
				templateUrl: pangu.config.path+"sysGame.html",
				controller: "sysGameCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/systemMod/sysGame.js');
					}]
				}
			})
			.state("index.sysAccount", {
				url: "/sysAccount",
				templateUrl: pangu.config.path+"sysAccount.html",
				controller: "sysAccountCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/systemMod/sysAccount.js');
					}]
				}
			})
			.state("index.sysJournal", {
				url: "/sysJournal",
				templateUrl: pangu.config.path+"sysJournal.html",
				controller: "sysJournalCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/systemMod/sysJournal.js');
					}]
				}
			})

	$urlRouterProvider.otherwise('/index');


	//注入拦截器
	$httpProvider.interceptors.push('interceptor');

}])*/
.config(['$stateProvider','$urlRouterProvider','$httpProvider',function($stateProvider, $urlRouterProvider,$httpProvider) {

	$stateProvider
			//登录
			.state("login", {
				url: "/login",
				templateUrl: pangu.config.path+"login.html",
				controller: "loginCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/loginMod/login.js');
					}]
				}
			})
			//系统
			.state("index", {
				url: "/index",
				templateUrl: pangu.config.path+"sysSetting.html",
				controller: "sysSettingCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/systemMod/sysSetting.js');
					}]
				}
			})
			.state("sysGame", {
				url: "/sysGame",
				templateUrl: pangu.config.path+"sysGame.html",
				controller: "sysGameCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/systemMod/sysGame.js');
					}]
				}
			})
			.state("sysShield", {
				url: "/sysShield",
				templateUrl: pangu.config.path+"sysShield.html",
				controller: "sysShieldCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/systemMod/sysShield.js');
					}]
				}
			})
			.state("sysAccount", {
				url: "/sysAccount",
				templateUrl: pangu.config.path+"sysAccount.html",
				controller: "sysAccountCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/systemMod/sysAccount.js');
					}]
				}
			})
			//员工账号-列表
			.state("sysAccount.sysAcoList", {
				url: "/sysAcoList",
				templateUrl: pangu.config.path+"sysAcoList.html",
				controller: "sysAcoListCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/systemMod/sysAcoList.js');
					}]
				}
			})
			//员工账号-权限组
			.state("sysAccount.sysAcoResign", {
				url: "/sysAcoResign",
				templateUrl: pangu.config.path+"sysAcoResign.html",
				controller: "sysAcoResignCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/systemMod/sysAcoResign.js');
					}]
				}
			})
			//员工账号-权限
			.state("sysAccount.sysAcoPer", {
				url: "/sysAcoPer",
				templateUrl: pangu.config.path+"sysAcoPer.html",
				controller: "sysAcoPerCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/systemMod/sysAcoPer.js');
					}]
				}
			})
			.state("sysJournal", {
				url: "/sysJournal",
				templateUrl: pangu.config.path+"sysJournal.html",
				controller: "sysJournalCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/systemMod/sysJournal.js');
					}]
				}
			})
			//运营
			.state("operateReport", {
				url: "/operateReport",
				templateUrl: pangu.config.path+"operateReport.html",
				controller: "operateReportCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/operate/operateReport.js');
					}]
				}
			})
			//财务
			.state("finance", {
				url: "/finance",
				templateUrl: pangu.config.path+"finance.html",
				controller: "financeCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/finance/finance.js');
					}]
				}
			})
			//客服
			.state("customer", {
				url: "/customer",
				templateUrl: pangu.config.path+"customer.html",
				controller: "customerCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/customer/customer.js');
					}]
				}
			})
			//会员
			.state("memberList", {
				url: "/memberList",
				templateUrl: pangu.config.path+"memberList.html",
				controller: "memberListCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/member/memberList.js');
					}]
				}
			})
			.state("memberFanShui", {
				url: "/memberFanShui",
				templateUrl: pangu.config.path+"memberFanShui.html",
				controller: "memberFanShuiCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/member/memberFanShui.js');
					}]
				}
			})
			//代理
			.state("agent", {
				url: "/agent",
				templateUrl: pangu.config.path+"agent.html",
				controller: "agentCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/agent/agent.js');
					}]
				}
			})
			//游戏
			.state("game", {
				url: "/game",
				templateUrl: pangu.config.path+"game.html",
				controller: "gameCtrl",
				resolve: {
					loadMyService: ['$ocLazyLoad', function($ocLazyLoad) {
						return $ocLazyLoad.load('./scripts/game/game.js');
					}]
				}
			})
	$urlRouterProvider.otherwise('/index');


	//注入拦截器
	$httpProvider.interceptors.push('interceptor');

}])




  
