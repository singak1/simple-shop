INSERT INTO Roles(id, name, is_active) VALUES(2, 'Shop Owner', 1) ON DUPLICATE KEY UPDATE name = name;