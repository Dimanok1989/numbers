<?php

namespace App\Http\Controllers\Regions\Numbers;

trait NumberData
{
    /**
     * Буквы серии Российских номеров
     * 
     * @var array
     */
    protected $letters_rus = [
        "А", "В", "Е", "К", "М", "Н", "О", "Р", "С", "Т", "У", "Х"
    ];

    /**
     * Перевод русской буквы в латинскую
     * 
     * @var array
     */
    protected $letters_eng = [
        "A", "B", "E", "K", "M", "H", "O", "P", "C", "T", "Y", "X"
    ];

    /**
     * Цифры в номере
     * 
     * @var array
     */
    protected $numbers = [
        "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"
    ];

    /**
     * Замена русской буквы на латинскую
     * 
     * @param string $letter
     * @return string
     */
    public function changeRusToEng($letter)
    {
        if (!$key = array_search($letter, $this->letters_rus))
            return $letter;

        return $this->letters_eng[$key] ?? $letter;
    }

    /**
     * Замена латинской буквы на русскую
     * 
     * @param string $letter
     * @return string
     */
    public function changeEngToRus($letter)
    {
        if (!$key = array_search($letter, $this->letters_eng))
            return $letter;

        return $this->letters_rus[$key] ?? $letter;
    }
}
