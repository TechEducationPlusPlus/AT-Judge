<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta https-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Open Source Free Judge System">
    <meta name="author" content="Alex Tsvetanov">
    <meta name="keywords" content="Judge, Online, System, C++, C#, Algorithms">
    <meta name="distribution" content="web">
    <meta name="robots" content="index, nofollow">
    <meta https-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" href="/favicon.png">
    <title>Judge :: TechEdu ++</title>
	<link href="/css/jumbotron.css" rel="stylesheet"><link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700"><link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons"><link rel="stylesheet" href="/css/bootstrap.min.css"><link rel="stylesheet" href="/css/bootstrap-material-design.min.css"><link rel="stylesheet" href="/css/ripples.min.css"><link rel="stylesheet" href="/css/snackbar.min.css"><link rel="stylesheet" href="/css/extension.css">
	
	<link rel="stylesheet" href="/d9757859af.css">
	<link rel="stylesheet" href="/css/quiz.css">
</head>

<body>
    <nav class="navbar navbar-fixed-top navbar-default"><a href="#" class="navbar-brand">TechEdu ++</a>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="/contactus.php" class="nav-link">Contact</a></li>
                <li class="nav-item"><a href="/aboutus.php" class="nav-link">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item" id="login"></li>
                <li class="nav-item"><a href="/register.php" class="nav-link">Register</a></li>
                <li style="border-right: rgba(0,0,0,0) solid 20px;" class="nav-item active"><a href="/user.php" class="nav-link">Hi<?php if (isset($_COOKIE ["name"])){echo ", "; echo $_COOKIE ["name"];} ?></a></li>
            </ul>
        </div>
    </nav>
	<div style="height: 50px"></div>
    <div class="jumbotron">
        <div class="container">
			<h1 class="display-3">{{title}}</h1>
        </div>
    </div>
	<div class="container">
        <div class="row">
            <div class="col-md-12" style="padding-right: 45px !important; padding-left: 45px !important;">
                <form enctype="multipart/form-data" action="/submission_quiz.php" method="POST" onsubmit="return validateForm()">
                    <div class="col-md-12">
                        <label for="email">Email address</label>
                        <input type="email" minlength=1 required name="email" value="{{email}}" readonly="" class="form-control"><small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small></div>
                    </div>
                    <div class="col-md-12">
						{{tasks}}
                    </div>
                    <div class="col-md-12">
						<input type="hidden" name="contest" value="{{quizid}}">
						<button type="submit" class="btn btn-raised btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <footer>
        <center>
            <p>Copyrights © Alex Tsvetanov 2016-2017</p>
        </center>
    </footer>
	<script src="/js/jquery.min.js"></script><script src="/js/tether.min.js"></script><script src="/js/bootstrap.min.js"></script><script src="/js/material.min.js"></script><script src="/js/ripples.min.js"></script><script src="/js/snackbar.min.js"></script><script src="/js/jquery.nouislider.min.js"></script><script src="/js/jquery.cookie.js"></script><script src="/js/main.js"></script>
	<script>
		function validateForm() {
			var x = document.forms[0]["email"].value;
			if (x == "") {
				alert("Please, login!");
				return false;
			}
		}
	</script>
</body>

</html>
