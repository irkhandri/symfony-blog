<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageFormType;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProfileRepository;


class MessageController extends AbstractController
{

    private $em;
    private $messageRepo;
    private $profileRepo;

    public function __construct(MessageRepository $repo, ProfileRepository $profileRepo, EntityManagerInterface $em)
    {
        $this->messageRepo = $repo;
        $this->em = $em;
        $this->profileRepo = $profileRepo;
    }

    #[Route('/message/{id}', name: 'message')]
    public function index($id): Response
    {
        $message = $this->messageRepo->find($id);

        $profile = $this->getUser()->getProfile();

        if ($profile !== $message->getSender())
        {
            $message->setIsRead(true);
            $this->em->flush();
        }

        $context = [
            'mess' => $message
        ];

        return $this->render('message/index.html.twig', $context );
    }


    #[Route('/input-messages', name: 'input_messages')]
    public function input () : Response
    {
        $profile = $this->getUser()->getProfile();
        // $in_box = $this->messageRepo->findOneBy()
        // $in_box = $profile->getMessagesReceived();

        $in_box = $this->messageRepo->findBy(['recipient' => $profile], ['is_read' => 'ASC']);
        $unreadMessages = $this->messageRepo->count(['is_read' => false, 'recipient' => $profile]);

        // $unreadMessages = $in_box->count(['is_read' => 'false']);
        // dd($in_box);
        // echo $in_box[0]->getText();

        $context = [
            'messages' => $in_box,
            'page' => 'in',
            'unread' =>  $unreadMessages//$unreadMessages->count()
        ];
        return $this->render('message/input_message.html.twig', $context );
    }

    #[Route('/output-messages', name: 'output_messages')]
    public function output () : Response
    {
        $profile = $this->getUser()->getProfile();
        $out_box = $profile->getMessagesSent();
        $context = [
            'messages' => $out_box,
            'page' => 'out'
        ];
        return $this->render('message/input_message.html.twig', $context );
    }


    #[Route('/create-message/{id}', methods:['GET', "POST"], name:'create_message')]
    public function create(Request $request, $id)
    {
        $message = new Message();
        $form = $this->createForm(MessageFormType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            // echo "edwdwe!!!!!!!!!!!!!";
            $newMessage = $form->getData();
            if ($this->getUser())
            {
                $user_id = $this->getUser()->getId();
                $sender = $this->profileRepo->find($user_id);
                $newMessage->setSender($sender);
                $newMessage->setEmail($sender->getEmail());
                $newMessage->setName($sender->getName());
            }
            else 
            {

            }
            $recipient = $this->profileRepo->find($id);
            $newMessage->setRecipient($recipient);
            $newMessage->setIsRead(false);

            $createdDateTime = new \DateTime('now');

            $newMessage->setCreated($createdDateTime);
            // dd($newMessage);


            $this->em->persist($newMessage);
            $this->em->flush();

            // $newMessage->
            // dd($newMessage);

            if ($this->getUser())
                return $this->redirectToRoute('input_messages');
            else 
                return $this->redirectToRoute('profiles');

        }

        return $this->render ('message/create.html.twig', [
            'form' => $form->createView()
        ]);
    }



}
