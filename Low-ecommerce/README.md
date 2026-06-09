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
    index.php
    src/
      config/
      controller/
      service/
      routes/
      middleware/
      utils/
        Sanitization.php
  db/
    schema.sql
    seed.sql
```

## Mapa de Paginas do Ecommerce

Nem todo item de navegacao vira uma pagina propria. Em ecommerce moderno, muitos itens aparecem como filtros, estados, abas ou sessoes dentro de uma mesma pagina. Por exemplo: marcas, departamentos, categorias, subcategorias, colecoes e ofertas podem aparecer como filtros dentro da pagina de busca ou dentro de uma listagem de produtos.

O objetivo deste mapa e definir quais paginas devem existir no `Low-ecommerce` e quais funcoes cada uma precisa cumprir.

### Paginas Publicas de Descoberta

#### Home

Arquivo atual: `frontend/home/index.html`

Funcao:

- Apresentar a loja.
- Destacar campanhas principais.
- Mostrar departamentos ou categorias principais.
- Mostrar produtos em destaque.
- Mostrar mais vendidos.
- Mostrar lancamentos.
- Dar acesso rapido para busca, carrinho, conta e menu.

#### Departamentos

Pagina planejada: `frontend/departments/index.html`

Funcao:

- Listar os departamentos principais da loja.
- Servir como entrada para categorias.
- Exemplo: Moda, Eletronicos, Casa, Beleza, Esporte.
- Nao precisa listar todos os produtos diretamente.

#### Departamento

Pagina planejada: `frontend/department/index.html`

Funcao:

- Exibir um departamento especifico.
- Mostrar categorias daquele departamento.
- Mostrar banners/campanhas relacionadas.
- Mostrar produtos ou colecoes em destaque daquele departamento.
- Pode direcionar o usuario para uma listagem filtrada.

#### Categorias

Pagina planejada: `frontend/categories/index.html`

Funcao:

- Listar categorias principais.
- Pode ser usada como pagina de navegacao geral.
- Ajuda SEO e organizacao do catalogo.

#### Categoria

Pagina planejada: `frontend/category/index.html`

Funcao:

- Exibir uma categoria especifica.
- Mostrar subcategorias.
- Mostrar produtos da categoria.
- Permitir filtros por marca, preco, avaliacao, disponibilidade, colecao e outros atributos.
- Permitir ordenacao por relevancia, menor preco, maior preco, lancamentos e mais vendidos.

#### Subcategoria

Pagina planejada: `frontend/subcategory/index.html`

Funcao:

- Exibir produtos de uma subcategoria especifica.
- Reutilizar a mesma logica visual da pagina de categoria/listagem.
- Permitir filtros e ordenacao.
- Exemplo: `Moda > Feminino > Vestidos`.

#### Colecoes / Campanhas

Pagina planejada: `frontend/collections/index.html`

Funcao:

- Listar colecoes e campanhas ativas.
- Exemplo: Dia dos Namorados, Black Friday, Verao, Volta as Aulas.

#### Colecao / Campanha

Pagina planejada: `frontend/collection/index.html`

Funcao:

- Exibir uma colecao ou campanha especifica.
- Mostrar banner, descricao e produtos participantes.
- Permitir filtros por departamento, categoria, marca, preco e disponibilidade.

#### Marcas

Pagina planejada: `frontend/brands/index.html`

Funcao:

- Listar marcas disponiveis na loja.
- Pode conter busca por marca.
- Pode destacar marcas mais vendidas.

#### Marca

Pagina planejada: `frontend/brand/index.html`

Funcao:

- Exibir uma marca especifica.
- Mostrar descricao da marca.
- Listar produtos daquela marca.
- Permitir filtros por departamento, categoria, subcategoria, colecao, preco e disponibilidade.

#### Ofertas / Sale

Pagina planejada: `frontend/sale/index.html`

Funcao:

- Reunir produtos promocionais.
- Permitir filtros por departamento, categoria, marca, faixa de desconto, preco e disponibilidade.
- Permitir ordenacao por maior desconto, menor preco, maior preco e mais vendidos.

#### Mais Vendidos

Pagina planejada: `frontend/best-sellers/index.html`

Funcao:

- Exibir produtos mais vendidos.
- Permitir recorte por departamento, categoria, marca e periodo.
- Pode ser uma pagina propria ou um estado de listagem com filtro `sort=best_sellers`.

#### Lancamentos

Pagina planejada: `frontend/new-arrivals/index.html`

Funcao:

- Exibir produtos recentes.
- Permitir filtros por departamento, categoria, marca, colecao, preco e disponibilidade.
- Pode ser uma pagina propria ou um estado de listagem com filtro `sort=newest`.

### Paginas de Busca e Listagem

#### Busca

Pagina planejada: `frontend/search/index.html`

Funcao:

- Receber termos digitados pelo usuario.
- Exibir resultados de busca.
- Permitir filtros por departamento, categoria, subcategoria, colecao, marca, preco, desconto, avaliacao e disponibilidade.
- Permitir ordenacao por relevancia, menor preco, maior preco, mais vendidos, lancamentos e maiores descontos.
- Exibir estado vazio quando nenhum produto for encontrado.
- Exibir sugestoes quando o termo tiver erro ou poucos resultados.

Observacao:

- Marcas, departamentos, categorias, subcategorias e colecoes nao precisam virar paginas separadas dentro da busca. Na busca, eles funcionam como filtros aplicados sobre a listagem.

#### Autocomplete da Busca

Funcao planejada dentro do componente de busca.

Nao e uma pagina propria.

Funcao:

- Sugerir produtos enquanto o usuario digita.
- Sugerir categorias, marcas e termos populares.
- Permitir acesso rapido a um produto ou resultado de busca.
- Mostrar historico ou buscas recentes quando fizer sentido.

#### Listagem de Produtos

Arquivo atual: `frontend/products/index.html`

Funcao:

- Exibir grade/lista de produtos.
- Servir como base reutilizavel para categoria, subcategoria, marca, colecao, ofertas, mais vendidos e lancamentos.
- Exibir filtros.
- Exibir ordenacao.
- Exibir quantidade de resultados.
- Permitir paginacao ou botao de carregar mais.
- Permitir adicionar ao carrinho quando o produto nao exigir variacao obrigatoria.

### Paginas de Produto e Compra

#### Detalhe do Produto

Pagina planejada: `frontend/product/index.html`

Funcao:

- Exibir informacoes completas do produto.
- Mostrar galeria de imagens.
- Mostrar preco, promocao, parcelamento e disponibilidade.
- Mostrar variacoes como tamanho, cor, voltagem, material ou modelo.
- Calcular frete por CEP.
- Adicionar ao carrinho.
- Comprar agora.
- Mostrar descricao, especificacoes, avaliacoes, perguntas e produtos relacionados.

#### Carrinho

Arquivo atual: `frontend/cart/index.html`

Funcao:

- Exibir itens adicionados.
- Alterar quantidade.
- Remover produtos.
- Validar estoque.
- Aplicar cupom.
- Estimar frete.
- Mostrar subtotal, descontos, frete e total.
- Direcionar para checkout.

#### Checkout

Arquivo atual: `frontend/checkout/index.html`

Funcao:

- Identificar cliente.
- Permitir compra como visitante quando configurado.
- Coletar dados pessoais.
- Coletar endereco.
- Escolher frete.
- Escolher pagamento.
- Revisar pedido.
- Confirmar compra.

#### Confirmacao de Pedido

Pagina planejada: `frontend/order-confirmation/index.html`

Funcao:

- Confirmar que o pedido foi criado.
- Mostrar numero do pedido.
- Mostrar resumo da compra.
- Mostrar status inicial do pagamento.
- Direcionar para acompanhamento do pedido.

### Paginas de Conta do Cliente

#### Conta

Arquivo atual: `frontend/account/index.html`

Funcao:

- Central do cliente.
- Mostrar atalhos para pedidos, dados pessoais, enderecos e favoritos.

#### Login

Pagina planejada: `frontend/login/index.html`

Funcao:

- Autenticar cliente.
- Permitir recuperacao de senha.
- Direcionar para cadastro.

#### Cadastro

Pagina planejada: `frontend/register/index.html`

Funcao:

- Criar conta de cliente.
- Validar nome, email, telefone e senha.

#### Meus Pedidos

Pagina planejada: `frontend/orders/index.html`

Funcao:

- Listar pedidos do cliente.
- Mostrar status, total e data.
- Permitir acesso ao detalhe do pedido.

#### Detalhe do Pedido

Pagina planejada: `frontend/order/index.html`

Funcao:

- Mostrar itens comprados.
- Mostrar pagamento, entrega, endereco e status.
- Exibir rastreamento quando houver.
- Permitir cancelamento, troca ou devolucao quando aplicavel.

#### Enderecos

Pagina planejada: `frontend/addresses/index.html`

Funcao:

- Listar, criar, editar e remover enderecos do cliente.

#### Favoritos

Pagina planejada: `frontend/wishlist/index.html`

Funcao:

- Listar produtos salvos pelo cliente.
- Permitir mover produto para carrinho.

### Paginas Institucionais e Suporte

#### Sobre

Pagina planejada: `frontend/about/index.html`

Funcao:

- Apresentar a marca, historia e proposta da loja.

#### Contato

Pagina planejada: `frontend/contact/index.html`

Funcao:

- Exibir canais de atendimento.
- Permitir envio de mensagem.

#### FAQ / Ajuda

Pagina planejada: `frontend/help/index.html`

Funcao:

- Responder duvidas frequentes.
- Organizar temas como compra, entrega, pagamento, troca e conta.

#### Entrega e Frete

Pagina planejada: `frontend/shipping/index.html`

Funcao:

- Explicar prazos, transportadoras, regioes atendidas e politicas de frete.

#### Trocas e Devolucoes

Pagina planejada: `frontend/returns/index.html`

Funcao:

- Explicar regras de troca, devolucao e reembolso.

#### Politica de Privacidade

Pagina planejada: `frontend/privacy/index.html`

Funcao:

- Explicar coleta, uso e protecao de dados.

#### Termos de Uso

Pagina planejada: `frontend/terms/index.html`

Funcao:

- Explicar regras de uso da loja.

### Paginas Administrativas

#### Admin

Arquivo atual: `frontend/admin/index.html`

Funcao:

- Servir como entrada administrativa.
- Mostrar resumo de vendas, pedidos, produtos e alertas.

#### Admin Produtos

Pagina planejada: `frontend/admin/products/index.html`

Funcao:

- Listar, criar, editar, ativar, desativar e remover produtos.
- Gerenciar preco, estoque, imagens, categorias, marcas e variacoes.

#### Admin Categorias

Pagina planejada: `frontend/admin/categories/index.html`

Funcao:

- Gerenciar departamentos, categorias e subcategorias.

#### Admin Colecoes / Campanhas

Pagina planejada: `frontend/admin/collections/index.html`

Funcao:

- Criar e editar colecoes, campanhas, banners e vitrines.

#### Admin Marcas

Pagina planejada: `frontend/admin/brands/index.html`

Funcao:

- Criar e editar marcas.

#### Admin Pedidos

Pagina planejada: `frontend/admin/orders/index.html`

Funcao:

- Listar pedidos.
- Filtrar por status, cliente, data e pagamento.
- Atualizar status.
- Cancelar pedido.

#### Admin Clientes

Pagina planejada: `frontend/admin/customers/index.html`

Funcao:

- Listar clientes.
- Visualizar pedidos e dados basicos.

#### Admin Cupons

Pagina planejada: `frontend/admin/coupons/index.html`

Funcao:

- Criar e gerenciar cupons.
- Definir regras de desconto, validade e limite de uso.

#### Admin Estoque

Pagina planejada: `frontend/admin/inventory/index.html`

Funcao:

- Acompanhar estoque.
- Ajustar quantidades.
- Ver produtos com baixo estoque.

### Resumo das Paginas Atuais

Hoje existem 6 paginas no frontend:

- `frontend/home/index.html`
- `frontend/products/index.html`
- `frontend/cart/index.html`
- `frontend/checkout/index.html`
- `frontend/account/index.html`
- `frontend/admin/index.html`

### Resumo das Paginas Planejadas

Paginas publicas e de compra:

- `frontend/home/index.html`
- `frontend/departments/index.html`
- `frontend/department/index.html`
- `frontend/categories/index.html`
- `frontend/category/index.html`
- `frontend/subcategory/index.html`
- `frontend/collections/index.html`
- `frontend/collection/index.html`
- `frontend/brands/index.html`
- `frontend/brand/index.html`
- `frontend/sale/index.html`
- `frontend/best-sellers/index.html`
- `frontend/new-arrivals/index.html`
- `frontend/search/index.html`
- `frontend/products/index.html`
- `frontend/product/index.html`
- `frontend/cart/index.html`
- `frontend/checkout/index.html`
- `frontend/order-confirmation/index.html`

Paginas de conta:

- `frontend/account/index.html`
- `frontend/login/index.html`
- `frontend/register/index.html`
- `frontend/orders/index.html`
- `frontend/order/index.html`
- `frontend/addresses/index.html`
- `frontend/wishlist/index.html`

Paginas institucionais:

- `frontend/about/index.html`
- `frontend/contact/index.html`
- `frontend/help/index.html`
- `frontend/shipping/index.html`
- `frontend/returns/index.html`
- `frontend/privacy/index.html`
- `frontend/terms/index.html`

Paginas administrativas:

- `frontend/admin/index.html`
- `frontend/admin/products/index.html`
- `frontend/admin/categories/index.html`
- `frontend/admin/collections/index.html`
- `frontend/admin/brands/index.html`
- `frontend/admin/orders/index.html`
- `frontend/admin/customers/index.html`
- `frontend/admin/coupons/index.html`
- `frontend/admin/inventory/index.html`

## Regras de Arquitetura do Frontend

O frontend do `Low-ecommerce` deve continuar simples, sem build obrigatorio, mas precisa seguir regras claras para nao virar um conjunto de paginas isoladas e dificeis de manter.

### Paginas

- Cada pagina deve ficar em uma pasta propria dentro de `frontend`.
- Cada pagina deve ter, no minimo, `index.html`, `style.css` e `script.js`.
- O `index.html` define estrutura semantica, containers e pontos de montagem.
- O `style.css` define somente estilos daquela pagina, exceto quando existir um arquivo global.
- O `script.js` da pagina controla DOM, eventos, criacao de componentes e renderizacao.
- Paginas nao devem conter regra de negocio complexa.
- Paginas nao devem repetir logica que ja existe em controller, service ou utils.
- Paginas devem ter estados de carregamento, erro e vazio quando consumirem dados dinamicos.
- Paginas e controllers nao devem usar `innerHTML`, `outerHTML` ou `insertAdjacentHTML` para renderizar dados.
- Renderizacao deve usar `createElement`, `textContent`, `setAttribute`, `dataset`, `append` e `replaceChildren`.

Exemplo correto:

```js
import { renderProductListPage } from '../src/controller/product-list-controller.js';

