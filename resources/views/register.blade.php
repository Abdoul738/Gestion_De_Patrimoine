
<!DOCTYPE html>
<html>
 <head>
  <title>Register</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
   }
  </style>
 </head>
 <body>
  <br/>
    <div class="container box" style="width:90%">
        <h3 align="center">Page d'inscription</h3>
        @if(Session::get('register_status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('register_status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        @endif
        <form method="post" action="{{ url('/registerUser') }}" return="false">
        {{ csrf_field() }}
            <div class="form-group">
                <label>Name
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter Name" required>
            </div>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @csrf
            <div class="form-group">
                <label>Email
                <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter Email" required>
            </div>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label>Password
                <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Enter Password" required>
            </div>
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label>Confirm Password
                <input type="password" name="confirm_password" value="{{ old('confirm_password') }}" class="form-control" placeholder="Confirm Password" required>
            </div>
            @error('confirm_password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label>Mobile</label>
                <input type="number" name="mobile" value="{{ old('mobile') }}" class="form-control" placeholder="Enter Mobile Number" required>
            </div>
            @error('mobile')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </body>
</html>
