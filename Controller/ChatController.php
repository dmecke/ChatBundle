<?php

namespace Cunningsoft\ChatBundle\Controller;

use Cunningsoft\ChatBundle\Entity\Message;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/chat")
 */
class ChatController extends Controller
{
    /**
     * @return Response
     *
     * @Route("", name="cunningsoft_chat_show")
     * @Template
     */
    public function showAction()
    {
        return array(
            'updateInterval' => $this->container->getParameter('cunningsoft_chat.update_interval'),
        );
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     *
     * @Route("/post", name="cunningsoft_chat_post")
     */
    public function postAction(Request $request)
    {
        $message = new Message();
        $message->setAuthor($this->getUser());
        $message->setChannel('default');
        $message->setMessage($request->get('message'));
        $message->setInsertDate(new \DateTime());
        $this->getDoctrine()->getManager()->persist($message);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Successful');
    }

    /**
     * @Route("/list", name="cunningsoft_chat_list")
     * @Template
     */
    public function listAction()
    {
        $messages = $this->getDoctrine()->getRepository('CunningsoftChatBundle:Message')->findBy(
            array('channel' => 'default'),
            array('id' => 'desc'),
            $this->container->getParameter('cunningsoft_chat.number_of_messages')
        );

        return array(
            'messages' => $messages,
        );
    }
}
