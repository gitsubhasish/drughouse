<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineImage extends Model
{
    use HasFactory;

    protected $fillable = ['medicine_id', 'image'];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
