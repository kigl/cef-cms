<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($data->getUrls() as $url) : ?>
        <url>
            <loc><?= $data->getHost() ?><?= $url; ?></loc>
            <changefreq>daily</changefreq>
            <priority>0.5</priority>
        </url>
    <?php endforeach; ?>
</urlset>
