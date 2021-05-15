<!DOCTYPE html>
<html>
<head>
<title>App de Música</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Estilos Boostrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">



<!-- Estilos personalizados -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

<!--Iconos -->
<script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>


<!-- Javascript Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<!--Jquery-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<!-- Music Player -->
<script src="{{ asset('js/jquery.jplayer.min.js') }}" type="text/javascript"></script>
<link type="text/css" href="{{ asset('css/blue.monday/css/jplayer.blue.monday.css') }}" rel="stylesheet" />

<!--Function to decode string -->
<script type="text/javascript">
	function decodeEntities(s){
	var str, temp= document.createElement('p');
	temp.innerHTML= s;
	str= temp.textContent || temp.innerText;
	temp=null;
	return str;
	}
</script>

</head>
<body>
@include('layouts.nav')


@yield('content')


</body>
</html>