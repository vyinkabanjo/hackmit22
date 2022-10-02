<?php

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

//function to find if $val matches the first value in a line of the csv file
$input = fopen('box_status.csv', 'r');  //open for reading
$output = fopen('temporary.csv', 'w'); //open for writing
while( false !== ( $data = fgetcsv($input) ) ){  //read each line as an array

    //modify data here
    debug_to_console($data[0]);
    debug_to_console($_POST['box_id_field']);
    debug_to_console($data[1]);
    debug_to_console("entering loop");
    if ($data[0] ==  $_POST['box_id_field']) {
        //Replace line here
        if ($data[1] == 'TRUE'){
            $data[1] = 'FALSE';
        }
        else{
            $data[1] = 'TRUE';
        }
        debug_to_console("replacing line");
        debug_to_console($data);
        echo("SUCCESS|Box Status changed!");
}

//write modified data to new file
fputcsv( $output, $data);
}

//close both files
fclose( $input );
fclose( $output );


//TODO at this point we should also generate the stats file for the chart page - shoud be "freshman""sophomore"jr""sr""d1""d2"..."d7" with a value under for each

//clean up
unlink('box_status.csv');// Delete obsolete BD
debug_to_console("Deleted old file");
rename('temporary.csv', 'box_status.csv'); //Rename temporary to new
?>
<p>Updating box status...</p>