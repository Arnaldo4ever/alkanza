<?php

/*--------------------------------*/
/* Selfie Options Page Started */
/*--------------------------------*/

function optionsframework_option_name() {
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}



/*--------------------------------*/
/* Google Fonts Array */
/*--------------------------------*/
function optionsframework_options() {

	$fonts_array = array(
		'ABeeZee' => esc_html__('Abeezee', 'selfie'),
		'Abel' => esc_html__('Abel', 'selfie'),	
		'Abril+Fatface' => esc_html__('Abril Fatface', 'selfie'),	
		'Aclonica' => esc_html__('Aclonica', 'selfie'),	
		'Actor' => esc_html__('Actor', 'selfie'),	
		'Adamina' => esc_html__('Adamina', 'selfie'),	
		'Aguafina+Script' => esc_html__('Aguafina Script', 'selfie'),	
		'Aladin' => esc_html__('Aladin', 'selfie'),	
		'Aldrich' => esc_html__('Aldrich', 'selfie'),	
		'Alice' => esc_html__('Alice', 'selfie'),	
		'Alike+Angular' => esc_html__('Alike Angular', 'selfie'),	
		'Alike' => esc_html__('Alike', 'selfie'),	
		'Allan' => esc_html__('Allan', 'selfie'),	
		'Allerta+Stencil' => esc_html__('Allerta Stencil', 'selfie'),	
		'Allerta' => esc_html__('Allerta', 'selfie'),	
		'Amaranth' => esc_html__('Amaranth', 'selfie'),	
		'Amatic+SC' => esc_html__('Amatic SC', 'selfie'),	
		'Andada' => esc_html__('Andada', 'selfie'),	
		'Andika' => esc_html__('Andika', 'selfie'),	
		'Annie+Use+Your+Telescope' => esc_html__('Annie Use Your Telescope', 'selfie'),	
		'Anonymous+Pro' => esc_html__('Anonymous Pro', 'selfie'),	
		'Antic' => esc_html__('Antic', 'selfie'),	
		'Anton' => esc_html__('Anton', 'selfie'),	
		'Arapey' => esc_html__('Arapey', 'selfie'),	
		'Architects+Daughter' => esc_html__('Architects Daughter', 'selfie'),	
		'Arimo' => esc_html__('Arimo', 'selfie'),	
		'Artifika' => esc_html__('Artifika', 'selfie'),	
		'Arvo' => esc_html__('Arvo', 'selfie'),	
		'Asset' => esc_html__('Asset', 'selfie'),	
		'Astloch' => esc_html__('Astloch', 'selfie'),	
		'Atomic+Age' => esc_html__('Atomic Age', 'selfie'),	
		'Aubrey' => esc_html__('Aubrey', 'selfie'),	
		'Bangers' => esc_html__('Bangers', 'selfie'),	
		'Bentham' => esc_html__('Bentham', 'selfie'),	
		'Bevan' => esc_html__('Bevan', 'selfie'),	
		'Bigshot+One' => esc_html__('Bigshot One', 'selfie'),	
		'Bitter' => esc_html__('Bitter', 'selfie'),	
		'Black+Ops+One' => esc_html__('Black Ops One', 'selfie'),	
		'Bowlby+One+SC' => esc_html__('Bowlby One SC', 'selfie'),	
		'Bowlby+One' => esc_html__('Bowlby One', 'selfie'),	
		'Brawler' => esc_html__('Brawler', 'selfie'),	
		'Bubblegum+Sans' => esc_html__('Bubblegum Sans', 'selfie'),	
		'Buda' => esc_html__('Buda', 'selfie'),	
		'Butcherman+Caps' => esc_html__('Butcherman Caps', 'selfie'),	
		'Cabin+Condensed' => esc_html__('Cabin Condensed', 'selfie'),	
		'Cabin+Sketch' => esc_html__('Cabin Sketch', 'selfie'),	
		'Cabin' => esc_html__('Cabin', 'selfie'),	
		'Cagliostro' => esc_html__('Cagliostro', 'selfie'),	
		'Calligraffitti' => esc_html__('Calligraffitti', 'selfie'),
		'Candal' => esc_html__('Candal', 'selfie'),	
		'Cantarell' => esc_html__('Cantarell', 'selfie'),	
		'Cardo' => esc_html__('Cardo', 'selfie'),	
		'Carme' => esc_html__('Carme', 'selfie'),	
		'Carter+One' => esc_html__('Carter One', 'selfie'),	
		'Caudex' => esc_html__('Caudex', 'selfie'),	
		'Cedarville+Cursive' => esc_html__('Cedarville Cursive', 'selfie'),	
		'Changa+One' => esc_html__('Changa One', 'selfie'),	
		'Cherry+Cream+Soda' => esc_html__('Cherry Cream Soda', 'selfie'),	
		'Chewy' => esc_html__('Chewy', 'selfie'),	
		'Chicle' => esc_html__('Chicle', 'selfie'),	
		'Chivo' => esc_html__('Chivo', 'selfie'),	
		'Coda+Caption' => esc_html__('Coda Caption', 'selfie'),	
		'Coda' => esc_html__('Coda', 'selfie'),	
		'Comfortaa' => esc_html__('Comfortaa', 'selfie'),	
		'Coming+Soon' => esc_html__('Coming Soon', 'selfie'),	
		'Contrail+One' => esc_html__('Contrail One', 'selfie'),	
		'Convergence' => esc_html__('Convergence', 'selfie'),	
		'Cookie' => esc_html__('Cookie', 'selfie'),	
		'Copse' => esc_html__('Copse', 'selfie'),	
		'Corben' => esc_html__('Corben', 'selfie'),	
		'Cousine' => esc_html__('Cousine', 'selfie'),	
		'Coustard' => esc_html__('Coustard', 'selfie'),	
		'Covered+By+Your+Grace' => esc_html__('Covered By Your Grace', 'selfie'),
		'Crafty+Girls' => esc_html__('Crafty Girls', 'selfie'),	
		'Creepster+Caps' => esc_html__('Creepster Caps', 'selfie'),	
		'Crimson+Text' => esc_html__('Crimson Text', 'selfie'),	
		'Crushed' => esc_html__('Crushed', 'selfie'),	
		'Cuprum' => esc_html__('Cuprum', 'selfie'),	
		'Damion' => esc_html__('Damion', 'selfie'),	
		'Dancing+Script' => esc_html__('Dancing Script', 'selfie'),	
		'Dawning+of+a+New+Day' => esc_html__('Dawning of a New Day', 'selfie'),	
		'Days+One' => esc_html__('Days One', 'selfie'),	
		'Delius+Swash+Caps' => esc_html__('Delius Swash Caps', 'selfie'),	
		'Delius+Unicase' => esc_html__('Delius Unicase', 'selfie'),	
		'Delius' => esc_html__('Delius', 'selfie'),	
		'Devonshire' => esc_html__('Devonshire', 'selfie'),	
		'Didact+Gothic' => esc_html__('Didact Gothic', 'selfie'),	
		'Dorsa' => esc_html__('Dorsa', 'selfie'),	
		'Dr+Sugiyama' => esc_html__('Dr Sugiyama', 'selfie'),	
		'Droid+Sans+Mono' => esc_html__('Droid Sans Mono', 'selfie'),	
		'Droid+Sans' => esc_html__('Droid Sans', 'selfie'),	
		'Droid+Serif' => esc_html__('Droid Serif', 'selfie'),	
		'EB+Garamond' => esc_html__('EB Garamond', 'selfie'),	
		'Eater+Caps' => esc_html__('Eater Caps', 'selfie'),	
		'Expletus+Sans' => esc_html__('Expletus Sans', 'selfie'),	
		'Fanwood+Text' => esc_html__('Fanwood Text', 'selfie'),	
		'Federant' => esc_html__('Federant', 'selfie'),
		'Federo' => esc_html__('Federo', 'selfie'),	
		'Fjord+One' => esc_html__('Fjord One', 'selfie'),	
		'Fondamento' => esc_html__('Fondamento', 'selfie'),	
		'Fontdiner+Swanky' => esc_html__('Fontdiner Swanky', 'selfie'),	
		'Forum' => esc_html__('Forum', 'selfie'),	
		'Francois+One' => esc_html__('Francois One', 'selfie'),	
		'Gentium+Basic' => esc_html__('Gentium Basic', 'selfie'),	
		'Gentium+Book+Basic' => esc_html__('Gentium Book Basic', 'selfie'),	
		'Geo' => esc_html__('Geo', 'selfie'),	
		'Geostar+Fill' => esc_html__('Geostar Fill', 'selfie'),	
		'Geostar' => esc_html__('Geostar', 'selfie'),	
		'Give+You+Glory' => esc_html__('Give You Glory', 'selfie'),	
		'Gloria+Hallelujah' => esc_html__('Gloria Hallelujah', 'selfie'),	
		'Goblin+One' => esc_html__('Goblin One', 'selfie'),	
		'Gochi+Hand' => esc_html__('Gochi Hand', 'selfie'),	
		'Goudy+Bookletter+1911' => esc_html__('Goudy Bookletter 1911', 'selfie'),	
		'Gravitas+One' => esc_html__('Gravitas One', 'selfie'),	
		'Gruppo' => esc_html__('Gruppo', 'selfie'),	
		'Hammersmith+One' => esc_html__('Hammersmith One', 'selfie'),	
		'Herr+Von+Muellerhoff' => esc_html__('Herr Von Muellerhoff', 'selfie'),	
		'Holtwood+One+SC' => esc_html__('Holtwood One SC', 'selfie'),	
		'Homemade+Apple' => esc_html__('Homemade Apple', 'selfie'),	
		'IM+Fell+DW+Pica+SC' => esc_html__('IM Fell DW Pica SC', 'selfie'),	
		'IM+Fell+DW+Pica' => esc_html__('IM Fell DW Pica', 'selfie'),
		'IM+Fell+Double+Pica+SC' => esc_html__('IM Fell Double Pica SC', 'selfie'),	
		'IM+Fell+Double+Pica' => esc_html__('IM Fell Double Pica', 'selfie'),	
		'IM+Fell+English+SC' => esc_html__('IM Fell English SC', 'selfie'),	
		'IM+Fell+English' => esc_html__('IM Fell English', 'selfie'),	
		'IM+Fell+French+Canon+SC' => esc_html__('IM Fell French Canon SC', 'selfie'),	
		'IM+Fell+French+Canon' => esc_html__('IM Fell French Canon', 'selfie'),	
		'IM+Fell+Great+Primer+SC' => esc_html__('IM Fell Great Primer SC', 'selfie'),	
		'IM+Fell+Great+Primer' => esc_html__('IM Fell Great Primer', 'selfie'),	
		'Iceland' => esc_html__('Iceland', 'selfie'),	
		'Inconsolata' => esc_html__('Inconsolata', 'selfie'),	
		'Indie+Flower' => esc_html__('Indie Flower', 'selfie'),	
		'Irish+Grover' => esc_html__('Irish Grover', 'selfie'),	
		'Istok+Web' => esc_html__('Istok Web', 'selfie'),	
		'Jockey+One' => esc_html__('Jockey One', 'selfie'),	
		'Josefin+Sans' => esc_html__('Josefin Sans', 'selfie'),	
		'Josefin+Slab' => esc_html__('Josefin Slab', 'selfie'),	
		'Judson' => esc_html__('Judson', 'selfie'),	
		'Julee' => esc_html__('Julee', 'selfie'),	
		'Jura' => esc_html__('Jura', 'selfie'),	
		'Just+Another+Hand' => esc_html__('Just Another Hand', 'selfie'),	
		'Just+Me+Again+Down+Here' => esc_html__('Just Me Again Down Here', 'selfie'),	
		'Kameron' => esc_html__('Kameron', 'selfie'),	
		'Kelly+Slab' => esc_html__('Kelly Slab', 'selfie'),	
		'Kenia' => esc_html__('Kenia', 'selfie'),
		'Knewave' => esc_html__('Knewave', 'selfie'),	
		'Kranky' => esc_html__('Kranky', 'selfie'),	
		'Kreon' => esc_html__('Kreon', 'selfie'),	
		'Kristi' => esc_html__('Kristi', 'selfie'),	
		'La+Belle+Aurore' => esc_html__('La Belle Aurore', 'selfie'),	
		'Lancelot' => esc_html__('Lancelot', 'selfie'),	
		'Lato' => esc_html__('Lato', 'selfie'),	
		'League+Script' => esc_html__('League Script', 'selfie'),	
		'Leckerli+One' => esc_html__('Leckerli One', 'selfie'),	
		'Lekton' => esc_html__('Lekton', 'selfie'),	
		'Lemon' => esc_html__('Lemon', 'selfie'),	
		'Limelight' => esc_html__('Limelight', 'selfie'),	
		'Linden Hill' => esc_html__('Linden Hill', 'selfie'),	
		'Lobster+Two' => esc_html__('Lobster Two', 'selfie'),	
		'Lobster' => esc_html__('Lobster', 'selfie'),	
		'Lora' => esc_html__('Lora', 'selfie'),	
		'Love+Ya+Like+A+Sister' => esc_html__('Love Ya Like A Sister', 'selfie'),	
		'Loved+by+the+King' => esc_html__('Loved by the King', 'selfie'),	
		'Luckiest+Guy' => esc_html__('Luckiest Guy', 'selfie'),	
		'Maiden+Orange' => esc_html__('Maiden Orange', 'selfie'),	
		'Mako' => esc_html__('Mako', 'selfie'),	
		'Marck+Script' => esc_html__('Marck Script', 'selfie'),	
		'Marvel' => esc_html__('Marvel', 'selfie'),	
		'Mate+SC' => esc_html__('Mate SC', 'selfie'),
		'Mate' => esc_html__('Mate', 'selfie'),	
		'Maven+Pro' => esc_html__('Maven Pro', 'selfie'),	
		'Meddon' => esc_html__('Meddon', 'selfie'),	
		'MedievalSharp' => esc_html__('MedievalSharp', 'selfie'),	
		'Megrim' => esc_html__('Megrim', 'selfie'),	
		'Merienda+One' => esc_html__('Merienda One', 'selfie'),	
		'Merriweather' => esc_html__('Merriweather', 'selfie'),
		'Merriweather+Sans' => esc_html__('Merriweather Sans', 'selfie'),		
		'Metrophobic' => esc_html__('Metrophobic', 'selfie'),	
		'Michroma' => esc_html__('Michroma', 'selfie'),	
		'Miltonian+Tattoo' => esc_html__('Miltonian Tattoo', 'selfie'),	
		'Miltonian' => esc_html__('Miltonian', 'selfie'),	
		'Miss+Fajardose' => esc_html__('Miss Fajardose', 'selfie'),	
		'Miss+Saint+Delafield' => esc_html__('Miss Saint Delafield', 'selfie'),	
		'Modern+Antiqua' => esc_html__('Modern Antiqua', 'selfie'),	
		'Molengo' => esc_html__('Molengo', 'selfie'),	
		'Monofett' => esc_html__('Monofett', 'selfie'),	
		'Monoton' => esc_html__('Monoton', 'selfie'),	
		'Monsieur+La+Doulaise' => esc_html__('Monsieur La Doulaise', 'selfie'),	
		'Montez' => esc_html__('Montez', 'selfie'),	
		'Mountains+of+Christmas' => esc_html__('Mountains of Christmas', 'selfie'),	
		'Mr+Bedford' => esc_html__('Mr Bedford', 'selfie'),	
		'Mr+Dafoe' => esc_html__('Mr Dafoe', 'selfie'),	
		'Mr+De+Haviland' => esc_html__('Mr De Haviland', 'selfie'),	
		'Mrs+Sheppards' => esc_html__('Mrs Sheppards', 'selfie'),
		'Muli' => esc_html__('Muli', 'selfie'),	
		'Neucha' => esc_html__('Neucha', 'selfie'),	
		'Neuton' => esc_html__('Neuton', 'selfie'),	
		'News+Cycle' => esc_html__('News Cycle', 'selfie'),	
		'Niconne' => esc_html__('Niconne', 'selfie'),	
		'Nixie+One' => esc_html__('Nixie One', 'selfie'),	
		'Nobile' => esc_html__('Nobile', 'selfie'),	
		'Nosifer+Caps' => esc_html__('Nosifer Caps', 'selfie'),	
		'Nothing+You+Could+Do' => esc_html__('Nothing You Could Do', 'selfie'),	
		'Nova+Cut' => esc_html__('Nova Cut', 'selfie'),	
		'Nova+Flat' => esc_html__('Nova Flat', 'selfie'),	
		'Nova+Mono' => esc_html__('Nova Mono', 'selfie'),	
		'Nova+Oval' => esc_html__('Nova Oval', 'selfie'),	
		'Nova+Round' => esc_html__('Nova Round', 'selfie'),	
		'Nova+Script' => esc_html__('Nova Script', 'selfie'),	
		'Nova+Slim' => esc_html__('Nova Slim', 'selfie'),	
		'Nova+Square' => esc_html__('Nova Square', 'selfie'),	
		'Numans' => esc_html__('Numans', 'selfie'),	
		'Nunito' => esc_html__('Nunito', 'selfie'),	
		'Old+Standard+TT' => esc_html__('Old Standard TT', 'selfie'),	
		'Open+Sans+Condensed' => esc_html__('Open Sans Condensed', 'selfie'),	
		'Open+Sans' => esc_html__('Open Sans', 'selfie'),	
		'Orbitron' => esc_html__('Orbitron', 'selfie'),	
		'Oswald' => esc_html__('Oswald', 'selfie'),
		'Over+the+Rainbow' => esc_html__('Over the Rainbow', 'selfie'),	
		'Ovo' => esc_html__('Ovo', 'selfie'),	
		'PT+Sans+Caption' => esc_html__('PT Sans Caption', 'selfie'),	
		'PT+Sans+Narrow' => esc_html__('PT Sans+Narrow', 'selfie'),	
		'PT+Sans' => esc_html__('PT Sans', 'selfie'),	
		'PT+Serif+Caption' => esc_html__('PT Serif Caption', 'selfie'),	
		'PT+Serif' => esc_html__('PT Serif', 'selfie'),	
		'Pacifico' => esc_html__('Pacifico', 'selfie'),	
		'Passero+One' => esc_html__('Passero One', 'selfie'),	
		'Patrick+Hand' => esc_html__('Patrick Hand', 'selfie'),	
		'Paytone+One' => esc_html__('Paytone One', 'selfie'),	
		'Permanent+Marker' => esc_html__('Permanent Marker', 'selfie'),	
		'Petrona' => esc_html__('Petrona', 'selfie'),	
		'Philosopher' => esc_html__('Philosopher', 'selfie'),	
		'Piedra' => esc_html__('Piedra', 'selfie'),	
		'Pinyon+Script' => esc_html__('Pinyon Script', 'selfie'),	
		'Play' => esc_html__('Play', 'selfie'),	
		'Playfair+Display' => esc_html__('Playfair Display', 'selfie'),	
		'Podkova' => esc_html__('Podkova', 'selfie'),	
		'Poller+One' => esc_html__('Poller One', 'selfie'),	
		'Poly' => esc_html__('Poly', 'selfie'),	
		'Pompiere' => esc_html__('Pompiere', 'selfie'),	
		'Prata' => esc_html__('Prata', 'selfie'),	
		'Prociono' => esc_html__('Prociono', 'selfie'),
		'Puritan' => esc_html__('Puritan', 'selfie'),	
		'Quattrocento+Sans' => esc_html__('Quattrocento Sans', 'selfie'),	
		'Quattrocento' => esc_html__('Quattrocento', 'selfie'),	
		'Questrial' => esc_html__('Questrial', 'selfie'),	
		'Quicksand' => esc_html__('Quicksand', 'selfie'),	
		'Radley' => esc_html__('Radley', 'selfie'),	
		'Raleway' => esc_html__('Raleway', 'selfie'),	
		'Rammetto+One' => esc_html__('Rammetto One', 'selfie'),	
		'Rancho' => esc_html__('Rancho', 'selfie'),	
		'Rationale' => esc_html__('Rationale', 'selfie'),	
		'Redressed' => esc_html__('Redressed', 'selfie'),	
		'Reenie+Beanie' => esc_html__('Reenie Beanie', 'selfie'),	
		'Ribeye+Marrow' => esc_html__('Ribeye Marrow', 'selfie'),	
		'Ribeye' => esc_html__('Ribeye', 'selfie'),	
		'Righteous' => esc_html__('Righteous', 'selfie'),	
		'Rochester' => esc_html__('Rochester', 'selfie'),	
		'Rock+Salt' => esc_html__('Rock Salt', 'selfie'),	
		'Rokkitt' => esc_html__('Rokkitt', 'selfie'),	
		'Rosario' => esc_html__('Rosario', 'selfie'),	
		'Ruslan+Display' => esc_html__('Ruslan Display', 'selfie'),	
		'Salsa' => esc_html__('Salsa', 'selfie'),	
		'Sancreek' => esc_html__('Sancreek', 'selfie'),
		'sans-serif' => esc_html__('sans-serif', 'selfie'),
		'Sansita+One' => esc_html__('Sansita One', 'selfie'),	
		'Satisfy' => esc_html__('Satisfy', 'selfie'),
		'Schoolbell' => esc_html__('Schoolbell', 'selfie'),
		'serif' => esc_html__('serif', 'selfie'),		
		'Shadows+Into+Light' => esc_html__('Shadows Into Light', 'selfie'),	
		'Shanti' => esc_html__('Shanti', 'selfie'),	
		'Short+Stack' => esc_html__('Short Stack', 'selfie'),	
		'Sigmar+One' => esc_html__('Sigmar One', 'selfie'),	
		'Signika+Negative' => esc_html__('Signika Negative', 'selfie'),	
		'Signika' => esc_html__('Signika', 'selfie'),	
		'Six+Caps' => esc_html__('Six Caps', 'selfie'),	
		'Slackey' => esc_html__('Slackey', 'selfie'),	
		'Smokum' => esc_html__('Smokum', 'selfie'),	
		'Smythe' => esc_html__('Smythe', 'selfie'),	
		'Sniglet' => esc_html__('Sniglet', 'selfie'),	
		'Snippet' => esc_html__('Snippet', 'selfie'),
		'Source+Sans+Pro' => esc_html__('Source Sans Pro', 'selfie'),		
		'Sorts+Mill+Goudy' => esc_html__('Sorts Mill Goudy', 'selfie'),	
		'Special+Elite' => esc_html__('Special Elite', 'selfie'),	
		'Spinnaker' => esc_html__('Spinnaker', 'selfie'),	
		'Spirax' => esc_html__('Spirax', 'selfie'),	
		'Stardos+Stencil' => esc_html__('Stardos Stencil', 'selfie'),	
		'Sue+Ellen+Francisco' => esc_html__('Sue Ellen Francisco', 'selfie'),	
		'Sunshiney' => esc_html__('Sunshiney', 'selfie'),	
		'Supermercado+One' => esc_html__('Supermercado One', 'selfie'),	
		'Swanky+and+Moo+Moo' => esc_html__('Swanky and Moo Moo', 'selfie'),	
		'Syncopate' => esc_html__('Syncopate', 'selfie'),	
		'Tangerine' => esc_html__('Tangerine', 'selfie'),
		'Tenor+Sans' => esc_html__('Tenor Sans', 'selfie'),	
		'Terminal+Dosis' => esc_html__('Terminal Dosis', 'selfie'),	
		'The+Girl+Next+Door' => esc_html__('The Girl Next Door', 'selfie'),	
		'Tienne' => esc_html__('Tienne', 'selfie'),	
		'Tinos' => esc_html__('Tinos', 'selfie'),	
		'Tulpen+One' => esc_html__('Tulpen One', 'selfie'),	
		'Ubuntu+Condensed' => esc_html__('Ubuntu Condensed', 'selfie'),	
		'Ubuntu+Mono' => esc_html__('Ubuntu Mono', 'selfie'),	
		'Ubuntu' => esc_html__('Ubuntu', 'selfie'),	
		'Ultra' => esc_html__('Ultra', 'selfie'),	
		'UnifrakturCook' => esc_html__('UnifrakturCook', 'selfie'),	
		'UnifrakturMaguntia' => esc_html__('UnifrakturMaguntia', 'selfie'),	
		'Unkempt' => esc_html__('Unkempt', 'selfie'),	
		'Unlock' => esc_html__('Unlock', 'selfie'),	
		'Unna' => esc_html__('Unna', 'selfie'),	
		'VT323' => esc_html__('VT323', 'selfie'),	
		'Varela+Round' => esc_html__('Varela Round', 'selfie'),	
		'Varela' => esc_html__('Varela', 'selfie'),	
		'Vast+Shadow' => esc_html__('Vast Shadow', 'selfie'),	
		'Vibur' => esc_html__('Vibur', 'selfie'),	
		'Vidaloka' => esc_html__('Vidaloka', 'selfie'),	
		'Volkhov' => esc_html__('Volkhov', 'selfie'),	
		'Vollkorn' => esc_html__('Vollkorn', 'selfie'),	
		'Voltaire' => esc_html__('Voltaire', 'selfie'),
		'Waiting+for+the+Sunrise' => esc_html__('Waiting for the Sunrise', 'selfie'),
		'Wallpoet' => esc_html__('Wallpoet', 'selfie'),
		'Walter+Turncoat' => esc_html__('Walter Turncoat', 'selfie'),
		'Wire+One' => esc_html__('Wire One', 'selfie'),
		'Yanone+Kaffeesatz' => esc_html__('Yanone Kaffeesatz', 'selfie'),
		'Yellowtail' => esc_html__('Yellowtail', 'selfie'),
		'Yeseva+One' => esc_html__('Yeseva One', 'selfie'),
		'Zeyada' => esc_html__('Zeyada', 'selfie'),
		
	);



/*--------------------------------*/
/* Responsive Array */
/*--------------------------------*/
	$responsive_array = array(
		'On' => esc_html__('On', 'selfie'),
		'Off' => esc_html__('Off', 'selfie')		
	);	

/*--------------------------------*/
/* Layout Array */
/*--------------------------------*/
	$layout_array = array(
		'Wide' => esc_html__('Wide', 'selfie'),
		'Boxed' => esc_html__('Boxed', 'selfie')		
	);	
	

/*--------------------------------*/
/* Header Options Array */
/*--------------------------------*/
	$menu_array = array(
		'Opened' => esc_html__('Opened', 'selfie'),
		'Closed' => esc_html__('Closed', 'selfie')	
	);	


/*--------------------------------*/
/* Categories Begin */
/*--------------------------------*/
	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
/*--------------------------------*/
/* Categories End */
/*--------------------------------*/


/*--------------------------------*/
/* Tags Begin */
/*--------------------------------*/	
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}
/*--------------------------------*/
/* Tags End */
/*--------------------------------*/	



