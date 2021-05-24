@php
    $menu = new \App\Aid\Menu();
    $mainMenu = $menu->makeMainMenu();
@endphp

@foreach($mainMenu as $item)
    @include('backpack::menu.item')
@endforeach

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('processos') }}'><i class='nav-icon la la-question'></i> Processos</a></li>