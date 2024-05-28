<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $primaryKey = 'supplier_id';
    public $timestamps = false;

    protected $fillable = [
        'supplier_name',
        'emai',
        'number',
    ];
    public function material_supplier() {
        return $this->hasMany(Material_supplier::class,'supplier_id', 'supplier_id');
    }
    
}
