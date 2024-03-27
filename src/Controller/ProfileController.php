<?php

namespace App\Controller;

use App\Form\BlogFormType;
use App\Form\ProfileFormType;
use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{

    private $em;
    private $profileRepo;
    public function __construct(ProfileRepository $profileRepo, EntityManagerInterface $em)
    {
        $this->profileRepo = $profileRepo;
        $this->em = $em;
    }


    #[Route('/profiles', methods: ['GET'], name: 'profiles')]
    public function index(Request $request): Response
    {
        $some_query = '';

        if ($request->query->has('some_query'))
            $some_query =$request->get('some_query');
            // dd($query);
        

        if (!$some_query)
            $profiles = $this->profileRepo->findAll();
        else 
            $profiles = $this->profileRepo->findBySearchQuery($some_query);

        $context = [
            'profiles' => $profiles
        ];

        return $this->render('profile/profiles.html.twig', $context);
    }

    #[Route('/profiles/{id}', methods:['GET'], name:'profile')]
    public function profile($id) : Response
    {
        $profile = $this->profileRepo->find($id);

        $context = [
            'profile' => $profile
        ];

        return $this->render('profile/profile.html.twig', $context);
    }

    #[Route('/profiles/edit/{id}')]
    public function edit($id, Request $request) : Response
    {
        $profile = $this->profileRepo->find($id);
        $form = $this->createForm(ProfileFormType::class, $profile);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $profile->setName($form->get('name')->getData());
            $profile->setUsername($form->get('username')->getData());
            $profile->setLocation($form->get('location')->getData());
            $profile->setNumber($form->get('number')->getData());
            $profile->setSocFacebook($form->get('soc_facebook')->getData());
            $profile->setSocLinkedin($form->get('soc_linkedin')->getData());
            $profile->setImageUrl($form->get('imageUrl')->getData());
            $profile->setIntro($form->get('intro')->getData());
            $profile->setBio($form->get('bio')->getData());

            $this->em->flush();

            // EDIT !!!
            return $this->redirectToRoute('profiles');
        }
        return $this->render('profile/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }




}
