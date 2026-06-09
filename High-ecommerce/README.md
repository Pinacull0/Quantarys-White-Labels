# High Ecommerce

Ecommerce avançado para white-label usando `Nuxt 3 + TypeScript` no frontend, `Nuxt API` como camada intermediária e `Node.js + TypeScript` no backend principal.

O objetivo do `High-ecommerce` é suportar lojas maiores, SEO, SSR, painel administrativo, integrações externas, checkout robusto, multi-tenant e arquitetura pronta para escala.

## Fluxo Geral

```text
Cliente
  -> Front-end UI Nuxt
  -> Nuxt API
  -> Back-end Node.ts
  -> Banco de dados
```

## Fluxo Detalhado

```text
Front-end UI
  -> pages
  -> components
  -> middlewares
  -> controllers
  -> services
  -> utils

Nuxt API
  -> router
  -> middlewares
  -> controller
  -> service
  -> utils

Back-end Node.ts
  -> routes
  -> middleware
  -> controller
  -> services
  -> utils
  -> config
  -> db
```

## Estrutura

```text
High-ecommerce/
  frontend/
    src/
      pages/
      components/
      middlewares/
      controllers/
      services/
      utils/
      server/
        controller/
        service/
        router/
        utils/
        middlewares/
  backend/
    config/
    utils/
      sanitization.ts
    middleware/
    controller/
    services/
    routes/
    src/
  db/
    schema.sql
    seed.sql
```

## Planejamento do Projeto

### Fase 1: Fundação

- Criar padrões de pastas, imports, tipagem e respostas HTTP.
- Separar `routes`, `controller`, `services`, `middleware`, `utils` e `config`.
- Criar utilitários globais, incluindo `backend/utils/sanitization.ts`.
- Definir contratos iniciais da API.
- Definir schema inicial do banco.

### Fase 2: Storefront

- Implementar home, listagem, busca e detalhes de produto.
- Implementar categorias, filtros e ordenação.
- Preparar SEO via Nuxt.
- Criar camada Nuxt API para adaptar dados ao front-end.

### Fase 3: Carrinho e Checkout

- Implementar carrinho anônimo e autenticado.
- Implementar cálculo de subtotal, frete, desconto e total.
- Implementar checkout em etapas.
- Criar pedido a partir do carrinho.

### Fase 4: Pagamentos

- Integrar provedores de pagamento.
- Criar webhooks.
- Criar conciliação e status de pagamento.
- Implementar reembolso e cancelamento.

### Fase 5: Conta e Administração

- Criar autenticação.
- Criar área do cliente.
- Criar painel admin.
- Criar gestão de produtos, pedidos, clientes, cupons e estoque.

### Fase 6: White-label e Escala

- Adicionar tenants.
- Configurar tema, logo, domínio e regras por loja.
- Adicionar auditoria, logs, métricas e rate limit.
- Preparar cache e filas para operações pesadas.

## Front-end UI

Stack: `Nuxt 3`, `Vue 3` e `TypeScript`.

### Pastas

- `src/pages`: telas públicas e privadas, como home, produto, carrinho, checkout, login, conta e admin.
- `src/components`: blocos visuais reutilizáveis, como vitrines, cards, menus, formulários, drawers e layouts.
- `src/middlewares`: guards de autenticação, sessão, perfil, tenant e permissões.
- `src/controllers`: coordenação das telas, eventos de UI e chamadas aos services.
- `src/services`: chamadas para a `Nuxt API`, nunca diretamente para regras complexas.
- `src/utils`: formatadores, normalizadores, validações e helpers puros.

### Fluxo de desenvolvimento

1. Criar tela em `frontend/src/pages`.
2. Criar componentes reutilizáveis em `frontend/src/components`.
3. Criar controller de tela em `frontend/src/controllers`.
4. Criar service para falar com a `Nuxt API`.
5. Criar utilitários compartilhados em `frontend/src/utils`.
6. Adicionar middleware em `frontend/src/middlewares` quando a página exigir autenticação, tenant ou permissão.

## Nuxt API

A `Nuxt API` funciona como camada BFF, ou seja, uma ponte entre a interface Nuxt e o backend Node.

Ela pode:

- Adaptar respostas para a UI.
- Proteger chamadas sensíveis.
- Centralizar cookies e sessão.
- Evitar expor URLs internas do backend.
- Fazer composição de dados para páginas SSR.

### Pastas

