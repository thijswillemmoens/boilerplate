/**
 * Declare variables
 */

// General.
var pkg				                = require('../../../package.json');
var project 			            = pkg.name;
var slug			                = pkg.slug;
var prefix			                = pkg.prefix;

// Translation.
var text_domain			            = pkg.textdomain;
var destFile			            = slug+'.pot';
var packageName			            = project;
var translatePath		            = './languages';

// Styles.
var styleSRC			            = './scss/style.scss';
var styleDestination		        = './';
var cssFiles			            = './**/*.css';
var scssDistFolder		            = './_dist/'+slug+'/scss/';
var scssDistFiles		            = './_dist/'+slug+'/scss/**/*.scss';
var scssDistFolderPackageDest	    = './_dist/'+slug+'/assets/scss/';

// Vendor Javascript.
var jsVendorSRC			            = './assets/javascript/vendors/*.js';
var jsVendorDestination	 	        = './assets/javascript/';
var jsVendorFile		            = 'vendors'; 

// Custom Javascript.
var jsCustomSRC			            = './assets/javascript/custom/*.js';
var jsCustomDestination	 	        = './assets/javascript/'; 
var jsCustomFile		            = 'custom'; 

// Images.
var imagesSRC			            = './assets/images/source/**/*.{png,jpg,gif,svg}';
var imagesDestination	  	        = './assets/images/';

// BrowserSync.
var styleWatchFiles	  				= ['./scss/**/*.scss', '!/scss/_gutenberg.scss' ];
var vendorJSWatchFiles	  			= './assets/js/vendors/**/*.js';
var customJSWatchFiles	  			= ['./assets/js/custom/**/*.js', '!_dist/assets/js/custom/**/*.js', '!_demo/assets/js/custom/**/*.js' ];
var projectPHPWatchFiles			= ['./**/*.php', '!_dist', '!_dist/**', '!_dist/**/*.php', '!_demo', '!_demo/**','!_demo/**/*.php'];

// Build.
var distBuildFiles		            = ['./**', '!_dist', '!_dist/**', '!_demo', '!_demo/**', '!inc/admin/gulp', '!inc/admin/gulp/**', '!node_modules/**', '!*.json', '!*.map', '!*.xml', '!gulpfile.js', '!*.sublime-project', '!*.sublime-workspace', '!*.sublime-gulp.cache', '!*.log', '!*.DS_Store', '!*.gitignore', '!TODO', '!*.git', '!*.ftppass', '!*.DS_Store', '!yarn.lock', '!package.lock'];
var distDestination		            = './_dist/';
var distCleanFiles		            = ['./_dist/'+slug+'/', './_dist/'+slug+'-package/', './_dist/'+slug+'.zip', './_dist/'+slug+'-package.zip' ];

// Build /slug/ contents within the _dist folder
var themeDestination		        = './_dist/'+slug+'/';
var themeBuildFiles		            = './_dist/'+slug+'/**/*';

// Browsers you care about for autoprefixing. https://github.com/ai/browserslist
const AUTOPREFIXER_BROWSERS = [
	'last 2 version',
	'> 1%',
	'ie >= 9',
	'ie_mob >= 10',
	'ff >= 30',
	'chrome >= 34',
	'safari >= 7',
	'opera >= 23',
	'ios >= 7',
	'android >= 4',
	'bb >= 10'
];


/**
 * Load Plugins.
 */
var gulp		                    = require('gulp');
var sass		                    = require('gulp-sass');
var minifycss		                = require('gulp-uglifycss');
var concat	   	                    = require('gulp-concat');
var uglify	   	                    = require('gulp-uglify');
var gulpif                          = require('gulp-if');
var image                           = require('gulp-image');
var zip                             = require('gulp-zip');
var imagemin	 	                = require('gulp-imagemin');
var cache                           = require('gulp-cache');
var del                             = require('del');
var browserSync  	                = require('browser-sync').create();
var reload	   	                    = browserSync.reload;
var autoprefixer 	                = require('gulp-autoprefixer');
var sourcemaps   	                = require('gulp-sourcemaps');
var copy		                    = require('gulp-copy');
var open	  	                    = require('gulp-open');
var notify	   	                    = require('gulp-notify');
var replace	  						= require('gulp-replace-task');
var lineec	   						= require('gulp-line-ending-corrector');
var filter	   						= require('gulp-filter');
var rename	   						= require('gulp-rename');



