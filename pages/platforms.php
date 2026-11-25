<?php
require_once "../config/database.php";

$sql = "SELECT * FROM platforms ORDER BY platform_id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Social Media Platforms | Cheat Codes of Social Media</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>
        .platform-page {
            padding: 70px 8%;
            background: #f8f8ff;
            min-height: 80vh;
        }

        .platform-intro {
            max-width: 750px;
            margin-bottom: 45px;
        }

        .platform-intro h1 {
            font-size: 45px;
            margin-bottom: 15px;
            color: #101426;
        }

        .platform-intro p {
            color: #6b7280;
            font-size: 17px;
            line-height: 1.7;
        }

        .platform-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .platform-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 30px;
            transition: 0.3s;
        }

        .platform-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .platform-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .platform-card h2 {
            margin-bottom: 12px;
            color: #101426;
        }

        .platform-card p {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 12px;
            line-height: 1.6;
        }

        .platform-card strong {
            color: #374151;
        }

        .platform-tag {
            display: inline-block;
            margin-top: 10px;
            padding: 7px 14px;
            background: #f5f3ff;
            color: #7c3aed;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-decoration: none;
        }

        .platform-tag:hover {
            background: #7c3aed;
            color: white;
        }

        @media (max-width: 900px) {
            .platform-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .platform-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- Navigation -->
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


    <!-- Main Content -->
    <main class="platform-page">

        <div class="platform-intro">

            <p class="small-heading">
                CHOOSE YOUR PLATFORM
            </p>

            <h1>
                Know Your Social Media Platforms
            </h1>

            <p>
                Every social media platform has different audiences,
                content formats and opportunities. Understanding these
                differences can help aspiring creators choose platforms
                that match their content and goals.
            </p>

        </div>


        <!-- Platform Cards -->
        <div class="platform-grid">

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <?php

                /* Platform Icon */
                if ($row['platform_name'] == 'Instagram') {
                    $icon = '📸';
                } elseif ($row['platform_name'] == 'YouTube') {
                    $icon = '▶️';
                } elseif ($row['platform_name'] == 'Facebook') {
                    $icon = '📘';
                } elseif ($row['platform_name'] == 'LinkedIn') {
                    $icon = '💼';
                } elseif ($row['platform_name'] == 'TikTok') {
                    $icon = '🎵';
                } elseif ($row['platform_name'] == 'X') {
                    $icon = '𝕏';
                } elseif ($row['platform_name'] == 'Threads') {
                    $icon = '🧵';
                } else {
                    $icon = '📱';
                }


                /* Platform Website */
                if ($row['platform_name'] == 'Instagram') {
                    $platform_url = 'https://www.instagram.com/';
                } elseif ($row['platform_name'] == 'YouTube') {
                    $platform_url = 'https://www.youtube.com/';
                } elseif ($row['platform_name'] == 'Facebook') {
                    $platform_url = 'https://www.facebook.com/';
                } elseif ($row['platform_name'] == 'LinkedIn') {
                    $platform_url = 'https://www.linkedin.com/';
                } elseif ($row['platform_name'] == 'TikTok') {
                    $platform_url = 'https://www.tiktok.com/';
                } elseif ($row['platform_name'] == 'X') {
                    $platform_url = 'https://x.com/';
                } elseif ($row['platform_name'] == 'Threads') {
                    $platform_url = 'https://www.threads.com/';
                } else {
                    $platform_url = '#';
                }

                ?>

                <div class="platform-card">

                    <div class="platform-icon">
                        <?php echo $icon; ?>
                    </div>

                    <h2>
                        <?php echo htmlspecialchars($row['platform_name']); ?>
                    </h2>

                    <p>
                        <strong>About:</strong>
                        <?php echo htmlspecialchars($row['description']); ?>
                    </p>

                    <p>
                        <strong>Content Types:</strong>
                        <?php echo htmlspecialchars($row['content_types']); ?>
                    </p>

                    <p>
                        <strong>Target Audience:</strong>
                        <?php echo htmlspecialchars($row['target_audience']); ?>
                    </p>

                    <p>
                        <strong>Key Features:</strong>
                        <?php echo htmlspecialchars($row['key_features']); ?>
                    </p>

                    <a
                        href="<?php echo $platform_url; ?>"
                        class="platform-tag"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        Explore →
                    </a>

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