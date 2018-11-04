<?php

namespace App\Extensions;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class Transactions implements ExtensionInterface
{
    public function register(Engine $engine)
    {
        $engine->registerFunction('transactions', [$this, 'getObject']);
    }

    public function getObject()
    {
        return $this;
    }

    public function getAmountFormat($number, $colors = false, string $symbolAmount = ''): string
    {
        if ($colors){
            return $this->convertColorNumber($number,$symbolAmount);
        } else {
            return $symbolAmount.$number;
        }
    }

    private function convertColorNumber($number, string $symbol = ''): string
    {
        if ($number>0){
            return '<p class="green-text">'.$symbol.$number.'</p>';
        } elseif ($number<0){
            return '<p class="red-text">'.$symbol.$number.'</p>';
        } else {
            return '<p>'.$symbol.$number.'</p>';
        }
    }

}