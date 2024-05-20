<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ChoosePresentController extends AbstractController
{
    #[Route('/choose/present', name: 'app_choose_present')]
    public function index(): Response
    {
        return $this->render('choose_present/index.html.twig', [
            'controller_name' => 'ChoosePresentController',
        ]);
    }
}
