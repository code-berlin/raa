var config = require('./config.json');

module.exports = function(grunt) {

	"use strict";

    var theme = config.theme;

	var JS_FILES = [
        'assets/js/lib/jquery-1.11.0.min.js',
        'assets/js/lib/jquery.mobile.custom.min.js',
        'assets/js/app/**/*.js',
        'assets/js/lib/superfish.min.js',
        'assets/js/lib/slick.min.js',
        'assets/js/lib/jquery.cookiebar.js',
        'assets/js/lib/jquery.onAppear.min.js',
        'assets/js/lib/jquery.flexslider-min.js',
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
                dest: 'assets/js/min/scripts.tmp.js'
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
                    'assets/css/vendor/flexslider.css',
                    'assets/css/raa/main.css',
                    'assets/css/theme/main.css'
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
                    'assets/css/raa/main.css',
                    'assets/css/theme/main.css'
                ],
                // the location of the resulting CSS file
                dest: 'assets/css/min/main.tmp.css'

            },
        },
        // compile sass
        compass: {
            raa: {
               options: {
                    sassDir: 'assets/css/sass/raa',
                    cssDir: 'assets/css/raa'
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
            theme : {
                options: {
                    sassDir: 'assets/css/sass/themes/' + theme,
                    cssDir: 'assets/css/theme'
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
            }
        },
		watch: {
            files: [
                'Gruntfile.js',
                'assets/js/**/*.js',
                'assets/css/sass/raa/*.scss',
                'assets/css/sass/raa/includes/*.scss',
                'assets/css/sass/themes/' + theme + '/*.scss',
                'assets/css/sass/themes/' + theme + '/includes/*.scss'
            ],
            tasks: [
                'jshint',
                'concat:devJS',
                'compass:raa:dev',
                'compass:theme:dev',
                'concat:devCSS'
            ]
        },
        cssmin: {
            options: {
                shorthandCompacting: false,
                roundingPrecision: -1
            },
            target: {
                files: {
                    'assets/css/min/main.min.css': [
                        'assets/css/min/main.tmp.css'
                    ]
                }
            }
        },
        uglify: {
            dist: {
                files: {
                    'assets/js/min/scripts.min.js': [
                        'assets/js/min/scripts.tmp.js'
                    ]
                }
            }
        },
        comments: {
            dist: {
              src: [ 'assets/js/min/scripts.min.js']
            },
        }
	});

	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-stripcomments');
	grunt.registerTask('default', ['compass:raa:dev', 'compass:theme:dev', 'jshint', 'concat:devJS', 'concat:devCSS', 'watch']);
    grunt.registerTask('dist', ['compass:raa:dist','compass:theme:dist', 'jshint', 'concat:distJS', 'uglify:dist', 'comments:dist', 'concat:distCSS', 'cssmin']);

};