<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>

<body>

    <?php
    phpinfo();

    function get_db()
    {
        $mongo = new MongoDB\Client(
            "mongodb://localhost:27017/wai"
            ,
            [
                'username' => 'wai_web'
                ,
                'password' => 'w@i_w3b',
            ]
        );
        $db = $mongo->wai;
        return $db;
    }

    $db = get_db();
    //dokument opisujący produkt w sklepie:
    $product = [
        'name' => 'Laptop XYZ',
        'price' => 2999,
        'manufacturer' => 'ABC',
        'description' => 'Ładny laptop.'
    ];
    //zapis do kolekcji products:
    $db->products->insertOne($product);


    ?>

</body>

</html>