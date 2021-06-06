<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Poll;
use App\User;
use App\Route;
use App\Canton;
use App\Question;
use App\Section;
use App\Option;
use App\OptionItem;
use App\Customer;
use App\PollOpen AS Period;
use App\Assignment;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Str;
use DataTables;



class TabController extends Controller
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
        foreach (Canton::all() as $key => $value) {
            $all [] = $value->id;
        }
        return view('panel.admin.tabs.index', ['title' => 'Tabulaciones Indices de Sastifacion', 'polls' => $this->polls(), 'cantons' => Canton::all(), 'all' => $all]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reportSingle(Request $request)
    {
        foreach (Canton::all() as $key => $value) {
            $all [] = $value->id;
        }
        return view('panel.admin.tabs.single', ['title' => 'Tabulaciones Individuales', 'polls' => $this->polls(), 'cantons' => Canton::all(), 'all' => $all]);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forQuestion(Request $request)
    {
        foreach (Canton::all() as $key => $value) {
            $all [] = $value->id;
        }
        return view('panel.admin.tabs.question', ['title' => 'Tabulaciones por Preguntas', 'polls' => $this->polls(), 'cantons' => Canton::all(), 'all' => $all]);
    }


    /**
     * Show the polls
     *
     * @return \Illuminate\Http\Response
     */
    public function polls()
    {
        $polls = DB::table('polls_periods')->select('polls_periods.id AS period_id', DB::raw('CONCAT(polls_periods.start," - ", polls_periods.end) AS period'), 'polls_periods.poll_id', 'polls.name AS poll' )->leftJoin('polls', 'polls_periods.poll_id', '=', 'polls.id')->get();
        return $polls;
    }

    /**
     * Show the polls
     *
     * @return \Illuminate\Http\Response
     */
    public function tabPollCantonIndexes(Request $request)
    {
        return is_array(json_decode(decrypt($request->canton))) ? $this->allTabPollCantonIndexes($request) : $this->singleTabPollCantonIndexes($request);
    }

    /**
     * Show the polls
     *
     * @return \Illuminate\Http\Response
     */
    public function singleTabPollCantonIndexes($request)
    {
        if($request->has('canton') && $request->has('poll')){
            $period_id = decrypt($request->poll);
            $poll = Period::find($period_id);
            $survey = Poll::find($poll->poll_id);
            $period = $poll->start." - ".$poll->end;

            $tabs = DB::table('answers_questions_polls')
                    ->select('answers_questions_polls.poll_id', 'answers_questions_polls.type', 'questions.id', 'questions.name', 'questions.section_id', 'cantons.id AS canton_id', 'cantons.name AS canton', 'cantons.code',
                            //values questions
                              DB::raw('SUM(IF(answers_questions_polls.value=1  and answers_questions_polls.type="close","1","0")) as item_1'),
                              DB::raw('SUM(IF(answers_questions_polls.value=2  and answers_questions_polls.type="close","1","0")) as item_2'),
                              DB::raw('SUM(IF(answers_questions_polls.value=3  and answers_questions_polls.type="close","1","0")) as item_3'),
                              DB::raw('SUM(IF(answers_questions_polls.value=4  and answers_questions_polls.type="close","1","0")) as item_4'),
                              DB::raw('SUM(IF(answers_questions_polls.value=5  and answers_questions_polls.type="close","1","0")) as item_5'),
                              DB::raw('SUM(IF(answers_questions_polls.value=6  and answers_questions_polls.type="close","1","0")) as item_6'),
                              DB::raw('SUM(IF(answers_questions_polls.value=7  and answers_questions_polls.type="close","1","0")) as item_7'),
                              DB::raw('SUM(IF(answers_questions_polls.value=8  and answers_questions_polls.type="close","1","0")) as item_8'),
                              DB::raw('SUM(IF(answers_questions_polls.value=9  and answers_questions_polls.type="close","1","0")) as item_9'),
                              DB::raw('SUM(IF(answers_questions_polls.value=10 and answers_questions_polls.type="close","1","0")) as item_10'),
                            //totales
                            DB::raw('(
                                        SUM(IF(answers_questions_polls.`value`=1 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=2 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=3 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=4 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=5 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=6 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=7 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=8 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=9 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=10 and answers_questions_polls.type="close",1,0))
                                     ) as total'
                            ),
                            //menor o igual 7
                            DB::raw('(
                                    SUM(IF(answers_questions_polls.`value`=1 and answers_questions_polls.type="close",1,0))
                                    + SUM(IF(answers_questions_polls.`value`=2 and answers_questions_polls.type="close",1,0))
                                    + SUM(IF(answers_questions_polls.`value`=3 and answers_questions_polls.type="close",1,0))
                                    + SUM(IF(answers_questions_polls.`value`=4 and answers_questions_polls.type="close",1,0))
                                    + SUM(IF(answers_questions_polls.`value`=5 and answers_questions_polls.type="close",1,0))
                                    + SUM(IF(answers_questions_polls.`value`=6 and answers_questions_polls.type="close",1,0))
                                ) as menor_a_7'
                            ),
                            //mayor a 7
                            DB::raw('(
                                + SUM(IF(answers_questions_polls.`value`=7 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=8 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=9 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=10 and answers_questions_polls.type="close",1,0))
                             ) as mayor_a_7'
                            ),
                            //percent
                            DB::raw('(((
                                + SUM(IF(answers_questions_polls.`value`=7 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=8 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=9 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=10 and answers_questions_polls.type="close",1,0))
                             )/(
                                SUM(IF(answers_questions_polls.`value`=1 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=2 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=3 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=4 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=5 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=6 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=7 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=8 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=9 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=10 and answers_questions_polls.type="close",1,0))
                             )*100)
                             ) as percent'
                            )
                    )
                    ->Join('polls_periods', 'polls_periods.id', '=', 'answers_questions_polls.period_id')
                    ->Join('questions', 'questions.id', '=', 'answers_questions_polls.question_id')
                    ->Join('cantons', 'cantons.id', '=', 'answers_questions_polls.canton_id')
                    ->where('answers_questions_polls.poll_id', $poll->poll_id)
                    ->where('answers_questions_polls.period_id', $period_id)
                    ->where(function ($query) use ($request) {
                        is_array(json_decode(decrypt($request->canton))) ? $query->whereIn('answers_questions_polls.canton_id', json_decode(decrypt($request->canton))) : $query->where('answers_questions_polls.canton_id', decrypt($request->canton));
                    })
                    ->groupBy('answers_questions_polls.question_id', 'answers_questions_polls.canton_id', 'answers_questions_polls.poll_id')
                    ->orderBy('questions.id',   'asc')
                    ->orderBy('cantons.name', 'asc')
                    ->orderBy('cantons.id', 'asc')
                    ->get();
            if(count($tabs)>0){
                $cantons = [];
                $canton = Canton::find(decrypt($request->canton));
                $sections = [];
                //poll sections all
                $sect =1;
                foreach(Poll::find($poll->poll_id)->section as $section){
                    if($section->poll_id == $survey->id){
                        $section_name = $section->name;
                        $questions = [];

                        //poll sections all questiosn
                        $total_section = 0;
                        $total_section_mayor_o_igual_a_7 = 0;
                        $total_section_menor_a_7 = 0;
                        $total_section_percent = 0;
                        foreach (Section::find($section->id)->question as $question) {
                            if($question->type=="close"){
                                foreach($tabs as $tab){
                                    //$canton_id = Canton::find($tab->canton_id)->id;
                                    if($tab->poll_id == $section->poll_id && $tab->canton_id == $canton->id && $question->id == $tab->id){
                                        //poll sections all questiosn close
                                        $mayor_o_igual_a_7 = $tab->item_7+$tab->item_8+$tab->item_9+$tab->item_10;
                                        $menor_a_7 = $tab->item_1+$tab->item_2+$tab->item_3+$tab->item_4+$tab->item_5+$tab->item_6;
                                        array_push($questions, [
                                            'id'            => $question->id,
                                            'name'          => $question->name,
                                            'type'          => $question->type,
                                            'item_1'        => $tab->item_1,
                                            'item_2'        => $tab->item_2,
                                            'item_3'        => $tab->item_3,
                                            'item_4'        => $tab->item_4,
                                            'item_5'        => $tab->item_5,
                                            'item_6'        => $tab->item_6,
                                            'item_7'        => $tab->item_7,
                                            'item_8'        => $tab->item_8,
                                            'item_9'        => $tab->item_9,
                                            'item_10'       => $tab->item_10,
                                            'total'         => $tab->total,
                                            'mayor_o_igual_a_7' => $mayor_o_igual_a_7,
                                            'menor_a_7'     =>  $menor_a_7,
                                        ]);
                                        $total_section += $tab->total;
                                        $total_section_mayor_o_igual_a_7 += $mayor_o_igual_a_7;
                                        $total_section_menor_a_7 += $menor_a_7;
                                        $total_section_percent += (($mayor_o_igual_a_7/$total_section)*100);
                                    }
                                }
                            }
                        }
                    }
                    array_push($sections, [ 'id'   => "SEC".$sect++,
                                            'name' => $section_name,
                                            'questions' => $questions,
                                            'total_sect' => $total_section,
                                            'high_seven_sect' => $total_section_mayor_o_igual_a_7,
                                            'less_seven_sect' => $total_section_menor_a_7,
                                            'percent_sect' => $total_section_percent
                    ]);
                }

                array_push($cantons, ['id' => $canton->id, 'canton' =>  $canton->name, 'code' =>  $canton->code, 'prefix' =>  $canton->code."00".$survey->id, 'period' => $period, 'poll' =>  $survey->name, 'sections' => $sections]);
                if(count($cantons)>0){
                    return View('panel.admin.tabs.tabs-poll-single-indexes', ['cantons' => $cantons]);
                    //$pdf = PDF::loadView('panel.admin.tabs.tabs-poll-single', ['cantons' => $cantons]);
                    //return $pdf->stream('poll-'.$canton->code."00".$survey->id.'.pdf');
                }
                abort(404);
            }
            abort(404);
        }
    }

    /**
     * Show the polls
     *
     * @return \Illuminate\Http\Response
     */
    public function allTabPollCantonIndexes($request)
    {
        if($request->has('canton') && $request->has('poll')){
            $period_id = decrypt($request->poll);
            $poll = Period::find($period_id);
            $survey = Poll::find($poll->poll_id);
            $period = $poll->start." - ".$poll->end;

            $tabs = DB::table('answers_questions_polls')
                    ->select('answers_questions_polls.poll_id', 'answers_questions_polls.type', 'questions.id', 'questions.name', 'questions.section_id', 'cantons.id AS canton_id', 'cantons.name AS canton', 'cantons.code',
                            //values questions
                              DB::raw('SUM(IF(answers_questions_polls.value=1  and answers_questions_polls.type="close","1","0")) as item_1'),
                              DB::raw('SUM(IF(answers_questions_polls.value=2  and answers_questions_polls.type="close","1","0")) as item_2'),
                              DB::raw('SUM(IF(answers_questions_polls.value=3  and answers_questions_polls.type="close","1","0")) as item_3'),
                              DB::raw('SUM(IF(answers_questions_polls.value=4  and answers_questions_polls.type="close","1","0")) as item_4'),
                              DB::raw('SUM(IF(answers_questions_polls.value=5  and answers_questions_polls.type="close","1","0")) as item_5'),
                              DB::raw('SUM(IF(answers_questions_polls.value=6  and answers_questions_polls.type="close","1","0")) as item_6'),
                              DB::raw('SUM(IF(answers_questions_polls.value=7  and answers_questions_polls.type="close","1","0")) as item_7'),
                              DB::raw('SUM(IF(answers_questions_polls.value=8  and answers_questions_polls.type="close","1","0")) as item_8'),
                              DB::raw('SUM(IF(answers_questions_polls.value=9  and answers_questions_polls.type="close","1","0")) as item_9'),
                              DB::raw('SUM(IF(answers_questions_polls.value=10 and answers_questions_polls.type="close","1","0")) as item_10'),
                            //totales
                            DB::raw('(
                                        SUM(IF(answers_questions_polls.`value`=1 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=2 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=3 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=4 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=5 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=6 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=7 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=8 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=9 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=10 and answers_questions_polls.type="close",1,0))
                                     ) as total'
                            ),
                            //menor o igual 7
                            DB::raw('(
                                    SUM(IF(answers_questions_polls.`value`=1 and answers_questions_polls.type="close",1,0))
                                    + SUM(IF(answers_questions_polls.`value`=2 and answers_questions_polls.type="close",1,0))
                                    + SUM(IF(answers_questions_polls.`value`=3 and answers_questions_polls.type="close",1,0))
                                    + SUM(IF(answers_questions_polls.`value`=4 and answers_questions_polls.type="close",1,0))
                                    + SUM(IF(answers_questions_polls.`value`=5 and answers_questions_polls.type="close",1,0))
                                    + SUM(IF(answers_questions_polls.`value`=6 and answers_questions_polls.type="close",1,0))
                                ) as menor_a_7'
                            ),
                            //mayor a 7
                            DB::raw('(
                                + SUM(IF(answers_questions_polls.`value`=7 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=8 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=9 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=10 and answers_questions_polls.type="close",1,0))
                             ) as mayor_a_7'
                            ),
                            //percent
                            DB::raw('(((
                                + SUM(IF(answers_questions_polls.`value`=7 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=8 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=9 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=10 and answers_questions_polls.type="close",1,0))
                             )/(
                                SUM(IF(answers_questions_polls.`value`=1 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=2 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=3 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=4 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=5 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=6 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=7 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=8 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=9 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=10 and answers_questions_polls.type="close",1,0))
                             )*100)
                             ) as percent'
                            )
                    )
                    ->Join('polls_periods', 'polls_periods.id', '=', 'answers_questions_polls.period_id')
                    ->Join('questions', 'questions.id', '=', 'answers_questions_polls.question_id')
                    ->Join('cantons', 'cantons.id', '=', 'answers_questions_polls.canton_id')
                    ->where('answers_questions_polls.poll_id', $poll->poll_id)
                    ->where('answers_questions_polls.period_id', $period_id)
                    ->where('answers_questions_polls.type', 'close')
                    ->where(function ($query) use ($request) {
                        is_array(json_decode(decrypt($request->canton))) ? $query->whereIn('answers_questions_polls.canton_id', json_decode(decrypt($request->canton))) : $query->where('answers_questions_polls.canton_id', decrypt($request->canton));
                    })
                    ->groupBy('answers_questions_polls.question_id', 'answers_questions_polls.canton_id', 'answers_questions_polls.poll_id')
                    ->orderBy('questions.id',   'asc')
                    ->orderBy('cantons.name', 'asc')
                    ->orderBy('cantons.id', 'asc')
                    ->get();

                    $cantons = [];
                    $sections = [];
                    $sect =1;
                    foreach(Poll::find($poll->poll_id)->section as $section){
                        $questions = [];
                        foreach (Section::find($section->id)->question as $question) {
                            if($question->type=="close"){
                                $item_1 = 0;
                                $item_2 = 0;
                                $item_3 = 0;
                                $item_4 = 0;
                                $item_5 = 0;
                                $item_6 = 0;
                                $item_7 = 0;
                                $item_8 = 0;
                                $item_9 = 0;
                                $item_10 = 0;
                                $total = 0;
                                $mayor_o_igual_a_7 = 0;
                                $menor_a_7 = 0;
                                $percent = 0;
                                foreach($tabs as $tab){
                                    if($tab->poll_id == $section->poll_id && $question->id == $tab->id){
                                        $item_1 += $tab->item_1;
                                        $item_2 += $tab->item_2;
                                        $item_3 += $tab->item_3;
                                        $item_4 += $tab->item_4;
                                        $item_5 += $tab->item_5;
                                        $item_6 += $tab->item_6;
                                        $item_7 += $tab->item_7;
                                        $item_8 += $tab->item_8;
                                        $item_9 += $tab->item_9;
                                        $item_10 += $tab->item_10;
                                        $total +=$tab->total;
                                        $mayor_o_igual_a_7 += $tab->mayor_a_7;
                                        $menor_a_7 += $tab->menor_a_7;
                                        $percent += $tab->percent;
                                    }
                                }
                                array_push($questions, [
                                    'id'            => $question->id,
                                    'name'          => $question->name,
                                    'type'          => $question->type,
                                    'item_1'        => $item_1,
                                    'item_2'        => $item_2,
                                    'item_3'        => $item_3,
                                    'item_4'        => $item_4,
                                    'item_5'        => $item_5,
                                    'item_6'        => $item_6,
                                    'item_7'        => $item_7,
                                    'item_8'        => $item_8,
                                    'item_9'        => $item_9,
                                    'item_10'       => $item_10,
                                    'total'         => $total,
                                    'mayor_o_igual_a_7' => $mayor_o_igual_a_7,
                                    'menor_a_7'         => $menor_a_7,
                                    'percent'       => sprintf('%0.2f', (($mayor_o_igual_a_7/$total)*100))
                                ]);
                            }
                        }
                        array_push($sections, ['id'   => "SEC".$sect++,'name' => $section->name, 'questions' => $questions]);
                    }
                    array_push($cantons, ['period' => $period, 'poll' =>  $survey->name, 'sections' => $sections]);

                    if(count($cantons)>0){
                        return View('panel.admin.tabs.tabs-poll-indexes', ['cantons' => $cantons]);
                        //$pdf = PDF::loadView('panel.admin.tabs.tabs-poll', ['cantons' => $cantons]);
                        //return $pdf->stream('polls-cantones-all.pdf');
                    }
                    abort(404);
        }
    }

    /**
     * Show the polls
     *
     * @return \Illuminate\Http\Response
     */
    public function tabPollCantonQuestion(Request $request)
    {
        return is_array(json_decode(decrypt($request->canton))) ? $this->allTabPollCantonQuestion($request) : $this->singleTabPollCantonQuestion($request);
    }

    /**
     * Show the polls
     *
     * @return \Illuminate\Http\Response
     */
    public function singleTabPollCantonQuestion($request)
    {
        if($request->has('canton') && $request->has('poll')){
            $period_id = decrypt($request->poll);
            $poll = Period::find($period_id);
            $survey = Poll::find($poll->poll_id);
            $period = $poll->start." - ".$poll->end;

            $tabs = DB::table('answers_questions_polls')
                    ->select('answers_questions_polls.poll_id', 'answers_questions_polls.type', 'questions.id', 'questions.name', 'questions.section_id', 'cantons.id AS canton_id', 'cantons.name AS canton', 'cantons.code',
                            //values questions
                              DB::raw('SUM(IF(answers_questions_polls.value=1  and answers_questions_polls.type="close","1","0")) as item_1'),
                              DB::raw('SUM(IF(answers_questions_polls.value=2  and answers_questions_polls.type="close","1","0")) as item_2'),
                              DB::raw('SUM(IF(answers_questions_polls.value=3  and answers_questions_polls.type="close","1","0")) as item_3'),
                              DB::raw('SUM(IF(answers_questions_polls.value=4  and answers_questions_polls.type="close","1","0")) as item_4'),
                              DB::raw('SUM(IF(answers_questions_polls.value=5  and answers_questions_polls.type="close","1","0")) as item_5'),
                              DB::raw('SUM(IF(answers_questions_polls.value=6  and answers_questions_polls.type="close","1","0")) as item_6'),
                              DB::raw('SUM(IF(answers_questions_polls.value=7  and answers_questions_polls.type="close","1","0")) as item_7'),
                              DB::raw('SUM(IF(answers_questions_polls.value=8  and answers_questions_polls.type="close","1","0")) as item_8'),
                              DB::raw('SUM(IF(answers_questions_polls.value=9  and answers_questions_polls.type="close","1","0")) as item_9'),
                              DB::raw('SUM(IF(answers_questions_polls.value=10 and answers_questions_polls.type="close","1","0")) as item_10'),
                            //totales
                            DB::raw('(
                                        SUM(IF(answers_questions_polls.`value`=1 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=2 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=3 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=4 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=5 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=6 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=7 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=8 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=9 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=10 and answers_questions_polls.type="close",1,0))
                                     ) as total'
                            ),
                             //menor o igual 7
                             DB::raw('(
                                SUM(IF(answers_questions_polls.`value`=1 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=2 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=3 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=4 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=5 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=6 and answers_questions_polls.type="close",1,0))
                            ) as menor_a_7'
                            ),
                            //mayor a 7
                            DB::raw('(
                                + SUM(IF(answers_questions_polls.`value`=7 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=8 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=9 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=10 and answers_questions_polls.type="close",1,0))
                            ) as mayor_a_7'
                            ),
                            //percent
                            DB::raw('(((
                                + SUM(IF(answers_questions_polls.`value`=7 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=8 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=9 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=10 and answers_questions_polls.type="close",1,0))
                            )/(
                                SUM(IF(answers_questions_polls.`value`=1 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=2 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=3 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=4 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=5 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=6 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=7 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=8 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=9 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=10 and answers_questions_polls.type="close",1,0))
                            )*100)
                            ) as percent'
                            )
                    )
                    ->Join('polls_periods', 'polls_periods.id', '=', 'answers_questions_polls.period_id')
                    ->Join('questions', 'questions.id', '=', 'answers_questions_polls.question_id')
                    ->Join('cantons', 'cantons.id', '=', 'answers_questions_polls.canton_id')
                    ->where('answers_questions_polls.poll_id', $poll->poll_id)
                    ->where('answers_questions_polls.period_id', $period_id)
                    ->where(function ($query) use ($request) {
                        is_array(json_decode(decrypt($request->canton))) ? $query->whereIn('answers_questions_polls.canton_id', json_decode(decrypt($request->canton))) : $query->where('answers_questions_polls.canton_id', decrypt($request->canton));
                    })
                    ->groupBy('answers_questions_polls.question_id', 'answers_questions_polls.canton_id', 'answers_questions_polls.poll_id')
                    ->orderBy('questions.id',   'asc')
                    ->orderBy('cantons.name', 'asc')
                    ->orderBy('cantons.id', 'asc')
                    ->get();
            if(count($tabs)>0){
                $tabs_open_options = DB::table('answers_questions_polls')
                ->select('cantons.name as canton','answers_questions_polls.question_id','answers_questions_polls.option_id','answers_questions_polls.item_id', 	'answers_questions_polls.poll_id',  'answers_questions_polls.canton_id', DB::raw('COUNT(*) as total'))
                    ->Join('polls_periods', 'polls_periods.id', '=', 'answers_questions_polls.period_id')
                ->Join('cantons', 'cantons.id', '=', 'answers_questions_polls.canton_id')
                ->where('answers_questions_polls.poll_id', $poll->poll_id)
                ->where('answers_questions_polls.period_id', $period_id)
                ->where(function ($query) use ($request) {
                    is_array(json_decode(decrypt($request->canton))) ? $query->whereIn('answers_questions_polls.canton_id', json_decode(decrypt($request->canton))) : $query->where('answers_questions_polls.canton_id', decrypt($request->canton));
                })
                ->where('answers_questions_polls.type', 'open')
                ->groupBy('answers_questions_polls.question_id', 'answers_questions_polls.option_id', 'answers_questions_polls.item_id', 'answers_questions_polls.canton_id', 'answers_questions_polls.poll_id')
                ->orderBy('cantons.name', 'asc')
                ->orderBy('answers_questions_polls.option_id', 'asc')
                ->orderBy('answers_questions_polls.item_id', 'asc')
                ->get();

                $cantons = [];
                $canton = Canton::find(decrypt($request->canton));
                $sections = [];
                //poll sections all
                $sect =1;
                foreach(Poll::find($poll->poll_id)->section as $section){
                    if($section->poll_id == $survey->id){
                        $section_name = $section->name;
                        $questions = [];

                        //poll sections all questiosn
                        $total_section = 0;
                        $total_section_mayor_o_igual_a_7 = 0;
                        $total_section_menor_a_7 = 0;
                        $total_section_percent = 0;
                        foreach (Section::find($section->id)->question as $question) {
                            if($question->type=="open"){
                                $options = [];
                                //poll sections all questiosn options
                                foreach (Question::find($question->id)->option as $option){
                                    $items = [];
                                    //poll sections all questiosn options items
                                    $j = 1;
                                    foreach(OptionItem::where('option_id', $option->id)->get() as $item){
                                        $total_item = 0;
                                        foreach($tabs_open_options as $tabs_open){
                                            if($tabs_open->poll_id == $section->poll_id && $tabs_open->canton_id == $canton->id && $question->id == $tabs_open->question_id){
                                                if($option->id == $tabs_open->option_id && $item->id == $tabs_open->item_id){
                                                    $total_item +=$tabs_open->total;
                                                    array_push($items, ['id'    => 'Q'.$j++,
                                                                        'name'  => $item->name,
                                                                        'total' => $total_item
                                                    ]);
                                                }
                                            }
                                        }
                                    }
                                    foreach($tabs_open_options as $tabs_open){
                                        if($tabs_open->poll_id == $section->poll_id && $tabs_open->canton_id == $canton->id && $question->id == $tabs_open->question_id){
                                            if($option->id == $tabs_open->option_id){
                                                $id = $option->id;
                                                $name = $option->name;
                                                $question_id = $option->question_id;

                                            }
                                        }
                                    }
                                    array_push($options, ['id'          => $id,
                                                            'name'        => $name,
                                                            'question_id' => $question_id,
                                                            'items'       => $items,
                                    ]);
                                }
                                foreach($tabs_open_options as $tabs_open){
                                    $canton_id = Canton::find($tabs_open->canton_id);
                                    if($tabs_open->poll_id == $section->poll_id && $tabs_open->canton_id == $canton_id->id && $question->id == $tabs_open->question_id){
                                        $id_canton [] =  $tabs_open->canton_id;
                                    }
                                }
                                foreach (array_values(array_unique($id_canton)) as $value) {
                                    if($canton->id == $value){
                                        //poll sections all questiosn open
                                        array_push($questions, [
                                            'id'            => $question->id,
                                            'name'          => $question->name,
                                            'type'          => $question->type,
                                            'options'       => $options,
                                        ]);
                                    }
                                }
                            }else{
                                foreach($tabs as $tab){
                                    //$canton_id = Canton::find($tab->canton_id)->id;
                                    if($tab->poll_id == $section->poll_id && $tab->canton_id == $canton->id && $question->id == $tab->id){
                                        //poll sections all questiosn close
                                        $mayor_o_igual_a_7 = $tab->item_7+$tab->item_8+$tab->item_9+$tab->item_10;
                                        $menor_a_7 = $tab->item_1+$tab->item_2+$tab->item_3+$tab->item_4+$tab->item_5+$tab->item_6;
                                        $percent =(($tab->total*$mayor_o_igual_a_7)/100);
                                        array_push($questions, [
                                            'id'            => $question->id,
                                            'name'          => $question->name,
                                            'type'          => $question->type,
                                            'item_1'        => $tab->item_1,
                                            'item_2'        => $tab->item_2,
                                            'item_3'        => $tab->item_3,
                                            'item_4'        => $tab->item_4,
                                            'item_5'        => $tab->item_5,
                                            'item_6'        => $tab->item_6,
                                            'item_7'        => $tab->item_7,
                                            'item_8'        => $tab->item_8,
                                            'item_9'        => $tab->item_9,
                                            'item_10'       => $tab->item_10,
                                            'total'         => $tab->total,
                                            'mayor_o_igual_a_7' => $mayor_o_igual_a_7,
                                            'menor_a_7'     =>  $menor_a_7,
                                            'percent'       =>  sprintf('%0.2f', $tab->percent)
                                        ]);
                                        $total_section += $tab->total;
                                        $total_section_mayor_o_igual_a_7 += $mayor_o_igual_a_7;
                                        $total_section_menor_a_7 += $menor_a_7;
                                        $total_section_percent += $percent;
                                    }
                                }
                            }
                        }
                    }
                    array_push($sections, [ 'id'   => "SEC".$sect++,
                                            'name' => $section_name,
                                            'questions' => $questions,
                                            'total_sect' => $total_section,
                                            'high_seven_sect' => $total_section_mayor_o_igual_a_7,
                                            'less_seven_sect' => $total_section_menor_a_7,
                                            'percent_sect' => $total_section_percent
                    ]);
                }

                array_push($cantons, ['id' => $canton->id, 'canton' =>  $canton->name, 'code' =>  $canton->code, 'prefix' =>  $canton->code."00".$survey->id, 'period' => $period, 'poll' =>  $survey->name, 'sections' => $sections]);
                //return $cantons;
                if(count($cantons)>0){
                    return View('panel.admin.tabs.tabs-poll-single-questions', ['cantons' => $cantons]);
                    //$pdf = PDF::loadView('panel.admin.tabs.tabs-poll-single', ['cantons' => $cantons]);
                    //return $pdf->stream('poll-'.$canton->code."00".$survey->id.'.pdf');
                }
                abort(404);
            }
            abort(404);
        }
    }

    /**
     * Show the polls
     *
     * @return \Illuminate\Http\Response
     */
    public function allTabPollCantonQuestion($request)
    {
        if($request->has('canton') && $request->has('poll')){
            $period_id = decrypt($request->poll);
            $poll = Period::find($period_id);
            $survey = Poll::find($poll->poll_id);
            $period = $poll->start." - ".$poll->end;

            $tabs = DB::table('answers_questions_polls')
                    ->select('answers_questions_polls.poll_id', 'answers_questions_polls.type', 'questions.id', 'questions.name', 'questions.section_id', 'cantons.id AS canton_id', 'cantons.name AS canton', 'cantons.code',
                            //values questions
                              DB::raw('SUM(IF(answers_questions_polls.value=1  and answers_questions_polls.type="close","1","0")) as item_1'),
                              DB::raw('SUM(IF(answers_questions_polls.value=2  and answers_questions_polls.type="close","1","0")) as item_2'),
                              DB::raw('SUM(IF(answers_questions_polls.value=3  and answers_questions_polls.type="close","1","0")) as item_3'),
                              DB::raw('SUM(IF(answers_questions_polls.value=4  and answers_questions_polls.type="close","1","0")) as item_4'),
                              DB::raw('SUM(IF(answers_questions_polls.value=5  and answers_questions_polls.type="close","1","0")) as item_5'),
                              DB::raw('SUM(IF(answers_questions_polls.value=6  and answers_questions_polls.type="close","1","0")) as item_6'),
                              DB::raw('SUM(IF(answers_questions_polls.value=7  and answers_questions_polls.type="close","1","0")) as item_7'),
                              DB::raw('SUM(IF(answers_questions_polls.value=8  and answers_questions_polls.type="close","1","0")) as item_8'),
                              DB::raw('SUM(IF(answers_questions_polls.value=9  and answers_questions_polls.type="close","1","0")) as item_9'),
                              DB::raw('SUM(IF(answers_questions_polls.value=10 and answers_questions_polls.type="close","1","0")) as item_10'),
                            //totales
                            DB::raw('(
                                        SUM(IF(answers_questions_polls.`value`=1 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=2 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=3 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=4 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=5 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=6 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=7 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=8 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=9 and answers_questions_polls.type="close",1,0))
                                        + SUM(IF(answers_questions_polls.`value`=10 and answers_questions_polls.type="close",1,0))
                                     ) as total'
                            ),
                             //menor o igual 7
                             DB::raw('(
                                SUM(IF(answers_questions_polls.`value`=1 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=2 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=3 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=4 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=5 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=6 and answers_questions_polls.type="close",1,0))
                            ) as menor_a_7'
                            ),
                            //mayor a 7
                            DB::raw('(
                                + SUM(IF(answers_questions_polls.`value`=7 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=8 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=9 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=10 and answers_questions_polls.type="close",1,0))
                            ) as mayor_a_7'
                            ),
                            //percent
                            DB::raw('(((
                                + SUM(IF(answers_questions_polls.`value`=7 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=8 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=9 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=10 and answers_questions_polls.type="close",1,0))
                            )/(
                                SUM(IF(answers_questions_polls.`value`=1 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=2 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=3 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=4 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=5 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=6 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=7 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=8 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=9 and answers_questions_polls.type="close",1,0))
                                + SUM(IF(answers_questions_polls.`value`=10 and answers_questions_polls.type="close",1,0))
                            )*100)
                            ) as percent'
                            )
                    )
                    ->Join('polls_periods', 'polls_periods.id', '=', 'answers_questions_polls.period_id')
                    ->Join('questions', 'questions.id', '=', 'answers_questions_polls.question_id')
                    ->Join('cantons', 'cantons.id', '=', 'answers_questions_polls.canton_id')
                    ->where('answers_questions_polls.poll_id', $poll->poll_id)
                    ->where('answers_questions_polls.period_id', $period_id)
                    ->where(function ($query) use ($request) {
                        is_array(json_decode(decrypt($request->canton))) ? $query->whereIn('answers_questions_polls.canton_id', json_decode(decrypt($request->canton))) : $query->where('answers_questions_polls.canton_id', decrypt($request->canton));
                    })
                    ->groupBy('answers_questions_polls.question_id', 'answers_questions_polls.canton_id', 'answers_questions_polls.poll_id')
                    ->orderBy('questions.id',   'asc')
                    ->orderBy('cantons.name', 'asc')
                    ->orderBy('cantons.id', 'asc')
                    ->get();

                    $tabs_open_options = DB::table('answers_questions_polls')
                    ->select('cantons.name as canton','answers_questions_polls.question_id','answers_questions_polls.option_id','answers_questions_polls.item_id', 	'answers_questions_polls.poll_id',  'answers_questions_polls.canton_id', DB::raw('COUNT(*) as total'))
                     ->Join('polls_periods', 'polls_periods.id', '=', 'answers_questions_polls.period_id')
                    ->Join('cantons', 'cantons.id', '=', 'answers_questions_polls.canton_id')
                    ->where('answers_questions_polls.poll_id', $poll->poll_id)
                    ->where('answers_questions_polls.period_id', $period_id)
                    ->where(function ($query) use ($request) {
                        is_array(json_decode(decrypt($request->canton))) ? $query->whereIn('answers_questions_polls.canton_id', json_decode(decrypt($request->canton))) : $query->where('answers_questions_polls.canton_id', decrypt($request->canton));
                    })
                    ->where('answers_questions_polls.type', 'open')
                    ->groupBy('answers_questions_polls.question_id', 'answers_questions_polls.option_id', 'answers_questions_polls.item_id', 'answers_questions_polls.canton_id', 'answers_questions_polls.poll_id')
                    ->orderBy('cantons.name', 'asc')
                    ->orderBy('answers_questions_polls.option_id', 'asc')
                    ->orderBy('answers_questions_polls.item_id', 'asc')
                    ->get();

                    $cantons = [];
                    $sections = [];
                    $sect =1;
                    foreach(Poll::find($poll->poll_id)->section as $section){
                        $questions = [];
                        foreach (Section::find($section->id)->question as $question) {
                            if($question->type=="open"){
                                $options = [];
                                //poll sections all questiosn options
                                foreach (Question::find($question->id)->option as $option){
                                    $items = [];
                                    //poll sections all questiosn options items
                                    $j = 1;
                                    foreach(OptionItem::where('option_id', $option->id)->get() as $item){
                                        $total_item = 0;
                                        foreach($tabs_open_options as $tabs_open){
                                            if($tabs_open->poll_id == $section->poll_id  && $question->id == $tabs_open->question_id){
                                                if($option->id == $tabs_open->option_id && $item->id == $tabs_open->item_id){
                                                    $total_item +=$tabs_open->total;
                                                }
                                            }
                                        }
                                        array_push($items, ['id'    => 'Q'.$j++,
                                                            'name'  => $item->name,
                                                            'total' => $total_item
                                                    ]);
                                    }
                                    foreach($tabs_open_options as $tabs_open){
                                        if($tabs_open->poll_id == $section->poll_id && $question->id == $tabs_open->question_id){
                                            if($option->id == $tabs_open->option_id){
                                                $id = $option->id;
                                                $name = $option->name;
                                                $question_id = $option->question_id;
                                            }
                                        }
                                    }
                                    array_push($options, ['id'          => $id,
                                                          'name'        => $name,
                                                          'question_id' => $question_id,
                                                          'items'       => $items,
                                    ]);
                                }
                                array_push($questions, [
                                    'id'            => $question->id,
                                    'name'          => $question->name,
                                    'type'          => $question->type,
                                    'options'       => $options,
                                ]);
                            }else{
                                $item_1 = 0;
                                $item_2 = 0;
                                $item_3 = 0;
                                $item_4 = 0;
                                $item_5 = 0;
                                $item_6 = 0;
                                $item_7 = 0;
                                $item_8 = 0;
                                $item_9 = 0;
                                $item_10 = 0;
                                $total = 0;
                                $mayor_o_igual_a_7 = 0;
                                $menor_a_7 = 0;
                                $percent = 0;
                                foreach($tabs as $tab){
                                    if($tab->poll_id == $section->poll_id && $question->id == $tab->id){
                                        $item_1 += $tab->item_1;
                                        $item_2 += $tab->item_2;
                                        $item_3 += $tab->item_3;
                                        $item_4 += $tab->item_4;
                                        $item_5 += $tab->item_5;
                                        $item_6 += $tab->item_6;
                                        $item_7 += $tab->item_7;
                                        $item_8 += $tab->item_8;
                                        $item_9 += $tab->item_9;
                                        $item_10 += $tab->item_10;
                                        $total +=$tab->total;
                                        $mayor_o_igual_a_7 += $tab->mayor_a_7;
                                        $menor_a_7 += $tab->menor_a_7;
                                        $percent += $tab->percent;
                                    }
                                }
                                array_push($questions, [
                                    'id'            => $question->id,
                                    'name'          => $question->name,
                                    'type'          => $question->type,
                                    'item_1'        => $item_1,
                                    'item_2'        => $item_2,
                                    'item_3'        => $item_3,
                                    'item_4'        => $item_4,
                                    'item_5'        => $item_5,
                                    'item_6'        => $item_6,
                                    'item_7'        => $item_7,
                                    'item_8'        => $item_8,
                                    'item_9'        => $item_9,
                                    'item_10'       => $item_10,
                                    'total'         => $total,
                                    'mayor_o_igual_a_7' => $mayor_o_igual_a_7,
                                    'menor_a_7'         => $menor_a_7,
                                    'percent'       => sprintf('%0.2f', (($mayor_o_igual_a_7/$total)*100))
                                ]);
                            }
                        }
                        array_push($sections, ['id'   => "SEC".$sect++,'name' => $section->name, 'questions' => $questions]);
                    }
                    array_push($cantons, ['period' => $period, 'poll' =>  $survey->name, 'sections' => $sections]);
                    //return $cantons;
                    if(count($cantons)>0){
                        return View('panel.admin.tabs.tabs-poll-questions', ['cantons' => $cantons]);
                        //$pdf = PDF::loadView('panel.admin.tabs.tabs-poll', ['cantons' => $cantons]);
                        //return $pdf->stream('polls-cantones-all.pdf');
                    }
                    abort(404);
        }
    }

    /**
     * Show the polls
     *
     * @return \Illuminate\Http\Response
     */
    public function tabHistory(Request $request)
    {
        if(\Request::wantsJson()){
            $clients = [];
            $period = Period::find(decrypt($request->poll));
            $poll = Poll::find($period->poll_id);
            $canton = Canton::findOrFail(decrypt($request->canton));

            $respondents = DB::table('answers_questions_polls')
                                ->select('answers_questions_polls.period_id', 'answers_questions_polls.poll_id', 'answers_questions_polls.customer_id', 'answers_questions_polls.canton_id')
                                ->leftJoin('customers', 'customers.id', '=', 'answers_questions_polls.customer_id')
                                ->where('answers_questions_polls.period_id', decrypt($request->poll))
                                ->where('answers_questions_polls.canton_id', decrypt($request->canton))
                                ->groupBy('answers_questions_polls.period_id', 'answers_questions_polls.canton_id', 'customers.id')
                                ->get();

            $assignments = DB::table('assignment_pollster')
            ->select('assignment_pollster.period_id', 'assignment_pollster.pollster_id', 'assignment_pollster.canton_id', 'assignment_pollster.routes')
            ->join('polls_periods', 'assignment_pollster.period_id', '=', 'polls_periods.id')
            ->where('assignment_pollster.period_id', decrypt($request->poll))->where('assignment_pollster.canton_id', decrypt($request->canton))->get();

           foreach($assignments as $key => $assignment){
               $collections[$key] = Str::of($assignment->routes)->explode(',');
               foreach($collections[$key] as $val){
                   if($assignment->canton_id == decrypt($request->canton)){
                       $routes [] =  array('pollster' => $assignment->pollster_id, 'route' => $val, 'canton' => $assignment->canton_id);
                    }
                }
           }
            $data = [];
            foreach(Canton::find(decrypt($request->canton))->route as $route){
                foreach(Customer::all() as $customer){
                    if($route->id==$customer->route_id){
                        $status = 'no';
                        foreach($respondents as $respondent){
                            if($respondent->customer_id==$customer->id){
                                $status = 'si';
                            }
                        }
                        foreach($routes as $val){
                            $user = User::find($val['pollster']);
                            if($val['canton']==$route->canton_id && $val['route']==$route->id){
                                $pollster =  $user->name." ".$user->last_name;
                                $pollster_id =  $user->id;
                            }
                        }
                        array_push($clients, [
                            'customer_id' => $customer->id,
                            'poll_id'     => $poll->id,
                            'pollster_id' => $pollster_id,
                            'period_id'   => $period->id,
                            'number'      => $customer->number_measurer,
                            'fullname'    => $customer->name." ".$customer->last_name,
                            'address'     => $customer->address,
                            'route'       => $route->name,
                            'respondent'  => $status,
                            'pollster'    => $pollster,
                            'period'      => $period->start."-".$period->end,
                            'canton'      => $canton->name,
                            'poll'        => $poll->name,
                        ]);
                    }
                }
            }
            return View('panel.admin.tabs.tabs-table', ['clients' => $clients ?? 0, 'canton' => $canton]);
        }
        abort(404);
    }

     /**
     * Show the polls
     *
     * @return \Illuminate\Http\Response
     */
    public function test(Request $request)
    {

        $period = Period::find($request->poll);
        $poll = Poll::find($period->poll_id);
        $canton = Canton::findOrFail($request->canton);

        $respondents = DB::table('answers_questions_polls')
                            ->select('answers_questions_polls.period_id', 'answers_questions_polls.poll_id', 'answers_questions_polls.customer_id', 'answers_questions_polls.canton_id')
                            ->leftJoin('customers', 'customers.id', '=', 'answers_questions_polls.customer_id')
                            ->where('answers_questions_polls.period_id', $request->poll)
                            ->where('answers_questions_polls.canton_id', $request->canton)
                            ->groupBy('answers_questions_polls.period_id', 'answers_questions_polls.canton_id', 'customers.id')
                            ->get();

            $assignments = DB::table('assignment_pollster')
            ->select('assignment_pollster.period_id', 'assignment_pollster.pollster_id', 'assignment_pollster.canton_id', 'assignment_pollster.routes')
            ->join('polls_periods', 'assignment_pollster.period_id', '=', 'polls_periods.id')
            ->where('assignment_pollster.period_id', $request->poll)->where('assignment_pollster.canton_id', $request->canton)->get();

           foreach($assignments as $key => $assignment){
               $collections[$key] = Str::of($assignment->routes)->explode(',');
               foreach($collections[$key] as $val){
                   if($assignment->canton_id == $request->canton){
                       $routes [] =  array('pollster' => $assignment->pollster_id, 'route' => $val, 'canton' => $assignment->canton_id);
                    }
                }
           }
            $data = [];
            foreach(Canton::find($request->canton)->route as $route){
                foreach(Customer::all() as $customer){
                    if($route->id==$customer->route_id){
                        $status = 'no';
                        foreach($respondents as $respondent){
                            if($respondent->customer_id==$customer->id){
                                $status = 'si';
                            }
                        }
                        foreach($routes as $val){
                            $user = User::find($val['pollster']);
                            if($val['canton']==$route->canton_id && $val['route']==$route->id){
                                $pollster =  $user->name." ".$user->last_name;
                                $pollster_id =  $user->id;
                            }
                        }
                        array_push($data, [
                            'customer_id' => $customer->id,
                            'poll_id'     => $poll->id,
                            'pollster_id' => $pollster_id,
                            'period_id'   => $period->id,
                            'number'      => $customer->number_measurer,
                            'fullname'    => $customer->name." ".$customer->last_name,
                            'address'     => $customer->address,
                            'route'       => $route->name,
                            'respondent'  => $status,
                            'pollster'    => $pollster,
                            'period'      => $period->start."-".$period->end,
                            'canton'      => $canton->name,
                            'poll'        => $poll->name,
                        ]);
                    }
                }
            }
           return $data;
    }
}
