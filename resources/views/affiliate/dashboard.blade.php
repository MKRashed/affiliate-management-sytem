@extends('affiliate.layouts.app')

@section('content')
    <div class="max-w-7xl flex gap-4 py-12 justify-between mx-auto sm:px-6 lg:px-8">
      <div class="w-full flex flex-col max-w-2xl mx-auto bg-white">
        <div class="p-6 text-blue-900 text-center font-bold text-xl">
          {{ __("You're commition List") }}
        </div>
          <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
              <div class="overflow-hidden">
                <table class="min-w-full">
                  <thead class="bg-gray-200 border-b">
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
                    @foreach ($own_commitions->commitions as $key=>$transaction)
                    <tr class="bg-gray-50 border-b">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                          {{ $loop->iteration }}
                      </td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        {{ $transaction->amount }}
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

      @if (auth()->user()->role === 'affiliate')
        <div class="w-full flex flex-col max-w-2xl mx-auto bg-white">
            <div class="p-6 text-blue-900 text-center font-bold text-xl">
                {{ __("You're created sub affiliate List") }}
            </div>
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                  <table class="min-w-full">
                    <thead class="bg-gray-200 border-b">
                      <tr>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                          #
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                          Sub Affiliate
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                          Commition Details
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $key=>$transaction)
                      <tr class="bg-gray-50 border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $loop->iteration }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                          <div>
                          <div> {{ $transaction['name'] }}</div>
                          <div>{{ $transaction['email'] }}</div>
                          </div>
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                          @foreach ($transaction['commitions'] as $index => $commition )
                            <div>
                              {{ ++ $index  }}. {{ $commition['amount'] }} ( {{ $commition['created_at'] }})
                            </div>
                            
                          @endforeach
                        </td>
                      </tr>
                    @endforeach
                    
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      @endif
      
    </div>
@endsection
