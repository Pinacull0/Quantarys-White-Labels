import { allProductsService } from '../../service/products/allProductsService.js';

export async function allProductsController() {
  try {
    const products = await allProductsService();

    return {
      success: true,
      data: products,
      error: null
    };
  } catch (error) {
    return {
      success: false,
      data: [],
      error: {
        message: error.message
      }
    };
  }
}
