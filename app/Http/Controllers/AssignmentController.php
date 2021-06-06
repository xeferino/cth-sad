<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormAssignmentAddRequest;
use App\PollOpen AS Period;
use App\User;
use App\Route;
use App\Poll;
use App\Canton;
use App\Customer;
use App\Assignment;
use DataTables;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Str;

class AssignmentController extends Controller
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
            $assignment = DB::table('assignment_pollster')->select('assignment_pollster.id',  DB::raw('CONCAT(users.name," ", users.last_name) AS fullname'), 'users.id as pollster_id', 'cantons.id as canton_id', 'cantons.name as canton', 'assignment_pollster.routes as route',  'polls.name as poll', 'polls_periods.id as period', 'polls_periods.status')
            ->leftJoin('polls_periods', 'assignment_pollster.period_id', '=', 'polls_periods.id')
            ->leftJoin('cantons', 'assignment_pollster.canton_id', '=', 'cantons.id')
            ->leftJoin('users', 'assignment_pollster.pollster_id', '=', 'users.id')
            ->leftJoin('polls', 'polls_periods.poll_id', '=', 'polls.id')
            ->get();
            return Datatables::of($assignment)
                    ->addIndexColumn()
                    ->addColumn('action', function($assignment){
                           $btn = '';
                           $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Eliminar"  data-id="'.$assignment->id.'"  id="del_'.$assignment->id.'" class="btn btn-danger btn-xs deleteAssignment">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>';
                        return $btn;
                    })->addColumn('status', function($assignment){
                        $btn = '';
                        if($assignment->status){
                            $btn .= '<span class="badge badge-success">Activo</span>';
                        }else{
                            $btn .= '<span class="badge badge-danger">Culminado</span>';
                        }
                        return $btn;
                    })->addColumn('canton', function($assignment){
                        $btn = '';
                        $btn .= '<a href="javascript:void(0)" data-id="'.$assignment->id.'" data-canton_id="'.$assignment->canton_id.'" data-period="'.$assignment->period.'" data-canton="'.$assignment->canton.'"  data-pollster_id="'.$assignment->pollster_id.'" data-routes="'.$assignment->route.'" class="btn btn-info btn-xs modalRouteCustomer">'.$assignment->canton.'</a>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'canton', 'status'])
                    ->make(true);
        }

        $assignments = Assignment::count();
        $pollsters   = User::where('role', 'pollster')->get();
        $periods     = Period::select('polls_periods.id',  DB::raw('CONCAT(polls_periods.start," - ", polls_periods.end) AS period'), 'polls.name as poll', 'polls_periods.status')
                                ->leftJoin('polls', 'polls_periods.poll_id', '=', 'polls.id')
                                ->where('status', 1)
                                ->get();
        $cantons      = Canton::all();
        return view('panel.admin.polls.assignments.index', ['title' => 'Asignacion - Encuestas', 'pollsters' => $pollsters, 'periods' => $periods, 'cantons' => $cantons, 'assignments' => $assignments]);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function routeCustomerPoll(Request $request)
    {
        if(\Request::wantsJson()){
            $period = Period::find($request->period);
            $poll = Poll::find($period->poll_id);
            $canton = Canton::findOrFail($request->canton);
            $respondents = DB::table('answers_questions_polls')
                                ->select('answers_questions_polls.period_id', 'answers_questions_polls.poll_id', 'answers_questions_polls.customer_id', 'answers_questions_polls.canton_id')
                                ->leftJoin('customers', 'customers.id', '=', 'answers_questions_polls.customer_id')
                                ->where('answers_questions_polls.period_id', $request->period)
                                ->where('answers_questions_polls.canton_id', $request->canton)
                                ->groupBy('answers_questions_polls.period_id', 'answers_questions_polls.canton_id', 'customers.id')
                                ->get();
            $assignments = DB::table('assignment_pollster')
            ->select('assignment_pollster.period_id', 'assignment_pollster.pollster_id', 'assignment_pollster.canton_id', 'assignment_pollster.routes')
            ->join('polls_periods', 'assignment_pollster.period_id', '=', 'polls_periods.id')
            ->where('assignment_pollster.period_id', $request->period)->where('assignment_pollster.routes', $request->routes)->where('assignment_pollster.canton_id', $request->canton)->get();

            foreach($assignments as $key => $assignment){
                $collections[$key] = Str::of($assignment->routes)->explode(',');
                foreach($collections[$key] as $val){
                    if($assignment->canton_id == $request->canton){
                        $routes [] =  $val;
                     }
                 }
            }

            foreach(Canton::find($request->canton)->route as $route){
                $clients = [];
                foreach($routes as $val){
                    foreach(Customer::all() as $customer){
                        if($val==$customer->route_id){
                            $status = 'no';
                            foreach($respondents as $respondent){
                                if($respondent->customer_id==$customer->id){
                                    $status = 'si';
                                }
                            }
                            array_push($clients, [
                                'id'       => $customer->id,
                                'fullname' => $customer->name." ".$customer->last_name,
                                'route'    => $route->name,
                                'address'  => $customer->address,
                                'status'   => $status,
                                'poll'     => $poll->id,
                                'period'   => $request->period ?? null
                            ]);
                        }
                    }
                }
            }
            return response()->json(['success' => true, 'routes' => $clients ?? 0], 200);
       }
        abort(404);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function routesCanton(Request $request)
    {
        if(\Request::wantsJson()){
            $assignments = DB::table('assignment_pollster')->leftJoin('polls_periods', 'assignment_pollster.period_id', '=', 'polls_periods.id')->where('polls_periods.status', 1)->count();
            $routes = [];
            if($assignments>0){
                $periods = DB::table('assignment_pollster')
                ->select('assignment_pollster.canton_id', 'assignment_pollster.routes')
                ->leftJoin('polls_periods', 'assignment_pollster.period_id', '=', 'polls_periods.id')
                ->where('polls_periods.status', 1)->where('assignment_pollster.canton_id', $request->canton)->get();

                if(count($periods) > 0){
                    foreach($periods as $key => $value){
                        $collections[$key] = Str::of($value->routes)->explode(',');
                         foreach($collections[$key] as $data){
                            $array_routes[] =  $data;
                        }
                    }

                    foreach(Canton::find($request->canton)->route as $route){
                        if (in_array($route->id, $array_routes)) {
                            array_push($routes, [
                                'id' => $route->id,
                                'name' => $route->name,
                                'exists' => 'true'
                            ]);
                        }else{
                            array_push($routes, [
                                'id' => $route->id,
                                'name' => $route->name,
                                'exists' => 'false'
                            ]);
                        }
                    }
                }else{
                    foreach(Canton::find($request->canton)->route as $route){
                        array_push($routes, [
                            'id' => $route->id,
                            'name' => $route->name,
                            'exists' => 'false'
                        ]);
                    }
                }
                return response()->json(['success' => true, 'routes' => $routes ?? 0], 200);
            }else{
                foreach(Canton::find($request->canton)->route as $route){
                    array_push($routes, [
                        'id' => $route->id,
                        'name' => $route->name,
                        'exists' => 'false'
                    ]);
                }
                return response()->json(['success' => true, 'routes' => $routes ?? 0], 200);
            }
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormAssignmentAddRequest $request)
    {
        if(!empty($request->routes) && (count($request->routes)>0)){
            $assignment =  new Assignment();
            $assignment->pollster_id  =  $request->pollster_id;
            $assignment->period_id    =  $request->period_id;
            $assignment->canton_id    =  $request->canton_id;
            $assignment->routes       =  implode(",", $request->routes);
            $saved = $assignment->save();
            if($saved)
                return response()->json(['success' => true, 'message' => 'Asignacion de encuesta registrada exitosamente.'], 200);
        }
        return response()->json(['success' => false, 'message' => 'Seleccione una ruta disponible de la lista.'], 200);
    }

     /**
     * all resources
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function all(Request $request)
    {
        if(\Request::wantsJson()){
            $periods = Period::where('status', 1)->get();
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
            $period = Assignment::findOrFail($id);
            $delete = $period->delete();
            if ($delete) {
                return response()->json(['success' => true, 'message' => 'Asignacion de encuesta eliminada exitosamente.'], 200);
            } else {
                return response()->json(['error' => true, 'message' => 'la Asignacion de encuesta no se elimino correctamente. Intente mas tarde.'], 403);
            }
        }
        abort(404);
    }
}
