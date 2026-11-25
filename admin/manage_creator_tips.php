<?php
require_once "../config/database.php";

/* Delete Tip */
if (isset($_GET['delete'])) {
    $tip_id = (int)$_GET['delete'];

    $sql = "DELETE FROM creator_tips WHERE tip_id = $tip_id";
    mysqli_query($conn, $sql);

    header("Location: manage_creator_tips.php");
    exit();
}

/* Add Tip */
if (isset($_POST['add_tip'])) {

    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $platform = mysqli_real_escape_string($conn, $_POST['platform']);
    $difficulty_level = mysqli_real_escape_string($conn, $_POST['difficulty_level']);
    $source = mysqli_real_escape_string($conn, $_POST['source']);

    $sql = "INSERT INTO creator_tips
            (category, title, description, platform, difficulty_level, source, last_updated)
            VALUES
            ('$category', '$title', '$description', '$platform',
             '$difficulty_level', '$source', CURDATE())";

    mysqli_query($conn, $sql);

    header("Location: manage_creator_tips.php");
    exit();
}

/* Update Tip */
if (isset($_POST['update_tip'])) {

    $tip_id = (int)$_POST['tip_id'];

    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $platform = mysqli_real_escape_string($conn, $_POST['platform']);
    $difficulty_level = mysqli_real_escape_string($conn, $_POST['difficulty_level']);
    $source = mysqli_real_escape_string($conn, $_POST['source']);

    $sql = "UPDATE creator_tips SET
            category = '$category',
            title = '$title',
            description = '$description',
            platform = '$platform',
            difficulty_level = '$difficulty_level',
            source = '$source',
            last_updated = CURDATE()
            WHERE tip_id = $tip_id";

    mysqli_query($conn, $sql);

    header("Location: manage_creator_tips.php");
    exit();
}

/* Get Tip for Editing */
$edit_tip = null;

if (isset($_GET['edit'])) {

    $tip_id = (int)$_GET['edit'];

    $sql = "SELECT * FROM creator_tips WHERE tip_id = $tip_id";
    $result_edit = mysqli_query($conn, $sql);

    if ($result_edit && mysqli_num_rows($result_edit) > 0) {
        $edit_tip = mysqli_fetch_assoc($result_edit);
    }
}

