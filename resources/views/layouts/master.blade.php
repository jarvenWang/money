<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title or '博彩后台' }}</title>
    <!-- <link rel="stylesheet" href="../bower_components/bootstrap/bootstrap.min.css"> -->

    <link rel="stylesheet" href="{{ asset('styles/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/common.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/index.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/layer/skin/layer.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/laypage/skin/laypage.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/tablesorter/themes/blue/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/bower_components/icheck-1.x/skins/minimal/blue.css')}}">


    <script type="text/javascript" src="{{ asset('bower_components/jquery/jquery-2.1.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/jquery.cookie/jquery.cookie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/echarts/echarts.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/laydate/laydate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/tablesorter/jquery.tablesorter.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/layer/layer.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/laypage/laypage.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/audioplayer/audioplayer.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/bower_components/icheck-1.x/icheck.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('scripts/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('scripts/common.js') }}"></script>




{{--    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">--}}
   {{-- <script src="{{ asset('/js/jquery.min.js')}}"></script>--}}
    <script src="{{ asset('/js/jquery.form.js')}}"></script>

</head>
<body>
<!-- moudle header -->
<div class="in-header-wrap clearfix"  id="head-fix">
    <ul class="in-header-l ">
        <li class="in-iteml-fir in-item  in-hoverbg in-bigpic01">
            常规
            <ul class="in-itemmenu">
                <li class="in-iteml-sec bs-page  bs-page-l" data-page="main"><a href="javascript:;">运营状况</a> </li>
                <li class="in-iteml-sec bs-page  bs-page-l" data-page="routine-setting"><a href="javascript:;">设置</a> </li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="noticeList"><a href="javascript:;">公告</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="messageList"><a href="javascript:;">短信</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="routine-account"><a href="javascript:;">账号</a></li>
                <span class="intemmenu-sj"></span>
            </ul>
        </li>
        <li class="in-iteml-fir in-item in-bigpic02">
            活动
            <ul class="in-itemmenu">
                <li class="in-iteml-sec bs-page bs-page-l" data-page="activity-module"><a href="javascript:;">模块</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="activity-list"><a href="javascript:;">列表</a></li>
                <span class="intemmenu-sj"></span>
            </ul>
        </li>
        <li class="in-iteml-fir in-item in-bigpic03 ">
            会员
            <ul class="in-itemmenu">
                <li class="in-iteml-sec bs-page bs-page-l" data-page="member-grade"><a href="javascript:;">等级</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="member-level"><a href="javascript:;">层级</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="member-list"><a href="javascript:;">列表</a></li>
                <span class="intemmenu-sj"></span>
            </ul>
        </li>
        <li class="in-iteml-fir in-item in-bigpic04">
            代理
            <ul class="in-itemmenu">
                <li class="in-iteml-sec bs-page bs-page-l" data-page="agent-level"><a href="javascript:;">层级</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="agent-notice"><a href="javascript:;">公告</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="agent-review"><a href="javascript:;">审核</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="agent-list"><a href="javascript:;">列表</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="agent-commission"><a href="javascript:;">佣金计算</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="agent-historycommission"><a href="javascript:;">历史佣金</a></li>
                <span class="intemmenu-sj"></span>
            </ul>
        </li>
        <li class="in-iteml-fir in-item in-bigpic05">
            财务
            <ul class="in-itemmenu">
                <li class="in-iteml-sec bs-page bs-page-l" data-page="finance-interface"><a href="javascript:;">接口</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="finance-record"><a href="javascript:;">记录</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="finance-accountchange"><a href="javascript:;">账变</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="finance-debit"><a href="javascript:;">加扣款</a></li>
                <span class="intemmenu-sj"></span>
            </ul>
        </li>
        <li class="in-iteml-fir in-item in-bigpic06">
            记录
            <ul class="in-itemmenu" >
                <li class="in-iteml-sec bs-page bs-page-l" data-page="record-sports"><a href="javascript:;">体育</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="record-lottery"><a href="javascript:;">彩票</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="record-video"><a href="javascript:;">视讯</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="record-bandit"><a href="javascript:;">老虎机</a></li>
                <span class="intemmenu-sj"></span>
            </ul>
        </li>
        <li class="in-iteml-fir in-item in-bigpic07">
            报表
            <ul class="in-itemmenu">
                <li class="in-iteml-sec bs-page bs-page-l" data-page="report-whole"><a href="javascript:;">全局</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="report-finance"><a href="javascript:;">财务</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="report-game"><a href="javascript:;">游戏</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="report-account"><a href="javascript:;">对账</a></li>
                <span class="intemmenu-sj"></span>
            </ul>
        </li>
        <li class="in-iteml-fir in-item in-bigpic08">
            分析
            <ul class="in-itemmenu">
                <li class="in-iteml-sec bs-page bs-page-l" data-page="analysis-member"><a href="javascript:;">会员</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="analysis-game"><a href="javascript:;">游戏</a></li>
                <li class="in-iteml-sec bs-page bs-page-l" data-page="analysis-operate"><a href="javascript:;">运营</a></li>
                <span class="intemmenu-sj"></span>
            </ul>
        </li>
    </ul>
    <!-- // head left -->
    <ul class="in-header-r ">
        <li class="in-itemr-fir in-item in-item-custom ">
            <ul class="in-itemmenu in-itemmenu-customer ">
                <li class="in-iteml-sec bs-page" data-page="customer-setting"><a href="/main">主页</a></li>
                <li class="in-iteml-sec bs-page" data-page="customer-setting"><a href="javascript:;">设置</a></li>
                <li class="in-iteml-sec bs-page" data-page="customer-answer"><a href="javascript:;">应答</a></li>
                <li class="in-iteml-sec bs-page" data-page="customer-invited"><a href="javascript:;">主动邀请</a></li>
                <li class="in-iteml-sec bs-page" data-page="customer-repass"><a href="javascript:;">修改密码</a></li>
                <li class="in-iteml-sec bs-page" ><a href="\logout">退出</a></li>
                <span class="intemmenu-sj"></span>
            </ul>
        </li>
        <li class="in-itemr-fir in-item in-item-operte ">
            <ul class="in-itemmenu in-itemmenu-operate">
                <li class="in-iteml-sec bs-page" data-page="operate-status"><a href="javascript:;">运营状况</a></li>
                <li class="in-iteml-sec bs-page" data-page="operate-online"><a href="javascript:;">在线人数</a></li>
                <li class="in-iteml-sec bs-page" data-page="operate-betting"><a href="javascript:;">下注反水</a></li>
                <span class="intemmenu-sj"></span>
            </ul>
        </li>
        <li class="in-itemr-fir in-item in-item-check">
            <ul class="in-itemmenu in-itemmenu-check">
                <li class="in-iteml-sec bs-page" data-page="review-discount"><a href="javascript:;">优惠审核</a></li>
                <li class="in-iteml-sec bs-page" data-page="review-agent"><a href="javascript:;">代理审核</a></li>
                <span class="intemmenu-sj"></span>
            </ul>
        </li>
        <li class="in-itemr-fir in-item in-item-deposit">
            <ul class="in-itemmenu in-itemmenu-check">
                <li class="in-iteml-sec bs-page" data-page="money-deposit"><a href="javascript:;">入款</a><span class="deposit-tipnum">1</span></li>
                <li class="in-iteml-sec bs-page" data-page="money-drawing"><a href="javascript:;">提款</a><span class="deposit-tipnum">2</span></li>
                <span class="intemmenu-sj"></span>
            </ul>
            <span class="in-itemr-num">3</span>
        </li>
    </ul>
</div>
<!--// module header   -->

<!-- moudle include page -->
<div class="include-page" id="include-page">

    <!-- module header end  -->
    <div class="in-curpage-wrap">
        <a href="#">报表</a> —>
        <a href="#" class="in-curpage-active">图表页</a>
    </div>
    <!-- module section start -->
    <div class="in-content-wrap">
        <div class="operte-content-wrap">
            <!-- title head start -->
            <ul class="operte-con-ul clearfix">
                <li class="operte-con-tititem operte-titlist-bg01">
                    <p class="operte-con-money">1,0000,0000</p>
                    <p class="operte-month-deposit">月首存</p>
                </li>
                <li class="operte-con-tititem operte-titlist-bg02">
                    <p class="operte-con-money">1,0000,0000</p>
                    <p class="operte-month-deposit">月存款</p>
                </li>
                <li class="operte-con-tititem operte-titlist-bg03">
                    <p class="operte-con-money">1,0000,0000</p>
                    <p class="operte-month-deposit">月存款</p>
                </li>
                <li class="operte-con-tititem operte-titlist-bg04">
                    <p class="operte-con-money">1,0000,0000</p>
                    <p class="operte-month-deposit">月存款</p>
                </li>
                <li class="operte-con-tititem operte-titlist-bg05">
                    <p class="operte-con-money">1,0000,0000</p>
                    <p class="operte-month-deposit">月存款</p>
                </li>
                <!-- <li class="operte-con-tititem operte-titlist-bg06">
                    <p class="operte-con-money">1,0000,0000</p>
                    <p class="operte-month-deposit">月存款</p>
                </li> -->
            </ul>
            <!-- title head end  -->

            <h1>demo 图表的配置使用</h1>
            <div class="operte-chart-list clearfix">
                <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
                <!-- 折线图 -->
                <div class="operte-chart-box">
                    <div id="broken-line" class="operte-chart-size"></div>
                </div>
                <!-- 柱状图 -->
                <div class="operte-chart-box">
                    <div id="histogram-picture" class="operte-chart-size"></div>
                </div>
                <!-- 饼状图 -->
                <div class="operte-chart-box">
                    <div id="pie-picture" class="operte-chart-size"></div>
                </div>

            </div>
        </div>
    </div>
    <!-- module section end -->
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var brokenLine = echarts.init(document.getElementById("broken-line"));
        var histogramPic = echarts.init(document.getElementById('histogram-picture'));
        var piePic = echarts.init(document.getElementById('pie-picture'));

        // 指定图表的配置项和数据
        var option1 = {
            title: {
                text: '彩票访问量变化'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ['最高访问量', '最低访问量']
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: ['周一', '周二', '周三', '周四', '周五', '周六', '周日']
            },
            yAxis: {
                type: 'value',
                axisLabel: {
                    formatter: '{value} '
                }
            },
            series: [{
                name: '访问量',
                type: 'line',
                data: [11, 11, 15, 13, 12, 13, 10],
                markPoint: {
                    data: [{
                        type: 'max',
                        name: '最大值'
                    }, {
                        type: 'min',
                        name: '最小值'
                    }]
                }
            },
                {
                    name: '访问量2',
                    type: 'line',
                    data: [1, 3, 2, 6, 2, 5, 3],
                    markPoint: {
                        data: [{
                            type: 'max',
                            name: '最大值'
                        }, {
                            type: 'min',
                            name: '最小值'
                        }]
                    }
                }]
        };


        var option2 = {
            title: {
                text: '盈利和投资'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ['盈利', '投资']
            },
            calculable: true,
            xAxis: [{
                type: 'category',
                data: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月']
            }],
            yAxis: [{
                type: 'value'
            }],
            series: [{
                name: '盈利',
                type: 'bar',
                data: [2.0, 4.9, -7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3],
                markPoint: {
                    data: [{
                        type: 'max',
                        name: '最大值'
                    }, {
                        type: 'min',
                        name: '最小值'
                    }]
                }
            }, {
                name: '投资',
                type: 'bar',
                data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3],
                markPoint: {
                    data: [{
                        name: '年最高',
                        value: 182.2,
                        xAxis: 7,
                        yAxis: 183
                    }, {
                        name: '年最低',
                        value: 2.3,
                        xAxis: 11,
                        yAxis: 3
                    }]
                }
            }]
        };


        var option3 = {
            title: {
                text: '客户地区分布',
                x: 'center'
            },
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data: ['深圳', '北京', '上海', '天津', '国外']
            },
            series: [{
                name: '访问人数',
                type: 'pie',
                radius: '55%',
                center: ['50%', '60%'],
                data: [{
                    value: 335,
                    name: '深圳'
                }, {
                    value: 310,
                    name: '北京'
                }, {
                    value: 234,
                    name: '上海'
                }, {
                    value: 135,
                    name: '天津'
                }, {
                    value: 1548,
                    name: '其它'
                }],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        brokenLine.setOption(option1);
        histogramPic.setOption(option2);
        piePic.setOption(option3);
    </script>


</div>

<!-- // moudle include page -->

<!-- 组件引入  -->

</body>
</html>