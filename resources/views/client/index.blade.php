@extends('client.layout.app')

@section('content')
<div class="container mx-auto my-8 px-4">
    <!-- Tiêu đề Danh Mục -->
    <h3 class="text-center text-xl font-semibold text-gray-700 mb-6">Danh Mục</h3>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">
        @foreach($categories as $category)
            <x-category-item :category="$category" class="p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out" />
        @endforeach
    </div>
</div>

<div class="container mx-auto my-8 px-4">
    <!-- Tiêu đề -->
    <h3 class="text-center text-xl font-semibold text-gray-700 mb-6">Sách Gợi Ý</h3>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mx-10">
        @foreach($booksBySuggest as $book)
            <x-book-item :book="$book" class="transition transform hover:scale-105 duration-300 ease-in-out rounded-lg shadow-md hover:shadow-xl" />
        @endforeach
    </div>
</div>
@endsection
