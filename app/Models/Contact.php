<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Company;
use App\Models\User;



class Contact extends Model
{
use \Znck\Eloquent\Traits\BelongsToThrough;
    use HasFactory;
    use LogsActivity;
    protected $fillable = [
        'company_id',
        'name',
        'last',
        'phone',
        'email',
        'job_position',
        'user_id'
    ];
    protected static $logFillable = true;

   public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsToThrough(User::class, Company::class);
    }
}
