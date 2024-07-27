<?php
require_once '../resources/config.php';
$conn = DatabaseConnection::getInstance();
$baseArticleUrl = "https://www.sociolme.com/article/"; // Update to include "https://"
$baseAuthorUrl = "https://www.sociolme.com/author/"; // Update to include "https://"
$baseCategoryUrl = "https://www.sociolme.com/category/"; // Update to include "https://"

$articleQuery = 'SELECT slug, 
       CASE 
           WHEN date >= modified_date THEN date 
           ELSE COALESCE(modified_date, date)
       END AS latest_date 
FROM articles';
$authorsQuery = "select slug from authors";
$categoryQuery = 'select slug from categories';

// handling the headers
header("Content-Type: application/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8" ?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL; // Update the schema URL

// Function to convert special characters to HTML entities
function xml_entities($string)
{
    return str_replace(
        array("&", "<", ">", '"', "'"),
        array("&amp;", "&lt;", "&gt;", "&quot;", "&apos;"),
        $string
    );
}

// Fetching the data
$articlesstmt = $conn->prepare($articleQuery);
$authorstmt = $conn->prepare($authorsQuery);
$catstmt = $conn->prepare($categoryQuery);

// Execute the statements
$articlesstmt->execute();
$authorstmt->execute();
$catstmt->execute();

// Fetch the results into arrays
$articleResults = $articlesstmt->fetchAll(PDO::FETCH_ASSOC);
$authorResults = $authorstmt->fetchAll(PDO::FETCH_ASSOC);
$categoryResults = $catstmt->fetchAll(PDO::FETCH_ASSOC);

// Loop through the article results and create URL nodes for each article
foreach ($articleResults as $article) {
    $articleSlug = xml_entities($article['slug']);
    $articleLatestDate = date('Y-m-d\TH:i:s+00:00', strtotime($article['latest_date'])); // Format the date

    // Create the URL node for the article
    echo '<url>' . PHP_EOL;
    echo '    <loc>' . $baseArticleUrl . $articleSlug . '</loc>' . PHP_EOL;
    echo '    <lastmod>' . $articleLatestDate . '</lastmod>' . PHP_EOL;
    echo '    <changefreq>daily</changefreq>' . PHP_EOL; // Set the desired change frequency
    echo '    <priority>0.8</priority>' . PHP_EOL; // Set the desired priority
    echo '</url>' . PHP_EOL;
}

// Loop through the author results and create URL nodes for each author
foreach ($authorResults as $author) {
    $authorSlug = xml_entities($author['slug']);

    // Create the URL node for the author
    echo '<url>' . PHP_EOL;
    echo '    <loc>' . $baseAuthorUrl . $authorSlug . '</loc>' . PHP_EOL;
    // You can set the lastmod, changefreq, and priority for authors as well if needed
    echo '</url>' . PHP_EOL;
}

// Loop through the category results and create URL nodes for each category
foreach ($categoryResults as $category) {
    $categorySlug = xml_entities($category['slug']);

    // Create the URL node for the category
    echo '<url>' . PHP_EOL;
    echo '    <loc>' . $baseCategoryUrl . $categorySlug . '</loc>' . PHP_EOL;
    // You can set the lastmod, changefreq, and priority for categories as well if needed
    echo '</url>' . PHP_EOL;
}

// Close the urlset tag
echo '</urlset>' . PHP_EOL;
