<?php

namespace ApiBundle\Controller;

use ApiBundle\Model\Order;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    /**
     * @Route("/order")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $orderData = $request->request->get('order');
        $order = (new Order())
            ->setProjectCode($orderData['project_code'])
            ->setPosCode($orderData['pos_code'])
            ->setEmail($orderData['email'])
            ->setWholesalerCode($orderData['wholesaler_code'])
            ->setTerm($orderData['term'])
            ->setConditionCode($orderData['condition_code'])
            ->setOrderClient($orderData['order_client'])
            ->setMarkup($orderData['markup']);
        foreach ($orderData['itens'] as &$item) {
            $item = (new Order\Item())
                ->setEan($item['ean'])
                ->setAmount($item['amount'])
                ->setMonitored($item['monitored'])
                ->setDiscount($item['discount'])
                ->setNetPrice($item['net_price']);
            $order->addItem($item);
        }
        $this->get('api.file_manager')->createOrderFile(
            $order,
            $request->request->get('id'),
            $request->request->get('industry'),
            $request->request->get('wholesaler')
        );

        return new JsonResponse(null, 201);
    }
}
