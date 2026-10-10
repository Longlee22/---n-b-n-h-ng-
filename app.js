function changeQty(delta) {
    const input = document.getElementById('qty');
    if (!input) return;
    let value = parseInt(input.value || 1, 10) + delta;
    value = Math.max(1, Math.min(10, value));
    input.value = value;
}
