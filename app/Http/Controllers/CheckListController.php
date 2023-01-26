<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;

class CheckListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = [];
        $checklist = Checklist::get();
        foreach ($checklist as $raw_data) {
            $items[] = explode(",", $raw_data->item);
        }
        return view("checklist/index", compact("checklist", "items"));
    }

    public function create()
    {
        return view("checklist/create");
    }

    public function store(Request $request)
    {
        $item = "";
        foreach ($request->all() as $key => $data) {
            if (strpos($key, "item") !== false) {
                $item .= $data . ",";
            }
        }
        $item = substr($item, 0, -1);

        Checklist::create(["title" => $request->input("title"), "item" => $item]);
        return redirect("/checklist");
    }

    public function edit($id)
    {
        $checklist = CheckList::find($id);
        $items = explode(",", $checklist->item);
        return view("checklist/edit", compact("checklist", "items"));
    }

    public function update(Request $request)
    {
        $item = "";
        $id = $request->input("id");
        $req_data = $request->all();
        foreach ($req_data as $key => $data) {
            if (strpos($key, "item") !== false) {
                $item .= $data . ",";
            }
        }
        $item = substr($item, 0, -1);
        Checklist::where("id", $id)->update(["title" => $request->input("title"), "item" => $item]);
        return redirect("/checklist");
    }

    public function delete(Request $request)
    {
        $id = $request->input("id");
        Checklist::where("id", $id)->delete();
        return redirect("/checklist");
    }
}
