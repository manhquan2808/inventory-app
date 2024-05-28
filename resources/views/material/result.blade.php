<!DOCTYPE html>
<html>
<head>
    <title>Result</title>
</head>
<body>
    <h1>{{ $message }}</h1>
    @if ($material)
        <p>ID: {{ $material->input_id }}</p>
        <p>Tên: {{ $material->material_name }}</p>
        {{-- <p>Đơn vị: {{ $material->unit }}</p>
        <p>Giá mỗi đơn vị: {{ $material->price_per_unit }}</p>
        <p>Trạng thái: {{ $material->status }}</p> --}}
    @else
        <p>Nguyên liệu không tồn tại.</p>
    @endif
</body>
</html>
