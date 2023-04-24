CREATE TABLE IF NOT EXISTS Cart
(
    `id`                INT AUTO_INCREMENT PRIMARY KEY,
    `product_id`        INT,
    `user_id`           INT,
    `desired_quantity`  INT,
    `unit_price`        INT,
    check(desired_quantity > 0),
    check(unit_price > 0),
    Foreign Key (`user_id`) REFERENCES Users(`id`),
    Foreign Key (`product_id`) REFERENCES Products(`id`),
    UNIQUE KEY (`user_id`, `product_id`)
)