@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/buy.css') }}">
@endsection

@section('content')

<div class="all-contents">
    <!-- <form action="" class=""> -->
    <div class="left-content">
        <div class="item">
            <div class="image-card">
             <img src="{{ asset($item->img_url) }}" alt="" class="item-img">
             <!-- <p class="img">商品画像</p> -->
             </div>
            <div class="item-info">
             <label for="" class="item-name">{{ $item->name }}</label>
             <p class="item-price"><span>￥</span>{{number_format($item->price)}}</p>
             </div>
        </div>
    <form action="{{route('purchase.updatePayment') }}" method="post">
    @csrf
        <input type="hidden" name="item_id" value="{{ $item->id}}">
        <div class="pay-method">
        <label for="payment_method" class="label-title">支払い方法</label>
       
        <!-- <div class="select-inner"> -->
        <select class="select" name="payment_method" id="payment_method" onchange="this.form.submit()" >
            <option value="" disabled {{ empty(old('payment_method', $payment_method)) ? 'selected' : '' }}>選択してください</option>
            <option value="コンビニ支払い" {{ old('payment_method', $payment_method) == 'コンビニ支払い' ? 'selected' : '' }}>コンビニ支払い</option>
            <option value="カード支払い" {{ old('payment_method', $payment_method) == 'カード支払い' ? 'selected' : '' }}>カード支払い</option>
    </select>
            {{--<option value=""disabled selected>選択してください</option>
            <option value="カード支払い" {{ old('payment_method', $payment_method ?? '') == 'カード支払い' ? 'selected' : '' }}>カード支払い</option>
            <option value="コンビニ支払い" {{ old('payment_method', $payment_method ?? '') == 'コンビニ支払い' ? 'selected' : '' }}>コンビニ払い</option>--}}
           {{--@foreach($payment_methods as $method)
            <option value="{{ $method}}">&#160;&#160;&#160;{{$method}}</option>
           @endforeach--}}
        </select>
        <style>
            select:focus option[value=""] {
            display: none;
            }
        </style>
        <p class="form_error">
            @error('payment_method')
            {{$message}}
            @enderror
        </p>
        <!-- </div> -->
        </div>
    </form>
    {{--<form action="{{ route('purchase.store',['item_id' => $item->id]) }}" class="" method="post">--}}
      <form action="{{ route('purchase.store') }}" method="post">  
    @csrf
     <input type="hidden" name="item_id" value="{{ $item->id }}">  
      <input type="hidden" name="payment_method" value="{{ $payment_method }}">
        <div class="shipping-info">
            <div class="flex">
            <label for="" class="label-title">配送先</label>
            <a href="{{route('purchase.address',['item_id' => $item->id]) }}" class="link">変更する</a>
            </div>
         <p class="address"><span>〒</span>{{$shipping_post_code}}</p>
         <p class="address">{{$shipping_address}}</p>
         <p class="address">{{$shipping_building}}</p>
        
         {{--   <input type="hidden" name="shipping_address" value="{{ auth()->user()->profile->address }}">
            <input type="hidden" name="shipping_post_code" value="{{ auth()->user()->profile->post_code }}">
            <input type="hidden" name="shipping_building" value="{{  auth()->user()->profile->building }}">--}}
             <input type="hidden" name="shipping_address" value="{{ $shipping_address }}">
            <input type="hidden" name="shipping_post_code" value="{{ $shipping_post_code }}">
            <input type="hidden" name="shipping_building" value="{{ $shipping_building }}">
  
        </div>
    </div>

    <div class="right-content">
        
        <table>
            <!-- <div class="table__inner"> -->
            <tr>
                <th>商品代金</th>
                <td>￥{{number_format($item->price)}}</td>
            </tr>
            <tr>
                <th>支払い方法</th>
                <td>{{$payment_method}}</td>
            </tr>
            <!-- </div> -->
        </table>
        

        <div class="buy-btn">
            <button class="button" type="submit">購入する</button>
        </div>
    </div>
    <!-- </form> -->
</div>
</form>
@endsection