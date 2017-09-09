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
        $chants = [
            [
                'category' => 'Entrée',
                'name'     => 'Que vienne ton Règne',
                'url'      => 'https://www.youtube.com/watch?v=TaTDmFA5oEc',
            ],
            [
                'category' => 'Kyrie',
                'name'     => 'Messe de Saint Paul',
                'url'      => 'https://www.youtube.com/watch?v=nAQtQBPv31E',
            ],
            [
                'category' => 'Gloria',
                'name'     => 'Messe de Saint Paul',
                'url'      => 'https://www.youtube.com/watch?v=fHamkBtQ2zo',
            ],
            [
                'category' => 'Psaume',
                'name'     => 'Le Seigneur est ma Lumière et mon Salut',
                'url'      => 'https://www.youtube.com/watch?v=HuUXRfxZNBY',
            ],
            [
                'category' => 'Alleluia',
                'name'     => 'Messe de Saint Paul',
                'url'      => 'https://www.youtube.com/watch?v=6pkMFCMahcA',
            ],
            [
                'category' => 'Chant à l\'Esprit Saint',
                'name'     => 'Viens Esprit Saint, viens embraser nos cœurs',
                'url'      => 'https://www.youtube.com/watch?v=Ny87InnoYck',
            ],
            [
                'category' => 'Sanctus',
                'name'     => 'Messe de Saint Paul',
                'url'      => 'https://youtu.be/Lkvbs6MNPNE?t=50s',
            ],
            [
                'category' => 'Anamnèse',
                'name'     => 'Messe de Saint Paul',
                'url'      => 'https://youtu.be/Lkvbs6MNPNE?t=1m45s',
            ],
            [
                'category' => 'Agnus',
                'name'     => 'Messe de Saint Paul',
                'url'      => 'https://youtu.be/sKscHz_9Dqk',
            ],
            [
                'category' => 'Chant de Communion',
                'name'     => 'Venez, approchons-nous de la table du Christ',
                'url'      => 'https://www.youtube.com/watch?v=lzlg3AsLoAI',
            ],
            [
                'category' => 'Chant à la Vierge',
                'name'     => 'Regarde l\'étoile',
                'url'      => 'https://www.youtube.com/watch?v=0gAopdXol3A',
            ],
            [
                'category' => 'Chant de sortie',
                'name'     => 'Chantez avec moi le Seigneur',
                'url'      => 'https://www.youtube.com/watch?v=4qkq2Pbbp5w',
            ],
        ];

        return $this->render('default/nuptialMass.html.twig', [
            'chants' => $chants,
        ]);
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
