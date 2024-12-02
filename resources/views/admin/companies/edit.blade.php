@extends('admin.layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow-lg">
    <h1 class="text-3xl font-bold mb-4 text-center">Chỉnh Sửa Công Ty</h1>

    <form action="{{ route('admin.companies.update', $company->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="company_name" class="block font-semibold">Tên Công Ty:</label>
            <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $company->company_name) }}" class="border p-2 w-full" required>
            @error('company_name')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="company_info" class="block font-semibold">Thông Tin Công Ty:</label>
            <textarea name="company_info" id="company_info" rows="5" class="border p-2 w-full">{{ old('company_info', $company->company_info) }}</textarea>
            @error('company_info')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Cập Nhật</button>
            <a href="{{ route('admin.companies.index') }}" class="bg-gray-500 text-white p-2 rounded">Quay Lại</a>
        </div>
    </form>
</div>
@endsection
