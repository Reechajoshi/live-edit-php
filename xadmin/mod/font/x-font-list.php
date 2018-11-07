<?php
	echo( '<link href="'.ASITEURL.'/mod/font/select2.css" rel="stylesheet"/>' );
	echo( '<script src="'.ASITEURL.'/mod/font/select2.min.js"></script>' );
	$_MAIN_FONTS = array( "Tahoma" => "Tahoma", "Bauhaus 93" => "Bauhaus 93", "Times New Roman" => "Times New Roman", "Georgia" => "Georgia", "Arial" => "Arial" );
	
	if( isset( $_POST[ 'fonts' ] ) )
	{
		$_q = "delete from fonts;";
		
		if( $DB->dbQuery( $_q ) )
		{
			foreach( $_POST[ 'fonts' ] as $ff )
			{
				$_v[] = "( '$ff' )";
			}			
			
			$_q = "insert into fonts values ".implode( ', ', $_v );
				
			if( $DB->dbQuery( $_q ) )
				echo( "Fonts Changed Successfully." );
			else
				echo( "Sorry, unable to change fonts!" );
		}	
	}
	
	$_q = "select f from fonts";
	$DB->dbRows( $_q );
	
	echo( '<form method="POST" action="?" >
	<div>Specify Font Family:</div>
	<br/>
	
	' );
	
	if( count( $_MAIN_FONTS ) > 0 )
	{
		echo( '<select id="multi1" name="fonts[]" multiple style="width: 600px;" >' );
			
		$sub = $DB->rows;				
		$str = '';
		foreach($sub as $d) {
			echo( "<option value='".$d[ 'f' ]."' SELECTED >".$d[ 'f' ]."</option>" );
			$str[] = $d[ 'f' ];
		}
		
		$_str = implode( ",", $str );
		
		foreach( $_MAIN_FONTS as $v )
		{
			if( strpos( $_str, $v ) === false )
				echo( "<option value='$v' >$v</option>" );
		}
		echo( '</select>' );
		echo( '<input type="submit" value="save" />' );
	}
	else
		echo( 'Contact Administrator as no fonts available in configuration.' );
?>	
	
	
</form>

<script>
	$(document).ready(function() { 
		$("#multi1").select2();
	});
</script>