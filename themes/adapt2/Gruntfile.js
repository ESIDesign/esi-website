module.exports = function(grunt) {

    // 1. All configuration goes here 
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {   
		    home: {
		        src: [
			        'js/froogaloop2.min.js',
		            'js/jquery.cookie.js',
		            'js/jquery.cycle.js',
		            'js/home.dev.js', 
		        ],
		        dest: 'js/home.min.js',
		    },
		    reponsive: {
		        src: [
			        'js/jquery.uniform.js',
		            'js/jquery.responsify.init.js',
		        ],
		        dest: 'js/responsive.min.js',
		    }
		},
		uglify: {
		    build_home: {
		        src: 'js/home.min.js',
		        dest: 'js/home.min.js'
		    },
		    build_responsive: {
		        src: 'js/responsive.min.js',
		        dest: 'js/responsive.min.js'
		    }
		},
		
		watch: {
		    scripts: {
		        files: ['js/*.js'],
		        tasks: ['concat', 'uglify'],
		        options: {
		            spawn: false,
		        },
		    } 
		}

    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-watch');
    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['concat', 'uglify', 'watch']);

};