<?php
namespace Scriber\Bundle\AdminPanelBundle\Menu;

use Rzeka\Menu\MenuItem;

class MenuItemFactory
{
    public static function createNewItem(string $title, string $link, array $attributes = [])
    {
        $item = new MenuItem($title);

        $item->setLink($link);
        $item->setAttributes($attributes);

        return $item;
    }
}
