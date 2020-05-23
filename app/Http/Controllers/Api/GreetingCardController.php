<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  

class GreetingCardController extends Controller
{
    /**
     * 由于之前设计错误，所有方法先经过处理判断，
     * 再对应执行。以后后端设计不可参照此文件方法
     * @param Request $Request
     */
    public function Public(Request $request)
    {
        $input = $request->all();
        $op = $input['op']; // 获取操作方法
        $greetingcard=new GreetingCardController();
        
        if (strcmp($op, "add") == 0) { // 毕业贺卡计数+1
            $tag = $input['tag']; // 毕业贺卡标签
            $return = $greetingcard->CountAdd($tag);
            return response($return);
        } else if (strcmp($op, "request") == 0) { // 随机返回一条毕业贺卡文案
            $tag = $input['tag']; // 毕业贺卡标签
            $return = $greetingcard->RandomBack($tag);
            return response($return);
        } else if (strcmp($op, "query") == 0) { // 返回所有贺卡数据
            $return = $greetingcard->ReturnData();
            return response()->json($return);
        } else { // op操作方法错误
            return response("op_error");
        }
    }

    /**
     * 毕业贺卡计数+1
     * @param $tag
     */
    public function CountAdd($tag)
    {
        $arr = [0=>$tag]; // 初始化毕业贺卡标签数组
        $bool = DB::update('UPDATE `greetingcard_num` SET `gcn_num` = `gcn_num`+1 WHERE `greetingcard_num`.`gcn_tag` = ?', $arr); // 更新毕业贺卡计数
        if ($bool) { // 判断执行结果
            return "success";
        } else {
            return "failed";
        }
    }

    /**
     * 随机返回一条毕业贺卡文案
     * @param $tag
     */
    public function RandomBack($tag)
    {
        $wenan = DB::table('greetingcard_wenan')->get(); // 查询毕业贺卡文案表
        $requestWenan = array(); // 初始化tag对应的贺卡文案
        $wenanNum = 0; // 初始化tag对应的贺卡文案数
        for ($i = 0; $i < count($wenan); $i++) { // 查询tag对应的贺卡文案
            if (strcmp($wenan[$i]->gcw_tag, $tag) == 0) {
                $requestWenan[$wenanNum++] = $wenan[$i];
            }
        }
        if ($wenanNum == 0) { // tag错误
            return "failed";
        }
        $seed = time(); // 设置随机种子
        mt_srand($seed);
        $index = rand(0, $wenanNum-1); // 随机返回请求标签的一条文案
        return $requestWenan[$index]->gcw_wenan;
    }

    /**
     * 返回所有贺卡数据
     */
    public function ReturnData()
    {
        $gcNum = DB::table('greetingcard_num')->get(); // 查询毕业贺卡计数表
        return $gcNum;
    }

}