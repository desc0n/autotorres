<?php

class Controller_Ajax extends Controller
{
    /** @var Model_CRM */
    private $crmModel;

    /** @var Model_Content */
    private $contentModel;

    /** @var $cartModel Model_Cart */
    private $cartModel;

    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);

        $this->crmModel = Model::factory('CRM');
        $this->contentModel = Model::factory('Content');
        $this->cartModel = Model::factory('Cart');
    }

    public function action_search_order_spare_offer()
    {
        return $this->response->body(json_encode($this->crmModel->searchOrderSpareOffer($this->request->post('article'))));
    }

    public function action_search_order_spare()
    {
        return $this->response->body(json_encode($this->crmModel->findOrderSpare((int)$this->request->post('orderId'))));
    }

    public function action_set_order_spare_by_search()
    {
        return $this->response->body(json_encode($this->crmModel->setOrderSpareBySearch((int)$this->request->post('id'), (int)$this->request->post('itemId'))));
    }

    public function action_search_order_by_number()
    {
        return $this->response->body($this->crmModel->findOrderById((int)$this->request->post('id')) ? (int)$this->request->post('id') : 0);
    }

    public function action_add_spare_to_order_from_search()
    {
        return $this->response->body($this->crmModel->addSpareToOrderFromSearch((int)$this->request->post('orderId'), (int)$this->request->post('itemId')));
    }

    public function action_send_review()
    {
        return $this->response->body($this->contentModel->addReview($this->request->post('author'), $this->request->post('content')));
    }

    public function action_add_to_cart()
    {
        $cartId = $this->cartModel->addToCart($this->request->post('itemId'));
        $this->cartModel->setCartNum($cartId, (int)$this->request->post('quantity'));

        $this->response->body('ok');
    }

    public function action_set_cart_num()
    {
        $cartId = (int)$this->request->post('cartId');
        $value = (int)$this->request->post('value');

        $value = preg_replace('/[\D]+/', '', $value);

        $this->cartModel->setCartNum($cartId, $value < 0 ? 0 : $value);

        $this->response->body($value);
    }

    public function action_remove_from_cart()
    {
        $this->response->body($this->cartModel->removeCartPosition((int)$this->request->post('cartId')));
    }

    public function action_get_cart_num()
    {
        $this->response->body($this->cartModel->getCartNum());
    }

    public function action_get_cart_all_price()
    {
        $this->response->body($this->cartModel->getCartAllPrice());
    }



    public function action_send_order()
    {
        /** @var $cartModel Model_Cart */
        $cartModel = Model::factory('Cart');

        $name = (string)$this->request->post('name');
        $phone = (string)$this->request->post('phone');
        $address = (string)$this->request->post('address');
        $email = (string)$this->request->post('email');

        $this->response->body($cartModel->sendOrder($name, $phone, $address, $email));
    }
}