<div class="form-row">
    @foreach((array)$options['children'] as $child)
        {!! $child->render() !!}
    @endforeach
</div>
