<html>
<head>
<title>Laravel Generate &amp; Download Pdf Tutorial</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
body{
background-color: #f1f1f1;
}
</style>
<body>
<div class="container contact">
<br><br><br>
<div class="row">
<div class="col-md-8 offset-md-2">
<form action="{{route('pdf_download') }}" method="post" accept-charset="utf-8">
@csrf
<div class="contact-form">
<div class="form-group">
<label class="control-label col-sm-2" for="fname">First Name:</label>
<div class="col-sm-10">
   <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
   <span class="text-danger">{{ $errors->first('name') }}</span>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-2" for="email">Email:</label>
<div class="col-sm-10">
   <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
   <span class="text-danger">{{ $errors->first('email') }}</span>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-2" for="comment">Comment:</label>
<div class="col-sm-10">
   <textarea class="form-control" rows="5" name="message" id="message"></textarea>
   <span class="text-danger">{{ $errors->first('message') }}</span>
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
   <button type="submit" class="btn btn-default">Submit</button>
</div>
</div>
</div>
</form>
</div>
</div>
<br><br><br><br>
</div>
</body>
</html>