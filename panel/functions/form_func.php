<?php

function createForm($array = array())
{


    $out = '<form ';

    if (isset($array['action'])) {
        $out .= ' action="' . $array['action'] . '"';
    }
    if (isset($array['id'])) {
        $out .= ' id="' . $array['id'] . '"';
    }


    if (isset($array['method'])) {
        $out .= ' method="' . $array['method'] . '"';
    }

    $out .= ' >';


    $inputElements = array('text', 'password', 'time', 'url', 'date', 'email', 'number');

    foreach ($array['elements'] as $item) {


        if (isset($item['collabel']) and $item['collabel'] > 0) {
            $colLabel = $item['collabel'];
        } else {
            $colLabel = 3;
        }

        if (isset($item['colinput']) and $item['colinput'] > 0) {
            $colinput = $item['colinput'];
        } else {
            $colinput = 9;
        }

        if($item['type'] != 'hidden'){
        $out .= '<div class="row mb-3">';
        }


        $valuePlaceholder = '';
        if (isset($item['value'])) {
            $valuePlaceholder = 'value = "' . $item['value'] . '"';
        } elseif (isset($item['placeholder'])) {
            $valuePlaceholder = 'placeholder = "' . $item['placeholder'] . '"';
        }

        if (isset($item['required']) and $item['required']) {
            $require = 'required';
        } else {
            $require = '';
        }

        if (isset($item['disabled']) and $item['disabled']) {
            $disabled = 'disabled';
        } else {
            $disabled = '';
        }


        if (in_array($item['type'], $inputElements)) {


            $out .= ' 	<div class="col-lg-' . $colLabel . '">
 						<label for="' . $item['name'] . '" class="form-label">' . $item['label'] . '</label>
 						</div>
						<div class="col-lg-' . $colinput . '">
						<input autocomplete="off" type="' . $item['type'] . '" class="form-control '.($item['class']??'').'" id="' . $item['name'] . '" name="' . $item['name'] . '" ' . $valuePlaceholder . ' ' . $require . ' ' . $disabled . '>
						</div>
						';

        } elseif ($item['type'] == 'hidden') {

            if (isset($item['value'])) {
                $out .= '<input type="' . $item['type'] . '" id="' . $item['name'] . '" name="' . $item['name'] . '" value ="' . $item['value'] . '">
                ';
            }


        } elseif ($item['type'] == 'select') {


            if(isset($item['multiple']) AND $item['multiple']){
                $multiple = ' multiple="multiple" ';
            }else{
                $multiple = '';
            }

            $out .= ' 	<div class="col-lg-' . $colLabel . '">
 						<label for="' . $item['name'] . '" class="form-label">' . $item['label'] . '</label>
 						</div>
						<div class="col-lg-' . $colinput . '">';
            $out .= '<select '.$multiple.' class="form-select mb-3 ' . $item['class'] . '" name="' . $item['name'] . '" id="' . $item['id'] . '" aria-label="Default select example" ' . $disabled . '>';

            if (isset($item['optionValue'])) {
                $optionValueIndex = $item['optionValue'];
            } else {
                $optionValueIndex = 'id';
            }

            if (isset($item['optionText'])) {
                $optionText = $item['optionText'];
            } else {
                $optionText = 'name';
            }
            if (isset($item['emptyOption']) and $item['emptyOption']) {
                $out .= '<option disabled selected value>...</option >';
            }
            foreach ($item['option'] as $option) {



                if(is_array($option)){
                    if (isset($option[$optionValueIndex]) and isset($item['value'])) {
                        if ($option[$optionValueIndex] == $item['value']) {
                            $selected = 'selected';
                        } else {
                            $selected = '';
                        }
                    } else {
                        $selected = '';
                    }
                    $out .= '<option value = "' . $option[$optionValueIndex] . '" ' . $selected . '> ' . $option[$optionText] . ' </option >';

                }else{

                    if (isset($item['value'])) {
                        if ($option == $item['value']) {
                            $selected = 'selected';
                        } else {
                            $selected = '';
                        }
                    } else {
                        $selected = '';
                    }

                    $out .= '<option value = "' . $option . '" ' . $selected . '> ' . $option . ' </option >';

                }


            }

            $out .= '</select>';

            $out .= '</div>
';


        } elseif ($item['type'] == 'file') {


            $out .= ' 	<div class="col-lg-' . $colLabel . '">
 						<label for="' . $item['name'] . '" class="form-label">' . $item['label'] . '</label>
 						</div>
						<div class="col-lg-' . $colinput . '">
						<input type="' . $item['type'] . '" class="form-control" id="' . $item['id'] . '" name="' . $item['name'] . '" ' . $valuePlaceholder . ' ' . $require . ' ' . $disabled . '>
						</div>
						';

        } elseif ($item['type'] == 'textarea') {


            $out .= ' 	<div class="col-lg-' . $colLabel . '">
 						<label for="' . $item['name'] . '" class="form-label">' . $item['label'] . '</label>
 						</div>
						<div class="col-lg-' . $colinput . '">
						   <textarea class="form-control" id="' . $item['id'] . '" name="' . $item['name'] . '" ' . $require . ' ' . $disabled . '>' . $item['value'] . '</textarea>
						</div>
						';

        } elseif ($item['type'] == 'checkbox') {

            if ($item['value'] or $item['value'] == 1) {
                $checked = 'checked';
            } else {
                $checked = '';
            }


            $out .= ' 	<div class="col-lg-' . $colLabel . '">
 						<label for="' . $item['name'] . '" class="form-label">' . $item['label'] . '</label>
 						</div>
						<div class="col-lg-' . $colinput . '">
						<div class="form-check form-switch form-switch-lg" dir="ltr">
						<input type="checkbox" class="form-check-input" id="' . $item['id'] . '" name="' . $item['name'] . '" ' . $checked . '>
						</div>
						</div>
						   
					';

        } elseif ($item['type'] == 'editor') {


            $out .= ' 	<div class="col-lg-' . $colLabel . '">
 						<label for="' . $item['name'] . '" class="form-label">' . $item['label'] . '</label>
 						</div>
						<div class="col-lg-' . $colinput . '">
						<div id="' . $item['id'] . '" class="snow-editor" style="height: 300px;">
                                                    '.$item['value'].'
                                                    </div></div>
					
						   
					';


        } elseif ($item['type'] == 'ckeditor') {
            $out .= '<div id="ckeditorform" style="max-width: 1140px">' . $item['value'] . '</div>';
        } elseif ($item['type'] == 'custom') {
            $out .= $item['value'];

        }

        if($item['type'] != 'hidden') {
            $out .= '</div>';
        }


    }

    $out .= '<input type="hidden" id="token" name="token" value ="' . setFormTokenSession() . '">';

    if (isset($array['buttonIcon'])) {
        $buttonIcon = $array['buttonIcon'];
    } else {
        $buttonIcon = '';
    }

    $out .= '<div class="text-end">
                                                <button name="formSubmitBtn" id="formSubmitBtn" type="submit" class="btn '.($array['btnclass']?$array['btnclass']:'btn-primary').'">' . $array['buttonText'] . '  ' . $buttonIcon . '</button>
                                                
                                            </div>';


    $out .= '</form>';

    return $out;


}

function setFormTokenSession() {

	//session_start();

	$token = md5( time() . rand( 0, 9999999 ) );

	if ( isset( $_SESSION['token'] ) ) {
		array_push( $_SESSION['token'], $token );
	} else {

		$_SESSION['token'] = array();
		array_push( $_SESSION['token'], $token );
	}

	return $token;


}

function checkFormTokenSession( $token ) {

	if ( ! in_array( $token, $_SESSION['token'] ) ) {
		echo json_encode( array( 'operation' => 'none', 'hata' => 'Token Hatalı! ' ) );
		die();
	}

}


function removeFormTokenSession( $token ) {

	$key = array_search( $token, $_SESSION['token'] );
	unset( $_SESSION['token'][ $key ] );


}

function createJSObj( $objName, $array = array() ) {


	echo ' <script>var ' . $objName . ' = ' . json_encode( $array ) . ' </script > ';


}

