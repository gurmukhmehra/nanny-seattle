function loadFun() {
    const cToasts = document.querySelectorAll(`.c-toast`)
    
    let i = 0
    const muIntercval = setInterval(() => {
        if(i == cToasts.length) {
            i = 0
            // clearInterval(myInterval)
        }
        const cToast = document.querySelector(`.c-toast[data-index="${ i }"]`)
        if(cToast) {
            cToast.style.display = "block"
            setTimeout(() => {
                cToast.style.display = "none"
            }, 5000);
            i++
        }
    }, 10000);
}

document.addEventListener("readystatechange", function() {
    if(document.readyState == "complete") {
        loadFun();
    }
})