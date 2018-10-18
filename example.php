<?php
/* 
 * Project : template_parser_php
 * Author  : Rasmus Wissing Kallehauge
 * Tele    : +45 42 46 98 18
 * Email   : rkallehauge@gmail.com
 * Created : 18-10-2018 17:24:37
 */

// This file is an example use of the ParserTemplate class.


// Fetch parser.php
require 'parser.php';

// Object for data, even though most use cases would be a mysql result object or something similiar.
class data {
    public function __construct($lang, $title, $text) {
        // Using { } in class properties allows you to have some interesting variable names.
        $this->{'#LANGUAGE'} = $lang;
        $this->{'#TITLE'} = $title;
        $this->{'#TEXT'} = $text;
    }
}


// Associative array with data
$data = array(
    '#LANGUAGE'=>'DK',
    '#TITLE'=>'WEBSITE',
    '#TEXT'=>'Lorem Ipsum er ganske enkelt fyldtekst fra print- og typografiindustrien.'
            );

// Initialization of object with data.
$object = new data('DK', 'WEBSITE', 'Lorem Ipsum er ganske enkelt fyldtekst fra print- og typografiindustrien');

// Example of a template, not very complex, but for demonstration purposes this will do fine.
$template = "
    <!DOCTYPE html>
    
    <html lang='#LANGUAGE'>
        <head>
            <title>#TITLE</title>
        </head>
        
        <body>
            <h1>#TITLE</h1>
            <p>#TEXT</p>
        </body>
    </html>
    ";

// Initialize our parser
// Template and data CAN be set inside this function call
$parser = new templateParser();

// Initialize data
$parser->setData($data);

// Initialize template
$parser->setTemplate($template);

// Output template result 
echo $parser->parse();


// Also works with the object.
$parser->setData($object);
// Echo into a HTML comment, so we don't interfere with template that already has been outputted.
echo "<!--" . $parser->parse() . "-->";
