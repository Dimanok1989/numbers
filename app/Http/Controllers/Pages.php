<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Regions\Regions;
use Illuminate\Http\Request;

class Pages extends Controller
{
    /**
     * Вывод страницы с кодами регионов
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $country
     * @return \Illuminate\View\View|never
     */
    public function regions(Request $request, $country)
    {
        $request->country = $country;

        if ($country === "ru")
            return $this->regionsRus($request);

        abort(404, 'Данные не найдены');
    }

    /**
     * Вывод кодов регионов России
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function regionsRus(Request $request)
    {
        $data = (new Regions)->regions($request);

        return view('pages.regions', $data);
    }

    /**
     * Вывод страницы с сериями номеров региона
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $country
     * @param string $code
     * @param string $series
     * @return \Illuminate\View\View|never
     */
    public function series(Request $request, $country, $code, $series = null)
    {
        if ($country === "ru")
            return $this->seriesRus($request, $country, $code, $series);

        abort(404, "Данные региона не найдены");
    }

    /**
     * Вывод серий региона РФ
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $country
     * @param string $code
     * @param string $series
     * @return \Illuminate\View\View|never
     */
    public function seriesRus(Request $request, $country, $code, $series)
    {
        if ($series)
            $data = (new Regions)->getSeriesRusNumbers($country, $code, $series);
        else
            $data = (new Regions)->series($request, $country, $code);

        if (($data ?? null) === null)
            abort(404, "Данные региона не найдены");

        return view('pages.series-rus', $data);
    }
}