/*--------------------------------*/
/* Options Page Begin */
/*--------------------------------*/	
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
/*--------------------------------*/
/* Options Page End */
/*--------------------------------*/	



/*--------------------------------*/
/* Variables Start */
/*--------------------------------*/
	$imagepath =  get_template_directory_uri() . '/images/';
	$options = array();	
/*--------------------------------*/
/* Variables End */
/*--------------------------------*/

	
/*--------------------------------*/
/* Site Options Start */
/*--------------------------------*/
	$options[] = array(
		'name' => esc_html__('Site Options', 'selfie'),
		'type' => 'heading');
	
	$options[] = array(
	'name' => esc_html__('Please enter Rev./Layer Slider Shortcode', 'selfie'),
	'desc' => esc_html__('This is the Slider that will be shown in your front page', 'selfie'),
	'id' => 'page_slider',
	'std' => '',
	'class' => 'mini',
	'type' => 'text');
	
	$options[] = array(
	'name' => esc_html__('Please choose Site Font', 'selfie'),
	'desc' => esc_html__('The font that will be displayed for the whole site.', 'selfie'),
	'id' => 'select_font',
	'std' => 'Open+Sans',
	'type' => 'select',
	'options' => $fonts_array);

	$options[] = array(
	'name' => esc_html__('Please choose a color for the Site', 'selfie'),
	'desc' => esc_html__('This color will be your site color (Links, borders, ...etc)', 'selfie'),
	'id' => 'theme_color',
	'std' => '#1abc9c',
	'type' => 'color' );		
	
	$options[] = array(	
	'name' => esc_html__('Please choose a background color for the Menu', 'selfie'),
	'desc' => esc_html__('This color will be applied as a menu background', 'selfie'),
	'id' => 'menu_background_color',
	'std' => '#000000',
	'type' => 'color' );
	
	$options[] = array(	
	'name' => esc_html__('Please choose Menu items color', 'selfie'),
	'desc' => esc_html__('This color will be applied for menu items', 'selfie'),
	'id' => 'menu_items_color',
	'std' => '#ffffff',
	'type' => 'color' );	
	
	$options[] = array(	
	'name' => esc_html__('Please choose color for Menu dropdown background', 'selfie'),
	'desc' => esc_html__('This color will for Menu dropdown background', 'selfie'),
	'id' => 'menu_dropdown_background',
	'std' => '#000000',
	'type' => 'color' );	
	
	$options[] = array(
	'name' => esc_html__('Please choose Menu dropdown background opacity', 'selfie'),
	'desc' => esc_html__('This value is your Menu dropdown background opacity', 'selfie'),
	'id' => 'menu_dropdown_opacity',
	'std' => '0.8',
	'class' => 'mini',
	'type' => 'text');		
	
	$options[] = array(	
	'name' => esc_html__('Please choose color for Menu dropdown items', 'selfie'),
	'desc' => esc_html__('This color will for for Menu dropdown items', 'selfie'),
	'id' => 'menu_dropdown_items',
	'std' => '#ffffff',
	'type' => 'color' );		
	
	$options[] = array(	
	'name' => esc_html__('Please choose a background color for the Sticky Menu', 'selfie'),
	'desc' => esc_html__('This color will be applied as a sticky menu background', 'selfie'),
	'id' => 'sticky_menu_background_color',
	'std' => '#FFF',
	'type' => 'color' );	
	
	$options[] = array(	
	'name' => esc_html__('Please choose color for Menu items for the Sticky Menu', 'selfie'),
	'desc' => esc_html__('This color will for for Menu items for the Sticky Menu', 'selfie'),
	'id' => 'menu_sticky_items',
	'std' => '#999999',
	'type' => 'color' );	
	
	$options[] = array(
	'name' => esc_html__('Please choose a background opacity for the Sticky Menu', 'selfie'),
	'desc' => esc_html__('This value is your Sticky menu background opacity', 'selfie'),
	'id' => 'menu_background_color_opacity_sticky',
	'std' => '0.95',
	'class' => 'mini',
	'type' => 'text');	
	
	
	$options[] = array(
	'name' => esc_html__('Please choose a background color for processes icons', 'selfie'),
	'desc' => esc_html__('This color will be for processes icons background', 'selfie'),
	'id' => 'icon_process_color',
	'std' => '',
	'type' => 'color' );			

	$options[] = array(
	'name' => esc_html__('Please choose a border color for processes icons', 'selfie'),
	'desc' => esc_html__('This color will be for processes icons border', 'selfie'),
	'id' => 'icon_process_border',
	'std' => '#1abc9c',
	'type' => 'color' );		
	
	$options[] = array(
	'name' => esc_html__('Display Back to Top link?', 'selfie'),
	'desc' => esc_html__('On/Off Back to Top link', 'selfie'),
	'id' => 'select_backtotop',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);
	
	$options[] = array(
	'name' => esc_html__('Enable Animation Effects on Mobile/iPad devices?', 'selfie'),
	'desc' => esc_html__('On/Off Animation Effects on Mobile/iPad devices', 'selfie'),
	'id' => 'select_animation',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);		
	
	$options[] = array(
	'name' => esc_html__('Do you want to enable Presents/Education Title Link', 'selfie'),
	'desc' => esc_html__('On/Off your Presents/Education Link to open them in an internal page', 'selfie'),
	'id' => 'select_present_education_link',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);	
	
	$options[] = array(
	'name' => esc_html__('Please choose a background color for Pages Title section', 'selfie'),
	'desc' => esc_html__('This color will a background color for Pages Title section', 'selfie'),
	'id' => 'top_title_color',
	'std' => '#1abc9c',
	'type' => 'color' );		
	
	$options[] = array(
	'name' => esc_html__('Please choose a background image for Pages Title section', 'selfie'),
	'desc' => esc_html__('Upload your own image/pattern here or keep it empty', 'selfie'),
	'id' => 'top_title_image',
	'std' => get_template_directory_uri() . '/images/selfie-internal-pages-new.jpg',
	'type' => 'upload');
	
	$options[] = array(
	'name' => esc_html__('Please choose a color for Pages Title', 'selfie'),
	'desc' => esc_html__('This color will be for Pages Title', 'selfie'),
	'id' => 'top_title_icon_color',
	'std' => '#cccccc',
	'type' => 'color' );	
	

	
