<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //////// Invoices Total
        $Total = number_format(invoices::sum('Total'), 2);
        $countTotal = invoices::count('Total');

        //////// Unpaid Total
        $unpaid = number_format(invoices::where('Status', 'غير مدفوعة')->sum('Total'), 2);
        $countUnpaid = invoices::where('Value_Status', 2)->count();

        //////// Paid Total
        $paid = number_format(invoices::where('Status', 'مدفوعة')->sum('Total'), 2);
        $countPaid = invoices::where('Value_Status', 1)->count();

        //////// Partial Total
        $partial = number_format(invoices::where('Status', 'مدفوعة جزئيا')->sum('Total'), 2);
        $countPartial = invoices::where('Value_Status', 3)->count();

        if ($countUnpaid == 0) {
            $RateUnpaid = 0;
        } else {
            $RateUnpaid = round(($countUnpaid / $countTotal) * 100, 1);
        }

        if ($countPaid == 0) {
            $RatePaid = 0;
        } else {
            $RatePaid = round(($countPaid / $countTotal) * 100, 1);
        }

        if ($countPartial == 0) {
            $RatePartial = 0;
        } else {
            $RatePartial = round(($countPartial / $countTotal) * 100, 1);
        }

        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels([__('home.Invoices_Unpaid'), __('home.Invoices_Paid'), __('home.Invoices_Partial')])
            ->datasets([
                [
                    "label" => __('home.Invoices_Unpaid'),
                    'backgroundColor' => ['#ec5858'],
                    'data' => [$RateUnpaid]
                ],
                [
                    "label" => __('home.Invoices_Paid'),
                    'backgroundColor' => ['#81b214'],
                    'data' => [$RatePaid]
                ],
                [
                    "label" => __('home.Invoices_Partial'),
                    'backgroundColor' => ['#ff9642'],
                    'data' => [$RatePartial]
                ],


            ])
            ->options([]);


        $chartjs2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 340, 'height' => 255])
            ->labels([__('home.Invoices_Unpaid'), __('home.Invoices_Paid'), __('home.Invoices_Partial')])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214', '#ff9642'],
                    'data' => [$RateUnpaid, $RatePaid, $RatePartial]
                ]
            ])
            ->options([]);
        return view('home', compact('Total', 'countTotal', 'unpaid', 'countUnpaid', 'paid', 'countPaid', 'partial', 'countPartial', 'chartjs', 'chartjs2'));
    }
}
