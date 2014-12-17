<?php
/**
 * Created by PhpStorm.
 * User: yenphan93
 * Date: 12/12/14
 * Time: 5:39 AM
 */

//define('CSV_PATH','./');
//get file csv
define('CSV_PATH','./');
$csv_file = CSV_PATH . "product09.csv";
$csvfile = fopen($csv_file, 'r');
$theData = fgets($csvfile);

$title_array = explode(",", $theData);
for ( $i = 0; $i < sizeof($title_array);  ++$i)
{
    if (substr($title_array[$i],0,7) == "option_")
    {
        $insert_opt = "Insert into  option (name ) values (".$title_array[$i].")";
        echo $insert_opt;
        echo "<br/>";
    }
}
//read file csv
//insert table option

$i = 0;
while (!feof($csvfile)) {
    $csv_data[] = fgets($csvfile, 1024);
    $csv_array = explode(",", $csv_data[$i]);

    if(count($csv_array) == 13)
    {
        $insert_csv = array();

        $insert_csv['id'] = $csv_array[0];
        $insert_csv['name'] = $csv_array[1];
        $insert_csv['slug'] = $csv_array[2];
        $insert_csv['short_description'] = $csv_array[3];
        $insert_csv['description'] = $csv_array[4];

        $date = strtotime($csv_array[5]);
        $insert_csv['available_on'] = date('Y-m-d H:i:s', $date);

        $date = strtotime($csv_array[6]);
        $insert_csv['created_at'] = date('Y-m-d H:i:s', $date);

        $date = strtotime($csv_array[7]);
        $insert_csv['updated_at'] = date('Y-m-d H:i:s', $date);

        $date = strtotime($csv_array[8]);
        $insert_csv['deleted_at'] = date('Y-m-d H:i:s', $date);

        $insert_csv['variant_selection_method'] = $csv_array[9];

        //insert product
        $query = "INSERT INTO products (id,name,slug,short_description,description,available_on,created_at,updated_at,deleted_at,variant_selection_method)
VALUES"."('".$insert_csv['id']."','".$insert_csv['name']."','".$insert_csv['slug']."',
    '".$insert_csv['short_description']."', '".$insert_csv['description']."', '".$insert_csv['available_on']."',
    '".$insert_csv['created_at']."', '".$insert_csv['updated_at']."','".$insert_csv['deleted_at']."',
    '".$insert_csv['variant_selection_method']."'),";
        echo $query; echo "<br/>";

        //insert option color
        $insert_csv['option_color'] = $csv_array[10];
        $array_color = explode(";", $insert_csv['option_color']);
        $m = 0;
        while ($m < sizeof($array_color))
        {
            //insert table option_value
            $query_color = "INSERT INTO option_value (option_id, value) VALUES ( 1, ". $array_color[$m].")";
            echo $query_color; echo "<br/>";
            //insert product_option_value
            $query_product_color = "INSERT INTO product_option_value ()";
            ++$m;
        }
        $insert_csv['option_size'] = $csv_array[11];
        $array_size = explode(";", $insert_csv['option_size']);
        $n = 0;
        while ($n < sizeof($array_size))
        {
            //insert table option_value
            $query_size = "INSERT INTO option_value (option_id, value) VALUES ( 2, ". $array_size[$n].")";
            echo $query_size; echo "<br/>";
            //insert table product_option_value
                // SELECT MAX(id) FROM option_value
                // insert dl vao.
            ++$n;
        }
        //insert category
        $insert_csv['option_color'] = $csv_array[11];
        $array_category = explode(";", $insert_csv['option_color']);
        $c = 0;
        while ($c < sizeof($array_category))
        {
            //insert table category
            $query_catergory = "INSERT INTO category (name) VALUES (".$array_category[$c].")";
            echo $query_catergory; echo "<br/>";
            //insert table product_category

            ++$c;
        }
    }
    $i++;
}
fclose($csvfile);


