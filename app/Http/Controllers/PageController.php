<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupe;
use App\Models\RapportFp;
use App\Models\RapportKa;
use App\Models\User;
use App\Models\RapportMa;
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
        $totalMas = User::where('role_id', 2)->where('supervisor_id', Auth::id())->count();
        $mas = User::where('supervisor_id', Auth::id())->orderBy('created_at', 'desc')->take(10)->get();
        $totalRapportsFp = RapportFp::where('user_id', Auth::id())->count();
        $rapportsFp = RapportFp::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(10)->get();

        return view('pages.dashboard.dashboard_fp', compact('totalMas', 'mas', 'totalRapportsFp', 'rapportsFp'));
    }

    // groupes details
    public function detail_groupes()
    {
        return view('pages.groupes.details_groupes');
    }

    // kas profile
    public function ka_profile($id)
    {
        $user = User::findOrFail($id);
        return view('pages.profils.ka_profil', compact('user'));
    }

    // ma profile
    public function ma_profile($id)
    {
        $user = User::findOrFail($id);
        return view('pages.profils.ma_profil', compact('user'));
    }

    // fp profile
    public function fp_profile($id)
    {
        $user = User::findOrFail($id);
        return view('pages.profils.fp_profil', compact('user'));
    }

    // admin profile
    public function admin_profile($id)
    {
        $user = User::findOrFail($id);
        // Pour un admin, on récupère tous les rapports de tous les groupes
        $rapports = RapportGroupe::orderBy('date_rapport', 'desc')->take(10)->get();
        $rapportsKa = RapportKa::orderBy('created_at', 'desc')->take(10)->get();
        $rapportsMa = RapportMa::orderBy('created_at', 'desc')->take(10)->get();
        $rapportsFp = RapportFp::orderBy('created_at', 'desc')->take(10)->get();
        return view('pages.profils.admin_profil', compact('user', 'rapports', 'rapportsKa', 'rapportsMa', 'rapportsFp'));
    }

    // Recherche des rapports groupes par plage de dates
    public function searchRapportsGroupes(Request $request, $id)
    {
        $dateDebut = $request->input('date_debut');
        $dateFin = $request->input('date_fin');

        // Pour un admin, récupérer tous les rapports de tous les groupes
        $query = RapportGroupe::with('groupe');

        if ($dateDebut) {
            $query->whereDate('date_rapport', '>=', $dateDebut);
        }
        if ($dateFin) {
            $query->whereDate('date_rapport', '<=', $dateFin);
        }

        $rapports = $query->orderBy('date_rapport', 'desc')->get();
        return response()->json(['success' => true, 'data' => $rapports]);
    }

    // Recherche des rapports KA par plage de dates
    public function searchRapportsKa(Request $request)
    {
        $dateDebut = $request->input('date_debut');
        $dateFin = $request->input('date_fin');

        $query = RapportKa::with('user');

        if ($dateDebut) {
            $query->whereDate('date_rapport', '>=', $dateDebut);
        }
        if ($dateFin) {
            $query->whereDate('date_rapport', '<=', $dateFin);
        }

        $rapportsKa = $query->orderBy('date_rapport', 'desc')->get();
        return response()->json(['success' => true, 'data' => $rapportsKa]);
    }

    // Recherche des rapports MA par plage de dates
    public function searchRapportsMa(Request $request)
    {
        $dateDebut = $request->input('date_debut');
        $dateFin = $request->input('date_fin');

        $query = RapportMa::with('user');

        if ($dateDebut) {
            $query->whereDate('date_rapport', '>=', $dateDebut);
        }
        if ($dateFin) {
            $query->whereDate('date_rapport', '<=', $dateFin);
        }

        $rapportsMa = $query->orderBy('date_rapport', 'desc')->get();
        return response()->json(['success' => true, 'data' => $rapportsMa]);
    }

    // Recherche des rapports FP par plage de dates
    public function searchRapportsFp(Request $request)
    {
        $dateDebut = $request->input('date_debut');
        $dateFin = $request->input('date_fin');

        $query = RapportFp::with('user');

        if ($dateDebut) {
            $query->whereDate('date_rapport', '>=', $dateDebut);
        }
        if ($dateFin) {
            $query->whereDate('date_rapport', '<=', $dateFin);
        }

        $rapportsFp = $query->orderBy('date_rapport', 'desc')->get();
        return response()->json(['success' => true, 'data' => $rapportsFp]);
    }
}
