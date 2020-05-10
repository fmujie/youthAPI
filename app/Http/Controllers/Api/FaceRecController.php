<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Fmujie\BaiduFace\BaiduFaceApi;
use Illuminate\Support\Facades\Storage;

class FaceRecController extends Controller
{
    public function faceRec(Request $request) 
    {
        $userGroup = $request['userGroup'];
        $userId = $request['userId'];
        $image = Storage::get('public/faceImg/3.jpg');
        // $image = base64_encode($image);
        // $image = 'a3e58f1dfe51db52faba030318786c9d';
        // $image = 'https://dss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=2534506313,1688529724&fm=26&gp=0.jpg';
        $res = BaiduFaceApi::searchFaceUid($image, $userGroup, $userId);
        return $res;
    }
}
