<?php

namespace App\Controller;

use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type as Type;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request): Response
    {
        $form = $this->createForm(RegisterType::class);
        $form->add('register', Type\SubmitType::class, ['label' => 'Create your SensioTV account']);

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid() && $form->get('terms')->getData()) {
            $user = $form->getData();
            dump($user);
            // Insert into DB
        }

        return $this->render('security/register.html.twig', [
            'register_form' => $form->createView()
        ]);
    }
}
