# Low Ecommerce

Ecommerce enxuto para white-label usando `HTML + CSS + JavaScript` no frontend e `PHP` no backend.

O objetivo do `Low-ecommerce` é entregar uma base simples, organizada e rápida de evoluir para lojas menores, MVPs, catálogos com checkout e operações com baixa complexidade.

## Fluxo Geral

```text
Cliente
  -> Frontend HTML/CSS/JS
  -> Frontend service/controller
  -> Frontend páginas estáticas
  -> Backend PHP routes
  -> Backend controllers
  -> Backend services
  -> Banco de dados
```

## Estrutura

```text
Low-ecommerce/
  frontend/
    home/
      index.html
      style.css
      script.js
    products/
      index.html
      style.css
      script.js
    cart/
      index.html
      style.css
      script.js
    checkout/
      index.html
      style.css
      script.js
    account/
      index.html
      style.css
      script.js
    admin/
      index.html
      style.css
      script.js
    src/
      controller/
      service/
      middlewares/
      utils/
  backend/
    config/
    utils/
      Sanitization.php
    middleware/
    controller/
    services/
    routes/
    public/
    src/
  db/
    schema.sql
    seed.sql
```

## Planejamento do Projeto

### Fase 1: Fundação

- Criar padrões de pastas, respostas JSON e contratos HTTP.
- Separar `routes`, `controller`, `services`, `middleware`, `utils` e `config`.
- Criar utilitários globais, incluindo `backend/utils/Sanitization.php`.
- Definir endpoints essenciais para catálogo, carrinho, checkout e pedidos.
- Definir schema inicial do banco.

### Fase 2: Storefront

- Criar home da loja.
- Criar listagem e detalhe de produtos.
- Criar categorias e filtros simples.
- Criar services do frontend para consumir o backend PHP.

### Fase 3: Carrinho e Checkout

- Criar carrinho por sessão ou cliente.
- Adicionar, remover e alterar itens.
- Calcular subtotal, frete, desconto e total.
- Criar checkout simples e pedido.

### Fase 4: Pagamento e Pedido

- Integrar gateway de pagamento.
- Criar confirmação de pedido.
- Atualizar status do pedido.
- Baixar estoque após confirmação.

### Fase 5: Administração

- Criar login administrativo.
- Criar cadastro de produtos.
- Criar gestão de estoque.
- Criar gestão de pedidos e clientes.

## Frontend

Stack: `HTML`, `CSS` e `JavaScript` sem build obrigatório.

### Pastas

- `home`: página inicial da loja com `index.html`, `style.css` e `script.js`.
- `products`: página de catálogo com `index.html`, `style.css` e `script.js`.
- `cart`: página de carrinho com `index.html`, `style.css` e `script.js`.
- `checkout`: página de checkout com `index.html`, `style.css` e `script.js`.
- `account`: página de conta do cliente com `index.html`, `style.css` e `script.js`.
- `admin`: página administrativa com `index.html`, `style.css` e `script.js`.
- `src/controller`: coordenação entre página, service e manipulação do DOM.
- `src/service`: chamadas HTTP via `fetch` para o backend PHP.
- `src/middlewares`: proteções de navegação, autenticação, permissões e sessão.
- `src/utils`: formatadores, helpers de moeda, validação, storage e funções puras.

### Fluxo de desenvolvimento

1. Criar uma pasta de página em `frontend`, como `frontend/products`.
2. Criar `index.html`, `style.css` e `script.js` dentro da pasta da página.
3. Criar regras da página em `frontend/src/controller`.
4. Criar chamadas HTTP em `frontend/src/service`.
5. Reutilizar validações e formatadores em `frontend/src/utils`.
6. Proteger páginas sensíveis com `frontend/src/middlewares`.
7. Conectar o `script.js` da página ao controller ou service necessário.

## Backend PHP

Stack: `PHP 8.2+`.

### Pastas

