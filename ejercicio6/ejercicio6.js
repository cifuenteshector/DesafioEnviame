function entregas() {
    let random;
    //rangos en sucesión númerica
    let r1 = [99,0], r2=[199,1], 
        r3=[299,1], r4=[399,2], r5=[499,r4[1]+r3[1]], /*3*/ r6=[599,r5[1]+r4[1]], /*5*/ r7=[699,r6[1]+r5[1]], /*8*/ r8=[799,r7[1]+r6[1]], /*13*/ r9=[899,r8[1]+r7[1]], /*21*/ 
        r10=[999,r9[1]+r8[1]], /*34*/ r11=[1099,r10[1]+r9[1]], /*55*/ r12=[1199,r11[1]+r10[1]], /*89*/ r13=[1299,r12[1]+r11[1]], /*144*/ r14=[1399,r13[1]+r12[1]], /*233*/ 
        r15=[1499,r14[1]+r13[1]], /*377*/ r16=[1599,r15[1]+r14[1]], /*610*/ r17=[1699,r16[1]+r15[1]], /*987*/ r18=[1799,r17[1]+r16[1]], /*1597*/ r19=[1899,r18[1]+r17[1]]; /*2584*/ r20=[1999,r19[1]+r18[1]]; /*4181*/
        arr = [r1,r2,r3,r4,r5,r6,r7,r8,r9,r10,r11,r12,r13,r14,r15,r16,r17,r18,r19,r20];
        //Obtiene un numero entero entre 0 y 2000
        random = Math.floor(Math.random() * (2000 - 0 + 1)) + 0;
        //recorriendo el arreglo obteniendo el arreglo y su posición
        for(const [i,value] of arr.entries()){
            //Si el random es menor al valor del arreglo en la posicion i y es mayor al de su posicion anterior obtengo el valor
            if(random < value[0] && random > arr[i-1][0]){
                console.log('El pedido será entregado en: '+arr[i-1][1]+' días');
            }
        }
}

entregas();