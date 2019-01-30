<?php
/**
 * Created by PhpStorm.
 * User: other
 * Date: 07/01/2019
 * Time: 17:49
 */

class Magicien extends Character
{
    public function __construct($name, $id = null, $life = 50, $strength = 5)
    {
        $this->setType('magicien');
        $this->setlife($life);
        $this->setStrength($strength);
        $this->setName($name);
        $this->setId($id);
    }
}