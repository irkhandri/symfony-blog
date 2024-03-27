<?php

namespace App\Controller;

use App\Repository\BlogRepository;
use App\Entity\Blog;
use App\Entity\User;
use App\Form\BlogFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    private $em;
    private $blogRepo;
    public function __construct(BlogRepository $blogRepo, EntityManagerInterface $em)
    {

        $this->blogRepo = $blogRepo;
        $this->em = $em;
    }

    #[Route('/', name: 'blogs')] //, defaults:['name' => null], methods:['GET', 'HEAD'])]
    public function index(Request $request): Response
    {
        // findAll() -> SELECT * FROM blogs
        // find() -> select * from blogs where id=
        //findBy() -> select * from blogs order by DESC
        // findOneBy() -> select * from blogs where id = and title = " "
        // count() -> select count() from blogs where id= 

        $some_query = '';
        if ($request->query->has('some_query'))
            $some_query = $request->get('some_query');
        
        $blogs = !$some_query ? $this->blogRepo->findAll() : $this->blogRepo->findBySearchQuery($some_query);
        


    //    $blogs = $this->blogRepo->findAll();

       $context = [
            'blogs' => $blogs
       ];
        // dd($blogs);
        return $this->render('blogs/blogs.html.twig', $context );
    }

    #[Route('/blogs/create', name: 'create_blog')]
    public function create(Request $request): Response
    {
        $blog = new Blog();
        $form = $this->createForm(BlogFormType::class, $blog);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newBlog = $form->getData();

            // $user = $this->getUser();
            // $newBlog->setProfile($user->getProfile());

            $newBlog->setProfile($this->getUser()->getProfile());



            $this->em->persist($newBlog);
            $this->em->flush();

            return $this->redirectToRoute('blogs');
            
        }

        return $this->render('blogs/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/blogs/edit/{id}', name: 'edit_blog')]
    public function edit($id, Request $request) : Response 
    {
        $blog = $this->blogRepo->find($id);
        $form = $this->createForm(BlogFormType::class, $blog);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $blog->setTitle($form->get('title')->getData());
            $blog->setDescription($form->get('description')->getData());
            $blog->setImageUrl($form->get('imageUrl')->getData());

            $this->em->flush();
            return $this->redirectToRoute('blogs');
        }

        return $this->render('blogs/create.html.twig', [
            // 'blog' => $blog,
            'form' => $form->createView()
        ]);
    }

    #[Route('/blogs/delete/{id}', methods: ['GET', 'DELETE'], name: 'delete_blog')]
    public function delete($id) : Response
    {
        $blog = $this->blogRepo->find($id);
        $this->em->remove($blog);

        $this->em->flush();

        return  $this->redirectToRoute('blogs');
        
    }

    #[Route('/blogs/{id}', methods:['GET'],  name: 'blog')] //, defaults:['name' => null], methods:['GET', 'HEAD'])]
    public function blog($id): Response
    {
       $context = [
            'blog' => $this->blogRepo->find($id)
       ];
        return $this->render('blogs/blog.html.twig', $context );
    }

    
}
