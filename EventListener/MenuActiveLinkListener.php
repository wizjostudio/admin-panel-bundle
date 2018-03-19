<?php
namespace Wizjo\Bundle\AdminPanelBundle\EventListener;

use Wizjo\Bundle\AdminPanelBundle\Event\AbstractMenuBuildEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuActiveLinkListener
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function onMenuFinish(AbstractMenuBuildEvent $event)
    {
        $request = $this->requestStack->getCurrentRequest();
        $path = $request->getPathInfo();

        foreach ($event->getMenu()->getChildren() as $child) {
            if ($child->getLink() === $path) {
                $child->setActive(true);
            }
        }
    }
}
