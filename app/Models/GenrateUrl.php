<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class GenrateUrl extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::Class, 'company_id');
    }

    public function member() : BelongsTo
    {
        return $this->belongsTo(User::Class,'member_id');
    }

    public static function genrateShortUrl(){
        return substr(md5(uniqid(rand())), 0, 10);
    }

}
 