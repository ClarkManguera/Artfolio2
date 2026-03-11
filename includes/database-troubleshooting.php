<?php
// includes/database-troubleshooting.php
// This file is shown when the database connection fails
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Error — ArtFolio</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='16' fill='%230d0d0b'/><text y='.9em' font-size='72' x='50%' dominant-baseline='top' text-anchor='middle'>◈</text></svg>">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background: #0d0d0b;
            color: #e8e4db;
            font-family: 'Courier New', monospace;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .error-box {
            max-width: 600px;
            width: 100%;
            border: 1px solid rgba(255,255,255,0.08);
            padding: 3rem;
            background: #141410;
        }
        .error-logo {
            font-size: 2rem;
            color: #c9a84c;
            margin-bottom: 2rem;
        }
        h1 {
            font-size: 1.4rem;
            font-weight: normal;
            margin-bottom: 1rem;
            color: #ff6b6b;
        }
        p { color: #7a7568; line-height: 1.8; margin-bottom: 1rem; font-size: 13px; }
        .steps {
            margin: 1.5rem 0;
            padding: 1.5rem;
            background: #0d0d0b;
            border-left: 3px solid #c9a84c;
        }
        .steps p { margin-bottom: 0.5rem; }
        .steps strong { color: #e8e4db; }
        a { color: #c9a84c; }
        code {
            background: #0d0d0b;
            padding: 2px 6px;
            border: 1px solid rgba(255,255,255,0.1);
            font-size: 12px;
            color: #6dbe8d;
        }
    </style>
</head>
<body>
    <div class="error-box">
        <div class="error-logo">◈ ArtFolio</div>
        <h1>⚠ Database Connection Failed</h1>
        <p>The site could not connect to the database. Please check the steps below.</p>

        <div class="steps">
            <p><strong>Step 1 —</strong> Make sure <code>MySQL</code> is running in XAMPP Control Panel.</p>
            <p><strong>Step 2 —</strong> Open <code>includes/database-connection.php</code> and verify:</p>
            <p>&nbsp;&nbsp;&nbsp;• <code>$server</code> is <code>'localhost'</code></p>
            <p>&nbsp;&nbsp;&nbsp;• <code>$db</code> is <code>'artfolio_db'</code></p>
            <p>&nbsp;&nbsp;&nbsp;• <code>$username</code> and <code>$password</code> are correct</p>
            <p><strong>Step 3 —</strong> Make sure you imported <code>database.sql</code> in phpMyAdmin.</p>
            <p><strong>Step 4 —</strong> Visit <a href="includes/database-troubleshooting.php">this page</a> directly to test connection.</p>
        </div>

        <p><a href="index.php">← Try again</a> &nbsp;|&nbsp; <a href="http://localhost/phpmyadmin" target="_blank">Open phpMyAdmin</a></p>
    </div>
</body>
</html>