<?php
/**
 * Created by PhpStorm.
 * User: other
 * Date: 07/01/2019
 * Time: 17:49
 */

class Villageois extends Character
{
    public function __construct($name, $id = null, $life = 25, $strength = 3)
    {
        $this->setType('villageois');
        $this->setlife($life);
        $this->setStrength($strength);
        $this->setName($name);
        $this->setId($id);
    }
}