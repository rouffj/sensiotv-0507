<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/secretPageForEditors")
     */
    public function page1(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EDITOR');

        return new Response('<h1>Secret page for editors</h1>');
    }
}