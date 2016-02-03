<?php

namespace Filmotheque\FilmothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

 


/**
 * Film
 *
 * @ORM\Table(name="film")
 * @ORM\Entity(repositoryClass="Filmotheque\FilmothequeBundle\Entity\FilmRepository")
 */
class Film
{
    
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank()
     */
    private $description;

    
    /**
     *@ORM\ManyToOne(targetEntity="Categorie")
     *@Assert\NotBlank()
     *
     */
     private $categories;
     
     /**
      *@ORM\ManyToMany(targetEntity="Acteur")
      */
     private $acteurs;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Film
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Film
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->acteurs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set categories
     *
     * @param \Filmotheque\FilmothequeBundle\Entity\Categorie $categories
     * @return Film
     */
    public function setCategories(\Filmotheque\FilmothequeBundle\Entity\Categorie $categories = null)
    {
        $this->categories = $categories;
    
        return $this;
    }

    /**
     * Get categories
     *
     * @return \Filmotheque\FilmothequeBundle\Entity\Categorie 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add acteurs
     *
     * @param \Filmotheque\FilmothequeBundle\Entity\Acteur $acteurs
     * @return Film
     */
    public function addActeur(\Filmotheque\FilmothequeBundle\Entity\Acteur $acteurs)
    {
        $this->acteurs[] = $acteurs;
    
        return $this;
    }

    /**
     * Remove acteurs
     *
     * @param \Filmotheque\FilmothequeBundle\Entity\Acteur $acteurs
     */
    public function removeActeur(\Filmotheque\FilmothequeBundle\Entity\Acteur $acteurs)
    {
        $this->acteurs->removeElement($acteurs);
    }

    /**
     * Get acteurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActeurs()
    {
        return $this->acteurs;
    }
}