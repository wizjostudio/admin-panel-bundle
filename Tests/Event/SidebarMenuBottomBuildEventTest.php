<?php
namespace Scriber\Bundle\AdminPanelBundle\Test\Event;

use PHPUnit\Framework\TestCase;
use Rzeka\Menu\MenuItemInterface;
use Scriber\Bundle\AdminPanelBundle\Event\AbstractMenuBuildEvent;
use Scriber\Bundle\AdminPanelBundle\Event\SidebarMenuBottomBuildEvent;

class SidebarMenuBottomBuildEventTest extends TestCase
{
    public function testInstanceOfAbstractMenuBuildEvent()
    {
        $event = new SidebarMenuBottomBuildEvent($this->createMock(MenuItemInterface::class));

        static::assertInstanceOf(AbstractMenuBuildEvent::class, $event);
    }
}
