@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    {{ __('invoices/update.Edit_Invoices') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('invoices/update.Invoices') }}
                    <span class="text-muted mt-1 tx-15 mr-2 mb-0">/ {{ __('invoices/update.Edit_Invoices') }}</span>
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
                    msg: '{{ __('invoices/update.Add') }}',
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('Err'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('invoices/update.Err') }}',
                    type: "error"
                })
            }
        </script>
    @endif

    @if (session()->has('deleted'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('invoices/update.deleted') }}',
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('edit'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('invoices/update.edit') }}',
                    type: "success"
                })
            }
        </script>
    @endif

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('invoices.update', $invoices->id) }}" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        {{ method_field('POST') }}
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row mb-3">
                            <div class="col">
                                <label for="inputName"
                                    class="control-label">{{ __('invoices/update.Invoices_Number') }}</label>
                                <input type="text" class="form-control" id="inputName" name="invoice_number"
                                    title="{{ __('invoices/update.Invoices_Number_Enter') }}"
                                    value="{{ $invoices->invoice_number }}" required>
                            </div>

                            <div class="col">
                                <label>{{ __('invoices/update.Invoices_Date') }}</label>
                                <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoices->invoice_Date }}" required>
                            </div>

                            <div class="col">
                                <label>{{ __('invoices/update.Due_Date') }}</label>
                                <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoices->Due_date }}" required>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row mb-3">
                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('invoices/update.Section') }}</label>
                                <select name="Section" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">

                                    <option value="{{ $invoices->section->id }}">{{ $invoices->section->section_name }}
                                    </option>

                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('invoices/update.Product') }}</label>
                                <select id="product" name="product" class="form-control">
                                    <option>{{ $invoices->product }}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName"
                                    class="control-label">{{ __('invoices/update.Amount_Collection') }}</label>
                                <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoices->Amount_collection }}">
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row mb-3">

                            <div class="col">
                                <label for="inputName"
                                    class="control-label">{{ __('invoices/update.Amount_Commission') }}</label>
                                <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                    name="Amount_Commission" title="{{ __('invoices/update.Amount_Commission_Enter') }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required value="{{ $invoices->Amount_Commission }}">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('invoices/update.Discount') }}</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                    title="{{ __('invoices/update.Discount_Enter') }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoices->Discount }}" required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('invoices/update.Tax_Rate') }}</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()">
                                    <option>{{ $invoices->Rate_VAT }}</option>
                                    <option value=" 5%">5%</option>
                                    <option value="10%">10%</option>
                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row mb-3">
                            <div class="col">
                                <label for="inputName"
                                    class="control-label">{{ __('invoices/update.Tax_Value') }}</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT"
                                    value="{{ $invoices->Value_VAT }}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{ __('invoices/update.Total') }}</label>
                                <input type="text" class="form-control" id="Total" name="Total"
                                    value="{{ $invoices->Total }}" readonly>
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">{{ __('invoices/update.Notes') }}</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3">{{ $invoices->note }}</textarea>
                            </div>
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">{{ __('invoices/update.Save_Data') }}</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });
    </script>


    <script>
        function myFunction() {

            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

            var Amount_Commission2 = Amount_Commission - Discount;


            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('{{ __('Amount_Commission_Enter') }}');

            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("Value_VAT").value = sumq;

                document.getElementById("Total").value = sumt;

            }

        }
    </script>


@endsection
