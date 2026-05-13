<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_date',
        'due_date',
        'status',
        'fine_amount'
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'return_date' => 'date',
        'due_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function isOverdue()
    {
        if ($this->status === 'borrowed' && now()->gt($this->due_date)) {
            return true;
        }
        return false;
    }

    public function getCurrentFineAttribute()
    {
        if ($this->status === 'overdue') {
            return $this->fine_amount;
        }

        if ($this->status === 'lost') {
            return 50000; 
        }

        $dueDate = \Carbon\Carbon::parse($this->due_date);
        if (now()->gt($dueDate)) {
            $daysLate = now()->diffInDays($dueDate);
            return $daysLate * 2000;
        }
        return 0;
    }

}
