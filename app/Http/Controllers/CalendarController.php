<?php

namespace App\Http\Controllers;

use App\Models\Constructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public $office_dict;

    public function __construct()
    {
        $this->middleware('auth');
        $this->office_dict = [
            "岐南営業所" => 1,
            "柿ヶ瀬営業所" => 2,
            "岐阜西営業所" => 3,
            "高富営業所" => 4,
            "美濃営業所" => 5,
            "関営業所" => 6,
            "各務原営業所" => 7,
        ];
    }

    public function index()
    {
        $calendar_bool = true;
        $event_data = $this->fix_event_data();
        return view("calendar/index", compact("calendar_bool", "event_data"));
    }

    private function fix_event_data()
    {
        $user_office_id = Auth::user()->office;
        if ($user_office_id !== 0) {
            $office_dict = array_flip($this->office_dict);
            $construct_data = Constructor::where("office", "like", "%{$office_dict[$user_office_id]}%")->get();
        } else {
            $construct_data = Constructor::get();
        }
        $event_data = [];
        foreach ($construct_data as $key => $data) {
            $bus_info = $data->bus_relocation_flag ? "　バス移設:必要" : "" ;
            $bus_info .= $data->stopped_bus_flag ? "　バス休止:必要" : "";
            $bus_info .= $data->detour_flag ? "　迂回運転:必要" : "";
            $event_data[$key]["url"] = "construct/edit/" . $data->id;
            $event_data[$key]["title"] = "工事内容:" . $data->detail . "　工事場所:" . $data->location . $bus_info . "　内:".$data->inworking_start_time ." ～ ".$data->inworking_end_time;
            $event_data[$key]["start"] = $data->started_at;
            $event_data[$key]["end"] = $data->ended_at;
        }
        return json_encode($event_data, JSON_UNESCAPED_UNICODE);
    }
}
