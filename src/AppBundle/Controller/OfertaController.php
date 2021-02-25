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
        if( ($this->get('session')->get('loginUserId') != null ) && ($this->get('session')->get('roleId') != 4) ){
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
            }

                return $this->redirectToRoute('buletini');
        }  
        else{
            return $this->redirectToRoute('homepage');
        }        
        return $this->render('oferta/aplikim.html.twig',[
            'form' => $form->createView(),
            'tender'=>$tender
        ]);

    }
    /**
     * @Route("/ofertat_e_mia", name="ofertat_e_mia")
     */
    public function shikoOfertateMia(Request $request,EntityManagerInterface  $entityManager)
    {
        if(($this->get('session')->get('loginUserId') != null) && ($this->get('session')->get('roleId') !=4)){
            $biznesId = $this->get('session')->get('loginUserId');
            $repository = $entityManager->getRepository(Oferta::class);

            $oferta= $repository->createQueryBuilder('q')
                ->andWhere('q.createdBy=:val')
                ->setParameter('val', $biznesId)
                ->andWhere('q.isDeleted=0')
                ->getQuery()
                ->getResult();
        }
        else{
            return $this->redirectToRoute('homepage');
        }
        return $this->render('oferta/ofertatemia.html.twig',[
            'oferta' =>$oferta
        ]);
    }
}