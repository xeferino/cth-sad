<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormPollAddRequest;
use App\Http\Requests\FormPollEditRequest;
use App\Poll;
use App\Section;
use App\OptionItem;
use App\Question;
use App\Customer;
use App\Route;
use App\Canton;
use App\User;
use DataTables;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;


class PollController extends Controller
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
            $poll = Poll::select('id',  'name', 'description');
            return Datatables::of($poll)
                    ->addIndexColumn()
                    ->addColumn('action', function($poll){
                           $btn = '';
                           $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Agregar Seccion"  data-id="'.$poll->id.'" id="add_'.$poll->id.'" class="btn btn-warning btn-xs sectionPoll">
                                        <i class="fas fa-columns"></i>
                                    </a>
                                    ';
                           $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Editar"  data-id="'.$poll->id.'" id="edit_'.$poll->id.'" class="btn btn-primary btn-xs editPoll">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    ';
                           $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Eliminar"  data-id="'.$poll->id.'" id="del_'.$poll->id.'" class="btn btn-danger btn-xs deletePoll">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        $polls = Poll::count();
        $sections = Section::all();
        return view('panel.admin.polls.index', ['title' => 'Encuentas', 'polls' => $polls, 'sections' => $sections]);
    }

    /**
     * all resources
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function all(Request $request)
    {
        if(\Request::wantsJson()){
            $polls = Poll::all();
            foreach($polls->chunk(100) as $key => $poll){
                $survers = [];
                foreach($poll as $item){
                    array_push($survers, [
                        'id' => $item['id'],
                        'name' => $item['name']
                    ]);
                }
            }
            return response()->json(['success' => true, 'polls' => $survers ?? 0], 200);
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormPollAddRequest $request)
    {
        $poll =  new Poll();
        $poll->name        =  $request->name;
        $poll->description =  $request->description;
        $saved = $poll->save();
        if($saved)
            return response()->json(['success' => true, 'message' => 'Encuesta registrada exitosamente.'], 200);
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
            $poll = Poll::findOrFail($id);
            if(!empty($poll->section) && ($poll->section->count()>0)){
                $sections = [];
                foreach ($poll->section as $key => $sec) {
                    $questions = [];
                    foreach (Section::find($sec->id)->question as $question) {

                        $caracteres = (strlen($question->description)/2);
                        if($question->type=="open"){
                            $options = [];
                            foreach (Question::find($question->id)->option as $option){
                                array_push($options, ['id'          => $option->id,
                                                      'name'        => $option->name,
                                                      'question_id' => $option->question_id,
                                                      'items'       => OptionItem::where('option_id', $option->id)->get()
                                                    ]);
                            }
                            array_push($questions, [
                                'id'            => $question->id,
                                'name'          => $question->name,
                                'description'   => substr($question->description, 0, $caracteres).'...',
                                'title'         => $question->description,
                                'type'          => $question->type,
                                'options'       => $options,
                            ]);
                        }else{
                            array_push($questions, [
                                'id'            => $question->id,
                                'name'          => $question->name,
                                'description'   => substr($question->description, 0, $caracteres).'...',
                                'title'         => $question->description,
                                'type'          => $question->type,
                            ]);
                        }
                    }

                    array_push($sections, [
                        'id'            => $sec->id,
                        'name'          => $sec->name,
                        'description'   => $sec->description,
                        'questions'     => $questions
                    ]);
                }
            }
            return response()->json(['success' => true, 'poll' => $poll, 'sections' => $sections ?? '0'], 200);
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
    public function update(FormPollEditRequest $request, Poll $Poll)
    {
        $poll   = Poll::findOrFail($Poll->id);
        $poll->fill($request->all());
        $saved = $poll->save();
        if($saved)
            return response()->json(['success' => true, 'message' => 'Encuesta actualizada exitosamente.'], 200);
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
            $poll = Poll::findOrFail($id);
            $delete = $poll->delete();
            if ($delete) {
                return response()->json(['success' => true, 'message' => 'Encuesta eliminada exitosamente.'], 200);
            } else {
                return response()->json(['error' => true, 'message' => 'la Encuesta no se elimino correctamente. Intente mas tarde.'], 403);
            }
        }
        abort(404);
    }

    public function pdfPollCustomer($poll, $period, $customer, $pollster)
    {
        $answers = DB::table('answers_questions_polls')->where('period_id', $period)->where('poll_id', $poll)->where('customer_id', $customer)->get();
        $poll = Poll::findOrFail($poll);
        if(!empty($poll->section) && ($poll->section->count()>0)){
            $polls = [];
            foreach ($poll->section as $key => $sec) {
                $questions = [];
                foreach (Section::find($sec->id)->question as $question) {
                    if($question->type=="open"){
                        $options = [];
                        foreach (Question::find($question->id)->option as $option){
                            $items = [];
                            foreach(OptionItem::where('option_id', $option->id)->get() as $item){
                                $value_item = 'no';
                                    foreach($answers as $answer){
                                    if($answer->question_id == $option->question_id && $answer->option_id == $option->id && $answer->item_id == $item->id){
                                        if($answer->value=='si' or $answer->value=='1');
                                            $value_item = 'si';
                                    }
                                }
                                array_push($items, ['id'    => $item->id,
                                                    'name'  => $item->name,
                                                    'value' => $value_item,
                                ]);
                            }

                            array_push($options, ['id'          => $option->id,
                                                    'name'        => $option->name,
                                                    'question_id' => $option->question_id,
                                                    'items'       => $items,
                                                ]);
                        }
                        array_push($questions, [
                            'id'            => $question->id,
                            'name'          => $question->name,
                            'description'   => $question->description,
                            'type'          => $question->type,
                            'options'       => $options,
                        ]);
                    }else{
                        $value = 0;
                        foreach($answers as $answer){
                            if($answer->question_id == $question->id){
                                $value = $answer->value;
                            }
                        }
                        array_push($questions, [
                            'id'            => $question->id,
                            'name'          => $question->name,
                            'description'   => $question->description,
                            'frecuency'     => [1,2,3,4,5,6,7,8,9,10],
                            'value'         => $value,
                            'type'          => $question->type,
                        ]);
                    }
                }

                array_push($polls, [
                    'id'            => $sec->id,
                    'name'          => $sec->name,
                    'questions'     => $questions,
                ]);
            }
        }

        $card = DB::table('card_poll')->where('period_id', $period)->where('poll_id', $poll->id)->where('customer_id', $customer)->count();
        $client = Customer::find($customer);
        $route = Route::find($client->route->id);
        $prefix = Canton::find($route->canton_id)->code."00".$poll->id;

        $pollster = User::find($pollster);
        if($card>0){
            $card_poll = DB::table('card_poll')->where('period_id', $period)->where('poll_id', $poll->id)->where('customer_id', $customer)->first();
        }

        $pdf = PDF::loadView('panel.admin.polls.pdfs.poll-customer', ['polls' =>  $polls ?? abort(404), 'card' =>  $card_poll ?? null, 'customer' => $client, 'poll_info' => $poll,  'pollster' => $pollster ?? '', 'prefix' => $prefix ?? 'POLL000']);
        $client = $client ?? 'default';
        return ($client != 'default') ? $pdf->stream('poll-'.$client->name.'-'.$client->last_name.'.pdf') : $pdf->stream('poll-'.$client.'.pdf');
    }
}
