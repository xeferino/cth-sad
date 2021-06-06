<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormRouteAddRequest;
use App\Http\Requests\FormRouteEditRequest;
use App\Route;
use App\Canton;
use DataTables;
use Illuminate\Support\Facades\DB;



class RouteController extends Controller
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
            $route = DB::table('routes')->select('routes.id',  'routes.name', 'routes.code', 'cantons.name as canton', 'routes.description')
            ->leftJoin('cantons', 'routes.canton_id', '=', 'cantons.id')->get();
            return Datatables::of($route)
                    ->addIndexColumn()
                    ->addColumn('action', function($route){
                           $btn = '';
                           $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Editar"  data-id="'.$route->id.'" id="edit_'.$route->id.'" class="btn btn-primary btn-xs editRoute">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    ';
                           $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Eliminar"  data-id="'.$route->id.'" id="del_'.$route->id.'" class="btn btn-danger btn-xs deleteRoute">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        $routes = Route::count();
        return view('panel.admin.routes.index', ['title' => 'Rutas', 'routes' => $routes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormRouteAddRequest $request)
    {
        $route =  new Route();
        $route->name        =  $request->name;
        $route->code        =  $request->code;
        $route->description =  $request->description;
        $route->canton_id   =  $request->canton_id;
        $saved = $route->save();
        if($saved)
            return response()->json(['success' => true, 'message' => 'Ruta registrada exitosamente.'], 200);
    }

     /**
     * all resources
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function all(Request $request)
    {
        if(\Request::wantsJson()){
            $cantons = Canton::all();
            foreach($cantons->chunk(100) as $key => $canton){
                $routes = [];
                foreach($canton as $item){
                    $route = Canton::find($item['id'])->route;

                    array_push($routes, [
                        'canton' => $item['name'],
                        'routes' =>  $route
                    ]);
                }
            }
            return response()->json(['success' => true, 'cantons' => $routes ?? 0], 200);
        }
        abort(404);
    }


    /**
     * all resources
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function cantons()
    {
        $all = Canton::all();
        foreach($all->chunk(100) as $key => $canton){
            $cantons = [];
            foreach($canton as $item){
                array_push($cantons, [
                    'id' => $item['id'],
                    'name' => $item['name'],
                ]);
            }
        }
        return response()->json(['success' => true, 'cantons' => $cantons ?? 0], 200);
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
            $route = Route::findOrFail($id);
            $all = Canton::all();
            foreach($all->chunk(100) as $key => $canton){
                $cantons = [];
                foreach($canton as $item){
                    array_push($cantons, [
                        'id' => $item['id'],
                        'name' => $item['name'],
                    ]);
                }
            }
            return response()->json(['success' => true, 'route' => $route, 'cantons' => $cantons], 200);
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormRouteEditRequest $request, Route $Route)
    {
        $route   = Route::findOrFail($Route->id);
        //$route->fill($request->all());
        $route->name        =  $request->name;
        $route->code        =  $request->code;
        $route->description =  $request->description;
        $route->canton_id   =  $request->canton_id;
        $saved = $route->save();
        if($saved)
            return response()->json(['success' => true, 'message' => 'Ruta actualizada exitosamente.'], 200);
        return response()->json(['error' => true, 'message' => 'la Ruta no se actualizo correctamente. Intente mas tarde.'], 403);
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
            $route = Route::findOrFail($id);
            $delete = $route->delete();
            if ($delete) {
                return response()->json(['success' => true, 'message' => 'Ruta eliminada exitosamente.'], 200);
            } else {
                return response()->json(['error' => true, 'message' => 'la Ruta no se elimino correctamente. Intente mas tarde.'], 403);
            }
        }
        abort(404);
    }
}
