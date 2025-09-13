<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $guarded = [];

    public function genrateurl(){
        return $this->HasMany(GenrateUrl::Class, 'company_id');
    }

    public function users(){
        return $this->HasMany(User::Class, 'company_id');
    }

    public function getUrlcount(){
        return $this->genrateurl()->selectRaw('count(*) as total_genrated_url, sum(hits) as total_hit_url');
    }


}
 