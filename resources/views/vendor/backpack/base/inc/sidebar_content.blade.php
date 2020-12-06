@php
    $menu = new \App\Aid\Menu();
    $mainMenu = $menu->makeMainMenu();
@endphp

@foreach($mainMenu as $item)
    @include('backpack::menu.item')
@endforeach

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('country') }}'><i class='nav-icon la la-globe'></i> Countries</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('state') }}'><i class='nav-icon la la-flag'></i> States</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('city') }}'><i class='nav-icon la la-city'></i> Cities</a></li>
