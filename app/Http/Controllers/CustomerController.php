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
            $customer = DB::table('customers')->select('id', DB::raw('CONCAT(name," ", last_name) AS fullname'), 'document', 'email', 'phone', 'city', 'province', 'address', 'gender', DB::raw('IF(status=1,"Activo","Inactivo") AS status'))->get();
            return Datatables::of($customer)
                    ->addIndexColumn()
                    ->addColumn('action', function($customer){
                           $btn = '';
                        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Editar"  data-id="'.$customer->id.'" id="edit_'.$customer->id.'" class="btn btn-primary btn-xs mr-1 editCustomer">
                                        <i class="fas fa-pencil-alt"></i>
                                </a>';
                        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Detalles"  data-id="'.$customer->id.'" id="det_'.$customer->id.'" class="btn btn-info btn-xs  mr-1 detalleCustomer">
                                    <i class="fas fa-search"></i>
                                </a>';
                        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Eliminar"  data-id="'.$customer->id.'" id="del_'.$customer->id.'" class="btn btn-danger btn-xs deleteCustomer">
                                        <i class="fas fa-trash-alt"></i>
                                </a>';
                        return $btn;
                    })
                    ->addColumn('status', function($customer){
                        $btn = '';
                        if($customer->status=='Activo'){
                            $btn .= '<span class="badge badge-success">'.$customer->status.'</span>';
                        }else{
                            $btn .= '<span class="badge badge-danger">'.$customer->status.'</span>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
        }

        $customers           = Customer::count();
        $customers_inactive  = Customer::where('status', 0)->count();
        $customers_active    = Customer::where('status', 1)->count();
        return view('panel.admin.customers.index', ['title' => 'Clientes', 'customers' => $customers, 'customers_inactive' => $customers_inactive, 'customers_active' => $customers_active]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormCustomerAddRequest $request)
    {
        $customer               = new Customer();
        $customer->name         = $request->name;
        $customer->last_name    = $request->last_name;
        $customer->document     = $request->document;
        $customer->email        = $request->email;
        $customer->phone        = $request->phone;
        $customer->mobile       = $request->mobile;
        $customer->city         = $request->city;
        $customer->province     = $request->province;
        $customer->address      = $request->address;
        $customer->gender       = $request->gender;
        $customer->number_measurer  = $request->number_measurer;
        $customer->rate       = $request->rate;
        $customer->half       = $request->half;
        $customer->code       = $request->code;
        $customer->observation  = $request->observation;
        $customer->route_id     = $request->route;

        if($request->file('img')){
            $file           = $request->file('img');
            $extension      = $file->getClientOriginalExtension();
            $fileName       = time() . '.' . $extension;
            $customer->img  = $fileName;
            $file->move(public_path('img/customer/'), $fileName);
        }else{
            $customer->img = 'avatar.svg';
        }
        $saved = $customer->save();
        if($saved)
            return response()->json(['success' => true, 'message' => 'Cliente registrado exitosamente.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if(\Request::wantsJson()){
            $customer = Customer::findOrFail($id);
            return response()->json(['success' => true, 'customer' => $customer, 'route' => $customer->route], 200);
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
    public function update(FormCustomerEditRequest $request, Customer $Customer)
    {
        $customer = Customer::findOrFail($Customer->id);
        $customer->name         = $request->name;
        $customer->last_name    = $request->last_name;
        $customer->document     = $request->document;
        $customer->email        = $request->email;
        $customer->phone        = $request->phone;
        $customer->mobile       = $request->mobile;
        $customer->city         = $request->city;
        $customer->province     = $request->province;
        $customer->address      = $request->address;
        $customer->gender       = $request->gender;
        $customer->number_measurer  = $request->number_measurer;
        $customer->rate       = $request->rate;
        $customer->half       = $request->half;
        $customer->code       = $request->code;
        $customer->observation  = $request->observation;
        $customer->status     = ($request->status=="true") ? 1 : 0;
        $customer->route_id   = $request->route;

        if($request->file('img')){
            if ($customer->img != "avatar.svg") {
                if (File::exists(public_path('img/customer/' . $customer->img))) {
                    File::delete(public_path('img/customer/' . $customer->img));
                }
            }

            $file          = $request->file('img');
            $extension     = $file->getClientOriginalExtension();
            $fileName      = time() . '.' . $extension;
            $customer->img = $fileName;
            $file->move(public_path('img/customer/'), $fileName);
        }

        $saved = $customer->save();
        if($saved)
            return response()->json(['success' => true, 'message' => 'Cliente actualizado exitosamente.'], 200);
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
            $customer = Customer::findOrFail($id);
            if ($customer->img != "avatar.svg") {
                if (File::exists(public_path('img/customer/' . $customer->img))) {
                    File::delete(public_path('img/customer/' . $customer->img));
                }
            }
            $delete = $customer->delete();
            if ($delete) {
                return response()->json(['success' => true, 'message' => 'Cliente eliminado exitosamente.'], 200);
            } else {
                return response()->json(['error' => true, 'message' => 'El cliente no se elimino correctamente. Intente mas tarde.'], 403);
            }
        }
        abort(404);
    }
}
