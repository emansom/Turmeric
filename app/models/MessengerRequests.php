<?php

class MessengerRequests extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Column(column="from_id", type="integer", length=11, nullable=true)
     */
    public $from_id;

    /**
     *
     * @var integer
     * @Column(column="to_id", type="integer", length=11, nullable=true)
     */
    public $to_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("kepler");
        $this->setSource("messenger_requests");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'messenger_requests';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MessengerRequests[]|MessengerRequests|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MessengerRequests|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
