<?php

$array_diff_one = array('A'=>'1','Blue','C'=>'8','cat','D'=>'9','S'=>'9');
$array_diff_two = array('Yellow','C'=>'3','D'=>'4');

$array_diff = array_diff($array_diff_one , $array_diff_two);


?>

<pre>
<?php
foreach($array_diff as $array_diff_value){
	    echo $array_diff_value.'<br/>';
}
?>
<?php print_r ($array_diff);?>
</pre>