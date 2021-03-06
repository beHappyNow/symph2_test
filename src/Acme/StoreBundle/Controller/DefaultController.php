<?php

namespace Acme\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Acme\StoreBundle\Document\Product;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AcmeStoreBundle:Default:index.html.twig');
    }

    /**
     * @Route("/createmongo", name="create_mongo_product")
     * @return Response
     */
    public function createAction()
    {
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($product);
        $dm->flush();

        return new Response('Created product id '.$product->getId());
    }

    /**
     * @Route("/showm/{id}", name="showm_product")
     * @return Response
     */
    public function showAction($id)
    {
        $product = $this->get('doctrine_mongodb')
            ->getRepository('AcmeStoreBundle:Product')
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        // do something, like pass the $product object into a template

        return $this->render("default/show.html.twig",["product" => $product]);
        // ... do something, like pass the $product object into a template
    }
}
