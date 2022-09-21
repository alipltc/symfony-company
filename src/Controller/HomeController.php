<?php

namespace App\Controller;

use App\Entity\Admin\Mesaj;
use App\Repository\Admin\KonuRepository;
use App\Repository\Admin\MenuRepository;
use App\Repository\Admin\SettingRepository;
use App\Form\Admin\MesajType;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Crypto\SMimeEncrypter;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(KonuRepository $konuRepository,MenuRepository $menuRepository,SettingRepository $settingRepository):Response
    {
        $menulist = $menuRepository->findBy(['parentid' => 0, 'status'=>'True']);
        $catlist = $konuRepository->findBy(['menu_id' => 1]);
        $catlist3 = $konuRepository->findBy(['menu_id' => 3]);
        $catlist4 = $konuRepository->findBy(['menu_id' => 4]);
        $data= $settingRepository->findAll();
        return $this->render('home/index.html.twig', [
            'catlist' => $catlist,
            'catlist3' => $catlist3,
            'catlist4' => $catlist4,
            'menulist' => $menulist,
            'data' => $data,
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/Kurumsal", name="Kurumsal")
    */
    public function Kurumsal(KonuRepository $konuRepository,MenuRepository $menuRepository):Response
    {
        $catlist = $konuRepository->findBy(['menu_id' => 1, 'status'=>'True']);
        $catlist3 = $konuRepository->findBy(['menu_id' => 3, 'status'=>'True']);
        $catlist4 = $konuRepository->findBy(['menu_id' => 4, 'status'=>'True']);
        $menulist = $menuRepository->findBy(['parentid' => 0, 'status'=>'True']);
        return $this->render('home/Kurumsal.html.twig', [
            'catlist' => $catlist,
            'catlist3' => $catlist3,
            'catlist4' => $catlist4,
            'menulist' => $menulist,
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/Cozumlerimiz", name="Cozumlerimiz")
     */
    public function Cozumlerimiz(KonuRepository $konuRepository,MenuRepository $menuRepository):Response
    {
        $catlist = $konuRepository->findBy(['menu_id' => 1, 'status'=>'True']);
        $catlist3 = $konuRepository->findBy(['menu_id' => 3, 'status'=>'True']);
        $catlist4 = $konuRepository->findBy(['menu_id' => 4, 'status'=>'True']);
        $menulist = $menuRepository->findBy(['parentid' => 0, 'status'=>'True']);
        return $this->render('home/Cozumlerimiz.html.twig', [
            'catlist' => $catlist,
            'catlist3' => $catlist3,
            'catlist4' => $catlist4,
            'menulist' => $menulist,
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/Hizmetlerimiz", name="Hizmetlerimiz")
     */
    public function Hizmetlerimiz(KonuRepository $konuRepository,MenuRepository $menuRepository):Response
    {
        $catlist = $konuRepository->findBy(['menu_id' => 1, 'status'=>'True']);
        $catlist3 = $konuRepository->findBy(['menu_id' => 3, 'status'=>'True']);
        $catlist4 = $konuRepository->findBy(['menu_id' => 4, 'status'=>'True']);
        $menulist = $menuRepository->findBy(['parentid' => 0, 'status'=>'True']);
        return $this->render('home/Hizmetlerimiz.html.twig', [
            'catlist' => $catlist,
            'catlist3' => $catlist3,
            'catlist4' => $catlist4,
            'menulist' => $menulist,
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/Referanslarimiz", name="Referanslarimiz")
     */
    public function Referanslarimiz(KonuRepository $konuRepository,MenuRepository $menuRepository):Response
    {
        $catlist = $konuRepository->findBy(['menu_id' => 1, 'status'=>'True']);
        $catlist3 = $konuRepository->findBy(['menu_id' => 3, 'status'=>'True']);
        $catlist4 = $konuRepository->findBy(['menu_id' => 4, 'status'=>'True']);
        $menulist = $menuRepository->findBy(['parentid' => 0, 'status'=>'True']);
        return $this->render('home/Referanslarimiz.html.twig', [
            'catlist' => $catlist,
            'catlist3' => $catlist3,
            'catlist4' => $catlist4,
            'menulist' => $menulist,
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/iletisim", name="iletisim", methods={"GET","POST"})
     */
    public function iletisim(KonuRepository $konuRepository,MenuRepository $menuRepository,SettingRepository $settingRepository,Request $request, MailerInterface $mailer):Response
    {
        $mesaj = new Mesaj();
        $form = $this->createForm(MesajType::class, $mesaj);
        $form->handleRequest($request);
        $submittedToken = $request->request->get('token');
        $setting=$settingRepository->findAll();


        if ($form->isSubmitted()) {
            if ($this->isCsrfTokenValid('form-mesaj', $submittedToken)) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($mesaj);
                $entityManager->flush();
                $this->addFlash('success','Mesajınız İletilmiştir,Teşekkürler!');

                $email = (new Email())
                    ->from('bluetechweb@bluetechbilgisayar.com')
                    ->to('alipltc@hotmail.com',$form['email']->getData())
                    //->cc('cc@example.com')
                    //->bcc('bcc@example.com')
                    //->replyTo('fabien@example.com')
                    //->priority(Email::PRIORITY_HIGH)
                    ->subject('Bluetech Bilgisayar Site Mesajı')
                    //->text('Sending emails is fun again!')
                    ->html("Sayın ".$form['name']->getData()." mesajınız gönderildi(www.bluetechbilgisayar.com)"."<br>
                            <p>Mesaj tarafımıza iletildi.Teşekkürler</p>
                            Mesaj İçeriği <br>
                            ----------------------------------------------------------
                            <br>Mesajı Gönderen Email:<br> ".$form['email']->getData()." <br>
                            <br>Mesajı Gönderenin Telefonu:<br> ".$form['phone']->getData()." <br>
                            <br>Mesajı Gönderenin Konusu:<br> ".$form['konu']->getData()." <br>
                            <br>Mesajı Gönderenin Mesajı:<br> ".$form['mesaj']->getData()." <br>
                            ----------------------------------------------------------
                            <br>".$setting[0]->getCompany()." <br>
                            Adres: ".$setting[0]->getAddress()."<br>
                            Telefon: ".$setting[0]->getPhone()."<br>
                            ".$setting[0]->getContact()."<br>"


                    );
                $mailer->send($email);

                $entityManager->remove($mesaj);
                $entityManager->flush();

                return $this->redirectToRoute('iletisim');
            }
        }

        $data= $settingRepository->findAll();
        $catlist = $konuRepository->findBy(['menu_id' => 1, 'status'=>'True']);
        $catlist3 = $konuRepository->findBy(['menu_id' => 3, 'status'=>'True']);
        $catlist4 = $konuRepository->findBy(['menu_id' => 4, 'status'=>'True']);
        $menulist = $menuRepository->findBy(['parentid' => 0, 'status'=>'True']);
        return $this->render('home/iletisim.html.twig', [

            'catlist' => $catlist,
            'catlist3' => $catlist3,
            'catlist4' => $catlist4,
            'menulist' => $menulist,
            'data' => $data,
            'form' => $form->createView(),
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     *  @Route("{menu_id}/{url}", name="konudetail")
     */
    public function konudetail($url,KonuRepository $konuRepository,MenuRepository $menuRepository,SettingRepository $settingRepository):Response
    {
        $data= $konuRepository->findBy(['url' => $url]);

        $catlist = $konuRepository->findBy(['menu_id' => 1, 'status'=>'True']);
        $catlist3 = $konuRepository->findBy(['menu_id' => 3, 'status'=>'True']);
        $catlist4 = $konuRepository->findBy(['menu_id' => 4, 'status'=>'True']);
        $menulist = $menuRepository->findBy(['parentid' => 0, 'status'=>'True']);
        //dump($data);
        //die();
        return $this->render('home/konudetail.html.twig', [

            'catlist' => $catlist,
            'catlist3' => $catlist3,
            'catlist4' => $catlist4,
            'menulist' => $menulist,
            'data' => $data,
            'controller_name' => 'HomeController',

        ]);

    }

}

