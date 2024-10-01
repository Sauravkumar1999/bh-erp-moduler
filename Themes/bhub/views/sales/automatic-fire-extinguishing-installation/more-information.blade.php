@extends('bhub::sales.master',['title'=>'Fire extinguishing installation - More info'])

@section('css')
    <link rel="stylesheet" href="{{ themes('css/more-information.css') }}">
@endsection

@section('content')
    @include('bhub::sales.partials._nav')
    <div class="top">
        <span class="heading">자동 소화 장치, “키친 119” (법적 의무사항)</span>
    </div>
    <div class=" pt-5"><img src="{{ themes('images/more-info/1.png') }}" class="imgs-1" alt="" /></div>
    <div class=" pt-5"><img src="{{ themes('images/more-info/2.png') }}" class="imgs-2" alt="" /></div>
    <div class=" pt-5"><img src="{{ themes('images/more-info/3.png') }}" class="imgs-3" alt="" /></div>
    <div class=" pt-5" style="background-color: #EDECEA;"><img src="{{ themes('images/more-info/new-4.png') }}"
            class="imgs-4" alt="" />
    </div>
    <div class=" pt-5"><img src="{{ themes('images/more-info/5.png') }}" class="imgs-5" alt="" /></div>
@endsection

@section('js')
@endsection
