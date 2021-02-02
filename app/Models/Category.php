<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryType;

class Category extends Model
{
    use HasFactory;

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'category_type_id',
        'category_name',
        'created_at'
    ];

    protected $table = 'categories';

    public function category_type() {
        return $this->belongsTo(CategoryType::class);
    }
}