- `config`: conexão com banco, variáveis de ambiente, CORS e configurações globais.
- `utils`: respostas JSON, validações, sanitização, helpers de data, moeda e segurança.
- `middleware`: autenticação, autorização, CORS, rate limit e tratamento de erros.
- `controller`: entrada HTTP, chamada de sanitização, chamada de service e resposta.
- `services`: regras de negócio, como catálogo, carrinho, pedido, pagamento e estoque.
- `routes`: definição das rotas HTTP e ligação com controllers.
- `public`: ponto de entrada público da aplicação PHP.
- `src`: código PHP inicial compartilhado.

### Fluxo de desenvolvimento

1. Definir a rota em `backend/routes`.
2. Criar o controller em `backend/controller`.
3. Sanitizar dados chamando funções/classes de `backend/utils/Sanitization.php`.
4. Implementar regra de negócio em `backend/services`.
5. Aplicar validações e segurança em `backend/middleware`.
6. Ler configurações em `backend/config`.
7. Persistir dados usando scripts e migrations em `db`.

## Regras de Arquitetura do Backend

### Controllers

- Controllers devem ser finos.
- Controllers recebem dados da rota/request.
- Controllers chamam sanitização pronta em `backend/utils/Sanitization.php`.
- Controllers chamam services.
- Controllers retornam arrays/respostas para a camada HTTP.
- Controllers não acessam banco diretamente.
- Controllers não chamam APIs externas diretamente.
- Controllers não contêm regra de negócio pesada.
- Controllers não implementam código de sanitização inline.

Exemplo correto:

```php
$payload = Sanitization::sanitizeCreateProductPayload($requestBody);
$product = $productService->create($payload);
return ['data' => $product, 'meta' => []];
```

Exemplo proibido:

```php
$name = trim(strip_tags((string) $requestBody['name']));
```

### Sanitização

- Todo código de sanitização do backend fica em `backend/utils/Sanitization.php`.
- Sanitização remove espaços excedentes, tags indesejadas e caracteres perigosos.
- Sanitização normaliza strings antes do service receber os dados.
- Sanitização não decide regra de negócio.
- Sanitização não consulta banco.
- Sanitização não retorna resposta HTTP.

### Services

- Services concentram regras de negócio.
- Services recebem dados já sanitizados.
- Services validam regras de domínio, como estoque, preço, cupom e status.
- Services podem chamar repositórios, providers e integrações.
- Services não conhecem detalhes HTTP.
- Services não leem `$_GET`, `$_POST`, `$_SERVER` ou `php://input`.

### Routes

- Routes registram endpoints.
- Routes aplicam middlewares quando necessário.
- Routes apontam para controllers.
- Routes não sanitizam dados.
- Routes não executam regra de negócio.

### Middlewares

- Middlewares lidam com contexto da requisição.
- Middlewares fazem autenticação, autorização, CORS, rate limit e tratamento de erros.
- Middlewares não executam regra de negócio de ecommerce.
- Middlewares não substituem services.

### Utils

- Utils são funções puras ou quase puras.
- Utils não dependem da camada HTTP.
- Utils não leem superglobais.
- Utils podem ser testadas isoladamente.

## Banco de Dados

O diretório `db` contém:

- `schema.sql`: estrutura inicial de clientes, produtos, carrinho e pedidos.
- `seed.sql`: dados iniciais para desenvolvimento.

Entidades base:

- `customers`
- `products`
- `carts`
- `cart_items`
- `orders`
- `order_items`

## Módulos do Ecommerce

### Autenticação e Clientes

- Cadastro.
- Login.
- Logout.
- Recuperação de senha.
- Área do cliente.

### Catálogo

- Listagem de produtos.
- Página de produto.
- Categorias.
- Filtros simples.
- Controle de produto ativo/inativo.

### Estoque

- Quantidade disponível.
- Baixa após pedido confirmado.
- Bloqueio de compra sem estoque.

### Carrinho

- Adicionar item.
- Remover item.
- Alterar quantidade.
- Calcular subtotal.
- Aplicar cupom simples.

### Checkout

- Identificação do cliente.
- Endereço de entrega.
- Frete.
- Forma de pagamento.
- Revisão do pedido.
- Confirmação.

### Pedidos

- Criação do pedido.
- Status do pedido.
- Histórico do cliente.
- Cancelamento administrativo.

### Pagamentos

- PIX.
- Cartão.
- Boleto.
- Webhook de confirmação.

