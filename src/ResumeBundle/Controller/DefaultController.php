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
     * @Route("/index")
     */
    public function indexAction() {
        return $this->render('ResumeBundle:Default:index.html.twig');
    }

    /**
     * @Route("/test")
     */
    public function testAction() {
        return $this->render('default/test.html.twig');
    }

    /**
     * @Route("/")
     */
    public function homeAction(Request $request) {

//        $nbParPage = Article::NB_ARTICLE;
        ///  LES TEXTES //////////////
        $cat = 4;
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('ResumeBundle:Categorie');
//        $textes = $rep->getTxtByCat($cat);

        $sect = new Categorie;
        $sect = $rep->find($cat);
        $textes = $sect->getTextes();



//        $nbarticles = count($articles);
//        $nombrePage = ceil($nbarticles / $nbParPage);
//        $extrait = $this->get('app.extrait');
//        foreach ($articles as $key => $article) {
//            $text = $extrait->genereExtrait($article->getcontenu());
//            $article->setExtrait($text);
//        }
        return $this->render('default/home.html.twig', array('textes' => $textes));




        $extrait = $this->setExtrait(text);


//$extrait = $this->get('CatalogueBundle.crop');
//        $texte = $extrait->cropTexte($article->getContenu());
//        $article->setExtrait($texte);
//        return $this->render('blog/index.html.twig', array('articles' => $articles, 'page' => $page,
//                    'nombrePage' => ceil(count($articles) / $nbParPage)));
//        return $this->render('default/home.html.twig');
        ///////  FIN TEXTES  /////////////////////////////////
    }

}
