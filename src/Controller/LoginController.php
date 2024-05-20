<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserDataType;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(UserDataType::class); 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
            $session = $request->getSession();
            $session->set('userData', $form->getData());
            return $this->redirectToRoute('app_choose_present'); 
        }

        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
            'form' => $form->createView(), 
        ]);
    }
}
