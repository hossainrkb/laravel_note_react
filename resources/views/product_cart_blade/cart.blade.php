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
       <div class="row">
           <div class="col-md-12">
               <table class="table">
                   <tr>
                       <td><b>count</b></td>
                       <td><b>product name</b></td>
                       <td><b>quantity</b></td>
                       <td><b>price</b></td>
                   </tr>
                   @php ($count = 1)
                   @php ($total = 0)
                   @foreach ($cart as $item)
                   <tr>
                <td>{{ $count }}</td>
                <td>{{ $item["product"] }}</td>
                <td>{{ $item["qty"] }}</td>
                <td>{{ $item["qty"] }}</td>
                       @php ($count++)
                       @php ($total = $total + $item["qty"])
                   </tr>
                   @endforeach
                   <tr>
                   <td colspan="4" class="text-right">{{ $total }} . tk</td>
                   </tr>
               </table>
                <form action="{{ route("pay_now")}}" method="post">
                @csrf
                 <input type="submit" class="btn btn-md btn-info float-right" value="checkout">
                </form>
           </div>
       </div>
    </div>
    
</body>
</html>