- `src/server/router`: definição e agrupamento das rotas server-side do Nuxt.
- `src/server/middlewares`: autenticação, sessão, tenant e validações antes da rota.
- `src/server/controller`: entrada da requisição da Nuxt API.
- `src/server/service`: comunicação com o backend Node e composição de dados.
- `src/server/utils`: helpers da camada Nuxt API.

### Fluxo de desenvolvimento

1. Criar rota em `frontend/src/server/router`.
2. Aplicar middleware em `frontend/src/server/middlewares`.
3. Criar controller em `frontend/src/server/controller`.
4. Criar service em `frontend/src/server/service`.
5. Encaminhar ou compor dados vindos do backend Node.
6. Retornar resposta já amigável para a UI.

## Back-end Node.ts

Stack: `Node.js`, `Fastify` e `TypeScript`.

### Pastas

- `config`: variáveis de ambiente, conexão com banco, providers e configurações globais.
- `utils`: helpers puros, normalização, sanitização, logs, erros e respostas.
- `middleware`: autenticação, autorização, CORS, rate limit, tenant e observabilidade.
- `controller`: entrada HTTP, chamada de sanitização, chamada de service e resposta.
- `services`: regras de negócio, integrações, pagamentos, pedidos, estoque e usuários.
- `routes`: definição das rotas HTTP e ligação com controllers.
- `src`: entrada atual do servidor.

### Fluxo de desenvolvimento

1. Criar ou atualizar rota em `backend/routes`.
2. Criar controller em `backend/controller`.
3. Sanitizar dados chamando funções de `backend/utils/sanitization.ts`.
4. Criar service em `backend/services`.
5. Adicionar validações e middlewares em `backend/middleware`.
6. Usar configurações em `backend/config`.
7. Persistir e consultar dados no banco.
8. Retornar contrato estável para a `Nuxt API`.

## Regras de Arquitetura do Backend

### Controllers

- Controllers devem ser finos.
- Controllers recebem `request` e `reply`.
- Controllers chamam sanitização pronta em `backend/utils/sanitization.ts`.
- Controllers chamam services.
- Controllers retornam resposta HTTP.
- Controllers não acessam banco diretamente.
- Controllers não chamam APIs externas diretamente.
- Controllers não contêm regra de negócio pesada.
- Controllers não implementam código de sanitização inline.

Exemplo correto:

```ts
const payload = sanitizeCreateProductPayload(request.body);
const product = await productService.create(payload);
return reply.status(201).send(product);
```

Exemplo proibido:

```ts
const name = String(request.body.name).trim().replace(/[<>]/g, '');
```

### Sanitização

- Todo código de sanitização do backend fica em `backend/utils/sanitization.ts`.
- Sanitização remove espaços excedentes, tags indesejadas e caracteres perigosos.
- Sanitização normaliza strings antes do service receber os dados.
- Sanitização não decide regra de negócio.
- Sanitização não consulta banco.
- Sanitização não retorna resposta HTTP.

### Services

- Services concentram regras de negócio.
- Services recebem dados já sanitizados.
- Services validam regras de domínio, como estoque, preço, cupom, tenant e status.
- Services podem chamar repositórios, providers e integrações.
- Services não recebem `request` ou `reply`.
- Services não conhecem detalhes HTTP.

### Routes

- Routes registram endpoints.
- Routes aplicam middlewares quando necessário.
- Routes apontam para controllers.
- Routes não sanitizam dados.
- Routes não executam regra de negócio.

### Middlewares

- Middlewares lidam com contexto da requisição.
- Middlewares fazem autenticação, autorização, tenant, rate limit e CORS.
- Middlewares não executam regra de negócio de ecommerce.
- Middlewares não substituem services.

### Utils

- Utils são funções puras ou quase puras.
- Utils não dependem de Fastify.
- Utils não recebem `request` ou `reply`.
- Utils podem ser testadas isoladamente.

## Banco de Dados

O diretório `db` contém:

- `schema.sql`: estrutura inicial para usuários, categorias, produtos, pedidos, pagamentos e auditoria.
- `seed.sql`: dados iniciais para desenvolvimento.

Entidades base:

- `users`
- `categories`
- `products`
- `orders`
- `order_items`
- `payments`
- `audit_events`

## Módulos do Ecommerce

### Autenticação e Usuários

