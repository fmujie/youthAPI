<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Fmujie\TulingApi\TulingApi;
use Fmujie\BaiduSpeech\BaiduSpeech;
use App\Http\Controllers\Controller;
use App\Http\Requests\Interact\ConverseRequest;
use App\Http\Requests\Interact\SynthesisRequest;

class ConversationController extends Controller
{
    private $statusCode = 200;
    private $return = [
        'code' => 0,
        'status' => 'error',
        'msg' => null,
        'data' => null
    ];

    private static $optional = [
        'userID' => 'fmujie',
        'lan' => 'zh',
        'speed' => 5,
        'pitch' => 5,
        'volume' => 5,
        'person' => 4
    ];

    public function speechSynthesis(SynthesisRequest $request)
    {
        $text = $request->txtInfo;
        
        $userID = self::$optional['userID'];
        $lan = self::$optional['lan'];
        $speed = self::$optional['speed'];
        $pitch = self::$optional['pitch'];
        $volume = self::$optional['volume'];
        $person = self::$optional['person'];

        $result = BaiduSpeech::combine($text, $userID, $lan, $speed, $pitch, $volume, $person);

        if ($result['code'] == 1) {
            return response()->json([
                'result' => $result
            ], $this->statusCode);
        } else {
            $this->return['msg'] = $result['msg'];
        }

        return response()->json([
            'result' => $this->return
        ], $this->statusCode);
    }

    public function conversation(ConverseRequest $request)
    {
        $userSendInfo = $request->userSendInfo;
        $userID = $request->userID;

        if (is_null($userID)) {
            $userID = self::$optional['userID'];
        }

        $result = TulingApi::txtConversation($request, $userSendInfo, $userID);

        if ($result['code'] == 1) {
            $this->return['code'] = 1;
            $this->return['status'] = 'success';
            $this->return['data'] = $result['data'];
        }

        $this->return['msg'] = $result['msg'];

        return response()->json([
            'result' => $this->return
        ], $this->statusCode);
    }
}
