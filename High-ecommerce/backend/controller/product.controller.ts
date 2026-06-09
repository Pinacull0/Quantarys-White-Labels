import type { FastifyReply, FastifyRequest } from 'fastify';
import { createProduct } from '../services/product.service.js';
import { sanitizeCreateProductPayload } from '../utils/sanitization.js';

export async function createProductController(request: FastifyRequest, reply: FastifyReply) {
  const payload = sanitizeCreateProductPayload(request.body);
  const product = await createProduct(payload);

  return reply.status(201).send({
    data: product,
    meta: {}
  });
}
