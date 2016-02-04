<?php

namespace Filmotheque\FilmothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Filmotheque\FilmothequeBundle\Entity\Categorie;
use Filmotheque\FilmothequeBundle\Entity\Acteur;
use Filmotheque\FilmothequeBundle\Entity\Film;
use Filmotheque\FilmothequeBundle\Form\ActeurType;
use Filmotheque\FilmothequeBundle\Form\FilmType;

class FilmController extends Controller
{
    /*Ajout d'un film
     */
    public function ajouterAction()
    {
        // entity manager
        $em      = $this->getDoctrine()->getManager();
        //création d'un objet
        $film    = new Film();
        //création d'un formulaire
        $form    = $this->createForm(new FilmType(), $film);
        //création de l'objet requete
        $request = $this->get('request');
        //vérification si la requete est une requete get ou POST
        if($request->getMethod() == 'POST')
        {
            // si la condition est  on lié la requete au formulaire
            $form->bind($request);
            // vérification si le formulaire est valide
            if($form->isValid())
            {
                //On persist
                $em->persist($film);
                //On flush
                $em->flush();
                // on fait une redirection vers la page des listes
                return $this->redirect($this->generateUrl('film_liste'));
                
            }
        }
        return $this->render('FilmothequeBundle:Film:ajouter.html.twig', array('form' => $form->createview()));
    }
    
    /*Affichage  des acteurs
     */
    public function listerAction()
    {
        //entity manager
        $em    = $this->getDoctrine()->getManager();
        //recupérer les données
        $films = $em->getRepository('FilmothequeBundle:Film')->findAll();
        //affichage dans la vue *
        return $this->render('FilmothequeBundle:Film:lister.html.twig', array('films' => $films));
    }
    
    public function modifierAction($id)
    {
        //creé l'entity manager
        $em      = $this->getDoctrine()->getManager();
        //recupérer le id du film
        $film    = $em->getRepository('FilmothequeBundle:Film')->find($id);
        // création du formulaire
        $form    = $this->createForm(new FilmType(), $film );
        //On vérifie si une requete est envoyé
        $request = $this->get('request');
        // vérification si c'est une get ou un post
       if($request->getMethod() == 'POST')
       {// on fait une liaison entre le formulaire et la requete
        $form->bind($request);
        // on verifie la valididité du formulaire
        if($form->isValid() )
        {   // on perisst
            $em->persist($film);
            //on flush
            $em->flush();    
            return $this->redirect($this->generateUrl('Film_liste'));
        }
       }  
    }
    
    /*
     *Suppression
     */
    public function supprimerAction($id)
    {
        // vérifiction de l'existance de l'id du film
        if(!isset($id))
        {
            throw $this->createNotFoundException('film inexistant');  
        }
       // entity
       $em   = $this->getDoctrine()->getManager();
       //recuperé l'id dans le repository
       $film = $em->getRepository('FilmothequeBundle:Film')->find($id);
       // on procede a la suppression
       $em  ->remove($film);
       // on régistre par un flush
       $em  ->flush();
    }
    
    public function editerAction($id = null)
    {
        // vérification de l'existance de l'id
        if(isset($id))
        {
            // existance de l'id donc on procede a la modification
            $em = $this->getDoctrine()->getManager();
            // création du formulaire
            $form = $this->createForm(new FilmType(), $film );
            //recupếration de l'id du repository
            $film = $em->getRepository('FilmothequeBundle:Film')->find($id);
            // vérification de la requete
            $request = $this->get('request');
             // vérification si la requete est get ou post
             if ($request->getMethod() == 'POST')
             {    //on lie le formulaire et la requete
                  $form->bind($request);
                 // vérification de la validité du formulaire
                if($request->isValid())
                {
                    //on persist
                    $em->persist($film);
                    //on flush
                    $em->flush();
                    // on fait une redirection
                    return $this->rediect($this->generateUrl('film_list'));   
                }  
             }
             return $this->render('FilmothequeBundle:Film:ajouter.html.twig', array('form'=> $form->createView(),
                                                                                    'id'   => $id ));
        }else
        {
                // id inexistant
                $em      = $this->getDoctrine()->getManager();
                //instantiation d'un objet
                $film    = new Film();
                //création d'un formulaire
                $form    = $this->createForm(new FilmType(), $film );
                // vérification  de la requete
                $request ->get('request');
                //vérification si c'est un get ou post
                if($request->getMehod() == 'POST')
                {
                    // on lie le formulaire et la requete
                       $form->bind($request);
                    // vérification de la validité du formulaire
                    if($form->isValid())
                    {
                        $em->persist($film);
                        // on flush
                        $em->flush();
                        // redirection vers les vues liste
                        return $this->redirect(generateUrl('film_list'));
                    }
                }
                return $this->render('FilmothequeBundle:Film:ajouter.html.twig', array('form' => $form->createView()));
        }
    }
    
}
