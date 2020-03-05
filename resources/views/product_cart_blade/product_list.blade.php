<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>rakib's</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <form action="{{ route("add_to_cart")}}" method="post">
    <div class="row mt-3">
    <div class="col-md-2 text-right">
    <p><b>Select Product</b></p>
    </div>

                <div class="col-md-6">
        <select class="form-control" name="product" required>
            <option value="">Select Product</option>    
            @foreach ($product_list as $item)
        <option value="{{ $item["p_id"] }}">{{ $item["p_name"]." (".$item["p_qty"].")" }}</option>    
            @endforeach
            
        </select>
    </div>
    <div class="col-md-3">
       
    </div>
      
    </div>
    <div class="row mt-3">
        <div class="col-md-2 text-right">
            <p><b>Add Quantity</b></p>
        </div>
        <div class="col-md-6">
            <input name="qty" type="number" class="form-control" >
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 text-right"></div>
        <div class="col-md-6">
            <input type="submit" class="btn btn-md btn-info float-right" value="Add To Cart">
        </div>
        <div class="col-md-3"></div>
    </div>
    </form>
    </div>
    
</body>
</html>