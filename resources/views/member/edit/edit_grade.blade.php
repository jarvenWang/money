
<form action="{{ route('_changeGrade') }}" method="post" class="edit_form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="data[id]" value="{{ $data->id }}">

    <div class="notice-con-box">

        <div class="com-form-wrap">
            <!-- input -->
            <div class="com-form-group clearfix">
                <label class="com-form-l com-fl com-lh">会员层级名称：</label>

                <div class="com-form-r com-fl">
                    <input type="text" name="data[name]" class="com-input-text" value="{{ $data->name }}">
                </div>
            </div>
            <!-- //input -->
            <!-- input -->
            <div class="com-form-group clearfix">
                <label class="com-form-l com-fl com-lh">专属服务：</label>

                <div class="com-form-r com-fl">
                    <input type="text" name="data[private_service]" class="com-input-text" value="{{ $data->private_service }}" >
                </div>
            </div>
            <!-- //input -->
            <!-- input -->
            <div class="com-form-group clearfix">
                <label class="com-form-l com-fl com-lh">等级排序：</label>

                <div class="com-form-r com-fl">
                    <input type="text" name="data[sort]" class="com-input-text" value="{{ $data->sort }}">
                </div>
            </div>
            <!-- //input -->
            <!-- input -->
            <div class="com-form-group clearfix">
                <label class="com-form-l com-fl com-lh">最小积分：</label>

                <div class="com-form-r com-fl">
                    <input type="text" name="data[min_points]" class="com-input-text" value="{{ $data->min_points }}">
                </div>
            </div>

            <div class="com-form-group clearfix">
                <label class="com-form-l com-fl com-lh">最大积分：</label>

                <div class="com-form-r com-fl">
                    <input type="text" name="data[max_points]" class="com-input-text" value="{{ $data->max_points }}" >
                </div>
            </div>
            <!-- //input -->
            <!-- input -->
            <div class="com-form-group clearfix">
                <label class="com-form-l com-fl com-lh">开始时间</label>

                <div class="com-form-r com-fl">
                    <input name="data[from_date]"
                           onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"
                           class="laydate-icon"
                           value="{{ $data->from_date }}"
                    >

                </div>
            </div>
            <!-- //input -->
            <!-- input -->
            <div class="com-form-group clearfix">
                <label class="com-form-l com-fl com-lh">结束时间</label>

                <div class="com-form-r com-fl">
                    <input name="data[to_date]"
                           onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"
                           class="laydate-icon"
                           value="{{ $data->to_date }}"
                    >

                </div>
            </div>
            <!-- //input -->
            <!-- input -->
            <div class="com-form-group clearfix">
                <label class="com-form-l com-fl com-lh">网址</label>

                <div class="com-form-r com-fl">
                    <input type="text" name="data[url]" class="com-input-text" value="{{ $data->url }}" >
                </div>
            </div>
            <!-- //input -->

            <!-- button -->
            <div class="com-form-group clearfix">
                <label class="com-form-l com-fl"></label>

                <div class="com-form-r com-fl">

                    <button class="com-bigbtn com-btn-color02 " type="submit">确认</button>

                </div>
            </div>
            <!-- //button -->
        </div>

    </div>

</form>
<script>
    $('.edit_form').ajaxForm(function (message) {
        _load();
        layer.close(index);
    });

</script>