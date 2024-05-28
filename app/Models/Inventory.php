<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventory';
    protected $primaryKey = 'inventory_id';
    public $timestamps = false;

    protected $fillable = [
        'inventory_name',
        'address',
        'email',
        'type_id'
    ];

    protected $guarded = ['inventory_id '];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'inventory_id', 'inventory_id');
    }
    public function inventory_product()
    {
        return $this->hasMany(Inventory_product::class,'inventory_id','inventory_id');
    }
    // Phương thức hasMany được sử dụng để thiết lập một mối quan hệ "một-nhiều" giữa hai model.
    public function inventory_type()
    {
        return $this->belongsTo(Inventory_type::class, 'type_id', 'type_id');
    }
    // Phương thức belongsTo được sử dụng để thiết lập một mối quan hệ "nhiều-một" giữa hai model.

    public function scopeSearch($query, $value)
    {
        $query->where('inventory_name', 'like', "%{$value}%")
            ->orWhere('address', 'like', "%{$value}%");
    }

}
