<template>
<div class="container">
	<div class="row mb-3">
		<div class="col-12 py-1 border-bottom">
			<p class="h1 font-weight-bolder">Instances</p>
		</div>
	</div>
	<div v-if="!loaded" class="row pt-3">
		<div class="col-12 py-5">
			<div class="d-flex justify-content-center">
				<div class="spinner-border" role="status">
					<span class="sr-only">Loading...</span>
				</div>
			</div>
		</div>
	</div>
	<div v-else class="row pt-3">
		<div class="col-12 col-md-3">
			<p class="small text-muted font-weight-bold">Filter Results</p>
			<div class="custom-control custom-checkbox mb-2">
				<input type="checkbox" class="custom-control-input" id="customCheck0" v-model="openRegistration">
				<label class="custom-control-label font-weight-bold text-muted" for="customCheck0">Open Registration</label>
			</div>
			<div class="custom-control custom-checkbox mb-2">
				<input type="checkbox" class="custom-control-input" id="customCheck1" v-model="latestVersionOnly">
				<label class="custom-control-label font-weight-bold text-muted" for="customCheck1">Latest Version Only</label>
			</div>
			<div class="custom-control custom-checkbox mb-4">
				<input type="checkbox" class="custom-control-input" id="customCheck2" v-model="allowsVideos">
				<label class="custom-control-label font-weight-bold text-muted" for="customCheck2">Allows Video Uploads</label>
			</div>
			<hr>
			<p>
				<button type="button" class="btn btn-outline-secondary btn-block font-weight-bold" @click.prevent="applyFilters()">Apply Filters</button>
			</p>	
		</div>
		<div v-if="instances.length" class="col-12 col-md-6">
			<div v-for="(instance, index) in instances" class="card rounded-lg bg-white shadow border-0 mb-4">
				<div class="card-body p-0">
					<div class="media">
						<div class="bg-portrait instance-img d-flex flex-column justify-content-center align-items-center">
							<div class="px-2 text-center">
								<span v-if="instance.nodeinfo.metadata.config.uploader.album_limit > 1" class="btn btn-outline-secondary btn-sm py-0 font-weight-bold">albums</span>
								<span v-if="instance.nodeinfo.metadata.config.uploader.media_types.includes('video/mp4')" class="btn btn-outline-secondary btn-sm py-0 font-weight-bold">video</span>
							</div>
							<div class="py-4">
								<!-- <span>
									<span class="d-inline-block mr-4">
										<span class="d-block font-weight-bold lead mb-n2">{{formatCount(instance.user_count)}}</span>
										<span class="text-muted font-weight-bold small text-uppercase">Users</span>
									</span>
									<span class="d-none d-md-inline-block ml-3">
										<span class="d-block font-weight-bold lead mb-n2">{{formatCount(instance.post_count)}}</span>
										<span class="text-muted font-weight-bold small text-uppercase">Posts</span>
									</span>
								</span> -->
								<ul class="small px-0 mb-0 font-weight-bold text-muted">
									<li>{{formatSize(instance)}} Upload Limit</li>
									<li>Mobile App Support</li>
									<li>{{instance.nodeinfo.metadata.config.uploader.max_caption_length}} char caption limit</li>
								</ul>
							</div>
							<div>
								<p class="small font-weight-bold text-muted">v{{instance.nodeinfo.software.version}}</p>
							</div>
						</div>
						<div class="media-body d-flex flex-column" style="width:100%;height: 250px;">
							<div class="px-3 d-flex flex-grow-1 justify-content-center">
								<p class="h3 align-self-center font-weight-light mb-0">{{instance.domain}}</p>
							</div>
							<div class="px-3 bg-light flex-grow-0 border-top">
								<div class="py-3">
									<p class="text-muted" v-html="instance.description ? instance.description : 'Instance description not available'"></p>
									<div class="mb-0 d-flex justify-content-between align-items-center">
										<span>
											<span class="d-inline-block mr-4">
												<span class="d-block font-weight-bold lead mb-n2">{{formatCount(instance.user_count)}}</span>
												<span class="text-muted font-weight-bold small text-uppercase">Users</span>
											</span>
											<span class="d-none d-md-inline-block ml-3">
												<span class="d-block font-weight-bold lead mb-n2">{{formatCount(instance.post_count)}}</span>
												<span class="text-muted font-weight-bold small text-uppercase">Posts</span>
											</span>
										</span>
										<span>
											<a v-if="instance.nodeinfo.openRegistrations == false" class="btn btn-danger font-weight-bold px-5 btn-lg disabled" disabled :href="'https://' + instance.domain + '/register'" rel="noreferrer noopener nofollow">Closed</a>
											<a v-else class="btn btn-success font-weight-bold px-5 btn-lg" :href="'https://' + instance.domain + '/register'" rel="noreferrer noopener nofollow">Join</a>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div v-else class="col-12 col-md-6">
			<div class="card card-body p-5 text-center">
				<div class="font-weight-bold">No instances found. Please try again later</div>
			</div>
		</div>
		<div class="col-12 col-md-3">
			<p class="d-flex justify-content-between align-items-center">
				<a class="btn btn-success btn-sm py-1 font-weight-bold disabled" href="#" disabled>Prev Page</a>
				<a class="btn btn-success btn-sm py-1 font-weight-bold disabled" href="#" disabled>Next Page</a>
			</p>
			<div class="card card-body mt-3 bg-transparent">
				<p class="text-muted font-weight-bold mb-0 text-center">{{resultCount}} Results Found</p>
			</div>
		</div>
	</div>
