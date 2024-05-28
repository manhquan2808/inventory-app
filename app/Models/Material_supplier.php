<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material_supplier extends Model
{
    use HasFactory;
    protected $table = 'material_supplier';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'material_id',
        'supplier_id',
        'price',
        'delivery_time',
    ];

    public function materials(){
        return $this->belongsTo(Materials::class,'material_id','material_id');
    }
    public function suppliers(){
        return $this->belongsTo(Suppliers::class,'supplier_id','supplier_id');
    }
}
