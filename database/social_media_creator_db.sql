-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2026 at 02:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_media_creator_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_id`, `username`, `password`, `full_name`, `created_at`) VALUES
(1, 'admin', '$2y$10$rp0oN68DRpqziR7wSR7RdeQv9RGdKQLpR/m9drO1TAfPFUTp63JX6', 'Website Administrator', '2026-09-15 14:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `creator_tips`
--

CREATE TABLE `creator_tips` (
  `tip_id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `platform` varchar(100) NOT NULL,
  `difficulty_level` varchar(50) NOT NULL,
  `source` varchar(255) NOT NULL,
  `last_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `creator_tips`
--

INSERT INTO `creator_tips` (`tip_id`, `category`, `title`, `description`, `platform`, `difficulty_level`, `source`, `last_updated`) VALUES
(1, 'Content Creation', 'Create a Strong Hook!', 'Start your video or post with an interesting statement, question or visual that encourages viewers to continue watching.', 'Instagram, YouTube, TikTok', 'Beginner', 'Platform creator guidelines and content best practices', '2026-09-15'),
(2, 'Content Creation', 'Maintain Consistency', 'Post content regularly and maintain a consistent style or theme so that your audience knows what to expect.', 'Instagram, YouTube, TikTok', 'Beginner', 'Platform creator guidelines and content best practices', '2026-09-15'),
(3, 'Video Creation', 'Use Good Lighting', 'Use sufficient and balanced lighting so that the subject is clearly visible and the video looks professional.', 'Instagram, YouTube, TikTok', 'Beginner', 'General content creation guidelines', '2026-09-15'),
(4, 'Engagement', 'Encourage Audience Interaction', 'Ask questions, respond to comments and use interactive features to encourage your audience to participate.', 'Instagram, YouTube', 'Intermediate', 'Platform creator guidelines', '2026-09-15'),
(5, 'Content Strategy', 'Know Your Audience', 'Understand the interests and needs of your target audience and create content that is relevant to them.', 'Instagram, YouTube, TikTok', 'Intermediate', 'General content strategy guidelines', '2026-09-15');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `faq_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `source` varchar(255) NOT NULL,
  `last_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`faq_id`, `question`, `answer`, `category`, `source`, `last_updated`) VALUES
(1, 'How often should I post on social media?', 'There is no single ideal posting frequency. Choose a schedule that you can maintain consistently while keeping the quality of your content high.', 'Content Creation', 'General social media best practices', '2026-09-15'),
(2, 'How can I increase engagement on my posts?', 'Create useful and interesting content, encourage viewers to comment or share, respond to comments and understand what content your audience prefers.', 'Growth', 'General social media best practices', '2026-09-15'),
(3, 'Do I need expensive equipment to become a content creator?', 'No. Beginners can start with a smartphone and basic lighting and audio equipment. The quality and value of the content are more important than expensive equipment.', 'Content Creation', 'General content creation guidelines', '2026-09-15'),
(4, 'How can content creators make money?', 'Creators can earn through platform monetization programs, brand collaborations, sponsored content, affiliate marketing and digital products, depending on eligibility and platform policies.', 'Monetization', 'General creator monetization guidelines', '2026-09-15'),
(5, 'How can I protect my social media account?', 'Use a strong unique password, enable two-factor authentication, avoid suspicious links and do not share passwords or sensitive account information.', 'Safety', 'General social media safety guidelines', '2026-09-15');

-- --------------------------------------------------------

--
-- Table structure for table `growth_strategies`
--

CREATE TABLE `growth_strategies` (
  `strategy_id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `strategy_name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `platform` varchar(255) NOT NULL,
  `difficulty_level` varchar(50) NOT NULL,
  `source` varchar(255) NOT NULL,
  `last_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `growth_strategies`
--

