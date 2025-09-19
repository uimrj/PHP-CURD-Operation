<?php
require_once "../../config/connection.php";
$id = $_GET['id'];
$select = $db->prepare('SELECT * FROM contacts WHERE id=:id');
$select->execute(['id' => $id]);
$row = $select->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <title>Edit Contact</title>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7f8;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #007BFF;
            padding: 15px 30px;
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

        form {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        fieldset {
            border: none;
            padding: 0;
        }

        legend {
            font-size: 1.8em;
            font-weight: 700;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1em;
            transition: 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #007BFF;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .form-group textarea {
            resize: vertical;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            font-size: 1em;
            font-weight: 600;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #0056b3;
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
</head>

<body>
    <nav>
        <ul>
            <li><a href="list-contact.php"><i class="fas fa-list"></i> List Contact</a></li>
            <li><a href="create-contact.php"><i class="fas fa-plus-circle"></i> Add Contact</a></li>
        </ul>
    </nav>

    <form action="update-contact.php" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <fieldset>
            <legend>Edit Contact Form</legend>

            <div class="form-group">
                <label>Full Name <b class="red">*</b></label>
                <input type="text" name="full_name" placeholder="Full Name" value="<?= $row->full_name ?>">
            </div>

            <div class="form-group">
                <label>Nickname</label>
                <input type="text" name="nickname" placeholder="Nickname" value="<?= $row->nickname ?>">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="example@domain.com" value="<?= $row->email ?>">
            </div>

            <div class="form-group">
                <label>Phone <b class="red">*</b></label>
                <input type="tel" name="phone" placeholder="+964(0) 000 000 00 00" value="<?= $row->phone ?>">
            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea name="address" cols="30" rows="3"
                    placeholder="Street, City, Country"><?= $row->address ?></textarea>
            </div>

            <div class="form-group">
                <label>Contact Types</label>
                <select name="type_id">
                    <option value="">Select Contact Type</option>
                    <option value="1" <?= $row->contact_type_id == 1 ? 'selected' : '' ?>>Friend</option>
                    <option value="2" <?= $row->contact_type_id == 2 ? 'selected' : '' ?>>Business</option>
                </select>
            </div>

            <div>
                <button><i class="fas fa-save"></i> Save Changes</button>
            </div>

            <?php
            if (isset($_GET['code'])) {
                echo '<div class="message">';
                if ($_GET['code'] == 1) {
                    echo "Contact updated successfully!";
                }
                if ($_GET['code'] == 2) {
                    echo "<span class='error'>Failed to update contact.</span>";
                }
                echo '</div>';
            }
            ?>
        </fieldset>
    </form>

</body>

</html>