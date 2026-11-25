<?php
require_once "../config/database.php";

$sql = "SELECT * FROM monetization_guides ORDER BY guide_id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Monetization | Cheat Codes of Social Media</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>
        .monetization-page {
            background: #f8f9ff;
            min-height: 80vh;
            padding: 60px 7%;
        }

        .monetization-intro {
            max-width: 750px;
            margin-bottom: 45px;
        }

        .monetization-intro .eyebrow {
            color: #7138e8;
            font-weight: bold;
            letter-spacing: 3px;
            font-size: 14px;
        }

        .monetization-intro h1 {
            font-size: 45px;
            margin: 20px 0;
            color: #101426;
        }

        .monetization-intro p {
            color: #6b7280;
            font-size: 16px;
            line-height: 1.7;
        }

        .monetization-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .monetization-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 30px;
            transition: 0.3s;
        }

        .monetization-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .monetization-card .category {
            color: #7138e8;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 14px;
            margin-bottom: 18px;
        }

        .monetization-card h2 {
            color: #101426;
            margin-bottom: 15px;
        }

        .monetization-card p {
            color: #6b7280;
            line-height: 1.6;
            font-size: 14px;
        }

        .monetization-card strong {
            color: #374151;
        }

        .monetization-tag {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 14px;
            border-radius: 20px;
            background: #f0e8ff;
            color: #7138e8;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .monetization-tag:hover {
            background: #e5d5ff;
            transform: translateY(-2px);
        }

        @media (max-width: 900px) {
            .monetization-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .monetization-grid {
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


    <!-- Monetization Content -->
    <main class="monetization-page">

        <div class="monetization-intro">

            <div class="eyebrow">
                TURN YOUR CONTENT INTO INCOME
            </div>

            <h1>
                Monetization for Creators
            </h1>

            <p>
                Explore different ways creators can generate income
                from their content, skills, audience and online presence.
            </p>

        </div>


        <!-- Monetization Cards -->
        <div class="monetization-grid">

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="monetization-card">

                    <div class="category">
                        MONETIZATION
                    </div>

                    <h2>
                        <?php echo htmlspecialchars($row['method_name']); ?>
                    </h2>

                    <p>
                        <strong>About:</strong>
                        <?php echo htmlspecialchars($row['description']); ?>
                    </p>

                    <p>
                        <strong>Requirements:</strong>
                        <?php echo htmlspecialchars($row['requirements']); ?>
                    </p>

                    <p>
                        <strong>Platform:</strong>
                        <?php echo htmlspecialchars($row['platform']); ?>
                    </p>

                    <a
                        href="<?php echo htmlspecialchars($row['source'], ENT_QUOTES, 'UTF-8'); ?>"
                        class="monetization-tag"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        Monetization Method
                    </a>

                </div>

            <?php } ?>

        </div>

    </main>

</body>

</html>