<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 20/05/14
 * Time: 21:32
 */

namespace ebussola\ihair\salon;


use ebussola\common\superpower\EasyArrayable;

class Salon implements \ebussola\ihair\Salon {
    use EasyArrayable;

    public $id;
    public $name;
    public $rating;

}