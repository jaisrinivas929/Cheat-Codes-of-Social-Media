<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once "../config/database.php";

$edit_growth = null;

/* Add Growth Strategy */
if (isset($_POST['add_growth'])) {
    $category = trim($_POST['category']);
    $strategy_name = trim($_POST['strategy_name']);
    $description = trim($_POST['description']);
    $platform = trim($_POST['platform']);
    $difficulty_level = $_POST['difficulty_level'];
    $source = trim($_POST['source']);

    $stmt = $conn->prepare("INSERT INTO growth_strategies 
        (category, strategy_name, description, platform, difficulty_level, source, last_updated)
        VALUES (?, ?, ?, ?, ?, ?, CURDATE())");

    $stmt->bind_param(
        "ssssss",
        $category,
        $strategy_name,
        $description,
        $platform,
        $difficulty_level,
        $source
    );

    $stmt->execute();
    $stmt->close();

    header("Location: manage_growth.php");
    exit;
}

/* Delete Growth Strategy */
if (isset($_GET['delete'])) {
    $growth_id = (int)$_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM growth_strategies WHERE strategy_id = ?");
    $stmt->bind_param("i", $growth_id);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_growth.php");
    exit;
}

/* Load record for editing */
if (isset($_GET['edit'])) {
    $growth_id = (int)$_GET['edit'];

    $stmt = $conn->prepare("SELECT * FROM growth_strategies WHERE strategy_id = ?");
    $stmt->bind_param("i", $growth_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $edit_growth = $result->fetch_assoc();

    $stmt->close();
}

/* Update Growth Strategy */
if (isset($_POST['update_growth'])) {
    $growth_id = (int)$_POST['strategy_id'];
    $category = trim($_POST['category']);
    $strategy_name = trim($_POST['strategy_name']);
    $description = trim($_POST['description']);
    $platform = trim($_POST['platform']);
    $difficulty_level = $_POST['difficulty_level'];
    $source = trim($_POST['source']);

    $stmt = $conn->prepare("UPDATE growth_strategies SET
        category = ?,
        strategy_name = ?,
        description = ?,
        platform = ?,
        difficulty_level = ?,
        source = ?,
        last_updated = CURDATE()
        WHERE strategy_id = ?");

    $stmt->bind_param(
        "ssssssi",
        $category,
        $strategy_name,
        $description,
        $platform,
        $difficulty_level,
        $source,
        $growth_id
    );

    $stmt->execute();
    $stmt->close();

    header("Location: manage_growth.php");
    exit;
}

/* Fetch all strategies */
$result = $conn->query("SELECT * FROM growth_strategies ORDER BY strategy_id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Growth Strategies | Cheat Codes of Social Media</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>
        .admin-container {
            max-width: 1400px;
            margin: 50px auto;
            padding: 0 30px;
        }

        .admin-header {
            margin-bottom: 30px;
        }

        .admin-header h1 {
            margin-bottom: 10px;
        }

        .admin-header p {
            color: #667085;
        }

        .admin-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
            margin-bottom: 30px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #d0d5dd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .btn {
            border: none;
            padding: 11px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
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
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-cancel {
            background: #e5e7eb;
            color: #111827;
            margin-left: 8px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f3f0ff;
            color: #5b21b6;
            text-align: left;
            padding: 15px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        .action-buttons {
            white-space: nowrap;
        }

        .action-buttons a {
            margin-right: 6px;
        }

        .top-bar {
            background: white;
            padding: 20px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .brand {
            font-size: 22px;
            font-weight: 700;
        }

        .brand span {
            color: #7c3aed;
        }

        .back-btn {
            background: #7c3aed;
            color: white;
            padding: 11px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 700px) {
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

<div class="top-bar">
    <div class="brand">
        Cheat Codes <span>of Social Media</span>
    </div>

    <a href="dashboard.php" class="back-btn">
        Back to Dashboard
    </a>
</div>

<div class="admin-container">

    <div class="admin-header">
        <h1>Manage Growth Strategies</h1>
        <p>Add, edit and manage growth strategies displayed on the website.</p>
    </div>

    <div class="admin-card">

        <?php if ($edit_growth): ?>

            <h2>Edit Growth Strategy</h2>

            <form method="POST">

                <input type="hidden" name="strategy_id"
                       value="<?php echo $edit_growth['strategy_id']; ?>">

                <div class="form-grid">

                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" name="category"
                               value="<?php echo htmlspecialchars($edit_growth['category']); ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Strategy Name</label>
                        <input type="text" name="strategy_name"
                               value="<?php echo htmlspecialchars($edit_growth['strategy_name']); ?>"
                               required>
                    </div>

                    <div class="form-group full">
                        <label>Description</label>
                        <textarea name="description" required><?php
                            echo htmlspecialchars($edit_growth['description']);
                        ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Platform</label>
                        <input type="text" name="platform"
                               value="<?php echo htmlspecialchars($edit_growth['platform']); ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Difficulty Level</label>

                        <select name="difficulty_level" required>
                            <option value="Beginner"
                                <?php if ($edit_growth['difficulty_level'] == 'Beginner') echo 'selected'; ?>>
                                Beginner
                            </option>

                            <option value="Intermediate"
                                <?php if ($edit_growth['difficulty_level'] == 'Intermediate') echo 'selected'; ?>>
                                Intermediate
                            </option>

                            <option value="Advanced"
                                <?php if ($edit_growth['difficulty_level'] == 'Advanced') echo 'selected'; ?>>
                                Advanced
                            </option>
                        </select>
                    </div>

                    <div class="form-group full">
                        <label>Source</label>
                        <input type="text" name="source"
                               value="<?php echo htmlspecialchars($edit_growth['source']); ?>"
                               required>
                    </div>

                </div>

                <button type="submit" name="update_growth" class="btn btn-primary">
                    Update Growth Strategy
                </button>

                <a href="manage_growth.php" class="btn btn-cancel">
                    Cancel
                </a>

            </form>

        <?php else: ?>

            <h2>Add New Growth Strategy</h2>

            <form method="POST">

                <div class="form-grid">

                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" name="category"
                               placeholder="Example: Content Strategy"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Strategy Name</label>
                        <input type="text" name="strategy_name"
                               placeholder="Example: Post Consistently"
                               required>
                    </div>

                    <div class="form-group full">
                        <label>Description</label>
                        <textarea name="description"
                                  placeholder="Enter strategy description"
                                  required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Platform</label>
                        <input type="text" name="platform"
                               placeholder="Instagram, YouTube, TikTok"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Difficulty Level</label>

                        <select name="difficulty_level" required>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                    </div>

                    <div class="form-group full">
                        <label>Source</label>
                        <input type="text" name="source"
                               placeholder="Example: Creator Growth Guidelines"
                               required>
                    </div>

                </div>

                <button type="submit" name="add_growth" class="btn btn-primary">
                    + Add Growth Strategy
                </button>

            </form>

        <?php endif; ?>

    </div>


    <div class="admin-card">

        <h2>Existing Growth Strategies</h2>

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Strategy</th>
                        <th>Description</th>
                        <th>Platform</th>
                        <th>Difficulty</th>
                        <th>Source</th>
                        <th>Last Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                <?php while ($row = $result->fetch_assoc()): ?>

                    <tr>

                        <td><?php echo $row['strategy_id']; ?></td>

                        <td><?php echo htmlspecialchars($row['category']); ?></td>

                        <td>
                            <strong>
                                <?php echo htmlspecialchars($row['strategy_name']); ?>
                            </strong>
                        </td>

                        <td><?php echo htmlspecialchars($row['description']); ?></td>

                        <td><?php echo htmlspecialchars($row['platform']); ?></td>

                        <td><?php echo htmlspecialchars($row['difficulty_level']); ?></td>

                        <td><?php echo htmlspecialchars($row['source']); ?></td>

                        <td><?php echo htmlspecialchars($row['last_updated']); ?></td>

                        <td class="action-buttons">

                            <a class="btn btn-edit"
                               href="manage_growth.php?edit=<?php echo $row['strategy_id']; ?>">
                                Edit
                            </a>

                            <a class="btn btn-delete"
                               href="manage_growth.php?delete=<?php echo $row['strategy_id']; ?>"
                               onclick="return confirm('Are you sure you want to delete this strategy?');">
                                Delete
                            </a>

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