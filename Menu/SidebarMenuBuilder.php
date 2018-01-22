<?php
namespace Scriber\Bundle\AdminPanelBundle\Menu;

use Rzeka\Menu\MenuItem;
use Rzeka\Menu\MenuItemInterface;
use Rzeka\MenuBundle\Menu\MenuBuilderInterface;
use Scriber\Bundle\AdminPanelBundle\Event\SidebarMenuBottomBuildEvent;
use Scriber\Bundle\AdminPanelBundle\Event\SidebarMenuFinishBuildEvent;
use Scriber\Bundle\AdminPanelBundle\Event\SidebarMenuTopBuildEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Translation\TranslatorInterface;

class SidebarMenuBuilder implements MenuBuilderInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @param EventDispatcherInterface $eventDispatcher
     * @param UrlGeneratorInterface $router
     * @param TranslatorInterface $translator
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, UrlGeneratorInterface $router, TranslatorInterface $translator)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->router = $router;
        $this->translator = $translator;
    }

    public function build(): MenuItemInterface
    {
        $menu = new MenuItem($this->getName());

        $this->eventDispatcher
            ->dispatch(
                SidebarMenuTopBuildEvent::class,
                new SidebarMenuTopBuildEvent($menu)
            );

        $dashboard = MenuItemFactory::createNewItem(
            $this->translator->trans('sidebar.label.dashboard', [], 'admin'),
            $this->router->generate('scriber_admin_panel_dashboard'),
            ['icon' => 'dashboard']
        );
        $menu->addChild($dashboard);

        $this->eventDispatcher
            ->dispatch(
                SidebarMenuBottomBuildEvent::class,
                new SidebarMenuBottomBuildEvent($menu)
            );

        $this->eventDispatcher
            ->dispatch(
                SidebarMenuFinishBuildEvent::class,
                new SidebarMenuFinishBuildEvent($menu)
            );

        return $menu;
    }

    public function getName(): string
    {
        return 'scriber_admin_panel.sidebar';
    }
}
