<?php
namespace Scriber\Bundle\AdminPanelBundle\Tests\EventListener;

use PHPUnit\Framework\TestCase;
use Rzeka\Menu\MenuItemInterface;
use Scriber\Bundle\AdminPanelBundle\Event\AbstractMenuBuildEvent;
use Scriber\Bundle\AdminPanelBundle\EventListener\MenuActiveLinkListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuActiveLinkListenerTest extends TestCase
{
    public function testOnMenuFinish()
    {
        $url = '/test';

        $requestStack = $this->createMock(RequestStack::class);
        $request = $this->createMock(Request::class);

        $menu = $this->createMock(MenuItemInterface::class);
        $event = $this->createMock(AbstractMenuBuildEvent::class);
        $childItem = $this->createMock(MenuItemInterface::class);

        $requestStack
            ->expects(static::once())
            ->method('getCurrentRequest')
            ->willReturn($request);

        $request
            ->expects(static::once())
            ->method('getPathInfo')
            ->willReturn($url);

        $event
            ->expects(static::once())
            ->method('getMenu')
            ->willReturn($menu);

        $menu
            ->expects(static::once())
            ->method('getChildren')
            ->willReturn([$childItem, $childItem]);

        $childItem
            ->expects(static::exactly(2))
            ->method('getLink')
            ->willReturnOnConsecutiveCalls($url, '/');

        $childItem
            ->expects(static::once())
            ->method('setActive')
            ->with(true);

        $listener = new MenuActiveLinkListener($requestStack);
        $listener->onMenuFinish($event);
    }
}
