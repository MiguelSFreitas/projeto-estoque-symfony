<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class Categoria/CadastrarController extends AbstractController
{
    #[Route('/categoria/cadastrar', name: 'app_categoria_cadastrar')]
    public function index(): Response
    {
        return $this->render('categoria/cadastrar/index.html.twig', [
            'controller_name' => 'Categoria/CadastrarController',
        ]);
    }
}
