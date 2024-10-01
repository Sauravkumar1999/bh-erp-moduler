@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = Helper::appClasses();
@endphp

@isset($configData["layout"])
@include((( $configData["layout"] === 'horizontal') ? 'layouts.horizontal-layout' :
(( $configData["layout"] === 'blank') ? 'layouts.blank-layout' :
(($configData["layout"] === 'front') ? 'layouts.layout-front' : 'layouts.content-navbar-layout') )))
@endisset
