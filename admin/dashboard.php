<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}

require_once "../config/database.php";

// Count records from each table
$platforms = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM platforms"))["total"];

$creator_tips = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM creator_tips"))["total"];

$growth_strategies = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM growth_strategies"))["total"];

$monetization = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM monetization_guides"))["total"];

$safety = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM safety_guides"))["total"];

$faqs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM faqs"))["total"];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard | Cheat Codes of Social Media</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>

        body {
            background: #f8f9ff;
            margin: 0;
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
            color: #111827;
        }

        .logout-btn {
            text-decoration: none;
            background: #7c3aed;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: bold;
        }

        .dashboard {
            width: 86%;
            max-width: 1200px;
            margin: 50px auto;
        }

        .dashboard h1 {
            margin-bottom: 8px;
            color: #111827;
        }

        .dashboard-intro {
            color: #6b7280;
            margin-bottom: 35px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .card {
            background: white;
            padding: 25px;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.04);
        }

        .card h3 {
            margin-top: 0;
            color: #111827;
        }

        .count {
            font-size: 36px;
            font-weight: bold;
            color: #7c3aed;
            margin: 10px 0;
        }

        .manage-btn {
            display: inline-block;
            text-decoration: none;
            background: #f1e9ff;
            color: #7c3aed;
            padding: 9px 15px;
            border-radius: 7px;
            font-weight: bold;
        }

        .manage-btn:hover {
            background: #e5d5ff;
        }

        @media (max-width: 800px) {
            .cards {
                grid-template-columns: 1fr;
            }
        }

    </style>

</head>

<body>

    <header class="admin-header">

        <h2>Cheat Codes of Social Media</h2>

        <a href="logout.php" class="logout-btn">
            Logout
        </a>

    </header>


    <main class="dashboard">

        <h1>Admin Dashboard</h1>

        <p class="dashboard-intro">
            Welcome, <?php echo htmlspecialchars($_SESSION["admin_username"]); ?>!
            Manage the content of your website from here.
        </p>


        <div class="cards">


            <!-- Platforms -->

            <div class="card">

                <h3>📱 Platforms</h3>

                <div class="count">
                    <?php echo $platforms; ?>
                </div>

                <p>Social media platforms available.</p>

                <a href="manage_platforms.php" class="manage-btn">
                    Manage Platforms
                </a>

            </div>


            <!-- Creator Tips -->

            <div class="card">

                <h3>✍️ Creator Tips</h3>

                <div class="count">
                    <?php echo $creator_tips; ?>
                </div>

                <p>Content creation tips.</p>

                <a href="manage_creator_tips.php" class="manage-btn">
                    Manage Tips
                </a>

            </div>


            <!-- Growth Strategies -->

            <div class="card">

                <h3>📈 Growth Strategies</h3>

                <div class="count">
                    <?php echo $growth_strategies; ?>
                </div>

                <p>Strategies for growing your audience.</p>

                <a href="manage_growth.php" class="manage-btn">
                    Manage Growth
                </a>

            </div>


            <!-- Monetization -->

            <div class="card">

                <h3>💰 Monetization</h3>

                <div class="count">
                    <?php echo $monetization; ?>
                </div>

                <p>Ways creators can earn money.</p>

                <a href="manage_monetization.php" class="manage-btn">
                    Manage Monetization
                </a>

            </div>


            <!-- Safety Guides -->

            <div class="card">

                <h3>🛡️ Safety Guides</h3>

                <div class="count">
                    <?php echo $safety; ?>
                </div>

                <p>Online safety information.</p>

                <a href="manage_safety.php" class="manage-btn">
                    Manage Safety
                </a>

            </div>


            <!-- FAQs -->

            <div class="card">

                <h3>❓ FAQs</h3>

                <div class="count">
                    <?php echo $faqs; ?>
                </div>

                <p>Frequently asked questions.</p>

                <a href="manage_faqs.php" class="manage-btn">
                    Manage FAQs
                </a>

            </div>


        </div>

    </main>

</body>

</html>