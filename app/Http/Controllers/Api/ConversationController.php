<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Fmujie\TulingApi\TulingApi;
use Fmujie\BaiduSpeech\BaiduSpeech;
use App\Http\Controllers\Controller;

class ConversationController extends Controller
{

    private static $optional = [
        'userID' => 'fmujie',
        'lan' => 'zh',
        'speed' => 5,
        'pitch' => 5,
        'volume' => 5,
        'person' => 4
    ];

    public function speechSynthesis()
    {
        $text = "我爱你";
        $userID = self::$optional['userID'];
        $lan = self::$optional['lan'];
        $speed = self::$optional['speed'];
        $pitch = self::$optional['pitch'];
        $volume = self::$optional['volume'];
        $person = self::$optional['person'];
        $data = BaiduSpeech::combine($text, $userID, $lan, $speed, $pitch, $volume, $person);
        return $data;
    }

    public function conversation(Request $request)
    {
        $text = '我爱你';
        $result = TulingApi::txtConversation($request, $text);
        return $result;
    }
}
