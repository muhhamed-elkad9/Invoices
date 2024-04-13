<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesArchiveController extends Controller
{
    public function index()
    {
        $invoices = invoices::onlyTrashed()->get();

        return view('invoices.Archive', compact('invoices'));
    }

    public function create(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function transfer(Request $request, $id)
    {
        // $id = $request->invoice_id;
        $flight = Invoices::withTrashed()->where('id', $id)->restore();

        return redirect()->back()->with(['restore' => __('invoices/invoices.restore')]);
    }

    public function delete(Request $request, $id)
    {
        $invoices = invoices::withTrashed()->where('id', $request->id)->first();
        $Details = invoice_attachments::where('invoice_id', $id)->first();

        if (!empty($Details->invoice_number)) {
            Storage::disk('public_uploads')->deleteDirectory($Details->invoice_number);
        }

        if (!$invoices) {
            return redirect()->back()->with(['Err' => __('invoices/Archive.Err')]);
        } else {
            $invoices->forceDelete();

            return redirect()->back()->with(['deleted' => __('invoices/Archive.deleted')]);
        }
    }
}
