<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><meta name="description" content="Open Source Free Judge System"><meta name="author" content="Alex Tsvetanov"><meta name="keywords" content="Judge, Online, System, Programming, Languages, Algorithms"><meta name="distribution" content="web"><meta name="robots" content="index, nofollow"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><link rel="icon" href="/favicon.ico"><title>AT Judge</title><link href="/css/jumbotron.css" rel="stylesheet"><link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700"><link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons"><link rel="stylesheet" href="/css/bootstrap.min.css"><link rel="stylesheet" href="/css/bootstrap-material-design.min.css"><link rel="stylesheet" href="/css/ripples.min.css"><link rel="stylesheet" href="/css/snackbar.min.css"><link rel="stylesheet" href="/css/extension.css"></head><body cz-shortcut-listen="true"><nav class="navbar navbar-fixed-top navbar-default"><a href="/" class="navbar-brand">AT Judge</a><div class="navbar-collapse collapse"><ul class="nav navbar-nav navbar-left"><li class="nav-item active"><a href="/" class="nav-link">Home</a></li><li class="nav-item"><a href="/contactus.php" class="nav-link">Contact</a></li><li class="nav-item"><a href="/aboutus.php" class="nav-link">About</a></li></ul><ul class="nav navbar-nav navbar-right"><li class="nav-item"><a href="/login.php" class="nav-link">Login</a></li><li class="nav-item"><a href="/logout.php" class="nav-link">Logout</a></li><li class="nav-item"><a href="/register.php" class="nav-link">Register</a></li><li style="border-right: rgba(0,0,0,0) solid 20px;" class="nav-item active"><a href="/user.php" class="nav-link"> 
Hi
<?php 
if (isset($_COOKIE ["name"])) 
{
	echo ", "; 
	echo $_COOKIE ["name"];
} 
?></a></li></ul></div></nav><div style="height: 50px"></div><div class="jumbotron"><div class="container"><h1 class="display-3"><img src="/img/judge_logo.png"></h1><p>Best tasks for you! Here and now!</p><p><a href="/aboutus.php" role="button" class="btn btn-primary btn-lg">Learn more »</a></p></div></div><div class="container"><div class="row"><div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad"><div class="panel panel-info"><div style="background-color: #FF6A00; color: black;" class="panel-heading"><h3 class="panel-title">{{name}}</h3></div><div class="panel-body"><div class="row"><div align="center" class="col-md-3 col-lg-3"><img alt="User Pic" src="{{pic}}" class="img-circle img-responsive"></div><div class="col-md-9 col-lg-9"><table class="table table-user-information"><tbody><tr><td>Email</td><td><a href="mailto:{{mail}}">{{mail}}</a></td></tr></tbody></table></div></div></div><div class="panel-footer"><a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a><span class="pull-right"><a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a></span></div></div></div></div></div><hr><footer><center> <p> 
<?php 
require ($_SERVER["DOCUMENT_ROOT"] . "/content/copyrights.php");
?></p></center></footer><script src="/js/jquery.min.js"></script><script src="/js/tether.min.js"></script><script src="/js/bootstrap.min.js"></script><script src="/js/material.min.js"></script><script src="/js/ripples.min.js"></script><script src="/js/snackbar.min.js"></script><script src="/js/jquery.nouislider.min.js"></script><script src="/js/main.js"></script></body></html>