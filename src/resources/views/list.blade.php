@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/list.css')}}">
@endsection

@section('content')
<div class="product-list">
    <h2 class="product-list__heading content__heading">商品一覧</h2>
    <a href="/products/register" class="add-button">+ 商品を追加</a>
</div>

<form class="search-form" action="/products/search" method="get">
    <input class="search-form__keyword-input" type="text" name="keyword" placeholder="商品名で検索" value="{{request('keyword')}}">
    <button type="submit" class="search-form__button">検索</button>
</form>
<form class="sort-form" action="/products" method="get">
    <h3 class="option__heading">価格順で表示</h3>
    <select name="sort" onchange="this.form.submit()">
            <option value="">価格で並べ替え</option>
            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>低い順に表示</option>
            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>高い順に表示</option>
    </select>
    @if (request('sort'))
        <div class="sort-tag">
            <span>
                @if(request('sort') === 'price_asc')
                    低い順に表示
                @elseif (request('sort') === 'price_desc')
                    高い順に表示
                @endif
            </span>
            <a href="/products" class="clear-sort">×</a>
        </div>
    @endif
</form>


<div class="product-grid">
    @foreach ($products as $product)
        <a href="/products/{{ $product->id }}" class="product-card-link">
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <div class="product-info">
                    <p>{{ $product->name }}</p>
                    <p>¥{{ $product->price }}</p>
                </div>
            </div>
        </a>
    @endforeach
</div>

<div class="pagination">
    {{ $products->links('vendor.pagination.tailwind') }}
</div>

@endsection