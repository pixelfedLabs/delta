
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function() {
	$('.preview-btn').on('click', function(e) {
		let el = $(this);
		if(el.hasClass('text-primary')) {
			return;
		}
		$('.preview-btn, .preview-btn i').removeClass('text-primary text-dark');
		el.addClass('text-primary');
		let id = el.data('id');
		switch(id) {
			case 1:
			$('#carousel_features_img_1').removeClass('d-none');
			$('#carousel_features_img_2').addClass('d-none');
			$('#carousel_features_img_3').addClass('d-none');
			break;

			case 2:
			$('#carousel_features_img_1').addClass('d-none');
			$('#carousel_features_img_2').removeClass('d-none');
			$('#carousel_features_img_3').addClass('d-none');
			break;

			case 3:
			$('#carousel_features_img_1').addClass('d-none');
			$('#carousel_features_img_2').addClass('d-none');
			$('#carousel_features_img_3').removeClass('d-none');
			break;
		}
	})
});

window.Vue = require('vue');

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

const app = new Vue({
    el: '#app',
});

window.App = {
	util: {
		format: {
			count: (function(count = 0, locale = 'en-GB', notation = 'compact') {
				if(count < 1) {
					return 0;
				}
				return new Intl.NumberFormat(locale, { notation: notation , compactDisplay: "short" }).format(count);
			})
		}
	}
};