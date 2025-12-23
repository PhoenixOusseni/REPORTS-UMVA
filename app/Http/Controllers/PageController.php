<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function auth()
    {
        return view('login-admin');
    }

    public function dashboard()
    {
        return view('pages.dashboard.admin_dashboard');
    }

    public function dashboard_ka()
    {
        return view('pages.dashboard.dashboard_ka');
    }

    public function dashboard_ma()
    {
        return view('pages.dashboard.dashboard_ma');
    }

    public function dashboard_fp()
    {
        return view('pages.dashboard.dashboard_fp');
    }

    public function detail_groupes()
    {
        return view('pages.groupes.details_groupes');
    }
}
