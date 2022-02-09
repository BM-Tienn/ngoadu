<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="#">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>Thank you</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('client/css/thank.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">&nbsp</div>
                <div class=" box col-xl-8 col-lg-8 col-md-12 col-sm-12">
                    <h1>Thank You!</h1>
                    <h6>Your order has been successfully ordered</h6>
                    <h6>Order information has been emailed to you. Thank you!</h6>
                    <div class="row">
                        <div class="col-12"><a href="{{ url('home') }}"><button>Back to our home</button> </a></div>
                    </div>
                    
                </div>
                <div class="col-2">&nbsp</div>
            </div>
        </div>
    </div>
    <!-- /content -->
</body>
</html>