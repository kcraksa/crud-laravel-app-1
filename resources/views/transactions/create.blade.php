
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Transaction') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
              <form action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf

                  <div>
                      <label for="type" class="block font-medium text-sm text-gray-700">Tipe Transaksi</label>
                      <select name="type" id="type" class="form-select mt-1 block w-full" >
                          <option value="topup">Topup</option>
                          <option value="transaction">Transaksi</option>
                      </select>
                  </div>

                  <div class="mt-4">
                      <label for="amount" class="block font-medium text-sm text-gray-700">Jumlah</label>
                      <input type="number" name="amount" id="amount" class="form-input mt-1 block w-full">
                  </div>

                  <div class="mt-4">
                      <label for="description" class="block font-medium text-sm text-gray-700">Keterangan</label>
                      <textarea name="description" id="description" rows="3" class="form-textarea mt-1 block w-full"></textarea>
                  </div>

                  <div class="mt-4" id='uploadField'>
                      <label for="proof" class="block font-medium text-sm text-gray-700">Bukti Topup</label>
                      <input type="file" name="proof" id="proof" class="form-input mt-1 block w-full">
                  </div>

                  <div class="mt-6">
                      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                          Simpan
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var type = document.getElementById('type');
        var uploadField = document.getElementById('uploadField');

        type.addEventListener('change', function() {
            if (type.value === 'topup') {
                uploadField.style.display = 'block';
            } else {
                uploadField.style.display = 'none';
            }
        });
    });
  </script>
</x-app-layout>