renderProductListPage({
  targetSelector: '#product-list',
  context: 'category'
});
```

Exemplo proibido:

```js
const response = await fetch('http://localhost:8080/products');
const products = await response.json();
console.log(products);
```

### Controllers

- Controllers ficam em `frontend/src/controller`.
- Controllers devem ter nome da funcionalidade que executam, como `loginController.js` ou `products/allProductsController.js`.
- Controllers nao manipulam DOM.
- Controllers nao criam componentes.
- Controllers nao usam `document.querySelector`, `createElement`, `append`, `replaceChildren` ou eventos de tela.
- Controllers recebem valores enviados pelo `script.js` da pagina.
- Controllers podem chamar services.
- Controllers podem chamar sanitizadores e validadores especificos em `utils`.
- Controllers nao devem montar URLs de API manualmente.
- Controllers nao devem repetir chamadas HTTP ja existentes em services.
- Controllers nao devem conter regra de negocio pesada.
- Controllers nao devem conter formatacao monetaria, validacao complexa ou manipulacao de storage inline.
- Controllers devem chamar funcoes de sanitizacao em `frontend/src/utils/sanitizations.js`.
- Controllers nao devem declarar funcoes de sanitizacao inline.
- Controllers devem retornar para o `script.js` um objeto de sucesso ou erro.
- Quando a funcionalidade nao precisar enviar dados ao service, o controller nao deve criar payload.

Exemplo correto:

```js
export async function searchProductsController(values) {
  const filters = sanitizeSearchFilters(values);
  return searchProductsService(filters);
}
```

Exemplo proibido:

```js
const response = await fetch(`http://localhost:8080/products?brand=${brand}&category=${category}`);
```

### Services

- Services ficam em `frontend/src/service`.
- Services devem ter nome da funcionalidade que executam, como `loginService.js` ou `products/allProductsService.js`.
- Services concentram chamadas HTTP para o backend.
- Services devem fazer o proprio `fetch` dentro do arquivo da funcionalidade.
- Services nao devem depender de helper generico de request nesta fase.
- Services devem receber parametros simples e retornar dados para controllers.
- Services nao manipulam DOM.
- Services nao leem elementos HTML.
- Services nao exibem alertas.
- Services nao formatam valores para exibicao.
- Services de uma funcionalidade nao devem ser renomeados de forma generica, como `product-service.js`.

Exemplo correto:

```js
export async function searchProducts(filters = {}) {
  const response = await fetch('http://localhost:8080/api/v1/storefront/search', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    credentials: 'include',
    body: JSON.stringify(filters)
  });

  const payload = await response.json();

  return payload.data ?? [];
}
```

### Utils

- Utils ficam em `frontend/src/utils`.
- Utils devem ser funcoes puras ou quase puras.
- Utils podem formatar moeda, datas, slugs, mensagens e validacoes simples.
- Sanitizacoes do frontend ficam em `frontend/src/utils/sanitizations.js`.
- Sanitizacoes nao devem ser genericas quando o campo tiver regra propria.
- Email deve validar formato de email, tamanho maximo e caracteres perigosos.
- Senha deve validar tamanho maximo e caracteres perigosos.
- Checkbox deve aceitar apenas valores booleanos ou equivalentes controlados.
- Sanitizacoes devem reduzir riscos de XSS, SQL injection, caracteres de controle e payloads excessivos.
- Utils nao devem depender de uma pagina especifica.
- Utils nao devem manipular DOM, exceto quando forem explicitamente helpers de DOM.
- Utils nao devem chamar API diretamente, exceto `api.js`.

### Middlewares

- Middlewares ficam em `frontend/src/middlewares`.
- Verificacao de sessao deve se chamar `sessionVerify.js`.
- Login nao deve ficar em middleware; login deve usar `loginController.js` e `loginService.js`.
- Middlewares protegem paginas sensiveis.
- Middlewares validam contexto de sessao, autenticacao, permissao e perfil.
- Middlewares nao renderizam pagina completa.
- Middlewares nao executam regra de ecommerce.

Exemplo:

- `requireCustomerAuth` protege conta, pedidos, enderecos e favoritos.
- `requireAdminAuth` protege paginas administrativas.

### Listagens

- A listagem de produtos deve ser reutilizavel.
- Categoria, subcategoria, marca, colecao, ofertas, mais vendidos, lancamentos e busca devem reaproveitar a mesma base de listagem sempre que possivel.
- A diferenca entre essas paginas deve ser o contexto, filtros iniciais, titulo, banner e endpoint/parametros.
- Listagens devem suportar filtros, ordenacao, paginacao e estado vazio.
- Listagens devem mostrar quantidade de resultados quando o backend retornar essa informacao.

Contextos previstos:

- `all_products`
- `department`
- `category`
- `subcategory`
- `brand`
- `collection`
- `sale`
- `best_sellers`
- `new_arrivals`
- `search`

### Filtros

- Filtros nao sao paginas por padrao.
- Filtros sao estados aplicados a uma listagem.
- Filtros, IDs, slugs, ordenacao e paginacao nunca devem ser enviados para o backend pela URL.
- Tudo que o backend precisa receber deve ser enviado no body da requisicao.
- A URL do frontend pode representar estado visual da tela quando for necessario, mas o service deve converter esse estado em body antes de chamar a API.
- Filtros devem ser removiveis individualmente.
- Filtros devem suportar multiplos valores quando fizer sentido.

Filtros base:

- departamento
- categoria
- subcategoria
- marca
- colecao
- preco minimo
- preco maximo
- desconto
- avaliacao
- disponibilidade
- atributos especificos do produto

Exemplo de body:

```json
{
  "q": "tenis",
  "department": "moda",
  "category": "calcados",
  "brand": "marca-x",
  "min_price": 10000,
  "max_price": 30000,
  "sort": "relevance",
  "page": 1,
  "per_page": 24
}
```

### Busca

- Busca deve ser uma pagina propria em `frontend/search/index.html`.
- Busca deve enviar o termo para o backend pelo body.
- Busca deve aplicar filtros da mesma forma que outras listagens.
- Busca deve mostrar sugestoes quando nao houver resultado.
- Busca deve manter o termo pesquisado visivel no campo de busca.

### Autocomplete

- Autocomplete nao e pagina.
- Autocomplete e componente/comportamento ligado ao campo de busca.
- Deve sugerir produtos, categorias, marcas e termos populares.
- Deve ter estado vazio.
- Deve permitir navegacao por teclado quando possivel.
- Deve chamar service proprio quando houver endpoint de sugestoes.

### Produto

- A pagina de produto deve usar controller proprio.
- A pagina de produto deve buscar dados por `slug` ou `productId`.
- A pagina de produto deve validar variacoes obrigatorias antes de adicionar ao carrinho.
- A pagina de produto nao deve calcular regra de estoque sozinha; deve respeitar o retorno do backend.
- A pagina de produto pode calcular exibicao de parcelas e frete quando o backend fornecer as bases.

### Carrinho

- Carrinho deve ser controlado por service proprio.
- Carrinho pode usar storage local apenas como suporte temporario enquanto nao houver backend completo.
- O total do pedido deve vir do backend quando houver regra de desconto, frete ou estoque.
- A pagina do carrinho deve permitir alterar quantidade, remover item, aplicar cupom e seguir para checkout.

### Checkout

- Checkout deve ser separado em etapas logicas.
- Checkout nao deve confiar apenas nos valores calculados no frontend.
- Checkout deve validar dados pessoais, endereco, frete e pagamento.
- Checkout deve criar pedido no backend.
- Checkout deve redirecionar para confirmacao de pedido apos sucesso.

### Conta do Cliente

- Paginas de conta devem ser protegidas por middleware de autenticacao.
- Conta, pedidos, enderecos e favoritos devem usar services proprios.
- Dados sensiveis nao devem ficar expostos em storage local.
- A pagina de pedidos deve carregar dados do cliente autenticado.

### Admin

- Paginas administrativas devem ser protegidas por middleware de admin.
- Admin deve usar services separados dos services publicos quando os endpoints forem administrativos.
- Admin nao deve compartilhar regras de permissao com paginas publicas.
- Admin produtos deve controlar cadastro, edicao, estoque, categorias, marcas, imagens e variacoes.
- Admin pedidos deve controlar status, cancelamento e filtros operacionais.

### Componentes Reutilizaveis

Mesmo sem framework, comportamentos repetidos devem ser isolados em controllers, utils ou componentes JS simples.

Componentes previstos:

- header
- menu de departamentos
- campo de busca
- autocomplete
- card de produto
- filtros de listagem
- ordenacao
- paginacao/carregar mais
- mini cart
- resumo do pedido
- mensagens de erro/sucesso

### Nomes e URLs

- Pastas devem usar nomes em ingles, minusculos e com hifen quando necessario.
- Slugs devem ser usados para paginas publicas sempre que possivel.
- IDs podem ser usados em admin ou operacoes internas.
- URLs publicas devem ser legiveis.

Exemplos:

```text
/category/moda
/subcategory/vestidos
/brand/marca-x
/collection/black-friday
/product/camiseta-essential
```

### Ordem Inicial de Implementacao

Para evoluir o projeto sem pular etapas, a ordem sugerida e:

1. Criar base reutilizavel de listagem de produtos.
2. Criar pagina de busca com filtros.
3. Criar pagina de detalhe do produto.
4. Criar departamentos, categorias e subcategorias usando a mesma base de listagem.
5. Criar marcas, colecoes, sale, mais vendidos e lancamentos.
6. Evoluir carrinho.
7. Evoluir checkout.
8. Evoluir conta do cliente.
9. Evoluir admin.

## Planejamento do Projeto em 15 Etapas

Este plano define a construcao do `Low-ecommerce` em etapas operacionais. Cada etapa deve descrever pagina, campos, controllers, services, endpoints, middlewares, regras de banco e retorno esperado. Nenhuma etapa deve enviar dados ao backend por URL; tudo que a API precisar receber deve ir no body.

### Etapa 1: Base Tecnica, Router e Contratos

Objetivo:

- Preparar o projeto para todas as etapas seguintes.
- Garantir que o backend aceite rotas estaveis sem `/:id`, `/:slug` ou query string.
- Garantir que frontend e backend falem no mesmo contrato.

Fluxo:

- O frontend chama services especificos da funcionalidade.
- O service sempre envia body quando houver qualquer dado.
- A API PHP recebe a requisicao no router.
- O router le o body uma unica vez.
- O router passa o body para middlewares e controller.
- O controller backend sanitiza pelo `Sanitization.php`.
- O service backend executa regra de negocio.
- A resposta sempre volta como `{ "data": {}, "meta": {} }` ou `{ "error": {} }`.

Entregas:

- Router com suporte a `GET`, `POST`, `PATCH` e metodo de erro padronizado.
- Helper de resposta JSON.
- Helper de leitura de body.
- Erro padrao para rota inexistente.
- Erro padrao para payload invalido.
- CORS configurado.
- Services frontend preparados com `fetch` proprio para `GET`, `POST` e `PATCH`.

### Etapa 2: Banco de Dados, Config e Seeds

Objetivo:

- Criar a base de dados necessaria para catalogo, clientes, admin, carrinho, pedidos e pagamentos.
- Evitar regra de banco dentro de controllers.

Fluxo:

- O backend carrega configuracao em `backend/src/config`.
- O service solicita dados para repository ou camada equivalente.
- O repository acessa o banco.
- O banco retorna registros para o service.
- O service transforma dados em resposta de dominio.
- O controller retorna JSON padronizado.

Entregas:

- Tabelas de `admin_users`, `customers`, `customer_addresses` e `sessions`.
- Tabelas de `departments`, `categories`, `subcategories`, `brands`, `collections`.
- Tabelas de `products`, `product_images`, `product_variants`, `inventory`.
- Tabelas de `carts`, `cart_items`, `coupons`, `orders`, `order_items`, `payments`.
- Seeds de admin, categorias, marcas, colecoes e produtos.
- Conexao de banco em `backend/src/config`.

### Etapa 3: Segurança Base, Sanitização e Middlewares

Objetivo:

- Criar a base de seguranca antes de telas sensiveis.
- Centralizar sanitizacao, rate-limit, sessao e permissao.

Fluxo:

- A rota recebe body.
- O middleware de CORS valida origem e metodo.
- O middleware de rate-limit valida limite por IP, sessao ou email quando existir.
- O middleware de autenticacao valida cookie de sessao quando a rota exigir.
- O middleware de admin valida permissao administrativa quando a rota exigir.
- O controller recebe somente payload permitido.
- O controller sanitiza pelo `Sanitization.php`.
- O service valida regra de negocio.

Entregas:

- `backend/src/utils/Sanitization.php` com sanitizadores por payload.
- Middleware de rate-limit.
- Middleware de sessao de cliente.
- Middleware de sessao admin.
- Middleware de permissao admin.
- Utilitario de cookie seguro com assinatura HMAC.
- Padrao de senha com `password_hash` e `password_verify`.

### Etapa 4: Página de Login Admin

Objetivo:

- Criar a primeira tela administrativa segura.
- Permitir que o admin autentique e receba cookie de sessao assinado com HMAC.

Página:

- `frontend/admin/login/index.html`

Campos:

- Email.
- Senha.
- Checkbox `manter conectado`.
- Botao `Enviar`.

Fluxo:

- Ao clicar em `Enviar`, o `script.js` chama o controller de login admin.
- O `script.js` coleta email, senha e `manter conectado`.
- O `script.js` envia os valores para o controller frontend.
- O controller frontend chama os sanitizadores especificos de email, senha e checkbox em `frontend/src/utils/sanitizations.js`.
- O controller frontend chama o service admin auth.
- O service envia `POST /api/v1/admin/auth/login` com email, senha e `remember` no body.
- A API passa pelo middleware de CORS.
- A API passa pelo middleware de rate-limit.
- A rota chama o controller backend de admin auth.
- O controller backend sanitiza o payload com `Sanitization.php`.
- O controller backend envia os dados ao service.
- O service busca o admin no banco pelo email.
- O service valida se o admin esta ativo.
- O service valida a senha com `password_verify`.
- Se a validacao falhar, retorna erro padrao sem revelar se email ou senha esta incorreto.
- Se a validacao passar, gera sessao no banco.
- O service gera cookie de sessao seguro, `HttpOnly`, `Secure`, `SameSite` e assinado com HMAC.
- Se `manter conectado` estiver marcado, a sessao recebe expiracao maior.
- O backend retorna dados basicos do admin e permissao.
- O frontend redireciona para `frontend/admin/index.html`.

Entregas:

- Página de login admin.
- Controller frontend de login admin.
- Service frontend de admin auth.
- Endpoint `POST /api/v1/admin/auth/login`.
- Controller backend de admin auth.
- Service backend de admin auth.
- Middleware de rate-limit aplicado.
- Cookie de sessao admin assinado com HMAC.

### Etapa 5: Admin Dashboard e Logout

Objetivo:

- Criar a entrada administrativa apos login.
- Permitir encerrar sessao com seguranca.

Página:

- `frontend/admin/index.html`

Campos e componentes:

- Cards de resumo: pedidos, vendas, produtos, baixo estoque.
- Menu para produtos, categorias, marcas, colecoes, pedidos, clientes e cupons.
- Botao `Sair`.

Fluxo:

- Ao abrir a pagina admin, o middleware frontend `requireAdminAuth` chama service de sessao.
- O service envia `POST /api/v1/admin/auth/me` com body vazio.
- A API passa pelo middleware de sessao admin.
- O middleware valida cookie, HMAC, expiracao e sessao no banco.
- O controller backend retorna dados do admin.
- O controller frontend devolve os dados do dashboard para o `script.js`.
- O `script.js` renderiza dashboard.
- Ao clicar em `Sair`, o controller chama service de logout.
- O service envia `POST /api/v1/admin/auth/logout`.
- O backend invalida sessao no banco.
- O backend limpa cookie.
- O frontend redireciona para login admin.

Entregas:

- Dashboard admin inicial.
- Protecao frontend de rota admin.
- Endpoint `POST /api/v1/admin/auth/me`.
- Endpoint `POST /api/v1/admin/auth/logout`.
- Cards com dados vindos do backend.

### Etapa 6: Admin de Catálogo Base

Objetivo:

- Permitir cadastrar a estrutura do catalogo antes dos produtos.
- Criar departamentos, categorias, subcategorias, marcas e colecoes.

Páginas:

- `frontend/admin/departments/index.html`
- `frontend/admin/categories/index.html`
- `frontend/admin/subcategories/index.html`
- `frontend/admin/brands/index.html`
- `frontend/admin/collections/index.html`

Campos:

- Nome.
- Slug.
- Descricao.
- Status ativo/inativo.
- Ordem de exibicao.
- Relacionamentos: categoria pertence a departamento; subcategoria pertence a categoria; colecao pode conter produtos.

Fluxo:

- A pagina carrega e chama controller admin correspondente.
- O controller solicita lista pelo service.
- O service envia body com filtros, pagina e limite.
- A API passa por sessao admin e permissao.
- O controller backend sanitiza body.
- O service backend consulta banco.
- A resposta retorna lista e meta de paginacao.
- Ao criar ou editar, o controller frontend sanitiza campos.
- O service envia create/update no body.
- O backend sanitiza novamente.
- O service valida unicidade de slug, status e relacionamentos.
- O banco salva os dados.

Entregas:

- CRUD admin de departamentos.
- CRUD admin de categorias.
- CRUD admin de subcategorias.
- CRUD admin de marcas.
- CRUD admin de colecoes.
- Validacao de slug unico.

### Etapa 7: Admin de Produtos, Imagens, Variações e Estoque

Objetivo:

- Permitir cadastro completo de produtos.
- Controlar imagens, variacoes e estoque.

Página:

- `frontend/admin/products/index.html`

Campos:

- Nome, slug, descricao curta, descricao completa.
- Departamento, categoria, subcategoria, marca e colecoes.
- Preco em centavos.
- Preco promocional em centavos.
- Status ativo/inativo.
- Imagens.
- Variacoes como tamanho, cor, voltagem, material ou modelo.
- Estoque por produto ou por variacao.

Fluxo:

- A pagina lista produtos usando controller admin products.
- O controller envia filtros para o service.
- O service envia `POST /api/v1/admin/products/list` com body.
- A API passa por sessao admin e permissao.
- O controller backend sanitiza filtros.
- O service consulta produtos no banco.
- Ao salvar produto, o controller frontend sanitiza campos.
- O service envia `POST /api/v1/admin/products/create` ou `PATCH /api/v1/admin/products/update`.
- O backend sanitiza o payload.
- O service valida nome, slug, preco, relacionamentos e status.
- O service salva produto.
- Imagens sao enviadas por endpoint proprio.
- Variacoes sao criadas por endpoint proprio.
- Estoque e atualizado por endpoint proprio.

Entregas:

- CRUD admin de produtos.
- Upload ou cadastro de imagens.
- CRUD de variacoes.
- Ajuste de estoque.
- Produto ativo aparecendo no catalogo publico.

### Etapa 8: Storefront Home e Menu de Navegação

Objetivo:

- Criar a entrada publica da loja.
- Exibir departamentos, categorias principais, campanhas, mais vendidos e lancamentos.

Página:

- `frontend/home/index.html`

Componentes:

- Header.
- Campo de busca.
- Menu de departamentos.
- Vitrine de campanhas.
- Vitrine de categorias.
- Vitrine de mais vendidos.
- Vitrine de lancamentos.

Fluxo:

- Ao carregar a home, o `script.js` chama o controller home.
- O controller chama service storefront.
- O service chama `GET /api/v1/storefront/home` quando nao houver body necessario.
- Para menus dinamicos, o service chama `GET /api/v1/storefront/menu`.
- A API monta dados publicos no service backend.
- O backend retorna vitrines e navegacao.
- O controller frontend devolve os blocos para o `script.js`.
- O `script.js` renderiza as secoes.
- Erros exibem estado de falha sem quebrar a pagina.

Entregas:

- Home publica com dados reais.
- Header compartilhavel.
- Menu de departamentos.
- Vitrines com produtos do banco.

### Etapa 9: Listagem Pública Reutilizável

Objetivo:

- Criar uma base unica de listagem para produtos.
- Reusar essa base em departamentos, categorias, subcategorias, marcas, colecoes, sale, mais vendidos e lancamentos.

Páginas:

- `frontend/products/index.html`
- `frontend/department/index.html`
- `frontend/category/index.html`
- `frontend/subcategory/index.html`
- `frontend/brand/index.html`
- `frontend/collection/index.html`
- `frontend/sale/index.html`
- `frontend/best-sellers/index.html`
- `frontend/new-arrivals/index.html`

Fluxo:

- A pagina define um contexto, como `category`, `brand` ou `sale`.
- O controller de listagem le o estado visual da pagina.
- O controller sanitiza filtros, ordenacao e paginacao.
- O controller chama service de produtos.
- O service envia `POST /api/v1/storefront/products/list` com body.
- A API passa por middlewares publicos.
- O controller backend sanitiza payload.
- O service backend valida filtros permitidos.
- O service consulta banco.
- O backend retorna produtos, filtros disponiveis e meta de paginacao.
- O controller frontend devolve produtos, filtros, ordenacao e paginacao para o `script.js`.
- O `script.js` renderiza cards, filtros, ordenacao e paginacao.

Entregas:

- Controller reutilizavel de listagem.
- Card de produto reutilizavel.
- Filtros por departamento, categoria, subcategoria, marca, colecao, preco, desconto, avaliacao e disponibilidade.
- Ordenacao por relevancia, menor preco, maior preco, mais vendidos, lancamentos e desconto.
- Estado vazio e erro.

### Etapa 10: Busca e Autocomplete

Objetivo:

- Criar busca com sugestoes e filtros.
- Tratar autocomplete como componente, nao como pagina.

Página:

- `frontend/search/index.html`

Componente:

- Campo de busca com autocomplete.

Fluxo:

- Ao digitar no campo, o controller de autocomplete sanitiza o termo.
- O controller chama service de sugestoes.
- O service envia `POST /api/v1/storefront/search/suggestions` com termo no body.
- A API passa por rate-limit publico.
- O controller backend sanitiza o termo.
- O service busca sugestoes de produtos, marcas, categorias e termos populares.
- O frontend renderiza sugestoes.
- Ao enviar a busca, o controller chama service de busca.
- O service envia `POST /api/v1/storefront/search` com termo, filtros, ordenacao e paginacao no body.
- A resposta reutiliza a renderizacao da listagem publica.

Entregas:

- Pagina de busca.
- Autocomplete.
- Sugestoes.
- Filtros na busca.
- Estado sem resultado com sugestoes alternativas.

### Etapa 11: Detalhe do Produto

Objetivo:

- Criar pagina completa de produto.
- Permitir selecao de variacoes antes do carrinho.

Página:

- `frontend/product/index.html`

Campos e componentes:

- Galeria de imagens.
- Nome, preco, promocao e parcelamento.
- Variacoes.
- CEP para frete.
- Descricao e especificacoes.
- Reviews.
- Perguntas.
- Produtos relacionados.
- Botao `Adicionar ao carrinho`.
- Botao `Comprar agora`.

Fluxo:

- A pagina recebe contexto visual do produto pelo frontend.
- O controller sanitiza o identificador visual.
- O service envia `POST /api/v1/storefront/products/detail` com `product_slug` ou `product_id` no body.
- A API sanitiza payload.
- O service backend busca produto ativo no banco.
- O frontend renderiza produto.
- Ao selecionar variacao, o controller valida se todas as opcoes obrigatorias foram escolhidas.
- Ao calcular frete, o service envia CEP e produto no body.
- Ao adicionar ao carrinho, o controller envia produto, variacao e quantidade ao cart service.

Entregas:

- Pagina de produto.
- Variacoes obrigatorias.
- Simulacao de frete.
- Reviews e perguntas em leitura.
- Produtos relacionados.

### Etapa 12: Carrinho

Objetivo:

- Criar carrinho validado pelo backend.
- Evitar que o frontend seja fonte de verdade para total, desconto e estoque.

Página:

- `frontend/cart/index.html`

Campos e componentes:

- Lista de itens.
- Quantidade.
- Remover item.
- Cupom.
- CEP/frete.
- Resumo de valores.
- Botao `Finalizar compra`.

Fluxo:

- A pagina chama controller cart.
- O controller chama service cart.
- O service envia `POST /api/v1/cart/get` com identificacao de sessao no cookie.
- A API passa por middleware de sessao de carrinho.
- O backend busca carrinho no banco.
- Ao adicionar item, o frontend envia produto, variacao e quantidade no body.
- O backend sanitiza, valida estoque e preco atual.
- O service atualiza carrinho.
- Ao alterar quantidade, o backend recalcula subtotal.
- Ao aplicar cupom, o backend valida regra do cupom.
- Ao calcular frete, o backend valida CEP e itens.
- O backend retorna totais finais.

Entregas:

- Carrinho persistido.
- Adicionar, atualizar, remover e limpar itens.
- Cupom.
- Frete.
- Totais calculados pelo backend.

### Etapa 13: Checkout, Pedido e Confirmação

Objetivo:

- Criar fluxo de compra completo.
- Gerar pedido a partir do carrinho.

Páginas:

- `frontend/checkout/index.html`
- `frontend/order-confirmation/index.html`

Campos:

- Email ou cliente logado.
- Nome, documento e telefone.
- Endereco.
- Frete.
- Cupom.
- Forma de pagamento.
- Revisao do pedido.

Fluxo:

- O controller checkout inicia com `POST /api/v1/checkout/start`.
- O backend valida carrinho, estoque e precos.
- A cada etapa, o controller sanitiza campos e chama service.
- O service envia body para customer, address, shipping, coupon e payment.
- A API passa por rate-limit e sessao de checkout.
- Controllers backend sanitizam payloads.
- Services backend validam dados, estoque, frete, cupom e pagamento.
- Ao confirmar, o service cria pedido no banco.
- O service cria itens do pedido.
- O service reserva ou baixa estoque conforme regra definida.
- O service cria pagamento ou pendencia de pagamento.
- O backend retorna numero do pedido.
- O frontend redireciona para confirmacao.

Entregas:

- Checkout por etapas.
- Criacao de pedido.
- Confirmacao de pedido.
- Resumo final.
- Estoque validado.

### Etapa 14: Conta do Cliente e Pós-Compra

Objetivo:

- Criar area do cliente e acompanhamento apos compra.
- Proteger dados do cliente por sessao.

Páginas:

- `frontend/login/index.html`
- `frontend/register/index.html`
- `frontend/account/index.html`
- `frontend/orders/index.html`
- `frontend/order/index.html`
- `frontend/addresses/index.html`
- `frontend/wishlist/index.html`

Fluxo:

- Cadastro coleta nome, email, telefone e senha.
- Controller frontend sanitiza campos.
- Service envia body para auth register.
- Backend passa por rate-limit.
- Controller backend sanitiza.
- Service valida email unico e gera `password_hash`.
- Login valida senha com `password_verify`.
- Sessao de cliente usa cookie seguro assinado com HMAC.
- Paginas de conta passam por middleware `requireCustomerAuth`.
- Pedidos sao carregados pelo service com body.
- Enderecos sao criados, editados e removidos com body.
- Favoritos adicionam e removem produtos com body.

Entregas:

- Login e cadastro de cliente.
- Sessao de cliente.
- Perfil.
- Enderecos.
- Meus pedidos.
- Detalhe do pedido.
- Favoritos.
- Rastreamento e solicitacoes de pos-compra.

### Etapa 15: Pagamentos, Admin Operacional e Produção

Objetivo:

- Fechar a operacao da loja.
- Preparar pagamentos, webhooks, pedidos, estoque, cupons, frete, qualidade e deploy.

Páginas administrativas:

- `frontend/admin/orders/index.html`
- `frontend/admin/customers/index.html`
- `frontend/admin/coupons/index.html`
- `frontend/admin/inventory/index.html`
- `frontend/admin/shipping-methods/index.html`
- `frontend/admin/settings/index.html`

Fluxo:

- Admin pedidos lista pedidos com filtros enviados no body.
- Backend valida sessao admin e permissao.
- Controller backend sanitiza filtros.
- Service consulta pedidos e retorna meta.
- Atualizar status envia orderId e status no body.
- Cancelar ou estornar pedido envia orderId e motivo no body.
- Webhook de pagamento recebe provider, paymentId, status e assinatura no body.
- Middleware valida assinatura do webhook.
- Service atualiza pagamento e pedido.
- Estoque baixo e ajustes de estoque passam por endpoints admin.
- Cupons sao criados com regras de validade, uso e desconto.
- Frete recebe regras administrativas.
- Configuracoes gerais controlam nome da loja, meios de pagamento, politica de checkout e dados publicos.

Entregas:

- Admin operacional.
- Pagamentos e webhooks.
- Estoque operacional.
- Cupons.
- Frete.
- Configuracoes.
- Revisao de acessibilidade.
- Revisao de SEO.
- Testes manuais dos fluxos principais.
- Documentacao de execucao e deploy.

## Planejamento Detalhado por Funcionalidade

Esta seção detalha o fluxo de construção de cada funcionalidade. O padrão deve ser sempre o mesmo:

1. Usuário interage com a página.
2. `script.js` coleta valores e controla DOM/eventos.
3. `script.js` chama o controller frontend.
4. Controller frontend recebe valores e chama sanitizadores de `frontend/src/utils/sanitizations.js`.
5. Controller frontend chama service frontend.
6. Service frontend envia dados no body para a API PHP.
7. API passa pelos middlewares necessários.
8. Controller backend sanitiza novamente.
9. Controller backend chama service backend.
10. Service backend valida regra de negócio e acessa banco.
11. Backend retorna JSON padronizado.
12. Controller frontend devolve sucesso ou erro para o `script.js`.
13. `script.js` renderiza sucesso, erro ou estado vazio.

### Fluxo 1: Login Admin

Página:

- `frontend/admin/login/index.html`

Campos:

- Email.
- Senha.
- Checkbox `manter conectado`.
- Botão `Enviar`.

Passo a passo:

- Usuário digita email e senha.
- Usuário marca ou não `manter conectado`.
- Ao clicar em `Enviar`, o `script.js` chama `admin-login-controller`.
- O `script.js` lê email, senha e checkbox.
- O `script.js` envia os valores para o controller frontend.
- O controller frontend chama os sanitizadores especificos de email, senha e checkbox em `frontend/src/utils/sanitizations.js`.
- O controller frontend valida campos obrigatórios.
- O controller frontend chama `admin-auth-service`.
- O service frontend envia `POST /api/v1/admin/auth/login`.
- Body enviado: `{ "email": "", "password": "", "remember": true }`.
- A API passa pelo middleware CORS.
- A API passa pelo middleware rate-limit.
- A rota chama o controller backend de autenticação admin.
- O controller backend sanitiza email, senha e remember.
- O controller backend chama o service de autenticação admin.
- O service busca o admin pelo email.
- O service valida se o admin existe.
- O service valida se o admin está ativo.
- O service valida senha com `password_verify`.
- Se falhar, retorna erro genérico de credenciais.
- Se passar, cria sessão no banco.
- O service gera cookie de sessão `HttpOnly`, `Secure`, `SameSite` e assinado com HMAC.
- Se `remember` for true, aumenta expiração da sessão.
- Backend retorna dados básicos do admin.
- Frontend redireciona para `frontend/admin/index.html`.

### Fluxo 2: Sessão Admin e Logout

Páginas:

- `frontend/admin/index.html`
- Todas as páginas dentro de `frontend/admin/*`

Passo a passo:

- Ao abrir uma página admin, o `script.js` chama middleware frontend `requireAdminAuth`.
- Middleware frontend chama `admin-auth-service`.
- Service frontend envia `POST /api/v1/admin/auth/me` com body vazio.
- API passa pelo middleware de sessão admin.
- Middleware backend lê cookie.
- Middleware valida assinatura HMAC.
- Middleware valida expiração.
- Middleware consulta sessão no banco.
- Middleware valida se admin ainda está ativo.
- Controller backend retorna admin e permissões.
- Frontend libera renderização da página.
- Se falhar, frontend redireciona para login admin.
- Ao clicar em `Sair`, controller frontend chama service de logout.
- Service envia `POST /api/v1/admin/auth/logout`.
- Middleware valida sessão.
- Service backend invalida sessão no banco.
- Backend limpa cookie.
- Frontend redireciona para login admin.

### Fluxo 3: Dashboard Admin

Página:

- `frontend/admin/index.html`

Componentes:

- Total de pedidos.
- Vendas do período.
- Produtos ativos.
- Produtos com baixo estoque.
- Atalhos administrativos.

Passo a passo:

- Página carrega após validação de sessão admin.
- Controller frontend chama `admin-dashboard-service`.
- Service envia `GET /api/v1/admin/dashboard`.
- API passa pelo middleware de sessão admin.
- API passa pelo middleware de permissão admin.
- Controller backend chama dashboard service.
- Service consulta pedidos, produtos, clientes e estoque.
- Service monta cards de resumo.
- Backend retorna `{ data: { cards, alerts, shortcuts }, meta: {} }`.
- Frontend renderiza cards.
- Se não houver dados, frontend renderiza estados zerados.

### Fluxo 4: CRUD de Departamentos Admin

Página:

- `frontend/admin/departments/index.html`

Campos:

- Nome.
- Slug.
- Descrição.
- Ordem.
- Status ativo/inativo.

Passo a passo:

- Ao abrir a página, controller chama service de departamentos.
- Service envia `POST /api/v1/admin/departments/list` com filtros no body.
- API passa por sessão admin e permissão.
- Controller backend sanitiza filtros.
- Service consulta departamentos no banco.
- Backend retorna lista e paginação.
- Ao criar, usuário preenche campos.
- Controller frontend sanitiza nome, slug, descrição, ordem e status.
- Service envia `POST /api/v1/admin/departments/create`.
- Controller backend sanitiza payload.
- Service valida nome obrigatório.
- Service valida slug único.
- Service valida ordem numérica.
- Service salva no banco.
- Backend retorna departamento criado.
- Frontend atualiza lista e exibe sucesso.
- Editar e excluir seguem o mesmo fluxo usando `update` e `delete`, sempre com ID no body.

### Fluxo 5: CRUD de Categorias Admin

Página:

- `frontend/admin/categories/index.html`

Campos:

- Nome.
- Slug.
- Departamento.
- Descrição.
- Ordem.
- Status ativo/inativo.

Passo a passo:

- Controller carrega departamentos para preencher select.
- Controller carrega categorias via service.
- Service envia `POST /api/v1/admin/categories/list`.
- Ao criar ou editar, controller sanitiza todos os campos.
- Service envia body com dados da categoria.
- API passa por sessão admin e permissão.
- Controller backend sanitiza payload.
- Service valida departamento existente.
- Service valida slug único dentro do contexto definido.
- Service salva categoria.
- Backend retorna categoria atualizada.
- Frontend atualiza tabela.

### Fluxo 6: CRUD de Subcategorias Admin

Página:

- `frontend/admin/subcategories/index.html`

Campos:

- Nome.
- Slug.
- Categoria.
- Descrição.
- Ordem.
- Status ativo/inativo.

Passo a passo:

- Controller carrega categorias.
- Controller carrega subcategorias.
- Service envia `POST /api/v1/admin/subcategories/list`.
- Usuário cria ou edita subcategoria.
- Controller sanitiza campos.
- Service envia create/update com body.
- API passa por sessão admin e permissão.
- Controller backend sanitiza.
- Service valida categoria existente.
- Service valida slug único.
- Service salva no banco.
- Frontend renderiza resultado.

### Fluxo 7: CRUD de Marcas Admin

Página:

- `frontend/admin/brands/index.html`

Campos:

- Nome.
- Slug.
- Descrição.
- Logo.
- Status ativo/inativo.

Passo a passo:

- Controller carrega lista de marcas.
- Service envia `POST /api/v1/admin/brands/list`.
- Usuário cria ou edita marca.
- Controller sanitiza nome, slug, descrição, logo e status.
- Service envia body para create/update.
- API passa por sessão admin e permissão.
- Controller backend sanitiza payload.
- Service valida nome obrigatório.
- Service valida slug único.
- Service salva marca no banco.
- Frontend atualiza listagem.

### Fluxo 8: CRUD de Coleções e Campanhas Admin

Páginas:

- `frontend/admin/collections/index.html`
- `frontend/admin/campaigns/index.html`

Campos:

- Nome.
- Slug.
- Descrição.
- Banner.
- Data inicial.
- Data final.
- Status.
- Produtos vinculados.

Passo a passo:

- Controller carrega coleções/campanhas.
- Service envia listagem com filtros no body.
- Usuário cria campanha.
- Controller sanitiza campos.
- Service envia create/update.
- API passa por sessão admin e permissão.
- Controller backend sanitiza payload.
- Service valida datas.
- Service valida slug único.
- Service salva campanha.
- Para vincular produto, frontend envia collectionId e productId no body.
- Backend valida se coleção e produto existem.
- Service cria vínculo no banco.
- Frontend atualiza produtos vinculados.

### Fluxo 9: CRUD de Produtos Admin

Página:

- `frontend/admin/products/index.html`

Campos:

- Nome.
- Slug.
- Descrição curta.
- Descrição completa.
- Departamento.
- Categoria.
- Subcategoria.
- Marca.
- Coleções.
- Preço em centavos.
- Preço promocional em centavos.
- Status ativo/inativo.

Passo a passo:

- Página carrega controller de produtos admin.
- Controller busca departamentos, categorias, subcategorias, marcas e coleções.
- Controller busca produtos.
- Service envia `POST /api/v1/admin/products/list`.
- Usuário cria ou edita produto.
- Controller frontend sanitiza todos os campos.
- Controller valida campos obrigatórios antes do envio.
- Service envia `POST /api/v1/admin/products/create` ou `PATCH /api/v1/admin/products/update`.
- API passa por sessão admin e permissão.
- Controller backend sanitiza payload.
- Service valida nome, slug, preço, status e relacionamentos.
- Service valida se preço promocional não é maior que preço base.
- Service salva produto no banco.
- Backend retorna produto salvo.
- Frontend renderiza sucesso e atualiza lista.

### Fluxo 10: Imagens de Produto Admin

Página:

- `frontend/admin/products/index.html`

Campos:

- Produto.
- Imagem.
- Texto alternativo.
- Ordem.
- Imagem principal.

Passo a passo:

- Usuário abre edição do produto.
- Controller carrega imagens do produto.
- Usuário adiciona imagem.
- Controller sanitiza metadados da imagem.
- Service envia `POST /api/v1/admin/products/images/add`.
- Body contém productId, imagem ou URL, alt, ordem e flag principal.
- API passa por sessão admin e permissão.
- Controller backend sanitiza metadados.
- Service valida produto existente.
- Service salva imagem.
- Se imagem for principal, service remove flag principal das outras.
- Backend retorna galeria atualizada.
- Frontend renderiza imagens.

### Fluxo 11: Variações de Produto Admin

Página:

- `frontend/admin/products/index.html`

Campos:

- Produto.
- Nome da variação.
- Tipo: tamanho, cor, voltagem, material, modelo.
- Valor.
- SKU.
- Preço adicional.
- Status.

Passo a passo:

- Usuário abre variações do produto.
- Controller carrega variações.
- Usuário cria ou edita variação.
- Controller sanitiza campos.
- Service envia create/update de variação com body.
- API passa por sessão admin e permissão.
- Controller backend sanitiza.
- Service valida produto existente.
- Service valida SKU único quando informado.
- Service salva variação.
- Backend retorna variações atualizadas.
- Frontend renderiza opções.

### Fluxo 12: Estoque Admin

Página:

- `frontend/admin/inventory/index.html`

Campos:

- Produto ou variação.
- Quantidade.
- Motivo do ajuste.

Passo a passo:

- Controller carrega estoque.
- Service envia `POST /api/v1/admin/inventory/list`.
- Usuário ajusta quantidade.
- Controller sanitiza productId, variantId, quantidade e motivo.
- Service envia `PATCH /api/v1/admin/inventory/products/update` ou `PATCH /api/v1/admin/inventory/variants/update`.
- API passa por sessão admin e permissão.
- Controller backend sanitiza.
- Service valida produto ou variação.
- Service valida quantidade não negativa.
- Service salva ajuste no banco.
- Service registra histórico de estoque.
- Backend retorna estoque atualizado.
- Frontend renderiza nova quantidade.

### Fluxo 13: Home Pública

Página:

- `frontend/home/index.html`

Componentes:

- Header.
- Busca.
- Menu de departamentos.
- Banners.
- Categorias principais.
- Mais vendidos.
- Lançamentos.
- Ofertas.

Passo a passo:

- Página carrega `allProductsController` quando precisar listar todos os produtos.
- Controller chama storefront service.
- Service chama `GET /api/v1/storefront/home`.
- API monta dados públicos.
- Service backend busca banners ativos, categorias, campanhas e vitrines.
- Backend retorna blocos da home.
- Controller frontend devolve blocos para o `script.js`.
- O `script.js` renderiza blocos.
- Se algum bloco vier vazio, controller esconde ou mostra estado vazio da seção.

### Fluxo 14: Menu de Departamentos

Componente:

- Header/menu global.

Passo a passo:

- Ao carregar header, controller chama navigation service.
- Service chama `GET /api/v1/storefront/menu`.
- Backend busca departamentos, categorias e subcategorias ativas.
- Backend retorna árvore de navegação.
- Frontend renderiza menu desktop e mobile.
- Ao clicar em departamento/categoria, frontend abre a página correspondente.
- A página correspondente envia o filtro no body para buscar produtos.

### Fluxo 15: Listagem de Produtos

Páginas:

- `frontend/products/index.html`
- `frontend/department/index.html`
- `frontend/category/index.html`
- `frontend/subcategory/index.html`
- `frontend/brand/index.html`
- `frontend/collection/index.html`
- `frontend/sale/index.html`
- `frontend/best-sellers/index.html`
- `frontend/new-arrivals/index.html`

Passo a passo:

- Página define contexto de listagem.
- Controller lê contexto visual.
- Controller monta filtros iniciais.
- Controller sanitiza filtros, ordenação, página e limite.
- Service envia `POST /api/v1/storefront/products/list`.
- Body contém contexto, filtros, sort, page e per_page.
- API passa por rate-limit público quando necessário.
- Controller backend sanitiza payload.
- Service valida filtros permitidos.
- Service consulta produtos ativos no banco.
- Service consulta filtros disponíveis para aquele resultado.
- Backend retorna produtos, filtros e paginação.
- Frontend renderiza cards, filtros, ordenação e botão carregar mais.

### Fluxo 16: Filtros e Ordenação

Componente:

- Filtros da listagem.

Passo a passo:

- Usuário seleciona filtro.
- Controller atualiza estado local da listagem.
- Controller sanitiza filtros.
- Service envia novamente `POST /api/v1/storefront/products/list`.
- Todos os filtros vão no body.
- Backend sanitiza e valida filtros.
- Service consulta produtos.
- Backend retorna lista atualizada.
- Frontend renderiza tags de filtros aplicados.
- Ao remover filtro, controller remove do estado e repete fluxo.
- Ordenação segue o mesmo fluxo com `sort` no body.

### Fluxo 17: Busca

Página:

- `frontend/search/index.html`

Campos:

- Termo de busca.
- Filtros.
- Ordenação.

Passo a passo:

- Usuário digita termo e envia busca.
- Controller sanitiza termo.
- Controller sanitiza filtros e paginação.
- Service envia `POST /api/v1/storefront/search`.
- Body contém termo, filtros, sort, page e per_page.
- API passa por rate-limit público.
- Controller backend sanitiza payload.
- Service registra termo pesquisado quando aplicável.
- Service busca produtos por termo.
- Service busca filtros disponíveis.
- Backend retorna resultados.
- Frontend renderiza produtos.
- Se não houver resultados, frontend renderiza estado vazio e sugestões.

### Fluxo 18: Autocomplete da Busca

Componente:

- Campo de busca no header e na página de busca.

Passo a passo:

- Usuário digita no campo.
- Controller aplica debounce.
- Controller sanitiza termo parcial.
- Service envia `POST /api/v1/storefront/search/suggestions`.
- Body contém termo.
- API passa por rate-limit público.
- Controller backend sanitiza termo.
- Service busca produtos, marcas, categorias e termos populares.
- Backend retorna sugestões agrupadas.
- Frontend renderiza dropdown.
- Usuário escolhe sugestão.
- Controller direciona para produto, categoria ou busca.

### Fluxo 19: Detalhe do Produto

Página:

- `frontend/product/index.html`

Componentes:

- Galeria.
- Dados do produto.
- Variações.
- Frete.
- Descrição.
- Especificações.
- Reviews.
- Perguntas.
- Relacionados.

Passo a passo:

- Página carrega controller de produto.
- Controller identifica produto pelo estado visual da página.
- Controller sanitiza identificador.
- Service envia `POST /api/v1/storefront/products/detail`.
- Body contém productId ou productSlug.
- Backend sanitiza payload.
- Service busca produto ativo.
- Service busca imagens, variações, estoque, reviews e relacionados.
- Backend retorna produto completo.
- Frontend renderiza detalhes.
- Ao selecionar variação, controller valida opções obrigatórias.
- Ao adicionar ao carrinho, controller envia produto, variação e quantidade ao cart service.

### Fluxo 20: Simulação de Frete no Produto

Página:

- `frontend/product/index.html`

Campos:

- CEP.

Passo a passo:

- Usuário digita CEP.
- Controller sanitiza CEP.
- Controller valida tamanho/formato.
- Service envia `POST /api/v1/storefront/products/shipping`.
- Body contém productId, variantId, quantidade e CEP.
- Backend sanitiza payload.
- Service valida produto ativo.
- Service calcula opções de frete.
- Backend retorna prazos e preços.
- Frontend renderiza opções.

### Fluxo 21: Reviews e Perguntas

Página:

- `frontend/product/index.html`

Campos:

- Nota.
- Comentário.
- Pergunta.

Passo a passo:

- Para listar reviews, service envia `POST /api/v1/storefront/products/reviews/list`.
- Para listar perguntas, service envia `POST /api/v1/storefront/products/questions/list`.
- Para criar review ou pergunta, controller sanitiza campos.
- Service envia create com body.
- API passa por rate-limit.
- Se exigir login, passa por sessão cliente.
- Backend sanitiza payload.
- Service valida produto ativo.
- Service salva review ou pergunta.
- Backend retorna registro criado ou pendente de moderação.
- Frontend renderiza retorno.

### Fluxo 22: Carrinho

Página:

- `frontend/cart/index.html`

Componentes:

- Itens.
- Quantidade.
- Remover.
- Cupom.
- Frete.
- Resumo.

Passo a passo:

- Página chama cart controller.
- Controller chama service `cart/get`.
- Service envia `POST /api/v1/cart/get`.
- Backend identifica carrinho por cookie ou cliente logado.
- Backend retorna carrinho.
- Ao adicionar item, controller sanitiza produto, variação e quantidade.
- Service envia `POST /api/v1/cart/items/add`.
- Backend sanitiza payload.
- Service valida produto ativo.
- Service valida estoque.
- Service busca preço atual.
- Service adiciona item.
- Service recalcula totais.
- Backend retorna carrinho atualizado.
- Frontend renderiza carrinho.

### Fluxo 23: Cupom no Carrinho

Página:

- `frontend/cart/index.html`

Campos:

- Código do cupom.

Passo a passo:

- Usuário digita cupom.
- Controller sanitiza código.
- Service envia `POST /api/v1/cart/coupon/apply`.
- Body contém código e carrinho.
- Backend sanitiza payload.
- Service busca cupom.
- Service valida status, validade, limite de uso, valor mínimo e produtos elegíveis.
- Service aplica desconto.
- Service recalcula totais.
- Backend retorna carrinho atualizado.
- Frontend exibe desconto ou erro.

### Fluxo 24: Checkout

Página:

- `frontend/checkout/index.html`

Etapas:

- Identificação.
- Dados pessoais.
- Endereço.
- Frete.
- Pagamento.
- Revisão.
- Confirmação.

Passo a passo:

- Controller inicia checkout.
- Service envia `POST /api/v1/checkout/start`.
- Backend valida carrinho.
- Usuário preenche dados pessoais.
- Controller sanitiza campos.
- Service envia `POST /api/v1/checkout/customer`.
- Usuário preenche endereço.
- Service envia `POST /api/v1/checkout/address`.
- Usuário escolhe frete.
- Service envia `POST /api/v1/checkout/shipping`.
- Usuário escolhe pagamento.
- Service envia `POST /api/v1/checkout/payment`.
- Controller solicita revisão.
- Service envia `POST /api/v1/checkout/review`.
- Backend recalcula carrinho, frete, cupom e total.
- Usuário confirma.
- Service envia `POST /api/v1/checkout/confirm`.
- Backend cria pedido, itens, pagamento e movimentação de estoque.
- Backend retorna número do pedido.
- Frontend redireciona para confirmação.

### Fluxo 25: Confirmação de Pedido

Página:

- `frontend/order-confirmation/index.html`

Passo a passo:

- Página carrega controller de confirmação.
- Controller sanitiza identificador do pedido.
- Service envia `POST /api/v1/orders/detail`.
- Backend valida sessão ou token de confirmação.
- Controller backend sanitiza payload.
- Service busca pedido.
- Backend retorna resumo.
- Frontend renderiza número, status, itens, entrega e pagamento.

### Fluxo 26: Pagamento

Funcionalidade:

- Criação e atualização de pagamento.

Passo a passo:

- Checkout envia dados de pagamento para service frontend.
- Service envia `POST /api/v1/payments/create`.
- API passa por rate-limit.
- Controller backend sanitiza payload.
- Service valida pedido.
- Service chama provider de pagamento.
- Service salva pagamento no banco.
- Backend retorna status inicial.
- Frontend exibe pendente, aprovado ou recusado.
- Para cancelamento, service envia `POST /api/v1/payments/cancel` com paymentId no body.

### Fluxo 27: Webhook de Pagamento

Endpoint:

- `POST /api/v1/webhooks/payments`

Passo a passo:

- Provider envia webhook.
- Body contém provider, paymentId, status, assinatura e payload bruto quando necessário.
- Middleware valida assinatura do provider.
- Middleware aplica proteção contra replay quando aplicável.
- Controller backend sanitiza campos permitidos.
- Service localiza pagamento.
- Service atualiza status do pagamento.
- Service atualiza status do pedido.
- Service registra log do webhook.
- Backend retorna confirmação simples ao provider.

### Fluxo 28: Cadastro de Cliente

Página:

- `frontend/register/index.html`

Campos:

- Nome.
- Email.
- Telefone.
- Senha.
- Confirmação de senha.

Passo a passo:

- Usuário preenche cadastro.
- Controller sanitiza campos.
- Controller valida senha e confirmação.
- Service envia `POST /api/v1/auth/register`.
- API passa por rate-limit.
- Controller backend sanitiza payload.
- Service valida email único.
- Service cria hash da senha com `password_hash`.
- Service salva cliente.
- Service pode criar sessão automaticamente.
- Backend retorna cliente básico.
- Frontend redireciona para conta ou checkout.

### Fluxo 29: Login de Cliente

Página:

- `frontend/login/index.html`

Campos:

- Email.
- Senha.
- Manter conectado.

Passo a passo:

- Controller chama os sanitizadores especificos de email, senha e remember.
- Service envia `POST /api/v1/auth/login`.
- API passa por rate-limit.
- Controller backend sanitiza.
- Service busca cliente por email.
- Service valida status do cliente.
- Service valida senha com `password_verify`.
- Service cria sessão no banco.
- Service gera cookie seguro assinado com HMAC.
- Backend retorna cliente básico.
- Frontend redireciona para conta, checkout ou página anterior.

### Fluxo 30: Recuperação de Senha

Página:

- `frontend/login/index.html`

Campos:

- Email.
- Token.
- Nova senha.

Passo a passo:

- Usuário solicita recuperação.
- Controller chama o sanitizador especifico de email.
- Service envia `POST /api/v1/auth/forgot-password`.
- Backend passa por rate-limit.
- Service cria token seguro com expiração.
- Service envia email ou registra token para ambiente local.
- Usuário informa token e nova senha.
- Service envia `POST /api/v1/auth/reset-password`.
- Backend valida token.
- Service cria novo `password_hash`.
- Service invalida token.
- Backend retorna sucesso.

### Fluxo 31: Conta do Cliente

Página:

- `frontend/account/index.html`

Passo a passo:

- Página chama middleware frontend `requireCustomerAuth`.
- Service envia `POST /api/v1/auth/me`.
- Backend valida cookie HMAC e sessão.
- Controller backend retorna cliente básico.
- Controller frontend devolve dados da conta para o `script.js`.
- O `script.js` renderiza atalhos de conta.
- Para atualizar perfil, controller sanitiza dados.
- Service envia `PATCH /api/v1/account/profile/update`.
- Backend sanitiza e valida.
- Service salva alterações.
- Frontend renderiza sucesso.

### Fluxo 32: Endereços do Cliente

Página:

- `frontend/addresses/index.html`

Campos:

- Nome do destinatário.
- CEP.
- Rua.
- Número.
- Complemento.
- Bairro.
- Cidade.
- Estado.
- Principal.

Passo a passo:

- Página valida sessão cliente.
- Controller lista endereços.
- Service envia `POST /api/v1/account/addresses/list`.
- Usuário cria ou edita endereço.
- Controller sanitiza campos.
- Service envia create/update com body.
- Backend sanitiza payload.
- Service valida CEP e campos obrigatórios.
- Service salva endereço do cliente autenticado.
- Frontend atualiza lista.

### Fluxo 33: Favoritos

Página:

- `frontend/wishlist/index.html`

Passo a passo:

- Página valida sessão cliente.
- Controller carrega favoritos.
- Service envia `POST /api/v1/account/wishlist/list`.
- Ao favoritar produto, controller sanitiza productId.
- Service envia `POST /api/v1/account/wishlist/items/add`.
- Backend valida sessão cliente.
- Backend valida produto ativo.
- Service salva favorito.
- Ao remover, service envia `POST /api/v1/account/wishlist/items/remove`.
- Frontend atualiza lista.

### Fluxo 34: Meus Pedidos

Página:

- `frontend/orders/index.html`

Passo a passo:

- Página valida sessão cliente.
- Controller chama orders service.
- Service envia `POST /api/v1/orders/list`.
- Body contém filtros, página e limite.
- Backend valida sessão cliente.
- Controller backend sanitiza filtros.
- Service busca pedidos do cliente autenticado.
- Backend retorna lista.
- Frontend renderiza pedidos.

### Fluxo 35: Detalhe e Rastreamento do Pedido

Página:

- `frontend/order/index.html`

Passo a passo:

- Controller sanitiza orderId visual.
- Service envia `POST /api/v1/orders/detail` com orderId no body.
- Backend valida sessão cliente.
- Service confirma que pedido pertence ao cliente.
- Backend retorna itens, pagamento, entrega e status.
- Para rastreamento, service envia `POST /api/v1/orders/tracking`.
- Backend busca rastreio.
- Frontend renderiza status.

### Fluxo 36: Cancelamento, Troca ou Devolução

Página:

- `frontend/order/index.html`

Campos:

- Motivo.
- Observação.
- Itens selecionados quando aplicável.

Passo a passo:

- Usuário solicita cancelamento, troca ou devolução.
- Controller sanitiza motivo, observação e itens.
- Service envia `POST /api/v1/orders/cancel` ou `POST /api/v1/orders/return-request`.
- Backend valida sessão cliente.
- Service valida pedido, prazo, status e itens.
- Service cria solicitação.
- Backend retorna protocolo.
- Frontend exibe protocolo ao cliente.

### Fluxo 37: Admin de Pedidos

Página:

- `frontend/admin/orders/index.html`

Passo a passo:

- Página valida sessão admin.
- Controller envia filtros para service.
- Service envia `POST /api/v1/admin/orders/list`.
- Backend valida permissão admin.
- Service busca pedidos.
- Frontend renderiza tabela.
- Ao abrir pedido, service envia `POST /api/v1/admin/orders/detail`.
- Ao alterar status, controller sanitiza orderId e status.
- Service envia `PATCH /api/v1/admin/orders/status`.
- Backend valida transição de status.
- Service salva alteração e registra histórico.
- Frontend atualiza pedido.

### Fluxo 38: Admin de Clientes

Página:

- `frontend/admin/customers/index.html`

Passo a passo:

- Página valida sessão admin.
- Controller envia filtros.
- Service envia `POST /api/v1/admin/customers/list`.
- Backend valida permissão.
- Service busca clientes.
- Frontend renderiza tabela.
- Ao abrir cliente, service envia `POST /api/v1/admin/customers/detail`.
- Para ver pedidos, service envia `POST /api/v1/admin/customers/orders`.
- Backend retorna dados permitidos.

### Fluxo 39: Admin de Cupons

Página:

- `frontend/admin/coupons/index.html`

Campos:

- Código.
- Tipo de desconto.
- Valor.
- Data inicial.
- Data final.
- Uso máximo.
- Valor mínimo do carrinho.
- Status.

Passo a passo:

- Controller carrega cupons.
- Service envia `POST /api/v1/admin/coupons/list`.
- Usuário cria ou edita cupom.
- Controller sanitiza campos.
- Service envia create/update.
- Backend valida permissão admin.
- Service valida código único, datas e regras.
- Service salva cupom.
- Frontend atualiza lista.

### Fluxo 40: Admin de Frete

Página:

- `frontend/admin/shipping-methods/index.html`

Campos:

- Nome.
- Tipo.
- Região.
- Prazo.
- Preço.
- Valor mínimo.
- Status.

Passo a passo:

- Controller lista métodos de frete.
- Service envia `POST /api/v1/admin/shipping-methods/list`.
- Usuário cria ou edita método.
- Controller sanitiza campos.
- Service envia create/update.
- Backend valida permissão.
- Service valida preço, prazo e região.
- Service salva método.
- Frontend atualiza lista.

### Fluxo 41: Configurações da Loja

Página:

- `frontend/admin/settings/index.html`

Campos:

- Nome da loja.
- Email de atendimento.
- Telefone.
- Políticas públicas.
- Compra como visitante.
- Meios de pagamento ativos.
- Regras de sessão.

Passo a passo:

- Página valida sessão admin.
- Controller carrega configurações.
- Service chama `GET /api/v1/admin/settings`.
- Usuário altera campos.
- Controller sanitiza.
- Service envia `PATCH /api/v1/admin/settings`.
- Backend valida permissão.
- Service valida formatos.
- Service salva configurações.
- Frontend renderiza sucesso.

### Fluxo 42: Páginas Institucionais

Páginas:

- `frontend/about/index.html`
- `frontend/contact/index.html`
- `frontend/help/index.html`
- `frontend/shipping/index.html`
- `frontend/returns/index.html`
- `frontend/privacy/index.html`
- `frontend/terms/index.html`

Passo a passo:

- Página institucional chama content service quando o conteúdo vier do backend.
- Service envia `POST /api/v1/pages/detail` com slug no body.
- Backend sanitiza slug.
- Service busca página publicada.
- Frontend renderiza conteúdo.
- Página de contato coleta nome, email, assunto e mensagem.
- Controller sanitiza campos.
- Service envia `POST /api/v1/contact`.
- API passa por rate-limit.
- Backend sanitiza payload.
- Service registra contato ou envia notificação.
- Frontend exibe sucesso.

### Fluxo 43: Tratamento de Erros

Aplicação:

- Todas as páginas.
- Todos os endpoints.

Passo a passo:

- Service frontend recebe resposta da API.
- Se `response.ok` for falso, service lança erro padronizado.
- Controller captura erro.
- Controller devolve erro tratado para o `script.js`.
- O `script.js` renderiza mensagem amigável.
- Backend nunca retorna erro cru de banco ou stack trace.
- Backend retorna código, mensagem e detalhes seguros.
- Erros de validação retornam campos inválidos.
- Erros de autenticação redirecionam quando necessário.

### Fluxo 44: SEO e URLs Públicas

Aplicação:

- Páginas públicas.

Passo a passo:

- Frontend pode usar URLs amigáveis para navegação e SEO.
- Nenhum dado da URL é enviado diretamente para backend.
- Controller lê estado visual da página.
- Controller sanitiza estado.
- Service converte estado em body.
- Backend recebe somente body.
- Cada página pública deve ter title, description e conteúdo semântico.
- Listagens devem ter heading claro.
- Produto deve ter nome, preço e descrição renderizados.

### Fluxo 45: Testes Manuais Obrigatórios

Aplicação:

- Antes de considerar etapa concluída.

Passo a passo:

- Abrir página implementada.
- Testar estado inicial.
- Testar carregamento.
- Testar erro de API.
- Testar estado vazio.
- Testar submissão válida.
- Testar submissão inválida.
- Verificar se nenhum dado foi enviado pela URL.
- Verificar se controller frontend não chama API direto.
- Verificar se controller backend não contém regra pesada.
- Verificar se sanitização acontece no frontend e no backend.
- Verificar se service backend concentra regra de negócio.

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
- `service`: regras de negócio, como catálogo, carrinho, pedido, pagamento e estoque.
- `routes`: definição das rotas HTTP e ligação com controllers.
- `index.php`: ponto de entrada do backend, centraliza bootstrap, headers, middlewares globais e registro de rotas.
- `src`: contém todos os módulos internos do backend.

### Fluxo de desenvolvimento

1. Definir a rota em `backend/src/routes`.
2. Criar o controller em `backend/src/controller`.
3. Sanitizar dados chamando funções/classes de `backend/src/utils/Sanitization.php`.
4. Implementar regra de negócio em `backend/src/service`.
5. Aplicar validações e segurança em `backend/src/middleware`.
6. Ler configurações em `backend/src/config`.
7. Persistir dados usando scripts e migrations em `db`.

## Regras de Arquitetura do Backend

### Controllers

- Controllers devem ser finos.
- Controllers recebem dados da rota/request.
- Controllers chamam sanitização pronta em `backend/src/utils/Sanitization.php`.
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

- Todo código de sanitização do backend fica em `backend/src/utils/Sanitization.php`.
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
- Routes não devem usar parâmetros dinâmicos na URL, como `/:id` ou `/:slug`.
- Routes não devem depender de query string.
- Tudo que a rota precisa enviar ao controller deve vir do body da requisição.

### Middlewares

- Middlewares lidam com contexto da requisição.
- Middlewares fazem autenticação, autorização, CORS, rate limit e tratamento de erros.
- Middlewares não executam regra de negócio de ecommerce.
- Middlewares não substituem services.

Middlewares base:

- `backend/src/middleware/rateLimiter.php`: possui apenas a função `rateLimiter($attempts, $waitSeconds)`.
- `backend/src/middleware/bodyLimiter.php`: possui apenas a função `bodyLimiter($maxBytes)`.
- Os middlewares devem ser registrados no `Router` em `backend/index.php`.

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

Regra obrigatoria:

- Nenhum dado deve ser enviado ao backend via URL.
- Nao usar query string para filtros, busca, ordenacao ou paginacao.
- Nao usar parametros dinamicos na rota, como `/:id`, `/:slug` ou `/:provider`.
- IDs, slugs, filtros, termos de busca, pagina, limite, ordenacao e acoes devem ir no body.
- Endpoints de leitura que precisam receber dados usam `POST`.
- Endpoints `GET` devem ser usados apenas quando nao precisam receber body.

### Health

```text
GET /health
GET /api/v1/health
```

### Auth

```text
POST /api/v1/auth/register
POST /api/v1/auth/login
POST /api/v1/auth/logout
POST /api/v1/auth/forgot-password
POST /api/v1/auth/reset-password
POST /api/v1/auth/me
PATCH /api/v1/auth/password
```

### Storefront

```text
GET  /api/v1/storefront/home
GET  /api/v1/storefront/menu
GET  /api/v1/storefront/navigation
```

### Catalogo Publico

```text
POST /api/v1/storefront/departments/list
POST /api/v1/storefront/departments/detail
POST /api/v1/storefront/departments/categories
POST /api/v1/storefront/categories/list
POST /api/v1/storefront/categories/detail
POST /api/v1/storefront/categories/subcategories
POST /api/v1/storefront/subcategories/detail
POST /api/v1/storefront/brands/list
POST /api/v1/storefront/brands/detail
POST /api/v1/storefront/collections/list
POST /api/v1/storefront/collections/detail
POST /api/v1/storefront/sale
POST /api/v1/storefront/best-sellers
POST /api/v1/storefront/new-arrivals
```

### Produtos Publicos

```text
POST /api/v1/storefront/products/list
POST /api/v1/storefront/products/detail
POST /api/v1/storefront/products/related
POST /api/v1/storefront/products/reviews/list
POST /api/v1/storefront/products/reviews/create
POST /api/v1/storefront/products/questions/list
POST /api/v1/storefront/products/questions/create
POST /api/v1/storefront/products/shipping
```

### Busca

```text
POST /api/v1/storefront/search
POST /api/v1/storefront/search/suggestions
POST /api/v1/storefront/search/filters
GET  /api/v1/storefront/search/popular
POST /api/v1/storefront/search/recent
```

Body esperado para busca e listagens:

```json
{
  "q": "tenis",
  "department": "moda",
  "category": "calcados",
  "subcategory": "tenis",
  "brand": "marca-x",
  "collection": "black-friday",
  "min_price": 10000,
  "max_price": 30000,
  "discount": true,
  "rating": 4,
  "available": true,
  "attributes": {
    "color": ["preto", "branco"],
    "size": ["40", "41"]
  },
  "sort": "relevance",
  "page": 1,
  "per_page": 24
}
```

### Wishlist

```text
POST /api/v1/account/wishlist/list
POST /api/v1/account/wishlist/items/add
POST /api/v1/account/wishlist/items/remove
```

### Cart

```text
POST /api/v1/cart/get
POST /api/v1/cart/items/add
PATCH /api/v1/cart/items/update
POST /api/v1/cart/items/remove
POST /api/v1/cart/coupon/apply
POST /api/v1/cart/coupon/remove
POST /api/v1/cart/shipping
POST /api/v1/cart/clear
```

### Checkout

```text
POST /api/v1/checkout/start
POST /api/v1/checkout/customer
POST /api/v1/checkout/address
POST /api/v1/checkout/shipping
POST /api/v1/checkout/coupon
POST /api/v1/checkout/payment
POST /api/v1/checkout/review
POST /api/v1/checkout/confirm
```

### Orders

```text
POST /api/v1/orders/list
POST /api/v1/orders/create
POST /api/v1/orders/detail
POST /api/v1/orders/tracking
POST /api/v1/orders/cancel
POST /api/v1/orders/return-request
```

### Payments

```text
POST /api/v1/payments/create
POST /api/v1/payments/detail
POST /api/v1/payments/cancel
POST /api/v1/webhooks/payments
```

### Coupons

```text
POST /api/v1/coupons/validate
```

### Customers

```text
POST  /api/v1/account/profile/get
PATCH /api/v1/account/profile/update
POST  /api/v1/account/addresses/list
POST  /api/v1/account/addresses/create
POST  /api/v1/account/addresses/detail
PATCH /api/v1/account/addresses/update
POST  /api/v1/account/addresses/delete
```

### Atendimento e Institucional

```text
POST /api/v1/contact
POST /api/v1/help/list
POST /api/v1/help/detail
POST /api/v1/pages/detail
```

### Admin Dashboard

```text
GET  /api/v1/admin/dashboard
POST /api/v1/admin/reports/sales
POST /api/v1/admin/reports/products
POST /api/v1/admin/reports/customers
```

### Products Admin

```text
POST  /api/v1/admin/products/list
POST  /api/v1/admin/products/create
POST  /api/v1/admin/products/detail
PATCH /api/v1/admin/products/update
POST  /api/v1/admin/products/delete
POST  /api/v1/admin/products/images/add
POST  /api/v1/admin/products/images/remove
POST  /api/v1/admin/products/variants/list
POST  /api/v1/admin/products/variants/create
PATCH /api/v1/admin/products/variants/update
POST  /api/v1/admin/products/variants/delete
```

### Departments Admin

```text
POST  /api/v1/admin/departments/list
POST  /api/v1/admin/departments/create
POST  /api/v1/admin/departments/detail
PATCH /api/v1/admin/departments/update
POST  /api/v1/admin/departments/delete
```

### Categories Admin

```text
POST  /api/v1/admin/categories/list
POST  /api/v1/admin/categories/create
POST  /api/v1/admin/categories/detail
PATCH /api/v1/admin/categories/update
POST  /api/v1/admin/categories/delete
```

### Subcategories Admin

```text
POST  /api/v1/admin/subcategories/list
POST  /api/v1/admin/subcategories/create
POST  /api/v1/admin/subcategories/detail
PATCH /api/v1/admin/subcategories/update
POST  /api/v1/admin/subcategories/delete
```

### Brands Admin

```text
POST  /api/v1/admin/brands/list
POST  /api/v1/admin/brands/create
POST  /api/v1/admin/brands/detail
PATCH /api/v1/admin/brands/update
POST  /api/v1/admin/brands/delete
```

### Collections Admin

```text
POST  /api/v1/admin/collections/list
POST  /api/v1/admin/collections/create
POST  /api/v1/admin/collections/detail
PATCH /api/v1/admin/collections/update
POST  /api/v1/admin/collections/delete
POST  /api/v1/admin/collections/products/add
POST  /api/v1/admin/collections/products/remove
```

### Campaigns / Banners Admin

```text
POST  /api/v1/admin/campaigns/list
POST  /api/v1/admin/campaigns/create
POST  /api/v1/admin/campaigns/detail
PATCH /api/v1/admin/campaigns/update
POST  /api/v1/admin/campaigns/delete
POST  /api/v1/admin/banners/list
POST  /api/v1/admin/banners/create
PATCH /api/v1/admin/banners/update
POST  /api/v1/admin/banners/delete
```

### Inventory Admin

```text
POST  /api/v1/admin/inventory/list
POST  /api/v1/admin/inventory/low-stock
PATCH /api/v1/admin/inventory/products/update
PATCH /api/v1/admin/inventory/variants/update
```

### Orders Admin

```text
POST  /api/v1/admin/orders/list
POST  /api/v1/admin/orders/detail
PATCH /api/v1/admin/orders/status
POST  /api/v1/admin/orders/cancel
POST  /api/v1/admin/orders/refund
```

### Customers Admin

```text
POST  /api/v1/admin/customers/list
POST  /api/v1/admin/customers/detail
PATCH /api/v1/admin/customers/update
POST  /api/v1/admin/customers/orders
```

### Coupons Admin

```text
POST  /api/v1/admin/coupons/list
POST  /api/v1/admin/coupons/create
POST  /api/v1/admin/coupons/detail
PATCH /api/v1/admin/coupons/update
POST  /api/v1/admin/coupons/delete
```

### Shipping Admin

```text
POST  /api/v1/admin/shipping-methods/list
POST  /api/v1/admin/shipping-methods/create
PATCH /api/v1/admin/shipping-methods/update
POST  /api/v1/admin/shipping-methods/delete
```

### Settings Admin

```text
GET   /api/v1/admin/settings
PATCH /api/v1/admin/settings
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
php -S localhost:8080 index.php
```

## Padrões

- Frontend Low usa `HTML`, `CSS` e `JavaScript` sem dependência de build.
- Backend usa `PHP 8.2+`.
- Toda regra de negócio fica em `backend/src/service`.
- Controllers são finos e não sanitizam inline.
- Sanitização fica em `backend/src/utils/Sanitization.php`.
- Utils não devem depender da camada HTTP.
- Backend retorna JSON padronizado.
- Banco usa valores monetários em centavos.
- IDs em URL usam nomes explícitos, como `productId`, `orderId` e `customerId`.

## Roadmap

O roadmap macro segue as 15 etapas, mas a execução deve seguir o `Planejamento Detalhado por Funcionalidade`, que quebra cada etapa em fluxos completos de página, controller, service, API, middleware, banco e retorno.

1. Base tecnica, router e contratos.
2. Banco de dados, config e seeds.
3. Segurança base, sanitização e middlewares.
4. Página de login admin.
5. Admin dashboard e logout.
6. Admin de catálogo base.
7. Admin de produtos, imagens, variações e estoque.
8. Storefront home e menu de navegação.
9. Listagem pública reutilizável.
10. Busca e autocomplete.
11. Detalhe do produto.
12. Carrinho.
13. Checkout, pedido e confirmação.
14. Conta do cliente e pós-compra.
15. Pagamentos, admin operacional e produção.
