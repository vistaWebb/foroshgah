<?php

namespace App\Models;

use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "Transactions";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusAttribute($status)
    {
        switch($status){
            case '0' :
                $status = 'ناموفق';
            break;
            case '1':
                $status = 'موفق';
            break;
        }
        return $status;
    }

    public function scopeGetData($query, $status)
    {
        $v = verta()->subYear();
        $date = Verta::parse($v)->datetime();
        return $query->where('created_at', '>', Carbon::create($date))
            ->where('status', $status)
            ->get();
    }

    public function scopeGetLastMonth($query , $status)
    {
        $v = verta()->subMonth();
        $date = Verta::parse($v)->datetime();
        return $query->where('created_at', '>', Carbon::create($date))
            ->where('status', $status)
            ->get();
    }
}
