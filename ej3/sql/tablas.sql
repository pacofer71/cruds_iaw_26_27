
CREATE TABLE posts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    categoria ENUM(
        'Tecnología',
        'Hogar',
        'Deportes',
        'Cultura',
        'Alimentación'
    ) NOT NULL,
    disponible ENUM('SI', 'NO') NOT NULL DEFAULT 'SI'
) ENGINE=InnoDB;

INSERT INTO posts (titulo, categoria, disponible) VALUES
('Portátil Lenovo IdeaPad 15', 'Tecnología', 'SI'),
('Ratón inalámbrico Logitech', 'Tecnología', 'SI'),
('Monitor Samsung 27 pulgadas', 'Tecnología', 'NO'),
('Teclado mecánico RGB', 'Tecnología', 'SI'),
('Disco SSD 1TB', 'Tecnología', 'SI'),

('Lámpara de escritorio LED', 'Hogar', 'SI'),
('Silla ergonómica de oficina', 'Hogar', 'SI'),
('Juego de sábanas de algodón', 'Hogar', 'NO'),
('Estantería de madera', 'Hogar', 'SI'),

('Balón de fútbol profesional', 'Deportes', 'SI'),
('Raqueta de tenis', 'Deportes', 'SI'),
('Bicicleta de montaña', 'Deportes', 'NO'),
('Mancuernas ajustables', 'Deportes', 'SI'),

('Novela de misterio', 'Cultura', 'SI'),
('Libro de programación PHP', 'Cultura', 'SI'),
('Colección de cine clásico', 'Cultura', 'NO'),

('Aceite de oliva virgen extra', 'Alimentación', 'SI'),
('Café molido natural', 'Alimentación', 'SI'),
('Miel artesanal', 'Alimentación', 'NO'),
('Chocolate negro 85%', 'Alimentación', 'SI');

-- -----

CREATE TABLE usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

INSERT INTO usuarios (email, password) VALUES
('admin@ejemplo.com', '$2y$12$4yRxsTtcepiZ18WOO2xLguqHuwA9eUOanNUi0RzNli0aEmZcM93uC'),
('ana@ejemplo.com', '$2y$12$4yRxsTtcepiZ18WOO2xLguqHuwA9eUOanNUi0RzNli0aEmZcM93uC'),
('carlos@ejemplo.com', '$2y$12$4yRxsTtcepiZ18WOO2xLguqHuwA9eUOanNUi0RzNli0aEmZcM93uC'),
('lucia@ejemplo.com', '$2y$12$4yRxsTtcepiZ18WOO2xLguqHuwA9eUOanNUi0RzNli0aEmZcM93uC'),
('pedro@ejemplo.com', '$2y$12$4yRxsTtcepiZ18WOO2xLguqHuwA9eUOanNUi0aEmZcM93uC');