/*--------------------------------*/
/* Site Options End */
/*--------------------------------*/




/*--------------------------------*/
/* Resume Options Start */
/*--------------------------------*/
	$options[] = array(
		'name' => esc_html__('Top Header Options', 'selfie'),
		'type' => 'heading');	

		
	$options[] = array(
	'name' => esc_html__('Please enter Top Header mini description', 'selfie'),
	'desc' => esc_html__('This description will be displayed in your top header', 'selfie'),
	'id' => 'top_header_desc',
	'std' => 'Welcome to Selfie',
	'class' => 'mini',
	'type' => 'text');			
	
	$options[] = array(
	'name' => esc_html__('Please enter Top Header Email', 'selfie'),
	'desc' => esc_html__('This Email will be displayed in your top header', 'selfie'),
	'id' => 'top_header_email',
	'std' => 'info@selfiebusiness.com',
	'class' => 'mini',
	'type' => 'text');		
	
	$options[] = array(
	'name' => esc_html__('Please enter Top Header Phone', 'selfie'),
	'desc' => esc_html__('This Phone will be displayed in your top header', 'selfie'),
	'id' => 'top_header_phone',
	'std' => '345-657-534',
	'class' => 'mini',
	'type' => 'text');		
	
	$options[] = array(
	'name' => esc_html__('Display Cart in your Top Header?', 'selfie'),
	'desc' => esc_html__('On/Off Cart in your Top Header', 'selfie'),
	'id' => 'select_shoppingcart',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);		
	
