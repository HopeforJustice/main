module.exports = function (distTheme, devTheme, jsDir) {
	var uglifyFilesObject = {};


	uglifyFilesObject[distTheme + jsDir + 'footer.js'] = [

		devTheme + jsDir + 'scripts.js',

	];

	uglifyFilesObject[distTheme + jsDir + 'pages/plugins.js'] = [

		// plugins
		devTheme + jsDir + 'plugins/bootstrap.modal.js',
		devTheme + jsDir + 'plugins/utm-tracking.js',
		devTheme + jsDir + 'plugins/newsticker.js',
		devTheme + jsDir + 'plugins/lottie.js',
		devTheme + jsDir + 'plugins/waypoint.js',
		devTheme + jsDir + 'plugins/gsap.js',
		devTheme + jsDir + 'plugins/draggable.js',
		devTheme + jsDir + 'plugins/headroom.js',
		//devTheme + jsDir + 'plugins/pca.js',
		devTheme + jsDir + 'plugins/flexslider.js',
		devTheme + jsDir + 'plugins/fitvids.js',
		//devTheme + jsDir + 'plugins/bootstrap-flags.js',


	];


	uglifyFilesObject[distTheme + jsDir + 'pages/homepage.js'] = [

		devTheme + jsDir + 'pages/homepage.js',


	];


	uglifyFilesObject[distTheme + jsDir + 'pages/donate.js'] = [

		devTheme + jsDir + 'pages/donate.js',


	];

	uglifyFilesObject[distTheme + jsDir + 'pages/men-are-victims.js'] = [

		devTheme + jsDir + 'plugins/scrolltrigger.js',
		devTheme + jsDir + 'pages/men-are-victims.js',

	];

	uglifyFilesObject[distTheme + jsDir + 'pages/church-partnerships.js'] = [

		devTheme + jsDir + 'pages/church-partnerships.js',

	];

	uglifyFilesObject[distTheme + jsDir + 'pages/donate-new.js'] = [

		devTheme + jsDir + 'pages/donate-new.js',


	];

	uglifyFilesObject[distTheme + jsDir + 'pages/donorfy-donate.js'] = [

		devTheme + jsDir + 'pages/donorfy-donate.js',


	];

	uglifyFilesObject[distTheme + jsDir + 'pages/donorfy-stripe.js'] = [

		devTheme + jsDir + 'plugins/jquery-validate.js',
		devTheme + jsDir + 'pages/donorfy-stripe.js',


	];

	uglifyFilesObject[distTheme + jsDir + 'pages/regular-uk.js'] = [

		devTheme + jsDir + 'pages/regular-uk.js',


	];

	uglifyFilesObject[distTheme + jsDir + 'pages/donorfy-gocardless.js'] = [

		devTheme + jsDir + 'plugins/jquery-validate.js',
		devTheme + jsDir + 'pages/donorfy-gocardless.js',


	];

	uglifyFilesObject[distTheme + jsDir + 'pages/one-off-uk.js'] = [

		devTheme + jsDir + 'pages/one-off-uk.js',


	];


	uglifyFilesObject[distTheme + jsDir + 'pages/one-off-usa.js'] = [

		devTheme + jsDir + 'pages/one-off-usa.js',


	];

	uglifyFilesObject[distTheme + jsDir + 'pages/one-off-norway.js'] = [

		devTheme + jsDir + 'pages/one-off-norway.js',


	];



	uglifyFilesObject[distTheme + jsDir + 'pages/donate-thankyou.js'] = [

		devTheme + jsDir + 'pages/donate-thankyou.js',

	];

	uglifyFilesObject[distTheme + jsDir + 'pages/training.js'] = [

		devTheme + jsDir + 'pages/training.js',


	];

	uglifyFilesObject[distTheme + jsDir + 'popper.min.js'] = [

		devTheme + jsDir + 'plugins/popper.min.js',


	];
	uglifyFilesObject[distTheme + jsDir + 'bootstrap.min.js'] = [

		devTheme + jsDir + 'plugins/bootstrap.min.js',


	];

	uglifyFilesObject[distTheme + jsDir + 'news-page.js'] = [

		devTheme + jsDir + 'news-page.js',


	];

	uglifyFilesObject[distTheme + jsDir + 'pages/freedom-run.js'] = [

		devTheme + jsDir + 'pages/freedom-run.js',


	];



	return {
		// Process JavaScript
		default: {
			files: uglifyFilesObject,
			options: {
				sourceMap: true,
				sourceMapIncludeSources: true,
			},
		},
	}
}