INSERT INTO `growth_strategies` (`strategy_id`, `category`, `strategy_name`, `description`, `platform`, `difficulty_level`, `source`, `last_updated`) VALUES
(1, 'Content Strategy', 'Post Consistently', 'Create and publish content regularly so your audience knows when to expect new posts.', 'Instagram, YouTube, TikTok', 'Beginner', 'Creator Growth Guidelines', '2026-09-15'),
(2, 'Engagement', 'Engage With Your Audience', 'Respond to comments, answer questions and interact with your audience to build a stronger community.', 'Instagram, YouTube, TikTok', 'Beginner', 'Creator Growth Guidelines', '2026-09-15'),
(3, 'Content Strategy', 'Use Trending Topics', 'Create relevant content around popular topics and trends while keeping it suitable for your audience.', 'Instagram, YouTube, TikTok', 'Intermediate', 'Social Media Best Practices', '2026-09-15'),
(4, 'Analytics', 'Analyze Your Performance', 'Review views, engagement and audience data to understand what type of content performs best.', 'Instagram, YouTube', 'Intermediate', 'Platform Analytics Guidelines', '2026-09-15'),
(5, 'Community', 'Build a Strong Community', 'Encourage discussions and create content that makes your audience feel connected to your creator community.', 'Instagram, YouTube, Facebook', 'Intermediate', 'Creator Community Guidelines', '2026-09-15');

-- --------------------------------------------------------

--
-- Table structure for table `monetization_guides`
--

