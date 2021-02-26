<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Oferta;
use AppBundle\Entity\Dokumenta;
use AppBundle\Entity\Tender;
use AppBundle\Form\OfertaType;
use AppBundle\Forms\TenderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OfertaController extends  Controller
{


    /**
     * @Route("/ofertim/{id}", name="oferto")
     */
    public function shikoDetajet(Request $request,Tender $tender,EntityManagerInterface  $entityManager)
    {

        if( ($this->get('session')->get('loginUserId') != null )
//            && ($this->get('session')->get('roleId') != 4)
             ){
            $user = $this->get('session')->get('loginUserId');
            $oferta = new Oferta();
            $dokument = new Dokumenta();
            $form = $this->createForm(OfertaType::class);
            $form->handleRequest($request);
            if($form->isValid() && $form->isSubmitted()){

                $entityManager = $this->getDoctrine()->getManager();
                $oferta->setAdresaDorezimit($form->get('adresaDorezimit')->getData());
                $oferta->setPershkrimi($form->get('pershkrimi')->getData());
                $oferta->setVlefta($form->get('vlefta')->getData());
                $oferta->setCreatedBy($user);
                $oferta->setTenderId($tender->getId());
                $oferta->setIsDeleted(0);
                $oferta->setVendimi('shqyrtim');
                
                $entityManager->persist($oferta);
                $entityManager->flush();
                //file upload
                $uploads_directory=$this->getParameter('uploads_directory');
                $files = $request->files->get('oferta')['document'];
                foreach ($files as $file){
                    $dokument = new Dokumenta();
                    $filename=md5(uniqid()).'.'.$file->guessExtension();
                    $file->move($uploads_directory,$filename);
                    $dokument->setTitullDokumenti($filename);
                    $dokument->setOfertaId($oferta->getId());
                    $dokument->setPath($file);
                    $dokument->setIsDeleted(0);
                    $dokument->setCreatedBy($user);
                    $entityManager->persist($dokument);
                    $entityManager->flush();
                }
                return $this->redirectToRoute('buletini');

            }

        }
        else{
            return $this->redirectToRoute('homepage');
        }        
 return $this->render('oferta/aplikim.html.twig',[
                'form' => $form->createView(),
                'tender'=>$tender ]);
    }
    /**
     * @Route("/ofertat_e_mia", name="ofertat_e_mia")
     */
    public function shikoOfertateMia(Request $request,EntityManagerInterface  $entityManager)
    {
        if(($this->get('session')->get('loginUserId') != null) && ($this->get('session')->get('roleId') !=4)){
            $biznesId = $this->get('session')->get('loginUserId');
            $repository = $entityManager->getRepository(Oferta::class);

            $ofertaQuery="SELECT oferta.id as ofertaId, 
oferta.vlefta as VleraOferte, 
                tender.emer_statusi as statusTender, 
                tender.data_perfundimit as dataMbylljeTender, 
                oferta.vendimi as vendimi, 
                tender.titull_thirrje as titullTender, 
                biznes.id From oferta 
                inner join tender on oferta.tender_id=tender.id 
                inner join biznes on oferta.created_by=biznes.id 
                where oferta.created_by=:biznesId
                and  oferta.is_deleted=0;" ;
            $statement = $entityManager->getConnection()->prepare($ofertaQuery);

            $statement->execute(array('biznesId' => $biznesId));
            $ofertat = $statement->fetchAll();

        }
        else{
            return $this->redirectToRoute('homepage');
        }
        return $this->render('oferta/ofertatemia.html.twig',[
            'oferta' =>$ofertat
        ]);
    }


    /**
     * @Route("/modifikoOferten/{id}", name="Modifiko_Oferten")
     */
    public function modifikoOferten(Request $request, Oferta $oferte)
    {

        if(($this->get('session')->get('loginUserId') != null) && ($this->get('session')->get('roleId') !=4))
        {
        $form = $this->createForm(OfertaType::class, $oferte);
        $form->handleRequest($request);



        if($form->isSubmitted() && $form->isValid()){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($oferte);
            $entityManager->flush();


            $uploads_directory = $this->getParameter('uploads_directory');
            $files = $request->files->get('edito_form')['my_files'];
            $oferteid = $oferte->getId();

            foreach ($files as $file)
            {
                $dokumenta = new Dokumenta();
                $filename= $file->getClientOriginalName();
                $file->move(
                    $uploads_directory,
                    $filename);
                $RAW_QUERY2 = "UPDATE dokumenta SET dokumenta.titull_dokumenti = 
                                '$filename' , dokumenta.path= '$uploads_directory'
                              WHERE dokumenta.oferta_id = '$oferteid' ";
                $statement = $entityManager->getConnection()->prepare($RAW_QUERY2);
                $statement->execute();
            }


            return $this->redirectToRoute('Oferte_e_detajuar');
            //return $this->render('Oferta/showoferta.html.twig');
        }
        return $this->render('Oferta/showoferta.html.twig', array(
            'form' => $form->createView()));
        }

        else{
            return $this->redirectToRoute('homepage');
        }

    }
    /**
     * @Route("/fshiOferten/{id}/fshi", name="fshiOferten")
     */
    public function fshiOferten (Request $request,Oferta $oferta,EntityManagerInterface  $entityManager)
    {
        if (($this->get('session')->get('loginUserId') != null) && ($this->get('session')->get('roleId') != 4)) {
            $entityManager->getRepository(Oferta::class);
            $oferta->setIsDeleted(1);
            $entityManager->persist($oferta);
            $entityManager->flush();
            return $this->redirectToRoute('ofertat_e_mia');
        } else {
            return $this->redirectToRoute('homepage');
        }
    }

}