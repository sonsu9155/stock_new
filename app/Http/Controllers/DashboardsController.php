<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

class DashboardsController extends Controller {
    public function dashboard() {
        $data = array();
        return view('bsb.dashboards.superadmin')->with($data);
    }
}
