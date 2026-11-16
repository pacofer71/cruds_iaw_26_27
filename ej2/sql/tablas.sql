CREATE TABLE videojuegos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL UNIQUE,
    descripcion TEXT,
    disponible ENUM('SI', 'NO') NOT NULL DEFAULT 'SI',
    precio DECIMAL(6,2) NOT NULL
);
INSERT INTO videojuegos (nombre, descripcion, disponible, precio) VALUES
('The Witcher 3',
 'Juego de rol de mundo abierto ambientado en un universo de fantasía.',
 'SI', 29.99),

('Elden Ring',
 'Aventura de acción y rol en un enorme mundo de fantasía.',
 'SI', 59.99),

('Red Dead Redemption 2',
 'Aventura ambientada en el Salvaje Oeste americano.',
 'SI', 39.99),

('Cyberpunk 2077',
 'RPG futurista ambientado en la ciudad de Night City.',
 'SI', 49.99),

('God of War Ragnarok',
 'Aventura de acción protagonizada por Kratos y Atreus.',
 'NO', 59.99),

('Minecraft',
 'Videojuego de construcción y exploración con mundos infinitos.',
 'SI', 19.99),

('Grand Theft Auto V',
 'Juego de mundo abierto ambientado en Los Santos.',
 'SI', 24.99),

('Hogwarts Legacy',
 'Aventura de rol ambientada en el universo de Harry Potter.',
 'NO', 44.99),

('Resident Evil 4',
 'Videojuego de terror y supervivencia.',
 'SI', 34.99),

('Baldurs Gate 3',
 'Juego de rol basado en el universo de Dungeons and Dragons.',
 'SI', 59.99);