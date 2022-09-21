<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Mesaj;
use App\Form\Admin\MesajType;
use App\Repository\Admin\MesajRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/mesaj")
 */
class MesajController extends AbstractController
{
    /**
     * @Route("/", name="admin_mesaj_index", methods={"GET"})
     */
    public function index(MesajRepository $mesajRepository): Response
    {
        return $this->render('admin/mesaj/index.html.twig', [
            'mesajs' => $mesajRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_mesaj_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mesaj = new Mesaj();
        $form = $this->createForm(MesajType::class, $mesaj);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mesaj);
            $entityManager->flush();

            return $this->redirectToRoute('admin_mesaj_index');
        }

        return $this->render('admin/mesaj/new.html.twig', [
            'mesaj' => $mesaj,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_mesaj_show", methods={"GET"})
     */
    public function show(Mesaj $mesaj): Response
    {
        return $this->render('admin/mesaj/show.html.twig', [
            'mesaj' => $mesaj,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_mesaj_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mesaj $mesaj): Response
    {
        $form = $this->createForm(MesajType::class, $mesaj);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_mesaj_index');
        }

        return $this->render('admin/mesaj/edit.html.twig', [
            'mesaj' => $mesaj,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_mesaj_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Mesaj $mesaj): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mesaj->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mesaj);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_mesaj_index');
    }
}
