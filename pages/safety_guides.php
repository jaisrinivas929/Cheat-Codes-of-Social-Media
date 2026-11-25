<?php
require_once "../config/database.php";

$sql = "SELECT * FROM safety_guides ORDER BY guide_id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Safety Guides | Cheat Codes of Social Media</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>
        .safety-page {
            background: #f8f9ff;
            min-height: 80vh;
            padding: 60px 7%;
        }

        .safety-intro {
            max-width: 750px;
            margin-bottom: 45px;
        }

        .safety-intro .eyebrow {
            color: #7138e8;
            font-weight: bold;
            letter-spacing: 3px;
            font-size: 14px;
        }

        .safety-intro h1 {
            font-size: 45px;
            margin: 20px 0;
            color: #101426;
        }

        .safety-intro p {
            color: #6b7280;
            font-size: 16px;
            line-height: 1.7;
        }

        .safety-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .safety-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 30px;
            transition: 0.3s;
        }

        .safety-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .safety-card .category {
            color: #7138e8;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 14px;
            margin-bottom: 18px;
        }

        .safety-card h2 {
            color: #101426;
            margin-bottom: 15px;
        }

        .safety-card p {
            color: #6b7280;
            line-height: 1.6;
            font-size: 14px;
        }

        .safety-card strong {
            color: #374151;
        }

        .safety-tag {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 14px;
            border-radius: 20px;
            background: #f0e8ff;
            color: #7138e8;
            font-size: 13px;
            font-weight: bold;
        }

        @media (max-width: 900px) {
            .safety-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .safety-grid {
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


    <!-- Safety Guides -->
    <main class="safety-page">

        <div class="safety-intro">

            <div class="eyebrow">
                STAY SAFE ONLINE
            </div>

            <h1>
                Social Media Safety Guides
            </h1>

            <p>
                Learn simple safety practices to protect your accounts,
                personal information and online presence while using social media.
            </p>

        </div>


        <!-- Safety Cards -->
        <div class="safety-grid">

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="safety-card">

                    <div class="category">
                        <?php echo htmlspecialchars($row['category']); ?>
                    </div>

                    <h2>
                        <?php echo htmlspecialchars($row['title']); ?>
                    </h2>

                    <p>
                        <strong>About:</strong>
                        <?php echo htmlspecialchars($row['description']); ?>
                    </p>

                    <p>
                        <strong>Platform:</strong>
                        <?php echo htmlspecialchars($row['platform']); ?>
                    </p>

                    <span class="safety-tag">
                        Safety Guide
                    </span>

                </div>

            <?php } ?>

        </div>

    </main>

</body>

</html>