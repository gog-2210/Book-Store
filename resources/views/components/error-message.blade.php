@if ($errors->has($field))
    <span class="text-red-600 text-sm">{{ $errors->first($field) }}</span>
@endif
