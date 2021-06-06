<?php

/**
*
* @version 1.0
*
* @author Milan Gotera <milangotera@gmail.com>
* @copyright milangotera@gmail.com
*
*/

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Token;
use App\Permission\Models\Role;
use App\User;
use App\Route;
use App\Section;
use App\Customer;
use App\Poll;
use App\Canton;
use DB;
use File;

class ApiController extends Controller {

    public function profile()
    {
        return response()->json([
            'data'    => [
                'id'         => Auth::user()->id,
                'name'       => Auth::user()->name,
                'last_name'  => Auth::user()->last_name,
                'email'      => Auth::user()->email,
            ],
            'status' => 200
        ], 200);
    }

    public function login(Request $request)
    {
        $error = [];

        if(!$request->email){
            $error['email'] = "El campo email es requerido";
        }

        if(!$request->password){
            $error['password'] = "El campo clave es requerido";
        }

        if(count($error) > 0){
            return response()->json([
                'message'    => 'Por favor completa los datos de acceso',
                'errors'      => $error,
            ], 403);
        }

        $login = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|string',
        ]);

        if(!Auth::attempt($login)){
            $error['email'] = "Credenciales de acceso invalidos";
            $error['password'] = "Credenciales de acceso invalidos";
            return response()->json([ 'message' => 'Verifica tus datos de acceso', 'errors' => $error ], 400);
        }

        if (Auth::user()->status){

            $accessToken = Auth::user()->createToken('AuthToken')->accessToken;

            $user = User::find(Auth::user()->id);

            $user->save();

            return response()->json(
                [
                    'profile'    => [
		                'id'         => Auth::user()->id,
		                'name'       => Auth::user()->name,
		                'last_name'  => Auth::user()->last_name,
		                'email'      => Auth::user()->email,
		            ],
                    'token'   => $accessToken,
                    'message' => "Bienvenido, ".Auth::user()->name,
                ],
                201
            );

        } else {
            $error['email'] = "Credenciales de acceso invalidos";
            return response()->json([ 'message' => 'Tu cuenta esta inactiva', 'errors' => $error ], 401);
        }
    }

    public function download(Request $request)
    {
        $pollster = Auth::user()->id;
        $today    = date("Y-m-d H:is");
        $data     = [];

        $db_period = DB::table('polls_periods')
                    //->where('start', '<=', $today)
                    ->where('end', '>=', $today)
                    ->where('status', '=', 1)
                    ->get();

        foreach ($db_period as $period) {

            // AJUSTANDO LOS CANTONES
            $cantons = [];

            $db_canton  = Canton::select('cantons.*','assignment_pollster.routes as routes')
                        ->join('assignment_pollster', 'cantons.id', '=', 'assignment_pollster.canton_id')
                        ->where('assignment_pollster.period_id', '=', $period->id)
                        ->where('assignment_pollster.pollster_id', '=', $pollster)
                        ->get();

            foreach ($db_canton as $canton) {

                // AJUSTANDO LAS RUTAS
                $routes = [];
                
                $db_rute  = Route::select('routes.*')
                            ->whereIn('id', explode(",", $canton->routes) )
                            ->get();

                foreach ($db_rute as $rute) {

                    $custormers     = [];

                    $db_custormers  = Customer::select(
                        DB::raw("customers.*, (select count(0) from card_poll where customer_id=customers.id and period_id=".$period->id.") as quiz")
                        )
                        ->where('customers.route_id', '=', $rute->id)
                        ->get();

                    foreach ($db_custormers as $custormer) {
                        $custormer->done = $custormer->quiz > 0 ? true : false;
                        $custormers[] = $custormer;
                    }

                    $routes[]   = [
                        'id'          => $rute->id,
                        'canton_id'   => $rute->canton_id,
                        'name'        => $rute->name,
                        'customers'   => $custormers
                    ];
                }

                $cantons[]   = [
                    'id'          => $canton->id,
                    'name'        => $canton->name,
                    'routes'      => $routes,
                    'explode'     => explode(",", $canton->routes),
                ];

            }

            // AJUSTANDO LAS ENCUESTAS
            $poll  = Poll::select('*')
                    ->where('id', '=', $period->poll_id)
                    ->first();

            // AJUSTANDO LAS SECCIONES
            $sections = [];

            foreach ($poll->Section as $section) {

                // AJUSTANDO LAS PREGUNTAS
                $questions = [];
                foreach ($section->Question as $question) {

                    // AJUSTANDO LAS OPCIONES
                    $options = [];
                    foreach ($question->Option as $option) {
                        // AJUSTANDO LAS ITEM
                        $items = [];
                        $option->item  = $option->Item;
                        $options[]     = $option;
                    }

                    $questions[] = [
                        'id'           => $question->id,
                        'name'         => $question->name,
                        'description'  => $question->description,
                        'type'         => $question->type,
                        'options'      => $options,
                    ];
                }

                $sections[] = [
                    'id'    => $section->id,
                    'name'    => $section->name,
                    'questions'    => $questions,
                ];
            }

            $polls = [
                'id'       => $poll->id,
                'name'     => $poll->name,
                'sections' => $sections,
            ];

            // AGREGANDO LOS DATOS
            $data[] = [
                'id'      => $period->id,
                'start'   => $period->start,
                'end'     => $period->end,
                'polls'    => $polls,
                'cantons'  => $cantons
            ];
        }

        return response()->json($data, 200);
    }

    public function upload(Request $request)
    {
        $data          = 0;
        $pollster      = Auth::user()->id;
        $today         = date("Y-m-d H:is");
        $responses     = [];

        if(!$request->responses){
            return response()->json(["message" => "No se han enviado encuestas"], 200);
        }

        array_push($responses, $request->responses);

        foreach ($responses as $response) {

            $questions = isset($response['questions']) ? $response['questions'] : [];

            if( count($questions) > 0 ){

                $search = DB::table('card_poll')
                            ->where("period_id", "=", $response['period_id'])
                            ->where("customer_id", "=", $response['customer_id'])
                            ->count();

                if($search == 0){

                    $customer = Customer::find($response['customer_id']);

                    if(!$customer) {
                        $customer = new Customer;
                    }

                    $customer->observation     = $response['observation'];
                    $customer->name            = $response['name'];
                    $customer->last_name       = $response['last_name'];
                    $customer->document        = $response['document'];
                    $customer->email           = $response['email'];
                    $customer->phone           = $response['phone'];
                    $customer->mobile          = $response['mobile'];
                    $customer->city            = $response['city'];
                    $customer->province        = $response['province'];
                    $customer->address         = $response['address'];
                    $customer->gender          = $response['gender'] ? $response['gender'] : "M";
                    $customer->number_measurer = $response['number_measurer'];
                    $customer->rate            = $response['rate'];
                    $customer->half            = $response['half'];
                    $customer->code            = $response['code'];
                    $customer->route_id        = $response['route_id'];
                    $customer->save();

                    $card = DB::table('card_poll')->insert([
                        'respondent' => $response['respondent'],
                        //'route_id'       => $response['route_id'],
                        'period_id' => $response['period_id'],
                        'poll_id' => $response['poll_id'],
                        'customer_id' => $customer->id,
                        'pollster_id' => $response['pollster_id'],
                        'img' => $this->saveBase64($response['img'], "upload/card/", date("YmdHis").'.'.'jpg'),
                    ]);

                    foreach ($questions as $question) {

                        $item = DB::table('answers_questions_polls')->insert([
                            'question_id' => isset($question['question_id']) ? $question['question_id'] : NULL,
                            'option_id'       => isset($question['option_id']) ? $question['option_id'] : NULL,
                            'item_id' => isset($question['item_id']) ? $question['item_id'] : NULL,
                            'period_id' => isset($question['period_id']) ? $question['period_id'] : NULL,
                            'poll_id' => isset($question['question_id']) ? $question['poll_id'] : NULL,
                            //'route_id' => isset($question['route_id']) ? $question['route_id'] : NULL,
                            'canton_id' => isset($question['canton_id']) ? $question['canton_id'] : NULL,
                            'customer_id' => isset($customer->id) ? $customer->id : NULL,
                            'type' => isset($question['type']) ? $question['type'] : NULL,
                            'value' => isset($question['value']) ? $question['value'] : NULL,
                        ]);

                    }

                }
            }

        }

        return response()->json(
            [
                "message"    => "Se han cargado los datos exitosamente",
                "responses"  => $responses
            ],
            200
        );
    }

}
