<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Open Source Free Judge System">
    <meta name="author" content="Alex Tsvetanov">
    <meta name="keywords" content="Judge, Online, System, C++, C#, Algorithms">
    <meta name="distribution" content="web">
    <meta name="robots" content="index, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" href="/favicon.ico">
    <title>AT Judge</title>
	<link href="/css/jumbotron.css" rel="stylesheet"><link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700"><link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons"><link rel="stylesheet" href="/css/bootstrap.min.css"><link rel="stylesheet" href="/css/bootstrap-material-design.min.css"><link rel="stylesheet" href="/css/ripples.min.css"><link rel="stylesheet" href="/css/snackbar.min.css"><link rel="stylesheet" href="/css/extension.css">
	
	<link rel="stylesheet" href="https://codemirror.net/lib/codemirror.css">
	<link rel="stylesheet" href="https://codemirror.net/theme/lesser-dark.css">
	<script src="https://codemirror.net/lib/codemirror.js"></script>
	<script src="https://codemirror.net/mode/javascript/javascript.js"></script>
	<script src="https://codemirror.net/addon/fold/foldcode.js"></script>
	<script src="https://codemirror.net/mode/clike/clike.js"></script>
</head>

<body>
    <nav class="navbar navbar-fixed-top navbar-default"><a href="/" class="navbar-brand">AT Judge</a>
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
                <li style="border-right: rgba(0,0,0,0) solid 20px;" class="nav-item active"><a href="/user.php" class="nav-link">Hi<?php if (isset($_COOKIE ["name"])){echo ", "; echo $_COOKIE ["name"];} ?></a></li>
            </ul>
        </div>
    </nav>
	<div style="height: 50px"></div>
    <div class="jumbotron">
        <div class="container">
			<h1 class="display-3"><span>Submit {{ID}}</span></h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>ContestID</th>
                        <th>TaskID</th>
                        <th>UserID</th>
                        <th>Language</th>
                        <th>Points</th>
                    </tr>
                    <tr>{{info}}</tr>
                </table>
            </div>
			<div class="col-md-10">
				Source code:
				<textarea id="sourcecode" name="sourcecode" rows="20" autocorrect="off" autocapitalize="off" spellcheck="false" wrap="off" readonly>
{{source}}</textarea>
				Compile log:
				<textarea id="compile" autocorrect="off" autocapitalize="off" spellcheck="false" wrap="off" readonly>
{{compile}}</textarea>
				Tests log:
				{{tests}}
            </div>
        </div>
    </div>
    <hr>
    <footer>
        <center>
            <p>
                <?php require ($_SERVER["DOCUMENT_ROOT"] . "/content/copyrights.php"); ?>
            </p>
        </center>
    </footer>
	<script src="/js/jquery.min.js"></script><script src="/js/tether.min.js"></script><script src="/js/bootstrap.min.js"></script><script src="/js/material.min.js"></script><script src="/js/ripples.min.js"></script><script src="/js/snackbar.min.js"></script><script src="/js/jquery.nouislider.min.js"></script><script src="/js/main.js"></script>
	<script>
		var editor, code;
		var modes = {
			js: "javascript",
			java: "text/x-java",
			c: "text/x-csrc",
			cpp: "text/x-c++src",
			cs: "text/x-csharp",
			php: "application/x-httpsd-php",
			py: "text/x-python",
			cy: "text/x-cython",
			hs: "text/x-haskell",
			ts: "application/typescript"
		};

		function l ()
		{
			document.getElementById ("sourcecode").value = code;
		}

		window.onload = function() {
			code = document.getElementById ("sourcecode").value;
			CodeMirror.modeURL = "https://codemirror.net/mode/%N/%N.js";
			editor = CodeMirror.fromTextArea(document.getElementById("sourcecode"), {
				mode: modes ["{{lang}}"],
				theme: "default",
				lineNumbers: true,
				lineWrapping: true,
				readOnly: true
			});
			var editor2 = CodeMirror.fromTextArea(document.getElementById("compile"), {
				mode: modes ["text/plain"],
				theme: "default",
				lineWrapping: true,
				readOnly: true
			});
		};
	</script>
</body>

</html>

