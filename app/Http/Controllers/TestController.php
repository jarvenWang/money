<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\BaseMemberController;

class TestController extends Controller {
    //二维码
    public function index(Request $request) {
        BaseMemberController::_list();
//        dd(app());
//        $obj=new Request();
//        $obj->input('file');
//        $file = $request->file('file');

//        echo 'Request=>'.$request->input('name');
//
//        Storage::disk();
//          \Log::error(1);
//        \Storage::disk();
//        abort();
//        cache();
//        dd(old('age'));

/*
        //判断上传是否成功
        $file->isValid();
        //mime名字
        $file->getClientMimeType();
        //原文件名
        $file->getClientOriginalName();
        //扩展名字
        $file->getClientOriginalExtension();*/

//        dd(\Auth::user());
//        var_dump(\Auth::user());

//        print_r(\Auth::user());

//        echo QrCode::generate('http://www.chenze.site');

    }


}
