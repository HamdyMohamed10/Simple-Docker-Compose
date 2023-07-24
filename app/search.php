<?php

// Backend code
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search_term = $_POST['search_term'];

    // Query the database to find articles that match the search term
    $db_host = 'db';
    $db_user = 'my_user';
    $db_password = 'my_password';
    $db_name = 'hamdydb';

    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    $sql = "SELECT * FROM articles WHERE title LIKE '%$search_term%' OR description LIKE '%$search_term%'";
    $result = mysqli_query($conn, $sql);

    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Articles</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }
        .search-box {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 600px;
            padding: 20px;
        }
        .search-box h2 {
            margin-top: 0;
        }
        .search-box label {
            display: block;
            margin-bottom: 5px;
        }
        .search-box input[type="text"] {
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            display: block;
            margin-bottom: 20px;
            padding: 10px;
            width: 80%;
        }
        .search-results input[type="submit"] {
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            padding: 10px 20px;
        }
        .search-results input[type="submit"]:hover {
            background-color: #45a049;
        }
        .search-results {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 80%;
            padding: 20px;
        }
        .search-results table {
            border-collapse: collapse;
            margin-bottom: 20px;
            width: 100%;
        }
        .search-results th,
        .search-results td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .search-results th {
            background-color: #4CAF50;
            color: #fff;
        }
        .search-results tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>

    <div class="search-box">
        <h2>Search Articles</h2>
        <form method="post">
            <label>Search for articles:</label>
            <input type="text" name="search_term">
            <input type="submit" value="Search">
        </form>
    </div>

    <?php if ($result): ?>
        <div class="search-results">
            <h2>Search Results</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo $row['description'] ?></td>
                    </tr>
                <?php endwhile ?>
            </table>
        </div>
    <?php endif ?>

</body>
</html>
