<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Kolom yang bisa diisi (mass assignable)
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'image',
        'description',
    ];

    /**
     * Casting atribut otomatis oleh Laravel
     *
     * @var array<string, string>
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }

    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}