<?php

namespace ResumeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ResumeBundle\Entity\Categorie;
use ResumeBundle\Entity\Experience;
use ResumeBundle\Entity\Skill;
use ResumeBundle\Entity\Texte;

class DefaultController extends Controller {

    /**
     * @Route("/index", name="symfony")
     */
    public function indexAction() {
        return $this->render('ResumeBundle:Default:index.html.twig');
    }

    /**
     * @Route("/test", name="testtemplate")
     */
    public function testAction() {
        return $this->render('default/test.html.twig');
    }

    /**
     * @Route("/", name="home")
     */
    public function homeAction(Request $request) {


        ///  LES TEXTES //////////////
        $cat = 4;
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('ResumeBundle:Categorie');

        $sect = new Categorie;
        $sect = $rep->find($cat);
        $textes = $sect->getTextes();
        ///////  FIN TEXTES  ///////////////////////////
        //////***********************////////////
        /////   LES 3 DERNIERES EXP + EXP ///////////////////



        $rep = $em->getRepository('ResumeBundle:Experience');
        $exps = $rep->getLastExp(3);

        ///////////  FIN 3 EXP + EXP  ///////////////
        //////***********************////////////
        /////     SKILLS    //////////////////
        $rep = $em->getRepository('ResumeBundle:Skill');
        $skills = $rep->findAll();
        ////  FIN SKILLS  ////////////////

        return $this->render('default/home.html.twig', array('textes' => $textes, 'exps' => $exps, 'skills' => $skills));
    }

    /**
     * @Route("/{id}", name="detail", requirements={"id":"\d+"})
     */
    public function detailAction(Request $request, $id) {


        ///  LES TEXTES //////////////
        $cat = 4;
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('ResumeBundle:Categorie');

        $sect = new Categorie;
        $sect = $rep->find($cat);
        $textes = $sect->getTextes();
        ///////  FIN TEXTES  ///////////////////////////
        //////***********************////////////
        /////   L' EXP ///////////////////



        $rep = $em->getRepository('ResumeBundle:Experience');
        $exp = $rep->findOneById($id);

        ///////////  FIN EXP  ///////////////
        //////***********************////////////
        /////     SKILLS    //////////////////
        $rep = $em->getRepository('ResumeBundle:Skill');

        $skills = $exp->getSkills();
        ////  FIN SKILLS  ////////////////



        return $this->render('default/experience.html.twig', array('textes' => $textes, 'exp' => $exp, 'skills' => $skills));
    }

    /**
     * @Route("/cv/{skill}", name="byskill")
     */
    public function expBySkill(Request $request, $skill) {

        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('ResumeBundle:Skill');

        $sect = new Skill;
        $sect = $rep->find($skill);
        $exp = $sect->getExperiences();


        $skills = $exp->getSkills();

        var_dump($exp);

        return $this->render('default/cv.html.twig', array('experiences' => $exp, 'skills' => $skills));
    }

}
