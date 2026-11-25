<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

require_once "../config/database.php";


/* =========================
   UPDATE PLATFORM
========================= */

if (isset($_POST['update_platform'])) {

    $platform_id = $_POST['platform_id'];
    $platform_name = $_POST['platform_name'];
    $description = $_POST['description'];
    $content_types = $_POST['content_types'];
    $target_audience = $_POST['target_audience'];
    $key_features = $_POST['key_features'];
    $source = $_POST['source'];
    $last_updated = date('Y-m-d');

    $sql = "UPDATE platforms SET
            platform_name = ?,
            description = ?,
            content_types = ?,
            target_audience = ?,
            key_features = ?,
            source = ?,
            last_updated = ?
            WHERE platform_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssssssi",
        $platform_name,
        $description,
        $content_types,
        $target_audience,
        $key_features,
        $source,
        $last_updated,
        $platform_id
    );

    mysqli_stmt_execute($stmt);

    header("Location: manage_platforms.php");
    exit();
}


/* =========================
   ADD PLATFORM
========================= */

if (isset($_POST['add_platform'])) {

    $platform_name = $_POST['platform_name'];
    $description = $_POST['description'];
    $content_types = $_POST['content_types'];
    $target_audience = $_POST['target_audience'];
    $key_features = $_POST['key_features'];
    $source = $_POST['source'];
    $last_updated = date('Y-m-d');

    $sql = "INSERT INTO platforms
            (platform_name, description, content_types, target_audience, key_features, source, last_updated)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssssss",
        $platform_name,
        $description,
        $content_types,
        $target_audience,
        $key_features,
        $source,
        $last_updated
    );

    mysqli_stmt_execute($stmt);

    header("Location: manage_platforms.php");
    exit();
}


/* =========================
   DELETE PLATFORM
========================= */

if (isset($_GET['delete'])) {

    $platform_id = $_GET['delete'];

    $sql = "DELETE FROM platforms WHERE platform_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $platform_id);

    mysqli_stmt_execute($stmt);

    header("Location: manage_platforms.php");
    exit();
}


/* =========================
   EDIT PLATFORM
========================= */

$edit_platform = null;

if (isset($_GET['edit'])) {

    $platform_id = $_GET['edit'];

    $sql = "SELECT * FROM platforms WHERE platform_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $platform_id);

    mysqli_stmt_execute($stmt);

    $edit_result = mysqli_stmt_get_result($stmt);

    $edit_platform = mysqli_fetch_assoc($edit_result);
}


/* =========================
   FETCH ALL PLATFORMS
========================= */

$sql = "SELECT * FROM platforms ORDER BY platform_id";

