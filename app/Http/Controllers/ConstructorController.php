<?php

namespace App\Http\Controllers;

use App\Models\Constructor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Berkayk\OneSignal\OneSignalFacade as OneSignal;
use Illuminate\Support\Facades\Auth;

class ConstructorController extends Controller
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
        $user_office_id = Auth::user()->office;
        $offices = config("env");
        if ($search_word = request("search")) {
            $constructs = Constructor::where("office", "LIKE", "%" . $search_word . "%")->paginate(20);
        } else {
            $constructs = new Constructor;
            $constructs = $constructs->paginate(20);
            if ($user_office_id !== 0) {
                $office_dict = array_flip($this->office_dict);
                $constructs = Constructor::where("office", "like", "%{$office_dict[$user_office_id]}%")->paginate(20);
                return view("construct.index", compact("constructs", "offices"));
            }
        }
        return view("construct.index", compact("constructs", "offices"));
    }

    public function create()
    {
        $offices = config("env");
        return view("construct.create", compact("offices"));
    }

    public function store(Request $request)
    {
        $form_items = $request->all();
        $form_items["real_work"] == "選択してください" ? $form_items["real_work"] = "" : $form_items["real_work"];
        $fields = [];
        $office_name = $this->processing_office_name($form_items);
        if ($office_name != "無し") {
            $fields = $this->create_fields($office_name);
        }

        $route_name = $this->processing_route_name($form_items);
        $data = Constructor::create(["location" => $form_items["location"], "username" => $form_items["username"], "department" => $form_items["department"], "business_name" => $form_items["business_name"], "route" => $route_name, "real_work_time" => $form_items["real_work"], "bus_station"
        => $form_items["bus_station"], "notify_time" => $form_items["notify_time"], "coordinate" => $form_items["coordinate"], "stopped_bus_flag" => $form_items["stopped_bus"] ?? 0, "detour_flag" => $form_items["detour"] ?? 0, "bus_relocation_flag" => $form_items["relocation_bus"] ?? 0, "remarks" => $form_items["remarks"], "flag" => 0, "office" => $office_name ?: "無し", "detail" => $form_items["detail"], "started_at" => $form_items["start"], "ended_at" =>
            $form_items["end"]]);
        if ($fields != []) {
            $this->send_target($fields, $form_items["location"] . "が作成されました。", $data->id);
        }
        return redirect("/construct");
    }

    public function edit($id, Request $request)
    {
        $offices = config("env");
        $construct_data = Constructor::find($id);
        $construct_office_ids = $this->explode_offices($construct_data->office);
        $edit_mode = $request->query("edit_mode");
        return view("construct.edit", compact("construct_data", "edit_mode", "offices", "construct_office_ids"));
    }

    public function update(Request $request)
    {
        $form_items = $request->all();
        $construct_id = $form_items["construct_id"];
        $fields = [];

        $offices = $this->processing_office_name($form_items) === "" ? "無し" : $this->processing_office_name($form_items);
        $exists_office = $this->is_exists_office(array_keys($form_items));

        if ($exists_office) {
            $fields = $this->create_fields($offices);
        }
        if ($fields != []) {
            $this->send_target($fields, $form_items["location"] . "が更新されました。",$construct_id);
        }
        Constructor::where("id", $construct_id)->update(["remarks" => $form_items["remarks"],"location" => $form_items["location"], "notify_time" => $form_items["notify_time"], "coordinate" => $form_items["coordinate"], "stopped_bus_flag" => $form_items["stopped_bus"] ?? 0, "bus_relocation_flag" => $form_items["relocation_bus"] ?? 0, "detour_flag" => $form_items["detour"] ?? 0, "office" => $offices, "real_work_time" => $form_items["real_work"] ?? "", "detail" => $form_items["detail"], "started_at" => $form_items["started_at"], "ended_at" => $form_items["ended_at"]]);
        return redirect("/construct/edit/" . $construct_id);
    }

    public function delete(Request $request)
    {
        $construct_id = $request->input("construct_id");
        Constructor::where("id", $construct_id)->delete();
        return redirect("/construct");
    }

    private function processing_office_name($form_items)
    {
        $office_name = "";
        foreach ($form_items as $form_item) {
            if (strpos($form_item, "営業所")) {
                $office_name .= $form_item . ",";
            }
        }
        return substr($office_name, 0, -1);
    }

    private function processing_route_name($form_items)
    {
        $route_name = "";
        foreach ($form_items as $key => $data) {
            if (strpos($key, "item") !== false) {
                $route_name .= $data . ",";
            }
        }
        return substr($route_name, 0, -1);
    }

    public function remind()
    {
        $construct = Constructor::where("remind_flag", 0)->get();
        $fields = [];
        foreach ($construct as $data) {
            $dt1 = Carbon::now()->addDays((int)$data->notify_time);
            $dt2 = new Carbon($data->started_at);
            if ($dt1->isSameDay($dt2)) {
                Constructor::where("id", $data["id"])->update(["remind_flag" => 1]);
                if ($data["office"] != "無し") {
                    $fields = $this->create_fields($data["office"]);
                }
                if ($fields != []) {
                    $this->send_target($fields, $data["location"] . "が" . $data->notify_time . "日前になりました。",$data->id);
                }
            }
        }

        return "false";
    }

    public function send_all()
    {
        OneSignal::sendNotificationToAll(
            "Some Message",
            $data = null,
            $buttons = null,
            $schedule = null
        );
    }

    public function send_target($fields, $message, $id)
    {
        foreach ($fields as $field) {
            OneSignal::sendNotificationUsingTags($message,
                array(
                    $field,
                ),
                $url = "/public/construct/edit/$id",
                $data = null,
                $buttons = null,
                $schedule = null
            );
        }
    }

    private function explode_offices($offices): array
    {
        if ($offices === "無し") {
            return [];
        }
        $office_ids = [];
        $office_array = explode(",", $offices);
        foreach ($office_array as $office) {
            $office_ids[] = $this->office_dict[$office];
        }
        return $office_ids;
    }

    public function create_fields($offices): array
    {
        $fields = [
            ["field" => "tag", "key" => "officeId", "relation" => "=", "value" => 0]
        ];
        $office_array = explode(",", $offices);
        foreach ($office_array as $office) {
            $fields[] = ["field" => "tag", "key" => "officeId", "relation" => "=", "value" => $this->office_dict[$office]];
        }
        return $fields;
    }

    private function is_exists_office($form_items): bool
    {
        foreach ($form_items as $item) {
            if (strpos($item, "office") !== false) {
                return true;
            }
        }
        return false;
    }
}
