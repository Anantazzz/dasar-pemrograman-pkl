<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
protected $fillable = ['book_id', 'borrower_id','borrowed_at', 'due_at', 'returned_at', 'status'];
public function book()
{
    return $this->belongsTo(Book::class);
}

public function borrower()
{
    return $this->belongsTo(Borrower::class);
}
}