$result = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Platforms | Cheat Codes of Social Media</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>

        body {
            background: #f8f9ff;
            font-family: Arial, sans-serif;
            margin: 0;
            color: #111827;
        }

        .admin-header {
            background: white;
            padding: 20px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }

        .admin-header h2 {
            margin: 0;
        }

        .back-btn {
            text-decoration: none;
            background: #7c3aed;
            color: white;
            padding: 10px 18px;
            border-radius: 7px;
            font-weight: bold;
        }

        .container {
            width: 86%;
            margin: 40px auto;
        }

        .container h1 {
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 30px;
        }

        .form-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.06);
            margin-bottom: 35px;
        }

        .form-card h2 {
            margin-top: 0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            font-weight: bold;
            margin-bottom: 7px;
        }

        input,
        textarea {
            padding: 11px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 14px;
            font-family: Arial, sans-serif;
        }

        textarea {
            min-height: 90px;
            resize: vertical;
        }

        .add-btn,
        .update-btn {
            margin-top: 20px;
            background: #7c3aed;
            color: white;
            border: none;
            padding: 12px 22px;
            border-radius: 7px;
            font-weight: bold;
            cursor: pointer;
        }

        .cancel-btn {
            display: inline-block;
            margin-top: 20px;
            margin-left: 10px;
            background: #e5e7eb;
            color: #374151;
            text-decoration: none;
            padding: 12px 22px;
            border-radius: 7px;
            font-weight: bold;
        }

        .table-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.06);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1100px;
        }

        th,
        td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        th {
            background: #f5f3ff;
            color: #5b21b6;
        }

        .edit-btn {
            text-decoration: none;
            background: #ede9fe;
            color: #6d28d9;
            padding: 7px 12px;
            border-radius: 6px;
            font-weight: bold;
            margin-right: 5px;
        }

        .delete-btn {
            text-decoration: none;
            background: #fee2e2;
            color: #dc2626;
            padding: 7px 12px;
            border-radius: 6px;
            font-weight: bold;
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


<header class="admin-header">

    <h2>Cheat Codes of Social Media</h2>

    <a href="dashboard.php" class="back-btn">
        Back to Dashboard
    </a>

</header>


<main class="container">

    <h1>Manage Platforms</h1>

    <p class="subtitle">
        Add and manage social media platforms displayed on the website.
    </p>


    <?php if ($edit_platform) { ?>

        <!-- EDIT FORM -->

        <div class="form-card">

            <h2>Edit Platform</h2>

            <form method="POST">

                <input
                    type="hidden"
                    name="platform_id"
                    value="<?php echo $edit_platform['platform_id']; ?>"
                >

                <div class="form-grid">

                    <div class="form-group">

                        <label>Platform Name</label>

                        <input
                            type="text"
                            name="platform_name"
                            value="<?php echo htmlspecialchars($edit_platform['platform_name']); ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>Content Types</label>

                        <input
                            type="text"
                            name="content_types"
                            value="<?php echo htmlspecialchars($edit_platform['content_types']); ?>"
                            required
                        >

                    </div>


                    <div class="form-group full">

                        <label>Description</label>

                        <textarea
                            name="description"
                            required
                        ><?php echo htmlspecialchars($edit_platform['description']); ?></textarea>

                    </div>


                    <div class="form-group full">

                        <label>Target Audience</label>

                        <textarea
                            name="target_audience"
                            required
                        ><?php echo htmlspecialchars($edit_platform['target_audience']); ?></textarea>

                    </div>


                    <div class="form-group full">

                        <label>Key Features</label>

                        <textarea
                            name="key_features"
                            required
                        ><?php echo htmlspecialchars($edit_platform['key_features']); ?></textarea>

                    </div>


                    <div class="form-group full">

                        <label>Source</label>

                        <input
                            type="text"
                            name="source"
                            value="<?php echo htmlspecialchars($edit_platform['source']); ?>"
                            required
                        >

                    </div>

                </div>


                <button
                    type="submit"
                    name="update_platform"
                    class="update-btn"
                >
                    Update Platform
                </button>


                <a
                    href="manage_platforms.php"
                    class="cancel-btn"
                >
                    Cancel
                </a>

            </form>

        </div>


    <?php } else { ?>


        <!-- ADD FORM -->

        <div class="form-card">

            <h2>Add New Platform</h2>

            <form method="POST">

                <div class="form-grid">

                    <div class="form-group">

                        <label>Platform Name</label>

                        <input
                            type="text"
                            name="platform_name"
                            placeholder="Example: Instagram"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>Content Types</label>

                        <input
                            type="text"
                            name="content_types"
                            placeholder="Photos, Reels, Stories"
                            required
                        >

                    </div>


                    <div class="form-group full">

                        <label>Description</label>

                        <textarea
                            name="description"
                            placeholder="Enter platform description"
                            required
                        ></textarea>

                    </div>


                    <div class="form-group full">

                        <label>Target Audience</label>

                        <textarea
                            name="target_audience"
                            placeholder="Example: Creators, businesses, students"
                            required
                        ></textarea>

                    </div>


                    <div class="form-group full">

                        <label>Key Features</label>

                        <textarea
                            name="key_features"
                            placeholder="Example: Reels, Stories, messaging"
                            required
                        ></textarea>

                    </div>


                    <div class="form-group full">

                        <label>Source</label>

                        <input
                            type="text"
                            name="source"
                            placeholder="Example: Instagram Creator Guidelines"
                            required
                        >

                    </div>

                </div>


                <button
                    type="submit"
                    name="add_platform"
                    class="add-btn"
                >
                    + Add Platform
                </button>

            </form>

        </div>


    <?php } ?>


    <!-- EXISTING PLATFORMS -->

    <div class="table-card">

        <h2>Existing Platforms</h2>

        <table>

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Platform</th>
                    <th>Description</th>
                    <th>Content Types</th>
                    <th>Target Audience</th>
                    <th>Key Features</th>
                    <th>Source</th>
                    <th>Last Updated</th>
                    <th>Action</th>

                </tr>

            </thead>


            <tbody>

                <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td>
                            <?php echo $row['platform_id']; ?>
                        </td>

                        <td>
                            <strong>
                                <?php echo htmlspecialchars($row['platform_name']); ?>
                            </strong>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['description']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['content_types']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['target_audience']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['key_features']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['source']); ?>
                        </td>

                        <td>
                            <?php echo $row['last_updated']; ?>
                        </td>

                        <td>

                            <a
                                href="manage_platforms.php?edit=<?php echo $row['platform_id']; ?>"
                                class="edit-btn"
                            >
                                Edit
                            </a>


                            <a
                                href="manage_platforms.php?delete=<?php echo $row['platform_id']; ?>"
                                class="delete-btn"
                                onclick="return confirm('Are you sure you want to delete this platform?');"
                            >
                                Delete
                            </a>

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>


</main>


</body>

</html>