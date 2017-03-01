<?php

class Controller_Ajax extends Controller
{
    /** @var Model_CRM */
    private $crmModel;

    /** @var Model_Content */
    private $contentModel;

    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);

        $this->crmModel = Model::factory('CRM');
        $this->contentModel = Model::factory('Content');
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
}