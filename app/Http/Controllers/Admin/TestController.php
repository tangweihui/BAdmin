<?php

namespace App\Http\Controllers\Admin;

use App\AdminConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $wd   = $request->input('wd');
        $list = AdminConfig::searchCondition($wd)->paginate(10);
        return view('admin.config', ['list' => $list, 'wd' => $wd]);
    }
}
