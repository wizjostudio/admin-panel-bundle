<?php
namespace Scriber\Bundle\AdminPanelBundle\Menu;

use Rzeka\Menu\MenuItem;
use Rzeka\Menu\MenuItemInterface;
use Rzeka\MenuBundle\Menu\MenuBuilderInterface;
use Scriber\Bundle\AdminPanelBundle\Event\TopMenuBuildEvent;
use Scriber\Bundle\AdminPanelBundle\Event\TopMenuFinishBuildEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class TopMenuBuilder implements MenuBuilderInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function build(): MenuItemInterface
    {
        $menu = new MenuItem($this->getName());
        $menu->setChildren([]);

        $this->eventDispatcher
            ->dispatch(
                TopMenuBuildEvent::class,
                new TopMenuBuildEvent($menu)
            );

        $this->eventDispatcher
            ->dispatch(
                TopMenuFinishBuildEvent::class,
                new TopMenuFinishBuildEvent($menu)
            );

        return $menu;
    }

    public function getName(): string
    {
        return 'scriber_admin_panel.top';
    }
}
