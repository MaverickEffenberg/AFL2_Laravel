@extends('layouts.layout')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">My Wishlist</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($wishlist->isEmpty())
        <p>Your wishlist is empty.</p>
    @else
        <table class="w-full table-auto border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">Plant</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wishlist as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $item->plant->name }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('wishlist.destroy', $item->plant->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" text-white px-3 py-1 rounded">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
