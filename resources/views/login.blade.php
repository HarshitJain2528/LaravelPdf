@extends('layouts.main')

@section('login-section')
	<div class="col-md-12" style="height:70%; min-height:200px">
		<div class="container">
			<form action="{{route('login')}}" method="post">
				@csrf
				<table class="table" style="width:150px; margin:40px auto">
					<tr>
						<td></td>
						<td style="color:#1C5978; font-weight:bold; text-align:center">Login</td>
					</tr>
					<tr>
						<td class="login-table-text">Username</td>
						<td><input type="text" name="username" class="login-table-input" required></td>
					</tr>
					<tr style="border:none">
						<td class="login-table-text">Password</td>
						<td><input type="password" name="password" class="login-table-input" style="font-size:30px;height:25px" required></td>
					</tr>
					<tr>
						<td></td>
						<td><button class="btn btn-sm btn-primary" type="submit" style="margin-left:60px; padding:2px 15px">Login</button></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
@endsection
