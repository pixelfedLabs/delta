<template>
	<div>
		<header>
			<div class="navbar navbar-expand-lg navbar-light bg-transparent">
				<div class="container d-flex justify-content-between navbar-nav mr-auto my-4">
					<a href="/" class="navbar-brand d-flex align-items-center">
						<img src="/img/logo.svg" width="40px" class="mr-2">
						<strong translated class="text-uppercase font-ptsn">pixelfed</strong>
					</a>
				</div>
			</div>
		</header>
		<div v-if="!loaded">
			<div class="d-flex justify-content-center">
				<div class="spinner-border" role="status">
					<span class="sr-only">Loading...</span>
				</div>
			</div>
		</div>
		<div v-else class="container">
			<div class="row mb-4 align-items-center">
				<div class="col-md-8">
					<div class="p-4">
						<p class="display-4">{{domain}}</p>
					</div>
				</div>
				<div class="col-md-4">
					<a v-if="instance.nodeinfo.openRegistrations == false" class="btn btn-danger font-weight-bold px-5 btn-lg disabled btn-block" disabled rel="noreferrer noopener nofollow">Registration Closed</a>
					<a v-else class="btn btn-success font-weight-bold px-5 btn-lg btn-block" :href="'https://' + instance.domain + '/register'" rel="noreferrer noopener nofollow">Join</a>
				</div>
			</div>
			<div class="row">

				<div class="col-md-4">
					<!-- <div class="text-center mb-4 d-flex justify-content-between align-items-center px-4">
						<span>
							<div>
								<i class="fas fa-star fa-lg text-success"></i>
								<i class="fas fa-star fa-lg text-success"></i>
								<i class="fas fa-star fa-lg text-success"></i>
								<i class="fas fa-star fa-lg text-success"></i>
								<i class="fas fa-star fa-lg text-lighter"></i>
							</div>
							<div class="small text-muted font-weight-bold pt-1">
								14 Reviews
							</div>
						</span>
						<span>
							<p class="mb-0 h3 font-weight-light">4.2/5</p>
							<p class="mb-0 text-muted small font-weight-bold pt-1">RATING</p>
						</span>	
					</div> -->
					<div class="card bg-transparent mb-4">
						<div class="card-body">
							<p class="mb-0 text-center">
								<span class="text-center">
									<span class="d-inline-block mx-3">
										<span class="d-block font-weight-bold lead mb-n2">{{formatCount(instance.user_count)}}</span>
										<span class="text-muted font-weight-bold small text-uppercase">Users</span>
									</span>
									<span class="d-inline-block mx-4">
										<span class="d-block font-weight-bold lead mb-n2">{{formatCount(instance.post_count)}}</span>
										<span class="text-muted font-weight-bold small text-uppercase">Posts</span>
									</span>
									<span class="d-inline-block mx-3">
										<span class="d-block font-weight-bold lead mb-n2">{{formatCount(instance.nodeinfo.usage.users.activeMonth)}}</span>
										<span class="text-muted font-weight-bold small text-uppercase" title="Monthly Active Users">MAU</span>
									</span>
								</span>
							</p>
							<hr>
							<div class="">
								<ul class="mb-0 font-weight-bold text-muted">
									<li>{{formatSize()}} Upload Limit</li>
									<li>Mobile App Support</li>
									<li>{{instance.nodeinfo.metadata.config.uploader.max_caption_length}} char caption limit</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div v-if="!timeline.length && !timelineError" class="card">
						<div class="card-body p-4 text-center font-weight-bold">
							Loading timeline ...
						</div>
					</div>
					<div v-else-if="timelineError" class="card">
						<div class="card-body p-4 text-center font-weight-bold">
							An error occured while fetching the timeline.
						</div>
					</div>
					<div v-else class="row">
						<div v-for="(post, index) in timeline" class="col-12 col-md-4 cursor-pointer" @click="redirectPost(post)" style="margin-bottom:1.8rem;">
							<div class="square">
								<div class="square-content" v-bind:style="{ 'background-image': 'url(' + post.thumbnail + ')' }"></div>
							</div>			
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: ['domain'],

	data() {
		return {
			page: 1,
			instance: {},
			loaded: false,
			timeline: [],
			timelineError: false
		}
	},
	mounted() {
		this.boot();
	},

	methods: {
		boot() {
			let apiUrl = '/api/v1/instance/' + this.domain;
			axios.get(apiUrl)
			.then(res => {
				this.instance = res.data;
				this.loaded = true;
				this.fetchTimeline();
			})
			.catch(err => {
				console.log(err);
			})
		},

		formatCount(val) {
			return App.util.format.count(val);
		},

		formatSize() {
			let count = this.instance.nodeinfo.metadata.config.uploader.max_photo_size / 1000;
			return count + 'MB';
		},

		fetchTimeline() {
			let apiUrl = '/api/v1/instance/' + this.domain + '/timeline';

			axios.get(apiUrl)
			.then(res => {
				let data = res.data;
				this.timeline = data;
			})
			.catch(err => {
				this.timelineError = true;
				console.log('Timeline not available');
			})
		},

		redirectPost(post) {
			window.location.href = post.url;
		}
	}
}
</script>
