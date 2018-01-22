<?php
namespace Scriber\Bundle\AdminPanelBundle\Tests;

use PHPUnit\Framework\TestCase;
use Scriber\Bundle\AdminPanelBundle\ScriberAdminPanelBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ScriberAdminPanelBundleTest extends TestCase
{
    public function testInstanceOfBundle()
    {
        $bundle = new ScriberAdminPanelBundle();

        static::assertInstanceOf(Bundle::class, $bundle);
    }
}
