<?php
require_once "../../config/connection.php";

// Success / error messages
$code = $_GET['code'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Contacts</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7f8;
            margin: 0;
            padding: 20px;
        }

        nav {
            background-color: #007BFF;
            padding: 15px 30px;
            border-radius: 10px;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        nav ul li a:hover {
            background-color: #0056b3;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #007BFF;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #e6f2ff;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9em;
            transition: 0.3s;
        }

        .btn-edit {
            background-color: #28a745;
            color: #fff;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .message {
            margin-top: 15px;
            font-weight: 500;
            color: green;
        }

        .error {
            color: red;
        }
    </style>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this contact?")) {
                window.location.href = `delete-contact.php?id=${id}`;
            }
        }
    </script>
</head>

<body>
    <nav>
        <ul>
            <li><a href="list-contact.php"><i class="fas fa-list"></i> List Contact</a></li>
            <li><a href="create-contact.php"><i class="fas fa-plus-circle"></i> Add Contact</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>List of Contacts</h2>

        <?php
        if ($code == 1)
            echo '<div class="message">Successfully deleted!</div>';
        if ($code == 2)
            echo '<div class="error">Failed to delete contact.</div>';
        ?>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select = $db->prepare('SELECT * FROM contacts');
                $select->execute();
                $rows = $select->fetchAll(PDO::FETCH_OBJ);
                $n = 1;
                foreach ($rows as $contact) {
                    echo "<tr>
                        <td>$n</td>
                        <td>$contact->full_name</td>
                        <td>$contact->phone</td>
                        <td>$contact->email</td>
                        <td>$contact->address</td>
                        <td>
                            <a class='btn btn-edit' href='edit-contact.php?id=$contact->id'><i class='fas fa-edit'></i></a>
                            <button class='btn btn-delete' onclick='confirmDelete($contact->id)'><i class='fas fa-trash'></i></button>
                        </td>
                    </tr>";
                    $n++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>