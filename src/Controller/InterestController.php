<?php

namespace App\Controller;

use App\Entity\Interest;
use App\Form\InterestFormType;
use App\Repository\InterestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InterestController extends AbstractController
{

    private $em;
    private $interestRrepo;

    public function __construct(InterestRepository $repo, EntityManagerInterface $em)
    {
        $this->interestRrepo = $repo;
        $this->em = $em;
    }


    #[Route('/interest-edit/{id}', name: 'interest-edit')]
    public function edit($id, Request $request): Response
    {
        $interest = $this->interestRrepo->find($id);
        $form = $this->createForm(InterestFormType::class, $interest);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $interest->setName($form->get('name')->getData());
            $interest->setDescription($form->get('description')->getData());

            $this->em->flush();

            // $next = $request->request->get('next');
            // return $this->redirect('/profiles/' . $next);
            return $this->redirect('/profiles/' . $interest->getProfile()->getId());

        }

        return $this->render('interest/interest.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/interest-create', name:'interest-create')]
    public function create(Request $request)
    {
        $interest = new Interest();
        $form = $this->createForm(InterestFormType::class, $interest);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $newInterest = $form->getData();

            $newInterest->setProfile($this->getUser()->getProfile());

            // $newInterest->setProfile($next);

            $this->em->persist($newInterest);
            $this->em->flush();

            $next = $request->request->get('next');
            return $this->redirect('/profiles/' . $next);     
            

        }

        return $this->render('interest/interest.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/interest-delete/{id}', name: 'interest-delete', methods: ["GET", "DELETE"])]
    public function delete ($id) : Response
    {
        $interest = $this->interestRrepo->find($id);
        $this->em->remove($interest);

        $this->em->flush();

        return $this->redirect('/profiles/' . $interest->getProfile()->getId());
    }








}
