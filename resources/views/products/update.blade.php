@extends('layouts.master')
@section('title')
    {{ __('products/update.Edit_product') }}
@stop
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('products/update.Settings') }}
                    <span class="text-muted mt-1 tx-18 mr-2 mb-0">/ {{ __('products/update.Products') }}</span>
                    <span class="text-muted mt-1 tx-14 mr-2 mb-0">/ {{ __('products/update.Edit_product') }}</span>
                </h4>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('add'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('products/update.Add_pro') }}',
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('Err'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('products/update.Err_pro') }}',
                    type: "error"
                })
            }
        </script>
    @endif

    @if (session()->has('deleted'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('products/update.deleted_pro') }}',
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('edit'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('products/update.edit_pro') }}',
                    type: "success"
                })
            }
        </script>
    @endif


    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-header">
                    <h4 class="card-title mb-1">{{ __('products/update.Edit_product') }}</h4>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('products.update', $products->id) }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="exampleFormControlInput1">{{ __('products/create.product_name') }}</label>
                            <input type="text" value="{{ $products->Product_name }}" class="form-control"
                                id="Product_name" name="Product_name">
                        </div>

                        <label class="my-1 mr-2"
                            for="exampleFormControlInput1">{{ __('products/create.Section_name') }}</label>
                        <select name="section_id" id="section_id" class="form-control" required>
                            <option value="{{ $products->section_id }}">{{ $products->section->section_name }}
                            </option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                            @endforeach
                        </select>

                        <div class="form-group mt-3">
                            <label for="exampleFormControlInput1">{{ __('products/create.Notes') }}</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $products->description }}</textarea>
                        </div>

                        <div class="form-group mb-0 mt-3 float-left">
                            <button type="submit" class="btn btn-primary">{{ __('products/create.Save') }}</button>
                        </div>
                    </form>
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
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
    <!-- Ionicons js -->
    <script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
@endsection