- Cadastro.
- Login.
- Logout.
- Recuperação de senha.
- Refresh token.
- Perfis de acesso.
- Área do cliente.

### Tenant e White-label

- Loja por tenant.
- Tema por loja.
- Logo por loja.
- Domínio por tenant.
- Configurações de checkout.
- Regras comerciais por tenant.

### Catálogo

- Produtos.
- Categorias.
- Busca.
- Filtros.
- SEO por produto e categoria.
- Produtos relacionados.
- Variações de produto.

### Estoque

- Entrada de estoque.
- Saída de estoque.
- Reserva durante checkout.
- Baixa após pagamento aprovado.
- Reposição e alertas.

### Carrinho

- Carrinho por usuário.
- Carrinho anônimo.
- Cupom.
- Cálculo de subtotal.
- Persistência entre sessões.

### Checkout

- Identificação.
- Endereço.
- Frete.
- Pagamento.
- Antifraude.
- Revisão do pedido.
- Confirmação.

### Pedidos

- Criação.
- Histórico.
- Status.
- Cancelamento.
- Devolução.
- Notificações.

### Pagamentos

- PIX.
- Cartão.
- Boleto.
- Webhooks.
- Conciliação.
- Reembolso.

### Administração

- Produtos.
- Estoque.
- Pedidos.
- Clientes.
- Cupons.
- Relatórios.
- Configurações da loja.

## Endpoints do Backend Node

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
POST /api/v1/auth/refresh
POST /api/v1/auth/forgot-password
POST /api/v1/auth/reset-password
GET  /api/v1/auth/me
```

### Tenants

```text
GET   /api/v1/tenants/current
GET   /api/v1/admin/tenants
POST  /api/v1/admin/tenants
GET   /api/v1/admin/tenants/:tenantId
PATCH /api/v1/admin/tenants/:tenantId
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
POST /api/v1/payments/:paymentId/refund
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

### Inventory

```text
GET  /api/v1/admin/inventory
POST /api/v1/admin/inventory/movements
GET  /api/v1/admin/inventory/movements
```

### Customers

```text
GET   /api/v1/account/profile
PATCH /api/v1/account/profile
GET   /api/v1/account/addresses
POST  /api/v1/account/addresses
PATCH /api/v1/account/addresses/:addressId
DELETE /api/v1/account/addresses/:addressId
```

### Admin Reports

```text
GET /api/v1/admin/reports/sales
GET /api/v1/admin/reports/orders
GET /api/v1/admin/reports/customers
GET /api/v1/admin/reports/products
```

## Endpoints da Nuxt API

A Nuxt API expõe contratos próprios para a UI e encaminha para o backend Node.

```text
GET    /api/storefront/home
GET    /api/storefront/products
GET    /api/storefront/products/:slug
GET    /api/storefront/categories
GET    /api/cart
POST   /api/cart/items
PATCH  /api/cart/items/:itemId
DELETE /api/cart/items/:itemId
POST   /api/checkout/start
POST   /api/checkout/shipping
POST   /api/checkout/coupon
POST   /api/checkout/payment
POST   /api/checkout/confirm
GET    /api/account/profile
GET    /api/account/orders
GET    /api/account/orders/:orderId
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
cd High-ecommerce/frontend
npm install
npm run dev
```

Backend:

```bash
cd High-ecommerce/backend
npm install
npm run dev
```

## Padrões

- `TypeScript` é obrigatório no frontend, na Nuxt API e no backend Node.
- UI chama `Nuxt API`, não o backend Node diretamente.
- `Nuxt API` adapta contratos para a interface.
- Backend Node concentra regra de negócio.
- Controllers são finos e não sanitizam inline.
- Sanitização fica em `backend/utils/sanitization.ts`.
- Services concentram regras de negócio.
- Utils não dependem de framework.
- Middlewares lidam com segurança e contexto.
- Valores monetários devem ser armazenados em centavos.
- IDs em URL usam nomes explícitos, como `productId`, `orderId` e `tenantId`.

## Roadmap

1. Separar Fastify em `routes`, `controller` e `services`.
2. Criar sanitização oficial em `backend/utils/sanitization.ts`.
3. Criar endpoints de catálogo.
4. Criar endpoints de carrinho.
5. Criar checkout completo.
6. Adicionar autenticação.
7. Adicionar multi-tenant white-label.
8. Integrar gateway de pagamento.
9. Criar painel administrativo.
10. Adicionar logs, auditoria e métricas.
