@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="content">
    <h1 class="page-title">商品の出品</h1>
    <form action="{{ route('sell.store') }}" class="sell-form" method="post" enctype="multipart/form-data">
        @csrf
      <div class="image-file">
        <label for="" class="label">商品画像</label>
        <input type="file" id="fileInput" style="display: none;" accept="image/*" name="img_url">
            <div id="previewArea">
                <img src="{{ asset($item->img_url ?? '') }}" alt="" class="">
           
        
            <label for="fileInput" class="image-btn">画像を選択する</label>
            </div>
            <p class="form_error">
                @error('img_url')
                {{$message}}
                @enderror
            </p>
      </div>
        
        <section class="detail">
            <h2 class="section-title">商品の詳細</h2>
            <label class="label">カテゴリー</label>
            <div class="button-container">
              {{-- {{ dd($categories) }}--}}
                @foreach($categories as $category)
                <input type="checkbox" name="category_ids[]" value="{{$category->id}}" class="category-checkbox" id="category-{{ $category->id }}">
                <label for="category-{{ $category->id }}" class="category-button">
                   {{-- <input type="checkbox" name="category_ids[]" value="{{$category->id}}" class="category-checkbox">--}}{{$category->name}}
                </label>
                @endforeach
                <p class="form_error">
                    @error('category_ids')
                    {{$message}}
                    @enderror
                </p>
            </div>

            <label for="" class="label">商品の状態</label>
            <div class="select-wrapper">
                 <!-- <span class="checkmark">✔</span> -->
                 <!-- <span class="checkmark">{{ old('condition_id', $condition_id) ? '✔' : '' }}</span> -->
                <select class="select checkmark-select" name="condition_id" id="">
                <option value="" disabled hidden {{ empty(old('condition_id', $condition_id)) ? 'selected' : '' }}>選択してください

                </option>
                @foreach($conditions as $condition)
                {{--<option value="{{$condition->id}}" class="checkmark-option">
                    {{$condition->content}}
                </option>--}}
                <option value="{{$condition->id}}" {{ old('condition_id', $condition_id) == $condition->id ? 'selected' : '' }}>
                    <!-- &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;-->{{$condition->content}} 
                  {{--   @if(old('condition_id',$condition_id )==$condition->id)
                        ✔
                     @endif
                    {{ $condition->content }}--}}
            
                </option>
                @endforeach
                </select>
               <p class="form_error">
                    @error('condition_id')
                    {{$message}}
                    @enderror
                </p>
            </div>
             
        </section>

        <section class="description">
            <h2 class="section-title">商品名と説明</h2>
            <label for="" class="label">商品名</label>
            <!-- <div class="text-input"> -->
            <input type="text" class="input" name="name" value="{{ old('name') }}">
            <p class="form_error">
                @error('name')
                {{$message}}
                @enderror
            </p>
            <!-- </div> -->
             <label for="" class="label">ブランド名</label>
            <!-- <div class="text-input"> -->
            <input type="text" class="input" name="brand_name" value="{{ old('brand_name') }}">
            <!-- </div> -->
            <label class="label">商品の説明</label>
            <textarea name="description" class="textarea">{{old('description') }}</textarea>
            <p class="form_error">
                @error('description')
                {{$message}}
                @enderror
            </p>
            <label for="" class="label">販売価格</label>
            <!-- <div class="text-input"> -->
            <input type="text" class="input" name="price" value="{{old('price') ? '￥' . number_format((int)preg_replace('/\D/', '', old('price'))) : '￥' }}">
            <!-- </div> -->
             <p class="form_error">
                @error('price')
                {{$message}}
                @enderror
             </p>
        </section>
        <div class="button">
            <button class="sell-button" type="submit">出品する</button>
        </div>
    </form>

</div>

@endsection