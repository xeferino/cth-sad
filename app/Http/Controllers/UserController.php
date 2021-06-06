<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormUserAddRequest;
use App\Http\Requests\FormUserEditRequest;
use App\Http\Requests\FormUserProfileRequest;
use App\User;
use File;
use DataTables;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
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
            $user = DB::table('users')->select('id',  DB::raw('CONCAT(name," ", last_name) AS fullname, IF(status=1,"Activo","Inactivo") AS status, CASE WHEN role="super" THEN "SUPER ADMIN" WHEN role="pollster" THEN "ENCUESTADOR" ELSE "ADMINISTRADOR" END as role'), 'email')->get();
            return Datatables::of($user)
                    ->addIndexColumn()
                    ->addColumn('action', function($user){
                           $btn = '';
                           $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Editar"  data-id="'.$user->id.'" id="edit_'.$user->id.'" class="btn btn-primary btn-xs editUser">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    ';
                           $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Eliminar"  data-id="'.$user->id.'" id="del_'.$user->id.'" class="btn btn-danger btn-xs deleteUser">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>';
                        return $btn;
                    })
                    ->addColumn('status', function($user){
                        $btn = '';
                        if($user->status=='Activo'){
                            $btn .= '<span class="badge badge-success">'.$user->status.'</span>';
                        }else{
                            $btn .= '<span class="badge badge-danger">'.$user->status.'</span>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
        }

        $users           = User::count();
        $users_inactive  = User::where('status', 0)->count();
        $users_active    = User::where('status', 1)->count();
        return view('panel.admin.users.index', ['title' => 'Usuarios', 'users' => $users, 'users_inactive' => $users_inactive, 'users_active' => $users_active]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormUserAddRequest $request)
    {
        $user               = new User();
        $user->name         = $request->name;
        $user->last_name    = $request->last_name;
        $user->email        = $request->email;
        $user->role         = $request->role;
        $user->password     = bcrypt($request->password);

        if($request->file('img')){
            $file           = $request->file('img');
            $extension      = $file->getClientOriginalExtension();
            $fileName       = time() . '.' . $extension;
            $user->img      = $fileName;
            $file->move(public_path('img/profile/'), $fileName);
        }else{
            $user->img = 'avatar.svg';
        }
        $saved = $user->save();
        if($saved)
            return response()->json(['success' => true, 'message' => 'Usuario registrado exitosamente.'], 200);
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
            $user = User::findOrFail($id);
            return response()->json(['success' => true, 'user' => $user], 200);
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
    public function update(FormUserEditRequest $request, User $User)
    {
        $user               = User::findOrFail($User->id);
        $user->name         = $request->name;
        $user->last_name    = $request->last_name;
        $user->email        = $request->email;
        $user->role         = $request->role;
        $user->status       = ($request->status=="true") ? 1 : 0;
        if($request->password){
            $user->password = bcrypt($request->password);
        }

        if($request->file('img')){
            if ($user->img != "avatar.svg") {
                if (File::exists(public_path('img/profile/' . $user->img))) {
                    File::delete(public_path('img/profile/' . $user->img));
                }
            }

            $file           = $request->file('img');
            $extension      = $file->getClientOriginalExtension();
            $fileName       = time() . '.' . $extension;
            $user->img      = $fileName;
            $file->move(public_path('img/profile/'), $fileName);
        }

        $saved = $user->save();
        if($saved)
            return response()->json(['success' => true, 'message' => 'Usuario actualizado exitosamente.'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile(FormUserProfileRequest $request, User $User)
    {
        $user               = User::findOrFail($User->id);
        $user->name         = $request->name;
        $user->last_name    = $request->last_name;
        $user->email        = $request->email;
        $user->status       = ($request->status=="true") ? 1 : 0;
        if($request->password){
            $user->password = bcrypt($request->password);
        }

        if($request->file('img')){
            if ($user->img != "avatar.svg") {
                if (File::exists(public_path('img/profile/' . $user->img))) {
                    File::delete(public_path('img/profile/' . $user->img));
                }
            }

            $file           = $request->file('img');
            $extension      = $file->getClientOriginalExtension();
            $fileName       = time() . '.' . $extension;
            $user->img      = $fileName;
            $file->move(public_path('img/profile/'), $fileName);
        }

        $saved = $user->save();
        if($saved)
            return response()->json(['success' => true, 'profile_img' => $user->img, 'message' => 'Perfil actualizado exitosamente.'], 200);
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
            $user = User::findOrFail($id);
            if ($user->img != "avatar.svg") {
                if (File::exists(public_path('img/profile/' . $user->img))) {
                    File::delete(public_path('img/profile/' . $user->img));
                }
            }
            $delete = $user->delete();
            if ($delete) {
                return response()->json(['success' => true, 'message' => 'Usuario eliminado exitosamente.'], 200);
            } else {
                return response()->json(['error' => true, 'message' => 'El usuario no se elimino correctamente. Intente mas tarde.'], 403);
            }
        }
        abort(404);
    }
}
