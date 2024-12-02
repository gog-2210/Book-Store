@extends('admin.layout.app')

@section('content')
    <h1 class="text-xl font-semibold mb-4 text-center">Chi Tiết Sách</h1>
    
    <div>
        <p><strong>Tên sách:</strong> {{ $book->book_name }}</p>
        <p><strong>Tác giả:</strong> {{ $book->author }}</p>
        <p><strong>Danh mục:</strong> {{ $book->category->category_name }}</p>
        <p><strong>Công ty:</strong> {{ $book->company->company_name }}</p>
        <p><strong>Nhà xuất bản:</strong> {{ $book->publishing_house }}</p>
        <p><strong>Ngày xuất bản:</strong> {{ $book->publish_date }}</p>
        <p><strong>Người dịch:</strong> {{ $book->translator ?? 'Không có' }}</p>
        <p><strong>Số trang:</strong> {{ $book->number_of_pages }}</p>
        <p><strong>Số lượng:</strong> {{ $book->quantity }}</p>
        <p><strong>Số ấn bản bán được:</strong> {{ $book->sold }}</p>
        <p><strong>Giá:</strong> {{ number_format($book->price, 0, ',', '.') }} ₫</p>
        <p><strong>Mô tả:</strong> {{ $book->description }}</p>
        
        @if ($book->book_image)
            <p><strong>Hình ảnh:</strong> <img src="{{ asset('storage/book_images/' . $book->book_image) }}" alt="Book Image">
            </p>
        @else
            <p><strong>Hình ảnh:</strong> Không có ảnh</p>
        @endif
    </div>
    <a href="{{ route('admin.books.index') }}" class="bg-blue-500 text-white p-2 rounded mt-4 inline-block">Trở lại</a>

@endsection
