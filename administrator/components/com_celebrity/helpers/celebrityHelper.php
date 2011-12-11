<?php
class celebrityHelper{
function celebrityConvDateFromItToEn($date) {
        $separa=explode ("-",$date);
        $a=$separa[0];
        $b=$separa[1];
        $c=$separa[2];
        $data_convertita="$c-$b-$a";

        return $data_convertita;
    }
function celebrityTRIM($stringa)
{
    $ret = $stringa;
    $ret = str_replace(array("'"), "\'", $ret);
    $ret = str_replace(array("\r","\n"), " ", $ret);
    $ret = str_replace(array('"'), "\'", $ret);
    return $ret;
}
function celebrityGetImagesThumbsPath()
{
	return JURI::root().'images'.DS.'celebrity'.DS.'thumb'.DS;
}

function celebrityGetImagesLargePath()
{
        return JURI::root().'images'.DS.'celebrity'.DS.'big'.DS;
}

function celebrityGetPathImagesThumbsPath()
{
        return JPATH_ROOT.DS.'images'.DS.'celebrity'.DS.'thumb'.DS;
}

function celebrityGetPathImagesLargePath()
{
	return JPATH_ROOT.DS.'images'.DS.'celebrity'.DS.'big'.DS;
}

function getRanString($length)
{
		$string = "";
		// genera una stringa casuale che ha lunghezza
		// uguale al multiplo di 32 successivo a $length
		for ($i = 0; $i <= ($length/32); $i++){
			$string .= md5(time()+rand(0,99));
			// indice di partenza limite
			$max_start_index = (32*$i)-$length;
			// seleziona la stringa, utilizzando come indice iniziale
			// un valore tra 0 e $max_start_point
			$random_string = substr($string, rand(0, $max_start_index), $length);
		}
		return $random_string;
}

	function quickIconButton( $link, $image, $text ) {

		$lang	= &JFactory::getLanguage();
		$button = '';
		if ($lang->isRTL()) {
			$button .= '<div style="float:right;">';
		} else {
			$button .= '<div style="float:left;">';
		}
		$button .=	'<div class="icon">'
				   .'<a href="'.$link.'">'
				   .JHTML::_('image.site',  $image, '/components/com_celebrity/assets/images/', NULL, NULL, $text )
				   .'<span>'.$text.'</span></a>'
				   .'</div>';
		$button .= '</div>';

   	return $button;
	}

}

