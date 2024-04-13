<!-- Title -->
<title> @yield('title') </title>
<!-- Favicon -->
<link rel="icon" href="{{ URL::asset('assets/img/brand/favicon.png') }}" type="image/x-icon" />
<!-- Icons css -->
<link href="{{ URL::asset('assets/css/icons.css') }}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{ URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet" />
<!--  Sidebar css -->
<link href="{{ URL::asset('assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">
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

<!-- Sidemenu css -->
<link rel="stylesheet" href="{{ URL::asset('assets/css-rtl/sidemenu.css') }}">
@yield('css')
<!--- Style css -->
<link href="{{ URL::asset('assets/css-rtl/style.css') }}" rel="stylesheet">
<!--- Dark-mode css -->
<link href="{{ URL::asset('assets/css-rtl/style-dark.css') }}" rel="stylesheet">
<!---Skinmodes css-->
<link href="{{ URL::asset('assets/css-rtl/skin-modes.css') }}" rel="stylesheet">