/* Get All Tips */
$sql = "SELECT * FROM creator_tips ORDER BY tip_id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Manage Creator Tips | Cheat Codes of Social Media</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>

        .admin-container {
            width: 90%;
            max-width: 1500px;
            margin: 40px auto;
        }

        .admin-header {
            margin-bottom: 30px;
        }

        .admin-header h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .admin-header p {
            color: #64748b;
        }

        .admin-card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        }

        .admin-card h2 {
            margin-bottom: 20px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 15px;
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
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            box-sizing: border-box;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .btn {
            border: none;
            padding: 11px 18px;
            border-radius: 7px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #7c3aed;
            color: white;
        }

        .btn-edit {
            background: #ede9fe;
            color: #7c3aed;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-cancel {
            background: #e5e7eb;
            color: #374151;
            margin-left: 8px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1100px;
        }

        th {
            background: #f3f0ff;
            color: #5b21b6;
            text-align: left;
            padding: 14px;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        .action-buttons {
            white-space: nowrap;
        }

        .action-buttons a {
            margin-right: 5px;
        }

        .back-button {
            float: right;
            margin-top: -55px;
        }

        @media (max-width: 800px) {

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .back-button {
                float: none;
                margin-top: 10px;
            }
        }

    </style>

</head>

<body>

<header class="navbar">

    <div class="logo">
        Cheat Codes <span>of Social Media</span>
    </div>

    <a href="dashboard.php" class="btn btn-primary">
        Back to Dashboard
    </a>

</header>


<main class="admin-container">

    <div class="admin-header">

        <h1>Manage Creator Tips</h1>

        <p>
            Add, edit and manage content creation tips displayed on the website.
        </p>

    </div>


    <!-- ADD / EDIT FORM -->

    <div class="admin-card">

        <?php if ($edit_tip): ?>

            <h2>Edit Creator Tip</h2>

            <form method="POST">

                <input type="hidden"
                       name="tip_id"
                       value="<?php echo $edit_tip['tip_id']; ?>">

                <div class="form-grid">

                    <div class="form-group">

                        <label>Category</label>

                        <input type="text"
                               name="category"
                               value="<?php echo htmlspecialchars($edit_tip['category']); ?>"
                               required>

                    </div>


                    <div class="form-group">

                        <label>Title</label>

                        <input type="text"
                               name="title"
                               value="<?php echo htmlspecialchars($edit_tip['title']); ?>"
                               required>

                    </div>


                    <div class="form-group full">

                        <label>Description</label>

                        <textarea name="description"
                                  required><?php echo htmlspecialchars($edit_tip['description']); ?></textarea>

                    </div>


                    <div class="form-group">

                        <label>Platform</label>

                        <input type="text"
                               name="platform"
                               value="<?php echo htmlspecialchars($edit_tip['platform']); ?>"
                               required>

                    </div>


                    <div class="form-group">

                        <label>Difficulty Level</label>

                        <select name="difficulty_level" required>

                            <option value="Beginner"
                                <?php if ($edit_tip['difficulty_level'] == 'Beginner') echo 'selected'; ?>>
                                Beginner
                            </option>

                            <option value="Intermediate"
                                <?php if ($edit_tip['difficulty_level'] == 'Intermediate') echo 'selected'; ?>>
                                Intermediate
                            </option>

                            <option value="Advanced"
                                <?php if ($edit_tip['difficulty_level'] == 'Advanced') echo 'selected'; ?>>
                                Advanced
                            </option>

                        </select>

                    </div>


                    <div class="form-group full">

                        <label>Source</label>

                        <input type="text"
                               name="source"
                               value="<?php echo htmlspecialchars($edit_tip['source']); ?>"
                               required>

                    </div>

                </div>


                <button type="submit"
                        name="update_tip"
                        class="btn btn-primary">
                    Update Tip
                </button>

                <a href="manage_creator_tips.php"
                   class="btn btn-cancel">
                    Cancel
                </a>

            </form>


        <?php else: ?>

            <h2>Add New Creator Tip</h2>

            <form method="POST">

                <div class="form-grid">

                    <div class="form-group">

                        <label>Category</label>

                        <input type="text"
                               name="category"
                               placeholder="Example: Content Creation"
                               required>

                    </div>


                    <div class="form-group">

                        <label>Title</label>

                        <input type="text"
                               name="title"
                               placeholder="Example: Create a Strong Hook"
                               required>

                    </div>


                    <div class="form-group full">

                        <label>Description</label>

                        <textarea name="description"
                                  placeholder="Enter tip description"
                                  required></textarea>

                    </div>


                    <div class="form-group">

                        <label>Platform</label>

                        <input type="text"
                               name="platform"
                               placeholder="Instagram, YouTube, TikTok"
                               required>

                    </div>


                    <div class="form-group">

                        <label>Difficulty Level</label>

                        <select name="difficulty_level" required>

                            <option value="Beginner">Beginner</option>

                            <option value="Intermediate">
                                Intermediate
                            </option>

                            <option value="Advanced">
                                Advanced
                            </option>

                        </select>

                    </div>


                    <div class="form-group full">

                        <label>Source</label>

                        <input type="text"
                               name="source"
                               placeholder="Example: Platform Creator Guidelines"
                               required>

                    </div>

                </div>


                <button type="submit"
                        name="add_tip"
                        class="btn btn-primary">
                    + Add Tip
                </button>

            </form>

        <?php endif; ?>

    </div>


    <!-- EXISTING TIPS -->

    <div class="admin-card">

        <h2>Existing Creator Tips</h2>

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Platform</th>
                        <th>Difficulty</th>
                        <th>Source</th>
                        <th>Last Updated</th>
                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                    <?php while ($row = mysqli_fetch_assoc($result)): ?>

                        <tr>

                            <td>
                                <?php echo $row['tip_id']; ?>
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
                                <?php echo htmlspecialchars($row['difficulty_level']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['source']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['last_updated']); ?>
                            </td>

                            <td class="action-buttons">

                                <a href="?edit=<?php echo $row['tip_id']; ?>"
                                   class="btn btn-edit">
                                    Edit
                                </a>

                                <a href="?delete=<?php echo $row['tip_id']; ?>"
                                   class="btn btn-delete"
                                   onclick="return confirm('Are you sure you want to delete this tip?');">
                                    Delete
                                </a>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        </div>

    </div>

</main>

</body>

</html>