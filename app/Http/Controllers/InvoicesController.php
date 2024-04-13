<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\invoices;
use App\Models\invoices_details;
use App\Models\sections;
use App\Models\User;
use App\Notifications\Add_invoices_new;
use App\Notifications\Addinvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InvoicesController extends Controller
{
    public function index()
    {
        $sections = sections::all();
        $invoices = invoices::all();
        return view('invoices.invoices', compact('invoices', 'sections'));
    }

    public function create(Request $request)
    {
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);

        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'id_Invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {

            $invoice_id = invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        // $user = User::first();
        // Notification::send($user, new Addinvoice($invoice_id));

        $user = User::where('roles_name', '["owner"]')->get();

        $invoices = invoices::latest()->first();

        Notification::send($user, new Add_invoices_new($invoices));


        return redirect()->route('invoices.index')->with(['add' => __('invoices/invoices.Add')]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        $sections = sections::all();
        return view('invoices.create', compact('sections'));
    }

    public function edit($id)
    {
        $invoices = invoices::find($id);  // search in given table id only
        if (!$invoices)
            return redirect()->back();

        $sections = sections::select('id', 'section_name', 'description', 'Created_by')->get();
        $invoice_attachments = invoice_attachments::all();
        $invoices = invoices::all()->find($id);

        return view('invoices.update', compact('sections', 'invoices', 'invoice_attachments'));
    }


    public function update(Request $request, $id)
    {
        $invoices = invoices::find($id);
        if (!$invoices)
            return redirect()->back();

        $invoices->update($request->all());

        return redirect()->route('invoices.index')->with(['edit' => __('invoices/invoices.edit')]);
    }

    public function showStatus($id)
    {
        $invoices = invoices::all()->find($id);
        return view('invoices.update_status', compact('invoices'));
    }


    public function updateStatus(Request $request, $id)
    {
        $invoices = invoices::find($id);

        if ($request->Status == 'مدفوعة' || $request->Status == 'Paid') {

            $invoices->update([
                'Value_Status' => 1,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);

            invoices_details::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        } else {

            $invoices->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);

            invoices_details::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 3,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }

        return redirect()->route('invoices.index')->with(['edit' => __('invoices/invoices.edit')]);
    }


    public function delete($id)
    {
        $invoices = invoices::where('id', $id)->first();
        $Details = invoice_attachments::where('invoice_id', $id)->first();

        if (!empty($Details->invoice_number)) {
            Storage::disk('public_uploads')->deleteDirectory($Details->invoice_number);
        }

        if (!$invoices) {
            return redirect()->back()->with(['Err' => __('invoices/invoices.Err')]);
        } else {
            $invoices->forceDelete();

            return redirect()->back()->with(['deleted' => __('invoices/invoices.deleted')]);
        }
    }


    public function archive($id)
    {
        $invoices = invoices::where('id', $id)->first();

        if (!$invoices) {
            return redirect()->back()->with(['Err' => __('invoices/invoices.Err')]);
        } else {
            $invoices->delete();

            return redirect()->back()->with(['archived' => __('invoices/invoices.archived')]);
        }
    }

    public function showPrint($id)
    {
        $invoices = invoices::find($id);

        return view('invoices.print', compact('invoices'));
    }

    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }

    public function paid()
    {
        $invoices = invoices::where('Value_Status', 1)->get();
        return view('invoices.paid', compact('invoices'));
    }

    public function unpaid()
    {
        $invoices = invoices::where('Value_Status', 2)->get();
        return view('invoices.unpaid', compact('invoices'));
    }

    public function partial()
    {
        $invoices = invoices::where('Value_Status', 3)->get();
        return view('invoices.partial', compact('invoices'));
    }

    public function MarkAsRead_all(Request $request)
    {
        $userUnreadNotification = auth()->user()->unreadNotifications;

        if ($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }
    }
}
