<head>
    <base href="/">
    <link href="source/assets/dest/css/show.css" rel="stylesheet">
</head>

@extends('admin.layout')

@section('title', 'Thông tin danh mục')

@section('content')
<h4>Thông tin danh mục</h4>
<div class="col-sm-6">

    <div class="form-group">
        <h4><b>Id danh mục: </b> {{ $danhMuc->id }}</h4>
    </div>
    <div class="form-group">
        <h4><b>Tên danh mục: </b> {{ $danhMuc->name }}</h4>
    </div>
    <div class="form-group">
        <h4><b>Mô tả: </b> {{ $danhMuc->description }}</h4>
    </div>
    <div class="form-group">
        <h4><b>Trạng thái: </b> {{ $danhMuc->status ? 'Hiển thị' : 'Ẩn' }}</h4>
    </div>
    <div class="form-group">
        <h4><b>Ngày tạo: </b> {{ $danhMuc->created_at->format('d/m/Y H:i') }}</h4>
    </div>
    <div class="form-group">
        <h4><b>Ngày cập nhật: </b> {{ $danhMuc->updated_at->format('d/m/Y H:i') }}</h4>
    </div>
    <div class="col-sm-12" style="margin-bottom: 15px">
        <div class="shop-menu pull-left">
            <button class="btn btn-danger confirmDeletion" data-id="{{ $danhMuc->id }}">Xóa</button>
        </div>
        <div class="shop-menu pull-right">
            <a class="btn btn-success" href="{{ route('danhmuc.edit', $danhMuc->id) }}">Chỉnh sửa</a>
            <a class="btn btn-warning" href="{{ route('danhmuc.index') }}">Quay lại</a>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.confirmDeletion', function() {
        var id = $(this).data('id');
        var token = '{{ csrf_token() }}'; // CSRF token

        if (confirm("Bạn có chắc chắn muốn xóa mục này?")) {
            $.ajax({
                url: "{{ route('danhmuc.destroy', '') }}/" + id, // Sử dụng route để tạo URL
                type: 'DELETE',
                data: {
                    _token: token
                },
                success: function(response) {
                    alert('Danh mục đã được xóa thành công.');
                    window.location.href = "{{ route('danhmuc.index') }}";
                },
                error: function(xhr) {
                    if (xhr.status === 403) {
                        var response = JSON.parse(xhr.responseText);
                        alert(response.error);
                    } else {
                        alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
                    }
                }
            });
        }
    });
</script>