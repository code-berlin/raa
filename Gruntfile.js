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
          // Everything we need for the home page.
          'assets/js/min/scripts.min.js': [
            'assets/js/jquery-1.11.0.min.js',
            'assets/js/jquery-ui-1.10.4.easings.min.js',
            'assets/js/widget/footer.js',
            'assets/js/app/main_menu.js',
            'assets/js/app/team.js',
            'assets/js/app/portfolio.js',
            'assets/js/app/carousel.js',
            'assets/js/app/main.js'
          ],
          'assets/js/min/modernizr.min.js': [
            'assets/js/modernizr.js'
          ],
          'assets/js/min/google_map.min.js': [
            'assets/js/app/google_map.js'
          ]
        }
      }
    },
    csslint: {
      strict: {
        options: {
          import: 2
        },
        src: ['assets/css/style.css']
      }
    },
    cssmin: {
      add_banner: {
        options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
        },
        files: {
          'assets/css/style.min.css': [
            'assets/css/style.css'
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
          'assets/css/style.css': 'assets/css/codeb/sass/style.scss'
        }
      }
    },
    watch: {
      // Livereload Chrome Extension: https://chrome.google.  com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei
      js: {
        files: ['assets/js/app/*.js'],
        tasks: ['minify-js'],
        options: {
          livereload: true
        }
      },
      css: {
        files: ['assets/css/codeb/sass/*.scss'],
        tasks: ['sass', 'cssmin'],
        options: {
          livereload: true
        }
      },
      php: {
        files: ['application/views/**/*.php'],
        options: {
          livereload: true
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