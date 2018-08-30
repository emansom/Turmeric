<?php

class MessengerMessages extends \Phalcon\Mvc\Model
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
     * @Column(column="receiver_id", type="integer", length=11, nullable=true)
     */
    public $receiver_id;

    /**
     *
     * @var integer
     * @Column(column="sender_id", type="integer", length=11, nullable=true)
     */
    public $sender_id;

    /**
     *
     * @var string
     * @Column(column="unread", type="string", length=255, nullable=true)
     */
    public $unread;

    /**
     *
     * @var string
     * @Column(column="body", type="string", length=255, nullable=true)
     */
    public $body;

    /**
     *
     * @var integer
     * @Column(column="date", type="integer", length=20, nullable=true)
     */
    public $date;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("kepler");
        $this->setSource("messenger_messages");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'messenger_messages';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MessengerMessages[]|MessengerMessages|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MessengerMessages|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
