<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-6 sm:px-6 lg:px-8">
      <div class="row mb-4">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Total Balance</h5>
                      <h6 class="card-subtitle mb-2 text-muted">Your current balance</h6>
                      <p class="card-text">Rp {{ $currentBalance }}</p>
                  </div>
              </div>
          </div>
      </div>
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-3 font-bold text-xl">Daftar Transaksi</h2>
                <div class="text-end">
                  <a href="/create-transaction" class="btn btn-primary my-4">Create Transaction</a>
                </div>
                <table id="transactionTable" class="table">
                    <thead>
                        <tr>
                            <th>Kode Transaksi</th>
                            <th>Tipe Transaksi</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Bukti Topup</th>
                            <th>Waktu Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->transaction_code }}</td>
                            <td>{{ $transaction->type }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>
                                @if($transaction->proof_url)
                                <a href="{{ asset('storage/'.$transaction->proof_url) }}" target="_blank">Lihat Bukti Topup</a>
                                @else
                                -
                                @endif
                            </td>
                            <td>{{ $transaction->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#transactionTable').DataTable();
        });
    </script>
</x-app-layout>


