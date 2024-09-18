@extends('layouts.app')
@section('title', 'Product')
@section('content')
    <form action="{{ route('product.update', $edit->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3 row">
            <div class="col-sm-2">
                <label for="">Nama Kategori*</label>
            </div>
            <div class="col-sm-5">
                <select required name="category_id" id="" class="form-control">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                {{-- <input required type="text" class="form-control" name="category_id" placeholder="Category Name"> --}}
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-sm-2">
                <label for="">Product Name*</label>
            </div>
            <div class="col-sm-5">
                <input required type="text" class="form-control" name="product_name" placeholder="Category Name"
                    value="{{ $edit->product_name }}">
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-sm-2">
                <label for="">Qty*</label>
            </div>
            <div class="col-sm-5">
                <input required type="text" class="form-control" name="product_qty" placeholder="Category Name"
                    value="{{ $edit->product_qty }}">
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-sm-2">
                <label for="">Deskripsi</label>
            </div>
            <div class="col-sm-5">
                <input required type="text" class="form-control" name="description" placeholder="Category Name"
                    value="{{ $edit->description }}">
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-sm-2">
                <label for="">Harga*</label>
            </div>
            <div class="col-sm-5">
                <input required type="text" class="form-control" name="product_price" placeholder="Category Name"
                    value="{{ $edit->product_price }}">
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-sm-5">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
@endsection
