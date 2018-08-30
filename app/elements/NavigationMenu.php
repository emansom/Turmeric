<?php

namespace Turmeric\Elements;

use Phalcon\Di;

class NavigationMenu
{
    public function initialize()
    {
        foreach ($items as $item) {
            // Add top level menu items
            if ($item->getParentId() == 0) {
                $entry = new MenuItem($item->name);
                $entry->setLink($url->get(['for' => $item->controller]);
                $entry->setMinimumFuse(new UserFuses($item->minimum_fuse));

                $menu->addEntry($entry);
            }

            // Add submenus
            if ($item->type == "submenu") {
                $submenu = new SubMenu($item->name);
                $menu->addSubmenu()
            }
        }

        $items = $this->getTopLevel();

        foreach ($items as $item) {
            if ($item->getParentId() == 0) {
                $this->addEntry($item);
            }

            $subs = $this->menuByParentId($item->id);

            foreach($subs as $sub) {
                $items = $this->menuItems()
                $this->addSubmenu(sub);
            }
        }
    }

    public function setItems($items)
    {

    }

    public static function forRole(UserRole $role): NavigationMenu
    {
        // Retrieve fuserights for this user
        $fuserights = array_map(
            function($fuse) {
                return $fuse->getValue();
            },
            UserFuses::forRole(UserRole::fromIndex($user->rank))
        );

        $items = MenuItems::find([
            'fuse IN {fuses:array}',
            'bind' => [
                'fuses' => $fuserights
            ]
        ]);

        $menu = new NavigationMenu();
        $menu->setItems($items);

        return $items;
    }

    public function render(): string
    {
        $html = '';

        return $html;
    }
}