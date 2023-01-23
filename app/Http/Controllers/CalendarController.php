<?php

namespace App\Http\Controllers;

use App\Models\Constructor;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $calendar_bool = true;
        $event_data = $this->fix_event_data();
        return view("calendar/index", compact("calendar_bool", "event_data"));
    }

    private function fix_event_data()
    {
        $construct_data = Constructor::get();
        $event_data = [];
        foreach ($construct_data as $key => $data) {
            $event_data[$key]["url"] = "construct/edit/".$data->id;
            $event_data[$key]["title"] = "工事内容:".$data->detail."　工事場所:".$data->location;
            $event_data[$key]["start"] = $data->started_at;
            $event_data[$key]["end"] = $data->ended_at;
        }
        return json_encode($event_data, JSON_UNESCAPED_UNICODE);
    }
}
