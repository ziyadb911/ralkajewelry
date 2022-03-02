<!DOCTYPE html>
<html>
<head>
	@include('admin.layouts.meta')
	<style type="text/css">
		body{
			background-image: url("{{ URL::asset($login_background ?? 'img/bg-login.jpg') }}");
			background-size: cover;
			background-attachment: fixed;
		}
		.container{
			height:100%;
		}
		body > .container > .grid{
			height: 100%;
		}
	</style>
</head>
<body>
	<div class='container'>
		<div class='ui two column middle aligned stackable grid'>
			<div class='column'>
				<h1 class='ui center aligned white inverted header'>Ralka Jewelry</h1>
			</div>
			<div class='column' style='height: 100%'>
				<div class='ui center aligned middle aligned grid' style='height: 100%'>
					<div class='ui ten wide computer sixteen wide mobile column'>
						<div class="ui stacked segment">
							<form class="ui large {{ $errors->any() ? 'error' : '' }} form" id="formlogin" name="formlogin" method="POST" action="{{ route('login.post') }}">
								@csrf
								<div class='ui error message'>
	                                <ul>
		                                @foreach ($errors->all() as $error)
		                                <li>{{$error}}</li>
		                                @endforeach
	                                </ul>
								</div>
								<div class="field{{ $errors->has('username') ? ' error' : '' }}">
									<div class="ui left icon input">
										<i class="user icon"></i>
										<input id="username" type="username" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus/>
									</div>
								</div>
								<div class="field{{ $errors->has('password') ? ' error' : '' }}">
									<div class="ui left icon input">
										<i class="lock icon"></i>
										<input id="password" type="password" name="password" placeholder="Password" required/>
									</div>
								</div>
								<button type="submit" class='ui fluid large blue submit button'>LOGIN</button>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</body>
</html>
