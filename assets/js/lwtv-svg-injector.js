// Elements to inject
var elementsToInject = document.querySelectorAll('svg[data-src]');

// Options
var injectorOptions = { evalScripts: 'once' };

// create injector configured by options
var injector = new SVGInjector(injectorOptions);

// Trigger the injection
injector.inject( elementsToInject );