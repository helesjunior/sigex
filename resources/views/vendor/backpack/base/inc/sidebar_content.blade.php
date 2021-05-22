@php
    $menu = new \App\Aid\Menu();
    $mainMenu = $menu->makeMainMenu();
@endphp

@foreach($mainMenu as $item)
    @include('backpack::menu.item')
@endforeach
