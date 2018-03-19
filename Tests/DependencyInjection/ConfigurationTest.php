<?php
namespace Wizjo\Bundle\AdminPanelBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Wizjo\Bundle\AdminPanelBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class ConfigurationTest extends TestCase
{
    public function testGetConfigTreeBuilder()
    {
        $root = 'wizjo_admin_panel';

        $configuration = new Configuration();

        $result = $configuration->getConfigTreeBuilder();
        $nameResult = $result->buildTree()->getName();

        static::assertInstanceOf(TreeBuilder::class, $result);
        static::assertEquals($root, $nameResult);
    }
}
