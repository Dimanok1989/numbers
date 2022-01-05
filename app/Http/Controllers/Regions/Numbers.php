<?php

namespace App\Http\Controllers\Regions;

use Exception;

class Numbers
{
    /**
     * Создание экземпляра объекта
     * 
     * @param string $country
     * @return void
     * 
     * @throws Exception
     */
    public function __construct(string $country)
    {
        $this->country = ucfirst(strtolower($country));

        $class_name = "\\App\\Http\\Controllers\\Regions\\Numbers\\" . $this->country;

        if (!class_exists($class_name))
            throw new Exception("Обработчик номера не найден");

        $this->handler = new $class_name();
    }

    /**
     * Страницы с номером
     * 
     * @param $number
     * @return \Illuminate\View\View|never
     */
    public function number($number)
    {
        $data = $this->handler->check($number);
        $country = strtolower($this->country);

        return view("pages.numbers.{$country}.{$data['type']}", $data);
    }
}
