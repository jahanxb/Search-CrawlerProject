<?php


$action = $_GET["action"];
$query = $_GET["q"];

if ($action == "search") {
    $string = file_get_contents("BookDatasetLarge.json");
    $data = json_decode($string);
    $matchingBooks = array();

    foreach ($data as $book) {
        if (isset($book->Author)) {
            if (wild_compare('*' . $query . '*', $book->Author)) {
                    $matchingBooks[] = $book;
            }
        }
        if (isset($book->Category)) {
            if (wild_compare('*' . $query . '*', $book->Category)) {
                $matchingBooks[] = $book;
            }
        }
        if (isset($book->Subject)) {
            if (wild_compare('*' . $query . '*', $book->Subject)) {
                $matchingBooks[] = $book;
            }
        }
        if (isset($book->Title)) {
            if (wild_compare('*' . $query . '*', $book->Title)) {
                $matchingBooks[] = $book;
            }
        }
        

    }


    $matchingBooks = json_decode(json_encode($matchingBooks), true);
    usort($matchingBooks, function (array $a, array $b) { return $a["EBook-No."] - $b["EBook-No."]; });

//    print_r($matchingBooks);

    echo json_encode($matchingBooks);
}


function wild_compare($wild, $string)
{
    $wild = strtolower($wild);
    $string = strtolower($string);

    $wild_i = 0;
    $string_i = 0;

    $wild_len = strlen($wild);
    $string_len = strlen($string);

    while ($string_i < $string_len && $wild[$wild_i] != '*') {
        if (($wild[$wild_i] != $string[$string_i]) && ($wild[$wild_i] != '?')) {
            return 0;
        }
        $wild_i++;
        $string_i++;
    }

    $mp = 0;
    $cp = 0;

    while ($string_i < $string_len) {
        if ($wild[$wild_i] == '*') {
            if (++$wild_i == $wild_len) {
                return 1;
            }
            $mp = $wild_i;
            $cp = $string_i + 1;
        } else
            if (($wild[$wild_i] == $string[$string_i]) || ($wild[$wild_i] == '?')) {
                $wild_i++;
                $string_i++;
            } else {
                $wild_i = $mp;
                $string_i = $cp++;
            }
    }



    try {
        while ($wild[$wild_i] == '*') {
            $wild_i++;

            if($wild_i>(strlen($wild)-1)){
                break;
            }

        }

    } catch (OutOfBoundsException $e) {

    }

    return $wild_i == $wild_len ? 1 : 0;
}

