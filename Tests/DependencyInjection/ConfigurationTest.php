<?php
namespace Scriber\Bundle\AdminPanelBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Scriber\Bundle\AdminPanelBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class ConfigurationTest extends TestCase
{
    public function testGetConfigTreeBuilder()
    {
        $root = 'scriber_admin_panel';

        $configuration = new Configuration();

        $result = $configuration->getConfigTreeBuilder();
        $nameResult = $result->buildTree()->getName();

        static::assertInstanceOf(TreeBuilder::class, $result);
        static::assertEquals($root, $nameResult);
    }
}
