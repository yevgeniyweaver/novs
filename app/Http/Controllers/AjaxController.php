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
use Crumbs;
use Illuminate\Support\Facades\Redis;
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



    public function test(Request $request){
//        if (!$request->isMethod('post')){
//            return json_encode(['error'=>'true']);
//        }
        //header("Access-Control-Allow-Origin: *");
        $returnJson['msg'] = $this->msgComplete;
        $returnJson['cleanForm']=true;
        //return response()->json($returnJson);
       return response($returnJson)->withHeaders(["Access-Control-Allow-Origin"=>"*"]);
    }





    public function getObjInfo(Request $request){//show __invoke $id<?php
        if (!$request->isMethod('post')){
            return json_encode(['error'=>'true']);
        }
        $returnJson = [
            'error' => false,
            'msgid' => '#_form_note_otdelprodaj'
        ];
        $rules = [
            'name' => 'required|max:255',
            'phone' => 'required|min:10|max:17',
        ];
        $validate = Validator::make($request->all(),$rules,$this->messages);
//        $msg =[
//            'name' => 'required|unique:posts|max:255',
//            'phone' => 'required|min:10|max:13',
//        ];
//        if ($this->ajax() || $this->wantsJson())
//        {
//            return new JsonResponse($errors, 422);
//        }
//        if (!$model->isValidRow($data, $validate)) {
//            $returnJson['error'] = true;$returnJson['errorsArray'] = $model->getErrorsD($dictionary);$this->putJSON($returnJson);
//        }
        if ($validate->fails()) {
            $returnJson['error'] = true;
            $returnJson['errorsArray'] = $validate->errors();
            //return response($validate->errors(),); //return new JsonResponse($validate->errors(), 300);
            return response()->json($returnJson);
//            return redirect('post/create')
//                ->withErrors($validator)
//                ->withInput();
        }
        $returnJson['msg'] = $this->msgComplete;
        $returnJson['cleanForm']=true;

//        $this->validate($request, [
//            'name' => 'required|unique:posts|max:255',
//            'phone' => 'required|min:10',
//        ]);


        return response()->json($returnJson);
        //echo json_encode(['error'=>'false']);
//        User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => bcrypt($request->password),
//        ]);
//        // session()->flash('success_message', 'User successfully created!');
        //return response()->json(['error' => false,'msg'=>'Form Completed']);
        // return back()->with('success_message', 'User successfully created!');

        //Последняя работающая конфигурация
        //        Mail::send(['text'=>'mail'],['name'=>'laratest'],function($message){
//            $subject = 'Laratest test mail';
//            $message->from('laratest@example.com', 'Laratest');
//            $message->to('risetobase@gmail.com','web dev')->subject($subject)->attach('img/phone_1.png');
//            //$message->to('risetobase@ukr.net','web dev')->subject($subject)->attach('img/phone_1.png');
//            //$message->to('risetobase@gmail.com')->cc('bar@example.com');
//        });
    }
}
