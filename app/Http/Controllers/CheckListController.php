<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = [];
        $office_user_id = Auth::user()->office;
        $checklist = Checklist::where("office", $office_user_id)->get();
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

        Checklist::create(["title" => $request->input("title"), "item" => $item, "office" => Auth::user()->office]);
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
        foreach ($request->all() as $key => $data) {
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

    public function pdf($checklist_id)
    {
        $checklist = Checklist::where("id", $checklist_id)->first();
        $title = $checklist->title;
        $items = collect(explode(",", $checklist->item));
        $pdf = PDF::loadView("checklist.pdf", compact("items", "title"));
        return $pdf->stream();
    }
}
