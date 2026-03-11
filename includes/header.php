<?php
// includes/header.php
$navItems = [
    'print'        => 'Print',
    'illustration' => 'Illustration',
    'digital'      => 'Digital',
    'photography'  => 'Photography',
];
$counts      = getCategoryCounts();
$currentCat  = filter_input(INPUT_GET, 'cat') ?? '';
$currentFile = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? html_escape($title) . ' — ArtFolio' : 'ArtFolio' ?></title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='8' fill='%23111'/><text y='.9em' font-size='72' x='50%' dominant-baseline='top' text-anchor='middle' fill='%23e74c3c'>❖</text></svg>">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #fff; color: #111; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6; }
        a { color: inherit; text-decoration: none; }
        h1,h2,h3 { font-weight: 700; line-height: 1.2; }

        /* NAV */
        .site-header { background: #fff; border-bottom: 2px solid #111; position: sticky; top: 0; z-index: 100; }
        .header-inner { max-width: 1100px; margin: 0 auto; padding: 0 1.5rem; height: 60px; display: flex; align-items: center; gap: 1.5rem; }
        .site-logo { font-size: 1.3rem; font-weight: 900; text-transform: uppercase; letter-spacing: -0.01em; flex-shrink: 0; }
        .site-logo span { color: #e74c3c; }
        .nav-list { list-style: none; display: flex; align-items: center; }
        .nav-link { display: flex; align-items: center; gap: 0.3rem; padding: 0 0.8rem; height: 60px; font-size: 13px; font-weight: 700; text-transform: uppercase; color: #111; border-bottom: 3px solid transparent; }
        .nav-link:hover { border-bottom-color: #111; }
        .nav-item.active .nav-link { border-bottom-color: #e74c3c; color: #e74c3c; }
        .nav-count { font-size: 10px; background: #f0f0f0; border-radius: 20px; padding: 1px 6px; color: #666; font-weight: 400; }
        .nav-search { display: flex; margin-left: auto; }
        .nav-search input { border: 2px solid #111; border-right: none; padding: 0.3rem 0.7rem; font-size: 13px; outline: none; width: 140px; }
        .nav-search button { background: #111; color: #fff; border: 2px solid #111; padding: 0.3rem 0.8rem; font-size: 12px; font-weight: 700; cursor: pointer; text-transform: uppercase; }
        .nav-search button:hover { background: #e74c3c; border-color: #e74c3c; }

        /* PAGE */
        .page-wrap { max-width: 1100px; margin: 0 auto; padding: 2rem 1.5rem 4rem; }
        .page-title { margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #111; }
        .page-title h1 { font-size: 1.6rem; font-weight: 900; text-transform: uppercase; }
        .page-title p { color: #555; margin-top: 0.4rem; font-size: 14px; }

        /* GRID */
        .cards-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
        @media (max-width: 600px) { .cards-grid { grid-template-columns: 1fr; } }

        /* CARD */
        article.card { background: #fff; }
        article.card a { display: block; color: inherit; }
        article.card img { width: 100%; aspect-ratio: 4/3; object-fit: cover; display: block; background: #f0f0f0; margin-bottom: 0.75rem; }
        article.card h2 { font-size: 1.3rem; font-weight: 700; margin-bottom: 0.25rem; }
        article.card h2:hover { text-decoration: underline; }
        article.card a p { font-size: 14px; color: #444; margin-bottom: 0.5rem; }
        article.card .credit { font-size: 11px; letter-spacing: 0.08em; text-transform: uppercase; color: #888; margin-top: 0.4rem; }
        article.card .credit a { color: #888; font-weight: 700; }
        article.card .credit a:hover { color: #e74c3c; }

        /* ARTICLE DETAIL */
        main.article { max-width: 1100px; margin: 0 auto; padding: 2rem 1.5rem 4rem; display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: start; }
        @media (max-width: 768px) { main.article { grid-template-columns: 1fr; } }
        main.article section.image img { width: 100%; display: block; object-fit: cover; }
        main.article section.text h1 { font-size: 2rem; font-weight: 900; margin-bottom: 0.5rem; }
        .work-detail-cat { font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase; color: #e74c3c; margin-bottom: 0.5rem; font-weight: 700; }
        .date { font-size: 13px; color: #888; margin-bottom: 1.5rem; }
        .content { color: #444; line-height: 1.8; font-size: 15px; margin-bottom: 2rem; }
        .work-meta-table { width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; }
        .work-meta-table tr { border-top: 1px solid #eee; }
        .work-meta-table td { padding: 0.5rem 0; font-size: 13px; }
        .work-meta-table td:first-child { color: #888; width: 35%; font-size: 11px; text-transform: uppercase; }
        .tag { display: inline-block; margin: 2px 3px 2px 0; padding: 2px 8px; background: #f0f0f0; font-size: 11px; color: #666; }
        .credit { font-size: 12px; color: #888; margin-top: 1rem; }
        .credit a { color: #e74c3c; }

        /* SEARCH */
        .form-search { display: flex; align-items: center; gap: 0; flex-wrap: wrap; margin-bottom: 1.5rem; }
        .form-search label { font-size: 13px; color: #555; margin-right: 0.5rem; }
        .form-search input[type="text"] { border: 2px solid #111; border-right: none; padding: 0.5rem 1rem; font-size: 14px; outline: none; flex: 1; min-width: 200px; }
        .btn-search { background: #111; color: #fff; border: 2px solid #111; padding: 0.5rem 1.25rem; font-size: 13px; font-weight: 700; text-transform: uppercase; cursor: pointer; }
        .btn-search:hover { background: #e74c3c; border-color: #e74c3c; }

        /* PAGINATION */
        .pagination { margin-top: 2rem; }
        .pagination ul { list-style: none; display: flex; gap: 4px; flex-wrap: wrap; }
        .pagination a { display: inline-block; padding: 0.4rem 0.8rem; border: 2px solid #111; font-size: 13px; font-weight: 700; color: #111; }
        .pagination a:hover, .pagination a.active { background: #111; color: #fff; }

        /* FOOTER */
        .site-footer { border-top: 2px solid #111; padding: 1.5rem; background: #fff; }
        .footer-inner { max-width: 1100px; margin: 0 auto; display: flex; align-items: center; gap: 2rem; flex-wrap: wrap; }
        .footer-brand { font-size: 1.1rem; font-weight: 900; text-transform: uppercase; }
        .footer-nav { display: flex; gap: 1.5rem; flex-wrap: wrap; }
        .footer-nav a { font-size: 12px; font-weight: 700; text-transform: uppercase; color: #111; }
        .footer-nav a:hover { color: #e74c3c; }
        .footer-copy { margin-left: auto; font-size: 11px; color: #999; }

        /* MISC */
        main.container { max-width: 1100px; margin: 0 auto; padding: 2rem 1.5rem 4rem; }
        section.header { margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #111; }
        section.header h1 { font-size: 1.6rem; font-weight: 900; }
        section.header p { color: #555; margin-top: 0.4rem; font-size: 14px; }
        section.grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
        article.summary { background: #fff; }
        article.summary a { display: block; color: inherit; }
        article.summary img { width: 100%; aspect-ratio: 4/3; object-fit: cover; display: block; margin-bottom: 0.75rem; }
        article.summary h2 { font-size: 1.3rem; font-weight: 700; margin-bottom: 0.25rem; }
        article.summary p { font-size: 14px; color: #444; }
        article.summary .credit { font-size: 11px; text-transform: uppercase; color: #888; margin-top: 0.4rem; }
        article.summary .credit a { color: #888; font-weight: 700; }
    </style>
</head>
<body>

<header class="site-header">
    <div class="header-inner">
        <a href="index.php" class="site-logo"><span>❖</span> ArtFolio</a>

        <nav class="main-nav">
            <ul class="nav-list">
                <li class="nav-item <?= $currentFile === 'index.php' ? 'active' : '' ?>">
                    <a href="index.php" class="nav-link">All Works</a>
                </li>
                <?php foreach ($navItems as $slug => $label): ?>
                <li class="nav-item <?= ($currentFile === 'category.php' && $currentCat === $slug) ? 'active' : '' ?>">
                    <a href="category.php?cat=<?= $slug ?>" class="nav-link">
                        <?= $label ?>
                        <span class="nav-count"><?= $counts[$slug] ?? 0 ?></span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <form action="search.php" method="get" class="nav-search">
            <input type="text" name="term" placeholder="Search…" value="<?= html_escape(filter_input(INPUT_GET, 'term') ?? '') ?>">
            <button type="submit">Search</button>
        </form>
    </div>
</header>