<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormCustomerAddRequest;
use App\Http\Requests\FormCustomerEditRequest;
use App\Customer;
use App\Route;
use File;
use DataTables;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
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
            $customer = DB::table('tb_clientes')->select('idcliente', DB::raw('CONCAT(nombres," ", apellidos) AS fullname'), 'documento', 'email', 'telefono', 'tipo cliente AS tipo_cliente')->get();
            return Datatables::of($customer)
                    ->addIndexColumn()
                    ->addColumn('action', function($customer){
                           $btn = '';
                        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Editar"  data-id="'.$customer->idcliente.'" id="edit_'.$customer->idcliente.'" class="btn btn-primary btn-xs mr-1 editCustomer">
                                        <i class="fas fa-pencil-alt"></i>
                                </a>';
                        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Detalles"  data-id="'.$customer->idcliente.'" id="det_'.$customer->idcliente.'" class="btn btn-info btn-xs  mr-1 detalleCustomer">
                                    <i class="fas fa-search"></i>
                                </a>';
                        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Eliminar"  data-id="'.$customer->idcliente.'" id="del_'.$customer->idcliente.'" class="btn btn-danger btn-xs deleteCustomer">
                                        <i class="fas fa-trash-alt"></i>
                                </a>';
                        return $btn;
                    })

                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('panel.admin.customers.index', ['title' => 'Clientes']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormCustomerAddRequest $request)
    {
        $customer = DB::table('tb_clientes')->insert([
            [   'documento'     => $request->document,
                'nombres'       => $request->names,
                'apellidos'     => $request->surnames,
                'telefono'      => $request->phone,
                'direccion'     => $request->address,
                'email'         => $request->email,
                'tipo cliente'  => $request->type,
                'razon social'  => $request->social,
                'giro'          => $request->turn,
                'comuna'        => $request->commune,
                'region'        => $request->region,
                'ciudad'        => $request->city
            ],
        ]);
        if($customer)
            return response()->json(['success' => true, 'message' => 'Cliente registrado exitosamente.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if(\Request::wantsJson()){
            $customer = DB::table('tb_clientes')->select('idcliente', DB::raw('CONCAT(nombres," ", apellidos) AS fullnames'), 'nombres', 'apellidos', 'documento', 'email', 'telefono', 'tipo cliente AS tipo_cliente', 'razon social AS razon_social', 'giro', 'region', 'comuna', 'ciudad', 'direccion')->where('tb_clientes.idcliente', $request->id)->get();
            return response()->json(['success' => true, 'customer' => $customer], 200);
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
    public function update(FormCustomerEditRequest $request)
    {

        $customer = DB::table('tb_clientes')->where('idcliente', $request->idcliente)->update(
            [   'documento'     => $request->document_e,
                'nombres'       => $request->names_e,
                'apellidos'     => $request->surnames_e,
                'telefono'      => $request->phone_e,
                'direccion'     => $request->address_e,
                'email'         => $request->email_e,
                'tipo cliente'  => $request->type_e,
                'razon social'  => $request->social_e,
                'giro'          => $request->turn_e,
                'comuna'        => $request->commune_e,
                'region'        => $request->region_e,
                'ciudad'        => $request->city_e
            ],
        );

        if($customer)
            return response()->json(['success' => true, 'message' => 'Cliente actualizado exitosamente.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        if(\Request::wantsJson()){

            $delete = DB::table('tb_clientes')->where('tb_clientes.idcliente', $request->id)->delete();
            if ($delete) {
                return response()->json(['success' => true, 'message' => 'Cliente eliminado exitosamente.'], 200);
            } else {
                return response()->json(['error' => true, 'message' => 'El cliente no se elimino correctamente. Intente mas tarde.'], 403);
            }
        }
        abort(404);
    }
}
