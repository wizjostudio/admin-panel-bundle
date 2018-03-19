<?php
namespace Wizjo\Bundle\AdminPanelBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class AdminPanelController
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param string $_template
     *
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(string $_template): Response
    {
        return new Response(
            $this->twig->render($_template)
        );
    }
}
