<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'book_name',
        'description',
        'publish_date',
        'suggest',
        'author',
        'company_id',
        'category_id',
        'publishing_house',
        'translator',
        'number_of_pages',
        'quality',
        'price',
        'cover_price',
        'book_image',
        'images',
    ];

    protected $casts = [
        'publish_date' => 'date',
        'suggest' => 'boolean',
        'quality' => 'boolean',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
