@extends('layouts.app')

@section('title')
    Services
@endsection

@section('content')
   @if (Session::has('success'))
            <div class="alert alert-success">
              {{ Session::get('success') }}
              {{-- setting session to null --}}
            {{ Session::put('success', null) }} 
          </div>
    @endif
<div class="jumbtron">
    <div class="well">
        <h1>Welcome to service page</h1>
        @foreach ($products as $product)
        <div class="well">
                <h1><a href="/show/{{ $product->id }}">{{ $product->product_name }}</a></h1>
                <h3>Price: {{ $product->product_price }}</h3>
               {{--  <p>Description: {{ $product->product_description }}</p>
                <hr>
                <h4>Created at: {{ $product->created_at }}</h4>    --}}        
        </div> 
     @endforeach 

     {{ $products->links() }}
    </div>
    
</div>
@endsection