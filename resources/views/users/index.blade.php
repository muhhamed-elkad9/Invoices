@extends('layouts.master')
@section('css')

@section('title')
    {{ __('users/index.Users') }}
@stop

<!-- Internal Data table css -->

<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ __('users/index.Users') }}
                <span class="text-muted mt-1 tx-15 mr-2 mb-0">/ {{ __('users/index.Users_list') }}</span>
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
                msg: '{{ __('users/index.Add_User') }}',
                type: "success"
            })
        }
    </script>
@endif

@if (session()->has('edit'))
    <script>
        window.onload = function() {
            notif({
                msg: '{{ __('users/index.edit_User') }}',
                type: "success"
            })
        }
    </script>
@endif

@if (session()->has('delete'))
    <script>
        window.onload = function() {
            notif({
                msg: '{{ __('users/index.deleted_User') }}',
                type: "success"
            })
        }
    </script>
@endif

<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="col-sm-1 col-md-2">
                    @can('اضافة مستخدم')
                        <a class="btn btn-primary btn-sm"
                            href="{{ route('users.create') }}">{{ __('users/index.Add_Users') }}</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                    <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                        <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">{{ __('users/index.Name_Users') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('users/index.Email') }}</th>
                                <th class="wd-15p border-bottom-0">{{ __('users/index.Status_Users') }}</th>
                                <th class="wd-15p border-bottom-0">{{ __('users/index.Type_Users') }}</th>
                                <th class="wd-10p border-bottom-0">{{ __('users/index.Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->Status == 'مفعل')
                                            <span class="label text-success d-flex">
                                                <div class="dot-label bg-success ml-1"></div>{{ $user->Status }}
                                            </span>
                                        @else
                                            <span class="label text-danger d-flex">
                                                <div class="dot-label bg-danger ml-1"></div>{{ $user->Status }}
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $v)
                                                <label class="badge badge-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>

                                    <td>
                                        @can('تعديل مستخدم')
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info"
                                                title="{{ __('users/index.Edit') }}"><i class="las la-pen"></i></a>
                                        @endcan

                                        @can('حذف مستخدم')
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-user_id="{{ $user->id }}" data-username="{{ $user->name }}"
                                                data-toggle="modal" href="#modaldemo8"
                                                title="{{ __('users/index.Delete') }}"><i class="las la-trash"></i></a>
                                        @endcan
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

    <!-- Modal effects -->
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('users/index.Delete_User') }}</h6><button aria-label="Close"
                        class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('users.destroy', $user->id) }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>{{ __('Are_Sure_Delete_User') }}</p><br>
                        <input type="hidden" name="user_id" id="user_id" value="">
                        <input class="form-control" name="username" id="username" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('users/index.Cancel') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('users/index.Sure') }}</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>

</div>
<!-- /row -->
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
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<!-- Internal Modal js-->
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>

<script>
    $('#modaldemo8').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var user_id = button.data('user_id')
        var username = button.data('username')
        var modal = $(this)
        modal.find('.modal-body #user_id').val(user_id);
        modal.find('.modal-body #username').val(username);
    })
</script>


@endsection
