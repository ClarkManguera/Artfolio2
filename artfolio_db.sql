-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2026 at 07:26 AM
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
-- Database: `artfolio_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(10) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `name`, `description`, `icon`, `color`, `created_at`) VALUES
(1, 'print', 'Print', 'Printmaking, screen printing, letterpress, woodcut, etching, and all forms of the print arts.', '◼', '#1a1a1a', '2026-03-11 04:22:44'),
(2, 'illustration', 'Illustration', 'Editorial illustration, character design, concept art, book illustration, and narrative artwork.', '✦', '#c0392b', '2026-03-11 04:22:44'),
(3, 'digital', 'Digital', 'Digital painting, motion graphics, UI design, generative art, and pixel art.', '⬡', '#2980b9', '2026-03-11 04:22:44'),
(4, 'photography', 'Photography', 'Fine art photography, documentary, portrait, landscape, and experimental photography.', '◉', '#27ae60', '2026-03-11 04:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `artist` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `medium` varchar(100) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `tags` varchar(300) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT 0,
  `image_url` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`id`, `category_id`, `title`, `artist`, `description`, `medium`, `year`, `tags`, `featured`, `image_url`, `created_at`) VALUES
(1, 1, 'Echoes of Grain', 'Mara Santos', 'A textured screen print exploring the relationship between agricultural land patterns and urban sprawl.', 'Screen Print', '2024', 'abstract,texture,land', 1, 'https://images.unsplash.com/photo-1578926288207-a90a5366759d?w=600&q=80', '2026-03-11 04:22:44'),
(2, 1, 'Midnight Press No. 4', 'Julian Reyes', 'Letterpress broadside featuring layered wood type and ornamental borders on cotton rag paper.', 'Letterpress', '2023', 'typography,letterpress', 1, 'https://images.unsplash.com/photo-1561214115-f2f134cc4912?w=600&q=80', '2026-03-11 04:22:44'),
(3, 1, 'Woodblock Series: Forest Floor', 'Emi Tanaka', 'Reduction woodblock print capturing the complex textures of a forest floor.', 'Woodblock Print', '2024', 'nature,woodblock', 1, 'https://images.unsplash.com/photo-1508193638397-1c4234db14d8?w=600&q=80', '2026-03-11 04:22:44'),
(4, 1, 'Lithograph No. 7', 'Carlos Vega', 'Abstract lithograph exploring geometric tension through overlapping planes of color.', 'Lithograph', '2023', 'geometric,abstract', 1, 'https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=600&q=80', '2026-03-11 04:22:44'),
(5, 2, 'The Cartographer Dream', 'Lena Fischer', 'A detailed editorial illustration combining ink linework with watercolor washes about lost territories.', 'Ink & Watercolor', '2024', 'editorial,maps', 1, 'https://images.unsplash.com/photo-1572375992501-4b0892d50c69?w=600&q=80', '2026-03-11 04:22:44'),
(6, 2, 'Night Market Characters', 'Ravi Patel', 'Character design series for an animated short set in a fictional Southeast Asian night market.', 'Digital & Gouache', '2023', 'characters,animation', 1, 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?w=600&q=80', '2026-03-11 04:22:44'),
(7, 2, 'Botanical Archive Vol.2', 'Sophie Dubois', 'Scientific-style botanical illustration series with a surrealist twist.', 'Pen & Digital Color', '2024', 'botanical,scientific', 0, 'https://images.unsplash.com/photo-1585314062340-f1a5a7c9328d?w=600&q=80', '2026-03-11 04:22:44'),
(8, 2, 'Untitled Grief Study', 'Kwame Osei', 'An intimate narrative illustration exploring loss through fragmented portraiture.', 'Mixed Media', '2024', 'narrative,portrait', 0, 'https://images.unsplash.com/photo-1579762715118-a6f1d4b934f1?w=600&q=80', '2026-03-11 04:22:44'),
(9, 3, 'Recursive Bloom', 'Anya Ivanova', 'Generative artwork using custom algorithms to simulate organic growth patterns.', 'Generative / Processing', '2024', 'generative,algorithm', 1, 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=600&q=80', '2026-03-11 04:22:44'),
(10, 3, 'Neon Cityscape 3AM', 'Derrick Lam', 'A digital painting blending cyberpunk aesthetics with traditional Chinese architectural motifs.', 'Digital Painting', '2023', 'cityscape,neon,cyberpunk', 1, 'https://images.unsplash.com/photo-1545569341-9eb8b30979d9?w=600&q=80', '2026-03-11 04:22:44'),
(11, 3, 'Interface Study: Calm', 'Yuki Mori', 'Conceptual UI design for a meditation app emphasizing negative space and muted gradients.', 'UI / Motion Design', '2024', 'ui,motion,design', 0, 'https://images.unsplash.com/photo-1555774698-0b77e0d5fac6?w=600&q=80', '2026-03-11 04:22:44'),
(12, 3, 'Pixel Portrait: Grandmother', 'Luis Mendoza', 'A 128x128 pixel art portrait rendered with extraordinary detail and emotional depth.', 'Pixel Art', '2023', 'pixel,portrait', 0, 'https://images.unsplash.com/photo-1593642632559-0c6d3fc62b89?w=600&q=80', '2026-03-11 04:22:44'),
(13, 4, 'Salt Flats at Dusk', 'Nadia Kowalski', 'Long-exposure landscape photography taken over three days on the Bolivian salt flats.', 'Film Photography', '2024', 'landscape,longexposure', 1, 'https://images.unsplash.com/photo-1509316785289-025f5b846b35?w=600&q=80', '2026-03-11 04:22:44'),
(14, 4, 'The Fishermen of Inle', 'Arjun Mehta', 'Documentary portrait series of traditional leg-rowers on Inle Lake, Myanmar.', 'Medium Format Film', '2023', 'documentary,portrait', 1, 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=600&q=80', '2026-03-11 04:22:44'),
(15, 4, 'Concrete Geometries', 'Simone Laurent', 'Brutalist architecture photographed from extreme angles to reveal abstract compositions.', 'Digital Photography', '2024', 'architecture,abstract', 0, 'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=600&q=80', '2026-03-11 04:22:44'),
(16, 4, 'Double Exposure: Memory', 'Tae-yang Kim', 'In-camera double exposures combining portraits with natural landscapes.', 'Analog / In-camera', '2024', 'doubleexposure,portrait', 0, 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=600&q=80', '2026-03-11 04:22:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `works`
--
ALTER TABLE `works`
  ADD CONSTRAINT `works_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