/**
 * Make it clean first
 */
function clearCache(done) {
	cache.clearAll();
	done();
}
gulp.task(clearCache);

gulp.task('clean', function(done) {
	return del( distCleanFiles );
	done();
});

gulp.task('clean_dist_scss', function (done) {
	return del( scssDistFolder );
	done();
});

gulp.task('clean-dist', function (done) {
	return del( './_dist/' + slug + '/' );
	done();
});



/**
 * Start Gulp tasks
 */
 gulp.task( 'browser-sync', function(done) {

	try {
		var environmentFile	= require('../../../environment.json');
	} catch (error) {
		done();
	}

    if ( environmentFile ) {
		browserSync.init( {
			proxy: environmentFile.devURL,
			open: true,
			injectChanges: true,
		} );
		done();
	}
});

// Moves the development top-level scss folder within the /assets/ folder
gulp.task( 'move_dist_scss', function(done){
	return gulp.src( scssDistFiles, { allowEmpty: true } )
	.pipe( gulp.dest( scssDistFolderPackageDest ) );
	done();
});

// Ensures that debug mode is turned on during development.
gulp.task( 'debug_mode_on', function(done) {
	return gulp.src( ['./functions.php', '!_dist/functions.php'] )

	.pipe( replace( {
		patterns: [
		{
			match: '_DEBUG\', false );',
			replacement: '_DEBUG\', true );'
		}
		],
		usePrefix: false
	} ) )
	.pipe(gulp.dest( './' ));
	done();
});

// Ensures SLUG_DEBUG is set to false for all build files.
gulp.task( 'debug_mode_off', function(done) {
	return gulp.src( themeBuildFiles )

	.pipe( replace( {
		patterns: [
		{
			match: '_DEBUG\', true );',
			replacement: '_DEBUG\', false );'
		}
		],
		usePrefix: false
	} ) )
	.pipe(gulp.dest( themeDestination ));
	done();
});

// Assign the proper definition prefixes.
gulp.task( 'definition_prefix', function(done) {
	return gulp.src( themeBuildFiles )

	.pipe( replace( {
		patterns: [
		{
			match: '__PREFIX',
			replacement: prefixUppercase,
		}
		],
		usePrefix: false
	} ) )
	.pipe( gulp.dest( themeDestination ) );
	done();
});

// Sass files.
gulp.task( 'styles', function(done) {
	gulp.src( styleSRC )

	.pipe( sourcemaps.init() )

	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'expanded',
		precision: 10
	} ) )

	.on('error', console.error.bind(console))

	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )

	.pipe( sourcemaps.write( { includeContent: false } ) )
	.pipe( sourcemaps.init( { loadMaps: true } ) )
	.pipe( sourcemaps.write( styleDestination ) )

	.pipe( lineec() )

	.pipe( gulp.dest( styleDestination ) )

	.pipe( filter( '**/*.css' ) )

	.pipe( browserSync.stream() )

	.pipe(replace({
	patterns: [
		{
		  match: 'pkg.name',
		  replacement: project
		},
		{
		  match: 'pkg.version',
		  replacement: pkg.version
		},
		{
		  match: 'pkg.description',
		  replacement: pkg.description
		},
		{
		  match: 'pkg.textdomain',
		  replacement: pkg.textdomain
		},
	]
	}))
	.pipe( gulp.dest( './' ) )

	// Minify.
	// .pipe( rename( { suffix: css_suffix } ) )
	.pipe( minifycss() )
	.pipe( lineec() )
	.pipe( gulp.dest( styleDestination ) )

	.pipe( filter( '**/*.css' ) )
	.pipe( browserSync.stream() )
	done();
});

// Concatenate and minify Vendors Javascript.
gulp.task( 'vendorsJs', function(done) {
	gulp.src( jsVendorSRC )
	.pipe( concat( jsVendorFile + '.min.js' ) )
	.pipe( lineec() )
	.pipe( gulp.dest( jsVendorDestination ) )
	.pipe( rename( {
		basename: jsVendorFile,
		suffix: '.min'
	} ) )
	.pipe( uglify() )
	.pipe( lineec() )
	.pipe( gulp.dest( jsVendorDestination ) )
	done();
});

