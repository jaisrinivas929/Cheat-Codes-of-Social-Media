<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once "../config/database.php";

$edit_monetization = null;

/* Add Monetization Guide */
if (isset($_POST['add_monetization'])) {

    $method_name = trim($_POST['method_name']);
    $description = trim($_POST['description']);
    $requirements = trim($_POST['requirements']);
    $platform = trim($_POST['platform']);
    $source = trim($_POST['source']);

    $stmt = $conn->prepare("
        INSERT INTO monetization_guides
        (method_name, description, requirements, platform, source, last_updated)
        VALUES (?, ?, ?, ?, ?, CURDATE())
    ");

    $stmt->bind_param(
        "sssss",
        $method_name,
        $description,
        $requirements,
        $platform,
        $source
    );

    $stmt->execute();
    $stmt->close();

    header("Location: manage_monetization.php");
    exit;
}


/* Delete Monetization Guide */
if (isset($_GET['delete'])) {

    $guide_id = (int) $_GET['delete'];

    $stmt = $conn->prepare(
        "DELETE FROM monetization_guides WHERE guide_id = ?"
    );

    $stmt->bind_param("i", $guide_id);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_monetization.php");
    exit;
}


/* Get Monetization Guide for Editing */
if (isset($_GET['edit'])) {

    $guide_id = (int) $_GET['edit'];

    $stmt = $conn->prepare(
        "SELECT * FROM monetization_guides WHERE guide_id = ?"
    );

    $stmt->bind_param("i", $guide_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $edit_monetization = $result->fetch_assoc();

    $stmt->close();
}


/* Update Monetization Guide */
if (isset($_POST['update_monetization'])) {

    $guide_id = (int) $_POST['guide_id'];

    $method_name = trim($_POST['method_name']);
    $description = trim($_POST['description']);
    $requirements = trim($_POST['requirements']);
    $platform = trim($_POST['platform']);
    $source = trim($_POST['source']);

    $stmt = $conn->prepare("
        UPDATE monetization_guides
        SET method_name = ?,
            description = ?,
            requirements = ?,
            platform = ?,
            source = ?,
            last_updated = CURDATE()
        WHERE guide_id = ?
    ");

    $stmt->bind_param(
        "sssssi",
        $method_name,
        $description,
        $requirements,
        $platform,
        $source,
        $guide_id
    );

    $stmt->execute();
    $stmt->close();

    header("Location: manage_monetization.php");
    exit;
}


/* Fetch all Monetization Guides */
$result = $conn->query("
    SELECT *
    FROM monetization_guides
    ORDER BY guide_id ASC
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Monetization | Cheat Codes of Social Media</title>

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

        .admin-header h1 {
            margin: 0;
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
        <h2>Cheat Codes <span>of Social Media</span></h2>

        <a href="dashboard.php" class="btn btn-primary">
            Back to Dashboard
        </a>
    </div>
</header>


<div class="admin-container">

    <div class="admin-header">
        <div>
            <h1>Manage Monetization</h1>
            <p>Add, edit and manage monetization methods displayed on the website.</p>
        </div>
    </div>


    <!-- Add / Edit Form -->

    <div class="form-card">

        <?php if ($edit_monetization): ?>

            <h2>Edit Monetization Guide</h2>

            <form method="POST">

                <input
                    type="hidden"
                    name="guide_id"
                    value="<?php echo $edit_monetization['guide_id']; ?>"
                >

                <div class="form-grid">

                    <div class="form-group">
                        <label>Method Name</label>

                        <input
                            type="text"
                            name="method_name"
                            value="<?php echo htmlspecialchars($edit_monetization['method_name']); ?>"
                            required
                        >
                    </div>


                    <div class="form-group">
                        <label>Platform</label>

                        <input
                            type="text"
                            name="platform"
                            value="<?php echo htmlspecialchars($edit_monetization['platform']); ?>"
                            required
                        >
                    </div>


                    <div class="form-group full">
                        <label>Description</label>

                        <textarea
                            name="description"
                            required
                        ><?php echo htmlspecialchars($edit_monetization['description']); ?></textarea>
                    </div>


                    <div class="form-group full">
                        <label>Requirements</label>

                        <textarea
                            name="requirements"
                            required
                        ><?php echo htmlspecialchars($edit_monetization['requirements']); ?></textarea>
                    </div>


                    <div class="form-group full">
                        <label>Source</label>

                        <input
                            type="text"
                            name="source"
                            value="<?php echo htmlspecialchars($edit_monetization['source']); ?>"
                            required
                        >
                    </div>

                </div>

                <button
                    type="submit"
                    name="update_monetization"
                    class="btn btn-primary"
                >
                    Update Monetization
                </button>

                <a
                    href="manage_monetization.php"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

            </form>

        <?php else: ?>

            <h2>Add New Monetization Method</h2>

            <form method="POST">

                <div class="form-grid">

                    <div class="form-group">
                        <label>Method Name</label>

                        <input
                            type="text"
                            name="method_name"
                            placeholder="Example: YouTube Partner Program"
                            required
                        >
                    </div>


                    <div class="form-group">
                        <label>Platform</label>

                        <input
                            type="text"
                            name="platform"
                            placeholder="Example: YouTube"
                            required
                        >
                    </div>


                    <div class="form-group full">
                        <label>Description</label>

                        <textarea
                            name="description"
                            placeholder="Enter monetization method description"
                            required
                        ></textarea>
                    </div>


                    <div class="form-group full">
                        <label>Requirements</label>

                        <textarea
                            name="requirements"
                            placeholder="Enter requirements"
                            required
                        ></textarea>
                    </div>


                    <div class="form-group full">
                        <label>Source</label>

                        <input
                            type="text"
                            name="source"
                            placeholder="Example: YouTube Partner Program guidelines"
                            required
                        >
                    </div>

                </div>

                <button
                    type="submit"
                    name="add_monetization"
                    class="btn btn-primary"
                >
                    + Add Monetization
                </button>

            </form>

        <?php endif; ?>

    </div>


    <!-- Existing Monetization Methods -->

    <div class="table-card">

        <h2>Existing Monetization Methods</h2>

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Method</th>
                        <th>Description</th>
                        <th>Requirements</th>
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
                                <strong>
                                    <?php echo htmlspecialchars($row['method_name']); ?>
                                </strong>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['description']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['requirements']); ?>
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
                                        href="manage_monetization.php?edit=<?php echo $row['guide_id']; ?>"
                                    >
                                        Edit
                                    </a>

                                    <a
                                        class="btn btn-delete"
                                        href="manage_monetization.php?delete=<?php echo $row['guide_id']; ?>"
                                        onclick="return confirm('Are you sure you want to delete this monetization method?');"
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