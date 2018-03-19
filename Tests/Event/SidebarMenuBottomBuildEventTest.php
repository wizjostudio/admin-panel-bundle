<?php
namespace Wizjo\Bundle\AdminPanelBundle\Test\Event;

use PHPUnit\Framework\TestCase;
use Rzeka\Menu\MenuItemInterface;
use Wizjo\Bundle\AdminPanelBundle\Event\AbstractMenuBuildEvent;
use Wizjo\Bundle\AdminPanelBundle\Event\SidebarMenuBottomBuildEvent;

class SidebarMenuBottomBuildEventTest extends TestCase
{
    public function testInstanceOfAbstractMenuBuildEvent()
    {
        $event = new SidebarMenuBottomBuildEvent($this->createMock(MenuItemInterface::class));

        static::assertInstanceOf(AbstractMenuBuildEvent::class, $event);
    }
}
