<?php
$digits = '123456789';
$perms = array_map('implode', permute(str_split($digits)));

$char_list = array('a', '', 'c', '', 'e', '', 'g', '', 'i');
$result_list = array();

foreach ($perms as $perm) {
  $result = $char_list[$perm[0]-1] . $perm[1] . $char_list[$perm[2]-1];
  array_push($result_list, $result);
}

print_r($result_list);

// Function to generate permutations
function permute($items, $perms = array()) {
  if (empty($items)) {
    return array($perms);
  }
  $result = array();
  for ($i = count($items) - 1; $i >= 0; --$i) {
    $new_items = $items;
    $new_perms = $perms;
    list($foo) = array_splice($new_items, $i, 1);
    array_unshift($new_perms, $foo);
    $result = array_merge($result, permute($new_items, $new_perms));
  }
  return $result;
}
?>