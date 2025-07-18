<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Borrower;
use Illuminate\Http\Request;
use Carbon\Carbon; 
class LoanController extends Controller
{
public function borrow(Request $request)
{
    $request->validate([
        'book_id' => 'required|exists:books,id',
        'borrower_id' => 'required|exists:borrowers,id',
    ]);

    $hasUnreturned = Loan::where('borrower_id', $request->borrower_id)
                        ->whereNull('returned_at')
                        ->exists();

    if ($hasUnreturned) {
        return response()->json([
            'message' => 'Peminjam masih memiliki buku yang belum dikembalikan.'
        ], 400);
    }

    $book = Book::findOrFail($request->book_id);
    if ($book->stock < 1) {
        return response()->json([
            'message' => 'Stok buku tidak mencukupi.'
        ], 400);
    }

    $loan = Loan::create([
    'book_id' => $request->book_id,
    'borrower_id' => $request->borrower_id,
    'borrowed_at' => now(),
    'due_at' => now()->addDays(7),
]);

    $book->decrement('stock');

    return response()->json([
        'message' => 'Buku berhasil dipinjam.',
        'data' => $loan
    ], 201);
}
    public function returnBook($id)
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return response()->json(['message' => 'Data peminjaman tidak ditemukan.'], 404);
        }

        if ($loan->returned_at !== null) {
            return response()->json(['message' => 'Buku sudah dikembalikan sebelumnya.'], 400);
        }

        $now = Carbon::now();

        $loan->returned_at = $now;

         if ($now->greaterThan(Carbon::parse($loan->due_date))) {
            $loan->status = 'returned_late'; 
        } else {
            $loan->status = 'returned_on_time'; 
        }

        $loan->save();

        return response()->json([
            'message' => 'Buku berhasil dikembalikan.',
            'data' => $loan
        ]);
    }
}
