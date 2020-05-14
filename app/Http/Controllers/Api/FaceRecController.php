<?php

namespace App\Http\Controllers\Api;

use App\Models\FaceRec;
use App\Models\OaYouthUser;
use Illuminate\Http\Request;
use Fmujie\BaiduFace\BaiduFaceApi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Face\FaceRecRequest;
use App\Http\Requests\Face\FaceRegRequest;
use App\Http\Requests\Face\FaceDelRequest;

class FaceRecController extends Controller
{
    private $group = 'youthol';
    private $statusCode = 200;

    private $return = [
            'code' => 0,
            'status' => 'error',
            'msg' => null
        ];

    /**
     * 人脸认证
     *
     * @param $user_id 用户学号
     * @param $base64_content string 经过base_64编码后的图片字符串
     * @return response
     */
    public function faceRec(FaceRecRequest $request) 
    {
        $userId = $request->user_id;
        $base64Content = $request->base64_content;

        $faceRecModel = new FaceRec();
        $currentUser = FaceRec::where('user_id', $userId)->first();
        if (is_null($currentUser)) {
            $this->return['msg'] = '没有找到该用户的入库数据';
            $this->statusCode = 404;
        } else {
            $recRes = BaiduFaceApi::searchFaceUid($base64Content, $this->group, $userId, 'BASE64', true);
            if ($recRes['code'] == 1)
            {
                if ($recRes['score'] > 90) {
                    $this->return['code'] = 1;
                    $this->return['status'] = 'success';
                    $this->return['msg'] = '认证成功';
                } else {
                    $this->return['msg'] = '认证失败';
                }
                return response()->json([
                    'result' => $this->return
                ]);
            } else {
                $this->return['msg'] = $recRes['msg'];
            }
        }
        return response()->json([
            'result' => $this->return
        ], $this->statusCode);
    }

    /**
     * 人脸注册
     *
     * @param $user_id 用户学号
     * @param $user_name 用户姓名
     * @param $base64_content string 经过base_64编码后的图片字符串
     * @return response
     */
    public function faceReg(FaceRegRequest $request)
    {
        $base64Content = $request->base64_content;
        $userId = $request->user_id;

        $youthStationClerk = OaYouthUser::where('sdut_id', $userId)->first();
        if (is_null($youthStationClerk)) {
            $this->return['msg'] = '该用户非正式成员,暂无权限录入信息';
        } else {
            $faceRecModel = new FaceRec();
            $currentUser = $faceRecModel->where('user_id', $userId)->first();

            if (is_null($currentUser))
            {
                $regRes = BaiduFaceApi::faceRegistration($base64Content, $this->group, $userId, 'BASE64', true);
                if ($regRes['code'] == 1) {
                    $faceRecModel->user_id = $userId;
                    $faceRecModel->user_name = $youthStationClerk->name;
                    $faceRecModel->face_token = $regRes['face_token'];
                    $insertRes = $faceRecModel->save();
                    if ($insertRes) {
                        $this->return['code'] = 1;
                        $this->return['status'] = 'success';
                        $this->return['msg'] = '人脸数据录入成功';
                        $this->statusCode = 201;
                    } else {
                        $this->return['msg'] = '用户信息入库失败';
                    }
                } else {
                    $this->return['msg'] = $regRes['msg'];
                }
            } else {
                $this->return['msg'] = '该用户数据已存在';
            }
        }
        
        return response()->json([
            'result' => $this->return
        ], $this->statusCode);
    }

    /**
     * 人脸数据删除
     *
     * @param $user_id 用户学号
     * @return response
     */
    public function faceDel(FaceDelRequest $request)
    {
        $userId = $request->user_id;

        $faceRecModel = new FaceRec();
        $currentUser = $faceRecModel->where('user_id', $userId)->first();

        if(is_null($currentUser)) {
            $this->return['msg'] = '数据库中没有该用户信息';
            $this->statusCode = 404;
        } else {
            $faceToken = $currentUser->face_token;
            $delRes = BaiduFaceApi::faceDelete($userId, $this->group, $faceToken);
            if ($delRes['code'] == 1) {
                $mDelres = $currentUser->delete();
                if ($mDelres) {
                    $this->return['code'] = 1;
                    $this->return['status'] = 'success';
                    $this->return['msg'] = '人脸库数据删除成功';
                    $this->statusCode = 204;
                } else {
                    $this->return['msg'] = '入库数据未清空,请联系管理员手动删除,用户id:'."$userId";
                }
            } else {
                $this->return['msg'] = $delRes['msg'];
            }
        }

        return response()->json([
            'result' => $this->return
        ], $this->statusCode);
    }

    /**
     * 注册列表获取
     * @return response
     */
    public function getUserList()
    {
        $returned = [
            'result' => $this->return,
            'data' => null
        ];

        $faceRecModel = new FaceRec();
        $userData = $faceRecModel->orderBy('created_at','DESC')->get();
        $dataNum = count($userData);

        if ($dataNum == 0) {
            $this->return['msg'] = '暂无任何数据';
        } else {
            $returnListData = [];
            foreach ($userData as $key => $value) {
                array_push($returnListData, [
                    'username' => $value->oayouthuser->name, 
                    'department' => $value->oayouthuser->department, 
                    'grade' => $value->oayouthuser->grade,
                ]);
            }
            
            $this->return['code'] = 1;
            $this->return['status'] = 'success';
            $this->return['msg'] = '获取用户列表成功';
            $returned['data'] = $returnListData;
        }
        $returned['result'] = $this->return;
        
        return response()->json($returned, $this->statusCode);
    }
}
