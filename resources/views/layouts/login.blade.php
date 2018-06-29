<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bienvenue sur votre espace de gestion VISIORANK</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset("css/signin.css") }}" rel="stylesheet">

</head>

<body>

<div class="container">

    {!! Form::open(array('action' => 'DashboardController@login', 'role' => 'form', 'class' => 'form-signin')) !!}
        {!! Form::hidden('login', 1) !!}
        <h2 class="form-signin-heading">Espace de gestion VISIORANK</h2>
        <label for="inputEmail" class="sr-only">Adresse email</label>
        {!! Form::text('email', null, array('class' => "form-control", "placeholder" => "Email", "required" => "required", "autofocus" => "autofocus")) !!}
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        {!! Form::password('password', array('class' => "form-control", "placeholder" => "Mot de passe", "required" => "required")) !!}
        <button class="btn btn-lg btn-success btn-block" type="submit">Se connecter</button>
    {!! Form::close() !!}
</div> <!-- /container -->
</body>
</html>