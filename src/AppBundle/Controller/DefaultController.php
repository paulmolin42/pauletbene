<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CarpoolingMessage;
use AppBundle\Entity\CarpoolingTopic;
use AppBundle\Form\CarpoolingMessageType;
use AppBundle\Form\CarpoolingTopicType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default_index")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/messe-de-mariage", name="default_nuptial_mass")
     */
    public function nuptialMassAction()
    {
        return $this->render('default/nuptialMass.html.twig');
    }

    /**
     * @Route("/reception", name="default_reception")
     */
    public function receptionAction()
    {
        return $this->render('default/reception.html.twig');
    }

    /**
     * @Route("/liste-de-mariage", name="default_wedding_list")
     */
    public function weddingListAction()
    {
        return $this->render('default/weddingList.html.twig');
    }

    /**
     * @Route("/hebergement", name="default_accommodation")
     */
    public function sundayBrunchAction()
    {
        return $this->render('default/accommodation.html.twig');
    }
}
