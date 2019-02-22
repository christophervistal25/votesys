<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		  <script>
          window.myApp = {
          	'image_path' : '{{ URL::asset('images/') }}',
         	'last_vote' : '{{ \DB::table('student_vote')
         											->orderBy('created_at','desc')
         											->first()->created_at ?? 0 }}'
          };
        </script>
		<title>Vote Sys | {{ $title }}</title>
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.amaran/0.5.4/amaran.min.css">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
		<!-- Bootstrap -->
		<link rel="stylesheet" href="{{ URL::asset('/bootstrap/dist/css/bootstrap.min.css') }}">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ URL::asset('font-awesome/css/font-awesome.min.css') }}">
		<!-- NProgress -->
		<link href="{{ URL::asset('nprogress/nprogress.css') }}" rel="stylesheet">
		<!-- Custom Theme Style -->
		<link href="{{ URL::asset('custom.min.css') }}" rel="stylesheet">
	</head>
