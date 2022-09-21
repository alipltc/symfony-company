<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Konu;
use App\Form\Admin\KonuType;
use App\Repository\Admin\KonuRepository;
use App\Repository\Admin\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/konu")
 */
class KonuController extends AbstractController
{
    /**
     * @Route("/", name="admin_konu_index", methods={"GET"})
     */
    public function index(KonuRepository $konuRepository): Response
    {
        return $this->render('admin/konu/index.html.twig', [
            'konus' => $konuRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_konu_new", methods={"GET","POST"})
     */
    public function new(Request $request,MenuRepository $menuRepository): Response
    {
        $menus=$menuRepository->findAll();
        $konname=$menuRepository->findBy(
            ['id' => 0]
        );
        $konu = new Konu();
        $form = $this->createForm(KonuType::class, $konu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($konu);
            $entityManager->flush();
            $this->addFlash('success','Kayıt Ekleme Başarılı!');
            return $this->redirectToRoute('admin_konu_index');
        }

        return $this->render('admin/konu/new.html.twig', [
            'konu' => $konu,
            'menus' => $menus,
            'konname' => $konname,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_konu_show", methods={"GET"})
     */
    public function show(Konu $konu): Response
    {
        return $this->render('admin/konu/show.html.twig', [
            'konu' => $konu,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_konu_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Konu $konu,MenuRepository $menurepository): Response
    {
        $menus = $menurepository->findAll();
        $konname = $menurepository->findBy(['id' => $konu->getMenuId()]);
        $form = $this->createForm(KonuType::class, $konu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Kayıt Güncelleme Başarılı!');
            return $this->redirectToRoute('admin_konu_index');
        }

        return $this->render('admin/konu/edit.html.twig', [
            'konu' => $konu,
            'menus' => $menus,
            'konname' => $konname,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/iedit", name="admin_konu_iedit", methods={"GET","POST"})
     */
    public function iedit(Request $request,$id, Konu $konu): Response
    {
        $form = $this->createForm(KonuType::class, $konu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_konu_index');
        }

        return $this->render('admin/konu/iedit.html.twig', [
            'konu' => $konu,
            'id' => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/iupdate", name="admin_konu_iupdate", methods="POST")
     */
    public function iupdate(Request $request,$id , Konu $konu): Response
    {
        $form = $this->createForm(KonuType::class, $konu);
        $form->handleRequest($request);
        $file =$request->files->get('imagename');
        $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
        // Move the file to the directory where brochures are stored
        try {
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }
        $konu->setImage($fileName);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('admin_konu_iedit', [
            'id' => $konu->getId()]);
    }


    /**
     * @Route("/{id}", name="admin_konu_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Konu $konu): Response
    {
        if ($this->isCsrfTokenValid('delete'.$konu->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($konu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_konu_index');
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

}
