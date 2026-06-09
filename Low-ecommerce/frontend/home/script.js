import { allProductsController } from '../src/controller/products/allProductsController.js';
import { formatCurrency } from '../src/utils/currency.js';

const target = document.querySelector('#featured-products');

renderHomeProducts();

async function renderHomeProducts() {
  if (!target) {
    return;
  }

  renderMessage('Carregando produtos...');

  const result = await allProductsController();

  if (!result.success) {
    renderMessage(result.error.message, 'error');
    return;
  }

  target.replaceChildren(...result.data.map(createProductCard));
}

function createProductCard(product) {
  const card = document.createElement('article');
  card.className = 'product-card';

  const image = document.createElement('div');
  image.className = 'product-card__image';

  const title = document.createElement('h2');
  title.textContent = product.name;

  const price = document.createElement('strong');
  price.textContent = formatCurrency(product.price);

  const button = document.createElement('button');
  button.type = 'button';
  button.dataset.productId = product.id;
  button.textContent = 'Adicionar ao carrinho';

  card.append(image, title, price, button);

  return card;
}

function renderMessage(message, className = '') {
  const paragraph = document.createElement('p');
  paragraph.textContent = message;

  if (className !== '') {
    paragraph.className = className;
  }

  target.replaceChildren(paragraph);
}
