export function formatCurrency(valueInCents) {
  return new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL'
  }).format(valueInCents / 100);
}
