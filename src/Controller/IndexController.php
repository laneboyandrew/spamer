<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    /**
     * @Route("/", name="welcome", methods={"GET"})
     * @param Environment $twig
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function showIndexPage(Environment $twig)
    {
        $content = $twig->render('base.html.twig');
        $response = new Response();
        $response->setContent($content);
        return $response;
    }
}