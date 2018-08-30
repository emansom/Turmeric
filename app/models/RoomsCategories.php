<?php

class RoomsCategories extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(column="order_id", type="integer", length=11, nullable=false)
     */
    public $order_id;

    /**
     *
     * @var integer
     * @Column(column="parent_id", type="integer", length=11, nullable=false)
     */
    public $parent_id;

    /**
     *
     * @var integer
     * @Column(column="isnode", type="integer", length=11, nullable=true)
     */
    public $isnode;

    /**
     *
     * @var string
     * @Column(column="name", type="string", length=255, nullable=false)
     */
    public $name;

    /**
     *
     * @var integer
     * @Column(column="public_spaces", type="integer", length=11, nullable=true)
     */
    public $public_spaces;

    /**
     *
     * @var integer
     * @Column(column="allow_trading", type="integer", length=11, nullable=true)
     */
    public $allow_trading;

    /**
     *
     * @var integer
     * @Column(column="minrole_access", type="integer", length=11, nullable=true)
     */
    public $minrole_access;

    /**
     *
     * @var integer
     * @Column(column="minrole_setflatcat", type="integer", length=11, nullable=true)
     */
    public $minrole_setflatcat;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("kepler");
        $this->setSource("rooms_categories");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'rooms_categories';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return RoomsCategories[]|RoomsCategories|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return RoomsCategories|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
