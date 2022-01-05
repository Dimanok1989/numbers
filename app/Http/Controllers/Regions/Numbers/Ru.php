<?php

namespace App\Http\Controllers\Regions\Numbers;

use Exception;

class Ru
{
    use NumberData;

    /**
     * Идентификатор страны
     * 
     * @var string
     */
    public $type = "ru";

    /**
     * Проверка номера
     * 
     * @param string $number
     */
    public function check($number)
    {
        $data = [];
        $number = strtoupper($number);

        $number = str_replace($this->letters_rus, $this->letters_eng, $number);

        for ($i = 0; $i < mb_strlen($number); $i++)
            $data[] = $number[$i];

        if ($this->isCivil($data))
            return $this->getCivilNumberData($data);

        throw new Exception("Тип номера не определен");
    }

    /**
     * Проверка принадлежности гражданского номера
     * 
     * @param array
     * @return bool
     */
    public function isCivil($data)
    {
        if (count($data) < 8 or count($data) > 9)
            return false;

        if (
            !in_array($data[0], $this->letters_eng)
            or !in_array($data[4], $this->letters_eng)
            or !in_array($data[5], $this->letters_eng)
        )
            return false;

        if (
            !in_array($data[1], $this->numbers)
            or !in_array($data[2], $this->numbers)
            or !in_array($data[3], $this->numbers)
            or !in_array($data[6], $this->numbers)
            or !in_array($data[7], $this->numbers)
        )
            return false;

        return true;
    }

    /**
     * Вывод данных гражданского номера
     * 
     * @param array $data
     * @return array
     */
    public function getCivilNumberData($data)
    {
        $series = $data[0] . $data[4] . $data[5];
        $number = $data[0] . $data[1] . $data[2] . $data[3] . $data[4] . $data[5];
        $code = "";

        for ($i = 6; $i < count($data); $i++)
            $code .= $data[$i];

        $key = strtoupper($number . $code);

        return [
            'series' => $series,
            'number' => $number,
            'number_rus' => str_replace($this->letters_eng, $this->letters_rus, $number),
            'region' => $code,
            'key' => $key,
            'type' => "civil",
        ];
    }
}
