-- Criar banco
CREATE DATABASE IF NOT EXISTS runfinder
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE runfinder;

---------------------------------------------------
-- TABELA users
---------------------------------------------------
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('corredor','organizador','admin') NOT NULL DEFAULT 'corredor',
  avatar VARCHAR(255) DEFAULT NULL,
  plan_paid TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

---------------------------------------------------
-- TABELA events
---------------------------------------------------
DROP TABLE IF EXISTS events;
CREATE TABLE events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  organizer_id INT NOT NULL,
  name VARCHAR(150) NOT NULL,
  description TEXT,
  city VARCHAR(100),
  address VARCHAR(150) DEFAULT NULL,
  
  -- PONTO DE PARTIDA
  lat DECIMAL(10,7) NOT NULL,
  lng DECIMAL(10,7) NOT NULL,

  -- PONTO FINAL (OPCIONAL)
  end_lat DECIMAL(10,7) DEFAULT NULL,
  end_lng DECIMAL(10,7) DEFAULT NULL,

  -- DISTÂNCIA EM KM
  distance_km DECIMAL(6,2) DEFAULT NULL,

  -- PREÇO
  price DECIMAL(10,2) NOT NULL DEFAULT 0.00,

  -- STATUS DO EVENTO
  status ENUM('ativo','finalizado','cancelado') NOT NULL DEFAULT 'ativo',

  -- ROTA EM GEOJSON
  route_geojson LONGTEXT,

  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  FOREIGN KEY (organizer_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ÍNDICES PARA OTIMIZAÇÃO
CREATE INDEX idx_event_city ON events(city);
CREATE INDEX idx_event_date ON events(created_at);
CREATE INDEX idx_event_status ON events(status);

---------------------------------------------------
-- TABELA registrations
---------------------------------------------------
DROP TABLE IF EXISTS registrations;
CREATE TABLE registrations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  event_id INT NOT NULL,
  code VARCHAR(10) NOT NULL,
  paid TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  UNIQUE KEY unique_registration (user_id, event_id),

  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

---------------------------------------------------
-- TABELA blogs (opcional no futuro)
---------------------------------------------------
DROP TABLE IF EXISTS blogs;
CREATE TABLE blogs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  author_id INT NOT NULL,
  title VARCHAR(180) NOT NULL,
  content LONGTEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

---------------------------------------------------
-- EVENTO AUTOMÁTICO PARA FINALIZAR EVENTOS EXPIRADOS
---------------------------------------------------
DROP EVENT IF EXISTS update_event_status;
CREATE EVENT update_event_status
  ON SCHEDULE EVERY 1 DAY
  STARTS CURRENT_TIMESTAMP
  DO
    UPDATE events 
    SET status = 'finalizado' 
    WHERE date(created_at) < CURDATE() AND status = 'ativo';

-- Ativar event scheduler
SET GLOBAL event_scheduler = ON;
