<?php

/**
 * Class Model_Content
 */
class Model_Content extends Kohana_Model
{
    private $contactTypes = ['address' => 'Адрес', 'phone' => 'Телефон'];

    /**
     * @return array
     */
    public function getContactTypes()
    {
        return $this->contactTypes;
    }

    /**
     * @param null|bool $redact_access
     * @param null|bool $show
     * @return array
     */
    public function getPages($redact_access = null, $show = null)
    {
        $query = DB::select()
            ->from('content__pages')
            ->where('', '', 1)
        ;

        $query = $redact_access !== null ? $query->and_where('redact_access', '=', $redact_access) : $query;
        $query = $show !== null ? $query->and_where('show', '=', $show) : $query;

        return $query->execute()->as_array();
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function findPageBySlug($slug)
    {
        return DB::select()
            ->from('content__pages')
            ->where('slug', '=', $slug)
            ->limit(1)
            ->execute()
            ->current()
        ;
    }

    /**
     * @param string $slug
     * @param string $content
     */
    public function updatedPage($slug, $content)
    {
        DB::update('content__pages')
            ->set(['content' => $content])
            ->where('slug', '=', $slug)
            ->execute()
        ;
    }

    /**
     * @param null|int $id
     * @param int $status
     * @return array
     */
    public function findReviews($id = null, $status = 1)
    {
        $query = DB::select()
            ->from('content__reviews')
            ->where('status', '=', $status)
        ;

        $query = $id != null ? $query->and_where('id', '=', $id) : $query;

        return $query
                ->execute()
                ->as_array()
            ;
    }

    /**
     * @param string $author
     * @param string $content
     *
     * @return string
     */
    public function addReview($author, $content)
    {
        /** @var Model_CRM $crmModel */
        $crmModel = Model::factory('CRM');

        DB::insert('content__reviews', ['author', 'content', 'date'])
            ->values ([$author, $content, DB::expr('now()')])
            ->execute();

        $crmModel->sendMail('site@autotorres.ru', 'Новый отзыв на сайте');

        return 'success';
    }

    /**
     * @param int $id
     * @param int $status
     */
    public function setReview($id, $status)
    {
        DB::update('content__reviews')
            ->set(['status' => $status])
            ->where('id', '=', $id)
            ->execute();
    }

    /**
     * @param int $id
     */
    public function removeReview($id)
    {
        DB::delete('content__reviews')->where('id', '=', $id)->execute();
    }

    /**
     * @param null|array $type
     * @return array
     */
    public function getContacts($type = null)
    {
        $query = DB::select()
            ->from('content__contacts')
            ->where('', '', 1)
        ;

        $query = $type !== null ? $query->and_where('type', 'IN', $type) : $query;

        return $query->execute()->as_array();
    }

    /**
     * @param string $type
     * @param string $value
     *
     * @return bool
     */
    public function addContact($type, $value)
    {
        if (!array_key_exists($type, $this->getContactTypes())) {
            return false;
        }

        DB::insert('content__contacts', ['type', 'value'])
            ->values([$type, $value])
            ->execute()
        ;

        return true;
    }

    /**
     * @param array $params
     */
    public function updateContacts($params)
    {
        $ids = Arr::get($params, 'ids', []);
        $types = Arr::get($params, 'types', []);
        $values = Arr::get($params, 'values', []);

        foreach ($ids as $key => $id) {
            DB::update('content__contacts')
                ->set(['type' => $types[$key], 'value' => $values[$key]])
                ->where('id', '=', $id)
                ->execute()
            ;
        }
    }
}