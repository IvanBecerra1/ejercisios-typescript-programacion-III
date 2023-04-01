"use strict";
function mostrar(param1, param2) {
    if (param2 != null) {
        for (let index = 0; index < param1; index++) {
            console.log(index, param2);
        }
    }
    else {
        console.log("inversa del numero : ", param1 * -1);
    }
}
mostrar(5, "hola");
mostrar(2);
//# sourceMappingURL=index.js.map