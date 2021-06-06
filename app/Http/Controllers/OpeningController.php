<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormPeriodAddRequest;
use App\PollOpen AS Period;
use DataTables;
use Illuminate\Support\Facades\DB;



class OpeningController extends Controller
{
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $period = DB::table('polls_periods')->select('polls_periods.id',  DB::raw('CONCAT(polls_periods.start," - ", polls_periods.end) AS period'), 'polls.name as poll', 'polls_periods.status')
            ->leftJoin('polls', 'polls_periods.poll_id', '=', 'polls.id')->get();
            return Datatables::of($period)
                    ->addIndexColumn()
                    ->addColumn('action', function($period){
                           $btn = '';
                           $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Eliminar"  data-id="'.$period->id.'"  data-period="'.$period->period.'" data-poll="'.$period->poll.'" id="del_'.$period->id.'" class="btn btn-danger btn-xs deletePeriod">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>';
                        return $btn;
                    })->addColumn('status', function($period){
                        $btn = '';
                        if($period->status){
                            $btn .= '<span class="badge badge-success">Activo</span>';
                        }else{
                            $btn .= '<span class="badge badge-danger">Inactivo</span>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
        }

        $periods = Period::count();
        return view('panel.admin.polls.periods.index', ['title' => 'Aperturas - Encuestas', 'periods' => $periods]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormPeriodAddRequest $request)
    {
        $poll_open = Period::where('poll_id', $request->poll_id)->where('status', 1)->count();
        if($poll_open>0){
            return response()->json(['success' => false, 'message' => 'la encuesta seleccionada tiene un periodo abierto.'], 200);
        }
        $poll = Period::where('status', 1)->count();
        if($poll>0){
            return response()->json(['success' => false, 'message' => 'Solo puede aperturar una encuesta a la vez.'], 200);
        }
        $period =  new Period();
        $period->start   =  $request->start;
        $period->end     =  $request->end;
        $period->poll_id =  $request->poll_id;
        $period->status  =  1;
        $saved = $period->save();
        if($saved)
            return response()->json(['success' => true, 'message' => 'Periodo de apertura de encuesta registrada exitosamente.'], 200);
    }

     /**
     * all resources
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function all(Request $request)
    {
        if(\Request::wantsJson()){
            $periods = Period::all();
            foreach($periods->chunk(100) as $key => $period){
                $rutas = [];
                foreach($period as $item){
                    array_push($rutas, [
                        'id' => $item['id'],
                        'name' => $item['name']
                    ]);
                }
            }
            return response()->json(['success' => true, 'periods' => $rutas ?? 0], 200);
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       if(\Request::wantsJson()){
            $period = Period::findOrFail($id);
            return response()->json(['success' => true, 'period' => $period], 200);
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\Request::wantsJson()){
            $period = Period::findOrFail($id);
            $delete = $period->delete();
            if ($delete) {
                return response()->json(['success' => true, 'message' => 'Periodo de apertura de encuesta eliminada exitosamente.'], 200);
            } else {
                return response()->json(['error' => true, 'message' => 'la Periodo de apertura de encuesta no se elimino correctamente. Intente mas tarde.'], 403);
            }
        }
        abort(404);
    }
}
