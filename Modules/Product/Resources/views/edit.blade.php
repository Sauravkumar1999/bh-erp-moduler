@extends('adminlte::page')

@section('title', __('product::product.edit-product'))

@section('content_header')

    <div class="d-flex align-content-center">
        <a href="{{ route('admin.products.index') }}" class="link-primary mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                <path d="M15 6.5L9 12.5L15 18.5" stroke="#646464" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
            </svg>
        </a>
        <x-core-content-header :title="__('product::product.edit-product')" :breadcrumbs="$breadcrumbs" />
    </div>
@stop

@section('content')

    <x-adminlte-card theme="primary" header-class="d-none" body-class="mt-4" theme-mode="outline">

        <livewire:product::edit :product="$product" />

    </x-adminlte-card>

@stop

@section('css')
    <style>
        .form-label {
            font-size: 16px !important;
            font-weight: 400;
            line-height: 19px;
            letter-spacing: 0px;
            text-align: left;

        }

        .custom-field-group .form-label {
            font-weight: 600;
        }

        .custom-field-group .row .col-form-label {
            font-size: 14px !important;
            font-weight: 400;
            line-height: 17px;
            letter-spacing: 0px;
            text-align: left;

        }

        .select2-container {
            width: 100% !important;
        }

        span.select2-selection.select2-selection--multiple {
            padding: 0.422rem 0.875rem;
            min-height: 40px;
        }

        .select2-container li.select2-selection__choice {
            margin: 0 5px !important;
        }

        .select2-container--default .select2-selection--single {
            height: 39px !important;
            border: 1px solid #dedde1 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered,
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 39px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            height: 39px !important;
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #dedde1 !important;
        }
    </style>
@stop
