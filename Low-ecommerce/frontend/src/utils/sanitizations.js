const SQL_INJECTION_PATTERNS = [
  /(\bselect\b|\binsert\b|\bupdate\b|\bdelete\b|\bdrop\b|\balter\b|\btruncate\b|\bunion\b)/i,
  /(--|#|\/\*|\*\/|;)/,
  /(\bor\b|\band\b)\s+[\w'"]+\s*=\s*[\w'"]/i
];

export function sanitizeLoginEmail(value) {
  const email = normalizeText(value).toLowerCase();

  validateMaxLength(email, 80, 'Email');
  validateNoDangerousInput(email, 'Email');

  if (!/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(email)) {
    throw new Error('Email invalido.');
  }

  return email;
}

export function sanitizeLoginPassword(value) {
  const password = normalizeText(value);

  validateMaxLength(password, 24, 'Senha');
  validateNoDangerousInput(password, 'Senha');

  if (password.length === 0) {
    throw new Error('Senha obrigatoria.');
  }

  return password;
}

export function sanitizeLoginRemember(value) {
  if (value === true || value === 1 || value === '1' || value === 'true' || value === 'on') {
    return true;
  }

  if (value === false || value === 0 || value === '0' || value === 'false' || value == null) {
    return false;
  }

  throw new Error('Valor de manter conectado invalido.');
}

function normalizeText(value) {
  return String(value ?? '')
    .replace(/<[^>]*>/g, '')
    .replace(/[\u0000-\u001F\u007F]/g, '')
    .replace(/\s+/g, ' ')
    .trim();
}

function validateMaxLength(value, maxLength, label) {
  if (value.length > maxLength) {
    throw new Error(`${label} deve ter no maximo ${maxLength} caracteres.`);
  }
}

function validateNoDangerousInput(value, label) {
  if (value.length > 1000) {
    throw new Error(`${label} invalido.`);
  }

  if (SQL_INJECTION_PATTERNS.some((pattern) => pattern.test(value))) {
    throw new Error(`${label} contem caracteres invalidos.`);
  }
}
