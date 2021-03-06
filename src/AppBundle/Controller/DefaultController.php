<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/add", name="add_product")
     * * @return Response
     */
    public function createAction()
    {
        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    /**
     * @Route("/show/{productId}", name="show_product")
     * @param int $productId
     * @return Response
     */
    public function showAction($productId)
    {
//        $repository = $this->getDoctrine()
//            ->getRepository('AppBundle:Product');
//        var_dump($repository);die();

        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->find($productId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }

        return $this->render("default/show.html.twig",["product" => $product]);
        // ... do something, like pass the $product object into a template
    }


    /**
     * @Route("/create", name="create_product")
     * @return Response
     */
    public function createProductAction()
    {
        $category = new Category();
        $category->setName('Computer Peripherals');

        $product = new Product();
        $product->setName('Earphones');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        // relate this product to the category
        $product->setCategory($category);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();

        return new Response(
            'Saved new product with id: '.$product->getId()
            .' and new category with id: '.$category->getId()
        );
    }

    /**
     * @Route("/savefile", name="save_file")
     * @param Request $request
     * @return Response
     */
    public function saveFileAction( Request $request)
    {
        $uploaded = $request->files->get('file');
        var_dump($uploaded);

        $someNewFilename = $uploaded->getClientOriginalName();
        $moved = $uploaded->move('/home/dev49/www/symf.loc/web/img/', $someNewFilename);

        var_dump($moved);

        $product = new Product();
        $form = $this->createFormBuilder($product)
            ->add('imageFile', FileType::class)
            ->getForm();

        $form->handleRequest($request);
        var_dump($form['imageFile']->getData());die();

//        $uploaded->move('/home/dev49/www/symf.loc/web/img/', $someNewFilename);


        $category = new Category();
        $category->setName('file upload TEST');
        $product->setName('Earphones');
        $product->setImageName('imageFile');
        $product->setPrice(33.65);
        $product->setDescription('file upload test!');


        // relate this product to the category
        $product->setCategory($category);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();
        $product->upload();
        var_dump($product->getImageFile());
        die();

        return new Response(
            'Saved new product with id: '.$product->getId()
            .' and new category with id: '.$category->getId()
        );
    }

}
