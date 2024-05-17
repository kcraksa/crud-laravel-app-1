<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        // Ambil user_id dari sesi saat ini
        $userId = auth()->user()->id;

        // Ambil total jumlah topup untuk pengguna
        $totalTopup = Transaction::where('user_id', $userId)->where('type', 'topup')->sum('amount');

        // Ambil total jumlah transaksi untuk pengguna
        $totalTransaction = Transaction::where('user_id', $userId)->where('type', 'transaction')->sum('amount');

        // Hitung saldo saat ini
        $currentBalance = $totalTopup - $totalTransaction;

        $transactions = Transaction::where('user_id', $userId)->get();
        return view('transactions.index', compact('transactions', 'currentBalance'));
    }


    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'type' => 'required|in:topup,transaction',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'proof' => 'nullable|file|image|max:2048', // maksimum ukuran file 2MB
        ]);

        // Upload bukti topup jika ada
        $proofUrl = null;
        if ($request->hasFile('proof')) {
            $proofUrl = $request->file('proof')->store('proofs');
        }

        // Buat transaksi baru
        $transaction = new Transaction();
        $transaction->type = $request->type;
        $transaction->amount = $request->amount;
        $transaction->description = $request->description;
        $transaction->proof_url = $proofUrl;
        $transaction->transaction_code = 'TRX-' . Str::random(8); // generate kode transaksi secara acak
        $transaction->user_id = auth()->user()->id;
        $transaction->save();

        // Redirect dengan pesan sukses
        return redirect('/transactions')->with('success', 'Transaksi berhasil ditambahkan.');
    }
}
