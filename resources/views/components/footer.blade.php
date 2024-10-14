<div class="menubar-footer footer-fixed">
    <ul class="inner-bar">
        @foreach (config('footer') as $footer)
            <li class="{{ Route::is($footer['route-name']) || Route::is($footer['is-active']) ? 'active' : '' }}"><a
                    href="{{ route($footer['route-name']) }}"><i class="icon icon-{{  Route::is($footer['route-name']) || Route::is($footer['is-active']) ? $footer['icon-active'] : $footer['icon'] }}"></i>
                    {{ $footer['title'] }}</a></li>
        @endforeach
    </ul>
</div>
