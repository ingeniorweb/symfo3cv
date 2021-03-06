<?php

namespace ResumeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * skill
 *
 * @ORM\Table(name="skill")
 * @ORM\Entity(repositoryClass="\ResumeBundle\Repository\SkillRepository")
 */
class Skill {

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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="niveau", type="integer")
     */
    private $niveau;



    //// xtern

    /**
     * 
     * 
     * @ORM\ManyToMany(targetEntity="ResumeBundle\Entity\Experience", mappedBy="skills")
     * 
     */
    private $experiences;

    public function getExperiences() {
        return $this->experiences;
    }

    public function setExperiences($experiences) {
        $this->experiences = $experiences;
        return $this;
    }

    /// extern

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
     * @return skill
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
     * Set niveau
     *
     * @param integer $niveau
     *
     * @return skill
     */
    public function setNiveau($niveau) {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return int
     */
    public function getNiveau() {
        return $this->niveau;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->experiences = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add experience
     *
     * @param \ResumeBundle\Entity\Experience $experience
     *
     * @return skill
     */
    public function addExperience(\ResumeBundle\Entity\Experience $experience) {
        $this->experiences[] = $experience;

        return $this;
    }

    /**
     * Remove experience
     *
     * @param \ResumeBundle\Entity\Experience $experience
     */
    public function removeExperience(\ResumeBundle\Entity\Experience $experience) {
        $this->experiences->removeElement($experience);
    }

}