// Concatenate and minify Custom Javascript.
gulp.task( 'customJS', function(done) {
	gulp.src( jsCustomSRC )
	.pipe( concat( jsCustomFile + '.min.js' ) )
	.pipe( lineec() )
	.pipe( gulp.dest( jsCustomDestination ) )
	.pipe( rename( {
		basename: jsCustomFile,
		suffix: '.min'
	} ) )
	.pipe( uglify() )
	.pipe( lineec() )
	.pipe( gulp.dest( jsCustomDestination ) )
	done();
});


// Optimize and compress images
gulp.task( 'images', function(done) {
	gulp.src( imagesSRC, { allowEmpty: true } )
	.pipe( imagemin( {
		progressive: true,
		optimizationLevel: 3,
		interlaced: true,
		svgoPlugins: [{removeViewBox: false}]
	} ) )
	.pipe(gulp.dest( imagesDestination ))
	done();
});


gulp.task('copy', function(done) {
	return gulp.src( distBuildFiles )
	.pipe( copy( themeDestination ) );
	done();
});

gulp.task('variables', function(done) {
	return gulp.src( themeBuildFiles )
	.pipe(replace({
		patterns: [
		{
			match: 'pkg.name',
			replacement: project
		},
		{
			match: 'pkg.version',
			replacement: pkg.version
		},
		{
			match: 'pkg.author',
			replacement: pkg.author
		},
		{
			match: 'pkg.slug',
			replacement: pkg.slug
		},
		{
			match: 'pkg.copyright',
			replacement: pkg.copyright
		},
		{
			match: 'pkg.theme_uri',
			replacement: pkg.theme_uri
		},
		{
			match: 'textdomain',
			replacement: pkg.textdomain
		},
		{
			match: 'pkg.description',
			replacement: pkg.description
		}
		]
	}))
	.pipe(gulp.dest( themeDestination ));
	done();
});


gulp.task('css_variables', function(done) {
  gulp.src( cssFiles )
	.pipe(replace({
	  patterns: [
		{
		  match: 'pkg.name',
		  replacement: project
		},
	  ]
	}))
	.pipe(gulp.dest( './' ));
	done();
});

gulp.task('zip-theme', function(done) {
	return gulp.src( themeDestination + '/**', { base: '_dist' } )
	.pipe( zip( slug + '.zip' ) )
	.pipe( gulp.dest( distDestination ) );
	done();
});

gulp.task('zip-package', function(done) {
	return gulp.src( './_dist/**' , { base: '_dist' } )
	.pipe( zip( slug + '-package.zip' ) )
	.pipe( gulp.dest( distDestination ) );
	done();
});


gulp.task( 'build_notice', function( done) {
	return gulp.src( './' )
	.pipe( notify( { message: 'Your build of ' + packageName + ' is complete.', onLast: true } ) )
	done();
});

gulp.task( 'release_notice', function(done) {
	return gulp.src( './' )
	.pipe( notify( { message: 'The v' + pkg.version + ' release of ' + packageName + ' has been uploaded.', onLast: false } ) )
	done();
});

gulp.task( 'default', gulp.series( 'clearCache', 'debug_mode_on', 'styles', 'vendorsJs', 'customJS', 'images', 'browser-sync', function(done) {

	gulp.watch( styleWatchFiles, gulp.parallel('styles'));
	gulp.watch( vendorJSWatchFiles, gulp.parallel('vendorsJs'));
	gulp.watch( customJSWatchFiles, gulp.parallel('customJS'));
	done();
} ) );

gulp.task( 'build-process', gulp.series( 'clearCache', 'clean', 'styles', 'css_variables', 'vendorsJs', 'customJS', 'images', 'copy', 'variables', 'debug_mode_off', 'definition_prefix', 'move_dist_scss', 'clean_dist_scss', 'zip-theme', 'clean-dist', 'zip-package', function(done) {
	done();
} ) );

gulp.task( 'build', gulp.series( 'build-process', 'build_notice', function(done) {
	done();
} ) );

gulp.task( 'release', gulp.series( 'build-process', 'release_notice', function(done) {
	done();
} ) );