@extends('client.layout.app')

@section('content')

<section class="bg-cover bg-center h-96" style="background-image: url('/images/book-banner2.jpg');">
    <div class="h-full flex items-center justify-center bg-black bg-opacity-50">
        <div class="text-center text-white">
            <h1 class="text-4xl font-bold">Khuyến mãi mùa hè</h1>
            <p class="mt-4 text-lg">Giảm giá đến 50% cho các đầu sách nổi bật</p>
            <a href="#" class="mt-6 inline-block bg-yellow-500 text-black px-6 py-2 rounded-full">Khám phá ngay</a>
        </div>
    </div>
</section>

<section class="py-12 bg-gray-100">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-center mb-8">Danh Mục Nổi Bật</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
        @foreach($categories as $category)
            <x-category-item :category="$category"
                class="p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out" />
        @endforeach
    </div>
    </div>
</section>

@foreach($parentCategories as $category)
    <div class="container mx-auto my-8 px-4 bg-white rounded-xl shadow-lg" role="region" aria-label="Book Showcase">
        <h3 class="text-xl font-bold mb-6 text-gray-500" id="showcase-title">
            {{ $category->category_name }}
            <hr class="my-4 border-t-4 border-gray-100">
        </h3>
        <div class="relative">
            <div class="overflow-x-auto hide-scrollbar flex space-x-6 pb-4" role="list" aria-labelledby="showcase-title">
                <div class="flex  justify-start gap-6 mx-10">
                    @foreach($category->books as $book)
                        <div class="w-full sm:w-1/2 lg:w-1/4 xl:w-52">
                            <x-book-item :book="$book"
                                class="p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out" />
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>
@endforeach

<div class="container mx-auto my-8 px-4 bg-white rounded-xl shadow-lg">
    <h3 class="text-xl text-center font-bold mb-6 text-gray-800">
        Sách Nổi Bật
        <hr class="my-4 border-t-4 border-gray-100">
    </h3>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mx-10">
        @foreach($booksBySuggest as $book)
            <x-book-item :book="$book"
                class="transition transform hover:scale-105 duration-300 ease-in-out rounded-lg shadow-md hover:shadow-xl" />
        @endforeach
    </div>
</div>
@endsection
