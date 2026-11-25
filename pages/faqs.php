<?php
require_once "../config/database.php";

$sql = "SELECT * FROM faqs ORDER BY faq_id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FAQs | Cheat Codes of Social Media</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>
        .faq-page {
            background: #f8f9ff;
            min-height: 80vh;
            padding: 60px 7%;
        }

        .faq-intro {
            max-width: 750px;
            margin-bottom: 45px;
        }

        .faq-intro .eyebrow {
            color: #7138e8;
            font-weight: bold;
            letter-spacing: 3px;
            font-size: 14px;
        }

        .faq-intro h1 {
            font-size: 45px;
            margin: 20px 0;
            color: #101426;
        }

        .faq-intro p {
            color: #6b7280;
            font-size: 16px;
            line-height: 1.7;
        }

        .faq-list {
            max-width: 950px;
        }

        .faq-item {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 25px 30px;
            margin-bottom: 18px;
            transition: 0.3s;
        }

        .faq-item:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.07);
            transform: translateY(-2px);
        }

        .faq-category {
            color: #7138e8;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .faq-question {
            font-size: 20px;
            color: #101426;
            margin-bottom: 12px;
        }

        .faq-answer {
            color: #6b7280;
            font-size: 15px;
            line-height: 1.7;
        }

        .faq-tag {
            display: inline-block;
            margin-top: 15px;
            padding: 7px 13px;
            border-radius: 20px;
            background: #f0e8ff;
            color: #7138e8;
            font-size: 12px;
            font-weight: bold;
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


    <!-- FAQ Content -->
    <main class="faq-page">

        <div class="faq-intro">

            <div class="eyebrow">
                GOT QUESTIONS?
            </div>

            <h1>
                Frequently Asked Questions
            </h1>

            <p>
                Find answers to common questions about social media,
                content creation, growth strategies and monetization.
            </p>

        </div>


        <!-- FAQ List -->
        <div class="faq-list">

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="faq-item">

                    <div class="faq-category">
                        <?php echo htmlspecialchars($row['category']); ?>
                    </div>

                    <h2 class="faq-question">
                        <?php echo htmlspecialchars($row['question']); ?>
                    </h2>

                    <p class="faq-answer">
                        <?php echo htmlspecialchars($row['answer']); ?>
                    </p>

                    <span class="faq-tag">
                        FAQ
                    </span>

                </div>

            <?php } ?>

        </div>

    </main>

</body>

</html>