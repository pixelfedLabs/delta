@extends('layouts.blank')

@section('content')

<div class="d-flex w-100 h-100 bg-primary-alt mx-auto flex-column align-items-center justify-content-center">
	<div class="text-light">
		<p class="text-center display-4">
			Join Pixelfed
		</p>
		<p class="text-center lead py-4">To join Pixelfed, you need to pick an instance. <br>You can find a list of instances on the sites below.</p>
		<p class="text-center">
			<a class="btn btn-outline-light btn-lg font-weight-bold mr-3 px-5 py-3" rel="nofollow noreferrer noopener" href="https://the-federation.info/pixelfed">the-federation.info/pixelfed</a>
			<a class="btn btn-outline-light btn-lg font-weight-bold px-5 py-3" rel="nofollow noreferrer noopener" href="https://fediverse.network/pixelfed">fediverse.network/pixelfed</a>
		</p>
	</div>
</div>

@endsection

@push('styles')
<style type="text/css">
	html,
	body {
		height: 100%;
	}

	body {
		display: -ms-flexbox;
		display: flex;
	}
	.section {
		min-height: 40vh;
	}
	.bg-primary-alt {
		background: #00d2ff;  /* fallback for old browsers */
		background: -webkit-linear-gradient(to left, #3a7bd5, #00d2ff);  /* Chrome 10-25, Safari 5.1-6 */
		background: linear-gradient(to left, #3a7bd5, #00d2ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
		/* change the calc height to a percentage height to get alternate responsive behavior*/
	}
</style>
@endpush