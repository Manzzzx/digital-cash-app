<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'type',
        'amount',
        'date',
        'reference_number',
        'description',
        'receipt',
];
    /**
     * Generate nomor referensi unik setiap kali create.
     * Format: TRX-[TAHUN]-[5 digit increment]
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function booted()
    {
        static::creating(function ($transaction) {
            // Ambil tahun berjalan
            $year = now()->format('Y');
            $lastNumber = DB::table('transactions')
                ->whereYear('created_at', $year)
                ->selectRaw('MAX(CAST(SUBSTRING_INDEX(reference_number, "-", -1) AS UNSIGNED)) as last')
                ->value('last');

            $nextNumber = str_pad(($lastNumber ?? 0) + 1, 5, '0', STR_PAD_LEFT);

            $transaction->reference_number = "TRX-{$year}-{$nextNumber}";
        });
    }

}