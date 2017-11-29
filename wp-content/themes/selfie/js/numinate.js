////////////////////////////////////////////////////// Greenball / numinate ///////////////////////////////////////
// 
// This plugin is made to animate numbers while counting them up or down.
//
// Basic usage:
// $('#healt-point').numinate({from: 1200, to: 350, runningInterval: 1000, stepUnit: 5});
// 
// Github repo:
// https://github.com/greenball/numinate
// 
// Demo page:
// https://pages.github.com/greenball/numinate
// 
// Package has been published under the MIT license.
// 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {
    'use strict';

    // Math conditions & description.
    // 1. Either runningInterval or stepInterval need to be provided.
    // 2. If both stepUnit and stepCount setted then the 'to' value will be overwriten.
    // 3. Either stepUnit or stepCount is need to be provided.
    // 4. If stepInterval is less then 10 ms then the plugin will recalculate the animation with 10 ms stepInterval.
    // 5. If the 'from' and 'to' values are both zer0 the plugin will 
    // count infinity if no runningInterval provided or will count till reaches the runningInterval's end.

    // Default options.
	var defaults = {
		// Counting starts from here.
		from: 			0,
		// Counting ends here, if any differental setted.
		to: 			0,

		// Interval for the whole running.
		// ! Overwrites the stepInterval if it's setted.
		runningInterval:null,

		// Interval between two step.
		// If not provided will calculate from runningInterval.
		stepInterval:   null,
		// How many times refresh the %counter% value.
		stepCount:		null,
		// How much a step's alters the current value.
		stepUnit: 		null,

		// The appering text, the %counter% token will be
		// replaced with the actual step's value.
		format: 		'%counter%',
		// Class will be added to the counter DOM(s).
		class: 	 		'numinate',
		// The step values will be rounded to this precision,
		// this is directly passed to the currentValue.toFixed(precision) fn.
		precision: 		0,
		// The counter starts on call, or do manualy.
		autoStart: 		true,
		// The counter remove itself when reaches the goal.
		autoRemove: 	false,

		// Event called when the counter has been created.
		onCreate: 	null,
		// Event called when the counter starts to count.
		onStart: 	null,
		// Event called before the counter update the step value.
		onStep: 	null,
		// Event called when the counter reached the goal, or stoped manualy.
		onStop: 	null,
		// Event called when the counter reached the goal value, or called manualy.
		onComplete: null,
		// Event called when the counter has been removed.
		onRemove: 	null,
	};

    // Constructor, initialise everything you need here
    var Plugin = function(element, options) {
    	// Always need some kind of interval.
    	if ( ! options.runningInterval && ! options.stepInterval) {
    		return window.console.error('No interval was provided.');
    	}

    	// Calculate differental for further math.
    	var diff 	= Math.abs(options.from - options.to);

    	// Always need at least stepCount or stepUnit.
    	if ( ! options.stepCount && ! options.stepUnit) {
    		return window.console.error('Provide either stepCount or stepUnit value.');
    	}

    	// If both stepCount & stepUnit provided then the 'to' will be overwriten.
    	if (options.stepUnit && options.stepCount) {
    		options.to 	= options.from + (options.stepUnit * options.stepCount);
    	}

    	// Calculate the step count.
    	if ( ! options.stepCount) {
    		options.stepCount 	= (diff / options.stepUnit);
    	}

    	// Calculate the step unit.
    	if ( ! options.stepUnit) {
    		options.stepUnit 	= (diff / options.stepCount);
    	}

		// runningInterval overwrites the stepInterval.
		if (options.runningInterval) {
    		options.stepInterval 	= (options.runningInterval / options.stepCount);
    	}

    	// stepUnit cannot be more then the differental.
    	if (diff && options.stepUnit > diff) {
    		options.stepUnit 	= diff;
    		options.stepCount 	= 1;
    	}

    	// stepInterval cannot be less then 10 ms.
    	if (options.stepInterval < 10) {
    		var multiplier 			= (10 / options.stepInterval);
    		options.stepInterval 	*= multiplier;
    		options.stepUnit 		*= multiplier;
    		options.stepCount 		/= multiplier;
    	}

    	this.textBackup		= element.text();
        this.element   		= element;
        this.options   		= options;
        this.stepper 		= null;
        this.current 		= options.from;
        this.finished 		= false;

        // Add the class.
        this.element.addClass(options.class);

        // Fire the event for creation.
        this.fire('onCreate');

        // Auto starter.
        if (this.options.autoStart) {
        	this.start();
        };
    };

    // Plugin methods and shared properties
    Plugin.prototype = {
        // Reset constructor - http://goo.gl/EcWdiy
        constructor: Plugin,

        // Fire an event.
        fire: function(event) {
        	if ($.isFunction(this.options[event])) {
        		this.options[event](this.element, this.options, this.current);
        	}
        },

        // Stop the counter.
        stop: function() {
        	// Not running.
        	if ( ! this.stepper || this.finished) {return;}

        	// Free the stepper.
        	this.stepper = clearInterval(this.stepper);

        	// Fire the event for stop.
        	this.fire('onStop');
        },

        // Start the counter.
        start: function() {
        	// Already running or finished.
        	if (this.stepper || this.finished) {return;}

        	// Render the counter with the base value.
        	this.render();

        	// Start the stepping.
        	this.stepper = setInterval($.proxy(this.step, this), this.options.stepInterval);

        	// Fire the event for stop.
       		this.fire('onStart');
        },

        // Step one.
        step: function() {
        	// Infinity loop.
			if ( ! (this.options.from + this.options.to)) {
				this.current	+= this.options.stepUnit;
			}
			// Count up till a number.
			else if(this.options.from < this.options.to) {
				this.current	+= this.options.stepUnit;
			}
			// Count down till a number.
			else if(this.options.from > this.options.to) {
				this.current	-= this.options.stepUnit;
			}

       		// Reached the goal.
			if (this.options.from < this.options.to) {
				if(this.current > this.options.to) {
					return this.completed();
				}
			} else if(this.options.from > this.options.to) {
				if(this.current < this.options.to) {
					return this.completed();
				}
			}

            // Fire the event for stop.
            this.fire('onStep');

			// Render the new value.
			this.render();
        },

        // The current reached the last value.
        completed: function() {
        	// Fixing the problem where the stepUnit is
        	// an infity long fraction number and the
        	// last value is just close to the goal and
        	// cannot be equal with it.
    		var diff = Math.abs(this.options.from - this.options.to);

    		if (diff && this.options.current !== this.options.to) {
    			this.current = this.options.to;
    			this.render();
    		}

        	// Stop the counter.
        	this.stop();

        	// Inform the other fns.
        	this.finished 	= true;

        	// Fire the event for complete.
        	this.fire('onComplete');

        	// Auto remove if necessary.
        	if (this.options.autoRemove) {
        		this.remove();
        	}
        },

        // Remove.
        remove: 	function() {
        	// Fire the event for remove.
        	this.fire('onRemove');

        	// Unbind the data.
        	$.removeData(this.element, 'numinate');

        	// Clear the text.
        	this.element.text(this.textBackup ? this.textBackup : '');

        	// Remove the classes.
        	this.element.removeClass(this.options.class);
        },

        // Render text.
        render: function() {
			this.element.text(this.options.format.replace(/\%counter\%/, this.current.toFixed(this.options.precision)));
        },

        // Restart the process.
        restart: function() {
        	this.finished 	= false;
        	this.current 	= this.options.from;
        	this.stop();
        	this.start();
        }
    }

    // Create the numinate plugin
    $.fn.numinate = function(options) {
    	var action;

    	// Init config.
    	if (typeof options == 'object') {
    		// Do a deep copy of the options - http://goo.gl/gOSSrg
    		options = $.extend(true, {}, defaults, options);
    		action  = 'init';
    	}
    	// Call an action.
    	else if (typeof options == 'string') {
    		action 	= options;
    	} 

        return this.each(function() {
            var $this = $(this);

            // Push the numinate instance to the object.
            if (action == 'init') {
            	$this.data('numinate', new Plugin($this, options));	
            } 
            // Call the action.
           	else {
           		$this.data('numinate')[action]();
            }
        });
    };

    // Expose defaults and Constructor (allowing overriding of prototype methods for example)
    $.fn.numinate.defaults = defaults;
    $.fn.numinate.Plugin   = Plugin;
}));
