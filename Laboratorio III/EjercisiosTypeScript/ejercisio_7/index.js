"use strict";
function primo(numero) {
    for (let i = 2; i < numero; i++) {
        if (numero % i === 0) {
            return false;
        }
    }
    if (!(numero === 1)) {
        console.log("numero primo: ", numero);
    }
}
for (let i = 0; i < 100; i++) {
    primo(i);
}
//# sourceMappingURL=index.js.map