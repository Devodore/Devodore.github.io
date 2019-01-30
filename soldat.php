<?php
/**
 * Created by PhpStorm.
 * User: other
 * Date: 07/01/2019
 * Time: 17:49
 */

class Soldat extends Character
{
    public function __construct($name, $id = null, $life = 15, $strength = 15)
    {
        $this->setType('soldat');
        $this->setlife($life);
        $this->setStrength($strength);
        $this->setName($name);
        $this->setId($id);
    }
}