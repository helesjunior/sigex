{{-- Flags --}}
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="flag-icon flag-icon-{{ \App\Aid\Languages::getCurentFlag() }}"></i>
    </a>

    <div class="dropdown-menu dropdown-menu-right p-0">
        @foreach (\App\Aid\Languages::all() as $language)
            {{--
            // ************************************************************
            TODO:
            Point to url to define new language for current user!
            // ************************************************************
            --}}
            <a href="/language/{{ $language['code'] }}" class="dropdown-item {{ \App\Aid\Languages::isActive($language) ? 'active' : '' }}">
                <i class="flag-icon flag-icon-{{ $language['flag'] }} mr-2"></i>
                {{ $language['name'] }}
            </a>
        @endforeach
    </div>
</li>
