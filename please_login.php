<html lang="en"><head>
    <meta charset="utf-8">
    <meta https-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Open Source Free Judge System">
    <meta name="author" content="Alex Tsvetanov">
    <meta name="keywords" content="Judge, Online, System, C++, C#, Algorithms">
    <meta name="distribution" content="web">
    <meta name="robots" content="index, nofollow">
    <meta https-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" href="/favicon.ico">
    <title>AT Judge</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/jumbotron.css" rel="stylesheet">
    <link href="/css/theme.min.css" rel="stylesheet">
    <script src="/js/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="https://codemirror.net/lib/codemirror.css">
	<link rel="stylesheet" href="https://codemirror.net/theme/lesser-dark.css">
	<script src="https://codemirror.net/lib/codemirror.js"></script>
	<script src="https://codemirror.net/mode/javascript/javascript.js"></script>
	<script src="https://codemirror.net/addon/fold/foldcode.js"></script>
	<script src="https://codemirror.net/mode/clike/clike.js"></script>
</head>

<body>
    <nav class="navbar navbar-fixed-top navbar-dark bg-inverse"><a href="/" class="navbar-brand">AT Judge</a>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="/contactus.php" class="nav-link">Contact</a></li>
                <li class="nav-item"><a href="/aboutus.php" class="nav-link">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item"><a href="/login.php" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="/logout.php" class="nav-link">Logout</a></li>
                <li class="nav-item"><a href="/register.php" class="nav-link">Register</a></li>
                <li style="border-right: rgba(0,0,0,0) solid 20px;" class="nav-item active"><a href="/user.php" class="nav-link">Hi, Alex Tsvetanov<!--?php if (isset($_COOKIE ["name"])){echo ", "; echo $_COOKIE ["name"];} ?--></a></li>
            </ul>
        </div>
    </nav>
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3"><img src="/img/judge_logo.png"><br><br>Contest 1</h1>
            <p>Best tasks for you! Here and now!</p>
            <p><a href="/aboutus.php" role="button" class="btn btn-primary btn-lg">Learn more »</a></p>
        </div>
    </div>
	<div class="container">
        <div class="row">
            <div class="col-md-10">
            </div>
        </div>
    </div>
    <hr>
    <footer>
        <center>
            <p>
				<?php 
					echo "Copyrights © Alex Tsvetanov 2016-2017";
				?>
            </p>
        </center>
    </footer>
</body></html>
