<?php

namespace App\Http\Controllers;

use App\Models\Constructor;
use Illuminate\Http\Request;

class ConstructorController extends Controller
{
    public function index()
    {
        $constructs = Constructor::get();
        return view("construct.index", compact("constructs"));
    }

    public function create()
    {
        $offices = [
            "岐南営業所",
            "柿ヶ瀬営業所",
            "岐阜西営業所",
            "高富営業所",
            "美濃営業所",
            "関営業所",
            "各務原営業所",
        ];
        return view("construct.create", compact("offices"));
    }

    public function store(Request $request)
    {
        $form_items = $request->all();
        $office_name = $this->processing_office_name($form_items);
        Constructor::create(["location" => $form_items["location"], "hashtag" => $form_items["hashtag"], "office" => $office_name, "detail" => $form_items["detail"], "started_at" => $form_items["start"], "ended_at" => $form_items["end"]]);
        return redirect("/construct");
    }

    public function edit($id, Request $request)
    {
        $construct_data = Constructor::find($id);
        $edit_mode = $request->query("edit_mode");
        return view("construct.edit", compact("construct_data", "edit_mode"));
    }

    public function update(Request $request)
    {
        $form_items = $request->all();
        $construct_id = $form_items["construct_id"];
        Constructor::where("id", $construct_id)->update(["location" => $form_items["location"], "office" => $form_items["office"], "detail" => $form_items["detail"], "started_at" => $form_items["started_at"], "ended_at" => $form_items["ended_at"]]);
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

}
