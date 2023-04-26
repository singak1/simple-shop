CREATE TABLE IF NOT EXISTS OrderItems
(
    `id`            INT AUTO_INCREMENT PRIMARY KEY,
    `order_id`      INT,
    `product_id`    INT,
    `quantity`      INT,
    `unit_price`    INT,
    Foreign Key (`order_id`) REFERENCES Orders(`id`),
    Foreign Key (`product_id`) REFERENCES Products(`id`),
    check(quantity > 0),
    check(unit_price > 0)
)