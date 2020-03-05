<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- @if(withInput :: has('success'))

  <p class="text-center">{{Session :: get('success') }}</p>


@endif --}}
<?php
 //dd(storage_path("uploads/Brofest.jpg"))
//dd(database_path())
?>
 <img src="{{asset('storage/uploads/Brofest.jpg' ) }}" width="100" height="100" />

<form action="{{route("form_insert")}}"  method="POST" enctype="multipart/form-data">
        @csrf
<input type="text" placeholder="name input" value="{{old('hola_name') }}" name="hola_name" />
        <input type="text" placeholder="phone input" value="{{old('hola_phone') }}"  name="hola_phone" />
        <input type="file" placeholder="file input"  name="image" />
        <input type="submit"  />
    </form>
    <table border="1">
        @foreach ($ki as $item)
            <tr>
                <td>
                    {{$item->product_name}}    
                <td>
                <td>
                    {{$item->product_stock}}    
                <td>
            </tr>
        @endforeach
    </table>

    <form method="get" action="">
         <?php
         if(request()->has('product_stock')){?>
              <input type="text" name="product_stock" value="5" hidden />
         <?php
        }
        ?>
   
         
        <input type="text" name="sortby" value="product_name" hidden />
        <input type="submit"  value="sort by name" />

    </form>


    
    <form method="get" action="">

         <?php
         if(request()->has('sortby')){?>
               <input type="text" name="sortby" value="product_name" hidden />
         <?php
        }
        ?>
        <input type="text" name="product_stock" value="5" hidden />
        <input type="submit"  value="filter by stock" />

    </form>
<a href="{{ route("homee")}}">Reset</a>
    
</body>
</html>