const factorial = (numero: number) : number => {
    if (numero == 1 || numero == 0)
        return 1;

    let factorial : number = 1;

    for (let i = 1; i <= numero; i++) {
        factorial *= i;
    }
    return factorial;
}


const cuboNumero = (numero : number) : number => {
    let cubo : number = 1;
    for (let i = 1; i <= (numero < 0? numero* -1 : numero); i++) {
        cubo += (numero*numero);
    }
    return cubo;
}

const tipoNumero = (numero : number) => {
    if (numero < 0)
        console.log("numero al cubo: ", cuboNumero(numero));
    else    
        console.log("numero factorial: ", factorial(numero));
}

tipoNumero(5);
tipoNumero(-6);