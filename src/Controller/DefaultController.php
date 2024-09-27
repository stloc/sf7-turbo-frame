<?php

namespace App\Controller;

use App\Form\TestType;
use Psr\Log\LoggerInterface;
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
    public function form(Request $request, LoggerInterface $logger): Response
    {
        $logger->info('init form');
        $form = $this->createForm(TestType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $logger->info('form submitted');
            return $this->redirectToRoute('app_form_end');
        }

        return $this->render('default/form.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/_form_end', name: 'app_form_end')]
    public function formEnd(LoggerInterface $logger): Response
    {
        $logger->info('form end');

        return $this->render('default/form_end.html.twig', [

        ]);
    }
}
