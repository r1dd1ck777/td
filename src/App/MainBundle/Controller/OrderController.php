<?php

namespace App\MainBundle\Controller;

use App\MainBundle\Entity\Order;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends BaseCardController
{
    const SESSION_ORDER = 'app.order.id';

    // register or login
    public function checkout1Action()
    {
        $cart = $this->getCurrentCart();
        if ($cart->getCount() <= 0){return $this->redirect($this->generateUrl('app_main_cart_list')); }

        if ($this->getSecurityContext()->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            return $this->redirect($this->generateUrl('app_main_checkout_2'));
        }
        $this->setRedirectQ($this->generateUrl('app_main_checkout_1')); // fos_user.registration.success

        return $this->render('AppMainBundle:Order:checkout1.html.twig', array(
        ));
    }

    public function finalAction()
    {
        $order = $this->findOr404();
        if ($order instanceof Response){return $order;}

        if($this->getSecurityContext()->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            $order->setUser($this->getUser());
            $this->update($order);
        }

        $message = \Swift_Message::newInstance()
            ->setSubject("Заказ № {$order->getId()}")
            ->setFrom('robot@technodevice.com.ua')
            ->setTo($this->container->getParameter('admin_email'))
            ->setBody(
                $this->get('templating')->render('AppMainBundle:Order/partials:_admin_mail.txt.twig', array(
                    'order' => $order
                ))
//                ,'text/html'
            )
        ;
        $ns = array();
        $mailer = $this->get('mailer');
        $mailer->send($message, $ns);

        $this->addFlash('notice', 'Спасибо за покупку. Наш менеджер свяжется с Вами в ближайшее время.');
        $this->clearOrderId();
        $this->clearSessionCart();

        return $this->redirect($this->generateUrl('app_main_homepage'));
    }

    public function findOr404(array $criteria = null)
    {
        $id = $this->getOrderId();
        if (is_null($id)){return $this->redirect($this->generateUrl('app_main_homepage')); }

        $config = $this->getConfiguration();

        if (empty($criteria)) {
            $criteria = $config->getCriteria();
        }

        if (empty($criteria)) {
            $criteria = array('id' => $id);
        }

        $repository = $this->getRepository();

        if (!$resource = $this->getResourceResolver()->getResource($repository, $config, 'findOneBy', array($criteria))) {
            throw new NotFoundHttpException(sprintf('Requested %s does not exist', $config->getResourceName()));
        }

        return $resource;
    }

    /**
     * Create new resource or just display the form.
     */
    public function createAction(Request $request)
    {
        $cart = $this->getCurrentCart();
        if ($cart->getCount() <= 0){return $this->redirect($this->generateUrl('app_main_cart_list')); }

        $config = $this->getConfiguration();

        $resource = $this->createNew();
        $form = $this->getForm($resource);

        if ($request->isMethod('POST') && $form->bind($request)->isValid()) {
            $resource->setCart($cart);
            $this->create($resource);
            $this->setOrderId($resource->getId());
            $this->setFlash('success', 'create');

            return $this->redirectTo($resource);
        }

        if ($config->isApiRequest()) {
            return $this->handleView($this->view($form));
        }

        $view = $this
            ->view()
            ->setTemplate($config->getTemplate('create.html'))
            ->setData(array(
                $config->getResourceName() => $resource,
                'form'                     => $form->createView()
            ))
        ;

        return $this->handleView($view);
    }

    protected function getOrderId()
    {
        return $this->getRequest()->getSession()->get(self::SESSION_ORDER, null);
    }

    protected function setOrderId($id)
    {
        $this->getRequest()->getSession()->set(self::SESSION_ORDER, $id);
    }

    protected function clearOrderId()
    {
        $this->getRequest()->getSession()->remove(self::SESSION_ORDER);
    }

//    public function checkout2Action()
//    {
//        return $this->render('AppMainBundle:Order:checkout2.html.twig', array(
//            'form' => $this->getForm()
//        ));
//    }
//
//    protected function getOrderForm(Order $object = null, array $options = array())
//    {
//        if (is_null($object)) {
//            $object = new Order();
//        }
//
//        return $this->createForm('app_order', $object, $options);
//    }
}
