<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

require_once "../config/database.php";

/* DELETE FAQ */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $stmt = $conn->prepare("DELETE FROM faqs WHERE faq_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: manage_faqs.php");
    exit();
}

/* ADD FAQ */
if (isset($_POST['add_faq'])) {
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $category = $_POST['category'];
    $source = $_POST['source'];
    $last_updated = $_POST['last_updated'];

    $stmt = $conn->prepare(
        "INSERT INTO faqs (question, answer, category, source, last_updated)
         VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "sssss",
        $question,
        $answer,
        $category,
        $source,
        $last_updated
    );

    $stmt->execute();

    header("Location: manage_faqs.php");
    exit();
}

/* UPDATE FAQ */
if (isset($_POST['update_faq'])) {
    $id = intval($_POST['faq_id']);

    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $category = $_POST['category'];
    $source = $_POST['source'];
    $last_updated = $_POST['last_updated'];

    $stmt = $conn->prepare(
        "UPDATE faqs
         SET question = ?, answer = ?, category = ?, source = ?, last_updated = ?
         WHERE faq_id = ?"
    );

    $stmt->bind_param(
        "sssssi",
        $question,
        $answer,
        $category,
        $source,
        $last_updated,
        $id
    );

    $stmt->execute();

    header("Location: manage_faqs.php");
    exit();
}

/* EDIT MODE */
$edit_faq = null;

if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);

    $stmt = $conn->prepare("SELECT * FROM faqs WHERE faq_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $edit_faq = $result->fetch_assoc();
}

/* GET ALL FAQs */
$result = $conn->query("SELECT * FROM faqs ORDER BY faq_id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage FAQs - Cheat Codes of Social Media</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        h1 {
            color: #333;
        }

        .form-box {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 100px;
        }

        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .cancel {
            background: #777;
            text-decoration: none;
            color: white;
            padding: 10px 18px;
            border-radius: 5px;
            margin-left: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #007bff;
            color: white;
        }

        .edit {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
        }

        .delete {
            color: red;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Manage FAQs</h1>

    <!-- ADD / EDIT FORM -->
    <div class="form-box">

        <?php if ($edit_faq): ?>

            <h2>Edit FAQ</h2>

            <form method="POST">

                <input type="hidden" name="faq_id"
                       value="<?php echo $edit_faq['faq_id']; ?>">

                <label>Question</label>
                <input type="text" name="question"
                       value="<?php echo htmlspecialchars($edit_faq['question']); ?>"
                       required>

                <label>Answer</label>
                <textarea name="answer" required><?php
                    echo htmlspecialchars($edit_faq['answer']);
                ?></textarea>

                <label>Category</label>
                <input type="text" name="category"
                       value="<?php echo htmlspecialchars($edit_faq['category']); ?>"
                       required>

                <label>Source</label>
                <input type="text" name="source"
                       value="<?php echo htmlspecialchars($edit_faq['source']); ?>"
                       required>

                <label>Last Updated</label>
                <input type="date" name="last_updated"
                       value="<?php echo $edit_faq['last_updated']; ?>"
                       required>

                <button type="submit" name="update_faq">
                    Update FAQ
                </button>

                <a href="manage_faqs.php" class="cancel">
                    Cancel
                </a>

            </form>

        <?php else: ?>

            <h2>Add New FAQ</h2>

            <form method="POST">

                <label>Question</label>
                <input type="text" name="question" required>

                <label>Answer</label>
                <textarea name="answer" required></textarea>

                <label>Category</label>
                <input type="text" name="category" required>

                <label>Source</label>
                <input type="text" name="source" required>

                <label>Last Updated</label>
                <input type="date" name="last_updated" required>

                <button type="submit" name="add_faq">
                    Add FAQ
                </button>

            </form>

        <?php endif; ?>

    </div>

    <!-- FAQ LIST -->
    <h2>Existing FAQs</h2>

    <table>

        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Category</th>
            <th>Source</th>
            <th>Last Updated</th>
            <th>Action</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>

        <tr>
            <td><?php echo $row['faq_id']; ?></td>

            <td><?php echo htmlspecialchars($row['question']); ?></td>

            <td><?php echo htmlspecialchars($row['answer']); ?></td>

            <td><?php echo htmlspecialchars($row['category']); ?></td>

            <td><?php echo htmlspecialchars($row['source']); ?></td>

            <td><?php echo $row['last_updated']; ?></td>

            <td>
                <a class="edit"
                   href="manage_faqs.php?edit=<?php echo $row['faq_id']; ?>">
                    Edit
                </a>

                <a class="delete"
                   href="manage_faqs.php?delete=<?php echo $row['faq_id']; ?>"
                   onclick="return confirm('Are you sure you want to delete this FAQ?');">
                    Delete
                </a>
            </td>
        </tr>

        <?php endwhile; ?>

    </table>

</div>

</body>
</html>