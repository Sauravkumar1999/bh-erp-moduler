@extends('adminlte::page')

@section('title', $user->full_name . ' ' . trans('user::referral.genealogy'))

@section('content_header')
    <x-core-content-header :title="$user->full_name . ' ' . trans('user::referral.genealogy')" />
@stop

@section('content')
    <x-adminlte-card theme="primary" theme-mode="outline">
        <h4>{{ $user->full_name }}</h4>
        <?php $nodes = $user->children; ?>
        <div id="jstree-basic">
            <?php
            $traverse = function ($users, $prefix = '<ul style="margin-top: 5px;">', $postfix = '</ul>') use (&$traverse) {
                echo '<ul>';
                foreach ($users as $user) {
                    echo '<li data-jstree=\'{"icon" : false, "opened" : true}\'>';
                    echo '<div class="referral-box"><div class="inner">';
                    echo '<div class="head">' . $user->full_name . '</div>';
                    echo '<div class="body">';
                    echo '<div class="row-outer"><div class="row-inner">' . '<div class="left">' . trans('user::referral.group') . ':</div>' . '<div class="right">' . $user->company?->name. '</div>' . '</div></div>';
                    echo '<div class="row-outer"><div class="row-inner">' . '<div class="left">' . trans('user::referral.position') . ':</div>' . '<div class="right">' . ($user->roles->isNotEmpty() ? $user->roles->first()->name : 'NA') . '</div>' . '</div></div>';
                    echo '<div class="row-outer"><div class="row-inner">' . '<div class="left">' . trans('user::referral.personal-code') . ':</div>' . '<div class="right">' . $user->code . '</div>' . '</div></div>';

                    echo '</div>';
                    echo '</div></div>';
                    $traverse($user->children, $prefix, $postfix);
                    echo '</li>';
                }
                echo '</ul>';
            };
            // .'('.$user->roles->first()?->name
            $traverse($nodes);
            ?>
        </div>
    </x-adminlte-card>

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/jstree/jstree.css') }}" />
    <style>
        .referral-box {
            display: inline-flex;
            padding: 10px;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            border-radius: 10px;
            background: rgba(236, 102, 26, 0.20);
        }

        .referral-box .inner {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .referral-box .inner .head {
            display: flex;
            width: 165px;
            padding: 4px 20px;
            justify-content: center;
            align-items: center;
            gap: 10px;
            border-radius: 20px;
            background: #FFF;
        }

        .referral-box .body {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .referral-box .body .row-outer {
            display: flex;
            padding: 4px 10px;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .referral-box .body .row-inner {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .referral-box .body .left {
            color: var(--txt, #2B2B2B);
            font-feature-settings: 'clig' off, 'liga' off;
            font-family: Pretendard;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .referral-box .body .right {
            color: var(--txt, #2B2B2B);
            font-feature-settings: 'clig' off, 'liga' off;
            font-family: Pretendard;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .jstree-container-ul{
            margin-left: 0 !important;
        }

        .jstree-node,
        .jstree-children,
        .jstree-container-ul {
            /* margin-left: none !important; */
            margin-left: 5%;
            /* margin-top: 1%; */
        }

        @media(max-width: 576px){
            .jstree-node,
        .jstree-children,
        .jstree-container-ul {
            /* margin-left: none !important; */
            margin-left: 3%;
            /* padding-bottom: 1% 0; */
        }
        }

        .jstree-default .jstree-anchor {
            height: 145px !important;
        }

        .jstree-default .jstree-clicked,
        .jstree-hovered {
            box-shadow: none;
        }

    </style>
@stop

@section('js')
    <script src="{{ asset('vendor/vuexy/vendor/libs/jstree/jstree.js') }}"></script>
    <script src="{{ asset('vendor/vuexy/js/extended-ui-treeview.js') }}"></script>
@stop
