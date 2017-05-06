<side class="side">
    <nav class="nav">
        <div class="list-group">
            <a href="{{ route('admin.root') }}" class="list-group-item{{ classActivePath('', 2) }}">{{ trans('admin.root') }}</a>
            <a href="{{ route('admin.page.index') }}" class="list-group-item{{ classActivePath('page', 2) }}">{{ trans('admin.page.index') }}</a>
            <a href="{{ route('admin.slideshow.index') }}" class="list-group-item{{ classActivePath('slideshow', 2) }}">{{ trans('admin.slideshow.index') }}</a>
        </div>
    </nav>
</side>