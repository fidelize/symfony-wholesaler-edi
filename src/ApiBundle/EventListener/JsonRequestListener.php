<?php

namespace ApiBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class JsonRequestListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);
            $request->request->replace(is_array($data) ? $data : []);
        }
    }
}
