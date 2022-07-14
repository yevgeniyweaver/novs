<?php

namespace App\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: женя
 * Date: 21.08.2020
 * Time: 17:01
 */

use Illuminate\Http\Request;
use DB;
use Validator;
use Illuminate\Http\JsonResponse;
class AjaxController extends Controller
{

    public $msgComplete = 'Ваша заявка успешно отправлена! В ближайшее время с вами свяжутся!';

    public $messages = [
        'name.required' => 'Введите ваше имя.',
        'phone.required'    => 'Введите ваш телефон',
        'phone.max'    => 'Номер должен содержать не более 15 символов',
        'phone.min'    => 'Номер должен содержать не менее 10 символов',
//    'email' => 'The :attribute must be between :min - :max.',
//    'text'      => 'The :attribute must be one of the following types: :values',
    ];

    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'phone.required'  => 'A phone is required',
        ];
    }

    public function test(Request $request) {

        if (!$request->isMethod('post')){
            return json_encode(['error'=>'true']);
        }

        $returnJson['msg'] = $this->msgComplete;
        $returnJson['cleanForm'] = true;
        //header("Access-Control-Allow-Origin: *");
       return response($returnJson)->withHeaders(["Access-Control-Allow-Origin"=>"*"]);
    }

    public function getObjInfo(Request $request): JsonResponse {

        if (!$request->isMethod('post')){
            return json_encode(['error' => 'true']);
        }
        $returnJson = [
            'error' => false,
            'msgid' => '#_form_note_otdelprodaj'
        ];
        $rules = [
            'name' => 'required|max:255',
            'phone' => 'required|min:10|max:17',
        ];

        $validate = Validator::make($request->all(), $rules, $this->messages);

        if ($validate->fails()) {
            $returnJson['error'] = true;
            $returnJson['errorsArray'] = $validate->errors();

            return response()->json($returnJson);
            //return response($validate->errors(),);
            //return new JsonResponse($validate->errors(), 300);
            //return redirect('post/create')->withErrors($validator)->withInput();
        }

        $returnJson['msg'] = $this->msgComplete;
        $returnJson['cleanForm']=true;

        return response()->json($returnJson);
    }
}
