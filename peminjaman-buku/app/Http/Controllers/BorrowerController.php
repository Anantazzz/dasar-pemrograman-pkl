<?php

namespace App\Http\Controllers;
use App\Models\Borrower;
use Illuminate\Http\Request;

class BorrowerController extends Controller
{
     public function index() {
        return Borrower::all();
    }

    public function store(Request $request) {
        return Borrower::create($request->all());
    }

    public function show($id) {
        return Borrower::find($id);
    }

    public function update(Request $request, $id) {
        $book = Borrower::find($id);
        $book->update($request->all());
        return $book;
    }

    public function destroy($id) {
        return Borrower::destroy($id);
    }
}
