<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormSectionAddRequest;
use App\Http\Requests\FormSectionEditRequest;
use App\Section;
use DataTables;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
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
            $section = Section::select('id',  'name', 'description');
            return Datatables::of($section)
                    ->addIndexColumn()
                    ->addColumn('action', function($section){
                           $btn = '';
                           $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Editar"  data-id="'.$section->id.'" id="edit_'.$section->id.'" class="btn btn-primary btn-xs editSection">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    ';
                           $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Eliminar"  data-id="'.$section->id.'" id="del_'.$section->id.'" class="btn btn-danger btn-xs deleteSection">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormSectionAddRequest $request)
    {
        $section =  new Section();
        $section->name        =  $request->name;
        $section->description =  $request->description;
        $section->poll_id     =  $request->poll_id;
        $saved = $section->save();
        if($saved)
            return response()->json(['success' => true, 'message' => 'Seccion registrada exitosamente.'], 200);
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
            $section = Section::findOrFail($id);
            return response()->json(['success' => true, 'section' => $section], 200);
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
    public function update(FormSectionEditRequest $request, Section $Section)
    {
        $section   = Section::findOrFail($Section->id);
        $section->fill($request->all());
        $saved = $section->save();
        if($saved)
            return response()->json(['success' => true, 'message' => 'Seccion actualizada exitosamente.'], 200);
        return response()->json(['error' => true, 'message' => 'la Seccion no se actualizo correctamente. Intente mas tarde.'], 403);
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
            $section = Section::findOrFail($id);
            $delete = $section->delete();
            if ($delete) {
                return response()->json(['success' => true, 'message' => 'Seccion eliminada exitosamente.'], 200);
            } else {
                return response()->json(['error' => true, 'message' => 'la Seccion no se elimino correctamente. Intente mas tarde.'], 403);
            }
        }
        abort(404);
    }
}
