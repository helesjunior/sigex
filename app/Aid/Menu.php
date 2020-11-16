<?php

/**
 * Helper class to main menu management.
 *
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
namespace App\Aid;

use Illuminate\Support\Collection;

/**
 * Contains all methods to create a dynamic array with menu options to future display.
 *
 * @category SigEx
 * @package App\Aid\Menu
 * @copyright 2019~2029 SigEx
 * @license MIT License. <https://opensource.org/licenses/MIT>
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
class Menu extends Collection
{
    // Constants
    const HOME = '/';
    const DASHBOARD = '/dashboard';

    const CREDITORS = '/creditors';

    const AUTH = '#';
    const AUTH_ROLES = '/role';
    const AUTH_PERMISSIONS = '/permission';
    const AUTH_USERS = '/user';

    const ADMIN = '#';
    const ADMIN_BACKUPS = '/backup';
    const ADMIN_CODES = '/code';
    const ADMIN_LOGS = '/log';

    protected $currentUri;
    protected $currentPermission;

    /**
     * Make the main menu array data for future display.
     *
     * @return Menu
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    public function makeMainMenu()
    {
        $this->currentUri = Request()->getRequestUri();
        $this->currentPermission = '';

        $this->setMainMenu();

        return $this
            ->where('parent', '')
            ->where('show', true)
            ->where('can', true);
    }

    /**
     * Create a new menu item with $text description and $link.
     *
     * @param string $text
     * @param string $link
     * @return $this
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    public function item($text, $link)
    {
        $this->items[] = [
            'text' => $text,
            'link' => $link,
            'icon' => '',
            'parent' => '',
            'permission' => '',
            'can' => true, // TODO: check if has permission! (ASmR)
            'show' => true,
            'active' => ($link == $this->currentUri)
        ];

        return $this;
    }

    /**
     * Set the full icon name for current menu item.
     *
     * @param string $icon
     * @return $this
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    public function icon($icon)
    {
        $this->addMenuItemElement('icon', $icon);

        return $this;
    }

    /**
     * Set the parent menu item for current menu item.
     *
     * @param string $parent
     * @return $this
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    public function parent($parent)
    {
        $this->addMenuItemElement('parent', $parent);

        return $this;
    }

    /**
     * Set the permission name for current menu item.
     *
     * @param string $permission
     * @return $this
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    public function permission($permission)
    {
        $this->addMenuItemElement('permission', $permission);

        return $this;
    }

    /**
     * Defines if the current menu item is visible or not.
     *
     * @param boolean $isVisible
     * @return $this
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    public function show($isVisible)
    {
        $this->addMenuItemElement('show', $isVisible);

        return $this;
    }

    /**
     * Magic method for a new parameter field for current menu item - which demands future implementation on blade.
     *
     * @param string $method
     * @param array $parameters
     * @return $this
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    public function __call($method, $parameters)
    {
        $this->addMenuItemElement($method, $parameters[0]);

        return $this;
    }

    /**
     * Return a submenu from $parent, if exists.
     *
     * @param string $parent
     * @return Menu
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    public function childrens($parent)
    {
        return $this
            ->where('parent', $parent)
            ->where('show', true)
            ->where('can', true);
    }

    /**
     * Add new menu item element.
     *
     * @param $element
     * @param $value
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    private function addMenuItemElement($element, $value)
    {
        $key = count($this->items) - 1;
        $currentItem = last($this->items);
        $newElement = [$element => $value];

        $this->items[$key] = array_merge($currentItem, $newElement);
    }

    /**
     * Defines the main menu array data.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    private function setMainMenu()
    {
        $this->item('dashboard', self::DASHBOARD)
            ->icon('la la-home');

        $this->item('creditors', self::CREDITORS)
            ->icon('la la-industry');

        $this->item('authentication', self::AUTH)
            ->icon('la la-user-cog');
        $this->item('users', self::AUTH_USERS)
            ->icon('la la-user')
            ->parent('authentication');
        $this->item('roles', self::AUTH_ROLES)
            ->icon('la la-id-badge')
            ->parent('authentication');
        $this->item('permissions', self::AUTH_PERMISSIONS)
            ->icon('la la-key')
            ->parent('authentication');

        $this->item('administration', self::ADMIN)
            ->icon('la la-tools');
        $this->item('code_items', self::ADMIN_CODES)
            ->icon('la la-code')
            ->parent('administration');
        $this->item('backups', self::ADMIN_BACKUPS)
            ->icon('la la-hdd-o')
            ->parent('administration');
        $this->item('logs', self::ADMIN_LOGS)
            ->icon('la la-terminal')
            ->parent('administration');
    }
}
