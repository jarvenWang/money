
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
