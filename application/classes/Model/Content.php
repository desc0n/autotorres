<?php

/**
 * Class Model_Content
 */
class Model_Content extends Kohana_Model
{
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
        $query = $show !== null ? $query->and_where('show', '=', $show) : $show;

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
}