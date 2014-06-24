<?php
function fetchUsers($pdo) {
    $user_data = '';
    $stmt = $pdo->query('SELECT * FROM users');
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $user_data .= '<tr>';
        foreach ($row as $val) {
           $user_data .= '<td>' . $val . '</td>';
        }
        $user_data .= '</td>' . '</tr>';
    }
    return $user_data;
    var_dump($user_data);
}

?>
