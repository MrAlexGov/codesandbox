<?php

/**
 * Return list of users.
 */
function get_users($conn) {
    $stmt = $conn->prepare("
        SELECT DISTINCT u.id, u.name 
        FROM users u
        JOIN user_accounts ua ON u.id = ua.user_id
        JOIN transactions t ON ua.id = t.account_from OR ua.id = t.account_to
    ");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    return $users;
}

/**
 * Return transactions balances of given user.
 */
function get_user_transactions_balances($user_id, $conn) {
    $stmt = $conn->prepare("
        SELECT strftime('%Y-%m', t.trdate) AS month,
               SUM(CASE WHEN ua.user_id = :user_id AND t.account_to = ua.id THEN t.amount ELSE 0 END) -
               SUM(CASE WHEN ua.user_id = :user_id AND t.account_from = ua.id THEN t.amount ELSE 0 END) AS balance
        FROM transactions t
        JOIN user_accounts ua ON t.account_from = ua.id OR t.account_to = ua.id
        WHERE ua.user_id = :user_id
        GROUP BY month
        ORDER BY month
    ");
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}