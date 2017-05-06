<section class="content-header clearfix">
    <h2>
        {{ trans($route) }}
    </h2>
    @if (strpos($route, 'index') !== false && Route::has($createNew = substr($route, 0, strrpos($route, '.') + 1) . 'create'))
        <a href="{{ route($createNew) }}" title="{{ trans($createNew) }}" class="btn btn-default btn-create">
            <span class="glyphicon glyphicon-plus-sign"></span>
            {{ trans($createNew) }}
        </a>
    @endif
</section>