<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory_material extends Model
{
    use HasFactory;
    protected $table = 'inventory_material';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'inventory_id',
        'material_id',
        'quantity',
        'last_updated'
    ];

    protected $guarded = ['id'];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'inventory_id');
    }
    public function material()
    {
        return $this->belongsTo(Products::class, 'material_id', 'material_id');
    }
}
