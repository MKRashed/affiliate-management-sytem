<x-app-layout>
  <form method="POST" action="{{ route('transcations.store') }}" class="max-w-md mx-auto bg-white p-4 rounded">
    @csrf

    <!-- Amunt -->
    <div>
        <x-input-label for="amount" :value="__('Amount')" />
        <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount')" required  placeholder="eg. 10000Tk" />
        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
    </div>

    <!-- Transaction  Id-->

    <div class="mt-4">
        <x-input-label for="transaction" :value="__('Transaction Id')" />
        <x-text-input id="transaction" class="block mt-1 w-full" type="text" name="transaction" :value="old('transaction')" required placeholder="eg.TEEKJSOISf"  />
        <x-input-error :messages="$errors->get('transaction')" class="mt-2" />
    </div>


    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ms-4">
            {{ __('Sumbit') }}
        </x-primary-button>
    </div>
</form>
</x-app-layout>