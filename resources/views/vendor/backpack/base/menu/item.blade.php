@php
    $childrens = $menu->childrens($item['text']);
    $text = __('menu.' . \Illuminate\Support\Str::lower($item['text']));

    $hasSub = $childrens->count() > 0;
    $bActive = $item['active'] ? 'active' : '';
    $bSubmenuDropdown = $hasSub ? 'nav-dropdown-toggle' : '';
@endphp

<li class="nav-item {{ $hasSub ? 'nav-dropdown' : '' }}">
    <a href="{{ $item['link'] }}"
       alt="{{ $text }}"
       title="{{ $text }}"
       class="nav-link {{ $bActive }} {{ $bSubmenuDropdown }}"
    >
        <i class="nav-icon {{ $item['icon'] }}"></i>
        {{ $text }}
    </a>

    @if($hasSub)
        <ul class="nav-dropdown-items">
            @foreach ($childrens as $item)
                @include('backpack::menu.item')
            @endforeach
        </ul>
    @endif
</li>
