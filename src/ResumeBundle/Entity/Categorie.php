<?php

namespace ResumeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ResumeBundle\Entity\Texte;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="ResumeBundle\Repository\CategorieRepository")
 */
class Categorie {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;


    ////  extern

    /**
     * 
     * 
     * @ORM\ManyToMany(targetEntity="ResumeBundle\Entity\Texte", mappedBy="cat", cascade={"persist"})
     * 
     */
    private $textes;

    public function getTextes() {
        return $this->textes;
    }

    public function setTextes($textes) {
        $this->textes = $textes;
        return $this;
    }

////  extern fin

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Categorie
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->textes = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->textes = $textes;
    }

    /**
     * Add texte
     *
     * @param \ResumeBundle\Entity\Texte $texte
     *
     * @return categorie
     */
    public function addTexte(\ResumeBundle\Entity\Texte $texte) {
        $this->textes[] = $texte;

        return $this;
    }

    /**
     * Remove texte
     *
     * @param \ResumeBundle\Entity\Texte $texte
     */
    public function removeTexte(\ResumeBundle\Entity\Texte $texte) {
        $this->textes->removeElement($texte);
    }

}
