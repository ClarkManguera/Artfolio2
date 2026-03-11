-- ============================================
-- ArtFolio Database Schema & Seed Data
-- ============================================

CREATE DATABASE IF NOT EXISTS artfolio_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE artfolio_db;

-- Categories Table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    icon VARCHAR(10),
    color VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Works / Portfolio Items Table
CREATE TABLE IF NOT EXISTS works (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    artist VARCHAR(150) NOT NULL,
    description TEXT,
    medium VARCHAR(100),
    year YEAR,
    tags VARCHAR(300),
    featured TINYINT(1) DEFAULT 0,
    image_url VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- ============================================
-- SEED DATA
-- ============================================

INSERT INTO categories (slug, name, description, icon, color) VALUES
('print', 'Print', 'Printmaking, screen printing, letterpress, woodcut, etching, and all forms of the print arts.', '◼', '#1a1a1a'),
('illustration', 'Illustration', 'Editorial illustration, character design, concept art, book illustration, and narrative artwork.', '✦', '#c0392b'),
('digital', 'Digital', 'Digital painting, motion graphics, UI design, generative art, and pixel art.', '⬡', '#2980b9'),
('photography', 'Photography', 'Fine art photography, documentary, portrait, landscape, and experimental photography.', '◉', '#27ae60');

-- Print Works
INSERT INTO works (category_id, title, artist, description, medium, year, tags, featured, image_url) VALUES
(1, 'Echoes of Grain', 'Mara Santos', 'A textured screen print exploring the relationship between agricultural land patterns and urban sprawl.', 'Screen Print', 2024, 'abstract,texture,land', 1, 'https://images.unsplash.com/photo-1578926288207-a90a5366759d?w=600&q=80'),
(1, 'Midnight Press No. 4', 'Julian Reyes', 'Letterpress broadside featuring layered wood type and ornamental borders on cotton rag paper.', 'Letterpress', 2023, 'typography,letterpress', 1, 'https://images.unsplash.com/photo-1561214115-f2f134cc4912?w=600&q=80'),
(1, 'Woodblock Series: Forest Floor', 'Emi Tanaka', 'Reduction woodblock print capturing the complex textures of a forest floor.', 'Woodblock Print', 2024, 'nature,woodblock', 0, 'https://images.unsplash.com/photo-1508193638397-1c4234db14d8?w=600&q=80'),
(1, 'Lithograph No. 7', 'Carlos Vega', 'Abstract lithograph exploring geometric tension through overlapping planes of color.', 'Lithograph', 2023, 'geometric,abstract', 0, 'https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=600&q=80');

-- Illustration Works
INSERT INTO works (category_id, title, artist, description, medium, year, tags, featured, image_url) VALUES
(2, 'The Cartographer Dream', 'Lena Fischer', 'A detailed editorial illustration combining ink linework with watercolor washes about lost territories.', 'Ink & Watercolor', 2024, 'editorial,maps', 1, 'https://images.unsplash.com/photo-1572375992501-4b0892d50c69?w=600&q=80'),
(2, 'Night Market Characters', 'Ravi Patel', 'Character design series for an animated short set in a fictional Southeast Asian night market.', 'Digital & Gouache', 2023, 'characters,animation', 1, 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?w=600&q=80'),
(2, 'Botanical Archive Vol.2', 'Sophie Dubois', 'Scientific-style botanical illustration series with a surrealist twist.', 'Pen & Digital Color', 2024, 'botanical,scientific', 0, 'https://images.unsplash.com/photo-1585314062340-f1a5a7c9328d?w=600&q=80'),
(2, 'Untitled Grief Study', 'Kwame Osei', 'An intimate narrative illustration exploring loss through fragmented portraiture.', 'Mixed Media', 2024, 'narrative,portrait', 0, 'https://images.unsplash.com/photo-1579762715118-a6f1d4b934f1?w=600&q=80');

-- Digital Works
INSERT INTO works (category_id, title, artist, description, medium, year, tags, featured, image_url) VALUES
(3, 'Recursive Bloom', 'Anya Ivanova', 'Generative artwork using custom algorithms to simulate organic growth patterns.', 'Generative / Processing', 2024, 'generative,algorithm', 1, 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=600&q=80'),
(3, 'Neon Cityscape 3AM', 'Derrick Lam', 'A digital painting blending cyberpunk aesthetics with traditional Chinese architectural motifs.', 'Digital Painting', 2023, 'cityscape,neon,cyberpunk', 1, 'https://images.unsplash.com/photo-1545569341-9eb8b30979d9?w=600&q=80'),
(3, 'Interface Study: Calm', 'Yuki Mori', 'Conceptual UI design for a meditation app emphasizing negative space and muted gradients.', 'UI / Motion Design', 2024, 'ui,motion,design', 0, 'https://images.unsplash.com/photo-1555774698-0b77e0d5fac6?w=600&q=80'),
(3, 'Pixel Portrait: Grandmother', 'Luis Mendoza', 'A 128x128 pixel art portrait rendered with extraordinary detail and emotional depth.', 'Pixel Art', 2023, 'pixel,portrait', 0, 'https://images.unsplash.com/photo-1593642632559-0c6d3fc62b89?w=600&q=80');

-- Photography Works
INSERT INTO works (category_id, title, artist, description, medium, year, tags, featured, image_url) VALUES
(4, 'Salt Flats at Dusk', 'Nadia Kowalski', 'Long-exposure landscape photography taken over three days on the Bolivian salt flats.', 'Film Photography', 2024, 'landscape,longexposure', 1, 'https://images.unsplash.com/photo-1509316785289-025f5b846b35?w=600&q=80'),
(4, 'The Fishermen of Inle', 'Arjun Mehta', 'Documentary portrait series of traditional leg-rowers on Inle Lake, Myanmar.', 'Medium Format Film', 2023, 'documentary,portrait', 1, 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=600&q=80'),
(4, 'Concrete Geometries', 'Simone Laurent', 'Brutalist architecture photographed from extreme angles to reveal abstract compositions.', 'Digital Photography', 2024, 'architecture,abstract', 0, 'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=600&q=80'),
(4, 'Double Exposure: Memory', 'Tae-yang Kim', 'In-camera double exposures combining portraits with natural landscapes.', 'Analog / In-camera', 2024, 'doubleexposure,portrait', 0, 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=600&q=80');