/*--------------------------------*/
/* Headings Begin */
/*--------------------------------*/	

	$options[] = array(
		'name' => esc_html__('Headings Options', 'selfie'),
		'type' => 'heading');

	$options[] = array(
	'name' => esc_html__('Please choose a font family for your H1 Headings', 'selfie'),
	'desc' => esc_html__('This font family will be displayed for all H1 headings in your site.', 'selfie'),
	'id' => 'h1_font',
	'std' => 'Open+Sans',
	'type' => 'select',
	'options' => $fonts_array);
	
	$options[] = array(
	'name' => esc_html__('Please choose a color for your H1 Headings', 'selfie'),
	'desc' => esc_html__('This color will be displayed for all H1 headings in your site.', 'selfie'),
	'id' => 'h1_color',
	'std' => '#121212',
	'type' => 'color' );
	
	$options[] = array(
	'name' => esc_html__('Please choose a font size for your H1 Headings', 'selfie'),
	'desc' => esc_html__('This font size will be displayed for all H1 headings in your site.', 'selfie'),
	'id' => 'h1_font_size',
	'std' => '36px',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => esc_html__('Please choose a line height for your H1 Headings', 'selfie'),
	'desc' => esc_html__('This line height will be displayed for all H1 headings in your site.', 'selfie'),
	'id' => 'h1_line_height',
	'std' => '1.5',
	'class' => 'mini',
	'type' => 'text');		

	
	$options[] = array(
	'name' => esc_html__('Please choose a font family for your H2 Headings', 'selfie'),
	'desc' => esc_html__('This font family will be displayed for all H2 headings in your site.', 'selfie'),
	'id' => 'h2_font',
	'std' => 'Open+Sans',
	'type' => 'select',
	'options' => $fonts_array);	
	
	$options[] = array(
	'name' => esc_html__('Please choose a color for your H2 Headings', 'selfie'),
	'desc' => esc_html__('This color will be displayed for all H2 headings in your site.', 'selfie'),
	'id' => 'h2_color',
	'std' => '#121212',
	'type' => 'color' );

	$options[] = array(
	'name' => esc_html__('Please choose a font size for your H2 Headings', 'selfie'),
	'desc' => esc_html__('This font size will be displayed for all H2 headings in your site.', 'selfie'),
	'id' => 'h2_font_size',
	'std' => '30px',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => esc_html__('Please choose a line height for your H2 Headings', 'selfie'),
	'desc' => esc_html__('This line height will be displayed for all H2 headings in your site.', 'selfie'),
	'id' => 'h2_line_height',
	'std' => '1.5',
	'class' => 'mini',
	'type' => 'text');		
	
	
	
	
	$options[] = array(
	'name' => esc_html__('Please choose a font family for your H3 Headings', 'selfie'),
	'desc' => esc_html__('This font family will be displayed for all H3 headings in your site.', 'selfie'),
	'id' => 'h3_font',
	'std' => 'Open+Sans',
	'type' => 'select',
	'options' => $fonts_array);		
	
	$options[] = array(
	'name' => esc_html__('Please choose a color for your H3 Headings', 'selfie'),
	'desc' => esc_html__('This color will be displayed for all H3 headings in your site.', 'selfie'),
	'id' => 'h3_color',
	'std' => '#121212',
	'type' => 'color' );

	$options[] = array(
	'name' => esc_html__('Please choose a font size for your H3 Headings', 'selfie'),
	'desc' => esc_html__('This font size will be displayed for all H3 headings in your site.', 'selfie'),
	'id' => 'h3_font_size',
	'std' => '24px',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => esc_html__('Please choose a line height for your H3 Headings', 'selfie'),
	'desc' => esc_html__('This line height will be displayed for all H3 headings in your site.', 'selfie'),
	'id' => 'h3_line_height',
	'std' => '1.5',
	'class' => 'mini',
	'type' => 'text');	

	


	$options[] = array(
	'name' => esc_html__('Please choose a font family for your H4 Headings', 'selfie'),
	'desc' => esc_html__('This font family will be displayed for all H4 headings in your site.', 'selfie'),
	'id' => 'h4_font',
	'std' => 'Open+Sans',
	'type' => 'select',
	'options' => $fonts_array);	
	
	$options[] = array(
	'name' => esc_html__('Please choose a color for your H4 Headings', 'selfie'),
	'desc' => esc_html__('This color will be displayed for all H4 headings in your site.', 'selfie'),
	'id' => 'h4_color',
	'std' => '#121212',
	'type' => 'color' );

	$options[] = array(
	'name' => esc_html__('Please choose a font size for your H4 Headings', 'selfie'),
	'desc' => esc_html__('This font size will be displayed for all H4 headings in your site.', 'selfie'),
	'id' => 'h4_font_size',
	'std' => '18px',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => esc_html__('Please choose a line height for your H4 Headings', 'selfie'),
	'desc' => esc_html__('This line height will be displayed for all H4 headings in your site.', 'selfie'),
	'id' => 'h4_line_height',
	'std' => '1.5',
	'class' => 'mini',
	'type' => 'text');		
	
	
	$options[] = array(
	'name' => esc_html__('Please choose a font family for your H5 Headings', 'selfie'),
	'desc' => esc_html__('This font family will be displayed for all H5 headings in your site.', 'selfie'),
	'id' => 'h5_font',
	'std' => 'Open+Sans',
	'type' => 'select',
	'options' => $fonts_array);		
	
	$options[] = array(
	'name' => esc_html__('Please choose a color for your H5 Headings', 'selfie'),
	'desc' => esc_html__('This color will be displayed for all H5 headings in your site.', 'selfie'),
	'id' => 'h5_color',
	'std' => '#121212',
	'type' => 'color' );

	$options[] = array(
	'name' => esc_html__('Please choose a font size for your H5 Headings', 'selfie'),
	'desc' => esc_html__('This font size will be displayed for all H5 headings in your site.', 'selfie'),
	'id' => 'h5_font_size',
	'std' => '14px',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => esc_html__('Please choose a line height for your H5 Headings', 'selfie'),
	'desc' => esc_html__('This line height will be displayed for all H5 headings in your site.', 'selfie'),
	'id' => 'h5_line_height',
	'std' => '1.5',
	'class' => 'mini',
	'type' => 'text');	

	
	$options[] = array(
	'name' => esc_html__('Please choose a font family for your H6 Headings', 'selfie'),
	'desc' => esc_html__('This font family will be displayed for all H6 headings in your site.', 'selfie'),
	'id' => 'h6_font',
	'std' => 'Open+Sans',
	'type' => 'select',
	'options' => $fonts_array);	
		
	
	$options[] = array(
	'name' => esc_html__('Please choose a color for your H6 Headings', 'selfie'),
	'desc' => esc_html__('This color will be displayed for all H6 headings in your site.', 'selfie'),
	'id' => 'h6_color',
	'std' => '#121212',
	'type' => 'color' );	
	
	$options[] = array(
	'name' => esc_html__('Please choose a font size for your H6 Headings', 'selfie'),
	'desc' => esc_html__('This font size will be displayed for all H6 headings in your site.', 'selfie'),
	'id' => 'h6_font_size',
	'std' => '12px',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => esc_html__('Please choose a line height for your H6 Headings', 'selfie'),
	'desc' => esc_html__('This line height will be displayed for all H6 headings in your site.', 'selfie'),
	'id' => 'h6_line_height',
	'std' => '1.5',
	'class' => 'mini',
	'type' => 'text');	
	
