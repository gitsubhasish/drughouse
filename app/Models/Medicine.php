<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'batch_no',
        'mrp',
        'price',
        'expiry_date',
        'total_stock',
        'is_featured',
        'category_id',
        'manufacturer_id',
        'unit_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function images()
    {
        return $this->hasMany(MedicineImage::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
