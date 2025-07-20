@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css')}}">
<link href="https://fonts.cdnfonts.com/css/Hiragino Kaku Gothic Pro" rel="stylesheet">

@endsection

@section('content')
<div class="register-form">
    <h2 class="register-form__heading content__heading">商品登録</h2>
    <div class="register-form__inner">
        <form class="register-form__form" action="/products" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="register-form__group">
                <label class="register-form__label" for="name">商品名</label>
                <span class="form__label--required">必須</span>
                <input class="register-form__input" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="商品名を入力">
                <p class="register-form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <label class="register-form__label" for="price">値段</label>
                <span class="form__label--required">必須</span>
                <input class="register-form__input" type="number" name="price" id="price" value="{{ old('price') }}" placeholder="値段を入力">
                <p class="register-form__error-message">
                    @error('price')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <label class="register-form__label" for="image">商品画像</label>
                <span class="form__label--required">必須</span>
                <input class="register-form__input" type="file" name="image" id="image" accept=".png,.jpeg,.jpg">
                <p class="register-form__error-message">
                    @error('image')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <label class="register-form__label">季節</label>
                <span class="form__label--required">必須</span>
                <span class="form__label--note">※複数選択可</span>
                <div class="season-checkbox-group">
                    @foreach(['春', '夏', '秋', '冬'] as $season)
                        <label class="season-checkbox-label">
                            <input type="checkbox" class="season-checkbox" name="seasons[]" value="{{ $season }}"
                            {{ in_array($season, old('seasons', [])) ? 'checked' : '' }}>
                            {{ $season }}
                        </label>
                    @endforeach
                </div>
                <p class="register-form__error-message">
                    @error('seasons')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <label class="register-form__label" for="description">商品説明</label>
                <span class="form__label--required">必須</span>
                <textarea class="register-form__textarea" name="description" id="description" cols="30" rows="10" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                <p class="register-form__error-message">
                    @error('description')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="detail-container__buttons">
                <a href="/products" class="back__btn">戻る</a>
                <button type="submit" class="register-btn">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection