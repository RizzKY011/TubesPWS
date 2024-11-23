@extends('layouts.app')

@section('title', 'Cari Makanan')

@section('content')
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-10">
        <h1 class="text-3xl font-semibold text-center mb-4">Hasil Pencarian</h1>

        <form method="GET" action="{{ url('/cari') }}" class="flex justify-center mb-6">
            <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari pahlawan..." class="px-4 py-2 w-1/2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="ml-2 px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">Cari</button>
        </form>

        @if(isset($results) && count($results) > 0)
            <div class="space-y-4">
                @foreach ($results as $result)
                    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <h2 class="text-xl font-semibold">{{ $result['name'] }}</h2>
                        <p class="text-gray-600">{{ $result['description'] }}</p>
                    </div>  
                @endforeach
            </div>
        @elseif(isset($results))
            <p class="text-center text-gray-500">Tidak ada hasil untuk pencarian ini.</p>
        @endif
    </div>
@endsection
