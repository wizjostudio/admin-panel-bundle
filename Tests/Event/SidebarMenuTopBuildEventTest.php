<?php
namespace Scriber\Bundle\AdminPanelBundle\Tests\Event;

use PHPUnit\Framework\TestCase;
use Rzeka\Menu\MenuItemInterface;
use Scriber\Bundle\AdminPanelBundle\Event\AbstractMenuBuildEvent;
use Scriber\Bundle\AdminPanelBundle\Event\SidebarMenuTopBuildEvent;

class SidebarMenuTopBuildEventTest extends TestCase
{
    public function testInstanceOfAbstractMenuBuildEvent()
    {
        $event = new SidebarMenuTopBuildEvent($this->createMock(MenuItemInterface::class));

        static::assertInstanceOf(AbstractMenuBuildEvent::class, $event);
    }
}
