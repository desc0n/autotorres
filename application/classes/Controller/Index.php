<?php

class Controller_Index extends Kohana_Controller
{
    /** @var Model_CRM */
    private $crmModel;

    /** @var $cartModel Model_Cart */
    private $cartModel;

    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);

        View::set_global('rootPage', $request->param('slug'));
        $this->crmModel = Model::factory('CRM');
        $this->cartModel = Model::factory('Cart');
    }

    /**
     * @return View
     */
    private function getBaseTemplate()
    {
        return View::factory('template');
    }

    public function action_index()
    {
        $template = $this->getBaseTemplate();

        $content = View::factory('index');

        $content
            ->set('article', $this->request->post('article'))
            ->set('itemsList', $this->crmModel->searchOrderSpareOffer($this->request->post('article')))
        ;

        $template
            ->set('top_menu', View::factory('top_menu'))
            ->set('top_offer', View::factory('top_offer'))
            ->set('content', $content)
        ;

        $this->response->body($template);
    }

    public function action_page()
    {
        /** @var Model_Content $contentModel */
        $contentModel = Model::factory('Content');

        $template = $this->getBaseTemplate();
        $pageData = $contentModel->findPageBySlug($this->request->param('slug'));

        $content = View::factory('page')
            ->set('title', Arr::get($pageData, 'name'))
            ->set('content', Arr::get($pageData, 'content'))
        ;

        $template
            ->set('top_menu', View::factory('top_menu'))
            ->set('top_offer', null)
            ->set('content', $content)
        ;

        $this->response->body($template);
    }

    public function action_reviews()
    {
        /** @var Model_Content $contentModel */
        $contentModel = Model::factory('Content');

        $template = $this->getBaseTemplate();
        $content = View::factory('reviews')
            ->set('reviews', $contentModel->findReviews(null, 1))
        ;

        $template
            ->set('top_menu', View::factory('top_menu'))
            ->set('top_offer', null)
            ->set('content', $content)
        ;

        $this->response->body($template);
    }

    public function action_contacts()
    {
        $template = $this->getBaseTemplate();
        $content = View::factory('contacts');

        $template
            ->set('top_menu', View::factory('top_menu'))
            ->set('top_offer', null)
            ->set('content', $content)
        ;

        $this->response->body($template);
    }

    public function action_cart()
    {
        $template = $this->getBaseTemplate();
        $content = View::factory('cart')
            ->set('cart', $this->cartModel->getCart())
        ;

        $template
            ->set('top_menu', View::factory('top_menu'))
            ->set('top_offer', null)
            ->set('content', $content)
        ;

        $this->response->body($template);
    }
}