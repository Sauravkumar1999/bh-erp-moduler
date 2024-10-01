@extends('adminlte::page')

@section('title', trans('user::referral.referrals'))
@section('content_header')
    <x-core-content-header :title="trans('user::referral.referrals')" :breadcrumbs="$breadcrumbs"/>
@stop

@section('content')
    <x-adminlte-card theme="primary" theme-mode="outline">
        {!! $dataTable->table() !!}
    </x-adminlte-card>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
    <link rel="stylesheet" href="{{asset('/vendor/datatables/dt-editor/css/editor.bootstrap5.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('/vendor/vuexy/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
    <style>
        #referral-table_wrapper .dtb-popover-close {
            display: none;
        }
        .card{
            --bs-card-spacer-x: 0 !important;
        }
        @media screen and (max-width: 767px) {
            div#referral-table_wrapper {
                position: relative;

            }

            div#referral-table_filter {
                margin: 0;
                text-align: left;
                margin-bottom: 9px;
                width: 100%;
            }

            div#referral-table_filter label {
                width: 100%;
            }

            div#referral-table_filter input {
                width: 100%;
                margin: 0;
            }

            div#referral-table_length {
                margin-top: 0;
            }

            div#referral-table_wrapper .align-items-center {
                margin-bottom: 30px;
                justify-content: space-between !important;
            }

            .modal.DTED.fade.show .modal-dialog {
                left: 0px !important;
                padding-left: 0px !important;
                padding-right: 0px !important;
                height: 90% !important;
            }

            .modal-backdrop {
                height: 90% !important;
                position: fixed !important;
                top: 11% !important;
            }

            .modal-dialog-centered {
                position: fixed;
                bottom: 0px;
                min-height: 90% !important;
                overflow-y: scroll;
            }

            .modal .modal-header {
                justify-content: center;
            }

            .dt-buttons {
                display: flex;
                justify-content: end;
                padding-right: 0px;
                right: 0;
            }
        }

    </style>
@stop

@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="{{asset('/vendor/datatables/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/vendor/datatables/buttons.server-side.js')}}"></script>
    <script type="text/javascript" src="{{asset('/vendor/datatables/buttons.print.min.js')}}"></script>
    {!! $dataTable->scripts() !!}
@stop
