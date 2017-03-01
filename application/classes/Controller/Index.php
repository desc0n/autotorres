<?php

class Controller_Index extends Kohana_Controller
{
    /** @var Model_CRM */
    private $crmModel;

    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);

        View::set_global('rootPage', $request->param('slug'));
        $this->crmModel = Model::factory('CRM');
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
        $content = View::factory('page')
            ->set('content', Arr::get($contentModel->findPageBySlug($this->request->param('slug')), 'content'))
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
        /** @var Model_Content $contentModel */
        $contentModel = Model::factory('Content');

        $template = $this->getBaseTemplate();
        $content = View::factory('contacts');

        $template
            ->set('top_menu', View::factory('top_menu'))
            ->set('top_offer', null)
            ->set('content', $content)
        ;

        $this->response->body($template);
    }
}