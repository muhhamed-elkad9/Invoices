@extends('layouts.master')
@section('title')
    {{ __('invoices/invoices.Invoices_list') }}
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('invoices/invoices.Invoices') }}
                    <span class="text-muted mt-1 tx-15 mr-2 mb-0">/ {{ __('invoices/invoices.Invoices_list') }}</span>
                </h4>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('add'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('invoices/invoices.Add') }}',
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('Err'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('invoices/invoices.Err') }}',
                    type: "error"
                })
            }
        </script>
    @endif

    @if (Session::has('deleted'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('invoices/invoices.deleted') }}',
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('archived'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('invoices/invoices.archived') }}',
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('restore'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('invoices/invoices.restore') }}',
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('edit'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('invoices/invoices.edit') }}',
                    type: "success"
                })
            }
        </script>
    @endif


    <!-- row -->
    <div class="row row-sm">


        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    @can('اضافة فاتورة')
                        <a href="{{ route('invoices.show') }}" class="modal-effect btn btn-primary" style="color:white"><i
                                class="fas fa-plus"></i>&nbsp;{{ __('invoices/invoices.Add_Invoice') }}</a>
                    @endcan

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">{{ __('invoices/invoices.Invoices_Number') }}</th>
                                    <th class="border-bottom-0">{{ __('invoices/invoices.Invoices_Date') }}</th>
                                    <th class="border-bottom-0">{{ __('invoices/invoices.Due_Date') }}</th>
                                    <th class="border-bottom-0">{{ __('invoices/invoices.Product') }}</th>
                                    <th class="border-bottom-0">{{ __('invoices/invoices.Section') }}</th>
                                    <th class="border-bottom-0">{{ __('invoices/invoices.Discount') }}</th>
                                    <th class="border-bottom-0">{{ __('invoices/invoices.Tax_Rate') }}</th>
                                    <th class="border-bottom-0">{{ __('invoices/invoices.Tax_Value') }}</th>
                                    <th class="border-bottom-0">{{ __('invoices/invoices.Total') }}</th>
                                    <th class="border-bottom-0">{{ __('invoices/invoices.Status') }}</th>
                                    <th class="border-bottom-0">{{ __('invoices/invoices.Notes') }}</th>
                                    <th class="border-bottom-0">{{ __('invoices/invoices.Processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->id }}</td>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->invoice_Date }}</td>
                                        <td>{{ $invoice->Due_date }}</td>
                                        <td>{{ $invoice->product }}</td>
                                        <td><a
                                                href="{{ route('InvoicesDetails', $invoice->id) }}">{{ $invoice->section->section_name }}</a>
                                        </td>
                                        <td>{{ $invoice->Discount }}</td>
                                        <td>{{ $invoice->Rate_VAT }}</td>
                                        <td>{{ $invoice->Value_VAT }}</td>
                                        <td>{{ $invoice->Total }}</td>
                                        <td>

                                            @if ($invoice->Value_Status == 1)
                                                <span class="text-success">{{ $invoice->Status }}</span>
                                            @elseif($invoice->Value_Status == 2)
                                                <span class="text-danger">{{ $invoice->Status }}</span>
                                            @else
                                                <span class="text-warning">{{ $invoice->Status }}</span>
                                            @endif

                                        </td>
                                        <td>{{ $invoice->note }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">{{ __('invoices/invoices.Processes') }}&nbsp;&nbsp;<i
                                                        class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    @can('تعديل الفاتورة')
                                                        <a class="dropdown-item"
                                                            href="{{ route('invoices.edit', $invoice->id) }}">{{ __('invoices/invoices.Edit_Invoices') }}</a>
                                                    @endcan

                                                    @can('حذف الفاتورة')
                                                        <a class="dropdown-item"
                                                            href="{{ route('invoices.delete', $invoice->id) }}"><i
                                                                class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;{{ __('invoices/invoices.Delete_Invoices') }}</a>
                                                    @endcan

                                                    @can('تغير حالة الدفع')
                                                        <a class="dropdown-item"
                                                            href="{{ route('invoices.showStatus', $invoice->id) }}"><i
                                                                class="text-success fas fa-money-bill"></i>&nbsp;&nbsp;{{ __('invoices/invoices.Status_Change') }}</a>
                                                    @endcan

                                                    @can('ارشفة الفاتورة')
                                                        <a class="dropdown-item"
                                                            href="{{ route('invoices.archive', $invoice->id) }}"><i
                                                                class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;{{ __('invoices/invoices.Transfer_Archive') }}</a>
                                                    @endcan

                                                    @can('طباعةالفاتورة')
                                                        <a class="dropdown-item"
                                                            href="{{ route('invoices.showPrint', $invoice->id) }}"><i
                                                                class="text-success fas fa-print"></i>&nbsp;&nbsp;{{ __('invoices/invoices.Print_Invoices') }}</a>
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->


    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
