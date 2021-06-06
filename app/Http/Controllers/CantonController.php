<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormCantonAddRequest;
use App\Http\Requests\FormCantonEditRequest;
use App\Canton;
use App\Route;
use DataTables;
use Illuminate\Support\Facades\DB;

class CantonController extends Controller
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
            $canton = Canton::select('id',  'name', 'code', 'description');
            return Datatables::of($canton)
                    ->addIndexColumn()
                    ->addColumn('action', function($canton){
                           $btn = '';
                           $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Editar"  data-id="'.$canton->id.'" id="edit_'.$canton->id.'" class="btn btn-primary btn-xs editCanton">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    ';
                           $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Eliminar"  data-id="'.$canton->id.'" id="del_'.$canton->id.'" class="btn btn-danger btn-xs deleteCanton">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>';
                        return $btn;
                    })
                    ->addColumn('route', function($canton) {
                        $btn = '';
                        $routes = Canton::find($canton->id)->route;
                        foreach($routes as $value){
                            $btn .= '<span title="'.$value->name.'" style="cursor:pointer;">'.$value->id.', </span>';
                        }
                     return $btn;
                 })
                    ->rawColumns(['route','action'])
                    ->make(true);
        }
        $cantons = Canton::count();
        return view('panel.admin.cantons.index', ['title' => 'Cantones', 'cantons' => $cantons]);
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
                    'code' => $item['code'],
                ]);
            }
        }
        return $cantons ?? 0;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormCantonAddRequest $request)
    {
        $canton              =  new Canton();
        $canton->name        =  $request->name;
        $canton->code        =  $request->code;
        $canton->description =  $request->description;
        $saved = $canton->save();
        if($saved)
            return response()->json(['success' => true, 'message' => 'Canton registrada exitosamente.'], 200);
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
            $canton = Canton::findOrFail($id);
            return response()->json(['success' => true, 'canton' => $canton], 200);
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
    public function update(FormCantonEditRequest $request, Canton $Canton)
    {
        $canton   = Canton::findOrFail($Canton->id);
        $canton->fill($request->all());
        $saved = $canton->save();
        if($saved)
            return response()->json(['success' => true, 'message' => 'Canton actualizado exitosamente.'], 200);
        return response()->json(['error' => true, 'message' => 'la Canton no se actualizo correctamente. Intente mas tarde.'], 403);
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
            $canton = Canton::findOrFail($id);
            $delete = $canton->delete();
            if ($delete) {
                return response()->json(['success' => true, 'message' => 'Canton eliminado exitosamente.'], 200);
            } else {
                return response()->json(['error' => true, 'message' => 'El Canton no se elimino correctamente. Intente mas tarde.'], 403);
            }
        }
        abort(404);
    }
}
