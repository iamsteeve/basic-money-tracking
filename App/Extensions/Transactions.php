<?php

namespace App\Extensions;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

/**
 * Class Transactions
 * @package App\Extensions
 */
class Transactions implements ExtensionInterface
{
    /**
     * Registra la extensión
     * @param Engine $engine
     */
    public function register(Engine $engine)
    {
        $engine->registerFunction('transactions', [$this, 'getObject']);
    }

    /**
     * Obtiene el contexto
     * @return $this
     */
    public function getObject()
    {
        return $this;
    }

    /**
     * Método para obtener el numero formateado puedes pasarle un símbolo
     * @param $number
     * @param bool $colors
     * @param string $symbolAmount
     * @return string
     */
    public function getAmountFormat($number, $colors = false, string $symbolAmount = ''): string
    {
        if ($colors){
            return $this->convertColorNumber($number,$symbolAmount);
        } else {
            return $symbolAmount.$number;
        }
    }

    /**
     * Método que convierte el color de los numeros si es verde es mayor que cero y si es menor que cero será rojo si es 0 el color será negro
     * @param $number
     * @param string $symbol
     * @return string
     */
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