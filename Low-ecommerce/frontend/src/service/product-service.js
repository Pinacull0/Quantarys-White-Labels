import { apiRequest } from '../utils/api.js';

export async function listProducts() {
  return apiRequest('/products');
}
