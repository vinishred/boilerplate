<?php

namespace App\Controller;

use App\Entity\Marque;
use App\Form\MarqueType;
use App\Repository\MarqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MarqueController extends AbstractController
{
    // On veut faire un CRUD
    // On définit nos routes avec nos méthodes
    #[Route('/marque', name: 'marque_index', methods: ['GET'])]
    public function index(MarqueRepository $marqueRepository): Response
    {
        // On peut utiliser notre repository
        $marques = $marqueRepository->findAll();
        return $this->render('marque/index.html.twig', [
            'title' => 'Marque',
            'marques' => $marques,
        ]);
    }

    #[Route('/marque/{id}', name: 'marque_show', requirements: ['id' => '\d+'], priority: 10, methods: ['GET'])]
    public function show(Marque $marque): Response
    {
        return $this->render('marque/show.html.twig', [
            'title' => 'details',
            'marque' => $marque,
        ]);
    }

    #[Route('/marque/create', name: 'marque_create', methods: ['GET', 'POST'])]
    public function create(Request $request, MarqueRepository $marqueRepository): Response
    {
        $marque = new Marque();

        $form = $this->createForm(MarqueType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $marqueRepository->save($marque, true);
            return $this->redirectToRoute('marque_index');
        }

        return $this->render('marque/create.html.twig', [
            'title' => 'creation',
            'formView' => $form->createView(),
        ]);
    }

    #[Route('/marque/{id}/update', name: 'marque_update', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function update(): Response
    {
        return $this->render('marque/index.html.twig', [
            'controller_name' => 'MarqueController',
        ]);
    }

    #[Route('/marque/{id}/delete', name: 'marque_delete', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function delete(): Response
    {
        return $this->render('marque/index.html.twig', [
            'controller_name' => 'MarqueController',
        ]);
    }
}
