<?php
namespace Scriber\Bundle\AdminPanelBundle\Tests\Menu;

use PHPUnit\Framework\TestCase;
use Rzeka\Menu\MenuItemInterface;
use Scriber\Bundle\AdminPanelBundle\Menu\MenuItemFactory;

class MenuItemFactoryTest extends TestCase
{
    public function testCreateNewItem()
    {
        $title = 'title';
        $link = '/';
        $attributes = [
            'test' => 'test'
        ];

        $item = MenuItemFactory::createNewItem($title, $link, $attributes);

        static::assertInstanceOf(MenuItemInterface::class, $item);
        static::assertEquals($title, $item->getTitle());
        static::assertEquals($link, $item->getLink());
        static::assertEquals($attributes, $item->getAttributes());
    }
}
