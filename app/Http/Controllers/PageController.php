<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupe;
use App\Models\RapportKa;
use App\Models\User;
use App\Models\RapportMa;
use App\Models\RapportFp;
use App\Models\RapportGroupe;

use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function auth()
    {
        return view('login-admin');
    }

    public function dashboard()
    {
        // Les totaux des utilisateurs
        $totalGroups = Groupe::count();
        $totalPfs = User::where('role_id', 4)->count();
        $totalKas = User::where('role_id', 2)->count();
        $totalMas = User::where('role_id', 3)->count();

        // Les totaux des rapports
        $totalRapportsG50 = RapportGroupe::count();
        $totalRapportsPf = RapportFp::count();
        $totalRapportsKa = RapportKa::count();
        $totalRapportsMa = RapportMa::count();

        //
        $pfs = User::where('role_id', 4)->orderBy('created_at', 'desc')->take(10)->get();
        return view('pages.dashboard.admin_dashboard', compact('totalGroups', 'totalPfs', 'totalKas', 'totalMas', 'totalRapportsG50', 'totalRapportsPf', 'totalRapportsKa', 'totalRapportsMa', 'pfs'));
    }

    public function dashboard_ka()
    {
        $totalGroups = Groupe::where('user_id', Auth::id())->count();
        $collections = Groupe::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(10)->get();
        $totalRapportsKa = RapportKa::where('user_id', Auth::id())->count();
        $rapportsKa = RapportKa::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(10)->get();

        return view('pages.dashboard.dashboard_ka', compact('totalGroups', 'collections', 'totalRapportsKa', 'rapportsKa'));
    }

    public function dashboard_ma()
    {
        $totalKas = User::where('role_id', 2)->where('supervisor_id', Auth::id())->count();
        $kas = User::where('supervisor_id', Auth::id())->orderBy('created_at', 'desc')->take(10)->get();
        $totalRapportsMa = RapportMa::where('user_id', Auth::id())->count();
        $rapportsMa = RapportMa::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(10)->get();

        return view('pages.dashboard.dashboard_ma', compact('totalKas', 'kas', 'totalRapportsMa', 'rapportsMa'));
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
