<!DOCTYPE html>
<html lang="fr">

<head>

    <!-- Paramètres généraux
        ───────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────── -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="content-language" content="fr"/>
    <meta name="author" content="CORLER Damien"/>

    <!-- Paramètres spécifiques
        ───────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────── -->
    <title>Exercice 1</title>
    <meta name="description" content="Module WEBO"/>

    <style>
        table {
            border-spacing: 0;
        }
        tr {
            border-collapse: collapse;
        }
        td {
            border: 1px solid black;
            padding: 5px;
            font-size: 12px;
            font-family: "Calibri Light", serif;
        }
    </style>

</head>

<body>
    <table>

    <?php // Boucle 1
        $colors_hex_available = ['00', '33', '66', '99', 'CC', 'FF'];
        foreach ($colors_hex_available as $key => $data):
    ?>

        <?php // Boucle 2
            foreach ($colors_hex_available as $key2 => $data_2):
        ?>

        <tr>

            <?php // Boucle 3
                foreach ($colors_hex_available as $key3 => $data_3):
            ?>

                <td style="color: <?= white_text($data, $data_2, $data_3);?>; background-color: <?= '#'.$data.$data_2.$data_3;?>">

                    <!-- Version 1 -->
                    <?= '#'.$data.$data_2.$data_3;?>

                    <!-- Version 2 -->
                    <?= hexa($key).hexa($key2).hexa($key3);?>

                </td>

            <?php // Fin boucle 3
                endforeach;
            ?>

        </tr>

        <?php // Fin boucle 2
            endforeach;
        ?>

    <?php // Fin boucle 1
        endforeach;
    ?>

    <?php
        // Déterminer la couleur du texte par rapport à la luminosité du paramètre "background-color"
        function white_text($data, $data1, $data2) {
            if ((hexdec($data)*0.299 + hexdec($data1)*0.587 + hexdec($data2)*0.114) > 128) {
                return '#000000';
            } else {
                return '#FFFFFF';
            }
        }

        // Alternative
        function hexa($sr) {
            return sprintf( "%02s", dechex($sr * 0x33));
        }

    ?>

    </table>
</body>

</html>