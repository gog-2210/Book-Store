@extends('client.layout.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Menu Danh Mục -->
        <div class="bg-white rounded-lg shadow-md p-4">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Danh Mục</h2>
            <ul class="space-y-2">
                @foreach($itemCategories as $parent)
                    @if($parent->parent_id === null)
                        <li>
                            <a href="{{ route('category.show', $parent->id) }}" class="block text-gray-700 hover:text-blue-600 font-semibold">
                                {{ $parent->category_name }}
                            </a>
                            @if($parent->subCategories->count())
                                <ul class="ml-4 space-y-1">
                                    @foreach($parent->subCategories->sortBy('order') as $subCategory)
                                        <li>
                                            <a href="{{ route('category.show', $subCategory->id) }}" class="block text-gray-600 hover:text-blue-400">
                                                - {{ $subCategory->category_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <!-- Nội Dung Chính -->
        <div class="md:col-span-3 bg-white rounded-lg shadow-md p-4">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Danh Sách Sách</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            </div>
        </div>
    </div>
</div>
@endsection
