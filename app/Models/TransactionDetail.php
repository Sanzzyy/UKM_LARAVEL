<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'menu_id',
        'quantity',
        'price',
        'subtotal',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Relasi: Transaction Detail belongs to Transaction
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    // Relasi: Transaction Detail belongs to Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
