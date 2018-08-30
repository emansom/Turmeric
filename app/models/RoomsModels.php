<?php

class RoomsModels extends \Phalcon\Mvc\Model
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
     * @var string
     * @Column(column="model_id", type="string", length=255, nullable=false)
     */
    public $model_id;

    /**
     *
     * @var string
     * @Column(column="model_name", type="string", length=255, nullable=true)
     */
    public $model_name;

    /**
     *
     * @var integer
     * @Column(column="door_x", type="integer", length=11, nullable=false)
     */
    public $door_x;

    /**
     *
     * @var integer
     * @Column(column="door_y", type="integer", length=11, nullable=false)
     */
    public $door_y;

    /**
     *
     * @var string
     * @Column(column="door_z", type="string", nullable=false)
     */
    public $door_z;

    /**
     *
     * @var integer
     * @Column(column="door_dir", type="integer", length=11, nullable=true)
     */
    public $door_dir;

    /**
     *
     * @var string
     * @Column(column="heightmap", type="string", nullable=false)
     */
    public $heightmap;

    /**
     *
     * @var integer
     * @Column(column="usertype", type="integer", length=11, nullable=false)
     */
    public $usertype;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("kepler");
        $this->setSource("rooms_models");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'rooms_models';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return RoomsModels[]|RoomsModels|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return RoomsModels|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
