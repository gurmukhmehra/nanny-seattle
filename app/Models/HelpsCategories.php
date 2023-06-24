<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HelpsCategories extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $primaryKey= "id";  
    
    public function helpListBycategories()
    {
        return $this->hasMany('App\Models\Help','help_category','id')->orderBy('id');
    }

}