### Administração

- Cadastro de produtos.
- Gestão de estoque.
- Gestão de pedidos.
- Gestão de clientes.
- Gestão de cupons.

## Endpoints do Backend PHP

Base sugerida: `/api/v1`.

### Health

```text
GET /health
```

### Auth

```text
POST /api/v1/auth/register
POST /api/v1/auth/login
POST /api/v1/auth/logout
POST /api/v1/auth/forgot-password
POST /api/v1/auth/reset-password
GET  /api/v1/auth/me
```

### Storefront

```text
GET /api/v1/storefront/home
GET /api/v1/storefront/categories
GET /api/v1/storefront/categories/:slug
GET /api/v1/storefront/products
GET /api/v1/storefront/products/:slug
GET /api/v1/storefront/search
```

### Products Admin

```text
GET    /api/v1/admin/products
POST   /api/v1/admin/products
GET    /api/v1/admin/products/:productId
PATCH  /api/v1/admin/products/:productId
DELETE /api/v1/admin/products/:productId
```

### Categories Admin

```text
GET    /api/v1/admin/categories
POST   /api/v1/admin/categories
GET    /api/v1/admin/categories/:categoryId
PATCH  /api/v1/admin/categories/:categoryId
DELETE /api/v1/admin/categories/:categoryId
```

### Cart

```text
GET    /api/v1/cart
POST   /api/v1/cart/items
PATCH  /api/v1/cart/items/:itemId
DELETE /api/v1/cart/items/:itemId
DELETE /api/v1/cart
```

### Checkout

```text
POST /api/v1/checkout/start
POST /api/v1/checkout/shipping
POST /api/v1/checkout/coupon
POST /api/v1/checkout/payment
POST /api/v1/checkout/confirm
```

### Orders

```text
GET   /api/v1/orders
POST  /api/v1/orders
GET   /api/v1/orders/:orderId
PATCH /api/v1/admin/orders/:orderId/status
POST  /api/v1/admin/orders/:orderId/cancel
```

### Payments

```text
POST /api/v1/payments
GET  /api/v1/payments/:paymentId
POST /api/v1/webhooks/payments/:provider
```

### Coupons

```text
GET    /api/v1/admin/coupons
POST   /api/v1/admin/coupons
GET    /api/v1/admin/coupons/:couponId
PATCH  /api/v1/admin/coupons/:couponId
DELETE /api/v1/admin/coupons/:couponId
POST   /api/v1/coupons/validate
```

### Customers

```text
GET    /api/v1/account/profile
PATCH  /api/v1/account/profile
GET    /api/v1/account/addresses
POST   /api/v1/account/addresses
PATCH  /api/v1/account/addresses/:addressId
DELETE /api/v1/account/addresses/:addressId
```

## Contrato de Resposta

### Sucesso

```json
{
  "data": {},
  "meta": {}
}
```

### Erro

```json
{
  "error": {
    "code": "VALIDATION_ERROR",
    "message": "Invalid payload",
    "details": {}
  }
}
```

## Execução

Frontend:

```bash
cd Low-ecommerce/frontend
python3 -m http.server 5173
```

Backend:

```bash
cd Low-ecommerce/backend
composer install
php -S localhost:8080 -t public
```

## Padrões

- Frontend Low usa `HTML`, `CSS` e `JavaScript` sem dependência de build.
- Backend usa `PHP 8.2+`.
- Toda regra de negócio fica em `services`.
- Controllers são finos e não sanitizam inline.
- Sanitização fica em `backend/utils/Sanitization.php`.
- Utils não devem depender da camada HTTP.
- Backend retorna JSON padronizado.
- Banco usa valores monetários em centavos.
- IDs em URL usam nomes explícitos, como `productId`, `orderId` e `customerId`.

## Roadmap

1. Separar rotas PHP por módulo.
2. Criar sanitização oficial em `backend/utils/Sanitization.php`.
3. Criar endpoints de catálogo.
4. Criar endpoints de carrinho.
5. Criar checkout completo.
6. Integrar gateway de pagamento.
7. Adicionar autenticação de cliente e admin.
8. Criar painel administrativo.
