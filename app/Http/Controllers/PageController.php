<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupe;
use App\Models\RapportFp;
use App\Models\RapportKa;
use App\Models\User;
use App\Models\RapportMa;
use App\Models\RapportGroupe;
use Carbon\Carbon;

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
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY)->toDateString();
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY)->toDateString();

        $totalGroups = Groupe::where('user_id', Auth::id())->count();
        $collections = Groupe::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        $totalRapportsKa = RapportKa::where('user_id', Auth::id())->count();
        $rapportsKa = RapportKa::where('user_id', Auth::id())
            ->whereBetween('date_rapport', [$startOfWeek, $endOfWeek])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.dashboard.dashboard_ka', compact('totalGroups', 'collections', 'totalRapportsKa', 'rapportsKa'));
    }

    public function dashboard_ma()
    {
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY)->toDateString();
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY)->toDateString();

        $totalKas = User::where('role_id', 2)->where('supervisor_id', Auth::id())->count();
        $kas = User::where('supervisor_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        $totalRapportsMa = RapportMa::where('user_id', Auth::id())->count();
        $rapportsMa = RapportMa::where('user_id', Auth::id())
            ->whereBetween('date_rapport', [$startOfWeek, $endOfWeek])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.dashboard.dashboard_ma', compact('totalKas', 'kas', 'totalRapportsMa', 'rapportsMa'));
    }

    public function dashboard_fp()
    {
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY)->toDateString();
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY)->toDateString();

        $totalMas = User::where('role_id', 2)->where('supervisor_id', Auth::id())->count();
        $mas = User::where('supervisor_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        $totalRapportsFp = RapportFp::where('user_id', Auth::id())->count();
        $rapportsFp = RapportFp::where('user_id', Auth::id())
            ->whereBetween('date_rapport', [$startOfWeek, $endOfWeek])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

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
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY)->toDateString();
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY)->toDateString();

        // Pour un admin, on récupère tous les rapports de tous les groupes
        $rapports = RapportGroupe::whereBetween('date_rapport', [$startOfWeek, $endOfWeek])
            ->orderBy('date_rapport', 'desc')
            ->paginate(10);
        $rapportsKa = RapportKa::whereBetween('date_rapport', [$startOfWeek, $endOfWeek])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $rapportsMa = RapportMa::whereBetween('date_rapport', [$startOfWeek, $endOfWeek])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $rapportsFp = RapportFp::whereBetween('date_rapport', [$startOfWeek, $endOfWeek])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
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

    public function searchOwnRapportsKa(Request $request)
    {
        $dateDebut = $request->input('date_debut');
        $dateFin = $request->input('date_fin');
        $query = RapportKa::with('user')->where('user_id', Auth::id());

        if ($dateDebut) {
            $query->whereDate('date_rapport', '>=', $dateDebut);
        }
        if ($dateFin) {
            $query->whereDate('date_rapport', '<=', $dateFin);
        }

        $rapportsownKa = $query->orderBy('date_rapport', 'desc')->get();
        return response()->json(['success' => true, 'data' => $rapportsownKa]);
    }

    public function searchRapportsKaById(Request $request, string $id)
    {
        $targetUser = User::where('id', $id)->where('role_id', 2)->first();

        if (!$targetUser || !$this->canAccessUserReports($targetUser)) {
            return response()->json(['success' => false, 'message' => 'Acces non autorise'], 403);
        }

        $dateDebut = $request->input('date_debut');
        $dateFin = $request->input('date_fin');
        $query = RapportKa::with('user')->where('user_id', $targetUser->id);

        if ($dateDebut) {
            $query->whereDate('date_rapport', '>=', $dateDebut);
        }
        if ($dateFin) {
            $query->whereDate('date_rapport', '<=', $dateFin);
        }

        $rapportsKa = $query->orderBy('date_rapport', 'desc')->get();
        return response()->json(['success' => true, 'data' => $rapportsKa]);
    }

    // MA: récupérer les rapports d'un KA spécifique sur lequel il clique.
    public function getRapportsKaById(string $id)
    {
        $ka = User::where('id', $id)
            ->where('role_id', 2)
            ->where('supervisor_id', Auth::id())
            ->first();

        if (!$ka) {
            return response()->json([
                'success' => false,
                'message' => 'KA introuvable ou non autorise',
            ], 404);
        }

        $rapports = RapportKa::with('user')
            ->where('user_id', $ka->id)
            ->orderBy('date_rapport', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'ka' => [
                'id' => $ka->id,
                'umva_id' => $ka->umva_id,
            ],
            'data' => $rapports,
        ]);
    }

     public function getRapportsMaById(string $id)
    {
        $ma = User::where('id', $id)
            ->where('role_id', 3)
             ->where('supervisor_id', Auth::id())
            ->first();      

        if (!$ma) {
            return response()->json([
                'success' => false,
                'message' => 'MA introuvable ou non autorise',
            ], 404);
        }

        $rapports = RapportMa::with('user')
            ->where('user_id', $ma->id)
            ->orderBy('date_rapport', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'ma' => [
                'id' => $ma->id,
                'umva_id' => $ma->umva_id,
            ],
            'data' => $rapports,
        ]);
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

     public function searchOwnRapportsMa(Request $request)
    {
        $dateDebut = $request->input('date_debut');
        $dateFin = $request->input('date_fin');
         $query = RapportMa::with('user')->where('user_id', Auth::id());

        if ($dateDebut) {
            $query->whereDate('date_rapport', '>=', $dateDebut);
        }
        if ($dateFin) {
            $query->whereDate('date_rapport', '<=', $dateFin);
        }

        $rapportsownMa = $query->orderBy('date_rapport', 'desc')->get();
        return response()->json(['success' => true, 'data' => $rapportsownMa]);
    }

    public function searchRapportsMaById(Request $request, string $id)
    {
        $targetUser = User::where('id', $id)->where('role_id', 3)->first();

        if (!$targetUser || !$this->canAccessUserReports($targetUser)) {
            return response()->json(['success' => false, 'message' => 'Acces non autorise'], 403);
        }

        $dateDebut = $request->input('date_debut');
        $dateFin = $request->input('date_fin');
        $query = RapportMa::with('user')->where('user_id', $targetUser->id);

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
        $page = $request->input('page', 1);
         $query = RapportFp::with('user');
        // Filtrer par utilisateur si fourni

        if ($dateDebut) {
            $query->whereDate('date_rapport', '>=', $dateDebut);
        }
        if ($dateFin) {
            $query->whereDate('date_rapport', '<=', $dateFin);
        }

        $rapportsFp = $query->orderBy('date_rapport', 'desc')->paginate(5, ['*'], 'page', $page);
        return response()->json(['success' => true, 'data' => $rapportsFp->items(), 'pagination' => [
            'current_page' => $rapportsFp->currentPage(),
            'last_page' => $rapportsFp->lastPage(),
            'total' => $rapportsFp->total(),
            'per_page' => $rapportsFp->perPage(),
        ]]);
    }

    public function searchOwnRapportsFp(Request $request)
    {
        $dateDebut = $request->input('date_debut');
        $dateFin = $request->input('date_fin');
        $page = $request->input('page', 1);
         $query = RapportFp::with('user')->where('user_id', Auth::id());
        // Filtrer par utilisateur si fourni

        if ($dateDebut) {
            $query->whereDate('date_rapport', '>=', $dateDebut);
        }
        if ($dateFin) {
            $query->whereDate('date_rapport', '<=', $dateFin);
        }

        $rapportsownFp = $query->orderBy('date_rapport', 'desc')->paginate(5, ['*'], 'page', $page);
        return response()->json(['success' => true, 'data' => $rapportsownFp->items(), 'pagination' => [
            'current_page' => $rapportsownFp->currentPage(),
            'last_page' => $rapportsownFp->lastPage(),
            'total' => $rapportsownFp->total(),
            'per_page' => $rapportsownFp->perPage(),
        ]]);
    }

    public function searchRapportsFpById(Request $request, string $id)
    {
        $targetUser = User::where('id', $id)->where('role_id', 4)->first();

        if (!$targetUser || !$this->canAccessUserReports($targetUser)) {
            return response()->json(['success' => false, 'message' => 'Acces non autorise'], 403);
        }

        $dateDebut = $request->input('date_debut');
        $dateFin = $request->input('date_fin');
        $query = RapportFp::with('user')->where('user_id', $targetUser->id);

        if ($dateDebut) {
            $query->whereDate('date_rapport', '>=', $dateDebut);
        }
        if ($dateFin) {
            $query->whereDate('date_rapport', '<=', $dateFin);
        }

        $rapportsFp = $query->orderBy('date_rapport', 'desc')->get();
        return response()->json(['success' => true, 'data' => $rapportsFp]);
    }

    private function canAccessUserReports(User $targetUser): bool
    {
        if (Auth::user()->role_id === 1) {
            return true;
        }

        if ((int) Auth::id() === (int) $targetUser->id) {
            return true;
        }

        return (int) $targetUser->supervisor_id === (int) Auth::id();
    }
}
