CREATE TABLE IF NOT EXISTS Orders
(
    `id`                INT AUTO_INCREMENT PRIMARY KEY,
    `user_id`           INT,
    `created`           TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `total_price`       INT,
    `address`           VARCHAR(255) ,
    `payment_method`    VARCHAR(100) NOT NULL,
    `money_recieved`    INT NOT NULL,
    `first_name`        VARCHAR(32) NOT NULL,
    `last_name`         VARCHAR(32) NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES Users(`id`),
    check(total_price > 0)
)