@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css')}}">
@endsection

@section('content')
<form action="/products/{{ $product->id }}/update" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="detail-form">
        <a href="/products" class="product-list">商品一覧</a> ＞ {{ $product->name }}
        <div class="detail-form">
            <div class="product-img">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <input type="file" name="image">
                <p>{{ basename($product->image) }}</p>
                <p class="detail-form__error-message">
                    @error('image')
                    {{ $message }}
                    @enderror
            </div>
            <div class="product-info">
                <label class="product-info__label">商品名</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}">
                <p class="detail-form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
            </div>
            <div class="product-info">
                <label class="product-info__label">値段</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}">
                <p class="detail-form__error-message">
                    @error('price')
                    {{ $message }}
                    @enderror
            </div>
            <div class="product-info">
                <label class="product-info__label">季節</label>
                <div class="season-checkbox-group">
                    @foreach(['春', '夏', '秋', '冬'] as $season)
                        <label class="season-checkbox-label">
                            <input type="checkbox" class="season-checkbox" name="seasons[]" value="{{ $season }}"
                        {{ in_array($season, old('seasons',$product->seasons->pluck('name')->toArray())) ? 'checked' : '' }}>
                        {{ $season }}
                        </label>
                    @endforeach
                    <p class="detail-form__error-message">
                    @error('season')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="product-info">
                <label class="product-info__label">商品説明</label>
                <textarea class="description__textarea" name="description"  cols="100" rows="10">{{ old('description', $product->description) }}</textarea>
                <p class="detail-form__error-message">
                    @error('description')
                    {{ $message }}
                    @enderror
            </div>
            <div class="detail-container__buttons">
                <a href="/products" class="back__btn">戻る</a>
                <button type="submit" class="update-btn">変更を保存</button>
            </div>
        </div>
    </div>
</form>
<form action="/products/{{ $product->id }}/delete" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="delete-btn">
        <img src="{{ asset('storage/images/Vector.jpg') }}" alt="削除">
    </button>
</form>
@endsection