/*--------------------------------*/
/* Headings End */
/*--------------------------------*/	


/*--------------------------------*/
/* Logo & Favicon Begin */
/*--------------------------------*/	
	$options[] = array(
		'name' => esc_html__('Logo & Favicon Options', 'selfie'),
		'type' => 'heading');	

	$options[] = array(
	'name' => esc_html__('Do you want to display a Logo on your site?', 'selfie'),
	'desc' => esc_html__('On/Off your Site Logo', 'selfie'),
	'id' => 'select_display_logo',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);
	
	
	$options[] = array(
	'name' => esc_html__('Please choose a logo for your Homepage', 'selfie'),
	'desc' => esc_html__('Upload your own logo here (Suggest: 110 X 40 pixel)', 'selfie'),
	'id' => 'theme_logo',
	'std' => get_template_directory_uri() . '/images/logo.png',
	'type' => 'upload');
	
	$options[] = array(
	'name' => esc_html__('Please enter the padding top value for the Logo in PIXELS', 'selfie'),
	'desc' => esc_html__('This is the Space between the logo container and the top of the container', 'selfie'),
	'id' => 'theme_site_logo_padding_top',
	'std' => '0px',
	'class' => 'mini',
	'type' => 'text');
	
	$options[] = array(
	'name' => esc_html__('Please enter the padding bottom value for the Logo in PIXELS', 'selfie'),
	'desc' => esc_html__('This is the Space between the logo container and the bottom of the container', 'selfie'),
	'id' => 'theme_site_logo_padding_bottom',
	'std' => '0px',
	'class' => 'mini',
	'type' => 'text');
	
	$options[] = array(
	'name' => esc_html__('Please enter the padding left value for the Logo in PIXELS', 'selfie'),
	'desc' => esc_html__('This is the Space between the logo container and the left of the container', 'selfie'),
	'id' => 'theme_site_logo_padding_left',
	'std' => '0px',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => esc_html__('Please enter the padding right value for the Logo in PIXELS', 'selfie'),
	'desc' => esc_html__('This is the Space between the logo container and the right of the container', 'selfie'),
	'id' => 'theme_site_logo_padding_right',
	'std' => '0px',
	'class' => 'mini',
	'type' => 'text');		
	
	$options[] = array(
	'name' => esc_html__('Please enter a text to display instead of the logo if you chosen not to display logo from the above options', 'selfie'),
	'desc' => esc_html__('This text will be shown instead of logo there is no logo uploaded to the site or if you chosen not to display the logo from the above options.', 'selfie'),
	'id' => 'theme_site_logo_text',
	'std' => 'Selfie',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => esc_html__('Please choose a logo for your sticky Menu', 'selfie'),
	'desc' => esc_html__('Upload your own logo here (Suggest: 110 X 40 pixel)', 'selfie'),
	'id' => 'theme_logo_sticky',
	'std' => get_template_directory_uri() . '/images/logo_sticky.png',
	'type' => 'upload');	
	
	$options[] = array(
	'name' => esc_html__('Please enter your (16 X 16) Favicon', 'selfie'),
	'desc' => esc_html__('This Favicon will be displayed within your browser', 'selfie'),
	'id' => 'theme_favicon',
	'type' => 'upload');	
	
