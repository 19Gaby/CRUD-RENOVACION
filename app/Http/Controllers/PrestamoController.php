<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Books;
use App\Models\Students;

class PrestamoController extends Controller
{

    public function index(Request $request){
        //
        return view('index');
    }

    public function busqueda(Request $request){
        $Borrow = Borrow::select("MATRICULA",'status')->where("MATRICULA", "=", $request->matricula)->get();
        $N = 0;
        foreach ($Borrow as $prestado){
            // if ($prestado['status'] == 1){
                $N=1;
            // }
        }
        if($N==1){
            // return redirect()->route('mostrar',$request->matricula);
            return json_encode("True");
        }
        else{
            return json_encode("False");
        }
    }

    public function mostrar($matricula)
    {
        //
        // $matricula=$_GET['equipos'];
        $matri=$matricula;
        $data=Borrow::select('borrow.MATRICULA','books.id','books.title','borrow.date_borrow','borrow.hora_entregar','borrow.oportunidad')
                        ->join('books','borrow.book_id','=','books.id')
                        ->where("borrow.MATRICULA",'=',$matricula)
                        ->where("borrow.status",'=',1)
                        ->get();
        $tiempo=DB::select('call tiempo(?)',array($matricula));
        $tiempo2=DB::select('call tiempo2(?)',array($matricula));
        $opor=Borrow::select('oportunidad')->where("MATRICULA",'=',$matricula)->groupBy("oportunidad")->get();
        $student=Students::select('status')->where('MATRICULA','=',$matricula)->get();
        $borrow=Borrow::select('status')->where('MATRICULA','=',$matricula)->get();

        foreach($student as $i)
            foreach($borrow as $j)
                if($i->status==2){
                    return redirect('/')->with('bloqueo','Usuario Bloqueado');
                }else if($i->status==1 and $j->status==1){
                    return view('equipos',compact('data','matri','tiempo','tiempo2','opor'));
                }else{
                    return redirect('/')->with('bloqueo','No tienes ningún prestamo');
                }
    }
    
    public function renovar(Request $request){
        $intervalo=$request->intervalo;
        $ma=$request->matricula;
        DB::select('call update_register(?,?)',array($intervalo,$ma));
    }

    public function sancion(Request $request){
        $ma=$request->matricula;
        $id=$request->id_equipo;
        DB::select('call sancion(?)',array($ma));
        DB::select('call delete_equipo(?,?)',array($ma,$id));
        DB::select('call equipo(?)',array($id));
        return json_encode('200');
    }
}
