<?php

namespace App\Controller;

use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function register(): Response
    {
        $form = $this->createForm(RegisterType::class, ['first_name' => 'Joseph']);
        $form->add('register', Type\SubmitType::class, ['label' => 'Create your SensioTV account']);

        return $this->render('security/register.html.twig', [
            'register_form' => $form->createView()
        ]);
    }
}
