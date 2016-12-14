<?php
//获取浏览器信息
use App\Datas\Ip2Region;
function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
	$ub = '';
	$version = '';

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
   
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
   
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
   
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
   
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
   
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 

//获取用户IP
function get_client_ip($type = 0,$adv=false) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if($adv){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

/*
 * 根据IP获取所在地,获取成功返回地址对象,获取失败返回FALSE
 * @access public
 * @param string country 国家
 * @param string province 省
 * @param string city 市
 * @param string district 区
 * @param string carrier 网络运营商：电信，移动等
 * $Location = get_info_by_ip();
 * example $Location->country; //获取国家， $Location为返回对地址对象
 */	
function get_info_by_ip()
{
	$ip = get_client_ip();
	//if ($ip != '127.0.0.1' && $ip != '0.0.0.0')
	//{
        $path = app_path('Datas/ip2region.db');
        $ip2region = new Ip2Region($path);
        $data = $ip2region->binarySearch($ip);
        $rs = explode('|',$data['region']);
        $result = [
            'address' => '',
            'carrier' => '',
            'country' => ''
        ];
        foreach ($rs as $k=>$v){
            if ($k >0 && $k < 4 && $v != '0'){
                $result['address'] .= $result['address'] == '' ? $v . ', ' : $v;
            }
            if ($k == 0)
                $result['country'] = $v;
            if ($k == 4)
                $result['carrier'] = $v;
        }
        return $result;
	//}
	//else
	//return false;
}
function no_permission($type='json',$url = ''){
	$response = [
		'error' => '你无法进行此操作，原因：权限不足',
		'status' => 2,
		'url' => $url
	];
	if ($type == 'json'){
        return response()->json($response);
    }
    else{
        return view('no-permission');
    }

}
//显示SQL执行结果
function _sql(){
    DB::connection()->enableQueryLog();

    print_r(DB::getQueryLog());
}

function _success($data,$msg='数据处理成功'){
    $resArr=['data'=>$data];
    $resArr['status']=1;
    $resArr['code']=200;
    $resArr['msg']=$msg;
    return $resArr;

}
function _error($msg='数据处理失败'){
    $resArr['code']=200;
    $resArr['status']=0;
    $resArr['msg']=$msg;
    return $resArr;
}
//获取数据表的所有字段
function getColumnList($table){
    $columns = Schema::getColumnListing("$table");
    return $columns;
}
