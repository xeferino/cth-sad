<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormQuestionAddRequest;
use App\Http\Requests\FormQuestionRequest;
use App\Question;
use App\Option;
use App\OptionItem;
class QuestionController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormQuestionAddRequest $request)
    {
        if($request->type=="close"){
            $question =  new Question();
            $question->name            =  $request->name;
            $question->type            =  $request->type;
            $question->description     =  $request->description;
            $question->section_id      =  $request->section_id;
            $saved = $question->save();
            if($saved)
                return response()->json(['success' => true, 'message' => 'Pregunta registrada exitosamente.'], 200);
        }else{
            if(!empty($request->name_options) ){
                $question =  new Question();
                $question->name            =  $request->name;
                $question->description     =  $request->description;
                $question->type            =  $request->type;
                $question->section_id      =  $request->section_id;
                $saved = $question->save();
                foreach ($request->name_options as $value) {
                    $option = new Option();
                    $option->name = $value;
                    $option->question_id = $question->id;
                    $option->save();
                }
                if($saved)
                    return response()->json(['success' => true, 'message' => 'Pregunta registrada exitosamente.'], 200);
            }else{
                return response()->json(['success' => false], 200);
            }
        }
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
            $question = Question::findOrFail($id);
            return response()->json(['success' => true, 'question' => $question], 200);
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getShowQuestionOption($id)
    {
       if(\Request::wantsJson()){
            $option = Option::findOrFail($id);
            return response()->json(['success' => true, 'option' => $option], 200);
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getShowQuestionOptionItem($id)
    {
       if(\Request::wantsJson()){
            $optionItem = OptionItem::findOrFail($id);
            return response()->json(['success' => true, 'item' => $optionItem], 200);
        }
        abort(404);
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateQuestion(FormQuestionRequest $request)
    {
        if(isset($request->question_id) && ($request->question_id)){
            $question       = Question::findOrFail($request->question_id);
            $question->name = $request->name;
            $question->description  =  $request->description;
            $saved = $question->save();
            if($saved)
                return response()->json(['success' => true, 'message' => 'Pregunta actualizada exitosamente.'], 200);
            return response()->json(['error' => true, 'message' => 'la Pregunta no se actualizo correctamente. Intente mas tarde.'], 403);
        }

        if($request->option_id){
            $option       = Option::findOrFail($request->option_id);
            $option->name = $request->name;
            $saved = $option->save();
            if($saved)
                return response()->json(['success' => true, 'message' => 'Pregunta actualizada exitosamente.'], 200);
            return response()->json(['error' => true, 'message' => 'la Pregunta no se actualizo correctamente. Intente mas tarde.'], 403);
        }

        if($request->item_id){
            $item       = OptionItem::findOrFail($request->item_id);
            $item->name = $request->name;
            $saved = $item->save();
            if($saved)
                return response()->json(['success' => true, 'message' => 'Pregunta actualizada exitosamente.'], 200);
            return response()->json(['error' => true, 'message' => 'la Pregunta no se actualizo correctamente. Intente mas tarde.'], 403);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeQuestionOption(FormQuestionRequest $request){
        if(isset($request->question_id) && $request->question_id){
            $option       = new Option();
            $option->name = $request->name;
            $option->question_id = $request->question_id;
            $saved = $option->save();
            if($saved)
                return response()->json(['success' => true, 'message' => 'Pregunta registrada exitosamente.'], 200);
            return response()->json(['error' => true, 'message' => 'la Pregunta no se registro correctamente. Intente mas tarde.'], 403);
        }

        if(isset($request->option_id) && $request->option_id){
            $item       = new OptionItem();
            $item->name = $request->name;
            $item->option_id = $request->option_id;
            $saved = $item->save();
            if($saved)
                return response()->json(['success' => true, 'message' => 'Pregunta registrada exitosamente.'], 200);
            return response()->json(['error' => true, 'message' => 'la Pregunta no se registro correctamente. Intente mas tarde.'], 403);
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteQuestion(Request $request){
        if($request->question_id){
            $question   = Question::findOrFail($request->question_id);
            $delete = $question->delete();
            if($delete)
                return response()->json(['success' => true, 'message' => 'Pregunta eliminada exitosamente.'], 200);
            return response()->json(['error' => true, 'message' => 'la Pregunta no se elimino correctamente. Intente mas tarde.'], 403);
        }

        if($request->option_id){
            $option   = Option::findOrFail($request->option_id);
            $delete = $option->delete();
            if($delete)
                return response()->json(['success' => true, 'message' => 'Pregunta eliminada exitosamente.'], 200);
            return response()->json(['error' => true, 'message' => 'la Pregunta no se elimino correctamente. Intente mas tarde.'], 403);
        }


        if($request->item_id){
            $item   = OptionItem::findOrFail($request->item_id);
            $delete = $item->delete();
            if($delete)
                return response()->json(['success' => true, 'message' => 'Pregunta eliminada exitosamente.'], 200);
            return response()->json(['error' => true, 'message' => 'la Pregunta no se elimino correctamente. Intente mas tarde.'], 403);
        }
    }
}
