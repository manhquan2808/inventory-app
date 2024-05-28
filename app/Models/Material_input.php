<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material_input extends Model
{
    use HasFactory;
    protected $table = 'material_input';
    protected $primaryKey = 'input_id';
    public $timestamps = false;
    protected $guarded = ['input_id'];
    protected $fillable = [
        'material_id',
        'supplier_id',
        'quantity',
        'date',
    ];
    public function materials(){
        return $this->belongsTo(Materials::class,'material_id','material_id');
    }
    public function suppliers(){
        return $this->belongsTo(Suppliers::class,'supplier_id','supplier_id');
    }
}
