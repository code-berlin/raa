module.exports = function(grunt) {

	"use strict";

	var JS_FILES = [
        'assets/lib/jquery-1.11.0.min.js',
        'assets/js/app/**/*.js'
    ];
	
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		jshint: {
			files: [
				'assets/js/app/**/*.js',
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
            devCSS: {
                options: {
                    separator: '',
                    sourceMap: true
                },
                // the files to concatenate
                src: [                    
                    'assets/bootstrap/css/bootstrap.css',
                    'assets/bootstrap/css/bootstrap-responsive.css',
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
                    'assets/bootstrap/css/bootstrap.min.css',
                    'assets/bootstrap/css/bootstrap-responsive.min.css',
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
            js: {
                 files: [
                    'Gruntfile.js',
                    'assets/js/**/*.js',
                    'assets/**/*.js'
                ],
                tasks: [
                    'jshint',
                    'concat:devJS'
                ]
            },
            sass: {
                files: [
                    'assets/sass/*.scss',
                    'assets/sass/includes/*.scss'
                ],
                tasks: [
                    'compass:dev',
                    'concat:devCSS'
                ],
                options: {
                    livereload: false,
                    spawn: true
                }
            }
        },
	});

	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.registerTask('default', ['compass:dev', 'jshint', 'concat:devJS', 'concat:devCSS', 'watch']);

};