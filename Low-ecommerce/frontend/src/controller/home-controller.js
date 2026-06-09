import { listProducts } from '../service/product-service.js';
import { formatCurrency } from '../utils/currency.js';

export async function renderHomeProducts(targetSelector) {
  const target = document.querySelector(targetSelector);

  if (!target) {
    return;
  }

  target.innerHTML = '<p>Carregando produtos...</p>';

  try {
    const products = await listProducts();

    target.innerHTML = products
      .map(
        (product) => `
          <article class="product-card">
            <div class="product-card__image"></div>
            <h2>${product.name}</h2>
            <strong>${formatCurrency(product.price)}</strong>
            <button type="button" data-product-id="${product.id}">Adicionar ao carrinho</button>
          </article>
        `
      )
      .join('');
  } catch (error) {
    target.innerHTML = `<p class="error">${error.message}</p>`;
  }
}
