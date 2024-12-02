@extends('admin.layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow-lg">
    <h1 class="text-3xl font-bold mb-4 text-center">Chi Tiết Công Ty</h1>
    
    <div class="mb-4">
        <h2 class="text-lg font-semibold">Tên Công Ty:</h2>
        <p>{{ $company->company_name }}</p>
    </div>

    <div class="mb-4">
        <h2 class="text-lg font-semibold">Thông Tin Công Ty:</h2>
        <p>{{ $company->company_info }}</p>
    </div>

    <div>
        <a href="{{ route('admin.companies.index') }}" class="bg-gray-500 text-white p-2 rounded">Quay lại</a>
        <a href="{{ route('admin.companies.edit', $company->id) }}" class="bg-blue-500 text-white p-2 rounded">Chỉnh sửa</a>
    </div>
</div>
@endsection
