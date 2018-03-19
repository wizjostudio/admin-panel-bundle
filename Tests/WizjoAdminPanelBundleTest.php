<?php
namespace Wizjo\Bundle\AdminPanelBundle\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Wizjo\Bundle\AdminPanelBundle\WizjoAdminPanelBundle;

class WizjoAdminPanelBundleTest extends TestCase
{
    public function testInstanceOfBundle()
    {
        $bundle = new WizjoAdminPanelBundle();

        static::assertInstanceOf(Bundle::class, $bundle);
    }
}