CREATE TABLE `monetization_guides` (
  `guide_id` int(11) NOT NULL,
  `method_name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `requirements` text NOT NULL,
  `platform` varchar(100) NOT NULL,
  `source` varchar(255) NOT NULL,
  `last_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monetization_guides`
--

INSERT INTO `monetization_guides` (`guide_id`, `method_name`, `description`, `requirements`, `platform`, `source`, `last_updated`) VALUES
(1, 'YouTube Partner Program', 'Creators can monetize eligible YouTube content through advertising and other available YouTube monetization features.', 'Eligible channel, required subscribers and watch-time or Shorts eligibility, compliance with YouTube monetization policies', 'YouTube', 'https://support.google.com/youtube/answer/72857?hl=en', '2026-09-15'),
(2, 'Instagram Brand Collaborations', 'Creators can earn income by working with brands to promote products or services through sponsored content.', 'Established audience, engaging content, professional creator profile and compliance with branded content policies', 'Instagram', 'https://www.facebook.com/help/instagram/616901995832907?locale=en_GB', '2026-09-15'),
(3, 'Affiliate Marketing', 'Creators earn a commission by recommending products or services through affiliate links or promotional content.', 'Affiliate program approval, relevant content and disclosure of affiliate relationships where required', 'Instagram, YouTube, Blogs', 'https://www.ftc.gov/business-guidance/resources/ftcs-endorsement-guides-what-people-are-asking', '2026-09-15'),
(4, 'Sponsored Content', 'Creators collaborate with businesses to create promotional posts, videos or other content in exchange for payment.', 'Audience engagement, suitable niche, brand collaboration and clear sponsored-content disclosure', 'Instagram, YouTube, TikTok', 'https://www.ftc.gov/business-guidance/advertising-marketing/endorsements-influencers-reviews', '2026-09-15'),
(5, 'Digital Products', 'Creators can generate income by selling digital products such as ebooks, templates, presets, courses or other downloadable resources.', 'Useful digital product, suitable audience, platform or payment method for selling the product', 'Instagram, YouTube, Websites', 'https://www.shopify.com/digital-products', '2026-09-15');

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `platform_id` int(11) NOT NULL,
  `platform_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `content_types` varchar(255) NOT NULL,
  `target_audience` text NOT NULL,
  `key_features` text NOT NULL,
  `source` varchar(255) NOT NULL,
  `last_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`platform_id`, `platform_name`, `description`, `content_types`, `target_audience`, `key_features`, `source`, `last_updated`) VALUES
(1, 'Instagram', 'Instagram is a visual social media platform used by creators to share photos, videos, Reels and Stories.', 'Photos, Reels, Stories, Live Videos', 'Visual, lifestyle, entertainment and educational creators', 'Short-form video, Stories, Reels, messaging and audience engagement', 'Instagram for Creators', '2026-09-15'),
(2, 'YouTube', 'YouTube is a video-sharing platform for publishing long-form videos and Shorts.', 'Long Videos, Shorts, Live Streams', 'Video creators, educators, entertainers and reviewers', 'Video publishing, Shorts, live streaming, analytics and channel management', 'YouTube Creator Academy', '2026-09-15'),
(3, 'Facebook', 'Facebook allows creators to publish content, build communities and interact with audiences.', 'Videos, Posts, Reels, Live Videos', 'Creators, communities, businesses and organizations', 'Pages, Groups, Reels, video content and audience interaction', 'Meta for Creators', '2026-09-15'),
(4, 'LinkedIn', 'LinkedIn is a professional networking platform for sharing knowledge and industry-related content.', 'Articles, Posts, Videos, Documents', 'Students, professionals, educators and industry experts', 'Professional networking, articles, video and professional communities', 'LinkedIn for Creators', '2026-09-15'),
(5, 'X', 'X is a social platform focused on short-form posts and real-time conversations.', 'Posts, Images, Videos, Live Content', 'Commentators, professionals, creators and communities', 'Short-form posts, conversations, communities and real-time engagement', 'X Creator Resources', '2026-09-15'),
(6, 'Threads', 'A social media platform for sharing posts and interacting with audiences.', 'Posts, Images, Videos', 'Creators, communities and general users', 'Posts, replies, sharing and audience interaction', 'Threads Platform Guidelines', '2026-09-15');

-- --------------------------------------------------------

--
-- Table structure for table `safety_guides`
--

CREATE TABLE `safety_guides` (
  `guide_id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `platform` varchar(100) NOT NULL,
  `source` varchar(255) NOT NULL,
  `last_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `safety_guides`
--

INSERT INTO `safety_guides` (`guide_id`, `category`, `title`, `description`, `platform`, `source`, `last_updated`) VALUES
(1, 'Account Security', 'Use a Strong Password', 'Create a strong and unique password for your social media account and avoid sharing it with anyone.', 'All Platforms', 'General social media safety guidelines', '2026-09-15'),
(2, 'Account Security', 'Enable Two-Factor Authentication', 'Enable two-factor authentication to add an extra layer of security to your social media account.', 'Instagram, YouTube, Facebook, TikTok', 'Platform security guidelines', '2026-09-15'),
(3, 'Privacy', 'Protect Personal Information', 'Avoid publicly sharing sensitive information such as your phone number, home address, passwords or financial details.', 'All Platforms', 'General social media safety guidelines', '2026-09-15'),
(4, 'Content Safety', 'Avoid Copyright Violations', 'Use original content or properly licensed material and avoid using copyrighted content without permission.', 'All Platforms', 'Platform copyright guidelines', '2026-09-15'),
(5, 'Online Safety', 'Be Careful with Suspicious Links', 'Do not click suspicious links or respond to messages asking for passwords, payment details or account credentials.', 'All Platforms', 'General online safety guidelines', '2026-09-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `creator_tips`
--
ALTER TABLE `creator_tips`
  ADD PRIMARY KEY (`tip_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `growth_strategies`
--
ALTER TABLE `growth_strategies`
  ADD PRIMARY KEY (`strategy_id`);

--
-- Indexes for table `monetization_guides`
--
ALTER TABLE `monetization_guides`
  ADD PRIMARY KEY (`guide_id`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`platform_id`);

--
-- Indexes for table `safety_guides`
--
ALTER TABLE `safety_guides`
  ADD PRIMARY KEY (`guide_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `creator_tips`
--
ALTER TABLE `creator_tips`
  MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `growth_strategies`
--
ALTER TABLE `growth_strategies`
  MODIFY `strategy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `monetization_guides`
--
ALTER TABLE `monetization_guides`
  MODIFY `guide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `platform_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `safety_guides`
--
ALTER TABLE `safety_guides`
  MODIFY `guide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
