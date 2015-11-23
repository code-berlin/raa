module.exports = function(grunt) {

	"use strict";

    var theme = 'tm';

	var JS_FILES = [
        'assets/js/lib/jquery-1.11.0.min.js',
        'assets/js/app/**/*.js',
        'assets/js/lib/superfish.min.js',
        'assets/js/lib/slick.min.js',
        'assets/js/lib/jquery.cookiebar.js',
        'assets/js/themes/' + theme + '/**/*.js'
    ];

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		jshint: {
			files: [
				'assets/js/app/**/*.js',
                'assets/js/themes/' + theme + '/**/*.js',
				'Gruntfile.js'
			],
			options: {
                globals: {
                    jQuery: true
                }
            }
		},
		concat: {
            devJS: {
                options: {
                    separator: ';',
                    sourceMap: true
                },
                // the files to concatenate
                src: JS_FILES,
                // the location of the resulting JS file
                dest: 'assets/js/min/scripts.min.js'
            },
            distJS: {
                options: {
                    separator: ';',
                    sourceMap: false
                },
                // the files to concatenate
                src: JS_FILES,
                // the location of the resulting JS file
                dest: 'assets/js/min/scripts.min.js'
            },
            devCSS: {
                options: {
                    separator: '',
                    sourceMap: true
                },
                // the files to concatenate
                src: [
                    'assets/css/vendor/normalize.css',
                    'assets/css/vendor/font-awesome.min.css',
                    'assets/css/vendor/superfish.css',
                    'assets/css/vendor/slick.css',
                    'assets/css/vendor/jquery.cookiebar.css',
                    'assets/css/main.css'
                ],
                // the location of the resulting CSS file
                dest: 'assets/css/min/main.min.css'
            },
            distCSS: {
                options: {
                    separator: '',
                    sourceMap: false
                },
                // the files to concatenate
                src: [
                    'assets/css/vendor/normalize.css',
                    'assets/css/vendor/font-awesome.min.css',
                    'assets/css/vendor/superfish.css',
                    'assets/css/vendor/slick.css',
                    'assets/css/vendor/jquery.cookiebar.css',
                    'assets/css/main.css'
                ],
                // the location of the resulting CSS file
                dest: 'assets/css/min/main.min.css'

            },
        },
        // compile sass
        compass: {
            options: {
                sassDir: 'assets/css/sass',
                cssDir: 'assets/css'
            },
            dev: {
                options: {
                    sourcemap: true
                }
            },
            dist: {
                options: {
                    sourcemap: false,
                    outputStyle: 'compressed'
                }
            }
        },
		watch: {
            files: [
                'Gruntfile.js',
                'assets/js/**/*.js',
                'assets/css/sass/*.scss',
                'assets/css/sass/includes/*.scss'
            ],
            tasks: [
                'jshint',
                'concat:devJS',
                'compass:dev',
                'concat:devCSS'
            ]
        },
	});

	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.registerTask('default', ['compass:dev', 'jshint', 'concat:devJS', 'concat:devCSS', 'watch']);
    grunt.registerTask('dist', ['compass:dist', 'jshint', 'concat:distJS', 'concat:distCSS']);

};