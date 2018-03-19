<?php
namespace Wizjo\Bundle\AdminPanelBundle\Tests\Controller;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Wizjo\Bundle\AdminPanelBundle\Controller\AdminPanelController;
use Symfony\Component\HttpFoundation\Response;

class AdminPanelControllerTest extends TestCase
{
    public function testInvoke()
    {
        /** @var \Twig_Environment|MockObject $twig */
        $twig = $this->createMock(\Twig_Environment::class);

        $templateFile = 'test';
        $template = '<html><body>test</body>';

        $twig
            ->expects(static::once())
            ->method('render')
            ->with($templateFile)
            ->willReturn($template);

        $controller = new AdminPanelController($twig);
        $result = $controller($templateFile);

        static::assertInstanceOf(Response::class, $result);
        static::assertEquals($template, $result->getContent());
    }
}
