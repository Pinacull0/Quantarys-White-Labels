INSERT INTO categories (name, slug) VALUES
  ('Tecnologia', 'tecnologia'),
  ('Acessórios', 'acessorios');

INSERT INTO products (category_id, name, slug, description, price_cents, stock_quantity) VALUES
  (1, 'Smartwatch Pro', 'smartwatch-pro', 'Relógio inteligente premium.', 89990, 25),
  (1, 'Headset Studio', 'headset-studio', 'Headset com áudio imersivo.', 59990, 50),
  (2, 'Keyboard Elite', 'keyboard-elite', 'Teclado mecânico para alta performance.', 45990, 35);
