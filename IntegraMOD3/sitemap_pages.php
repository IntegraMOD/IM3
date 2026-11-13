<?php
/**
*
* Public static pages sitemap
*
* @package IntegraMOD
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_pages.' . $phpEx);

header('Content-Type: application/xml; charset=UTF-8');

$sql = 'SELECT page_id, page_title, page_url, page_updated
	FROM ' . PAGES_TABLE . '
	WHERE page_display = 1
		AND page_display_guests = 1
	ORDER BY page_order ASC, page_id ASC';
$result = $db->sql_query($sql);

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

while ($row = $db->sql_fetchrow($result))
{
	$updated = (!empty($row['page_updated'])) ? (int) $row['page_updated'] : time();

	echo "\t<url>\n";
	echo "\t\t<loc>" . htmlspecialchars(static_page_url($row['page_id'], $row['page_title'], $row['page_url']), ENT_QUOTES, 'UTF-8') . "</loc>\n";
	echo "\t\t<lastmod>" . gmdate('Y-m-d\TH:i:s\Z', $updated) . "</lastmod>\n";
	echo "\t</url>\n";
}
$db->sql_freeresult($result);

echo '</urlset>';
exit;
