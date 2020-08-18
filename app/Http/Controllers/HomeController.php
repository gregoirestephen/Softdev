<?php

namespace App\Http\Controllers;

use App\Consultation;
use App\Patient;
use App\Rdv;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use AuthenticatesUsers{
        logout as performLogout;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $day = Carbon::now()->format('Y-m-d');
        $patient=Patient::all()->count();
        $consult1=Consultation::all()->where('etape_consult','=',1)->where('dateConsultation','=',$day)->count();
        $consult2=Consultation::all()->where('etape_consult','=',2)->where('dateConsultation','=',$day)->count();

        $lm=DB::table('rdvs')->join('patients','patients.id','=','rdvs.patient_id')
            ->select('rdvs.objet_rdv','rdvs.heure_rdv','patients.nom_patient')
            ->where('rdvs.deleted_at','=',null)
        ->where('date_rdv','=',$day);
        $rDetail=$lm->get();

        $lc=DB::table('consultations')->join('patients','patients.id','=','consultations.patient_id')
            ->select('consultations.observation','consultations.etape_consult','patients.nom_patient')
            ->where('consultations.deleted_at','=',null)
            ->where('dateConsultation','=',$day);
        $rConsultation=$lc->get();


        $rdv=Rdv::all()->where('date_rdv','=',$day)->count();
        return view('dashboards.index',compact('patient','consult1','consult2','rdv','rDetail','rConsultation'));
    }



    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->route('login');
    }
}
