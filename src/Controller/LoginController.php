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

                if ($this->checkIfUserExists($form->getData())) {
                    return $this->redirectToRoute('app_existing_user');
                } else {
                    return $this->redirectToRoute('app_choose_present');
                }
            }
            return $this->render('login/index.html.twig', [
                'form' => $form->createView(),
            ]);
        }

    
    #[Route('/', name: 'app')]
        public function GoToLogin(): Response
        {
            return $this->redirectToRoute('app_login');
        }

    private function checkIfUserExists(array $data): bool
    {
        $filePath = '/Users/jillwets/Downloads/rodeDuivelsFanProject/public/fan_artikel_2024.csv';

        if (($file = fopen($filePath, 'r')) !== false) {
            while (($line = fgetcsv($file)) !== false) {
                if ($data['geboortedatum']->format('Y-m-d') === $line[1] && $data['lidnummer'] === $line[2]) {
                    fclose($file);
                    return true;
                }
            }
            fclose($file);
        } else {
            return false;
        }
        return false;
    }
}