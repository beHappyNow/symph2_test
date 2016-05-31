<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number/{count}", defaults={"count" = 3},
     *      requirements={"page": "\d+"})
     *
     * @Method ({"POST", "GET"})
     * @param int $count
     * @param Request $request
     *
     * @return mixed
    */
    public function numberAction($count, Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $resp = new Response('<h1>AJAX</h1>');
            return $resp;
        }

        $name = null;

        if (!empty($request->request->get('name'))) {
            $name = $request->request->get('name');
        }

        $session = $request->getSession();

        $foobar = $session->get('number');

        // store an attribute for reuse during a later user request
        $numbers = [];
        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        }
        $numbersList = implode(', ', $numbers);
        $session->set('number', $numbersList);

        $numbersList .= ' <!> '.$request->query->get('id')."  _Last time your lucky numbers was: $foobar  ";

        $this->addFlash(
            'notice',
            'Your changes were saved!'
        );

        return $this->render(
            'lucky/number.html.twig',
            array('luckyNumberList' => $numbersList, 'name' => $name != null ? $name : null)
        );
    }

    /**
     * @Route("/api/lucky/number", name="apinumber")
     */
    public function apiNumberAction()
    {
        $data = array(
            'lucky_number' => rand(0, 100),
        );

        return new JsonResponse($data);
    }


    /**
     * @Route("/ajax/test", name="ajax_test")
     */
    public function ajaxTestAction()
    {
        $arr = ['id' => '1','name' => 'keyboard','price' => '43.55','description' => 'description',];
        echo json_encode($arr);
        die();
    }

}