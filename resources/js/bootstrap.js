try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

	window._ = require('lodash');

	window.axios = require('axios');

	window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
} catch (e) { }

