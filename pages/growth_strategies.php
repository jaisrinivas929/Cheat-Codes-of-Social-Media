<?php
require_once "../config/database.php";

$sql = "SELECT * FROM growth_strategies ORDER BY strategy_id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Growth Strategies | Cheat Codes of Social Media</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>
        .growth-page {
            background: #f8f8ff;
            min-height: 80vh;
            padding: 60px 7%;
        }

        .growth-intro {
            max-width: 750px;
            margin-bottom: 45px;
        }

        .growth-intro .eyebrow {
            color: #7138e8;
            font-weight: bold;
            letter-spacing: 3px;
            font-size: 14px;
        }

        .growth-intro h1 {
            font-size: 45px;
            margin: 20px 0;
            color: #101426;
        }

        .growth-intro p {
            color: #64748b;
            font-size: 16px;
        }

        .growth-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .growth-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 30px;
            transition: 0.3s;
        }

        .growth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .growth-card .category {
            color: #7138e8;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 13px;
            text-transform: uppercase;
        }

        .growth-card h2 {
            margin: 15px 0 12px;
            color: #101426;
        }

        .growth-card p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        .growth-card strong {
            color: #374151;
        }

        .growth-tag {
            display: inline-block;
            margin-top: 10px;
            padding: 7px 13px;
            background: #f0e9ff;
            color: #7138e8;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        @media (max-width: 900px) {
            .growth-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .growth-grid {
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


    <!-- Growth Strategies -->
    <main class="growth-page">

        <div class="growth-intro">

            <div class="eyebrow">
                GROW YOUR PRESENCE
            </div>

            <h1>
                Growth Strategies for Creators
            </h1>

            <p>
                Discover practical strategies to increase your reach,
                build an engaged audience and grow your presence across
                social media platforms.
            </p>

        </div>


        <div class="growth-grid">

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="growth-card">

                    <div class="category">
                        <?php echo htmlspecialchars($row['category']); ?>
                    </div>

                    <h2>
                        <?php echo htmlspecialchars($row['strategy_name']); ?>
                    </h2>

                    <p>
                        <strong>About:</strong>
                        <?php echo htmlspecialchars($row['description']); ?>
                    </p>

                    <p>
                        <strong>Platform:</strong>
                        <?php echo htmlspecialchars($row['platform']); ?>
                    </p>

                    <p>
                        <strong>Difficulty:</strong>
                        <?php echo htmlspecialchars($row['difficulty_level']); ?>
                    </p>

                    <span class="growth-tag">
                        Growth Strategy
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