<?php

// access denied
defined('JPATH_BASE') or die();
 
class JElementGoogleFonts extends JElement
{
	// name of element
	var $_name = 'GoogleFonts';
	// Construct an array of the HTML OPTION statements.
	var $_options = array();
	// function to create an element
	function fetchElement($name, $value, &$node, $control_name)
	{
        // Base name of the HTML control.
        $ctrl  = $control_name .'['. $name .']';
        $this->_options = array();
		// iterating
		$temp_options = array(
			array('none','- - - None - - -'),
			array('Allan:bold', 'Allan'),
			array('Allerta', 'Allerta'),
			array('Allerta+Stencil', 'Allerta Stencil'),
			array('Amaranth', 'Amaranth'),
			array('Anonymous+Pro', 'Anonymous Pro'),
			array('Anonymous+Pro:italic', 'Anonymous Pro (italic)'),
			array('Anonymous+Pro:bold', 'Anonymous Pro (bold)'),
			array('Anonymous+Pro:bolditalic', 'Anonymous Pro (bold italic)'),
			array('Anton', 'Anton'),
			array('Architects+Daughter', 'Architects Daughter'),
			array('Arimo', 'Arimo'),
			array('Arimo:italic', 'Arimo (italic)'),
			array('Arimo:bold', 'Arimo (bold)'),
			array('Arimo:bolditalic', 'Arimo (bold italic)'),
			array('Arvo', 'Arvo'),
			array('Arvo:italic', 'Arvo (italic)'),
			array('Arvo:bold', 'Arvo (bold)'),
			array('Arvo:bolditalic', 'Arvo (bold italic)'),
			array('Astloch', 'Astloch'),
			array('Astloch:bold', 'Astloch (bold)'),
			array('Bentham', 'Bentham'), 
			array('Bevan', 'Bevan'),
			array('Buda:light', 'Buda'), // 79
			array('Cabin:400', 'Cabin (400)'), // 80
			array('Cabin:500', 'Cabin (500)'), // 80
			array('Cabin:600', 'Cabin (600)'), // 80
			array('Cabin:bold', 'Cabin (bold)'), // 80
			array('Cabin+Sketch:bold', 'Cabin Sketch (bold)'),
			array('Calligraffitti', 'Calligraffitti'),
			array('Candal', 'Candal'),
			array('Cantarell','Cantarell'),
			array('Cantarell:italic','Cantarell (italic)'),
			array('Cantarell:bold','Cantarell (bold)'),
			array('Cantarell:bolditalic','Cantarell (bold italic)'),
			array('Cardo','Cardo'),
			array('Cherry+Cream+Soda', 'Cherry Cream Soda'),
			array('Chewy', 'Chewy'),
			array('Coda+Caption:800', 'Coda Caption (800)'),
			array('Coda:800','Coda'),
			array('Coming+Soon', 'Coming Soon'),
			array('Copse','Copse'),
			array('Corben:bold', 'Corben'), // 81
			array('Cousine','Cousine'),
			array('Cousine:italic','Cousine (italic)'),
			array('Cousine:bold','Cousine (bold)'),
			array('Cousine:bolditalic','Cousine (bold italic)'),
			array('Covered+By+Your+Grace','Covered By Your Grace'),
			array('Crafty+Girls', 'Crafty Girls'),
			array('Crimson+Text','Crimision Text'),
			array('Crushed', 'Crushed'),
			array('Cuprum','Cuprum'),
			array('Dancing+Script', 'Dancing Script'),
			array('Droid+Sans','Droid Sans'),
			array('Droid+Sans:bold','Droid Sans (bold)'),
			array('Droid+Sans+Mono','Droid Sans Mono'),
			array('Droid+Serif','Droid Serif'),
			array('Droid+Serif:italic','Droid Serif (italic)'),
			array('Droid+Serif:bold','Droid Serif (bold)'),
			array('Droid+Serif:bolditalic','Droid Serif (bold italic)'),
			array('Expletus+Sans:400', 'Expletus Sans (400)'),
			array('Expletus+Sans:500', 'Expletus Sans (500)'),
			array('Expletus+Sans:600', 'Expletus Sans (600)'),
			array('Expletus+Sans:700', 'Expletus Sans (700)'),
			array('Fontdiner+Swanky', 'Fontdiner Swanky'),
			array('Geo', 'Geo'),
			array('Goudy+Bookletter+1911', 'Goudy Bookletter 1911'),
			array('Gruppo', 'Gruppo'), // 82
			array('Homemade+Apple', 'Homemade Apple'),
			array('IM+Fell+DW+Pica','IM Fell DW Pica'),
			array('IM+Fell+DW+Pica:italic','IM Fell DW Pica (italic)'),
			array('IM+Fell+DW+Pica+SC','IM Fell DW Pica SC'),
			array('IM+Fell+Double+Pica','IM Fell Double Pica'),
			array('IM+Fell+Double+Pica:italic','IM Fell Double Pica (italic)'),
			array('IM+Fell+Double+Pica+SC','IM Fell Double Pica SC'),
			array('IM+Fell+English','IM Fell English'),
			array('IM+Fell+English:italic','IM Fell English (italic)'),
			array('IM+Fell+English+SC','IM Fell English SC'),
			array('IM+Fell+French+Canon','IM Fell French Canon'),
			array('IM+Fell+French+Canon:italic','IM Fell French Canon (italic)'),
			array('IM+Fell+French+Canon+SC','IM Fell French Canon SC'), 
			array('IM+Fell+Great+Primer','IM Fell Great Primer'),
			array('IM+Fell+Great+Primer:italic','IM Fell Great Primer (italic)'),
			array('IM+Fell+Great+Primer+SC','IM Fell Great Primer SC'), 
			array('Inconsolata','Inconsolata'),
			array('Indie+Flower', 'Indie Flower'),
			array('Irish+Grover', 'Irish Grover'),
			array('Josefin+Sans:100','Josefin Sans (100)'), 
			array('Josefin+Sans:100italic','Josefin Sans (100 italic)'), 
			array('Josefin+Sans:300','Josefin Sans (300)'), 
			array('Josefin+Sans:300italic','Josefin Sans (300 italic)'), 
			array('Josefin+Sans:400','Josefin Sans (400)'), 
			array('Josefin+Sans:400italic','Josefin Sans (400 italic)'), 
			array('Josefin+Sans:600','Josefin Sans (600)'), 
			array('Josefin+Sans:600italic','Josefin Sans (600 italic)'), 
			array('Josefin+Sans:700','Josefin Sans (700)'), 
			array('Josefin+Sans:700italic','Josefin Sans (700 italic)'), 
			array('Josefin+Slab:100','Josefin Slab (100)'), 
			array('Josefin+Slab:100italic','Josefin Slab (100 italic)'), 
			array('Josefin+Slab:300','Josefin Slab (300)'), 
			array('Josefin+Slab:300italic','Josefin Slab (300 italic)'), 
			array('Josefin+Slab:400','Josefin Slab (400)'), 
			array('Josefin+Slab:400italic','Josefin Slab (400 italic)'), 
			array('Josefin+Slab:600','Josefin Slab (600)'), 
			array('Josefin+Slab:600italic','Josefin Slab (600 italic)'), 
			array('Josefin+Slab:700','Josefin Slab (700)'), 
			array('Josefin+Slab:700italic','Josefin Slab (700 italic)'), 
			array('Just+Another+Hand', 'Just Another Hand'), // 83
			array('Just+Me+Again+Down+Here','Just Me Again Down Here'), 
			array('Kenia','Kenia'), 
			array('Kranky', 'Kranky'),
			array('Kreon:300', 'Kreon (300)'),
			array('Kreon:400', 'Kreon (400)'),
			array('Kreon:700', 'Kreon (700)'),
			array('Kristi', 'Kristi'), // 84
			array('Lato:100','Lato (100)'), 
			array('Lato:100italic','Lato (100 italic)'), 
			array('Lato:300','Lato (300)'), 
			array('Lato:300','Lato (300 italic)'), 
			array('Lato:400','Lato (400)'), 
			array('Lato:400italic','Lato (400 italic)'), 
			array('Lato:700','Lato (700)'), 
			array('Lato:700italic','Lato (700 italic)'),
			array('Lato:900','Lato (900)'),
			array('Lato:900italic','Lato (900 italic)'), 
			array('League+Script', 'League Script'),
			array('Lekton:400', 'Lekton (400)'), // 85
			array('Lekton:italic', 'Lekton (italic)'), // 86
			array('Lekton:700', 'Lekton (700)'), // 87
			array('Lobster','Lobster'),
			array('Luckiest+Guy', 'Luckiest Guy'),
			array('Meddon', 'Meddon'),
			array('MedievalSharp', 'MedievalSharp'),
			array('Merriweather', 'Merriweather'), // 88
			array('Molengo','Molengo'),
			array('Mountains+of+Christmas','Mountains of Christmas'), 
			array('Neucha','Neucha'),
			array('Neuton','Neuton'),
			array('Nobile','Nobile'),
			array('Nobile:italic','Nobile (italic)'),
			array('Nobile:bold','Nobile (bold)'),
			array('Nobile:bolditalic','Nobile (bolditalic)'),
			array('OFL+Sorts+Mill+Goudy+TT','OFL Sorts Mill Goudy TT'),
			array('OFL+Sorts+Mill+Goudy+TT:italic','OFL Sorts Mill Goudy TT (italic)'),
			array('Old+Standard+TT','Old Standard TT'),
			array('Old+Standard+TT:italic','Old Standard TT (italic)'),
			array('Old+Standard+TT:bold','Old Standard TT (bold)'),
			array('Orbitron:400', 'Orbitron (400)'), 
			array('Orbitron:500', 'Orbitron (500)'),
			array('Orbitron:700', 'Orbitron (700)'),
			array('Orbitron:900', 'Orbitron (900)'), 
			array('PT+Sans','PT Sans'),
			array('PT+Sans:italic','PT Sans (italic)'),
			array('PT+Sans:bold','PT Sans (bold)'),
			array('PT+Sans:bolditalic','PT Sans (bold italic)'),
			array('PT+Sans+Caption','PT Sans Caption'),
			array('PT+Sans+Caption:bold','PT Sans Caption (bold)'),
			array('PT+Sans+Narrow','PT Sans Narrow'),
			array('PT+Sans+Narrow:bold','PT Sans Narrow (bold)'),
			array('PT+Serif', 'PT Serif'),
			array('PT+Serif:italic', 'PT Serif (italic)'),
			array('PT+Serif:bold', 'PT Serif (bold)'),
			array('PT+Serif:bolditalic', 'PT Serif (bold italic)'),
			array('PT+Serif+Caption', 'PT Serif Caption'),
			array('PT+Serif+Caption:italic', 'PT Serif Caption (italic)'),
			array('Pacifico', 'Pacifico'),
			array('Permanent+Marker', 'Permanent Marker'),
			array('Philosopher','Philosopher'),
			array('Puritan', 'Puritan'), 
			array('Puritan:italic', 'Puritan (italic)'),
			array('Puritan:bold', 'Puritan (bold)'),
			array('Puritan:bolditalic', 'Puritan (bold italic)'), 
			array('Quattrocento', 'Quattrocento'),
			array('Radley', 'Radley'),
			array('Raleway:100', 'Raleway'), 
			array('Reenie+Beanie','Reenie Beanie'),
			array('Rock+Salt', 'Rock Salt'),
			array('Schoolbell', 'Schoolbell'),
			array('Slackey', 'Slackey'),
			array('Sniglet:800', 'Sniglet'), 
			array('Sunshiney', 'Sunshiney'),
			array('Syncopate', 'Syncopate'), 
			array('Tangerine','Tangerine'),
			array('Tangerine:bold','Tangerine (bold)'),
			array('Tinos', 'Tinos'), 
			array('Tinos:italic', 'Tinos (italic)'),
			array('Tinos:bold', 'Tinos (bold)'),
			array('Tinos:bolditalic', 'Tinos (bold italic)'),   
			array('Ubuntu', 'Ubuntu'), // 89
			array('Ubuntu:italic', 'Ubuntu (italic)'), // 90
			array('Ubuntu:bold', 'Ubuntu (bold)'), // 91
			array('Ubuntu:bolditalic', 'Ubuntu (bold italic)'), // 92
			array('UnifakturCook:bold', 'UnifakturCook'), 
			array('UnifakturMaguntia', 'UnifakturMaguntia'),
			array('Unkempt', 'Unkempt'), 
			array('VT323', 'VT323'),
			array('Vibur', 'Vibur'), 
			array('Vollkorn','Vollkorn'),
			array('Vollkorn:italic','Vollkorn (italic)'), 
			array('Vollkorn:bold','Vollkorn (bold)'),
			array('Vollkorn:bolditalic','Vollkorn (bold italic)'), 
			array('Walter+Turncoat', 'Walter Turncoat'),
			array('Yanone+Kaffeesatz:extralight','Yanone Kaffeesatz'),
			array('Yanone+Kaffeesatz:extralight','Yanone Kaffeesatz (extralight)'),
			array('Yanone+Kaffeesatz:light','Yanone Kaffeesatz (light)'),
			array('Yanone+Kaffeesatz:bold','Yanone Kaffeesatz (bold)')
        );
		
		foreach ($temp_options as $option) {
    	   $this->_options[] = JHTML::_('select.option', $option[0], JText::_($option[1]));
    	}		
		// Construct the various argument calls that are supported.
        $attribs = ' ';
        if ($v = $node->attributes( 'size' )) $attribs .= 'size="'.$v.'"';
        if ($v = $node->attributes( 'class' )) $attribs .= 'class="'.$v.'"';
        else $attribs .= 'class="inputbox"';
        // Render the HTML SELECT list.
        return JHTML::_('select.genericlist', $this->_options, $ctrl, $attribs, 'value', 'text', $value, $control_name.$name );
	}
}						