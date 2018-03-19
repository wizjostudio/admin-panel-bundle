<?php
namespace Wizjo\Bundle\AdminPanelBundle\Event;

use Rzeka\Menu\MenuItemInterface;
use Symfony\Component\EventDispatcher\Event;

abstract class AbstractMenuBuildEvent extends Event
{
    /**
     * @var MenuItemInterface
     */
    private $menu;

    public function __construct(MenuItemInterface $menu)
    {
        $this->menu = $menu;
    }

    /**
     * @return MenuItemInterface
     */
    public function getMenu(): MenuItemInterface
    {
        return $this->menu;
    }
}