</div>
</template>

<script type="text/javascript">
export default {
	data() {
		return {
			page: 1,
			filters: [
				'latestVersion',
				'allowsVideos',
				'adultContent'
			],
			openRegistration: false,
			latestVersionOnly: false,
			allowsVideos: false,
			adultContent: false,
			instances: [],
			albumSizeRange: 3,
			fileSizeLimit: 15,
			searchFilters: [],
			resultCount: 0,
			loaded: false
		}
	},

	beforeMount() {
		let u = new URLSearchParams(window.location.search);
		if(u.has('latestVersionOnly') && u.get('latestVersionOnly') == 'true') {
			this.latestVersionOnly = true;
		}
		if(u.has('allowsVideos') && u.get('allowsVideos') == 'true') {
			this.allowsVideos = true;
		}
		if(u.has('adultContent') && u.get('adultContent') == 'true') {
			this.adultContent = true;
		}
		if(u.has('openRegistration') && u.get('openRegistration') == 'true') {
			this.openRegistration = true;
		}
		if(u.has('albumSizeRange') && u.get('albumSizeRange') !== 3) {
			this.albumSizeRange = u.get('albumSizeRange');
		}
		if(u.has('fileSizeLimit') && u.get('fileSizeLimit') !== 15) {
			this.fileSizeLimit = u.get('fileSizeLimit');
		}
		axios.get('/api/v1/instances', {
			params: {
				openRegistration: this.openRegistration,
				latestVersionOnly: this.latestVersionOnly,
				allowsVideos: this.allowsVideos,
				// adultContent: this.adultContent
			}
		})
		.then(res => {
			this.instances = res.data.data;
			this.resultCount = res.data.total;
			this.loaded = true;
		})
		.catch(err => {

		});
	},

	methods: {
		applyFilters() {
			let params = {
				openRegistration: this.openRegistration,
				latestVersionOnly: this.latestVersionOnly,
				allowsVideos: this.allowsVideos,
				// adultContent: this.adultContent
			}

			if(this.albumSizeRange != 3) {
				params['albumSizeRange'] = this.albumSizeRange;
			}

			if(this.fileSizeLimit != 15) {
				params['fileSizeLimit'] = this.fileSizeLimit;
			}

			let query = Object.keys(params).filter(key => params[key]).map(key => key + '=' + params[key]).join('&');

			if(query) {
				window.location.href = '/?' + query;
			} else {
				window.location.href = '/';
			}

		},

		formatCount(val) {
			return App.util.format.count(val);
		},

		formatSize(instance) {
			let count = instance.nodeinfo.metadata.config.uploader.max_photo_size / 1000;
			return count + 'MB';
		}
	}
}
</script>