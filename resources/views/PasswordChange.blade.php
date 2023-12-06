@extends('layouts.main')

@section('changePassword-section')
	<aside>
		@include('layouts/leftlist'); 
		<div class="col-md-10 main-section" style="margin-top:-30px;">
			@if (session('success'))
				<div class="alert alert-success">{{session('success')}}</div>
			@elseif (session('error'))
				<div class="alert alert-danger">{{session('error')}}</div>
			@endif
			<section>
				<h3 style="font-size:16px; font-weight:bold; color:#1C5978; text-align:left;margin-left:0px;">Change Password</h3>
				<hr style="margin:0px; width:600px; margin-bottom:10px" />
				<div style=" background:#F3F1F1;border:1px solid silver; font: bold 13px/13px arial ;padding:5px 0px 5px 15px ">Change Password</div>
				<div>
					<form method="post" action="{{route('change.password')}}">
						@csrf
						<table class="addpage-table">
							<tr>
								<td>Old Password</td>
								<td>
									<input type="password" name="oldpass" id="oldPassword" required> 
								</td>
							</tr>
							<tr>
								<td>New Password</td>
								<td>
									<input type="password" name="newpass" id="newPassword" required> 
								</td>
							</tr>
							<tr>
								<td>Confirm New Password</td>
								<td>
									<input type="password" name="cnewpass" id="cNewPassword" required> 
								</td>
							</tr>
							<tr>
								<td></td>
								<td colspan="2" >
									<input type="submit" class="srchbtn" name="save" value="Save"/>	
								</td>
							</tr>
						</table>
					</form>
				</div>
		</section>
		</div>
	</aside>
@endsection