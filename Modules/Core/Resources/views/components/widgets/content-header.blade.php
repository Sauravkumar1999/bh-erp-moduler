{{--<div class="card py-3 mb-4">
    <h4 class="card-header">{{ $title }}</h4>
    @if(!empty($breadcrumbs))
        <div class="card-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @foreach($breadcrumbs as $breadcrumb)
                        @if($loop->last)
                            <li class="breadcrumb-item active">{{ $breadcrumb['name'] }}</li>
                        @else
                            <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        </div>
    @endif
</div>--}}
<h1>{{$title}}</h1>
