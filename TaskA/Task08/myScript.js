const init = () => {
    document.querySelectorAll('a').forEach(el => {
        el.addEventListener('click', (e) => {
            e.preventDefault();
            const url = el.href;
            history.pushState(null, {}, url);
            fetch(url)
                .then(res => res.text())
                .then(res => {
                    document.body.innerHTML = res;
                })
                .then(init)
        })
    })
}
window.onload = init;