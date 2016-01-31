@extends('main')
@section('content')
<div id="page-contact">
	<div id="breadcrumb">
		<div class="main container">
			<div class="breadcrumbs">
				<span class="showHere">Bạn đang ở: </span><a href="../index.html" class="pathway">Trang chủ</a> <i class="fa fa-caret-right"></i>
				<span>Liên hệ</span>
			</div>
		</div>
	</div>
	<div id="content-page-contact">
		<div class="content-contact content-page">
			<p class="text-center">
				<iframe src="{{$setting['google_maps_link']}}" width="100%" height="350" frameborder="0" style="border:0"></iframe>
			</p>
			<div class="col-md-7" id="contactFormWrapper">
				<h3>Viết nhận xét</h3>
				<hr class="line-left"/>
				<p>
					Nếu bạn có thắc mắc gì, có thể gửi yêu cầu cho chúng tôi, và chúng tôi sẽ liên lạc lại với bạn sớm nhất có thể .
				</p>

				@if (!empty($errors))
					<div class="alert alert-warning" role="alert">{{errors}}</div>
				@endif


				
				@if (!empty($success))
					<div class="alert alert-success" role="alert">{{$success}}</div>
				@endif
				

				<form accept-charset='UTF-8' action='' class='contact-form' method='post'>
				<input name='form_type' type='hidden' value='contact'>
				<input name='utf8' type='hidden' value='✓'>
				<div class="form-group">
					<label for="contactFormName" class="sr-only">Tên</label>
					<input required type="text" id="contactFormName" class="form-control input-lg" name="contact[name]" placeholder="Tên của bạn" autocapitalize="words" value="">
				</div>
				<div class="form-group">
					<label for="contactFormEmail" class="sr-only">Email</label>
					<input required type="email" name="contact[email]" placeholder="Email của bạn" id="contactFormEmail" class="form-control input-lg" autocorrect="off" autocapitalize="off" value="">
				</div>
				<div class="form-group">
					<label for="contactFormMessage" class="sr-only">Nội dung</label>
					<textarea required rows="6" name="contact[body]" class="form-control" placeholder="Viết bình luận" id="contactFormMessage"></textarea>
				</div>
				<input type="submit" class="btn btn-primary btn-lg lienhe" value="Gửi liên hệ" />
				</form>
			</div>
			<div class="col-md-5" id="col-right">
				<h3>Chúng tôi ở đây</h3>
				<hr class="line-right"/>
				<?php echo html_entity_decode($setting['contact_information']);?>
			</div>
		</div>
	</div>
</div>
@endsection
				