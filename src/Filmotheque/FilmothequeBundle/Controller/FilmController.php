<?php

namespace Filmotheque\FilmothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Filmotheque\FilmothequeBundle\Entity\Categorie;
use Filmotheque\FilmothequeBundle\Entity\Acteur;
use Filmotheque\FilmothequeBundle\Form\ActeurType;

class ActeurController extends Controller
{
    public function ajouterAction()
    {
        // on apple l'entitie manager
        $em         = $this->getDoctrine()->getManager();
        // On crée un objet acteur
        $acteur     = new Acteur();   
        $form       = $this->createForm(new ActeurType, $acteur);
        // création de la requette
        $request    = $this->get('request');
        if($request ->getMethod() == "POST")
        {
            $form   ->bind($request);
            if($form->isValid())
            {
                $em ->persist($acteur);
                $em ->flush();
                return $this->redirect($this->generateUrl('acteur_liste'));
            }
        }
        
        return $this ->render('FilmothequeBundle:Acteur:ajouter.html.twig', array('form' => $form->createView()));
        
    }
    
    /*Affichage  des acteurs
     *
     */
    public function listerAction()
    {
        // appel de l'entity manager
        $em      = $this->getDoctrine()->getManager();
        // on crée un objet
        $acteurs = new Acteur();
        //Appel du repository        
        $acteurs = $em->getRepository('FilmothequeBundle:Acteur')->findAll();

        return $this->render('FilmothequeBundle:Acteur:lister.html.twig', array('acteurs' => $acteurs));
    }
    
    public function modifierAction($id)
    {
        if($id == null )
        {
            throw $this->createNotFoundException('Acteur inexistant');
        }
        
        $em      = $this->getDoctrine()->getManager();
        // recuperation de l'acteur dans la base
        $acteur  = $em->getRepository('FilmothequeBundle:Acteur')->find($id);
        // creation du formulaire 
        $form    = $this->createForm(new ActeurType(), $acteur);
        //création de la requette
        $request = $this->get('request');
        // vérification de la methode
        
        if($request     ->getMethod() == 'POST')
        {
            // lié le formulaire a la requete
            $form    ->bind($request);
            
            if($form ->isValid())
            {
                $em  ->perist($acteur);
                $em  ->flush();
                
                return redirect($this->generateUrl('FilmothequeBundle:Acteur:index.html.twig'));
            }
            
        }
        //pour modifier on prend l'id de l'acteur et on appel un formulaire aussi avec create view
        return $this  ->render('FilmothequeBundle:Acteur:ajouter.html.twig', array(
                                                                                    'id' => $id,
                                                                                   'form' => $form->createView() ));

    }
    
    /*
     *Suppression
     *
     */
    
    public function supprimerAction($id)
    {
        if($id == null)
        {
            throw NotFoundHttpException('Acteur inexistant');
        }
        //entity
        $em     = $this->getDoctrine()->getManager();
        //recupération de l'acteur
        $acteur = $em->getRepository('FilmothequeBundle:Acteur')->find($id);
        //suppression 
        $em     ->remove($acteur);
        $em     ->flush();

        return  $this->redirect($this->generateUrl('acteur_liste'));
    }
    
    public function editerAction($id = null)
    {
          // vérification de la validité de l'id
          if(!isset($id) )
          {
            //on crée un nouvel acteur
            $acteur = new Acteur();
            // l'id est null: soit c'est un formulaire vide soit elle a des requete
            $em      = $this->getDoctrine()->getManager();
            //On exécute l'ajout de formulaire
            $form    = $this->createForm(New ActeurType(), $acteur);
            // on recuper la requette en cours
            $request = $this->get('request');
            //vérifier
            if($request->getMethod() == 'POST')
            {
                $form->bind('request');
                if($form->isValid())
                {
                    $em->persist($acteur);
                    $em->flush();
                    
                    return $this->redirect(generateUrl('acteur_list'));
                }
            }
            // s'il n'y a pas de requette donc c'est get
            return $this->render('FilmothequeBundle:Acteur:ajouter.html.twig', array('form'=> $form->createView()));
            
          }else
          {
            //si le id est valide donc nous sommes dans le cas de la modification
            
            $em      = $this-> getDoctrine()->getManager();
            //il faut recuperer l'id de l'utisateur
            $acteur  = $em->getRepository('FilmothequeBundle:Acteur')->find($id);
            //on recupere les l'id del'acteur  du repository
            $form    = $this->createForm(new ActeurType(), $acteur);
            // on requepere la requette
            $request = $this->get('request');
            // Condition de validation vérifier si la requete est get ou POST
            if($request->getMethod() == 'POST')
            {
                $form->bind($request);
                // si le formulaire est valide
                if($form->isValid())
                {
                    //C'est une donnée a enrégistré
                    
                    $em->persist($acteur);
                    $em->flush();
                    
                    return $this->redirect(generateUrl('acteur_list'));
                }
                
            }
            // si c'est une requete get on fait le modification
            return $this->render('FilmothequeBundle:Acteur:ajouter.html.twig', array('id' => $id,
                                                                                     'form' => $form->createView()));
            
            
            
          }
    }
    
}
