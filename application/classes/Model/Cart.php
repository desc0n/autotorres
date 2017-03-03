<?php

/**
 * Class Model_Cart
 */
class Model_Cart extends Kohana_Model
{
    private $guestId;

    public function __construct()
    {
        /** @var $crmModel Model_CRM */
        $crmModel = Model::factory('CRM');

        $this->guestId = $crmModel->getGuestId();
    }

    /**
     * @param int $itemId
     *
     * @return bool
     */
    public function addToGuestCart($itemId)
    {
        $cartData = $this->getGuestCartByNotice($itemId);
        $cartId = Arr::get($cartData, 'id');

        if (empty($cartId)) {
            $res = DB::insert('cart', ['guest_id', 'item_id', 'date'])
                ->values([$this->guestId, $itemId, DB::expr('NOW()')])
                ->execute()
            ;

            $cartId = $res[0];
        } else {
            DB::update('cart')
                ->set(['num' => DB::expr('(num + 1)')])
                ->where('id', '=', $cartData['id'])
                ->execute()
            ;
        }

        return $cartId;
    }

    /**
     * @param int $itemId
     *
     * @return bool
     */
    public function addToCart($itemId)
    {
        return $this->addToGuestCart($itemId);
    }

    /**
     * @param int $id
     * @param int $value
     *
     * @return int
     */
    public function setCartNum($id, $value)
    {
        DB::update('cart')
            ->set(['num' => $value])
            ->where('id', '=', $id)
            ->execute()
        ;

        return $this->getGuestCartNum();
    }

    /**
     * @param $positionId
     * @return bool
     */
    public function removeCartPosition($positionId)
    {
        DB::update('cart')
            ->set(['show' => 0])
             ->where('id', '=', $positionId)
            ->execute()
        ;

        return true;
    }

    public function removeAllGuestCartPositions()
    {
        DB::update('cart')
            ->set(['show' => 0])
            ->where('guest_id', '=', $this->guestId)
            ->execute()
        ;

        return true;
    }

    public function removeAllCartPositions()
    {
        return $this->removeAllGuestCartPositions();
    }

    /**
     * @return array
     */
    public function getCart()
    {
        return $this->getGuestCart();
    }

    /**
     * @return array
     */
    public function getGuestCart()
    {
        return DB::select('c.*', 'n.*', 'c.id', ['n.id', 'item_id'])
            ->from(['cart', 'c'])
            ->join(['suppliers__items', 'n'])
            ->on('n.id', '=', 'c.item_id')
            ->where('c.show', '=', 1)
            ->and_where('c.guest_id', '=', $this->guestId)
            ->execute()
            ->as_array()
        ;
    }

    /**
     * @param int $itemId
     *
     * @return bool|array
     */
    public function getGuestCartByNotice($itemId)
    {
        return DB::select('c.*', 'n.*', 'c.id', ['n.id', 'item_id'])
            ->from(['cart', 'c'])
            ->join(['suppliers__items', 'n'])
            ->on('n.id', '=', 'c.item_id')
            ->where('c.show', '=', 1)
            ->and_where('c.guest_id', '=', $this->guestId)
            ->and_where('c.item_id', '=', $itemId)
            ->execute()
            ->current()
        ;
    }

    /**
     * @return int
     */
    public function getGuestCartNum()
    {
        $res = DB::select([DB::expr('SUM(c.num)'), 'num'])
            ->from(['cart', 'c'])
            ->where('c.show', '=', 1)
            ->and_where('c.guest_id', '=', $this->guestId)
            ->execute()
            ->current()
        ;

        return (int)Arr::get($res, 'num', 0);
    }

    /**
     * @return int
     */
    public function getGuestCartAllPrice()
    {
        $res = DB::select([DB::expr('SUM(c.num * n.price) '), 'all_price'])
            ->from(['cart', 'c'])
            ->join(['suppliers__items', 'n'])
            ->on('n.id', '=', 'c.item_id')
            ->where('c.show', '=', 1)
            ->and_where('c.guest_id', '=', $this->guestId)
            ->execute()
            ->current()
        ;

        return (int)Arr::get($res, 'all_price', 0);
    }

    /**
     * @return int
     */
    public function getCartNum()
    {
        return (int)$this->getGuestCartNum();
    }

    /**
     * @return int
     */
    public function getCartAllPrice()
    {
        return (int)$this->getGuestCartAllPrice();
    }

    public function sendOrder($name, $phone, $address, $email)
    {
        /** @var $crmModel Model_CRM */
        $crmModel = Model::factory('CRM');

        $crmModel->addOrderFromCart($name, $phone, $address, $email);

        return $this->removeAllCartPositions();
    }
}