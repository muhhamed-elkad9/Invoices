<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{

    public function index()
    {
        $sections = sections::select('id', 'section_name', 'description', 'Created_by')->get();

        return view("sections.sections", compact('sections'));
    }

    public function show()
    {
        return view('sections.create');
    }


    public function create(Request $request)
    {

        $rules = $this->getRules();
        $message = $this->getMessages();

        $validate = Validator($request->all(), $rules, $message);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInputs($request->all());
        }

        sections::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'Created_by' => (Auth::user()->name),
        ]);


        return redirect()->route('sections.index')->with(['add' => __('sections/sections.Add_Sec')]);
    }


    protected function getRules()
    {
        return $rules = [
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required|max:255',
        ];
    }

    protected function getMessages()
    {
        return $messages = [
            'section_name.required' => "يرجي ادخال اسم القسم",
            'section_name.unique' => "اسم القسم موجود مسبقا",
            'section_name.max:255' => "يجب ان لا يكون اسم القسم اكثر من 255 حرف",
            'description.required' => "يرجي ادخال الملاحظات",
            'description.max:255' => "يجب ان لا يكون الملاحظات اكثر من 255 حرف",
        ];
    }


    public function store(Request $request)
    {
        //
    }




    public function edit($id)
    {
        $sections = sections::find($id);  // search in given table id only
        if (!$sections)
            return redirect()->back();

        $sections = sections::select('id', 'section_name', 'description')->find($id);

        return view('sections.update', compact('sections'));
    }

    public function update(Request $request, $id)
    {

        $rules = $this->getRules();
        $message = $this->getMessages();

        $validate = Validator($request->all(), $rules, $message);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInputs($request->all());
        }


        $sections = sections::find($id);
        if (!$sections)
            return redirect()->back();

        //update data

        $sections->update($request->all());

        return redirect()->route('sections.index')->with(['edit' => __('sections/sections.edit_Sec')]);
    }


    public function delete($id)
    {
        $sections = sections::find($id);

        if (!$sections) {
            return redirect()->back()->with(['Err' => __('sections/sections.Err_Sec')]);
        } else {
            $sections->delete();

            return redirect()->back()->with(['deleted' => __('sections/sections.deleted_Sec')]);
        }
    }
}
