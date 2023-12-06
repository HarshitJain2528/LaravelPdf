@extends('layouts.main')

@section('imageUpload-section')
	<aside>
		@include('layouts.leftlist');
		<div class="col-md-10 main-section" style="margin-top:-30px;">
			@if (session('success'))
				<div class="alert alert-success">{{session('success')}}</div>
			@elseif (session('error'))
				<div class="alert alert-danger">{{session('error')}}</div>
			@endif
			<section>
				<h3 style="font-size:16px; font-weight:bold; color:#1C5978; text-align:left;margin-left:0px;">Upload Image File</h3>
				<hr style="margin:0px; width:600px; margin-bottom:10px" />
				<div style=" background:#F3F1F1;border:1px solid silver; font: bold 13px/13px arial ;padding:5px 0px 5px 15px ">Upload Image File</div>
				<div>
					<form method="post" action="{{route('upload.image')}}" enctype="multipart/form-data">
						@csrf
						<table class="addpage-table">
							<tr>
								<td>Upload Image</td>
								<td>
									<input type="file" name="images" id="csv_file" accept=".csv"> 
								</td>
							</tr>
							<tr>
								<td></td>
								<td colspan="2">
									<button class="srchbtn" type="submit" >Upload Images</button>    
								</td>
							</tr>
						</table>
					</form>
				</div>
		</section>
		</div>
	</aside>
@endsection