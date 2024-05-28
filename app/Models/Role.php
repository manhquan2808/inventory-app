<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    public $timestamps = false;

    protected $fillable = [
        'role_name',
        'nickname',
    ];

    protected $guarded = ['role_id'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'role_id', 'role_id');
    }

    public function scopeSearch($query, $value){
        $query->where('role_name', 'like', "%{$value}%")
        ->orWhere('nickname', 'like', "%{$value}%");
    }
}
