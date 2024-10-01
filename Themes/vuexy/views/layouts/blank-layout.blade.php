@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = Helper::appClasses();

/* Display elements */
$customizerHidden = ($customizerHidden ?? '');

@endphp

@extends('layouts/common-master' )

@section('layoutContent')

<!-- Content -->
@yield('content')
<!--/ Content -->

@endsection
