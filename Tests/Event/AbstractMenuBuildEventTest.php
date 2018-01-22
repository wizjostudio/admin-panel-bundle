<?php
namespace Scriber\Bundle\AdminPanelBundle\Tests\Event;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Rzeka\Menu\MenuItemInterface;
use Scriber\Bundle\AdminPanelBundle\Event\AbstractMenuBuildEvent;
use Scriber\Bundle\CoreBundle\Entity\User;
use Scriber\Bundle\CoreBundle\Event\User\AbstractUserChangePasswordEvent;

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
