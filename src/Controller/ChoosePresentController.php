<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PresentsType;
use Symfony\Component\HttpFoundation\Request;

class ChoosePresentController extends AbstractController
{
    #[Route('/choose/present', name: 'app_choose_present')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(PresentsType::class); 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
            $session = $request->getSession();
            $userData = $session->get('userData');
            $cadeau = $form->get('choiceField')->getData();
            $lidnummer = $request->getSession()->get('userData')['lidnummer'];
            $geboortedatum = $request->getSession()->get('userData')['geboortedatum'];

            $this->saveStringToFile($geboortedatum, $lidnummer, $cadeau);

            return $this->redirectToRoute('app_confirmation'); 
        } else {
            $lidnummer = $request->getSession()->get('userData')['lidnummer'];
            $geboortedatum = $request->getSession()->get('userData')['geboortedatum'];
            $formattedGeboortedatum = $geboortedatum->format('Y-m-d');
            var_dump($formattedGeboortedatum, $lidnummer);
        }

        return $this->render('choose_present/index.html.twig', [
            'controller_name' => 'ChoosePresentController',
            'form' => $form->createView(),
        ]);
    }

    public function saveStringToFile($geboortedatum, $lidnummer, $cadeau): void
    {
        $file = fopen("fan_artikel_2024.csv", "a");
        $currentdate = date('Y-m-d H:i:s');
        $formattedGeboortedatum = $geboortedatum->format('Y-m-d');
        $string = $currentdate . "," . $formattedGeboortedatum . "," . $lidnummer . "," . $cadeau . "\n";
        fwrite($file, $string);
        fclose($file);
    }
}
