<?php
require 'db.php';

// same param handling as history.php
$start = isset($_GET['start']) && $_GET['start'] !== '' ? $_GET['start'] : null;
$end   = isset($_GET['end']) && $_GET['end'] !== '' ? $_GET['end'] : null;

$where = "";
$params = [];
$types = "";
if ($start && $end) {
    $where = "WHERE created_at BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)";
    $params = [$start, $end];
    $types = "ss";
} elseif ($start) {
    $where = "WHERE created_at >= ?";
    $params = [$start];
    $types = "s";
} elseif ($end) {
    $where = "WHERE created_at <= DATE_ADD(?, INTERVAL 1 DAY)";
    $params = [$end];
    $types = "s";
}

$sql = "SELECT id, mood, note, created_at FROM moods " . ($where ? $where : "ORDER BY created_at DESC");
$stmt = mysqli_prepare($conn, $sql);
if ($where) mysqli_stmt_bind_param($stmt, $types, ...$params);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=mood_export_' . date('Ymd_His') . '.csv');

$output = fopen('php://output', 'w');
fputcsv($output, ['id','mood','note','created_at']);
while ($row = mysqli_fetch_assoc($res)) {
    fputcsv($output, [$row['id'], $row['mood'], $row['note'], $row['created_at']]);
}
fclose($output);
exit;
