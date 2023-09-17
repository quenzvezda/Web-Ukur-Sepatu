<?php
include "konek.php";

// Perform a SELECT query to fetch the data
$query = "SELECT * FROM buffer ORDER BY id DESC LIMIT 25";
$result = $mysqli->query($query);

// Check if the query was successful
if ($result) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="cssfix.css">
        <title>Data Display</title>
        <style>
            h1 {
                color: white;
            }

            th, td {
                text-align: left;
                padding: 8px;
                border-bottom: 1px solid #ddd;
            }

            th {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <h1 color="white">Data Display</h1>

        <table class="table table-stripped table-dark">
            <tr>
                <th>ID</th>
                <th>Width</th>
                <th>Length</th>
            </tr>
            <?php
            // Loop through the rows of the result set and output the data
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['lebar']; ?></td>
                    <td><?php echo $row['panjang']; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
    </html>
    <?php
} else {
    echo "Error: " . $mysqli->error;
}

// Close the database connection
$mysqli->close();
?>
