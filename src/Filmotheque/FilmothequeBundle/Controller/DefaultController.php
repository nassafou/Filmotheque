<?php

namespace Filmotheque\FilmothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Filmotheque\FilmothequeBundle\Entity\Categorie;
use Filmotheque\FilmothequeBundle\Entity\Acteur;

class DefaultController extends Controller
{
    public function indexAction()
    {
        
        
        return $this->render('FilmothequeBundle:Default:index.html.twig');
    }
    
    
    
    
    
}
