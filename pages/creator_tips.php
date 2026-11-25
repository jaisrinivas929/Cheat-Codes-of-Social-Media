<?php
require_once "../config/database.php";

$sql = "SELECT * FROM creator_tips ORDER BY tip_id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Content Tips | Cheat Codes of Social Media</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>
        .tips-page {
            padding: 70px 7%;
            background: #f8f8ff;
            min-height: 80vh;
        }

        .tips-intro {
            max-width: 750px;
            margin-bottom: 45px;
        }

        .tips-intro .eyebrow {
            color: #7138e8;
            font-weight: bold;
            letter-spacing: 3px;
            font-size: 14px;
        }

        .tips-intro h1 {
            font-size: 45px;
            margin: 20px 0;
            color: #101426;
        }

        .tips-intro p {
            color: #5f6b7a;
            line-height: 1.7;
        }

        .tips-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .tip-card {
            background: white;
            border: 1px solid #e5e5eb;
            border-radius: 14px;
            padding: 28px;
            transition: 0.3s;
        }

        .tip-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .tip-category {
            color: #7138e8;
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .tip-card h2 {
            margin: 12px 0;
            color: #172033;
            font-size: 22px;
        }

        .tip-card p {
            color: #667085;
            line-height: 1.6;
            font-size: 14px;
        }

        .tip-info {
            margin-top: 20px;
            font-size: 13px;
            color: #475467;
        }

        .tip-tag {
            display: inline-block;
            margin-top: 15px;
            padding: 7px 12px;
            border-radius: 20px;
            background: #f1ebff;
            color: #7138e8;
            font-size: 12px;
            font-weight: bold;
        }

        @media (max-width: 900px) {
            .tips-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 600px) {
            .tips-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header class="navbar">

        <div class="logo">
            Cheat Codes <span>of Social Media</span>
        </div>

        <nav class="nav-links">
            <a href="../index.php">Home</a>
            <a href="platforms.php">Platforms</a>
            <a href="creator_tips.php">Content Tips</a>
            <a href="growth_strategies.php">Growth Strategies</a>
            <a href="monetization.php">Monetization</a>
            <a href="faqs.php">FAQs</a>
        </nav>

    </header>


    <!-- Content Tips -->
    <main class="tips-page">

        <div class="tips-intro">

            <div class="eyebrow">
                CREATE BETTER CONTENT
            </div>

            <h1>
                Content Tips for Creators
            </h1>

            <p>
                Discover practical content creation tips, best practices
                and platform-specific ideas to help you create better
                content and engage your audience.
            </p>

        </div>


        <div class="tips-grid">

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="tip-card">

                    <div class="tip-category">
                        <?php echo htmlspecialchars($row['category']); ?>
                    </div>

                    <h2>
                        <?php echo htmlspecialchars($row['title']); ?>
                    </h2>

                    <p>
                        <?php echo htmlspecialchars($row['description']); ?>
                    </p>

                    <div class="tip-info">
                        <strong>Platform:</strong>
                        <?php echo htmlspecialchars($row['platform']); ?>
                    </div>

                    <div class="tip-info">
                        <strong>Difficulty:</strong>
                        <?php echo htmlspecialchars($row['difficulty_level']); ?>
                    </div>

                    <span class="tip-tag">
                        Creator Tip
                    </span>

                </div>

            <?php } ?>

        </div>

    </main>


    <!-- Footer -->
    <footer>

        <p>
            © 2026 Cheat Codes of Social Media
        </p>

        <p>
            A Web-Based Information System for Aspiring Content Creators
        </p>

    </footer>

</body>

</html>