export function requireCustomerSession() {
  const token = window.localStorage.getItem('customer_token');

  if (!token) {
    window.location.href = '../account/index.html';
  }
}
