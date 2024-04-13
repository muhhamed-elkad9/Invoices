@extends('layouts.master')
@section('title')
    {{ __('products/create.Add_product_new') }}
@stop
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('products/create.Settings') }}
                    <span class="text-muted mt-1 tx-18 mr-2 mb-0">/ {{ __('products/create.Products') }}</span>
                    <span class="text-muted mt-1 tx-14 mr-2 mb-0">/ {{ __('products/create.Add_product_new') }}</span>
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
                    msg: '{{ __('products/create.Add_pro') }}',
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('Err'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('products/create.Err_pro') }}',
                    type: "error"
                })
            }
        </script>
    @endif

    @if (session()->has('deleted'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('products/create.deleted_pro') }}',
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('edit'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('products/create.edit_pro') }}',
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
                    <h4 class="card-title mb-1">{{ __('products/create.Add_product') }}</h4>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('products.create') }}" method="get">
                        @csrf

                        <div class="form-group">
                            <label for="exampleFormControlInput1">{{ __('products/create.product_name') }}</label>
                            <input type="text" class="form-control" id="Product_name" name="Product_name">
                        </div>

                        <label class="my-1 mr-2"
                            for="exampleFormControlInput1">{{ __('products/create.Section_name') }}</label>
                        <select name="section_id" id="section_id" class="form-control" required>
                            <option value="" selected disabled>-- {{ __('products/create.Section_select') }} --
                            </option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                            @endforeach
                        </select>

                        <div class="form-group mt-3">
                            <label for="exampleFormControlInput1">{{ __('products/create.Notes') }}</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
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
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

@endsection
