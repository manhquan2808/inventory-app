<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    use HasFactory;

    protected $table = 'materials';
    protected $primaryKey = 'material_id';
    public $timestamps = false;

    protected $fillable = [
        'material_name',
        'unit',
        'price_per_unit',
    ];

    protected $guarded = ['material_id'];
    public function inventory_material()
    {
        return $this->hasMany(Inventory_material::class, 'material_id', 'material_id');
    }
    public function inventory_product()
    {
        return $this->hasMany(Inventory_product::class, 'material_id', 'material_id');
    }
    public function material_supplier()
    {
        return $this->hasMany(Material_supplier::class, 'material_id', 'material_id');
    }
    public function material_input()
    {
        return $this->hasMany(Material_input::class, 'material_id', 'material_id');
    }
    // public function materials()
    // {
    //     return $this->belongsToMany(Materials::class, 'material_product', 'product_id', 'material_id');
    // }

    public function scopeSearch($query, $value)
    {
        $query->where('materials.material_id', 'like', "%{$value}%")
            ->orWhere('materials.material_name', 'like', "%{$value}%")
            ->orWhere('materials.unit', 'like', "%{$value}%")
            ->orWhere('materials.price_per_unit', 'like', "%{$value}%");
    }
}
