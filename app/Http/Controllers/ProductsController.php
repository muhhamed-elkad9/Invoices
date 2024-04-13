<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = products::all();
        $sections = sections::all();
        return view('products.products', compact('products', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules = $this->getRules();
        $message = $this->getMessages();

        $validate = Validator($request->all(), $rules, $message);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInputs($request->all());
        }

        products::create([
            'Product_name' => $request->Product_name,
            'description' => $request->description,
            'section_id' => $request->section_id,
        ]);


        return redirect()->route('products.index')->with(['add' => __('products/products.Add_pro')]);
    }



    protected function getRules()
    {
        return $rules = [
            'Product_name' => 'required|unique:products|max:255',
            'description' => 'required|max:255',
            'section_id' => 'required|max:255',
        ];
    }

    protected function getMessages()
    {
        return $messages = [
            'Product_name.required' => "يرجي ادخال اسم المنتج",
            'Product_name.unique' => "اسم المنتج موجود مسبقا",
            'Product_name.max:255' => "يجب ان لا يكون اسم المنتج اكثر من 255 حرف",
            'description.required' => "يرجي ادخال الملاحظات",
            'description.max:255' => "يجب ان لا يكون الملاحظات اكثر من 255 حرف",
            'section_id.required' => "يرجي ادخال اسم القسم",
            'section_id.max:255' => "يجب ان لا يكون اسم القسم اكثر من 255 حرف",
        ];
    }

    public function show()
    {
        $sections = sections::all();
        return view('products.create', compact('sections'));
    }

    public function edit($id)
    {
        $sections = sections::all();
        $products = products::find($id);

        return view('products.update', compact('products', 'sections'));
    }

    public function update(Request $request, $id)
    {

        // $rules = $this->getRules();
        // $message = $this->getMessages();

        // $validate = Validator($request->all(), $rules, $message);

        // if ($validate->fails()) {
        //     return redirect()->back()->withErrors($validate)->withInputs($request->all());
        // }

        $products = products::find($id);
        if (!$products)
            return redirect()->back();

        //update data

        $products->Product_name = $request->Product_name;
        $products->description = $request->description;
        $products->section_id = $request->section_id;
        $products->save();

        return redirect()->route('products.index')->with(['edit' => __('products/products.edit_pro')]);
    }


    public function delete($id)
    {
        $products = products::find($id);

        if (!$products) {
            return redirect()->back()->with(['Err' => __('products/products.Err_pro')]);
        } else {
            $products->delete();

            return redirect()->back()->with(['deleted' => __('products/products.deleted_pro')]);
        }
    }
}
