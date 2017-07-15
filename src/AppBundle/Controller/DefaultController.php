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

    /**
     * @Route("/covoiturage", name="default_carpooling")
     */
    public function carpoolingAction(Request $request)
    {
        $topic = new CarpoolingTopic();
        $topicForm = $this->createForm(CarpoolingTopicType::class, $topic);

        $topicForm->handleRequest($request);
        $doctrine = $this->getDoctrine();
        $topics = $doctrine->getRepository(CarpoolingTopic::class)->findAllOrderedByDate();

        if ($topicForm->isValid()) {
            $topic->setPostedAt(new \DateTime());

            $entityManager = $doctrine->getManager();
            $entityManager->persist($topic);
            $entityManager->flush();

            $flashMessage = CarpoolingTopic::CARPOOLING_REQUEST === $topic->getOfferOrRequest() ?
                'Votre demande de covoiturage a bien été enregistrée !' :
                'Votre proposition de covoiturage a bien été enregistrée !';

            $this->addFlash('success', $flashMessage);

            return $this->redirectToRoute('default_carpooling');
        }

        return $this->render('default/carpooling.html.twig', [
            'form'   => $topicForm->createView(),
            'topics' => $topics,
        ]);
    }

    /**
     * @Route("/covoiturage/{id}", name="default_carpooling_topic")
     */
    public function carpoolingTopicAction(CarpoolingTopic $carpoolingTopic, Request $request)
    {
        $message = new CarpoolingMessage();
        $messageForm = $this->createForm(CarpoolingMessageType::class, $message);

        $messageForm->handleRequest($request);
        $doctrine = $this->getDoctrine();
        $messages = $doctrine->getRepository(CarpoolingMessage::class)->findForTopicOrderedByDate($carpoolingTopic);

        if ($messageForm->isValid()) {
            $message->setPostedAt(new \DateTime());
            $message->setCarpoolingTopic($carpoolingTopic);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            $flashMessage = 'Votre message a bien été enregistré !';

            $this->addFlash('success', $flashMessage);

            return $this->redirectToRoute('default_carpooling_topic', ['id' => $carpoolingTopic->getId()]);
        }

        return $this->render('default/carpoolingTopic.html.twig', [
            'topic' => $carpoolingTopic,
            'form'  => $messageForm->createView(),
        ]);
    }
}
