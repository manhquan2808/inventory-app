<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory_type extends Model
{
    use HasFactory;
    protected $table = 'inventory_type';
    protected $primaryKey = 'type_id';
    public $timestamps = false;

    protected $fillable = [
        'type_name',
    ];

    protected $guarded = ['type_id '];

    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'type_id', 'type_id');
    }
}
