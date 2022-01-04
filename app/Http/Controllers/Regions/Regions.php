<?php

namespace App\Http\Controllers\Regions;

use App\Http\Controllers\Controller;
use App\Models\RegionCode;
use Illuminate\Http\Request;

class Regions extends Controller
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
     * Вывод данных для страницы кодов региона
     * 
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function regions(Request $request)
    {
        $regions = RegionCode::where('country', $request->country)
            ->orderByRaw('CAST(code AS UNSIGNED)')
            ->get();

        return [
            'regions' => $regions,
        ];
    }

    /**
     * Вывод всех серий одного региона
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $country
     * @param string $code
     * @return array
     */
    public function series(Request $request, $country, $code)
    {
        $region = RegionCode::where([
            ['country', $country],
            ['code', $code],
        ])
            ->first();

        if (!$region)
            return null;

        return [
            'region' => $region->region_name,
            'code' => $region->code,
            'comment' => $region->comment,
            'numbers' => $this->createSeries($code),
        ];
    }

    /**
     * Создание массива серий номеров
     * 
     * @param string $code
     * @return array
     */
    public function createSeries($code)
    {
        $this->series = [];

        foreach ($this->letters_eng as $one) {
            foreach ($this->letters_eng as $two) {
                foreach ($this->letters_eng as $three) {
                    $this->pushSeriesRow($one, $two, $three, $code);
                }
            }
        }

        return $this->series;
    }

    /**
     * Добавление элемента в серии номеров
     * 
     * @param string $one
     * @param string $two
     * @param string $three
     * @param string $code
     * @param string $number
     * @return null
     */
    public function pushSeriesRow($one, $two, $three, $code, $number = "000")
    {
        $one_rus = $this->findRusLetter($one);
        $two_rus = $this->findRusLetter($two);
        $three_rus = $this->findRusLetter($three);

        $this->series[] = [
            'series' => $one . $two . $three,
            'eng' => "{$one}{$number}{$two}{$three}{$code}",
            'rus' => "{$one_rus}{$number}{$two_rus}{$three_rus}{$code}",
            'one' => $one,
            'two' => $two,
            'three' => $three,
            'one_rus' => $one_rus,
            'two_rus' => $two_rus,
            'three_rus' => $three_rus,
            'code' => $code,
            'number' => $number,
        ];

        return null;
    }

    /**
     * Поиск аналога российской буквы
     * 
     * @param string
     * @return string
     */
    public function findRusLetter($letter)
    {
        $key = array_search($letter, $this->letters_eng);

        return isset($this->letters_rus[$key]) ? $this->letters_rus[$key] : $letter;
    }

    /**
     * Вывод всех серий одного региона
     * 
     * @param string $country
     * @param string $code
     * @param string $series
     * @return array
     */
    public function getSeriesRusNumbers($country, $code, $series)
    {
        $region = RegionCode::where([
            ['country', $country],
            ['code', $code],
        ])
            ->first();

        $one = $series[0];
        $two = $series[1];
        $three = $series[2];

        if (!$region)
            return null;

        $numbers = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];

        foreach ($numbers as $number_one) {
            foreach ($numbers as $number_two) {
                foreach ($numbers as $number_three) {
                    $number = $number_one . $number_two . $number_three;

                    if ($number === "000")
                        continue;

                    $this->pushSeriesRow($one, $two, $three, $code, $number);
                }
            }
        }

        return [
            'region' => $region->region_name,
            'code' => $region->code,
            'comment' => $region->comment,
            'numbers' => $this->series ?? [],
        ];
    }
}
