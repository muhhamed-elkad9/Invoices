<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\invoices;
use App\Models\invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        // $rules = $this->getRules();
        // $message = $this->getMessages();

        // $validate = Validator($request->all(), $rules, $message);

        // if ($validate->fails()) {
        //     return redirect()->back()->withErrors($validate)->withInputs($request->all());
        // }

        // invoices_details::create([
        //     'id_Invoice' => $request->Product_name,
        //     'invoice_number' => $request->Product_name,
        //     'product' => $request->description,
        //     'Section' => $request->section_id,
        //     'Status' => $request->section_id,
        //     'Value_Status' => $request->section_id,
        //     'Payment_Date' => $request->section_id,
        //     'note' => $request->section_id,
        //     'user' => $request->section_id,
        // ]);

        // return redirect()->route('products.index')->with(['add' => 'تم اضافة المنتج بنجاح']);
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


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = invoices::where('id', $id)->first();
        $details  = invoices_details::where('id_Invoice', $id)->get();
        $attachments  = invoice_attachments::where('invoice_id', $id)->get();

        return view('invoices.details_invoice', compact('invoices', 'details', 'attachments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices = invoice_attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);

        return back()->with(['delete' => __('invoices/details_invoice.deleted')]);
    }

    public function get_file($invoice_number, $file_name)
    {
        $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->download($contents);
    }

    public function open_file($invoice_number, $file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->file($files);
    }
}
