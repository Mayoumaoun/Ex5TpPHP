<?php
require_once("classes/section.php");
$section = new Section();
$sections = $section->findAll();
$content = "ID\tDesignation\tDescription\n";
foreach ($sections as $sec) {
    $content .= $sec->id . "\t" . $sec->designation . "\t" . $sec->description . "\n";
}
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="sections_list.txt"');
echo $content;
exit;
?>
