<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Task;
use AppBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class MyFirstFormController extends Controller
{
    /**
     * @Route("/mff/mff", name="mff")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function firstAction(Request $request)
    {
        $article = new Article();
        $task = new Task();

        $form = $this->createForm(ArticleType::class, $article);

//        $form = $this->createFormBuilder([$article,$task])
//        $form = $this->createFormBuilder($article, [
//            'validation_groups' => ['registration']
////            'validation_groups' => ['reuse']
//                   ])->add('title',TextType::class,['label'=>'Title$'])
//                     ->add('body',TextareaType::class)
//                     ->add('date',DateTimeType::class)
////                     ->add('date',DateTimeType::class,['widget'=>'single_text'])
//                     ->add('published',RadioType::class)
//                     ->add('country', CountryType::class)
//                     ->add('save_Article',SubmitType::class,['label'=>'Submit'])
////                     ->add('task',TextType::class)
////                     ->add('dueDate',DateType::class)
////                     ->add('save_Task',SubmitType::class,['label'=>'Submit'])
//                     ->getForm();

        $form->handleRequest($request);

        $subm = $form->isSubmitted();
        $valid = $form->isValid();

        if ($subm && $valid) {
            return $this->redirectToRoute('app_lucky_number');
        }
        $formView = $form->createView();

        return $this->render('mff\mff.html.twig',['form'=>$formView]);
    }

    /**
     * @Route("/mff/contact", name="mfcont")
     * @param Request $request
     * @return Response
     */
    public function contactAction(Request $request)
    {
        $defaultData = array('message' => 'Type your message here');
        $form = $this->createFormBuilder($defaultData)
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
        }
        $formView = $form->createView();

        return $this->render('mff\mff.html.twig',['form'=>$formView]);
        // ... render the form
    }
}