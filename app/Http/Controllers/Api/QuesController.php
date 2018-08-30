<?php

namespace App\Http\Controllers\Api;

use App\Models\QuesAdmin;
use App\Models\QuesCategory;
use App\Models\QuesInvestOption;
use App\Models\QuesInvestQuestion;
use App\Models\QuesLoginOption;
use App\Models\QuesLoginQuestion;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class QuesController extends Controller
{
    public function register(Request $request){
        $this->validate($request,[
            'username'=>'required|unique:ques_admins',
            'password'=>'required'
        ]);
        $username = $request->username;
        $password = bcrypt($request->password);
        QuesAdmin::create([
            'username'=>$username,
            'password'=>$password,
            'admin'=>0,
        ]);
        return '';
        return $this->response->noContent()->setStatusCode(201);
    }
    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;
        if ($user = QuesAdmin::where('username',$username)->first())
        {
            //账号密码匹配
            if (Hash::check($password,$user->password))
            {
                    $token = Auth::guard('ques')->fromUser($user);
                    return $this->respondWithToken($token)->setStatusCode(200);
            }else {
                //账号密码不匹配
                return $this->response->errorUnauthorized('密码错误');
            }
        }else{
            //未找到该用户
            return $this->response->errorUnauthorized('未找到该用户');
        }
    }
    //
    public function quesStore(Request $request){
        $this->validate($request,[
           'category'=>'array',
           'category.title'=>'required',
            'category.user_required'=>[
                Rule::in(['false', 'true']),
            ],
            'start_at'=>'required|date|before:end_at',
            'end_at'=>'required|date|after:start_at',
            'questions'=>'array',
            'questions.*.key'=>'required|unique:ques_invest_questions,key',
            'questions.*.input_num'=>'required|numeric',
            'questions.*.input_title'=>'required|string',
            'questions.*.input_type'=>[
                Rule::in([1,2,3]),
            ],
            'questions.*.is_required'=>[
                Rule::in([0,1]),
            ]
        ]);
//        $user = Auth::guard('ques')->user;
        $category = $request->category;

//        $category['author'] = $user->id;
        $questions = $request->questions;
        $options = $request->options;
        $validate_fields = $request->validate_field;
        if($category['user_required']=='false'){
            $category['user_required']=0;
        }else{
            $category['user_required']=1;
        }
        $cat = QuesCategory::create($category);
        if($questions){
            foreach ($questions as $question){
                if($question['is_required']=='false'){
                    $question['is_required'] = 0;
                }else{
                    $question['is_required'] = 1;
                }
                QuesInvestQuestion::create([
                    'key'=>$question['key'],
                    'catid'=>$cat->id,
                    'input_num'=>$question['input_num'],
                    'input_title'=>$question['input_title'],
                    'input_type'=>$question['input_type'],
                    'is_required'=>$question['is_required']
                ]);
            }
            foreach ($options as $option){
                QuesInvestOption::create($option);
            }
        }
        if($cat->user_required){
            foreach ($validate_fields as $validate_field){
                QuesLoginQuestion::create([
                    'key'=>$validate_field['key'],
                    'input_num' => $validate_field['input_num'],
                    'input_title'=> $validate_field['input_title'],
                    'input_type' => $validate_field['input_type'],
                    'catid'=>$cat->id,
                ]);
                if($validate_field['input_type']){
                    foreach ($validate_field['input_options'] as $option){
                        QuesLoginOption::created(array_add($option,'qkey',$validate_field['key']));
                    }
                }
            }
        }
        return $this->response->noContent()->setStatusCode(201);
    }
    public function quesGet(){
        $user = Auth::guard('ques')->user();
        if($user->admin==1){
            $categories = QuesCategory::all();
        }else{
            $categories = QuesCategory::where('author',$user->id)->get();
        }
        foreach ($categories as $category){
            $category->user;
        }
        return $this->response->array(['data'=>$categories->toArray()])->setStatusCode(200);
    }
    public function quesDetail(Request $request,QuesCategory $category){
        $category->invest_questions;
        $category->login_questions;
        foreach ($category->invest_questions as $question){
            $question->options;
        }
        foreach ($category->login_questions as $login_question){
            $login_question->input_options;
        }
        return $this->response->array(['data'=>$category])->setStatus(200);
    }
    protected function respondWithToken($token)
    {
        return $this->response->array(['data'=>[
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('preordain')->factory()->getTTL() * 60
        ],'errCode'=>200]);
    }
}