/*--------------------------------*/
/* Logo & Favicon End */
/*--------------------------------*/	

/*--------------------------------*/
/* Site Social Begin */
/*--------------------------------*/	
	$options[] = array(
		'name' => esc_html__('Site Social Media', 'selfie'),
		'type' => 'heading');			
	
	$options[] = array(
		'name' => esc_html__('Please enter your FaceBook page URL', 'selfie'),
		'desc' => esc_html__('This link will be used by your users to navigate to your Facebook page from your site header.', 'selfie'),
		'id' => 'facebook_user_account',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => esc_html__('Please enter your Twitter page URL', 'selfie'),
		'desc' => esc_html__('This link will be used by your users to navigate to your Twitter page from your site header.', 'selfie'),
		'id' => 'twitter_user_account',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => esc_html__('Please enter your Dribbble page URL', 'selfie'),
		'desc' => esc_html__('This link will be used by your users to navigate to your Dribbble page from your site header.', 'selfie'),
		'id' => 'dribbble_user_account',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');		
		
	$options[] = array(
		'name' => esc_html__('Please enter your Pinterest page URL', 'selfie'),
		'desc' => esc_html__('This link will be used by your users to navigate to your Pinterest page from your site header.', 'selfie'),
		'id' => 'pinterest_user_account',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');


	$options[] = array(
		'name' => esc_html__('Please enter your LinkedIn page URL', 'selfie'),
		'desc' => esc_html__('This link will be used by your users to navigate to your LinkedIn page from your site header.', 'selfie'),
		'id' => 'linkedin_user_account',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => esc_html__('Please enter your RSS page URL', 'selfie'),
		'desc' => esc_html__('This link will be used by your users to navigate to your RSS page from your site header.', 'selfie'),
		'id' => 'rss_user_account',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => esc_html__('Please enter your Skype ID', 'selfie'),
		'desc' => esc_html__('This link will be used by your users to know your Skype ID.', 'selfie'),
		'id' => 'skype_user_account',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => esc_html__('Please enter your Google+ page URL', 'selfie'),
		'desc' => esc_html__('This link will be used by your users to navigate to your Google+ page from your site header.', 'selfie'),
		'id' => 'google_user_account',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');		
		
	$options[] = array(
		'name' => esc_html__('Please enter your Deviantart page URL', 'selfie'),
		'desc' => esc_html__('This link will be used by your users to navigate to your Deviantart page from your site header.', 'selfie'),
		'id' => 'deviantart_user_account',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => esc_html__('Please enter your Instagram page URL', 'selfie'),
		'desc' => esc_html__('This link will be used by your users to navigate to your Instagram page from your site header.', 'selfie'),
		'id' => 'instagram_user_account',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => esc_html__('Please enter your YouTube page URL', 'selfie'),
		'desc' => esc_html__('This link will be used by your users to navigate to your YouTube page from your site header.', 'selfie'),
		'id' => 'youtube_user_account',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');		
/*--------------------------------*/
/* Site Social End */
/*--------------------------------*/


/*--------------------------------*/
/* Site Portfolio Begin */
/*--------------------------------*/	
	$options[] = array(
		'name' => esc_html__('Index Page - Options', 'selfie'),
		'type' => 'heading');

	$options[] = array(
	'name' => esc_html__('Please enter a page title for your Index Page', 'selfie'),
	'desc' => esc_html__('This Title will be displayed for your Index Page.', 'selfie'),
	'id' => 'index_page_title',
	'std' => 'Home',
	'class' => 'mini',
	'type' => 'text');

	
/*--------------------------------*/
/* Site Portfolio End */
/*--------------------------------*/



/*--------------------------------*/
/* Site Footer Begin */
/*--------------------------------*/			
	$options[] = array(
		'name' => esc_html__('Footer Options', 'selfie'),
		'type' => 'heading' );

		
	$options[] = array(
	'name' => esc_html__('Do you want to display footer columns ?', 'selfie'),
	'desc' => esc_html__('On/Off footer columns', 'selfie'),
	'id' => 'select_columns_columns',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);			
		
	$options[] = array(
	'name' => esc_html__('Please choose a background color for your Footer section', 'selfie'),
	'desc' => esc_html__('This color will be used as a background color on your footer section', 'selfie'),
	'id' => 'foo_color',
	'std' => '#222222',
	'type' => 'color' );
	
	$options[] = array(
	'name' => esc_html__('Please choose a text color for your Footer section', 'selfie'),
	'desc' => esc_html__('This color will be used as a text color on your footer section', 'selfie'),
	'id' => 'foo_text_color',
	'std' => '#999999',
	'type' => 'color' );	
	
	$options[] = array(
	'name' => esc_html__('Please choose a borders color for your Footer section', 'selfie'),
	'desc' => esc_html__('This color will be used as borders color on your footer section', 'selfie'),
	'id' => 'foo_border_color',
	'std' => '#333333',
	'type' => 'color' );

	
	$options[] = array(
	'name' => esc_html__('Do you want to display the Copyrights Section in the footer?', 'selfie'),
	'desc' => esc_html__('On/Off Copyrights Section', 'selfie'),
	'id' => 'select_copyrights_columns',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);		

	
	$options[] = array(
	'name' => esc_html__('Please enter your Copyrights Text', 'selfie'),
	'desc' => esc_html__('This text will be shown as a Copyrights text in your footer section.', 'selfie'),
	'id' => 'footer_text',
	'std' => 'Copyright 2014. All Rights Reserved.',
	'type' => 'textarea');

	$options[] = array(
	'name' => esc_html__('Please enter your Email', 'selfie'),
	'desc' => esc_html__('This text will be shown as a Email address in your footer section.', 'selfie'),
	'id' => 'footer_email',
	'std' => 'example@site.com',
	'class' => 'mini',
	'type' => 'text');	
	
	$options[] = array(
	'name' => esc_html__('Please enter your Phone', 'selfie'),
	'desc' => esc_html__('This text will be shown as a Phone number in your footer section.', 'selfie'),
	'id' => 'footer_phone',
	'std' => '+1 323-444-4553',
	'class' => 'mini',
	'type' => 'text');	

/*--------------------------------*/
/* Site Footer End */
/*--------------------------------*/	


/*--------------------------------*/
/* Site Portfolio Begin */
/*--------------------------------*/	
	$options[] = array(
		'name' => esc_html__('Portfolio - Options', 'selfie'),
		'type' => 'heading');

	$options[] = array(
	'name' => esc_html__('Do you want to show (About Author) section in the Single Portfolio Page?', 'selfie'),
	'desc' => esc_html__('On/Off (About Author) Section', 'selfie'),
	'id' => 'portfolio_author_option',
	'std' => 'Off',
	'type' => 'select',
	'options' => $responsive_array);
	
	$options[] = array(
	'name' => esc_html__('Portfolio Page URL', 'selfie'),
	'desc' => esc_html__('Your Portfolio Page URL', 'selfie'),
	'id' => 'portfolio_url_option',
	'class' => 'mini',	
	'type' => 'text');	
	
/*--------------------------------*/
/* Site Portfolio End */
/*--------------------------------*/


/*--------------------------------*/
/* Site Blog Begin */
/*--------------------------------*/	
	$options[] = array(
		'name' => esc_html__('Blog - Options', 'selfie'),
		'type' => 'heading');

	$options[] = array(
	'name' => esc_html__('Do you want to show (About Author) section in the Single Post Page?', 'selfie'),
	'desc' => esc_html__('On/Off (About Author) Section', 'selfie'),
	'id' => 'blog_author_option',
	'std' => 'On',
	'type' => 'select',
	'options' => $responsive_array);
	
/*--------------------------------*/
/* Site Blog End */
/*--------------------------------*/





/*--------------------------------*/
/* 404 Begin */
/*--------------------------------*/	
	$options[] = array(
		'name' => esc_html__('404 Page - Options', 'selfie'),
		'type' => 'heading');
		
	$options[] = array(
	'name' => esc_html__('Please enter a page title for your 404', 'selfie'),
	'desc' => esc_html__('This Title will be displayed for any 404/incorrect page.', 'selfie'),
	'id' => 'blank_page_title',
	'std' => '404 Error Page',
	'class' => 'mini',
	'type' => 'text');
	
	$options[] = array(
	'name' => esc_html__('Please enter a brief description for your customers', 'selfie'),
	'desc' => esc_html__('This description will be displayed at the middle of the page.', 'selfie'),
	'id' => 'blank_page_desc',
	'std' => 'Unfortunately, the page that are you looking</br>for is not available. Try another search.',
	'type' => 'textarea');		


/*--------------------------------*/
/* 404 End */
/*--------------------------------*/	


/*--------------------------------*/
/* Custom CSS Begin */
/*--------------------------------*/		
	$options[] = array(
		'name' => esc_html__('Custom CSS', 'selfie'),
		'type' => 'heading');

	$options[] = array(
	'name' => esc_html__('Please feel free to add any custom CSS code for your site', 'selfie'),
	'desc' => esc_html__('Here you can enter any type of a valid CSS code in order to manage your site style.', 'selfie'),
	'id' => 'css_text',
	'std' => '',
	'type' => 'textarea');		
/*--------------------------------*/
/* Custom CSS End */
/*--------------------------------*/
	



	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
	

	return $options;
}



add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});

	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}

});
</script>

<?php
}