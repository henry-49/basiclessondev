@extends('layouts.app')

@section('title')
    Show
@endsection

@section('content')
<div class="jumbtron">
    <div class="well">
        <h1>Welcome to service page</h1>
        <h2>Product Details</h2>
        
        <div>
                <h1>{{ $product->product_name }}</h1>
                <h4>$ {{ $product->product_price }}</h4>
                 <p>Description: {{ $product->product_description }}</p>
                <hr>
                <h4>Created at: {{ $product->created_at }}</h4>
                <hr>
                <a href="/products/{{ $product->id }}/edit" class="btn btn-primary">Edit</a>
                {!!Form::open(['action' => ['ProductController@destroy', $product->id], 'class' => 'pull-right'])!!}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                {!! Form::close() !!}
                {{-- <a href="/products/{{ $product->id }}/delete" class="btn btn-danger">Delete</a> --}}
        </div> 
    </div>
    
</div>
@endsection