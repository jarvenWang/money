
<div class="in-curpage-wrap">
    <a href="#">设置</a> —>
    <a href="#" class="in-curpage-active">接口</a>
</div>
<!-- module routine-setting  -->
<div class="in-content-wrap">
    <div id="tabs">
        <ul class="tab-title clearfix">
            <li class="tabulous_active">支付接口设置</li>
            <li>安全转账设置</li>
            <li>支付宝设置</li>
            <li>微信设置</li>
            <li>新支付宝设置</li>
            <li>新微信设置</li>
            <li>添加支付平台</li>
        </ul>
        <div id="tabs_container" class="routine-tab-wrap">
            <div id="tabs-1" class="tab-itembox">
                <form name="setpayapi" id="setpayapi"  method="post" action="/set-payapi">
                    <!-- 列表数据  -->
                    <table  id="myTable" class="tablesorter table  table-bordered ">
                        <tbody>
                        <tr >
                                <!--  select -->
                                <div class="com-form-group clearfix">
                                    {{--代理商的id(或管理员的id)--}}
                                    <input type="hidden" name="reseller_id" value="{{$reseller_id}}">
                                    <input type="hidden" name="auth_key" value="{{$auth_key}}">


                                    <label class="com-form-l com-fl com-lh" >所属平台：</label>
                                    <div class="com-form-r com-fl">
                                        <select name="payment_id" id="" class="com-select">
                                            <option value="0">请选择支付平台</option>
                                            @foreach($data as $key)
                                                <option value="{{$key->id}}">{{$key->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- //select -->
                                <div class="com-form-wrap">
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">接口名称：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" name="name" class="com-input-text com-input-sizemid">
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <!--  select -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh" >接口类型：</label>
                                        <div class="com-form-r com-fl">
                                            <select name="type" id="" class="com-select">
                                                <option value="1">主要接口</option>
                                                <option value="2">备用接口</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- //select -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">商户号码：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" name="auth_username" class="com-input-text com-input-sizemid">
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">接口密钥：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" name="auth_password" class="com-input-text com-input-sizemid" style="width: 800px;">
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">接口域名：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" name="website" class="com-input-text com-input-sizemid">
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">最低支付：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" name="min_pay" class="com-input-text com-input-sizemid">
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">最高支付：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" name="max_pay" class="com-input-text com-input-sizemid">
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">停用上限：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" name="limit" class="com-input-text com-input-sizemid">
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <!--  select -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh" >是否启用：</label>
                                        <div class="com-form-r com-fl">
                                            <select name="status" id="" class="com-select">
                                                <option value="1">开启</option>
                                                <option value="2">关闭</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- //select -->
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">备注说明：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" name="remark" class="com-input-text com-input-sizemid" value="" style="width: 800px;">
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <!-- button -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl"></label>
                                        <div class="com-form-r com-fl">
                                            <button type="submit" class="com-bigbtn com-btn-color02 subrole">发布接口</button>
                                        </div>
                                    </div>
                                    <!-- //button -->
                                </div>
                        </tr>
                        </tbody>
                    </table>
                    <!-- //列表数据  -->
                </form>

                <!-- 编辑设置隐藏的列表数据  -->
<div id="editpayapi" style="display: none;">
    <form name="formpayapi" id="formpayapi"  method="post" action="/doedit-channel">

            <table class="tablesorter table  table-bordered ">
                    <tbody>
                    <tr >
                        <!--  select -->
                        <div class="com-form-group clearfix">
                            {{--代理商的id(或管理员的id)--}}
                            <input type="hidden" name="reseller_id" value="{{$reseller_id}}">
                            <input type="hidden" name="auth_key" value="{{$auth_key}}">
                            <input type="hidden" name="id" id="editid" value="">


                            <label class="com-form-l com-fl com-lh" >所属平台：</label>
                            <div class="com-form-r com-fl">
                                <select name="payment_id" id="payment_id" class="com-select">
                                    <option  value="0">请选择支付平台</option>
                                    @foreach($data as $key)
                                        <option value="{{$key->id}}">{{$key->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- //select -->
                        <div class="com-form-wrap">
                            <!-- input -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">接口名称：</label>
                                <div class="com-form-r com-fl">
                                    <input id="name" type="text" name="name" class="com-input-text com-input-sizemid" value="">
                                </div>
                            </div>
                            <!-- //input -->
                            <!--  select -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh" >接口类型：</label>
                                <div class="com-form-r com-fl">
                                    <select name="type" id="type" class="com-select">
                                        <option value="1">主要接口</option>
                                        <option value="2">备用接口</option>
                                    </select>
                                </div>
                            </div>
                            <!-- //select -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">商户号码：</label>
                                <div class="com-form-r com-fl">
                                    <input id="auth_username" type="text" name="auth_username" class="com-input-text com-input-sizemid" value="">
                                </div>
                            </div>
                            <!-- //input -->
                            <!-- input -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">接口密钥：</label>
                                <div class="com-form-r com-fl">
                                    <input id="auth_password" type="text" name="auth_password" class="com-input-text com-input-sizemid" value="" style="width: 800px;">
                                </div>
                            </div>
                            <!-- //input -->
                            <!-- input -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">接口域名：</label>
                                <div class="com-form-r com-fl">
                                    <input id="website" type="text" name="website" class="com-input-text com-input-sizemid" value="">
                                </div>
                            </div>
                            <!-- //input -->
                            <!-- input -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">最低支付：</label>
                                <div class="com-form-r com-fl">
                                    <input id="min_pay" type="text" name="min_pay" class="com-input-text com-input-sizemid" value="">
                                </div>
                            </div>
                            <!-- //input -->
                            <!-- input -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">最高支付：</label>
                                <div class="com-form-r com-fl">
                                    <input id="max_pay" type="text" name="max_pay" class="com-input-text com-input-sizemid" value="">
                                </div>
                            </div>
                            <!-- //input -->
                            <!-- input -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">停用上限：</label>
                                <div class="com-form-r com-fl">
                                    <input id="limit" type="text" name="limit" class="com-input-text com-input-sizemid" value="">
                                </div>
                            </div>
                            <!-- //input -->
                            <!--  select -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh" >是否启用：</label>
                                <div class="com-form-r com-fl">
                                    <select name="status" id="status" class="com-select">
                                        <option value="1">开启</option>
                                        <option value="2">关闭</option>
                                    </select>
                                </div>
                            </div>
                            <!-- //select -->
                            <!-- input -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl com-lh">备注说明：</label>
                                <div class="com-form-r com-fl">
                                    <input id="remark" type="text" name="remark" class="com-input-text com-input-sizemid" value="" style="width: 800px;">
                                </div>
                            </div>
                            <!-- //input -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!-- button -->
                            <div class="com-form-group clearfix">
                                <label class="com-form-l com-fl"></label>
                                <div class="com-form-r com-fl">
                                    <button type="submit" class="com-bigbtn com-btn-color02 subrole">修改接口</button>
                                </div>
                            </div>
                            <!-- //button -->
                        </div>
                    </tr>
                    </tbody>
                </table>
        </form>
</div>

                <!-- 列表数据  -->
                <table  id="myTable" class="tablesorter table  table-bordered ">
                    <thead>
                    <tr>
                        <th align="center">编号</th>
                        <th align="center">接口名称</th>
                        <th align="center">最低支付</th>
                        <th align="center">最高支付</th>
                        <th class="col-sm-2">停用上限</th>
                        <th class="col-sm-2">状态</th>
                        <th class="col-sm-2">说明</th>
                        <th class="col-sm-2">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr >


                        @foreach($channel_data as $channel)
                    <tr class="the{{$channel->id}}">
                        <td align="center">{{$channel->id}}</td>
                        <td align="center">{{$channel->name}}</td>
                        <td align="center">{{$channel->min_pay}}</td>
                        <td align="center">{{$channel->max_pay}}</td>
                        <td align="center">{{$channel->limit}}</td>
                        <td align="center">
                            @if($channel->status==1)
                                <a class="com-smallbtn com-btn-color01 editer-btn">开启</a>
                                @if($channel->type==1)
                                    /主
                                @else
                                    /备
                                @endif
                            @else
                                <a class=" com-smallbtn com-btn-color02 ml5 del-btn">关闭</a>
                                @if($channel->type==1)
                                    /主
                                @else
                                    /备
                                @endif
                            @endif
                        </td>
                        <td align="center">{{$channel->remark}}</td>
                        <td align="center"><a onclick="editchannel({{$channel->id}})" class="com-smallbtn com-btn-color01 editer-btn">编辑</a><a onclick="delchannel({{$channel->id}})" class=" com-smallbtn com-btn-color02 ml5 del-btn">删除</a></td>
                        </tr>
                        @endforeach

                    </tr>

                    </tbody>
                </table>
            </div>
            <!-- // tab-1 -->

            {{--安全转账设置--}}
            <div id="tabs-2" class="tab-itembox" style="display: none;">
                <form name="setpayapitt" id="setpayapitt"  method="post" action="/add-transfer">
                    <!-- 列表数据  -->
                    <table  id="myTable" class="tablesorter table  table-bordered ">
                        <tbody>
                        <tr >
                            <!--  select -->
                            <div class="com-form-group clearfix">
                                {{--代理商的id(或管理员的id)--}}
                                <input type="hidden" name="reseller_id" value="{{$reseller_id}}">

                                <label class="com-form-l com-fl com-lh" style="font-size:14px;">所属层级：</label>
                                <div class="com-form-r com-fl">
                                    <select name="level_id" id="" class="com-select">
                                        <option value="0">所有层级</option>
                                        @foreach($level_data as $level)
                                            <option value="{{$level->id}}">{{$level->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- //select -->
                            <div class="com-form-wrap">
                                <div class="com-form-group clearfix">
                                    <label class="com-form-l com-fl com-lh" >所属银行：</label>
                                    <div class="com-form-r com-fl">
                                        <select name="bank_id" id="" class="com-select">
                                            <option value="0">请选择所属银行</option>
                                            <option value="1">中国银行</option>
                                            <option value="2">招商银行</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="com-form-group clearfix">
                                    <label class="com-form-l com-fl com-lh">银行名称：</label>
                                    <div class="com-form-r com-fl">
                                        <input type="text" name="bank_name" class="com-input-text com-input-sizemid">
                                    </div>
                                </div>
                                <!-- //input -->
                                <!-- input -->
                                <div class="com-form-group clearfix">
                                    <label class="com-form-l com-fl com-lh">银行账户：</label>
                                    <div class="com-form-r com-fl">
                                        <input type="text" name="bank_account" class="com-input-text com-input-sizemid">
                                    </div>
                                </div>
                                <!-- //input -->
                                <!-- input -->
                                <div class="com-form-group clearfix">
                                    <label class="com-form-l com-fl com-lh">开户信息：</label>
                                    <div class="com-form-r com-fl">
                                        <input type="text" name="bank_info" class="com-input-text com-input-sizemid" style="width: 800px;">
                                    </div>
                                </div>
                                <!-- //input -->
                                <!-- input -->
                                <div class="com-form-group clearfix">
                                    <label class="com-form-l com-fl com-lh">银行网址：</label>
                                    <div class="com-form-r com-fl">
                                        <input type="text" name="website" class="com-input-text com-input-sizemid"  style="width: 800px;">
                                    </div>
                                </div>
                                <!-- //input -->
                                <!-- input -->
                                <div class="com-form-group clearfix">
                                    <label class="com-form-l com-fl com-lh">最低支付：</label>
                                    <div class="com-form-r com-fl">
                                        <input type="text" name="min_pay" class="com-input-text com-input-sizemid">
                                    </div>
                                </div>
                                <!-- //input -->
                                <!-- input -->
                                <div class="com-form-group clearfix">
                                    <label class="com-form-l com-fl com-lh">最高支付：</label>
                                    <div class="com-form-r com-fl">
                                        <input type="text" name="max_pay" class="com-input-text com-input-sizemid">
                                    </div>
                                </div>
                                <!-- //input -->
                                <!-- input -->
                                <div class="com-form-group clearfix">
                                    <label class="com-form-l com-fl com-lh">上级报警：</label>
                                    <div class="com-form-r com-fl">
                                        <input type="text" name="limit" class="com-input-text com-input-sizemid">
                                    </div>
                                </div>
                                <!-- //input -->
                                <!--  select -->
                                <div class="com-form-group clearfix">
                                    <label class="com-form-l com-fl com-lh" >是否启用：</label>
                                    <div class="com-form-r com-fl">
                                        <select name="status" id="" class="com-select">
                                            <option value="1">开启</option>
                                            <option value="2">关闭</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- //select -->
                                <!-- input -->
                                <div class="com-form-group clearfix">
                                    <label class="com-form-l com-fl com-lh">备注说明：</label>
                                    <div class="com-form-r com-fl">
                                        <input type="text" name="remark" class="com-input-text com-input-sizemid" value="" style="width: 800px;">
                                    </div>
                                </div>
                                <!-- //input -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <!-- button -->
                                <div class="com-form-group clearfix">
                                    <label class="com-form-l com-fl"></label>
                                    <div class="com-form-r com-fl">
                                        <button type="submit" class="com-bigbtn com-btn-color02 subrole">发布转账设置</button>
                                    </div>
                                </div>
                                <!-- //button -->
                            </div>
                        </tr>
                        </tbody>
                    </table>
                    <!-- //列表数据  -->
                </form>

{{--修改安全转账设置--}}
                <div id="edit_settings" style="display: none;">
                    <form name="form_settings" id="form_settings"  method="post" action="/doedit-settings">

                        <table class="tablesorter table  table-bordered ">
                            <tbody>
                            <tr >
                                <!--  select -->
                                <div class="com-form-group clearfix">
                                    {{--代理商的id(或管理员的id)--}}
                                    <input type="hidden" name="ide" id="ide" value="">


                                    <label class="com-form-l com-fl com-lh" >所属层级：</label>
                                    <div class="com-form-r com-fl">
                                        <select name="level_id" id="level_id" class="com-select">
                                            <option  value="0">所有属级</option>
                                            @foreach($level_data as $level)
                                                <option value="{{$level->id}}">{{$level->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- //select -->
                                <div class="com-form-wrap">
                                    <!--  select -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh" >所属银行：</label>
                                        <div class="com-form-r com-fl">
                                            <select name="bank_id" id="bank_id" class="com-select">
                                                <option value="0">请选择所属银行</option>
                                                <option value="1">中国银行</option>
                                                <option value="2">招商银行</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- //select -->
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">持卡人：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" name="reseller_ide" id="reseller_ide" class="com-input-text com-input-sizemid"  value="">
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">银行账户：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" name="bank_account" id="bank_account" class="com-input-text com-input-sizemid"  value="">
                                        </div>
                                    </div>
                                    <!-- //input -->

                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">最低支付：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" name="min_paye" id="min_paye" class="com-input-text com-input-sizemid" value="">
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">最高支付：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" name="max_paye" id="max_paye" class="com-input-text com-input-sizemid" value="">
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">上级报警：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" name="limite" id="limite" class="com-input-text com-input-sizemid" value="">
                                        </div>
                                    </div>
                                    <!-- //input -->
                                    <!--  select -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh" >是否启用：</label>
                                        <div class="com-form-r com-fl">
                                            <select name="statuse" id="statuse" class="com-select">
                                                <option value="1">开启</option>
                                                <option value="2">关闭</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- //select -->
                                    <!-- input -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl com-lh">备注说明：</label>
                                        <div class="com-form-r com-fl">
                                            <input type="text" name="remarke" id="remarke" class="com-input-text com-input-sizemid" value="" style="width: 800px;">
                                        </div>
                                    </div>
                                    <!-- //input -->


                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <!-- button -->
                                    <div class="com-form-group clearfix">
                                        <label class="com-form-l com-fl"></label>
                                        <div class="com-form-r com-fl">
                                            <button type="submit" class="com-bigbtn com-btn-color02 subrole">修改安全转账设置</button>
                                        </div>
                                    </div>
                                    <!-- //button -->
                                </div>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>

                <!-- 列表数据  -->
                <table  id="myTable" class="tablesorter table  table-bordered ">
                    <thead>
                    <tr>
                        <th align="center">编号</th>
                        <th align="center">所属层级</th>
                        <th align="center">所属银行</th>
                        <th align="center">持卡人</th>
                        <th align="center">账号</th>
                        <th class="col-sm-2">单笔最低</th>
                        <th class="col-sm-2">单笔最高</th>
                        <th class="col-sm-2">停用上限</th>
                        <th class="col-sm-2">今日入款次</th>
                        <th class="col-sm-2">今日总入款</th>
                        <th class="col-sm-2">状态</th>
                        <th class="col-sm-2">备注</th>
                        <th class="col-sm-2">编辑</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach($settings_data as $setting)
                        <tr class="set{{$setting->id}}">
                            <td align="center">{{$setting->id}}</td>
                            <td align="center">{{$setting->level_id}}</td>
                            <td align="center">{{$setting->bank_id}}</td>
                            <td align="center">{{$setting->reseller_id}}</td>
                            <td align="center">{{$setting->bank_account}}</td>
                            <td align="center">{{$setting->min_pay}}</td>
                            <td align="center">{{$setting->max_pay}}</td>
                            <td align="center">{{$setting->limit}}</td>
                            <td align="center"></td>
                            <td align="center"></td>
                            <td align="center">{{$setting->status}}</td>
                            <td align="center">{{$setting->remark}}</td>
                            <td align="center"><a onclick="editsettings({{$setting->id}})" class="com-smallbtn com-btn-color01 editer-btn">编辑</a><a onclick="delsettings({{$setting->id}})" class=" com-smallbtn com-btn-color02 ml5 del-btn">删除</a></td>
                        </tr>
                        @endforeach

                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- // tab-5 -->
            <div id="tabs-5" class="tab-itembox" style="display: none;">
                <form>

                    <!-- //列表数据  -->
                </form>
            </div>
            <!-- // tab-2 -->
            <div id="tabs-3" class="tab-itembox" style="display: none;">
                <form  name="loginForma" id="loginForma" method="post" action="/add-role">

                </form>
            </div>
            <!-- // tab-3 -->
            <div id="tabs-4" class="tab-itembox" style="display: none;">
                <form  name="loginForm" id="loginForm" method="post" action="/add-user">

                </form>
            </div>

            <!-- // tab-4 -->
            <div id="tabs-4" class="tab-itembox" style="display: none;">
                <form name="loginFormb"  method="post" action="/add-permission">

                </form>
            </div>


            <!-- // tab-5 -->
            <div id="tabs-5" class="tab-itembox" style="display: none;">
                <form name="add_mode" id="add_mode"  method="post" action="/add-mode">
                    <div class="com-form-wrap">
                        <!-- input -->
                        <div class="com-form-group clearfix">
                            <label class="com-form-l com-fl com-lh">支付平台称：</label>
                            <div class="com-form-r com-fl">
                                <input type="text" name="payname" class="com-input-text com-input-sizemid">
                            </div>
                        </div>
                        <!-- //input -->
                        <!-- input -->
                        <div class="com-form-group clearfix">
                            <label class="com-form-l com-fl com-lh">支付函数：</label>
                            <div class="com-form-r com-fl">
                                <input type="text" name="function_name" class="com-input-text">
                            </div>
                        </div>

                        <!-- input -->
                        <div class="com-form-group clearfix" style="display:none;">
                            <label class="com-form-l com-fl com-lh">状态：</label>
                            <div class="com-form-r com-fl">
                                <input type="text" name="status" class="com-input-text" value="1">
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!-- button -->
                        <div class="com-form-group clearfix">
                            <label class="com-form-l com-fl"></label>
                            <div class="com-form-r com-fl">
                                <button type="submit" class="com-bigbtn com-btn-color02 ">添加</button>
                            </div>
                        </div>
                        <!-- //button -->
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- //module routine-setting  -->

<script type="text/javascript">
    /**
     *form表单checkout radio美化初始化
     */
    $('input').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue',
        increaseArea: '20%' // optional
    });

    //添加支付平台
    var loadingIndex;
    $(function(){
        $('#add_mode').ajaxForm({
            success: logcompletem, // 这是提交后的方法
            dataType: 'json'
        });

        function logcompletem(data){
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
        //设置支付接口
        $('#setpayapi').ajaxForm({
            success: logcompleten, // 这是提交后的方法
            dataType: 'json'
        });

        function logcompleten(data){
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
        //设置转账设置
        $('#setpayapitt').ajaxForm({
            success: logcompleten, // 这是提交后的方法
            dataType: 'json'
        });

        function logcompleten(data){
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

        $('#formpayapi').ajaxForm({
            success: logcompleteo, // 这是提交后的方法
            dataType: 'json'
        });

        function logcompleteo(data){
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

        //form_settings
        //修改安全转账后提示
        $('#form_settings').ajaxForm({
            success: logcompletep, // 这是提交后的方法
            dataType: 'json'
        });

        function logcompletep(data){
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


        //tab切换
        $(".tab-title li").on("click",function(){
            var index = $(this).index();
            $(this).addClass('tabulous_active').siblings().removeClass('tabulous_active');
            $(".tab-itembox").eq(index).show().siblings().hide();
        })
    })

    //删除支付设置
    function delchannel(t) {
        layer.confirm('确定删除吗？', {
            btn: ['是','否'] //按钮
        }, function(){
            $.post('/delete-channel',{'_token':'{{csrf_token()}}','id':t},function(data) //第二个参数要传token的值 再传参数要用逗号隔开
            {
                if(data == 1){
                    layer.msg('删除成功');
                    $('tr').remove(".the"+t);
                    layer.closeAll();
                }else{
                    layer.msg('删除失败');
                    layer.closeAll();
                }
            });
        });
    }

    //修改支付设置
    function editchannel(k) {
        $.post('/edit-channel',{'_token':'{{csrf_token()}}','id':k},function(data) //第二个参数要传token的值 再传参数要用逗号隔开
        {
            if(data == 2){
                layer.msg('获取数据失败');
                layer.closeAll();
            }else{
                $("#payment_id").find("option").each(function () {
                    var payval = $(this).val();
                    if(data.payment_id==payval){
                        $(this).attr('selected','selected');
                    }
                });
                $("#type").find("option").each(function () {
                    var typeval = $(this).val();
                    if(data.type==typeval){
                        $(this).attr('selected','selected');
                    }
                });
                $("#status").find("option").each(function () {
                    var statusval = $(this).val();
                    if(data.tatus==statusval){
                        $(this).attr('selected','selected');
                    }
                });
                $("#name").val(data.name);
                $("#type").val(data.type);
                $("#auth_username").val(data.auth_username);
                $("#auth_password").val(data.auth_password);
                $("#website").val(data.website);
                $("#max_pay").val(data.max_pay);
                $("#min_pay").val(data.min_pay);
                $("#limit").val(data.limit);
                $("#status").val(data.status);
                $("#remark").val(data.remark);
                $("#editid").val(data.id);

                layer.open({
                    type: 1,
                    title: '支付设置修改',
                    shadeClose: true,
                    shade: 0.5,
                    area: ['900px', '500px'],
                    content: $("#editpayapi")
                });
            }

        });
    }

    //删除安全设置
    function delsettings(u) {
        layer.confirm('确定删除吗？', {
            btn: ['是','否'] //按钮
        }, function(){
            $.post('/delete-settings',{'_token':'{{csrf_token()}}','id':u},function(data) //第二个参数要传token的值 再传参数要用逗号隔开
            {
                if(data == 1){
                    layer.msg('删除成功');
                    $('tr').remove(".set"+u);
                    layer.closeAll();
                }else{
                    layer.msg('删除失败');
                    layer.closeAll();
                }
            });
        });
    }

    //修改安全转账设置
    function editsettings(v) {
        $.post('/edit-settings',{'_token':'{{csrf_token()}}','id':v},function(data) //第二个参数要传token的值 再传参数要用逗号隔开
        {
            if(data == 2){
                layer.msg('获取数据失败');
                layer.closeAll();
            }else{
                $("#level_id").find("option").each(function () {
                    var setval = $(this).val();
                    if(data.level_id==setval){
                        $(this).attr('selected','selected');
                    }
                });
                $("#bank_id").find("option").each(function () {
                    var setval = $(this).val();
                    if(data.bank_id==setval){
                        $(this).attr('selected','selected');
                    }
                });
                $("#ide").val(data.id);
                $("#level_id").val(data.level_id);
                $("#bank_id").val(data.bank_id);
                $("#bank_account").val(data.bank_account);
                $("#max_paye").val(data.max_pay);
                $("#min_paye").val(data.min_pay);
                $("#limite").val(data.limit);
                $("#statuse").val(data.status);
                $("#remarke").val(data.remark);

                layer.open({
                    type: 1,
                    title: '安全转账设置修改',
                    shadeClose: true,
                    shade: 0.5,
                    area: ['900px', '500px'],
                    content: $("#edit_settings")
                });
            }

        });
    }




</script>


