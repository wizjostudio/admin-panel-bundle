<?php
namespace Wizjo\Bundle\AdminPanelBundle\Tests\Event;

use PHPUnit\Framework\TestCase;
use Rzeka\Menu\MenuItemInterface;
use Wizjo\Bundle\AdminPanelBundle\Event\AbstractMenuBuildEvent;
use Wizjo\Bundle\AdminPanelBundle\Event\TopMenuFinishBuildEvent;

class TopMenuFinishBuildEventTest extends TestCase
{
    public function testInstanceOfAbstractMenuBuildEvent()
    {
        $event = new TopMenuFinishBuildEvent($this->createMock(MenuItemInterface::class));

        static::assertInstanceOf(AbstractMenuBuildEvent::class, $event);
    }
}
