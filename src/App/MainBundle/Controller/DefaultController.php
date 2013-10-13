<?php

namespace App\MainBundle\Controller;

use App\MainBundle\Form\FeedbackType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $page = $this->get('rid.page.repository.page')->getOneBySlug('homepage');

        /** @var \Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository $repository */
        $repository = $this->get('app.repository.category');
        $categories = $repository->findTop()->getQuery()->execute();

        return $this->render('AppMainBundle:Default:index.html.twig'
            ,array(
               'categories' => $categories,
                'slides' => $this->get('app.repository.slide')->findAll()
            )
        );
    }

    public function renderCategoryMenuAction()
    {
        /** @var \Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository $repository */
        $repository = $this->get('app.repository.category');
        $categories = $repository->findTop()->getQuery()->execute();

        return $this->render('AppMainBundle:Default/partials:_category_menu.html.twig',
            array('categories' => $categories)
        );
    }

    public function feedbackAction()
    {
        $form = $this->getFeedbackForm();
        $form->handleRequest($this->getRequest());
        if (!$form->isValid()){
            return $this->render('AppMainBundle:Default:feedbackForm.html.twig', array(
                'formView' => $form->createView()
            ));
        }
        $data = $form->getData();

        $message = \Swift_Message::newInstance()
            ->setSubject("Вопрос от пользователя {$data['name']}")
            ->setFrom('robot@technodevice.com.ua')
            ->setTo($this->container->getParameter('admin_email'))
            ->setBody(
                $this->get('templating')->render('AppMainBundle:Default/partials:_feedback_mail.txt.twig', array(
                    'data' => $data
                ))
//                ,'text/html'
            )
        ;

        $ns = array();
        $mailer = $this->get('mailer');
        $mailer->send($message, $ns);
//        $spool = $mailer->getTransport()->getSpool();
//        $transport = $this->get('swiftmailer.transport.real');
//        $spool->flushQueue($transport);
//        var_dump($ns);
//        die;
        $this->addFlash('notice', 'Сообщение отправлено.');

        return $this->redirect($this->generateUrl('app_main_feedback_form'));
    }

    public function feedbackFormAction()
    {
        return $this->render('AppMainBundle:Default:feedbackForm.html.twig', array(
            'formView' => $this->getFeedbackForm()->createView()
        ));
    }

    protected function getFeedbackForm()
    {
        return $this->createForm(new FeedbackType(), null, array(
            'action' => $this->generateUrl('app_main_feedback'),
            'method' => 'POST'
        ));
    }

    public function addFlash($type, $message)
    {
        $this->get('session')
            ->getFlashBag()
            ->add($type, $this->get('translator')->trans($message, array(), 'AppMainBundle'));
    }
}
