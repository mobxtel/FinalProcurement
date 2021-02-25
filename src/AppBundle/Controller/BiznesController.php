<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Role;
use AppBundle\Form\LoginAdminType;
use AppBundle\Form\UserRegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Biznes;

class BiznesController extends Controller
{
    /**
     * @Route("/regjistohu", name="regjistohu")
     */
    public function registerBiznesAction(Request $request)
    {
        $biznes = new Biznes();
        $form = $this->createForm(UserRegisterType::class, $biznes);
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()){
        
           $logo = $form->get('logo')->getData();
           $originalFilename = pathinfo($logo->getClientOriginalName(), PATHINFO_FILENAME);
           $newFilename = $originalFilename.'-'.uniqid().'.'.$logo->guessExtension();
           $logo->move($this->getParameter('logo_directory'), $newFilename);
           $entityManager = $this->getDoctrine()->getManager();
           $biznes->setEmerBiznesi($form->getData()->getEmerBiznesi());
           $biznes->setRoleId(3);
           $biznes->setEmail($form->getData()->getEmail());
           $biznes->setNipt($form->getData()->getNipt());
           $biznes->setAdresa($form->getData()->getAdresa());
           $biznes->setLogo($newFilename);
           $biznes->setNumerTelefoni($form->getData()->getNumerTelefoni());
           $biznes->setPassword(base64_encode($form->getData()->getPassword()));
           $biznes->setAktiv(0);
           $biznes->setIsDeleted(0);
           $biznes->setPaguar(1);
           if ($this->get('session')->get('loginUserId') != null){
               $biznes->setCreatedBy($this->get('session')->get('loginUserId'));
           }
           $entityManager->persist($biznes);
           $entityManager->flush();
         return $this->redirectToRoute('login');
        }

        return $this->render('regjistrim.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {
        $this->get('session')->clear();
        return $this->redirectToRoute('publicHomepage');
    }
    /**
     * @Route("/publicHomepage", name="publicHomepage")
     */
    public function indexPublic(Request $request)
    {
        return $this->renderView('public/index.html.twig');
    }
}
