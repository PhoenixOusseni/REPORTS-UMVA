<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupe;
use App\Models\RapportKa;

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
        $totalGroups = Groupe::count();
        $collections = Groupe::orderBy('created_at', 'desc')->take(10)->get();
        $totalRapportsKa = RapportKa::count();
        $rapportsKa = RapportKa::orderBy('created_at', 'desc')->take(10)->get();

        return view('pages.dashboard.dashboard_ka', compact('totalGroups', 'collections', 'totalRapportsKa', 'rapportsKa'));
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
    public function detail_kas()
    {
        return view('pages.kas.details_kas');
    }
    public function detail_mas()
    {
        return view('pages.mas.details_mas');
    }
}
