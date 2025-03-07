CREATE TABLE users (
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    firstname TEXT NOT NULL,
    lastname TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    type TEXT NOT NULL DEFAULT 'NORMAL' CHECK (type IN ('NORMAL', 'PREMIUM'))
);

CREATE TABLE token (
    id INT PRIMARY KEY,
    user_id INT NOT NULL,
    token TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_used BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE wallet
(
    userId      INT PRIMARY KEY,
    balance     DECIMAL(10, 2) DEFAULT 0.00,
    amountSpent DECIMAL(10, 2) DEFAULT 0.00,
    FOREIGN KEY (userId) REFERENCES users (id)
);

CREATE TABLE transactions (
    id INT PRIMARY KEY,
    user_id INT NOT NULL,
    name TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL,
    done_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)
