<?php
namespace Scriber\Bundle\AdminPanelBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    /**
     * @param \Twig_Environment $twig
     * @param AuthenticationUtils $authenticationUtils
     */
    public function __construct(\Twig_Environment $twig, AuthenticationUtils $authenticationUtils)
    {
        $this->twig = $twig;
        $this->authenticationUtils = $authenticationUtils;
    }

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(): Response
    {
        $error = $this->authenticationUtils->getLastAuthenticationError();
        $username = $this->authenticationUtils->getLastUsername();

        return new Response(
            $this->twig->render(
                '@ScriberAdminPanel/login.html.twig',
                [
                    'username' => $username,
                    'error' => $error
                ]
            )
        );
    }
}
