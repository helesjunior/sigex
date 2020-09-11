<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="la la-home nav-icon"></i>
        {{ __('base.dashboard') }}
    </a>
</li>

<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('backup') }}'>
        <i class='nav-icon la la-hdd-o'></i>
        {{ __('menu.backups') }}
    </a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('log') }}'>
        <i class='nav-icon la la-terminal'></i>
        {{ __('menu.logs') }}
    </a>
</li>

<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon la la-users"></i>
        {{ __('menu.authentication') }}
    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"
        ><a class="nav-link" href="{{ backpack_url('user') }}">
                <i class="nav-icon la la-user"></i>
                <span>
                    {{ __('menu.users') }}
                </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('role') }}">
                <i class="nav-icon la la-id-badge"></i>
                <span>
                    {{ __('menu.roles') }}
                </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('permission') }}">
                <i class="nav-icon la la-key"></i>
                <span>
                    {{ __('menu.permissions') }}
                </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('code') }}">
                <i class="nav-icon la la-code"></i>
                <span>
                    {{ __('menu.code_items') }}
                </span>
            </a>
        </li>
    </ul>
</li>
