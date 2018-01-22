<?php
namespace Scriber\Bundle\AdminPanelBundle\Tests\Controller;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Scriber\Bundle\AdminPanelBundle\Controller\LoginController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginControllerTest extends TestCase
{
    public function testInvoke()
    {
        /** @var \Twig_Environment|MockObject $twig */
        $twig = $this->createMock(\Twig_Environment::class);

        /** @var AuthenticationUtils|MockObject $authUtils */
        $authUtils = $this->createMock(AuthenticationUtils::class);

        $templateFile = '@ScriberAdminPanel/login.html.twig';
        $username = 'test';
        $error = 'error';

        $template = sprintf(
            '<html><body>Username: %s, Error: %s</body>',
            $username,
            $error
        );

        $twig
            ->expects(static::once())
            ->method('render')
            ->with($templateFile)
            ->willReturn($template);

        $controller = new LoginController($twig, $authUtils);
        $result = $controller();

        static::assertInstanceOf(Response::class, $result);
        static::assertEquals($template, $result->getContent());
    }
}
