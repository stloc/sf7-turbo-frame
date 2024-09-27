<?php

namespace App\Controller;

use App\Form\TestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(): Response
    {


        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',

        ]);
    }

    #[Route('/_form', name: 'app_form')]
    public function form(Request $request): Response
    {
        $form = $this->createForm(TestType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('app_form');
        }

        return $this->render('default/form.html.twig', [
            'form' => $form
        ]);
    }
}
