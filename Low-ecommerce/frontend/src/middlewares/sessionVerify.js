export function sessionVerify() {
  const hasSession = document.cookie.includes('low_session=');

  if (!hasSession) {
    window.location.href = '../login/index.html';
  }
}
