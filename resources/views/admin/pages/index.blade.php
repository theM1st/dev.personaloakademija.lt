@extends('layouts.admin')

@section('content')
    <div class="sortable-list">
        <ul class="sortable">
            @foreach ($pages as $node)
                {!! sortableRenderNode($node) !!}
            @endforeach
        </ul>
    </div>
@endsection

@section('scripts')
    <script>
        (function(){
            $('.sortable').sortable({
                handle: '.sort-handle',
                update: function(event, ui) {
                    var url = '{{ route('admin.page.move', [':id', ':position']) }}';
                    url = url.replace(':id', ui.item.data('id')).replace(':position', ui.item.index());
                    ajax(url, 'get');
                }
            });
        })();
    </script>
@endsection