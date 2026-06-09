import { randomUUID } from 'node:crypto';

export async function createProduct(payload: Record<string, unknown>) {
  return {
    id: randomUUID(),
    ...payload
  };
}
