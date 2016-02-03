<?php

namespace Filmotheque\FilmothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Filmotheque\FilmothequeBundle\Entity\Categorie;


class DefaultController extends Controller
{
    public function indexAction()
    {
        // on apple l'entitie manager
        $em = $this->getDoctrine()->getManager();
        // on instantie l'objet
        $categorie = new Categorie();
        $categorie->setNom('comedie');
        // on persist pour le valider
        $em->persist($categorie);
        
        //autre
        $categorie1 = new Categorie();
        $categorie1->setNom('Fiction');
        $em->persist($categorie1);
        
        // on enrégistre avec  flush

        $em->flush();
        
        $message = 'Les catégories on été enrégistré avec sussces';
        //$this->get('session')->getFlashBag()->add('Les catégories ont été ajoutté avec succes!');
        
        
        
        return $this->render('FilmothequeBundle:Default:index.html.twig', array('message' => $message));
    }
    
    
    
    
    
}
