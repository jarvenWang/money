@extends('layouts.master')

@section('title', '后台管理系统')

{{--//工具栏暂时用不到
@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection--}}

@section('content')
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
                    <p class="operte-con-money">66666666.66</p>
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
@endsection