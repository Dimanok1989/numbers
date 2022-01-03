<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class StatVisit extends Model
{
    use HasFactory;

    /**
     * Автообновления колонок времени
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'method',
        'ip',
        'url',
        'status_code',
        'referer',
        'user_agent',
        'data',
        'created_at'
    ];

    /**
     * Атрибуты, которые должны быть типизированы.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Запись статистики посещений
     * 
     * @param \Illuminate\Http\Request|null $request
     * @param int $code
     * @return null|StatVisits
     */
    public static function writeStatVisit($request = null, $code = 200)
    {
        $request = $request ?: request();

        $data = [
            'method' => $request->method(),
            'ip' => $request->ip(),
            'url' => $request->fullUrl(),
            'status_code' => $code,
            'referer' => $request->server('HTTP_REFERER'),
            'user_agent' => $request->userAgent(),
            'data' => [
                'input' => $request->all(),
                'cookie' => $request->cookie(),
                'headers' => $request->header(),
            ],
            'created_at' => now(),
        ];

        try {
            return static::create($data);
        } catch (Exception $e) {
            Log::channel('stats')->error($e->getMessage(), $data);
            return null;
        }
    }
}
