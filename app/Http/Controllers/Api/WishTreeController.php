<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WishTree;
use App\Http\Requests\Wish\WishTreeRequest;

class WishTreeController extends Controller
{
    private $statusCode = 200;

    private $return = [
            'code' => 0,
            'status' => 'error',
            'msg' => null
        ];

    public function addData(WishTreeRequest $request)
    {
        $userDemand = $request->user_demand;

        $wishModel = new WishTree();
        $wishModel->user_demand = $userDemand;

        $userName = is_null($request->user_name) ? '匿名' : $request->user_name;
        $conMethod = is_null($request->con_method) ? '' : $request->con_method;
        $conDetail = is_null($request->con_detail) ? '' : $request->con_detail;
        $wish = is_null($request->wish) ? '' : $request->wish;
        $regret = is_null($request->regret) ? '' : $request->regret;

        if (empty($wish) && empty($regret)) {
            $this->return['msg'] = 'Wish and regret cannot be empty at the same time';
        } else {
            $wishModel->user_name = $userName;
            $wishModel->con_method = $conMethod;
            $wishModel->con_detail = $conDetail;
            switch ($userDemand) {
                case 0:
                    if (empty($wish)) {
                        $this->return['msg'] = 'Wish field is empty';
                    } else {
                        $wishModel->wish = $wish;
                    }
                    break;
                case 1:
                    if (empty($regret)) {
                        $this->return['msg'] = 'Regret field is empty';
                    } else {
                        $wishModel->regret = $regret;
                    }
                    break;
                case 2:
                    if (empty($wish) || empty($regret)) {
                        $this->return['msg'] = 'Wish field or regret field is missing';
                    } else {
                        $wishModel->wish = $wish;
                        $wishModel->regret =$regret;
                    }
                    break;
                default:
                    $this->return['msg'] = '需求参数不正确';
            }
            
            if ($this->return['msg'] == null) {
                $insertRes = $wishModel->save();
                if ($insertRes) {
                    $this->return['code'] = 1;
                    $this->return['status'] = 'success';
                    $this->return['msg'] = '数据存库成功';
                    $this->statusCode = 201;
                } else {
                    $this->return['msg'] = '数据存库失败';
                }    
            }
        }

        return response()->json([
            'result' => $this->return
        ], $this->statusCode);
    }

    public function getData($requirement = 2)
    {
        $wishDataList = [];
        $regretDataList = [];
        
        $wishModel = new WishTree();
        $bothData = $wishModel->where('user_demand', 2)->orderBy('created_at', 'DESC')->get();

        if ($requirement != 0 && $requirement != 1 && $requirement != 2) {
            $this->return['msg'] = '参数错误';
        } else {
            $this->return['code'] = 1;
            $this->return['status'] = 'success';
            if ($requirement == 2) {
                $wishData = $wishModel->where('user_demand', 0)->orderBy('created_at', 'DESC')->get();
                $regretData = $wishModel->where('user_demand', 1)->orderBy('created_at', 'DESC')->get();
    
                $wishDataList = self::syntheticArr($wishData, 'wish');
                $regretDataList = self::syntheticArr($regretData, 'regret');
                $newListData = self::separateArr($bothData, $wishDataList, $regretDataList);
                $wishDataList = $newListData[0];
                $regretDataList = $newListData[1];
            } elseif ($requirement == 1) {
                $regretData = $wishModel->where('user_demand', 1)->orderBy('created_at', 'DESC')->get();
                $regretDataList = self::syntheticArr($regretData, 'regret');
                $res = self::separateArr($bothData, null, $regretDataList);
                $regretDataList = $res[1];
            } else {
                $wishData = $wishModel->where('user_demand', 0)->orderBy('created_at', 'DESC')->get();
                $wishDataList = self::syntheticArr($wishData, 'wish');
                $res = self::separateArr($bothData, $wishDataList, null);
                $wishDataList = $res[0];
            }
            $wishCount = count($wishDataList);
            $regretCount = count($regretDataList);
        }
        
        if ($wishCount == 0 && $regretCount == 0) {
            $this->return['msg'] = '暂无任何数据';
        } else {
            $this->return['msg'] = '数据获取成功';
        }

        return response()->json([
            'result' => $this->return,
            'data' => [
                'wish' => [
                    'wishList' => $wishDataList,
                    'wishCount' => $wishCount
                ],
                'regret' => [
                    'regretList' => $regretDataList,
                    'regretCount' => $regretCount
                ]
            ]
        ], $this->statusCode);
    }

    public function shaker($shaknum = null)
    {
        $wishModel = new WishTree();
        if (is_null($shaknum)) {
            $allDataSum = $wishModel->all()->count();
            $shaknum = $allDataSum / 20 > 1 ? $shaknum : 1;
        }
        
        $shakeData =  $wishModel->inRandomOrder()->take($shaknum)->get();
        $returnList = [];
        foreach ($shakeData as $key => $value) {
            array_push($returnList, [
                    'id' => $value->id,
                    'userName' => $value->user_name, 
                    'conMethod' => $value->con_method, 
                    'conDetail' => $value->con_detail,
                    'wishData' => $value->wish,
                    'regretData' => $value->regret
                ]);
        }

        return response()->json([
            'result' => $this->return,
            'data' => $returnList
        ], $this->statusCode);

    }

    private static function separateArr($data, $wishDataList = null, $regretDataList = null)
    {
        if (is_null($wishDataList) && is_null($regretDataList)) {
            return false;
        }
        foreach ($data as $key => $value) {
            if (is_null($wishDataList)) {
                array_push($regretDataList, [
                    'id' => $value->id,
                    'userName' => $value->user_name, 
                    'conMethod' => $value->con_method, 
                    'conDetail' => $value->con_detail,
                    'regretData' => $value->regret,
                ]);
            } elseif (is_null($regretDataList)) {
                array_push($wishDataList, [
                    'id' => $value->id,
                    'userName' => $value->user_name, 
                    'conMethod' => $value->con_method, 
                    'conDetail' => $value->con_detail,
                    'wishData' => $value->wish,
                ]);
            } else {
                array_push($wishDataList, [
                    'id' => $value->id,
                    'userName' => $value->user_name, 
                    'conMethod' => $value->con_method, 
                    'conDetail' => $value->con_detail,
                    'wishData' => $value->wish,
                ]);
                array_push($regretDataList, [
                    'id' => $value->id,
                    'userName' => $value->user_name, 
                    'conMethod' => $value->con_method, 
                    'conDetail' => $value->con_detail,
                    'regretData' => $value->regret,
                ]);
            }
        }
        return [$wishDataList, $regretDataList];
    }


    private static function syntheticArr($data, $dataName)
    {
        $dataArr = [];
        foreach ($data as $key => $value) {
            array_push($dataArr, [
                'id' => $value->id,
                'userName' => $value->user_name, 
                'conMethod' => $value->con_method, 
                'conDetail' => $value->con_detail,
                $dataName.'Data' => $value->$dataName,
            ]);
        }
        return $dataArr;
    }

}
