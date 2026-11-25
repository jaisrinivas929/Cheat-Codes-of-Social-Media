<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once "../config/database.php";

$edit_safety = null;

/* Add Safety Guide */
if (isset($_POST['add_safety'])) {

    $category = trim($_POST['category']);
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $platform = trim($_POST['platform']);
    $source = trim($_POST['source']);

    $stmt = $conn->prepare("
        INSERT INTO safety_guides
        (category, title, description, platform, source, last_updated)
        VALUES (?, ?, ?, ?, ?, CURDATE())
    ");

    $stmt->bind_param(
        "sssss",
        $category,
        $title,
        $description,
        $platform,
        $source
    );

    $stmt->execute();
    $stmt->close();

    header("Location: manage_safety.php");
    exit;
}


/* Delete Safety Guide */
if (isset($_GET['delete'])) {

    $guide_id = (int) $_GET['delete'];

    $stmt = $conn->prepare(
        "DELETE FROM safety_guides WHERE guide_id = ?"
    );

    $stmt->bind_param("i", $guide_id);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_safety.php");
    exit;
}


/* Get Safety Guide for Editing */
if (isset($_GET['edit'])) {

    $guide_id = (int) $_GET['edit'];

    $stmt = $conn->prepare(
        "SELECT * FROM safety_guides WHERE guide_id = ?"
    );

    $stmt->bind_param("i", $guide_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $edit_safety = $result->fetch_assoc();

    $stmt->close();
}


/* Update Safety Guide */
if (isset($_POST['update_safety'])) {

    $guide_id = (int) $_POST['guide_id'];

    $category = trim($_POST['category']);
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $platform = trim($_POST['platform']);
    $source = trim($_POST['source']);

    $stmt = $conn->prepare("
        UPDATE safety_guides
        SET category = ?,
            title = ?,
            description = ?,
            platform = ?,
            source = ?,
            last_updated = CURDATE()
        WHERE guide_id = ?
    ");

    $stmt->bind_param(
        "sssssi",
        $category,
        $title,
        $description,
        $platform,
        $source,
        $guide_id
    );

    $stmt->execute();
    $stmt->close();

    header("Location: manage_safety.php");
    exit;
}


/* Fetch all Safety Guides */
$result = $conn->query("
    SELECT *
    FROM safety_guides
    ORDER BY guide_id ASC
");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Safety Guides | Cheat Codes of Social Media</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>

        .admin-container {
            width: 90%;
            max-width: 1500px;
            margin: 40px auto;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .form-card,
        .table-card {
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.06);
            margin-bottom: 30px;
        }

        .form-card h2,
        .table-card h2 {
            margin-top: 0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d5d9e2;
            border-radius: 7px;
            box-sizing: border-box;
            font-size: 15px;
        }

        .form-group textarea {
            min-height: 110px;
            resize: vertical;
        }

        .btn {
            display: inline-block;
            padding: 11px 18px;
            border: none;
            border-radius: 7px;
            text-decoration: none;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-primary {
            background: #7c3aed;
            color: white;
        }

        .btn-edit {
            background: #eee7ff;
            color: #6d28d9;
        }

        .btn-delete {
            background: #ffe1e1;
            color: #dc2626;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #111827;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f1edff;
            color: #5b21b6;
            text-align: left;
            padding: 15px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        @media (max-width: 800px) {

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

        }

    </style>

</head>

<body>

<header>

    <div class="container">

        <h2>
            Cheat Codes <span>of Social Media</span>
        </h2>

        <a href="dashboard.php" class="btn btn-primary">
            Back to Dashboard
        </a>

    </div>

</header>


<div class="admin-container">

    <div class="admin-header">

        <div>

            <h1>Manage Safety Guides</h1>

            <p>
                Add, edit and manage safety guides displayed on the website.
            </p>

        </div>

    </div>


    <!-- Add / Edit Form -->

    <div class="form-card">

        <?php if ($edit_safety): ?>

            <h2>Edit Safety Guide</h2>

            <form method="POST">

                <input
                    type="hidden"
                    name="guide_id"
                    value="<?php echo $edit_safety['guide_id']; ?>"
                >

                <div class="form-grid">

                    <div class="form-group">

                        <label>Category</label>

                        <input
                            type="text"
                            name="category"
                            value="<?php echo htmlspecialchars($edit_safety['category']); ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>Title</label>

                        <input
                            type="text"
                            name="title"
                            value="<?php echo htmlspecialchars($edit_safety['title']); ?>"
                            required
                        >

                    </div>


                    <div class="form-group full">

                        <label>Description</label>

                        <textarea
                            name="description"
                            required
                        ><?php echo htmlspecialchars($edit_safety['description']); ?></textarea>

                    </div>


                    <div class="form-group">

                        <label>Platform</label>

                        <input
                            type="text"
                            name="platform"
                            value="<?php echo htmlspecialchars($edit_safety['platform']); ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>Source</label>

                        <input
                            type="text"
                            name="source"
                            value="<?php echo htmlspecialchars($edit_safety['source']); ?>"
                            required
                        >

                    </div>

                </div>


                <button
                    type="submit"
                    name="update_safety"
                    class="btn btn-primary"
                >
                    Update Safety Guide
                </button>


                <a
                    href="manage_safety.php"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

            </form>


        <?php else: ?>


            <h2>Add New Safety Guide</h2>

            <form method="POST">

                <div class="form-grid">

                    <div class="form-group">

                        <label>Category</label>

                        <input
                            type="text"
                            name="category"
                            placeholder="Example: Account Security"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>Title</label>

                        <input
                            type="text"
                            name="title"
                            placeholder="Example: Use a Strong Password"
                            required
                        >

                    </div>


                    <div class="form-group full">

                        <label>Description</label>

                        <textarea
                            name="description"
                            placeholder="Enter safety guide description"
                            required
                        ></textarea>

                    </div>


                    <div class="form-group">

                        <label>Platform</label>

                        <input
                            type="text"
                            name="platform"
                            placeholder="Example: All Platforms"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>Source</label>

                        <input
                            type="text"
                            name="source"
                            placeholder="Example: General social media safety guidelines"
                            required
                        >

                    </div>

                </div>


                <button
                    type="submit"
                    name="add_safety"
                    class="btn btn-primary"
                >
                    + Add Safety Guide
                </button>

            </form>

        <?php endif; ?>

    </div>


    <!-- Existing Safety Guides -->

    <div class="table-card">

        <h2>Existing Safety Guides</h2>

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Platform</th>
                        <th>Source</th>
                        <th>Last Updated</th>
                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                    <?php while ($row = $result->fetch_assoc()): ?>

                        <tr>

                            <td>
                                <?php echo $row['guide_id']; ?>
                            </td>


                            <td>
                                <?php echo htmlspecialchars($row['category']); ?>
                            </td>


                            <td>

                                <strong>
                                    <?php echo htmlspecialchars($row['title']); ?>
                                </strong>

                            </td>


                            <td>
                                <?php echo htmlspecialchars($row['description']); ?>
                            </td>


                            <td>
                                <?php echo htmlspecialchars($row['platform']); ?>
                            </td>


                            <td>
                                <?php echo htmlspecialchars($row['source']); ?>
                            </td>


                            <td>
                                <?php echo htmlspecialchars($row['last_updated']); ?>
                            </td>


                            <td>

                                <div class="action-buttons">

                                    <a
                                        class="btn btn-edit"
                                        href="manage_safety.php?edit=<?php echo $row['guide_id']; ?>"
                                    >
                                        Edit
                                    </a>


                                    <a
                                        class="btn btn-delete"
                                        href="manage_safety.php?delete=<?php echo $row['guide_id']; ?>"
                                        onclick="return confirm('Are you sure you want to delete this safety guide?');"
                                    >
                                        Delete
                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>

</html>