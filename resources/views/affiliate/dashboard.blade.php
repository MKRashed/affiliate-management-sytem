@extends('affiliate.layouts.app')

@section('content')
    <h2 class="font-semibold text-xl text-gray-800 text-center leading-tight">
        {{ __('Affiliate Dashboard') }}
    </h2>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in sdfsdf!") }}
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col max-w-2xl mx-auto bg-white">
        <div class="p-6 text-gray-900 text-center font-bold text-xl">
            {{ __("You're Commition List") }}
        </div>
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full">
                <thead class="bg-white border-b">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                      #
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                      Amount
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                      Date
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($commitions as $transaction)
                  <tr class="bg-gray-100 border-b">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $loop->iteration }}
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                      {{  $transaction->amount }}
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                      {{  $transaction->created_at }}
                    </td>
                  </tr>
                 @endforeach
                 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection
