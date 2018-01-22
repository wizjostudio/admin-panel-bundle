<?php
namespace Scriber\Bundle\AdminPanelBundle\Tests\Menu;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Rzeka\Menu\MenuItemInterface;
use Scriber\Bundle\AdminPanelBundle\Event\SidebarMenuBottomBuildEvent;
use Scriber\Bundle\AdminPanelBundle\Event\SidebarMenuFinishBuildEvent;
use Scriber\Bundle\AdminPanelBundle\Event\SidebarMenuTopBuildEvent;
use Scriber\Bundle\AdminPanelBundle\Menu\SidebarMenuBuilder;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Translation\TranslatorInterface;

class SidebarMenuBuilderTest extends TestCase
{
    public function testGetName()
    {
        /** @var EventDispatcherInterface|MockObject $dispatcher */
        $dispatcher = $this->createMock(EventDispatcherInterface::class);

        /** @var UrlGeneratorInterface|MockObject $router */
        $router = $this->createMock(UrlGeneratorInterface::class);

        /** @var TranslatorInterface|MockObject $translator */
        $translator = $this->createMock(TranslatorInterface::class);

        $builder = new SidebarMenuBuilder($dispatcher, $router, $translator);

        static::assertEquals('scriber_admin_panel.sidebar', $builder->getName());
    }

    public function testBuild()
    {
        $label = 'test';
        $route = '/test';
        $attributes = ['icon' => 'dashboard'];

        /** @var EventDispatcherInterface|MockObject $dispatcher */
        $dispatcher = $this->createMock(EventDispatcherInterface::class);

        /** @var UrlGeneratorInterface|MockObject $router */
        $router = $this->createMock(UrlGeneratorInterface::class);

        /** @var TranslatorInterface|MockObject $translator */
        $translator = $this->createMock(TranslatorInterface::class);

        $dispatcher
            ->expects(static::exactly(3))
            ->method('dispatch')
            ->withConsecutive(
                [SidebarMenuTopBuildEvent::class, static::isInstanceOf(SidebarMenuTopBuildEvent::class)],
                [SidebarMenuBottomBuildEvent::class, static::isInstanceOf(SidebarMenuBottomBuildEvent::class)],
                [SidebarMenuFinishBuildEvent::class, static::isInstanceOf(SidebarMenuFinishBuildEvent::class)]
            );

        $translator
            ->expects(static::once())
            ->method('trans')
            ->with('sidebar.label.dashboard', [], 'admin')
            ->willReturn($label);

        $router
            ->expects(static::once())
            ->method('generate')
            ->with('scriber_admin_panel_dashboard')
            ->willReturn($route);

        $builder = new SidebarMenuBuilder($dispatcher, $router, $translator);
        $result = $builder->build();

        static::assertInstanceOf(MenuItemInterface::class, $result);
        static::assertEquals('scriber_admin_panel.sidebar', $result->getTitle());

        $children = $result->getChildren();
        static::assertCount(1, $children);

        $child = reset($children);

        static::assertEquals($label, $child->getTitle());
        static::assertEquals($route, $child->getLink());
        static::assertEquals($attributes, $child->getAttributes());
    }
}
