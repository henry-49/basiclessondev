@extends('layouts.app')

@section('title')
    Create
@endsection


@section('content')
    <div class="jumbtron">
       @if (Session::has('success'))
            <div class="alert alert-success">
              {{ Session::get('success') }}
              {{-- setting session to null --}}
            {{ Session::put('success', null) }} 
          </div>
    @endif
        <div class="well">
         
            {{-- <form action="{{ url('/saveproduct') }}" method="post" class="form-horizontal"> --}}

              {!!Form::open(['action' => 'PagesController@saveproduct', 'method' => 'POST', 'class' => 'form-horizontal'])!!}

                {{ csrf_field() }}
    
                <div class="form-group">
                    {{-- <label for="formGroupExampleInput" class="form-label">Product Name</label> --}}
                     {{-- <input type="text" name="product_name" class="form-control"  placeholder="Enter Product Name" required> --}}
                     
                    {{Form::label('', 'Product Name')}}
                    {{Form::text('product_name', '', ['placeholder' => 'Enter Product Name', 'class' => 'form-control'])}}
                  </div>
                  <div class="form-group">
                    {{-- <label for="formGroupExampleInput2" class="form-label">Product Price</label> --}}
                    {{-- <input type="text" name="product_price" class="form-control" placeholder="Enter Product Price" required> --}}

                     {{Form::label('', 'Product Price')}}
                    {{Form::text('product_price', '', ['placeholder' => 'Enter Product Price', 'class' => 'form-control'])}}
                  </div>
            
                  <div class="form-group">
                    {{-- <label for="formGroupExampleInput2" class="form-label">Product Description</label> --}}
                    {{-- <textarea name="product_description"  cols="30" rows="10" class="form-control"></textarea> --}}

                     {{Form::label('', 'Product Description')}}
                    {{Form::textarea('product_description', '', ['placeholder' => 'Product Description', 'class' => 'form-control'])}}
                  </div>
                  {{-- <input type="submit" value="Add Product" class="btn btn-primary"> --}}
                  {{Form::submit('Add Product', ['class' => 'btn btn-primary'])}}

                {!!Form::close()!!}
            {{-- </form> --}}
          
        </div>
        
    </div>
@endsection