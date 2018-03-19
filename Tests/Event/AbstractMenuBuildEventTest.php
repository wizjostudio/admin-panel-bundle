<?php
namespace Wizjo\Bundle\AdminPanelBundle\Tests\Event;

use PHPUnit\Framework\TestCase;
use Rzeka\Menu\MenuItemInterface;
use Wizjo\Bundle\AdminPanelBundle\Event\AbstractMenuBuildEvent;

class AbstractMenuBuildEventTest extends TestCase
{
    public function testGetMenu()
    {
        $menu = $this->createMock(MenuItemInterface::class);

        $event = $this->getClass($menu);
        static::assertEquals($menu, $event->getMenu());
    }

    /**
     * @param array ...$args
     *
     * @return AbstractMenuBuildEvent
     */
    private function getClass(...$args)
    {
        return new class(...$args) extends AbstractMenuBuildEvent {};
    }
}
