module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    jshint: {
      files: ['assets/js/app/*.js'],
      options: {
        globalstrict: true,
        globals: {
          jQuery: true,
          module: true,
          window: true,
          document: true,
          google: true
        }
      }
    },
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy HH:mm:ss") %> */\n'
      },
      my_target: {
        files: {
          'assets/js/min/modernizr.min.js': [
            'assets/js/lib/modernizr.js'
          ],
          'assets/js/min/scripts.min.js': [
            'assets/js/lib/jquery-1.11.0.min.js',
            'assets/js/min/modernizr.min.js',
            'assets/js/app/footer.js'
          ]
        }
      }
    },
    csslint: {
      strict: {
        options: {
          import: 2
        },
        src: [
        'assets/css/admin.css',
        'assets/css/main.css',
        ]
      }
    },
    cssmin: {
      add_banner: {
        options: {
          banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
        },
        files: {
          'assets/css/min/admin.min.css': [
            'assets/bootstrap/css/bootstrap.min.css',
            'assets/css/admin.css',
            'assets/css/main.css'
          ]
        }
      }
    },
    sass: {
      dist: {
        options: {
          lineNumbers: true,
          noCache: true
        },
        files: {
          'assets/css/admin.css': 'assets/css/sass/admin.scss',
          'assets/css/main.css': 'assets/css/sass/main.scss'
        }
      }
    },
    watch: {
      // Livereload Chrome Extension: https://chrome.google.  com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei
      js: {
        files: ['assets/js/app/*.js'],
        tasks: ['minify-js'],
        options: {
          livereload: false
        }
      },
      css: {
        files: ['assets/css/sass/*.scss'],
        tasks: ['sass', 'cssmin'],
        options: {
          livereload: false
        }
      },
      php: {
        files: ['application/views/**/*.php'],
        options: {
          livereload: false
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-csslint');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');

  grunt.registerTask('default', ['watch']);
  grunt.registerTask('test', ['jshint', 'csslint']);
  grunt.registerTask('test-js', ['jshint']);
  grunt.registerTask('test-css', ['csslint']);
  grunt.registerTask('minify', ['jshint', 'uglify', 'cssmin']);
  grunt.registerTask('minify-css', ['cssmin']);
  grunt.registerTask('minify-js', ['jshint', 'uglify']);
};