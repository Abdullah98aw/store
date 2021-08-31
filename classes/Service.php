<?php
class Service
{

    public $available = false;

    public $taxRate = 0;



    public function __construct()
    {
        $this->available = true;
    }

    public function __destruct()
    {

    }

    public static function all()
    {
        return [

            ['name' => 'Consultation', 'price' => 500, 'days' => ['Sun', 'Mon']],
            ['name' => 'Training', 'price' => 200, 'days' => ['Tue', 'Wed']],
            ['name' => 'Design', 'price' => 100, 'days' => ['Thu', 'Fri']],

        ];
    }

    public function totalPrice($price)
    {
        if ($this->taxRate > 0) {

            return $price + ($price * $this->taxRate);
        }

        return $price;
    }
}