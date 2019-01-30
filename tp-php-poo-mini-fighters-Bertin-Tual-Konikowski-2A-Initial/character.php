<?php
/**
 * Created by PhpStorm.
 * User: other
 * Date: 07/01/2019
 * Time: 17:34
 */

class Character
{
    protected $_type;
    protected $_strength;
    protected $_life;
    protected $_name;
    protected $_id;

    public function damage($damagePoints)
    {
        $this->_life -= $damagePoints;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->_type = $type;
    }

    /**
     * @return mixed
     */
    public function getStrength()
    {
        return $this->_strength;
    }

    /**
     * @param mixed $strength
     */
    public function setStrength($strength)
    {
        $this->_strength = $strength;
    }

    /**
     * @return mixed
     */
    public function getLife()
    {
        return $this->_life;
    }

    /**
     * @param mixed $life
     */
    public function setLife($life)
    {
        $this->_life = $life;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

}