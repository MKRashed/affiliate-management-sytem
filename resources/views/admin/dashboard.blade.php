@extends('admin.layouts.app')

@section('content')

<div class="flex flex-col max-w-2xl mx-auto bg-white mt-10">
  <div class="p-6 text-cyan-500 text-center font-bold text-xl">
      {{ __("Affiliate User Commition Lisr") }}
  </div>
  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
      <div class="overflow-hidden">
        <table class="min-w-full">
          <thead class="bg-gray-300 border-b capitalize">
            <tr>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Name
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Email
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Commition
              </th>
             
            </tr>
          </thead>
          <tbody>
            @foreach ($affiliate_user_commition as $commition)
            <tr class="!bg-white border-b">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  {{ $commition->name }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                {{ $commition->email }}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
               <div class="flex flex-col  justify-center items-center">
                <span>{{  $commition->total_amount }} .Tk</span>
                <button class="text-blue-500"> See Every transaction </button>
               </div>
              </td>
              
            </tr>
           @endforeach
           
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="flex flex-col max-w-2xl mx-auto bg-white mt-10">
  <div class="p-6 text-cyan-500 text-center font-bold text-xl">
      {{ __("User Money Add List") }}
  </div>
  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
      <div class="overflow-hidden">
        <table class="min-w-full">
          <thead class="bg-gray-200 border-b">
            <tr>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Name
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Email
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Add total money 
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($user_add_money as $user)
            <tr class="!bg-white border-b">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  {{ $user->name }}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{ $user->email }}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                <div class="flex flex-col  justify-center items-center">
                  <span>{{  $user->total_amount }} .Tk</span>
                  <button class="text-blue-500"> See Every transaction </button>
                </div>
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
