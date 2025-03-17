CREATE TABLE userProfile(
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    firstName TEXT NOT NULL,
    lastName TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    type TEXT NOT NULL DEFAULT 'NORMAL' CHECK (type IN ('NORMAL', 'PREMIUM'))
);

CREATE TABLE token
(
    userId INT PRIMARY KEY,
    token TEXT NOT NULL UNIQUE,
    createdAt TIMESTAMP DEFAULT now(),
    FOREIGN KEY (userId) REFERENCES userProfile(id)
);



CREATE TABLE wallet
(
    userId      INT PRIMARY KEY,
    balance     DECIMAL(10, 2) DEFAULT 0.00,
    amountSpent DECIMAL(10, 2) DEFAULT 0.00,
    FOREIGN KEY (userId) REFERENCES userProfile(id)
);

CREATE TABLE transaction (
    id INT PRIMARY KEY,
    userId INT NOT NULL,
    name TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL,
    totalPrice DECIMAL(10,2) GENERATED ALWAYS AS (price * quantity) STORED,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userId) REFERENCES userProfile(id)
)
