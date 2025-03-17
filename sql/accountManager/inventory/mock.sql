INSERT INTO userProfile (username, password, firstName, lastName, email, type)
VALUES
    ('steve_m', '4837dd8fae7348d21ab8b72341bf7dff75f12b7c3e1973ba88e4906c12cdc111', 'Steve', 'Menard', 'steve.m@example.com', 'NORMAL'),
    ('bob_builder', 'f42441fcd0f171463b31be027991dbb6da6ae25b80b7fa185ff91cb010390f78', 'Bob', 'Builder', 'bob.builder@example.com', 'PREMIUM'),
    ('carol_s', '97246bcce130ee7908f6ccf36ed9f721d4849e15b138cf52fa11a25ffd4e594b', 'Carol', 'Smith', 'carol.s@example.com', 'NORMAL'),
    ('david_j', '65008bf00fbc08a733a69e60f704c27b450b8fcec856e8366cd98a3f1b43f288', 'David', 'Jones', 'david.j@example.com', 'PREMIUM'),
    ('eve_l', 'e9079bb6a656e797106c26c334b4569b7c01fbd4a7f13150dd2774ae53e3157a', 'Eve', 'Lewis', 'eve.l@example.com', 'NORMAL');

INSERT INTO token (userId, token)
VALUES
    (1, 'auth_steve_xyz123'),
    (2, 'auth_bob_xyz456'),
    (3, 'auth_carol_xyz789'),
    (4, 'auth_david_xyz101'),
    (5, 'auth_eve_xyz112');


INSERT INTO wallet (userId, balance, amountSpent)
VALUES
    ((SELECT id FROM userProfile WHERE username = 'steve_m'), 100.00, 50.00),
    ((SELECT id FROM userProfile WHERE username = 'bob_builder'), 250.00, 100.00),
    ((SELECT id FROM userProfile WHERE username = 'carol_s'), 500.00, 200.00),
    ((SELECT id FROM userProfile WHERE username = 'david_j'), 150.00, 75.00),
    ((SELECT id FROM userProfile WHERE username = 'eve_l'), 300.00, 150.00);


INSERT INTO transaction (id, userId, name, price, quantity)
VALUES
    (1, 1, 'Book Purchase', 15.99, 1),
    (2, 2, 'Laptop', 999.99, 1),
    (3, 3, 'Coffee', 3.50, 2),
    (4, 4, 'Gym Membership', 49.99, 1),
    (5, 5, 'Headphones', 199.99, 1),
    (6, 1, 'Online Course', 79.99, 1),
    (7, 2, 'Keyboard', 89.99, 1),
    (8, 3, 'Mouse', 29.99, 1);


